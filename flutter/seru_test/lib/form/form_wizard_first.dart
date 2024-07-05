import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:flutter/widgets.dart';
import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:seru_test/cubit/first_wizard_cubit/first_wizard_cubit_cubit.dart';
import 'package:seru_test/data.dart';
import 'package:seru_test/widget/dropdownSelect.dart';
import 'package:seru_test/widget/textArea.dart';
import 'package:seru_test/widget/textField.dart';

class FormWizardFirst extends StatefulWidget {
  final GlobalKey<FormState> formKey;
  FormWizardFirst({super.key, required this.formKey});

  @override
  State<FormWizardFirst> createState() => _FormWizardFirstState();
}

class _FormWizardFirstState extends State<FormWizardFirst> {
  TextEditingController firstName = TextEditingController();
  TextEditingController lastName = TextEditingController();
  TextEditingController biodata = TextEditingController();
  String? selectedProvinsi;
  String? selectedKota;
  String? selectedKecamatan;
  String? selectedKelurahan;

  List<DropdownMenuItem<String>> provinsi = dataProvinsi
      .map((provinsi) => DropdownMenuItem<String>(
            value: provinsi,
            child: Text(
              provinsi,
              style: const TextStyle(
                fontSize: 14,
              ),
            ),
          ))
      .toList();
  List<DropdownMenuItem<String>> kota = dataKota
      .map((kota) => DropdownMenuItem<String>(
            value: kota,
            child: Text(
              kota,
              style: const TextStyle(
                fontSize: 14,
              ),
            ),
          ))
      .toList();
  List<DropdownMenuItem<String>> kecamatan = dataKecamatan
      .map((kecamatan) => DropdownMenuItem<String>(
            value: kecamatan,
            child: Text(
              kecamatan,
              style: const TextStyle(
                fontSize: 14,
              ),
            ),
          ))
      .toList();
  List<DropdownMenuItem<String>> kelurahan = dataKelurahan
      .map((kelurahan) => DropdownMenuItem<String>(
            value: kelurahan,
            child: Text(
              kelurahan,
              style: const TextStyle(
                fontSize: 14,
              ),
            ),
          ))
      .toList();

  @override
  Widget build(BuildContext context) {
    return Form(
        key: widget.formKey,
        child: SingleChildScrollView(
          child: Column(
            children: [
              textFieldForm(
                label: "First Name",
                controller: firstName,
                validator: (value) {
                  if (value == null || value.isEmpty) {
                    return "firstname wajib di isi";
                  }
                  return null;
                },
              ),
              SizedBox(
                height: 20,
              ),
              textFieldForm(
                  label: "Last Name",
                  controller: lastName,
                  validator: (value) {
                    if (value == null || value.isEmpty) {
                      return "lastname wajib di isi";
                    }
                    return null;
                  }),
              SizedBox(
                height: 20,
              ),
              textArea(
                  label: "Biodata",
                  controller: biodata,
                  validator: (value) {
                    if (value == null || value.isEmpty) {
                      return "biodata wajib di isi";
                    }
                    return null;
                  }),
              SizedBox(
                height: 20,
              ),
              dropdownSelectSearchable(
                  selectedValue: selectedProvinsi,
                  hintText: "Pilih Provinsi",
                  validator: (value) {
                    if (value == null || value.isEmpty) {
                      return "provinsi wajib di isi";
                    }
                    return null;
                  },
                  data: provinsi,
                  onChanged: (String? val) {
                    selectedProvinsi = val;
                  }),
              SizedBox(
                height: 20,
              ),
              dropdownSelectSearchable(
                  selectedValue: selectedKota,
                  hintText: "Pilih Kota",
                  validator: (value) {
                    if (value == null || value.isEmpty) {
                      return "kota wajib di isi";
                    }
                    return null;
                  },
                  data: kota,
                  onChanged: (String? val) {
                    selectedKota = val;
                  }),
              SizedBox(
                height: 20,
              ),
              dropdownSelectSearchable(
                  selectedValue: selectedKecamatan,
                  hintText: "Pilih Kecamatan",
                  validator: (value) {
                    if (value == null || value.isEmpty) {
                      return "kecamatan wajib di isi";
                    }
                    return null;
                  },
                  data: kecamatan,
                  onChanged: (String? val) {
                    selectedKecamatan = val;
                  }),
              SizedBox(
                height: 20,
              ),
              dropdownSelectSearchable(
                  selectedValue: selectedKelurahan,
                  hintText: "Pilih kelurahan",
                  validator: (value) {
                    if (value == null || value.isEmpty) {
                      return "kelurahan wajib di isi";
                    }
                    return null;
                  },
                  data: kelurahan,
                  onChanged: (String? val) {
                    selectedKelurahan = val;
                  },
                  onSaved: (val) {
                    context.read<FirstWizardCubitCubit>().saveForm(
                        firstName: firstName.text,
                        lastName: lastName.text,
                        biodata: biodata.text,
                        selectedProvinsi: selectedProvinsi!,
                        selectedKota: selectedKota!,
                        selectedKecamatan: selectedKecamatan!,
                        selectedKelurahan: selectedKelurahan!);
                  })
            ],
          ),
        ));
  }
}
