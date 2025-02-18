<?php

namespace App\Http\Controllers;

use App\Models\Code;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CodeController extends Controller
{
    public function save_code(Request $request){
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'percentage' => 'required',
            'shop_id' => 'required|exists:shops,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 200);
        }

        $code = new Code();
        $code->code = $request->code;
        $code->percentage = $request->percentage;
        $code->shop_id = $request->shop_id;
        $code->save();

        return response()->json([
            'success' => true,
            'message' => 'Succés'
        ], 200);
    }

    public function update_code(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'percentage' => 'required',
            'code' => 'required',
            'shop_id' => 'required|exists:shops,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 200);
        }

        $code = Code::find($id);
        $code->code = $request->code;
        $code->percentage = $request->percentage;
        $code->shop_id = $request->shop_id;
        $code->save();

        return response()->json([
            'success' => true,
            'message' => 'Succés'
        ], 200);
    }

    public function get_codes($shop_id = null){
        if ($shop_id) {
            return Code::where('shop_id', $shop_id)->get();
        }
        return Code::all();
    }

    public function get_code($id){
        return Code::find($id);
    }

    public function delete_code($id){
        $code = Code::find($id);
        if ($code) {
            $code->delete();
            return response()->json([
                'success' => true,
                'message' => 'Code supprimé'
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Code non trouvé'
        ], 404);
    }
    }
