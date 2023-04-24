<?php

namespace App\Contracts\Dao;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

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

    /**
     * Export students to csv
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportCsv(): BinaryFileResponse;

    /**
     * Import csv data to database
     *
     * @param string|array $file
     * @return void
     */
    public function importCsv($file): void;

    /**
     * Studnet search function
     *
     * @param string $searchTerm
     * @return object
     */
    public function search($searchTerm): object;
}