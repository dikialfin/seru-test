import 'dart:io';

import 'package:flutter/material.dart';
import 'package:flutter/widgets.dart';
import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:image_picker/image_picker.dart';
import 'package:seru_test/cubit/second_wizard_cubit/second_wizard_cubit_cubit.dart';
import 'package:seru_test/widget/fotoField.dart';

class FormWizardSecond extends StatefulWidget {
  FormWizardSecond({super.key});

  @override
  State<FormWizardSecond> createState() => _FormWizardSecondState();
}

class _FormWizardSecondState extends State<FormWizardSecond> {
  ImagePicker picker = ImagePicker();
  File? selfiePath;
  File? ktpPath;
  File? bebasPath;

  @override
  Widget build(BuildContext context) {
    return Column(
      children: [
        selfiePath == null
            ? addFotoField(
                tittle: "tambah foto selfie",
                action: () async {
                  XFile? photo =
                      await picker.pickImage(source: ImageSource.camera);

                  if (photo != null) {
                    File resultPhoto = await context
                        .read<SecondWizardCubitCubit>()
                        .uplodaPhoto(photoFile: photo);
                    setState(() {
                      selfiePath = resultPhoto;
                    });
                  }
                },
              )
            : deleteFotoField(
                photo: selfiePath!,
                action: () async {
                  context
                      .read<SecondWizardCubitCubit>()
                      .deletePhoto(photoFile: selfiePath!);
                  setState(() {
                    selfiePath = null;
                  });
                },
              ),
        SizedBox(
          height: 20,
        ),
        ktpPath == null
            ? addFotoField(
                tittle: "tambah foto ktp",
                action: () async {
                  XFile? photo =
                      await picker.pickImage(source: ImageSource.gallery);

                  if (photo != null) {
                    File resultPhoto = await context
                        .read<SecondWizardCubitCubit>()
                        .uplodaPhoto(photoFile: photo);
                    setState(() {
                      ktpPath = resultPhoto;
                    });
                  }
                },
              )
            : deleteFotoField(
                photo: ktpPath!,
                action: () async {
                  context
                      .read<SecondWizardCubitCubit>()
                      .deletePhoto(photoFile: ktpPath!);
                  setState(() {
                    ktpPath = null;
                  });
                },
              ),
        SizedBox(
          height: 20,
        ),
        bebasPath == null
            ? addFotoField(
                tittle: "tambah foto bebas",
                action: () async {
                  XFile? photo =
                      await picker.pickImage(source: ImageSource.gallery);

                  if (photo != null) {
                    File resultPhoto = await context
                        .read<SecondWizardCubitCubit>()
                        .uplodaPhoto(photoFile: photo);
                    setState(() {
                      bebasPath = resultPhoto;
                    });
                  }
                },
              )
            : deleteFotoField(
                photo: bebasPath!,
                action: () async {
                  context
                      .read<SecondWizardCubitCubit>()
                      .deletePhoto(photoFile: bebasPath!);
                  setState(() {
                    bebasPath = null;
                  });
                },
              ),
      ],
    );
  }
}
