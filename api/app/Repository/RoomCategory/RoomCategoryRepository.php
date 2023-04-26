<?php

namespace App\Repository\RoomCategory;

use App\Model\RoomCategory\RoomCategory;
use App\Repository\AbstractRepository;

class RoomCategoryRepository extends AbstractRepository implements RoomCategoryRepositoryInterface
{
    public function findById(string $id): RoomCategory
    {
        return new RoomCategory('1', 1, '1', '1');
    }

    public function deleteById(string $id): void
    {
        $this->pdo->query("DELETE FROM room_category WHERE id = '$id'");
    }

    public function create(RoomCategory $roomCategory): void
    {
        $id = $roomCategory->getId();
        $count = $roomCategory->getCount();
        $roomId = $roomCategory->getRoomId();
        $categoryId = $roomCategory->getCategoryId();

        $this->pdo->query("INSERT INTO room_category (id,count,room_id,category_id) VALUES('$id',$count,'$roomId','$categoryId')");
    }

    public function deleteAllByRoomId(string $roomId): void
    {
        $this->pdo->query("DELETE FROM room_category WHERE room_id = '$roomId'");
    }
}