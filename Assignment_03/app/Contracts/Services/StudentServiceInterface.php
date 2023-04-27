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

    /**
     * Ecport CSV file for students
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportCsv();

    /**
     * Import data from CSV file to database
     *
     * @param string|array $file
     * @return void
     */
    public function importCsv($file): void;

    /**
     * Student search function
     *
     * @param string $searchTerm
     * @return object
     */
    public function search($searchTerm):  object;
}