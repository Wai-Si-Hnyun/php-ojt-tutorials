<?php

namespace App\Dao;

use App\Models\Major;
use App\Contracts\Dao\MajorDaoInterface;

class MajorDao implements MajorDaoInterface
{
    /**
     * Get all majors
     *
     * @return object
     */
    public function getMajors(): object
    {
        return Major::paginate(6);
    }

    /**
     * Get major by id
     *
     * @param integer $id
     * @return object
     */
    public function getMajorById(int $id): object
    {
        return Major::find($id);
    }

    /**
     * Store major in DB
     *
     * @param array $data
     * @return void
     */
    public function storeMajor(array $data): void
    {
        Major::create($data);
    }

    /**
     * Update major data in DB
     *
     * @param array $data
     * @param integer $id
     * @return void
     */
    public function updateMajor(array $data, int $id): void
    {
        $major = Major::find($id);
        $major->update($data);
    }

    /**
     * Delete major in DB
     *
     * @param integer $id
     * @return void
     */
    public function deleteMajor(int $id): void
    {
        $major = Major::find($id);
        $major->delete();
    }
}