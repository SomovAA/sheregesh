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
    private float $square;

    public function __construct(
        RoomImageCollection $imageCollection,
        RoomCategoryCollection $categoryCollection,
        float $square
    ) {
        $this->imageCollection = $imageCollection;
        $this->categoryCollection = $categoryCollection;
        $this->square = $square;
    }

    public function getImages(): RoomImageCollection
    {
        return $this->imageCollection;
    }

    public function getCategories(): RoomCategoryCollection
    {
        return $this->categoryCollection;
    }
}