import 'package:flutter/material.dart';
import 'package:dropdown_button2/dropdown_button2.dart';

Widget dropdownSelectSearchable(
    {required String hintText,
    required List<DropdownMenuItem<String>> data,
    required Function(String? value)? onChanged,
    required String? Function(String? value)? validator,
    String? selectedValue,
    void Function(String?)? onSaved}) {
  return DropdownButtonFormField2<String>(
    value: selectedValue,
    isExpanded: true,
    decoration: InputDecoration(
      contentPadding: const EdgeInsets.symmetric(vertical: 16),
      border: OutlineInputBorder(
        borderRadius: BorderRadius.circular(15),
      ),
    ),
    hint: Text(
      hintText,
      style: TextStyle(fontSize: 14),
    ),
    items: data,
    validator: validator,
    onChanged: onChanged,
    onSaved: onSaved,
    buttonStyleData: const ButtonStyleData(
      padding: EdgeInsets.only(right: 8),
    ),
    iconStyleData: const IconStyleData(
      icon: Icon(
        Icons.arrow_drop_down,
        color: Colors.black45,
      ),
      iconSize: 24,
    ),
    dropdownStyleData: DropdownStyleData(
      decoration: BoxDecoration(
        borderRadius: BorderRadius.circular(15),
      ),
    ),
    menuItemStyleData: const MenuItemStyleData(
      padding: EdgeInsets.symmetric(horizontal: 16),
    ),
  );
}
