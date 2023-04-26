<?php

namespace App\Model\Area;

use App\Model\Collection;

class AreaCollection extends Collection
{
    public function add(Area $area)
    {
        $this->data[] = $area;
    }

    public function first(): Area
    {
        // ToDo: изменить через функцию, а не через 0
        return $this->data[0];
    }
}