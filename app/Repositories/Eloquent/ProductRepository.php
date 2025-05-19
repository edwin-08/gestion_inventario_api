<?php
namespace App\Repositories\Eloquent;

use App\Models\ProductModel;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{

    public function all()
    {
        return ProductModel::all();
    }

    public function find($id)
    {
        return ProductModel::findOrFail($id);
    }

    public function create(array $data)
    {
        return ProductModel::create($data);        
    }

    public function update($id, array $data)
    {
        $product = $this->find($id);
        $product->update($data);
        return $product;        
    }

    public function delete($id)
    {
        $product = $this->find($id);
        return $product->delete();        
    }
}
