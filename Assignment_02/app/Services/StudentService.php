<?php

namespace App\Services;

use App\Contracts\Services\StudentServiceInterface;
use App\Contracts\Dao\StudentDaoInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class StudentService implements StudentServiceInterface
{
    /**
     * student dao
     */
    private $studentDao;

    /**
     * Constructor for student service
     *
     * @param StudentDaoInterface $studentDao
     */
    public function __construct(StudentDaoInterface $studentDao)
    {
        $this->studentDao = $studentDao;
    }

    /**
     * Get all Students
     *
     * @return object
     */
    public function getStudents(): object
    {
        return $this->studentDao->getStudents();
    }

    /**
     * Get Student by id
     *
     * @return object
     */
    public function getStudentById(int $id): object
    {
        return $this->studentDao->getStudentById($id);
    }

    /**
     * Store Student
     *
     * @param array $data
     * @return void
     */
    public function storeStudent(array $data): void
    {
        $this->studentDao->storeStudent($data);
    }

    /**
     * Update Student
     *
     * @param array $data
     * @return void
     */
    public function updateStudent(array $data, int $id): void
    {
        $this->studentDao->updateStudent($data, $id);
    }

    /**
     * Delete Student
     *
     * @param integer $id
     * @return void
     */
    public function deleteStudent(int $id): void
    {
        $this->studentDao->deleteStudent($id);
    }

    /**
     * Export students to csv
     *
     * @return BinaryFileResponse
     */
    public function exportCsv(): BinaryFileResponse
    {
        return $this->studentDao->exportCsv();
    }

    /**
     * Import data from csv file to database
     *
     * @param string|array $file
     * @return void
     */
    public function importCsv($file): void
    {
        $this->studentDao->importCsv($file);
    }
}