<?php

namespace App\Repository\Building;

use App\Model\Area\AreaCollection;
use App\Model\Building\Building;
use App\Model\Building\BuildingCategoryCollection;
use App\Model\Building\BuildingCollection;
use App\Model\Building\BuildingImageCollection;
use App\Model\Category\Category;
use App\Repository\AbstractRepository;
use PDO;

class BuildingRepository extends AbstractRepository implements BuildingRepositoryInterface
{
    public function findById(string $id): Building
    {
        $sql = "SELECT b.id as bid, b.square,bc.count,c.name,c.id as cid FROM buildings as b
                LEFT JOIN building_category bc on b.id = bc.building_id
                LEFT JOIN categories c on c.id = bc.category_id
                WHERE b.id = '$id'";
        $results = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        $buildingCollection = $this->getBuildingCollection($results);

        return $buildingCollection->first();
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
        $sql = "SELECT b.id as bid, b.square,bc.count,c.name,c.id as cid FROM buildings as b
                LEFT JOIN building_category bc on b.id = bc.building_id
                LEFT JOIN categories c on c.id = bc.category_id";
        $results = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        return $this->getBuildingCollection($results);
    }

    public function update(Building $building): void
    {
        $id = $building->getId();
        $square = $building->getSquare();

        $this->pdo->query("UPDATE buildings SET square = '$square' WHERE id = '$id'");
    }

    private function getBuildingCollection(array $results): BuildingCollection
    {
        $buildingCollection = new BuildingCollection();

        $data = [];
        foreach ($results as $result) {
            $categories[$result['bid']][] = [
                'id' => $result['cid'],
                'name' => $result['name'],
                'count' => $result['count'],
            ];

            $data[$result['bid']] = [
                'id' => $result['bid'],
                'square' => $result['square'],
                'categories' => $categories[$result['bid']]
            ];
        }

        foreach ($data as $result) {
            $buildingCategoryCollection = new BuildingCategoryCollection();
            foreach ($result['categories'] as $cat) {
                $category = new Category(
                    $cat['id'],
                    $cat['name'],
                    $cat['count']
                );
                $buildingCategoryCollection->add($category);
            }

            $building = new Building(
                new AreaCollection(),
                new BuildingImageCollection(),
                $buildingCategoryCollection,
                $result['id'],
                $result['square']
            );
            $buildingCollection->add($building);
        }

        return $buildingCollection;
    }
}