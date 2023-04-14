<?php

use App\Category\Category;
use App\Model\Area\Area;
use App\Model\Area\AreaCategoryCollection;
use App\Model\Area\AreaCollection;
use App\Model\Area\AreaImageCollection;
use App\Model\Building\Building;
use App\Model\Building\BuildingCategoryCollection;
use App\Model\Building\BuildingCollection;
use App\Model\Building\BuildingImageCollection;
use App\Model\Image\Image;
use App\Model\Room\Room;
use App\Model\Room\RoomCategoryCollection;
use App\Model\Room\RoomCollection;
use App\Model\Room\RoomImageCollection;

$image = new Image();
$roomImageCollection = new RoomImageCollection();
$roomImageCollection->add($image);

$category = new Category();
$roomCategoryCollection = new RoomCategoryCollection();
$roomCategoryCollection->add($category);

$square = 100.5;
$room = new Room($roomImageCollection, $roomCategoryCollection, $square);
$roomCollection = new RoomCollection();
$roomCollection->add($room);


$image = new Image();
$areaImageCollection = new AreaImageCollection();
$areaImageCollection->add($image);

$category = new Category();
$areaCategoryCollection = new AreaCategoryCollection();
$areaCategoryCollection->add($category);

$square = 300.5;
$area = new Area($roomCollection, $areaImageCollection, $areaCategoryCollection, $square);
$areaCollection = new AreaCollection();
$areaCollection->add($area);


$image = new Image();
$buildingImageCollection = new BuildingImageCollection();
$buildingImageCollection->add($image);

$category = new Category();
$buildingCategoryCollection = new BuildingCategoryCollection();
$buildingCategoryCollection->add($category);

$building = new Building($areaCollection, $buildingImageCollection, $buildingCategoryCollection);
$buildingCollection = new BuildingCollection();
$buildingCollection->add($building);