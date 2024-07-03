<?php

namespace App\Http\Controllers;

use App\Models\VehicleBrand;
use Illuminate\Http\Request;

class VehicleBrandController extends Controller
{
    public function createData(Request $request) {
        $rules = [
            'name' => 'required|string',
        ];

        $validator = validator($request->all(),$rules);

        if ($validator->fails()) {
            return response()->json([
                "status" => "failed",
                "message" => "bad request",
                "status_code" => 400,
                "errors" => $validator->errors()
            ], 400);
        }

        try {

            $vehicle = new VehicleBrand();
            $vehicle->name = $request->get('name');
            $vehicle->save();

            return response()->json([
                "status" => "success",
                "data" => [],
                "message" => "data has created",
                "status_code" => 201,
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => "failed",
                "message" => "internal server error",
                "status_code" => 500,
                "errors" => ["message" => "An error occurred while creating data"]
            ], 500);
        }

    }

    private function vehicleBrandById($id) {
        return VehicleBrand::where("id",$id)->paginate(10);
    }

    private function vehicleBrand() {
        return VehicleBrand::paginate(10);
    }

    public function getVehicleBrand(Request $request, $id = null) {
        try {
            $data = [];

            if ($id != null) {
                $data = $this->vehicleBrandById($id);
            }
            if ($id == null) {
                $data = $this->vehicleBrand();
            }

            if (count($data) < 1) {
                return response()->json([
                    "status" => "failed",
                    "message" => "not found",
                    "status_code" => 404,
                    "errors" => ["message" => "data not found"]
                ], 404);
            }

            
            return response()->json([
                "status" => "success",
                "data" => $data,
                "message" => "data founded",
                "status_code" => 200,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => "failed",
                "message" => "internal server error",
                "status_code" => 500,
                "errors" => ["message" => "An error occurred while geting data"]
            ], 500);
        }
    }

    public function editData(Request $request, $id) {

        $rules = [
            "name" => "required"
        ];

        $validator = validator($request->all(),$rules);

        if ($validator->fails()) {
            return response()->json([
                "status" => "failed",
                "message" => "bad request",
                "status_code" => 400,
                "errors" => $validator->errors()
            ], 400);
        }

        try {
            if (count($this->vehicleBrandById($id)) < 1) {
                return response()->json([
                    "status" => "failed",
                    "message" => "not found",
                    "status_code" => 404,
                    "errors" => ["message" => "data not found"]
                ], 404);
            }

            $vehicleBrand = VehicleBrand::find($id);
            $vehicleBrand->name = $request->get('name');
            $vehicleBrand->save();

            return response()->json([
                "status" => "success",
                "data" => [],
                "message" => "data has updated",
                "status_code" => 201,
            ], 201);

        } catch (\Throwable $th) {
            return response()->json([
                "status" => "failed",
                "message" => "internal server error",
                "status_code" => 500,
                "errors" => ["message" => "An error occurred while updating data"]
            ], 500);
        }
    }

    public function deleteData(Request $request,$id) {
        try {
            if (count($this->vehicleBrandById($id)) < 1) {
                return response()->json([
                    "status" => "failed",
                    "message" => "not found",
                    "status_code" => 404,
                    "errors" => ["message" => "data not found"]
                ], 404);
            }

            $vehicleBrand = VehicleBrand::where('id',$id);
            $vehicleBrand->delete();
            return response()->json([
                "status" => "success",
                "data" => [],
                "message" => "data has deleted",
                "status_code" => 200,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => "failed",
                "message" => "internal server error",
                "status_code" => 500,
                "errors" => ["message" => "An error occurred while deleting data"]
            ], 500);
        }
    }
}
