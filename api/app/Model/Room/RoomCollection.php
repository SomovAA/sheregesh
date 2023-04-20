<?php

namespace App\Model\Room;

use App\Model\Collection;

class RoomCollection extends Collection
{
    public function add(Room $room)
    {
        $this->data[] = $room;
    }
}