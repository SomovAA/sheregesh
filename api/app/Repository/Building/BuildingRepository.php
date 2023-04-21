<?php

namespace App\Repository\Building;

use App\Model\Area\AreaCollection;
use App\Model\Building\Building;
use App\Model\Building\BuildingCategoryCollection;
use App\Model\Building\BuildingCollection;
use App\Model\Building\BuildingImageCollection;
use App\Repository\AbstractRepository;
use PDO;

class BuildingRepository extends AbstractRepository implements BuildingRepositoryInterface
{
    public function findById(string $id): Building
    {
        $result = $this->pdo->query("SELECT * FROM buildings WHERE id = '$id' LIMIT 1")->fetch(PDO::FETCH_ASSOC);

        $areaCollection = new AreaCollection();
        $buildingImageCollection = new BuildingImageCollection();
        $buildingCategoryCollection = new BuildingCategoryCollection();

        return new Building(
            $areaCollection,
            $buildingImageCollection,
            $buildingCategoryCollection,
            $result['id'],
            $result['square']
        );
    }

    public function deleteById(string $id): void
    {
        $this->pdo->query("DELETE FROM buildings WHERE id = '$id'");
    }

    public function create(Building $building): void
    {
        $id = $building->getId();
        $square = $building->getSquare();

        $this->pdo->query("INSERT INTO buildings (id,square) VALUES('$id',$square)");
    }

    public function getList(): BuildingCollection
    {
        $sql = "SELECT * FROM buildings";
        $results = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        $buildingCollection = new BuildingCollection();

        foreach ($results as $result) {
            $building = new Building(
                new AreaCollection(),
                new BuildingImageCollection(),
                new BuildingCategoryCollection(),
                $result['id'],
                $result['square']
            );
            $buildingCollection->add($building);
        }

        return $buildingCollection;
    }

    public function update(Building $building): void
    {
        $id = $building->getId();
        $square = $building->getSquare();

        $this->pdo->query("UPDATE buildings SET square = '$square' WHERE id = '$id'");
    }
}