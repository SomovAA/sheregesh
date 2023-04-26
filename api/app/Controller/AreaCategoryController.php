<?php

namespace App\Controller;
use App\Service\AreaCategoryService;

class AreaCategoryController extends AbstractController
{
    private AreaCategoryService $areaCategoryService;

    public function __construct(AreaCategoryService $areaCategoryService)
    {
        $this->areaCategoryService = $areaCategoryService;
    }

    public function join(array $categories, string $buildingId): void
    {
        $this->areaCategoryService->join($categories, $buildingId);

        $this->displayJson();
    }
}