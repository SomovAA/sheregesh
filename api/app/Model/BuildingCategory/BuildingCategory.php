<?php

namespace App\Model\BuildingCategory;
class BuildingCategory
{
    private string $id;
    private int $count;
    private string $buildingId;
    private string $categoryId;

    public function __construct(string $id, int $count, string $buildingId, string $categoryId)
    {
        $this->id = $id;
        $this->count = $count;
        $this->buildingId = $buildingId;
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

    public function getBuildingId(): string
    {
        return $this->buildingId;
    }

    public function getCategoryId(): string
    {
        return $this->categoryId;
    }
}