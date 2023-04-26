<?php

namespace App\Service;

use App\Model\AreaCategory\AreaCategory;
use App\Repository\AreaCategory\AreaCategoryRepositoryInterface;

class AreaCategoryService
{
    private AreaCategoryRepositoryInterface $areaCategoryRepository;

    public function __construct(AreaCategoryRepositoryInterface $areaCategoryRepository)
    {
        $this->areaCategoryRepository = $areaCategoryRepository;
    }

    public function join(array $categories, string $areaId): void
    {
        $this->areaCategoryRepository->deleteAllByAreaId($areaId);

        foreach ($categories as $data) {
            $id = $this->areaCategoryRepository->nextIdentity();

            $buildingCategory = new AreaCategory(
                $id,
                $data['count'],
                $areaId,
                $data['id']
            );

            $this->areaCategoryRepository->create($buildingCategory);
        }
    }
}