<?php

namespace App\Repository\Area;

use App\Model\Area\Area;
use App\Repository\RepositoryInterface;

interface AreaRepositoryInterface extends RepositoryInterface
{
    public function save(Area $area);
}