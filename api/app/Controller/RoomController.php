<?php

namespace App\Controller;

use App\Model\Category\Category;
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
        $room = $this->roomService->view($id);

        $data = $this->getRoom($room);

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
            $data[] = $this->getRoom($room);
        }

        $this->displayJson($data);
    }

    private function getRoom(Room $room): array
    {
        $categories = [];
        /** @var Category $category */
        foreach ($room->getCategories()->toArray() as $category) {
            $categories[] = [
                'id' => $category->getId(),
                'name' => $category->getName(),
                'count' => $category->getCount(),
            ];
        }

        return [
            'id' => $room->getId(),
            'square' => $room->getSquare(),
            'area_id' => $room->getAreaId(),
            'categories' => $categories
        ];
    }
}