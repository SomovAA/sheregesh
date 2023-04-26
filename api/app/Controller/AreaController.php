<?php

namespace App\Controller;

use App\Model\Area\Area;
use App\Model\Category\Category;
use App\Service\AreaService;

class AreaController extends AbstractController
{
    private AreaService $areaService;
    public function __construct(AreaService $areaService)
    {
        $this->areaService = $areaService;
    }
    public function create(float $square, string $buildingId): void
    {
        $this->areaService->create($square, $buildingId);

        $this->displayJson();
    }

    public function update(string $id, float $square): void
    {
        $this->areaService->update($id, $square);

        $this->displayJson();
    }

    public function view(string $id): void
    {
        $area = $this->areaService->view($id);

        $data = $this->getArea($area);

        $this->displayJson($data);
    }

    public function delete(string $id): void
    {
        $this->areaService->delete($id);

        $this->displayJson();
    }

    public function list(string $buildingId): void
    {
        $areaCollection = $this->areaService->list($buildingId);

        $data = [];
        /** @var Area $area */
        foreach ($areaCollection->toArray() as $area) {
            $data[] = $this->getArea($area);
        }

        $this->displayJson($data);
    }

    private function getArea(Area $area): array
    {
        $categories = [];
        /** @var Category $category */
        foreach ($area->getCategories()->toArray() as $category) {
            $categories[] = [
                'id' => $category->getId(),
                'name' => $category->getName(),
                'count' => $category->getCount(),
            ];
        }

        return [
            'id' => $area->getId(),
            'square' => $area->getSquare(),
            'building_id' => $area->getBuildingId(),
            'categories' => $categories
        ];
    }
}