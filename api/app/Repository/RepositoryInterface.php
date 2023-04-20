<?php

namespace App\Repository;

interface RepositoryInterface
{
    public function nextIdentity(): string;

    public function findById(string $id);

    public function deleteById(string $id): void;
}