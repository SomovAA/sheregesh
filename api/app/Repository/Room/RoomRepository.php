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
    public function findById(string $id)
    {
        // TODO: Implement findById() method.
    }

    public function deleteById(string $id): void
    {
        // TODO: Implement deleteById() method.
    }

    public function save(Room $room)
    {
        // TODO: Implement save() method.
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
                $result['square']
            );
            $roomCollection->add($room);
        }

        return $roomCollection;
    }
}