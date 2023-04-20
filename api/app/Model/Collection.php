<?php

namespace App\Model;
class Collection
{
    protected array $data = [];
    public function toArray(): array
    {
        return $this->data;
    }
}