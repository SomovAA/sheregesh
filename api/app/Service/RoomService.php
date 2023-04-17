<?php

namespace App\Service;

use App\Model\Room\RoomCollection;
use App\Repository\Room\RoomRepositoryInterface;

class RoomService
{
    private RoomRepositoryInterface $roomRepository;

    public function __construct(RoomRepositoryInterface $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }

    public function list(string $areaId): RoomCollection
    {
        return $this->roomRepository->getListByAreaId($areaId);
    }
}