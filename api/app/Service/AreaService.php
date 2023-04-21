<?php

namespace App\Service;

use App\Model\Area\Area;
use App\Model\Area\AreaCategoryCollection;
use App\Model\Area\AreaCollection;
use App\Model\Area\AreaImageCollection;
use App\Model\Room\RoomCollection;
use App\Repository\Area\AreaRepositoryInterface;
use App\Repository\Building\BuildingRepositoryInterface;

class AreaService
{
    private BuildingRepositoryInterface $buildingRepository;
    private AreaRepositoryInterface $areaRepository;

    public function __construct(BuildingRepositoryInterface $buildingRepository, AreaRepositoryInterface $areaRepository)
    {
        $this->buildingRepository = $buildingRepository;
        $this->areaRepository = $areaRepository;
    }

    public function create(float $square, string $buildingId): void
    {
        if (!$this->buildingRepository->findById($buildingId)) {
            //exception
        }

        $roomCollection = new RoomCollection();
        $areaImageCollection = new AreaImageCollection();
        $areaCategoryCollection = new AreaCategoryCollection();
        $id = $this->areaRepository->nextIdentity();
        $area = new Area(
            $roomCollection,
            $areaImageCollection,
            $areaCategoryCollection,
            $id,
            $square,
            $buildingId
        );
        $this->areaRepository->create($area);
    }

    public function update(string $id, float $square): void
    {
        $roomCollection = new RoomCollection();
        $areaImageCollection = new AreaImageCollection();
        $areaCategoryCollection = new AreaCategoryCollection();

        /** @var Area $area */
        $area = $this->areaRepository->findById($id);

        $area = new Area(
            $roomCollection,
            $areaImageCollection,
            $areaCategoryCollection,
            $id,
            $square,
            $area->getBuildingId()
        );
        $this->areaRepository->update($area);
    }

    public function view(string $id): Area
    {
        return $this->areaRepository->findById($id);
    }

    public function delete(string $id): void
    {
        $this->areaRepository->deleteById($id);
    }

    public function list(string $buildingId): AreaCollection
    {
        return $this->areaRepository->getList($buildingId);
    }
}