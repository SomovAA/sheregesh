<?php

namespace App\Model\Building;

use App\Model\Collection;

class BuildingCollection extends Collection
{
    public function add(Building $building)
    {
        $this->data[] = $building;
    }

    public function first(): Building
    {
        // ToDo: изменить через функцию, а не через 0
        return $this->data[0];
    }
}