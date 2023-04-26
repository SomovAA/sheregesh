<?php

namespace App\Model\AreaCategory;
class AreaCategory
{
    private string $id;
    private int $count;
    private string $areaId;
    private string $categoryId;

    public function __construct(string $id, int $count, string $areaId, string $categoryId)
    {
        $this->id = $id;
        $this->count = $count;
        $this->areaId = $areaId;
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

    public function getAreaId(): string
    {
        return $this->areaId;
    }

    public function getCategoryId(): string
    {
        return $this->categoryId;
    }
}