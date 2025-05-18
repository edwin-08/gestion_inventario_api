<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        try {
            $products = ProductModel::all();
            return response()->json(["status" => true, "message" =>"", "products" => $products]);
        } catch (\Throwable $th) {
            return response()->json(["status" => false, "message" => "Hubo un problema al obtener los productos"], 500);
        }
    }
}
