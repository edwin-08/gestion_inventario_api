<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(protected CategoryService $categoryService) {}

    public function index(){
        return CategoryResource::collection($this->categoryService->list());
    }

    public function store(CategoryRequest $request)
    {
        $product = $this->categoryService->create($request->validated());
        return new CategoryResource($product);
    }

    public function show($id)
    {
        return new CategoryResource($this->categoryService->find($id));
    }

    public function update(CategoryRequest $request, $id)
    {
        $product = $this->categoryService->update($id, $request->validated());
        return new CategoryResource($product);
    }

    public function destroy($id)
    {
        $this->categoryService->delete($id);
        return response()->noContent();
    }
}
