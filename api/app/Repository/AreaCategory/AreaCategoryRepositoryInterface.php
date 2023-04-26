<?php

namespace App\Repository\AreaCategory;

use App\Model\AreaCategory\AreaCategory;
use App\Repository\RepositoryInterface;
interface AreaCategoryRepositoryInterface extends RepositoryInterface
{
    public function create(AreaCategory $areaCategory): void;

    public function deleteAllByAreaId(string $areaId): void;
}