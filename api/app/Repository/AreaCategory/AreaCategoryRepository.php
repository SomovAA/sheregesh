<?php

namespace App\Repository\AreaCategory;

use App\Model\AreaCategory\AreaCategory;
use App\Repository\AbstractRepository;

class AreaCategoryRepository extends AbstractRepository implements AreaCategoryRepositoryInterface
{
    public function create(AreaCategory $areaCategory): void
    {
        $id = $areaCategory->getId();
        $count = $areaCategory->getCount();
        $areaId = $areaCategory->getAreaId();
        $categoryId = $areaCategory->getCategoryId();

        $this->pdo->query("INSERT INTO area_category (id,count,area_id,category_id) VALUES('$id',$count,'$areaId','$categoryId')");
    }

    public function deleteAllByAreaId(string $areaId): void
    {
        $this->pdo->query("DELETE FROM area_category WHERE area_id = '$areaId'");
    }

    public function findById(string $id): AreaCategory
    {
        return new AreaCategory('1', 1, '1', '1');
    }

    public function deleteById(string $id): void
    {
        $this->pdo->query("DELETE FROM area_category WHERE id = '$id'");
    }
}