<?php

namespace App\Repository\Image;

use App\Model\Image\Image;
use App\Repository\RepositoryInterface;

interface ImageRepositoryInterface extends RepositoryInterface
{
    public function save(Image $image);
}