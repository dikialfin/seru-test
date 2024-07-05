import 'package:bloc/bloc.dart';

class StepperBlocCubit extends Cubit<int> {
  StepperBlocCubit() : super(0);

  void selectStep(int index) {
    emit(index);
  }

  void nextStep() {
    if (this.state < 3) {
      emit(this.state + 1);
    }
  }

  void prevStep() {
    if (this.state != 0) {
      emit(this.state - 1);
    }
  }
}
