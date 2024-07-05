import 'package:flutter/material.dart';
import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:seru_test/cubit/first_wizard_cubit/first_wizard_cubit_cubit.dart';
import 'package:seru_test/cubit/second_wizard_cubit/second_wizard_cubit_cubit.dart';
import 'package:seru_test/cubit/stepper_cubit/stepper_bloc_cubit.dart';
import 'package:seru_test/stepper.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  // This widget is the root of your application.
  @override
  Widget build(BuildContext context) {
    return MultiBlocProvider(
      providers: [
        BlocProvider(
          create: (context) => StepperBlocCubit(),
        ),
        BlocProvider(
          create: (context) => FirstWizardCubitCubit(),
        ),
        BlocProvider(
          create: (context) => SecondWizardCubitCubit(),
        ),
      ],
      child: MaterialApp(
        title: 'Flutter Demo',
        theme: ThemeData(
          appBarTheme: AppBarTheme(
              backgroundColor: Colors.blue,
              centerTitle: true,
              titleTextStyle: TextStyle(fontSize: 25, color: Colors.white)),
          useMaterial3: true,
        ),
        home: StepperPage(),
      ),
    );
  }
}
