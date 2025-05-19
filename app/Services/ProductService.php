<?php

namespace App\Services;

use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductService
{
    public function __construct(protected ProductRepositoryInterface $productRepository) {}

    public function list(){
        return $this->productRepository->all();
    }

    public function find($id){
        return $this->productRepository->find($id);
    }

    public function create(array $data){
        return $this->productRepository->create($data);
    }

    public function update($id, array $data){
        return $this->productRepository->update($id, $data);
    }

    public function delete($id){
        return $this->productRepository->delete($id);
    }
}
