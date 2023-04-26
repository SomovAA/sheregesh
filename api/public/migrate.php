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

$sql = "CREATE TABLE IF NOT EXISTS building_category (
        id UUID PRIMARY KEY,
        count INTEGER NOT NULL,
        building_id UUID,
        category_id UUID
    )";
$pdo->exec($sql);
print("Created building_category Table.\n");

$sql = "ALTER TABLE building_category 
    ADD CONSTRAINT fk_building_category_buildings
    FOREIGN KEY (building_id) 
    REFERENCES buildings (id);";
$pdo->exec($sql);
print("Created fk_building_category_buildings.\n");

$sql = "ALTER TABLE building_category 
    ADD CONSTRAINT fk_building_category_categories
    FOREIGN KEY (category_id) 
    REFERENCES categories (id);";
$pdo->exec($sql);
print("Created fk_building_category_categories.\n");

$pdo->query("INSERT INTO building_category (id,count,building_id,category_id) VALUES('a0eebc99-9c0b-4ef8-bb6d-7bb9bd480a11',1,'a0eebc99-9c0b-4ef8-bb6d-6bb9bd380a11','a0eebc99-9c0b-4ef8-bb6d-6bb9bd480a11')");
$pdo->query("INSERT INTO building_category (id,count,building_id,category_id) VALUES('a0eebc99-9c0b-4ef8-bb6d-7bb9bd480a12',2,'a0eebc99-9c0b-4ef8-bb6d-6bb9bd380a11','a0eebc99-9c0b-4ef8-bb6d-6bb9bd480a12')");

$sql = "CREATE TABLE IF NOT EXISTS area_category (
        id UUID PRIMARY KEY,
        count INTEGER NOT NULL,
        area_id UUID,
        category_id UUID
    )";
$pdo->exec($sql);
print("Created area_category Table.\n");

$sql = "ALTER TABLE area_category 
    ADD CONSTRAINT fk_area_category_areas
    FOREIGN KEY (area_id) 
    REFERENCES areas (id);";
$pdo->exec($sql);
print("Created fk_area_category_areas.\n");

$sql = "ALTER TABLE area_category 
    ADD CONSTRAINT fk_area_category_categories
    FOREIGN KEY (category_id) 
    REFERENCES categories (id);";
$pdo->exec($sql);
print("Created fk_area_category_categories.\n");

$pdo->query("INSERT INTO area_category (id,count,area_id,category_id) VALUES('a0eebc99-9c0b-4ef8-bb6d-7bb9bd480a13',1,'a0eebc99-9c0b-4ef8-bb6d-7bb9bd380a13','a0eebc99-9c0b-4ef8-bb6d-6bb9bd480a11')");
$pdo->query("INSERT INTO area_category (id,count,area_id,category_id) VALUES('a0eebc99-9c0b-4ef8-bb6d-7bb9bd480a14',2,'a0eebc99-9c0b-4ef8-bb6d-7bb9bd380a13','a0eebc99-9c0b-4ef8-bb6d-6bb9bd480a12')");
$pdo->query("INSERT INTO area_category (id,count,area_id,category_id) VALUES('a0eebc99-9c0b-4ef8-bb6d-7bb9bd480a15',1,'a0eebc99-9c0b-4ef8-bb6d-7bb9bd380a12','a0eebc99-9c0b-4ef8-bb6d-6bb9bd480a11')");
$pdo->query("INSERT INTO area_category (id,count,area_id,category_id) VALUES('a0eebc99-9c0b-4ef8-bb6d-7bb9bd480a16',2,'a0eebc99-9c0b-4ef8-bb6d-7bb9bd380a12','a0eebc99-9c0b-4ef8-bb6d-6bb9bd480a12')");

$sql = "CREATE TABLE IF NOT EXISTS room_category (
        id UUID PRIMARY KEY,
        count INTEGER NOT NULL,
        room_id UUID,
        category_id UUID
    )";
$pdo->exec($sql);
print("Created room_category Table.\n");

$sql = "ALTER TABLE room_category 
    ADD CONSTRAINT fk_room_category_rooms
    FOREIGN KEY (room_id) 
    REFERENCES rooms (id);";
$pdo->exec($sql);
print("Created fk_room_category_rooms.\n");

$sql = "ALTER TABLE room_category 
    ADD CONSTRAINT fk_room_category_categories
    FOREIGN KEY (category_id) 
    REFERENCES categories (id);";
$pdo->exec($sql);
print("Created fk_room_category_categories.\n");

$pdo->query("INSERT INTO room_category (id,count,room_id,category_id) VALUES('a0eebc99-9c0b-4ef8-bb6d-7bb9bd480a17',1,'a0eebc99-9c0b-4ef8-bb6d-8bb9bd380a15','a0eebc99-9c0b-4ef8-bb6d-6bb9bd480a11')");
$pdo->query("INSERT INTO room_category (id,count,room_id,category_id) VALUES('a0eebc99-9c0b-4ef8-bb6d-7bb9bd480a18',2,'a0eebc99-9c0b-4ef8-bb6d-8bb9bd380a15','a0eebc99-9c0b-4ef8-bb6d-6bb9bd480a12')");