<?php

namespace App\Controller;

use App\Service\BuildingCategoryService;

class BuildingCategoryController extends AbstractController
{
    private BuildingCategoryService $buildingCategoryService;

    public function __construct(BuildingCategoryService $buildingCategoryService)
    {
        $this->buildingCategoryService = $buildingCategoryService;
    }

    public function join(array $categories, string $buildingId): void
    {
        $this->buildingCategoryService->join($categories, $buildingId);

        $this->displayJson();
    }
}