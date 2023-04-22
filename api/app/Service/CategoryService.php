<?php

namespace App\Service;

use App\Model\Category\Category;
use App\Model\Category\CategoryCollection;
use App\Repository\Category\CategoryRepositoryInterface;

class CategoryService
{

    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function create(string $name): void
    {
        $id = $this->categoryRepository->nextIdentity();

        $category = new Category(
            $id,
            $name
        );
        $this->categoryRepository->create($category);
    }

    public function update(string $id, string $name): void
    {
        $category = new Category(
            $id,
            $name
        );
        $this->categoryRepository->create($category);
    }

    public function view(string $id): Category
    {
        return $this->categoryRepository->findById($id);
    }

    public function delete(string $id): void
    {
        $this->categoryRepository->deleteById($id);
    }

    public function list(): CategoryCollection
    {
        return $this->categoryRepository->getList();
    }
}