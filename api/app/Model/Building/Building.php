<?php

namespace App\Model\Building;

use App\Model\Area\AreaCollection;

/**
 * Здание | объект | котедж
 * Class Building
 * @package App\Model
 */
class Building
{
    private AreaCollection $areaCollection;
    private BuildingImageCollection $imageCollection;
    private BuildingCategoryCollection $categoryCollection;
    private string $id;
    private float $square;

    public function __construct(
        AreaCollection $areaCollection,
        BuildingImageCollection $imageCollection,
        BuildingCategoryCollection $categoryCollection,
        string $id,
        float $square
    ) {
        $this->areaCollection = $areaCollection;
        $this->imageCollection = $imageCollection;
        $this->categoryCollection = $categoryCollection;
        $this->id = $id;
        $this->square = $square;
    }

    public function getAreas(): AreaCollection
    {
        return $this->areaCollection;
    }

    public function getImages(): BuildingImageCollection
    {
        return $this->imageCollection;
    }

    public function getCategories(): BuildingCategoryCollection
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
}