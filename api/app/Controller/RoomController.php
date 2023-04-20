<?php

namespace App\Controller;

use App\Model\Room\Room;
use App\Model\Room\RoomCollection;
use App\Service\RoomService;

class RoomController
{
    private RoomService $roomService;

    public function __construct(RoomService $roomService)
    {
        $this->roomService = $roomService;
    }

    public function list(string $areaId): void
    {
        $roomCollection = $this->roomService->list($areaId);

        $data = [];
        /** @var Room $room */
        foreach ($roomCollection->toArray() as $room) {
            $data[] = [
                'id' => $room->getId(),
                'square' => $room->getSquare()
            ];
        }

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }
}