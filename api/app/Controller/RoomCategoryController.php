<?php

namespace App\Controller;

use App\Service\RoomCategoryService;

class RoomCategoryController extends AbstractController
{

    private RoomCategoryService $roomCategoryService;

    public function __construct(RoomCategoryService $roomCategoryService)
    {
        $this->roomCategoryService = $roomCategoryService;
    }

    public function join(array $categories, string $roomId): void
    {
        $this->roomCategoryService->join($categories, $roomId);

        $this->displayJson();
    }
}