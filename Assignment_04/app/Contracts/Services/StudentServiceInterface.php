<?php

namespace App\Contracts\Services;

interface StudentServiceInterface
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
     * @param integer $id
     * @return object
     */
    public function getStudentById(int $id): object;

    /**
     * Create Student
     *
     * @param array $data
     * @return void
     */
    public function storeStudent(array $data): void;

    /**
     * Update Student
     *
     * @param array $data
     * @return void
     */
    public function updateStudent(array $data, int $id): void;

    /**
     * Delete Student
     *
     * @param integer $id
     * @return void
     */
    public function deleteStudent(int $id): void;
}