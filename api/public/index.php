<?php

use App\Controller\RoomController;
use App\Model\Area\Area;
use App\Model\Area\AreaCategoryCollection;
use App\Model\Area\AreaCollection;
use App\Model\Area\AreaImageCollection;
use App\Model\Building\Building;
use App\Model\Building\BuildingCategoryCollection;
use App\Model\Building\BuildingCollection;
use App\Model\Building\BuildingImageCollection;
use App\Model\Category\Category;
use App\Model\Image\Image;
use App\Model\Room\Room;
use App\Model\Room\RoomCategoryCollection;
use App\Model\Room\RoomCollection;
use App\Model\Room\RoomImageCollection;
use App\Repository\Room\RoomRepository;
use App\Request;
use App\Service\RoomService;

require __DIR__ . '/../vendor/autoload.php';

$image = new Image();
$roomImageCollection = new RoomImageCollection();
$roomImageCollection->add($image);

$category = new Category();
$roomCategoryCollection = new RoomCategoryCollection();
$roomCategoryCollection->add($category);

$roomId = 1;
$square = 100.5;
$room = new Room($roomImageCollection, $roomCategoryCollection, $roomId, $square);
$roomCollection = new RoomCollection();
$roomCollection->add($room);


$image = new Image();
$areaImageCollection = new AreaImageCollection();
$areaImageCollection->add($image);

$category = new Category();
$areaCategoryCollection = new AreaCategoryCollection();
$areaCategoryCollection->add($category);

$areaId = 1;
$square = 300.5;
$area = new Area($roomCollection, $areaImageCollection, $areaCategoryCollection, $areaId, $square);
$areaCollection = new AreaCollection();
$areaCollection->add($area);


$image = new Image();
$buildingImageCollection = new BuildingImageCollection();
$buildingImageCollection->add($image);

$category = new Category();
$buildingCategoryCollection = new BuildingCategoryCollection();
$buildingCategoryCollection->add($category);

$buildingId = 1;
$square = 900;
$building = new Building($areaCollection, $buildingImageCollection, $buildingCategoryCollection, $buildingId, $square);
$buildingCollection = new BuildingCollection();
$buildingCollection->add($building);

$host = 'postgresql';
$db = 'api';
$username = 'admin';
$password = 'admin';

$dsn = "pgsql:host=$host;port=5432;dbname=$db;user=$username;password=$password";
try {
    $pdo = new PDO($dsn);
} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}
$request = new Request($_SERVER, $_REQUEST, $_GET, $_POST);

if ($request->getUrl() === '/api/v1/room/list' && $request->isGet()) {
    $roomRepository = new RoomRepository($pdo);
    $roomService = new RoomService($roomRepository);
    $controller = new RoomController($roomService);

    $areaId = 'a0eebc99-9c0b-4ef8-bb6d-7bb9bd380a12';
    $roomCollection = $controller->list($areaId);

    $data = [];
    /** @var Room $room */
    foreach ($roomCollection->toArray() as $room) {
        $data[] = [
            'id' => $room->getId(),
            'square' => $room->getSquare()
        ];
    }

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);
}

echo '<pre>';
print_r($_SERVER);
print_r($_GET);
print_r($_POST);
print_r($_REQUEST);