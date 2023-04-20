<?php

namespace App\Service;

use App\Model\Area\AreaCollection;
use App\Model\Building\Building;
use App\Model\Building\BuildingCategoryCollection;
use App\Model\Building\BuildingCollection;
use App\Model\Building\BuildingImageCollection;
use App\Repository\Building\BuildingRepositoryInterface;

class BuildingService
{
    private BuildingRepositoryInterface $buildingRepository;

    public function __construct(BuildingRepositoryInterface $buildingRepository)
    {
        $this->buildingRepository = $buildingRepository;
    }

    public function create(string $square): void
    {
        $areaCollection = new AreaCollection();
        $buildingImageCollection = new BuildingImageCollection();
        $buildingCategoryCollection = new BuildingCategoryCollection();
        $id = $this->buildingRepository->nextIdentity();

        $building = new Building(
            $areaCollection,
            $buildingImageCollection,
            $buildingCategoryCollection,
            $id,
            $square
        );
        $this->buildingRepository->create($building);
    }

    public function update(string $id, string $square): void
    {
        $areaCollection = new AreaCollection();
        $buildingImageCollection = new BuildingImageCollection();
        $buildingCategoryCollection = new BuildingCategoryCollection();

        $building = new Building(
            $areaCollection,
            $buildingImageCollection,
            $buildingCategoryCollection,
            $id,
            $square
        );
        $this->buildingRepository->update($building);
    }

    public function view(string $id): Building
    {
        return $this->buildingRepository->findById($id);
    }

    public function delete(string $id): void
    {
        $this->buildingRepository->deleteById($id);
    }

    public function list(): BuildingCollection
    {
        return $this->buildingRepository->getList();
    }
}