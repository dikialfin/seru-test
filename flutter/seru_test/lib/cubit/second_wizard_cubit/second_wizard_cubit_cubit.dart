import 'dart:io';

import 'package:bloc/bloc.dart';
import 'package:image_picker/image_picker.dart';
import 'package:meta/meta.dart';
import 'package:path_provider/path_provider.dart';

part 'second_wizard_cubit_state.dart';

class SecondWizardCubitCubit extends Cubit<SecondWizardCubitState> {
  SecondWizardCubitCubit() : super(SecondWizardCubitInitial());

  Future<File> uplodaPhoto({required XFile photoFile}) async {
    try {
      Directory aplicationDirectory = await getApplicationDocumentsDirectory();
      return await File(photoFile.path)
          .copy("${aplicationDirectory.path}/${photoFile.name}");
    } catch (e) {
      throw e;
    }
  }

  deletePhoto({required File photoFile}) async {
    try {
      await photoFile.delete();
    } catch (e) {
      throw e;
    }
  }
}
