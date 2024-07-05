import 'package:flutter/material.dart';
import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:seru_test/cubit/stepper_cubit/stepper_bloc_cubit.dart';
import 'package:seru_test/form/form_wizard_first.dart';
import 'package:seru_test/form/form_wizard_second.dart';
import 'package:seru_test/form/form_wizard_third.dart';

class StepperPage extends StatefulWidget {
  const StepperPage({super.key});

  @override
  State<StepperPage> createState() => _StepperPageState();
}

class _StepperPageState extends State<StepperPage> {
  GlobalKey<FormState> formKey = GlobalKey<FormState>();

  @override
  Widget build(BuildContext context) {
    return Scaffold(
        appBar: AppBar(
          title: Text("Stepper Form"),
        ),
        body: BlocBuilder<StepperBlocCubit, int>(
          builder: (context, state) {
            return Stepper(
                type: StepperType.horizontal,
                currentStep: state,
                onStepContinue: () {
                  if (state == 0 && !formKey.currentState!.validate()) {
                    return;
                  }
                  formKey.currentState!.save();
                  context.read<StepperBlocCubit>().nextStep();
                },
                onStepCancel: () {
                  context.read<StepperBlocCubit>().prevStep();
                },
                steps: [
                  Step(
                      title: Text("Wizard 1"),
                      content: FormWizardFirst(
                        formKey: formKey,
                      ),
                      isActive: state == 0 ? true : false),
                  Step(
                      title: Text("Wizard 2"),
                      content: FormWizardSecond(),
                      isActive: state == 1 ? true : false),
                  Step(
                      title: Text("Wizard 3"),
                      content: FormWizardThird(),
                      isActive: state == 2 ? true : false),
                ]);
          },
        ));
  }
}
