<?php

namespace App\Services;

use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryService
{
    public function __construct(protected CategoryRepositoryInterface $categoryRepository) {}

    public function list(){
        return $this->categoryRepository->all();
    }

    public function find($id){
        return $this->categoryRepository->find($id);
    }

    public function create(array $data){
        return $this->categoryRepository->create($data);
    }

    public function update($id, array $data){
        return $this->categoryRepository->update($id, $data);
    }

    public function delete($id){
        return $this->categoryRepository->delete($id);
    }
}
