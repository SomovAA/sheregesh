<?php

namespace App\Controller;

use App\Model\Building\Building;
use App\Model\Building\BuildingCollection;
use App\Service\BuildingService;

class BuildingController
{
    private BuildingService $buildingService;
    public function __construct(BuildingService $buildingService)
    {
        $this->buildingService = $buildingService;
    }
    public function create(string $square): void
    {
        $this->buildingService->create($square);

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([]);
    }
    public function update(string $id, string $square): void
    {
        $this->buildingService->update($id, $square);

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([]);
    }
    public function view(string $id): void
    {
        $building = $this->buildingService->view($id);

        $data = [
            'id' => $building->getId(),
            'square' => $building->getSquare()
        ];

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }
    public function delete(string $id): void
    {
        $this->buildingService->delete($id);

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([]);
    }
    public function list(): void
    {
        $buildingCollection = $this->buildingService->list();

        $data = [];
        /** @var Building $building */
        foreach ($buildingCollection->toArray() as $building) {
            $data[] = [
                'id' => $building->getId(),
                'square' => $building->getSquare()
            ];
        }

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }
}