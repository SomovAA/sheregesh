<?php

namespace App\Repository\Area;

use App\Model\Area\Area;
use App\Model\Area\AreaCategoryCollection;
use App\Model\Area\AreaCollection;
use App\Model\Area\AreaImageCollection;
use App\Model\Category\Category;
use App\Model\Room\RoomCollection;
use App\Repository\AbstractRepository;
use PDO;

class AreaRepository extends AbstractRepository implements AreaRepositoryInterface
{
    public function findById(string $id): Area
    {
        $sql = "SELECT a.id as aid, a.square, a.building_id, ac.count,c.name,c.id as cid FROM areas as a
                LEFT JOIN area_category ac on a.id = ac.area_id
                LEFT JOIN categories c on c.id = ac.category_id
                WHERE a.id = '$id'";

        $results = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        $areaCollection = $this->getAreaCollection($results);

        return $areaCollection->first();
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
        $sql = "SELECT a.id as aid, a.square, a.building_id,ac.count,c.name,c.id as cid FROM areas as a
                LEFT JOIN area_category ac on a.id = ac.area_id
                LEFT JOIN categories c on c.id = ac.category_id
                WHERE a.building_id = '$buildingId'";
        $results = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        return $this->getAreaCollection($results);
    }

    public function update(Area $area): void
    {
        $id = $area->getId();
        $square = $area->getSquare();

        $this->pdo->query("UPDATE areas SET square = '$square' WHERE id = '$id'");
    }

    private function getAreaCollection(array $results): AreaCollection
    {
        $data = [];
        $categories = [];
        foreach ($results as $result) {
            $data[$result['aid']] = [
                'id' => $result['aid'],
                'square' => $result['square'],
                'building_id' => $result['building_id'],
            ];

            if (isset($result['cid'])) {
                $categories[$result['aid']][] = [
                    'id' => $result['cid'],
                    'name' => $result['name'],
                    'count' => $result['count'],
                ];

                $data[$result['aid']]['categories'] = $categories[$result['aid']];
            }
        }

        $areaCollection = new AreaCollection();

        foreach ($data as $result) {
            $areaCategoryCollection = new AreaCategoryCollection();
            if (isset($result['categories'])) {
                foreach ($result['categories'] as $cat) {
                    $category = new Category(
                        $cat['id'],
                        $cat['name'],
                        $cat['count']
                    );
                    $areaCategoryCollection->add($category);
                }
            }

            $area = new Area(
                new RoomCollection(),
                new AreaImageCollection(),
                $areaCategoryCollection,
                $result['id'],
                $result['square'],
                $result['building_id'],
            );
            $areaCollection->add($area);
        }

        return $areaCollection;
    }
}