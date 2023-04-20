<?php

namespace App\Contracts\Dao;

interface StudentDaoInterface
{
    /**
     * Get all students
     *
     * @return object
     */
    public function getStudents(): object;

    /**
     * Get student by id
     *
     * @return object
     */
    public function getStudentById(int $id): object;

    /**
     * Store student
     *
     * @param array $data
     * @return void
     */
    public function storeStudent(array $data): void;

    /**
     * Update student
     *
     * @param array $data
     * @return void
     */
    public function updateStudent(array $data, int $id): void;

    /**
     * Delete student
     *
     * @param integer $id
     * @return void
     */
    public function deleteStudent(int $id): void;
}