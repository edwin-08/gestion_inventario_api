<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(protected UserService $userService) {}

    public function index()
    {
        return UserResource::collection($this->userService->list());
    }

    public function show($id)
    {
        return new UserResource($this->userService->find($id));
    }

    public function store(UserRequest $request)
    {
        $this->userService->create($request->validated());
        return response()->json(["status" => true, "message" => "El usuario se ha creado exitosamente"]);
    }

    public function update(UserRequest $request, $id)
    {
        $this->userService->update($id, $request->validated());
        return response()->json(["status" => true, "message" => "Usuario actualizado correctamente"]);
    }

    public function destroy($id)
    {
        try {
            $this->userService->delete($id);
            return response()->json(["status" => true, "message" => "Se ha eliminado correctamente el usuario"]);
        } catch (\Exception $e) {
            return response()->json(["status" => false, "message" => "Hubo un problema al eliminar el usuario o no existe este ID"]);
        }
    }
}
