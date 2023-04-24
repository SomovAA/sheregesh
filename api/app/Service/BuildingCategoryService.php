<?php

namespace App\Service;

use App\Model\BuildingCategory\BuildingCategory;
use App\Repository\BuildingCategory\BuildingCategoryRepositoryInterface;

class BuildingCategoryService
{
    private BuildingCategoryRepositoryInterface $buildingCategoryRepository;

    public function __construct(BuildingCategoryRepositoryInterface $buildingCategoryRepository)
    {
        $this->buildingCategoryRepository = $buildingCategoryRepository;
    }

    public function join(array $categories, string $buildingId): void
    {
        foreach ($categories as $data) {
            $id = $this->buildingCategoryRepository->nextIdentity();

            $buildingCategory = new BuildingCategory(
                $id,
                $data['count'],
                $buildingId,
                $data['id']
            );

            $this->buildingCategoryRepository->create($buildingCategory);
        }
    }
}