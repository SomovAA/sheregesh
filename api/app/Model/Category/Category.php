<?php

namespace App\Model\Category;

class Category
{

    private string $id;
    private string $name;
    private int $count;

    public function __construct(string $id, string $name, int $count)
    {
        $this->id = $id;
        $this->name = $name;
        $this->count = $count;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCount(): int
    {
        return $this->count;
    }
}