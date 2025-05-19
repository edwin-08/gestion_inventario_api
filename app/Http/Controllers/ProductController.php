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

    public function index() {
        return ProductResource::collection($this->productService->list());
    }

    public function store(ProductRequest $request)
    {
        $product = $this->productService->create($request->validated());
        return new ProductResource($product);
    }

    public function show($id)
    {
        return new ProductResource($this->productService->find($id));
    }

    public function update(ProductRequest $request, $id)
    {
        $product = $this->productService->update($id, $request->validated());
        return new ProductResource($product);
    }

    public function destroy($id)
    {
        $this->productService->delete($id);
        return response()->noContent();
    }
}
