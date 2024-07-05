part of 'first_wizard_cubit_cubit.dart';

@immutable
sealed class FirstWizardCubitState {}

final class FirstWizardCubitInitial extends FirstWizardCubitState {}

final class FormFirstWizardSaved extends FirstWizardCubitState {
  final String firstName;
  final String lastName;
  final String biodata;
  final String selectedProvinsi;
  final String selectedKota;
  final String selectedKecamatan;
  final String selectedKelurahan;

  FormFirstWizardSaved({
    required String this.firstName,
    required String this.lastName,
    required String this.biodata,
    required String this.selectedProvinsi,
    required String this.selectedKota,
    required String this.selectedKecamatan,
    required String this.selectedKelurahan,
  });
}
