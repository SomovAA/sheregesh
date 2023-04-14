<?php

namespace App\Repository\Room;

use App\Model\Room\Room;
use App\Repository\RepositoryInterface;

interface RoomRepositoryInterface extends RepositoryInterface
{
    public function save(Room $room);
}