<?php

namespace App\Model\Room;

use App\Model\Collection;

class RoomCollection extends Collection
{
    public function add(Room $room)
    {
        $this->data[] = $room;
    }

    public function first(): Room
    {
        // ToDo: изменить через функцию, а не через 0
        return $this->data[0];
    }
}