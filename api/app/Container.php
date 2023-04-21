<?php

namespace App;

use App\Repository\Area\AreaRepository;
use App\Repository\Area\AreaRepositoryInterface;
use App\Repository\Building\BuildingRepository;
use App\Repository\Building\BuildingRepositoryInterface;
use App\Repository\Room\RoomRepository;
use App\Repository\Room\RoomRepositoryInterface;
use PDO;
use PDOException;
use ReflectionClass;
use ReflectionException;

class Container
{
    private array $objects = [];

    public function __construct()
    {
        $host = 'postgresql';
        $db = 'api';
        $username = 'admin';
        $password = 'admin';

        try {
            $pdo = new PDO("pgsql:host=$host;port=5432;dbname=$db;user=$username;password=$password");
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }

        // нужно добавить хранение, чтобы не создавать один объект дважды
        $this->objects = [
            PDO::class => fn() => $pdo,
            BuildingRepositoryInterface::class => fn() => $this->get(BuildingRepository::class),
            AreaRepositoryInterface::class => fn() => $this->get(AreaRepository::class),
            RoomRepositoryInterface::class => fn() => $this->get(RoomRepository::class)
        ];
    }

    public function has(string $id): bool
    {
        return isset($this->objects[$id]) || class_exists($id);
    }

    public function get(string $id)
    {
        return
            isset($this->objects[$id])
                ? $this->objects[$id]()         // "Старый подход"
                : $this->prepareObject($id); // "Новый" подход
    }

    /**
     * @throws ReflectionException
     */
    private function prepareObject(string $class): object
    {
        $classReflector = new ReflectionClass($class);

        // Получаем рефлектор конструктора класса, проверяем - есть ли конструктор
        // Если конструктора нет - сразу возвращаем экземпляр класса
        $constructReflector = $classReflector->getConstructor();
        if (empty($constructReflector)) {
            return new $class;
        }

        // Получаем рефлекторы аргументов конструктора
        // Если аргументов нет - сразу возвращаем экземпляр класса
        $constructArguments = $constructReflector->getParameters();
        if (empty($constructArguments)) {
            return new $class;
        }

        // Перебираем все аргументы конструктора, собираем их значения
        $args = [];
        foreach ($constructArguments as $argument) {
            // Получаем тип аргумента
            $argumentType = $argument->getType()->getName();
            // Получаем сам аргумент по его типу из контейнера
            //$args[$argument->getName()] = $this->get($argumentType);
            $args[] = $this->get($argumentType);
        }

        // И возвращаем экземпляр класса со всеми зависимостями
        return new $class(...$args);
    }
}