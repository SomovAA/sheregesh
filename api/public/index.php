<?php

use App\Container;
use App\Controller\AreaController;
use App\Controller\BuildingCategoryController;
use App\Controller\BuildingController;
use App\Controller\CategoryController;
use App\Controller\RoomController;
use App\Request;

require __DIR__ . '/../vendor/autoload.php';

$request = new Request($_SERVER, $_REQUEST, $_GET, $_POST);
$container = new Container();

if ($request->compareUrl('/api/v1/admin/building/category/join') && $request->isPost()) {
    $buildingId = (string)$request->post('building_id');
    $categories = (array)$request->post('categories');
    /*$buildingId = 'a0eebc99-9c0b-4ef8-bb6d-6bb9bd380a11';
    $categories = [[
        'id' => 'a0eebc99-9c0b-4ef8-bb6d-6bb9bd480a11',
        'count' => 2
    ]];*/

    /** @var BuildingCategoryController $buildingCategoryController */
    $buildingCategoryController = $container->get(BuildingCategoryController::class);

    $buildingCategoryController->join($categories, $buildingId);
}
if ($request->compareUrl('/api/v1/admin/building/create') && $request->isPost()) {
    $square = (float)$request->post('square');

    /** @var BuildingController $buildingController */
    $buildingController = $container->get(BuildingController::class);

    $buildingController->create($square);
}
if ($request->compareUrl('/api/v1/admin/building/view') && $request->isGet()) {
    $id = (string)$request->get('id');

    /** @var BuildingController $buildingController */
    $buildingController = $container->get(BuildingController::class);

    $buildingController->view($id);
}
if ($request->compareUrl('/api/v1/admin/building/update') && $request->isPost()) {
    $id = (string)$request->post('id');
    $square = (float)$request->post('square');

    /** @var BuildingController $buildingController */
    $buildingController = $container->get(BuildingController::class);

    $buildingController->update($id, $square);
}
if ($request->compareUrl('/api/v1/admin/building/delete') && $request->isPost()) {
    $id = (string)$request->post('id');

    /** @var BuildingController $buildingController */
    $buildingController = $container->get(BuildingController::class);

    $buildingController->delete($id);
}
if ($request->compareUrl('/api/v1/admin/building/list') && $request->isGet()) {
    /** @var BuildingController $buildingController */
    $buildingController = $container->get(BuildingController::class);

    $buildingController->list();
}


if ($request->compareUrl('/api/v1/admin/area/create') && $request->isPost()) {
    $buildingId = (string)$request->post('building_id');
    $square = (float)$request->post('square');

    /** @var AreaController $areaController */
    $areaController = $container->get(AreaController::class);

    $areaController->create($square, $buildingId);
}
if ($request->compareUrl('/api/v1/admin/area/update') && $request->isPost()) {
    $id = (string)$request->post('id');
    $square = (float)$request->post('square');

    /** @var AreaController $areaController */
    $areaController = $container->get(AreaController::class);

    $areaController->update($id, $square);
}
if ($request->compareUrl('/api/v1/admin/area/view') && $request->isGet()) {
    $id = (string)$request->get('id');

    /** @var AreaController $areaController */
    $areaController = $container->get(AreaController::class);

    $areaController->view($id);
}
if ($request->compareUrl('/api/v1/admin/area/delete') && $request->isPost()) {
    $id = (string)$request->post('id');

    /** @var AreaController $areaController */
    $areaController = $container->get(AreaController::class);

    $areaController->delete($id);
}
if ($request->compareUrl('/api/v1/admin/area/list') && $request->isGet()) {
    $buildingId = (string)$request->get('building_id');

    /** @var AreaController $areaController */
    $areaController = $container->get(AreaController::class);

    $areaController->list($buildingId);
}


if ($request->compareUrl('/api/v1/admin/room/create') && $request->isPost()) {
    $areaId = (string)$request->post('area_id');
    $square = (float)$request->post('square');

    /** @var RoomController $roomController */
    $roomController = $container->get(RoomController::class);

    $roomController->create($square, $areaId);
}
if ($request->compareUrl('/api/v1/admin/room/update') && $request->isPost()) {
    $id = (string)$request->post('id');
    $square = (float)$request->post('square');

    /** @var RoomController $roomController */
    $roomController = $container->get(RoomController::class);

    $roomController->update($id, $square);
}
if ($request->compareUrl('/api/v1/admin/room/view') && $request->isGet()) {
    $id = (string)$request->get('id');

    /** @var RoomController $roomController */
    $roomController = $container->get(RoomController::class);

    $roomController->view($id);
}
if ($request->compareUrl('/api/v1/admin/room/delete') && $request->isPost()) {
    $id = (string)$request->post('id');

    /** @var RoomController $roomController */
    $roomController = $container->get(RoomController::class);

    $roomController->delete($id);
}
if ($request->compareUrl('/api/v1/admin/room/list') && $request->isGet()) {
    $areaId = (string)$request->get('area_id');

    /** @var RoomController $roomController */
    $roomController = $container->get(RoomController::class);

    $roomController->list($areaId);
}


if ($request->compareUrl('/api/v1/admin/category/create') && $request->isPost()) {
    $name = (string)$request->post('name');

    /** @var CategoryController $categoryController */
    $categoryController = $container->get(CategoryController::class);

    $categoryController->create($name);
}
if ($request->compareUrl('/api/v1/admin/category/view') && $request->isGet()) {
    $id = (string)$request->get('id');

    /** @var CategoryController $categoryController */
    $categoryController = $container->get(CategoryController::class);

    $categoryController->view($id);
}
if ($request->compareUrl('/api/v1/admin/category/update') && $request->isPost()) {
    $id = (string)$request->post('id');
    $name = (string)$request->post('name');

    /** @var CategoryController $categoryController */
    $categoryController = $container->get(CategoryController::class);

    $categoryController->update($id, $name);
}
if ($request->compareUrl('/api/v1/admin/category/delete') && $request->isPost()) {
    $id = (string)$request->post('id');

    /** @var CategoryController $categoryController */
    $categoryController = $container->get(CategoryController::class);

    $categoryController->delete($id);
}
if ($request->compareUrl('/api/v1/admin/category/list') && $request->isGet()) {
    /** @var CategoryController $categoryController */
    $categoryController = $container->get(CategoryController::class);

    $categoryController->list();
}
//1. генератор api
//2. админка для работы с категориями
//3. админка для работы с картинками
//4. бронирование
//4.1 календарь

echo '<pre>';
print_r($_SERVER);
print_r($_GET);
print_r($_POST);
print_r($_REQUEST);