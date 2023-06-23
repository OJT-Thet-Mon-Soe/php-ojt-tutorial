<?php

namespace App\Services;

use App\Contracts\Dao\MajorDaoInterface;
use App\Contracts\Services\MajorServiceInterface;

class MajorService implements MajorServiceInterface
{
    private $majorDao;
    public function __construct(MajorDaoInterface $majorDaoInterface)
    {
        $this->majorDao = $majorDaoInterface;
    }

    public function getMajor(): object
    {
        return $this->majorDao->getMajor();
    }

    public function storeMajor($request): void
    {
        $this->majorDao->storeMajor($request);
    }

    public function destoryMajor($id): void
    {
        $this->majorDao->destoryMajor($id);
    }

    public function editMajor($id): object
    {
        return $this->majorDao->editMajor($id);
    }

    public function updateMajor($data, $id): void
    {
        $this->majorDao->updateMajor($data, $id);
    }
}
