<?php

namespace App\Repository;

interface RepositoryInterface
{
    public function findById(string $id);

    public function deleteById(string $id);
}