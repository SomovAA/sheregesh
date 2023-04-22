<?php

namespace App\Repository\Category;

use App\Model\Category\Category;
use App\Model\Category\CategoryCollection;
use App\Repository\AbstractRepository;
use PDO;

class CategoryRepository extends AbstractRepository implements CategoryRepositoryInterface
{
    public function create(Category $category): void
    {
        $id = $category->getId();
        $name = $category->getName();

        $this->pdo->query("INSERT INTO categories (id,name) VALUES('$id','$name')");
    }

    public function getList(): CategoryCollection
    {
        $sql = "SELECT * FROM categories";
        $results = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        $categoryCollection = new CategoryCollection();

        foreach ($results as $result) {
            $category = new Category(
                $result['id'],
                $result['name']
            );
            $categoryCollection->add($category);
        }

        return $categoryCollection;
    }

    public function update(Category $category): void
    {
        $id = $category->getId();
        $name = $category->getName();

        $this->pdo->query("UPDATE categories SET name = '$name' WHERE id = '$id'");
    }

    public function findById(string $id): Category
    {
        $result = $this->pdo->query("SELECT * FROM categories WHERE id = '$id' LIMIT 1")->fetch(PDO::FETCH_ASSOC);

        return new Category(
            $result['id'],
            $result['name']
        );
    }

    public function deleteById(string $id): void
    {
        $this->pdo->query("DELETE FROM categories WHERE id = '$id'");
    }
}