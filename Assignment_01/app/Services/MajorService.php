<?php

namespace App\Services;

use App\Contracts\Services\MajorServiceInterface;
use App\Contracts\Dao\MajorDaoInterface;

class MajorService implements MajorServiceInterface
{
    /**
     * major dao
     */
    private $majorDao;

    /**
     * Constructor for major service
     *
     * @param \App\Contracts\Dao\MajorDaoInterface $majorDao
     */
    public function __construct(MajorDaoInterface $majorDao)
    {
        $this->majorDao = $majorDao;
    }

    /**
     * Get all majors
     *
     * @return object
     */
    public function getMajors(): object
    {
        return $this->majorDao->getMajors();
    }

    /**
     * Get major by id
     *
     * @return object
     */
    public function getMajorById(int $id): object
    {
        return $this->majorDao->getMajorById($id);
    }

    /**
     * Store major
     *
     * @param array $data
     * @return void
     */
    public function storeMajor(array $data): void
    {
        $this->majorDao->storeMajor($data);
    }

    /**
     * Update major
     *
     * @param array $data
     * @return void
     */
    public function updateMajor(array $data, int $id): void
    {
        $this->majorDao->updateMajor($data, $id);
    }

    /**
     * Delete major
     *
     * @param integer $id
     * @return void
     */
    public function deleteMajor(int $id): void
    {
        $this->majorDao->deleteMajor($id);
    }
}