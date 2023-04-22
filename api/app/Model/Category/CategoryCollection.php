<?php

namespace App\Model\Category;

use App\Model\Collection;

class CategoryCollection extends Collection
{
    public function add(Category $category)
    {
        $this->data[] = $category;
    }
}