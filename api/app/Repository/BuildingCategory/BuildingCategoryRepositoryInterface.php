<?php

namespace App\Repository\BuildingCategory;

use App\Model\BuildingCategory\BuildingCategory;
use App\Repository\RepositoryInterface;

interface BuildingCategoryRepositoryInterface extends RepositoryInterface
{
    public function create(BuildingCategory $buildingCategory): void;

    public function deleteAllByBuildingId(string $buildingId): void;
}