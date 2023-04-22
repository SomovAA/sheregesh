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

    public function create(float $square, string $areaId): void
    {
        $this->roomService->create($square, $areaId);

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([]);
    }

    public function update(string $id, float $square): void
    {
        $this->roomService->update($id, $square);

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([]);
    }

    public function view(string $id): void
    {
        $area = $this->roomService->view($id);

        $data = [
            'id' => $area->getId(),
            'square' => $area->getSquare(),
            'area_id' => $area->getAreaId()
        ];

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function delete(string $id): void
    {
        $this->roomService->delete($id);

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([]);
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