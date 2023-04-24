<?php

namespace App\Controller;

use App\Model\Category\Category;
use App\Service\CategoryService;

class CategoryController extends AbstractController
{
    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function create(string $name): void
    {
        $this->categoryService->create($name);

        $this->displayJson();
    }

    public function update(string $id, float $name): void
    {
        $this->categoryService->update($id, $name);

        $this->displayJson();
    }

    public function delete(string $id): void
    {
        $this->categoryService->delete($id);

        $this->displayJson();
    }

    public function view(string $id): void
    {
        $category = $this->categoryService->view($id);

        $data = [
            'id' => $category->getId(),
            'name' => $category->getName()
        ];

        $this->displayJson($data);
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

        $this->displayJson($data);
    }
}