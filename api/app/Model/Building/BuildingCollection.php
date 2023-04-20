<?php

namespace App\Model\Building;

use App\Model\Collection;

class BuildingCollection extends Collection
{
    public function add(Building $building)
    {
        $this->data[] = $building;
    }
}