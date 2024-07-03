<?php

namespace App\Http\Controllers;

use App\Models\VehicleType;
use Exception;
use Illuminate\Http\Request;

class VehicleTypeController extends Controller
{
    public function createData(Request $request) {
        $rules = [
            'name' => 'required|string',
            'brand_id' => 'required|integer',
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

            $vehicle = new VehicleType();
            $vehicle->name = $request->get('name');
            $vehicle->brand_id = $request->get('brand_id');
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

    private function vehicleTypeById($id) {
        return VehicleType::select("vehicle_type.*","vehicle_brand.name as brand_name")->where("vehicle_type.id",$id)->join("vehicle_brand",'vehicle_type.brand_id','=','vehicle_brand.id')->paginate(10);
    }

    private function vehicleType() {
        return VehicleType::select("vehicle_type.*","vehicle_brand.name as brand_name")->join("vehicle_brand",'vehicle_type.brand_id','=','vehicle_brand.id')->paginate(10);
    }

    public function getVehicleType(Request $request, $id = null) {
        try {
            $data = [];

            if ($id != null) {
                $data = $this->vehicleTypeById($id);
            }
            if ($id == null) {
                $data = $this->vehicleType();
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

        } catch (Exception $th) {
            return response()->json([
                "status" => "failed",
                "message" => "internal server error",
                "status_code" => 500,
                "errors" => ["message" => $th->getMessage()]
            ], 500);
        }
    }

    public function editData(Request $request, $id) {

        $rules = [
            'name' => 'required|string',
            'brand_id' => 'required|integer',
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
            if (count($this->vehicleTypeById($id)) < 1) {
                return response()->json([
                    "status" => "failed",
                    "message" => "not found",
                    "status_code" => 404,
                    "errors" => ["message" => "data not found"]
                ], 404);
            }

            $vehicleType = VehicleType::find($id);
            $vehicleType->name = $request->get('name');
            $vehicleType->save();

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
            if (count($this->vehicleTypeById($id)) < 1) {
                return response()->json([
                    "status" => "failed",
                    "message" => "not found",
                    "status_code" => 404,
                    "errors" => ["message" => "data not found"]
                ], 404);
            }

            $vehicleType = VehicleType::where('id',$id);
            $vehicleType->delete();
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
