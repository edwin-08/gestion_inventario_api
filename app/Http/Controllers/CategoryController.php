<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(protected CategoryService $categoryService) {}

    public function index()
    {
        return CategoryResource::collection($this->categoryService->list());
    }

    //Función Store ayuda en la creación de nuevas categorias, además,
    // CategoryRequest valida los datos antes de crear la información
    public function store(CategoryRequest $request)
    {
        $this->categoryService->create($request->validated());
        return response()->json(["status" => true, "message" => "La categoria se ha creado correctamente"]);
    }

    public function show($id)
    {
        return new CategoryResource($this->categoryService->find($id));
    }

    public function update(CategoryRequest $request, $id)
    {
        $this->categoryService->update($id, $request->validated());
        return response()->json(["status" => true, "message" => "La categoría se ha actualizado correctamente"]);
    }

    public function destroy($id)
    {
        try {
            $this->categoryService->delete($id);
            return response()->json(["status" => true, "message" => "La categoría se ha eliminado correctamente"]);
        } catch (\Exception $e) {
            return response()->json(["status" => false, "message" => "Hubo un problema al eliminar la categoría o no existe este ID"]);
        }
    }
}
