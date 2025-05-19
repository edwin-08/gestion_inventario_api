<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\ProductModel;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(protected ProductService $productService) {}

    public function index()
    {
        return ProductResource::collection($this->productService->list());
    }

    public function store(ProductRequest $request)
    {
        $this->productService->create($request->validated());
        return response()->json(["status" => true, "message" => "El producto se ha creado exitosamente"]);
    }

    public function show($id)
    {
        return new ProductResource($this->productService->find($id));
    }

    public function update(ProductRequest $request, $id)
    {
        $this->productService->update($id, $request->validated());
        return response()->json(["status" => true, "message" => "Producto actualizado correctamente"]);
    }

    public function destroy($id)
    {
        try {
            $this->productService->delete($id);
            return response()->json(["status" => true, "message" => "Se ha eliminado correctamente el producto"]);
        } catch (\Exception $e) {
            return response()->json(["status" => false, "message" => "Hubo un problema al eliminar el producto o no existe este ID"]);
        }
    }
}
