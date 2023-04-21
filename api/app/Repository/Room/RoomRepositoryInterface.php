<?php

namespace App\Repository\Room;

use App\Model\Room\RoomCollection;
use App\Repository\RepositoryInterface;

interface RoomRepositoryInterface extends RepositoryInterface
{
    public function getListByAreaId(string $areaId): RoomCollection;
}