<?php

namespace App\Repository\Area;

use App\Model\Area\Area;
use App\Model\Area\AreaCollection;
use App\Repository\RepositoryInterface;

interface AreaRepositoryInterface extends RepositoryInterface
{
    public function create(Area $area): void;

    public function getList(string $buildingId): AreaCollection;

    public function update(Area $area): void;
}