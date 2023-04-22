<?php

use App\Container;
use App\Controller\AreaController;
use App\Controller\BuildingController;
use App\Controller\RoomController;
use App\Request;

require __DIR__ . '/../vendor/autoload.php';

$request = new Request($_SERVER, $_REQUEST, $_GET, $_POST);
$container = new Container();

if ($request->compareUrl('/api/v1/building/create') && $request->isPost()) {
    $square = (float)$request->post('square');

    /** @var BuildingController $buildingController */
    $buildingController = $container->get(BuildingController::class);

    $buildingController->create($square);
}
if ($request->compareUrl('/api/v1/building/view') && $request->isGet()) {
    $id = (string)$request->get('id');

    /** @var BuildingController $buildingController */
    $buildingController = $container->get(BuildingController::class);

    $buildingController->view($id);
}
if ($request->compareUrl('/api/v1/building/update') && $request->isPost()) {
    $id = (string)$request->post('id');
    $square = (float)$request->post('square');

    /** @var BuildingController $buildingController */
    $buildingController = $container->get(BuildingController::class);

    $buildingController->update($id, $square);
}
if ($request->compareUrl('/api/v1/building/delete') && $request->isPost()) {
    $id = (string)$request->post('id');

    /** @var BuildingController $buildingController */
    $buildingController = $container->get(BuildingController::class);

    $buildingController->delete($id);
}
if ($request->compareUrl('/api/v1/building/list') && $request->isGet()) {
    /** @var BuildingController $buildingController */
    $buildingController = $container->get(BuildingController::class);

    $buildingController->list();
}


if ($request->compareUrl('/api/v1/area/create') && $request->isPost()) {
    $buildingId = (string)$request->post('building_id');
    $square = (float)$request->post('square');

    /** @var AreaController $areaController */
    $areaController = $container->get(AreaController::class);

    $areaController->create($square, $buildingId);
}
if ($request->compareUrl('/api/v1/area/update') && $request->isPost()) {
    $id = (string)$request->post('id');
    $square = (float)$request->post('square');

    /** @var AreaController $areaController */
    $areaController = $container->get(AreaController::class);

    $areaController->update($id, $square);
}
if ($request->compareUrl('/api/v1/area/view') && $request->isGet()) {
    $id = (string)$request->get('id');

    /** @var AreaController $areaController */
    $areaController = $container->get(AreaController::class);

    $areaController->view($id);
}
if ($request->compareUrl('/api/v1/area/delete') && $request->isPost()) {
    $id = (string)$request->post('id');

    /** @var AreaController $areaController */
    $areaController = $container->get(AreaController::class);

    $areaController->delete($id);
}
if ($request->compareUrl('/api/v1/area/list') && $request->isGet()) {
    $buildingId = (string)$request->get('building_id');

    /** @var AreaController $areaController */
    $areaController = $container->get(AreaController::class);

    $areaController->list($buildingId);
}


if ($request->compareUrl('/api/v1/room/create') && $request->isPost()) {
    $areaId = (string)$request->post('area_id');
    $square = (float)$request->post('square');

    /** @var RoomController $roomController */
    $roomController = $container->get(RoomController::class);

    $roomController->create($square, $areaId);
}
if ($request->compareUrl('/api/v1/room/update') && $request->isPost()) {
    $id = (string)$request->post('id');
    $square = (float)$request->post('square');

    /** @var RoomController $roomController */
    $roomController = $container->get(RoomController::class);

    $roomController->update($id, $square);
}
if ($request->compareUrl('/api/v1/room/view') && $request->isGet()) {
    $id = (string)$request->get('id');

    /** @var RoomController $roomController */
    $roomController = $container->get(RoomController::class);

    $roomController->view($id);
}
if ($request->compareUrl('/api/v1/room/delete') && $request->isPost()) {
    $id = (string)$request->post('id');

    /** @var RoomController $roomController */
    $roomController = $container->get(RoomController::class);

    $roomController->delete($id);
}
if ($request->compareUrl('/api/v1/room/list') && $request->isGet()) {
    $areaId = (string)$request->get('area_id');

    /** @var RoomController $roomController */
    $roomController = $container->get(RoomController::class);

    $roomController->list($areaId);
}

echo '<pre>';
print_r($_SERVER);
print_r($_GET);
print_r($_POST);
print_r($_REQUEST);