<?php

namespace App\Repository;

use PDO;

abstract class AbstractRepository implements RepositoryInterface
{
    protected PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    public function nextIdentity(): string
    {
        $bytes = random_bytes(16);
        $bytes[6] = chr((ord($bytes[6]) & 0b00001111) | 0b01000000);
        $bytes[8] = chr((ord($bytes[8]) & 0b00111111) | 0b10000000);

        $hex = bin2hex($bytes);

        return substr($hex, 0, 8) . '-' .
            substr($hex, 8, 4) . '-' .
            substr($hex, 12, 4) . '-' .
            substr($hex, 16, 4) . '-' .
            substr($hex, 20);
    }
}