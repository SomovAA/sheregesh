<?php

namespace App\Repository\Category;

use App\Model\Category\Category;
use App\Model\Category\CategoryCollection;
use App\Repository\RepositoryInterface;

interface CategoryRepositoryInterface extends RepositoryInterface
{
    public function create(Category $category): void;

    public function getList(): CategoryCollection;

    public function update(Category $category): void;
}