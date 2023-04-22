<?php

namespace App\Service;

use App\Model\Room\Room;
use App\Model\Room\RoomCategoryCollection;
use App\Model\Room\RoomCollection;
use App\Model\Room\RoomImageCollection;
use App\Repository\Area\AreaRepositoryInterface;
use App\Repository\Room\RoomRepositoryInterface;

class RoomService
{
    private RoomRepositoryInterface $roomRepository;
    private AreaRepositoryInterface $areaRepository;

    public function __construct(RoomRepositoryInterface $roomRepository, AreaRepositoryInterface $areaRepository)
    {
        $this->roomRepository = $roomRepository;
        $this->areaRepository = $areaRepository;
    }

    public function create(float $square, string $areaId): void
    {
        if (!$this->areaRepository->findById($areaId)) {
            //exception
        }

        $roomImageCollection = new RoomImageCollection();
        $roomCategoryCollection = new RoomCategoryCollection();
        $id = $this->roomRepository->nextIdentity();

        $room = new Room(
            $roomImageCollection,
            $roomCategoryCollection,
            $id,
            $square,
            $areaId
        );

        $this->roomRepository->create($room);
    }

    public function update(string $id, float $square): void
    {
        /** @var Room $room */
        $room = $this->roomRepository->findById($id);

        $roomImageCollection = new RoomImageCollection();
        $roomCategoryCollection = new RoomCategoryCollection();

        $room = new Room(
            $roomImageCollection,
            $roomCategoryCollection,
            $id,
            $square,
            $room->getAreaId()
        );

        $this->roomRepository->update($room);
    }

    public function view(string $id): Room
    {
        return $this->roomRepository->findById($id);
    }

    public function delete(string $id): void
    {
        $this->roomRepository->deleteById($id);
    }

    public function list(string $areaId): RoomCollection
    {
        return $this->roomRepository->getListByAreaId($areaId);
    }
}