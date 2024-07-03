<?php

namespace App\Http\Controllers;

use App\Models\VehicleModel;
use Exception;
use Illuminate\Http\Request;

class VehicleModelController extends Controller
{
    public function createData(Request $request) {
        $rules = [
            'name' => 'required|string',
            'type_id' => 'required|integer',
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

            $vehicle = new VehicleModel();
            $vehicle->name = $request->get('name');
            $vehicle->type_id = $request->get('type_id');
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

    private function vehicleModelById($id) {
        return VehicleModel::select("vehicle_model.*","vehicle_type.name as type_name")->where("vehicle_model.id",$id)
        ->join("vehicle_type",'vehicle_type.id','=','vehicle_model.type_id')->paginate(10);
    }

    private function vehicleModel() {
        return VehicleModel::select("vehicle_model.*","vehicle_type.name as type_name")->join("vehicle_type",'vehicle_type.id','=','vehicle_model.type_id')->paginate(10);
    }

    public function getVehicleModel(Request $request, $id = null) {
        try {
            $data = [];

            if ($id != null) {
                $data = $this->vehicleModelById($id);
            }
            if ($id == null) {
                $data = $this->vehicleModel();
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
            'type_id' => 'required|integer',
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
            if (count($this->vehicleModelById($id)) < 1) {
                return response()->json([
                    "status" => "failed",
                    "message" => "not found",
                    "status_code" => 404,
                    "errors" => ["message" => "data not found"]
                ], 404);
            }

            $vehicle = VehicleModel::find($id);
            $vehicle->name = $request->get('name');
            $vehicle->type_id = $request->get('type_id');
            $vehicle->save();

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
            if (count($this->vehicleModelById($id)) < 1) {
                return response()->json([
                    "status" => "failed",
                    "message" => "not found",
                    "status_code" => 404,
                    "errors" => ["message" => "data not found"]
                ], 404);
            }

            $vehicle = VehicleModel::where('id',$id);
            $vehicle->delete();
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
