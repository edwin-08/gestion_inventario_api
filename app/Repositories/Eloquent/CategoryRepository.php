<?php
namespace App\Repositories\Eloquent;

use App\Models\CategoryModel;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{

    public function all()
    {
        return CategoryModel::all();
    }

    public function find($id)
    {
        return CategoryModel::findOrFail($id);
    }

    public function create(array $data)
    {
        return CategoryModel::create($data);        
    }

    public function update($id, array $data)
    {
        $category = $this->find($id);
        $category->update($data);
        return $category;        
    }

    public function delete($id)
    {
        $category = $this->find($id);
        return $category->delete();        
    }
}
