<?php

namespace App\Model\Room;

class RoomCollection
{
    private array $data = [];

    public function add(Room $room)
    {
        $this->data[] = $room;
    }

    public function toArray(): array
    {
        return $this->data;
    }
}