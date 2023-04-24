<?php

namespace App\Controller;

use App\Model\Room\Room;
use App\Service\RoomService;

class RoomController extends AbstractController
{
    private RoomService $roomService;

    public function __construct(RoomService $roomService)
    {
        $this->roomService = $roomService;
    }

    public function create(float $square, string $areaId): void
    {
        $this->roomService->create($square, $areaId);

        $this->displayJson();
    }

    public function update(string $id, float $square): void
    {
        $this->roomService->update($id, $square);

        $this->displayJson();
    }

    public function view(string $id): void
    {
        $area = $this->roomService->view($id);

        $data = [
            'id' => $area->getId(),
            'square' => $area->getSquare(),
            'area_id' => $area->getAreaId()
        ];

        $this->displayJson($data);
    }

    public function delete(string $id): void
    {
        $this->roomService->delete($id);

        $this->displayJson();
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

        $this->displayJson($data);
    }
}