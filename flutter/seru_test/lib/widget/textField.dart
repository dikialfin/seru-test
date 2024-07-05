import 'package:flutter/material.dart';
import 'package:flutter/widgets.dart';

Widget textFieldForm(
        {required String label,
        required TextEditingController controller,
        String? Function(String?)? validator}) =>
    TextFormField(
      controller: controller,
      textInputAction: TextInputAction.next,
      validator: validator,
      decoration: InputDecoration(
          labelText: label,
          hintText: label,
          contentPadding: EdgeInsets.symmetric(vertical: 5, horizontal: 10),
          border: OutlineInputBorder(
              borderRadius: BorderRadius.circular(10),
              borderSide:
                  BorderSide(color: Colors.black, style: BorderStyle.solid)),
          focusedBorder: OutlineInputBorder(
              borderRadius: BorderRadius.circular(10),
              borderSide:
                  BorderSide(color: Colors.black38, style: BorderStyle.solid)),
          focusedErrorBorder: OutlineInputBorder(
              borderRadius: BorderRadius.circular(10),
              borderSide: BorderSide(
                  color: const Color.fromARGB(255, 180, 79, 79),
                  style: BorderStyle.solid)),
          errorBorder: OutlineInputBorder(
              borderRadius: BorderRadius.circular(10),
              borderSide:
                  BorderSide(color: Colors.red, style: BorderStyle.solid))),
    );
