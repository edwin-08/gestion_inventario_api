<?php

namespace App\Services;

use App\Repositories\Interfaces\UserRepositoryInterface;

class UserService
{
    public function __construct(protected UserRepositoryInterface $userRepository) {}

    public function list(){
        return $this->userRepository->all();
    }

    public function find($id){
        return $this->userRepository->find($id);
    }

    public function create(array $data){
        return $this->userRepository->create($data);
    }

    public function update($id, array $data){
        return $this->userRepository->update($id, $data);
    }

    public function delete($id){
        return $this->userRepository->delete($id);
    }
}
