<?php

namespace App\Http\Controllers;

use App\Models\Pricelist;
use Exception;
use Illuminate\Http\Request;

class PricelistController extends Controller
{
    public function createData(Request $request) {
        $rules = [
            'code' => 'required|string',
            'price' => 'required|integer',
            'year_id' => 'required|integer',
            'model_id' => 'required|integer',
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

            $pricelist = new Pricelist();
            $pricelist->code = $request->get('code');
            $pricelist->price = $request->get('price');
            $pricelist->year_id = $request->get('year_id');
            $pricelist->model_id = $request->get('model_id');
            $pricelist->save();

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

    private function pricelistById($id) {
        return Pricelist::select("pricelist.*","vehicle_year.year","vehicle_model.name")
        ->where("pricelist.id",$id)
        ->join("vehicle_year",'vehicle_year.id','=','pricelist.year_id')
        ->join("vehicle_model",'vehicle_model.id','=','pricelist.model_id')
        ->paginate(10);
    }

    private function pricelist() {
        return Pricelist::select("pricelist.*","vehicle_year.year","vehicle_model.name")
        ->join("vehicle_year",'vehicle_year.id','=','pricelist.year_id')
        ->join("vehicle_model",'vehicle_model.id','=','pricelist.model_id')
        ->paginate(10);
    }

    public function getPricelist(Request $request, $id = null) {
        try {
            $data = [];

            if ($id != null) {
                $data = $this->pricelistById($id);
            }
            if ($id == null) {
                $data = $this->pricelist();
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
            'code' => 'required|string',
            'price' => 'required|integer',
            'year_id' => 'required|integer',
            'model_id' => 'required|integer',
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
            if (count($this->pricelistById($id)) < 1) {
                return response()->json([
                    "status" => "failed",
                    "message" => "not found",
                    "status_code" => 404,
                    "errors" => ["message" => "data not found"]
                ], 404);
            }

            $pricelist = Pricelist::find($id);
            $pricelist->code = $request->get('code');
            $pricelist->price = $request->get('price');
            $pricelist->year_id = $request->get('year_id');
            $pricelist->model_id = $request->get('model_id');
            $pricelist->save();

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
            if (count($this->pricelistById($id)) < 1) {
                return response()->json([
                    "status" => "failed",
                    "message" => "not found",
                    "status_code" => 404,
                    "errors" => ["message" => "data not found"]
                ], 404);
            }

            $pricelist = Pricelist::where('id',$id);
            $pricelist->delete();
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
