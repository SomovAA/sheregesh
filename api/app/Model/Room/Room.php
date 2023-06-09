<?php

namespace App\Model\Room;

/**
 * Комната
 * Class Room
 * @package App\Model
 */
class Room
{
    private RoomImageCollection $imageCollection;
    private RoomCategoryCollection $categoryCollection;
    private string $id;
    private float $square;
    private string $areaId;

    public function __construct(
        RoomImageCollection $imageCollection,
        RoomCategoryCollection $categoryCollection,
        string $id,
        float $square,
        string $areaId
    ) {
        $this->imageCollection = $imageCollection;
        $this->categoryCollection = $categoryCollection;
        $this->id = $id;
        $this->square = $square;
        $this->areaId = $areaId;
    }

    public function getImages(): RoomImageCollection
    {
        return $this->imageCollection;
    }

    public function getCategories(): RoomCategoryCollection
    {
        return $this->categoryCollection;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getSquare(): float
    {
        return $this->square;
    }

    public function getAreaId(): string
    {
        return $this->areaId;
    }
}