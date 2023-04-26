<?php

namespace App\Repository\Room;

use App\Model\Category\Category;
use App\Model\Room\Room;
use App\Model\Room\RoomCategoryCollection;
use App\Model\Room\RoomCollection;
use App\Model\Room\RoomImageCollection;
use App\Repository\AbstractRepository;
use PDO;

class RoomRepository extends AbstractRepository implements RoomRepositoryInterface
{
    public function findById(string $id): Room
    {
        $sql = "SELECT r.id as rid, r.square, r.area_id, rc.count,c.name,c.id as cid FROM rooms as r
                LEFT JOIN room_category rc on r.id = rc.room_id
                LEFT JOIN categories c on c.id = rc.category_id
                WHERE r.id = '$id'";

        $results = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        $roomCollection = $this->getRoomCollection($results);

        return $roomCollection->first();
    }

    public function deleteById(string $id): void
    {
        $this->pdo->query("DELETE FROM rooms WHERE id = '$id'");
    }

    public function create(Room $room): void
    {
        $id = $room->getId();
        $square = $room->getSquare();
        $areaId = $room->getAreaId();

        $this->pdo->query("INSERT INTO rooms (id,square,area_id) VALUES('$id',$square,'$areaId')");
    }

    public function getListByAreaId(string $areaId): RoomCollection
    {
        $sql = "SELECT r.id as rid, r.square, r.area_id, rc.count,c.name,c.id as cid FROM rooms as r
                LEFT JOIN room_category rc on r.id = rc.room_id
                LEFT JOIN categories c on c.id = rc.category_id
                WHERE r.area_id = '$areaId'";
        $results = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        return $this->getRoomCollection($results);
    }

    public function update(Room $room): void
    {
        $id = $room->getId();
        $square = $room->getSquare();

        $this->pdo->query("UPDATE rooms SET square = '$square' WHERE id = '$id'");
    }

    private function getRoomCollection(array $results): RoomCollection
    {
        $data = [];
        $categories = [];
        foreach ($results as $result) {
            $data[$result['rid']] = [
                'id' => $result['rid'],
                'square' => $result['square'],
                'area_id' => $result['area_id'],
            ];

            if (isset($result['cid'])) {
                $categories[$result['rid']][] = [
                    'id' => $result['cid'],
                    'name' => $result['name'],
                    'count' => $result['count'],
                ];

                $data[$result['rid']]['categories'] = $categories[$result['rid']];
            }
        }

        $roomCollection = new RoomCollection();

        foreach ($data as $result) {
            $roomCategoryCollection = new RoomCategoryCollection();
            if (isset($result['categories'])) {
                foreach ($result['categories'] as $cat) {
                    $category = new Category(
                        $cat['id'],
                        $cat['name'],
                        $cat['count']
                    );
                    $roomCategoryCollection->add($category);
                }
            }

            $room = new Room(
                new RoomImageCollection(),
                $roomCategoryCollection,
                $result['id'],
                $result['square'],
                $result['area_id'],
            );
            $roomCollection->add($room);
        }

        return $roomCollection;
    }
}