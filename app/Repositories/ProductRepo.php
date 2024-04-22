<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepo
{
    public function getAll()
    {
        return Product::query()->get();
    }

}
