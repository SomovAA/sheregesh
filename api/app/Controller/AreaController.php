<?php

namespace App\Controller;

use App\Model\Area\Area;
use App\Service\AreaService;

class AreaController
{
    private AreaService $areaService;
    public function __construct(AreaService $areaService)
    {
        $this->areaService = $areaService;
    }
    public function create(float $square, string $buildingId): void
    {
        $this->areaService->create($square, $buildingId);

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([]);
    }

    public function update(string $id, float $square): void
    {
        $this->areaService->update($id, $square);

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([]);
    }

    public function view(string $id): void
    {
        $area = $this->areaService->view($id);

        $data = [
            'id' => $area->getId(),
            'square' => $area->getSquare(),
            'building_id' => $area->getBuildingId()
        ];

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function delete(string $id): void
    {
        $this->areaService->delete($id);

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([]);
    }

    public function list(string $buildingId): void
    {
        $areaCollection = $this->areaService->list($buildingId);

        $data = [];
        /** @var Area $area */
        foreach ($areaCollection->toArray() as $area) {
            $data[] = [
                'id' => $area->getId(),
                'square' => $area->getSquare()
            ];
        }

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }
}