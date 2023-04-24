<?php

namespace App\Repository\BuildingCategory;

use App\Model\BuildingCategory\BuildingCategory;
use App\Repository\AbstractRepository;

class BuildingCategoryRepository extends AbstractRepository implements BuildingCategoryRepositoryInterface
{
    public function findById(string $id): BuildingCategory
    {
        return new BuildingCategory('1', 1, '1', '1');
    }

    public function deleteById(string $id): void
    {
        $this->pdo->query("DELETE FROM building_category WHERE id = '$id'");
    }

    public function create(BuildingCategory $buildingCategory): void
    {
        $id = $buildingCategory->getId();
        $count = $buildingCategory->getCount();
        $buildingId = $buildingCategory->getBuildingId();
        $categoryId = $buildingCategory->getCategoryId();

        $this->pdo->query("INSERT INTO building_category (id,count,building_id,category_id) VALUES('$id',$count,'$buildingId','$categoryId')");
    }

    public function deleteAllByBuildingId(string $buildingId): void
    {
        $this->pdo->query("DELETE FROM building_category WHERE building_id = '$buildingId'");
    }
}