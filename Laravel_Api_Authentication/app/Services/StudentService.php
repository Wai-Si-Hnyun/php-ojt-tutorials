<?php

namespace App\Services;

use App\Mail\MyEmail;
use Illuminate\Support\Facades\Mail;
use App\Contracts\Dao\StudentDaoInterface;
use App\Contracts\Services\StudentServiceInterface;

class StudentService implements StudentServiceInterface
{
    /**
     * student dao
     */
    private $studentDao;

    /**
     * Constructor for student service
     *
     * @param \App\Contracts\Dao\StudentDaoInterface $studentDao
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
        $student = $this->studentDao->storeStudent($data);

        $this->sendMail($student->email);
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
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportCsv()
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

    /**
     * Student search function
     *
     * @param string $searchTerm
     * @return object
     */
    public function search($searchTerm): object
    {
        return $this->studentDao->search($searchTerm);
    }

    /**
     * Mail send function
     *
     * @param string $email
     * @return void
     */
    public function sendMail(string $email): void
    {
        Mail::to($email)->send(new MyEmail());
    }
}