<?php


namespace App\Model\Area;


use App\Model\Room\RoomCollection;

/**
 * Помещение | номер
 * Class Area
 * @package App\Model
 */
class Area
{
    private RoomCollection $roomCollection;
    private AreaImageCollection $imageCollection;
    private AreaCategoryCollection $categoryCollection;
    private float $square;

    public function __construct(
        RoomCollection $roomCollection,
        AreaImageCollection $imageCollection,
        AreaCategoryCollection $categoryCollection,
        float $square
    ) {
        $this->roomCollection = $roomCollection;
        $this->imageCollection = $imageCollection;
        $this->categoryCollection = $categoryCollection;
        $this->square = $square;
    }

    public function getRooms(): RoomCollection
    {
        return $this->roomCollection;
    }

    public function getImages(): AreaImageCollection
    {
        return $this->imageCollection;
    }

    public function getCategories(): AreaCategoryCollection
    {
        return $this->categoryCollection;
    }
}