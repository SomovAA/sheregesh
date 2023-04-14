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

    public function __construct(
        AreaCollection $areaCollection,
        BuildingImageCollection $imageCollection,
        BuildingCategoryCollection $categoryCollection
    ) {
        $this->areaCollection = $areaCollection;
        $this->imageCollection = $imageCollection;
        $this->categoryCollection = $categoryCollection;
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
}