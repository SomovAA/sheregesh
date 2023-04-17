<?php

namespace App\Repository\Building;

use App\Model\Building\Building;
use App\Repository\RepositoryInterface;

interface BuildingRepository extends RepositoryInterface
{
    public function save(Building $building);
}