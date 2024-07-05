import 'package:bloc/bloc.dart';
import 'package:meta/meta.dart';

part 'first_wizard_cubit_state.dart';

class FirstWizardCubitCubit extends Cubit<FirstWizardCubitState> {
  FirstWizardCubitCubit() : super(FirstWizardCubitInitial());

  void saveForm({
    required String firstName,
    required String lastName,
    required String biodata,
    required String selectedProvinsi,
    required String selectedKota,
    required String selectedKecamatan,
    required String selectedKelurahan,
  }) {
    emit(FormFirstWizardSaved(
        firstName: firstName,
        lastName: lastName,
        biodata: biodata,
        selectedProvinsi: selectedProvinsi,
        selectedKota: selectedKota,
        selectedKecamatan: selectedKecamatan,
        selectedKelurahan: selectedKelurahan));
  }
}
