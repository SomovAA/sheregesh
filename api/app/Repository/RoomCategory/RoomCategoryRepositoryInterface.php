<?php

namespace App\Repository\RoomCategory;

use App\Model\RoomCategory\RoomCategory;
use App\Repository\RepositoryInterface;

interface RoomCategoryRepositoryInterface extends RepositoryInterface
{
    public function create(RoomCategory $roomCategory): void;

    public function deleteAllByRoomId(string $roomId): void;
}