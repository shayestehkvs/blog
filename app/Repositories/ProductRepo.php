<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepo implements IProductRepo
{
    public function getAll()
    {
        return ProductRepo::query()->get();
    }
    public function getById($id)
    {
        return ProductRepo::find($id);
    }

}
