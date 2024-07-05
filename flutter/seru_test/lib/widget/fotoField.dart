import 'dart:io';

import 'package:flutter/material.dart';

Widget addFotoField({required String tittle, required Function() action}) =>
    Container(
      width: double.infinity,
      height: 150,
      decoration: BoxDecoration(
          border: Border.all(
            color: Colors.black,
            style: BorderStyle.solid,
          ),
          borderRadius: BorderRadius.circular(10)),
      child: Column(
        mainAxisAlignment: MainAxisAlignment.center,
        children: [
          TextButton(
              onPressed: action,
              child: Column(
                children: [Icon(Icons.add), Text(tittle)],
              ))
        ],
      ),
    );

Widget deleteFotoField({required File photo, required Function() action}) =>
    Container(
      width: double.infinity,
      height: 150,
      decoration: BoxDecoration(
          image: DecorationImage(image: FileImage(photo)),
          border: Border.all(
            color: Colors.black,
            style: BorderStyle.solid,
          ),
          borderRadius: BorderRadius.circular(10)),
      child: Align(
        alignment: Alignment.bottomRight,
        child: Container(
          width: 50,
          height: 50,
          decoration: BoxDecoration(
              borderRadius: BorderRadius.only(
                  bottomRight: Radius.circular(10),
                  topLeft: Radius.circular(10)),
              color: Colors.red[300]),
          child: Center(
            child: IconButton(
                onPressed: action,
                icon: Icon(
                  Icons.delete,
                  color: Colors.white,
                )),
          ),
        ),
      ),
    );
