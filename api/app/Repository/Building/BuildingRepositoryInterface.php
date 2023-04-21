<?php

namespace App\Repository\Building;

use App\Model\Building\Building;
use App\Model\Building\BuildingCollection;
use App\Repository\RepositoryInterface;

interface BuildingRepositoryInterface extends RepositoryInterface
{
    public function create(Building $building): void;

    public function getList(): BuildingCollection;

    public function update(Building $building): void;
}