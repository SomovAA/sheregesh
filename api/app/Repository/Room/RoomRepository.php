<?php

namespace App\Repository\Room;

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
        $result = $this->pdo->query("SELECT * FROM rooms WHERE id = '$id' LIMIT 1")->fetch(PDO::FETCH_ASSOC);

        $roomImageCollection = new RoomImageCollection();
        $roomCategoryCollection = new RoomCategoryCollection();

        return new Room(
            $roomImageCollection,
            $roomCategoryCollection,
            $result['id'],
            $result['square'],
            $result['area_id']
        );
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
        $sql = "SELECT * FROM rooms WHERE area_id = '$areaId'";
        $results = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        $roomCollection = new RoomCollection();

        foreach ($results as $result) {
            $room = new Room(
                new RoomImageCollection(),
                new RoomCategoryCollection(),
                $result['id'],
                $result['square'],
                $result['area_id'],
            );
            $roomCollection->add($room);
        }

        return $roomCollection;
    }

    public function update(Room $room): void
    {
        $id = $room->getId();
        $square = $room->getSquare();

        $this->pdo->query("UPDATE rooms SET square = '$square' WHERE id = '$id'");
    }
}