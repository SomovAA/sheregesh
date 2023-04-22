<?php

use App\Container;

require __DIR__ . '/../vendor/autoload.php';

$container = new Container();
$pdo = $container->get(PDO::class);

$sql = "CREATE TABLE IF NOT EXISTS buildings (
        id UUID PRIMARY KEY,
        square DECIMAL(7,2) NOT NULL
    )";
$pdo->exec($sql);
print("Created buildings Table.\n");

$sql = "CREATE TABLE IF NOT EXISTS areas (
        id UUID PRIMARY KEY,
        square DECIMAL(5,2) NOT NULL,
        building_id UUID
    )";
$pdo->exec($sql);
print("Created areas Table.\n");

$sql = "ALTER TABLE areas 
    ADD CONSTRAINT fk_areas_buildings
    FOREIGN KEY (building_id) 
    REFERENCES buildings (id);";
$pdo->exec($sql);
print("Created fk_areas_buildings.\n");

$sql = "CREATE TABLE IF NOT EXISTS rooms (
        id UUID PRIMARY KEY,
        square DECIMAL(5,2) NOT NULL,
        area_id UUID
    )";
$pdo->exec($sql);
print("Created rooms Table.\n");

$sql = "ALTER TABLE rooms 
    ADD CONSTRAINT fk_rooms_areas
    FOREIGN KEY (area_id) 
    REFERENCES areas (id);";
$pdo->exec($sql);
print("Created fk_rooms_areas.\n");

$pdo->query("INSERT INTO buildings (id,square) VALUES('a0eebc99-9c0b-4ef8-bb6d-6bb9bd380a11',1000.50)");

$pdo->query("INSERT INTO areas (id,square,building_id) VALUES('a0eebc99-9c0b-4ef8-bb6d-7bb9bd380a12',300,'a0eebc99-9c0b-4ef8-bb6d-6bb9bd380a11')");
$pdo->query("INSERT INTO rooms (id,square,area_id) VALUES('a0eebc99-9c0b-4ef8-bb6d-8bb9bd380a14',200,'a0eebc99-9c0b-4ef8-bb6d-7bb9bd380a12')");
$pdo->query("INSERT INTO rooms (id,square,area_id) VALUES('a0eebc99-9c0b-4ef8-bb6d-8bb9bd380a15',100,'a0eebc99-9c0b-4ef8-bb6d-7bb9bd380a12')");

$pdo->query("INSERT INTO areas (id,square,building_id) VALUES('a0eebc99-9c0b-4ef8-bb6d-7bb9bd380a13',200,'a0eebc99-9c0b-4ef8-bb6d-6bb9bd380a11')");
$pdo->query("INSERT INTO rooms (id,square,area_id) VALUES('a0eebc99-9c0b-4ef8-bb6d-8bb9bd380a16',120,'a0eebc99-9c0b-4ef8-bb6d-7bb9bd380a13')");
$pdo->query("INSERT INTO rooms (id,square,area_id) VALUES('a0eebc99-9c0b-4ef8-bb6d-8bb9bd380a17',80,'a0eebc99-9c0b-4ef8-bb6d-7bb9bd380a13')");

$sql = "CREATE TABLE IF NOT EXISTS categories (
        id UUID PRIMARY KEY,
        name VARCHAR(255) NOT NULL
    )";
$pdo->exec($sql);
print("Created categories Table.\n");

$pdo->query("INSERT INTO categories (id,name) VALUES('a0eebc99-9c0b-4ef8-bb6d-6bb9bd480a11','Wi-Fi')");
$pdo->query("INSERT INTO categories (id,name) VALUES('a0eebc99-9c0b-4ef8-bb6d-6bb9bd480a12','Кабельное TV')");
