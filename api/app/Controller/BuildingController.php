<?php

namespace App\Controller;

use App\Model\Building\Building;
use App\Model\Category\Category;
use App\Service\BuildingService;

class BuildingController extends AbstractController
{
    private BuildingService $buildingService;

    public function __construct(BuildingService $buildingService)
    {
        $this->buildingService = $buildingService;
    }

    public function create(float $square): void
    {
        $this->buildingService->create($square);

        $this->displayJson();
    }

    public function update(string $id, float $square): void
    {
        $this->buildingService->update($id, $square);

        $this->displayJson();
    }

    public function view(string $id): void
    {
        $building = $this->buildingService->view($id);

        $data = $this->getBuilding($building);

        $this->displayJson($data);
    }

    public function delete(string $id): void
    {
        $this->buildingService->delete($id);

        $this->displayJson();
    }

    public function list(): void
    {
        $buildingCollection = $this->buildingService->list();

        $data = [];
        /** @var Building $building */
        foreach ($buildingCollection->toArray() as $building) {
            $data[] = $this->getBuilding($building);
        }

        $this->displayJson($data);
    }

    private function getBuilding(Building $building): array
    {
        $categories = [];
        /** @var Category $category */
        foreach ($building->getCategories()->toArray() as $category) {
            $categories[] = [
                'id' => $category->getId(),
                'name' => $category->getName(),
                'count' => $category->getCount(),
            ];
        }

        return [
            'id' => $building->getId(),
            'square' => $building->getSquare(),
            'categories' => $categories
        ];
    }
}