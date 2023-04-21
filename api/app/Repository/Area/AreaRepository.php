<?php

namespace App\Repository\Area;

use App\Model\Area\Area;
use App\Model\Area\AreaCategoryCollection;
use App\Model\Area\AreaCollection;
use App\Model\Area\AreaImageCollection;
use App\Model\Room\RoomCollection;
use App\Repository\AbstractRepository;
use PDO;

class AreaRepository extends AbstractRepository implements AreaRepositoryInterface
{
    public function findById(string $id): Area
    {
        $result = $this->pdo->query("SELECT * FROM areas WHERE id = '$id' LIMIT 1")->fetch(PDO::FETCH_ASSOC);

        $roomCollection = new RoomCollection();
        $areaImageCollection = new AreaImageCollection();
        $areaCategoryCollection = new AreaCategoryCollection();

        return new Area(
            $roomCollection,
            $areaImageCollection,
            $areaCategoryCollection,
            $result['id'],
            $result['square'],
            $result['building_id']
        );
    }
    public function deleteById(string $id): void
    {
        $this->pdo->query("DELETE FROM areas WHERE id = '$id'");
    }

    public function create(Area $area): void
    {
        $id = $area->getId();
        $square = $area->getSquare();
        $buildingId = $area->getBuildingId();

        $this->pdo->query("INSERT INTO areas (id,square,building_id) VALUES('$id',$square,'$buildingId')");
    }

    public function getList(string $buildingId): AreaCollection
    {
        $sql = "SELECT * FROM areas WHERE building_id = '$buildingId'";
        $results = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        $areaCollection = new AreaCollection();

        foreach ($results as $result) {
            $area = new Area(
                new RoomCollection(),
                new AreaImageCollection(),
                new AreaCategoryCollection(),
                $result['id'],
                $result['square'],
                $result['building_id'],
            );
            $areaCollection->add($area);
        }

        return $areaCollection;
    }

    public function update(Area $area): void
    {
        $id = $area->getId();
        $square = $area->getSquare();

        $this->pdo->query("UPDATE areas SET square = '$square' WHERE id = '$id'");
    }
}