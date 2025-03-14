<?php

namespace App\Http\Controllers;

use App\Models\VehicleYear;
use Exception;
use Illuminate\Http\Request;

class VehicleYearController extends Controller
{
    public function createData(Request $request) {
        $rules = [
            'year' => 'required|integer',
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

            $vehicle = new VehicleYear();
            $vehicle->year = $request->get('year');
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

    private function vehicleYearById($id) {
        return VehicleYear::where("vehicle_year.id",$id)->paginate(10);
    }

    private function vehicleYear() {
        return VehicleYear::paginate(10);
    }

    public function getVehicleYear(Request $request, $id = null) {
        try {
            $data = [];

            if ($id != null) {
                $data = $this->vehicleYearById($id);
            }
            if ($id == null) {
                $data = $this->vehicleYear();
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
            'year' => 'required|integer',
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
            if (count($this->vehicleYearById($id)) < 1) {
                return response()->json([
                    "status" => "failed",
                    "message" => "not found",
                    "status_code" => 404,
                    "errors" => ["message" => "data not found"]
                ], 404);
            }

            $vehicle = VehicleYear::find($id);
            $vehicle->year = $request->get('year');
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
            if (count($this->vehicleYearById($id)) < 1) {
                return response()->json([
                    "status" => "failed",
                    "message" => "not found",
                    "status_code" => 404,
                    "errors" => ["message" => "data not found"]
                ], 404);
            }

            $vehicle = VehicleYear::where('id',$id);
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
