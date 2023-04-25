<?php

namespace App\Contracts\Dao;

interface MajorDaoInterface
{
    /**
     * Get all majors
     *
     * @return object
     */
    public function getMajors(): object;

    /**
     * Get major by id
     *
     * @return object
     */
    public function getMajorById(int $id): object;

    /**
     * Store major
     *
     * @param array $data
     * @return void
     */
    public function storeMajor(array $data): void;

    /**
     * Update major
     *
     * @param array $data
     * @return void
     */
    public function updateMajor(array $data, int $id): void;

    /**
     * Delete major
     *
     * @param integer $id
     * @return void
     */
    public function deleteMajor(int $id): void;
}