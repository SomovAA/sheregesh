<?php

namespace App\Controller;

use App\Model\Category\Category;
use App\Service\CategoryService;

class CategoryController
{

    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function create(string $name): void
    {
        $this->categoryService->create($name);

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([]);
    }

    public function update(string $id, float $name): void
    {
        $this->categoryService->update($id, $name);

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([]);
    }

    public function delete(string $id): void
    {
        $this->categoryService->delete($id);

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([]);
    }

    public function view(string $id): void
    {
        $category = $this->categoryService->view($id);

        $data = [
            'id' => $category->getId(),
            'name' => $category->getName()
        ];

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function list(): void
    {
        $categoryCollection = $this->categoryService->list();

        $data = [];
        /** @var Category $category */
        foreach ($categoryCollection->toArray() as $category) {
            $data[] = [
                'id' => $category->getId(),
                'name' => $category->getName()
            ];
        }

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }
}