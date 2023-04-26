<?php

namespace App\Model\RoomCategory;

class RoomCategory
{
    private string $id;
    private int $count;
    private string $roomId;
    private string $categoryId;

    public function __construct(string $id, int $count, string $roomId, string $categoryId)
    {

        $this->id = $id;
        $this->count = $count;
        $this->roomId = $roomId;
        $this->categoryId = $categoryId;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function getRoomId(): string
    {
        return $this->roomId;
    }

    public function getCategoryId(): string
    {
        return $this->categoryId;
    }
}