<?php

namespace App\Service;

use App\Model\RoomCategory\RoomCategory;
use App\Repository\RoomCategory\RoomCategoryRepositoryInterface;

class RoomCategoryService
{

    private RoomCategoryRepositoryInterface $roomCategoryRepository;

    public function __construct(RoomCategoryRepositoryInterface $roomCategoryRepository)
    {
        $this->roomCategoryRepository = $roomCategoryRepository;
    }

    public function join(array $categories, string $roomId): void
    {
        $this->roomCategoryRepository->deleteAllByRoomId($roomId);

        foreach ($categories as $data) {
            $id = $this->roomCategoryRepository->nextIdentity();

            $roomCategory = new RoomCategory(
                $id,
                $data['count'],
                $roomId,
                $data['id']
            );

            $this->roomCategoryRepository->create($roomCategory);
        }
    }
}