<?php

namespace App\Controller;

use App\Model\Room\RoomCollection;
use App\Service\RoomService;

class RoomController
{
    private RoomService $roomService;

    public function __construct(RoomService $roomService)
    {
        $this->roomService = $roomService;
    }

    public function list(string $areaId): RoomCollection
    {
        return $this->roomService->list($areaId);
    }
}