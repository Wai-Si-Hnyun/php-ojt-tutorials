<?php

namespace App\Dao;

use App\Exports\StudentsExport;
use App\Models\Student;
use App\Imports\StudentsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Contracts\Dao\StudentDaoInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class StudentDao implements StudentDaoInterface
{
    /**
     * Get all Students
     *
     * @return object
     */
    public function getStudents(): object
    {
        return Student::with('major')->paginate(5);
    }

    /**
     * Get Student by Id
     *
     * @param integer $id
     * @return object
     */
    public function getStudentById(int $id): object
    {
        return Student::where('id', $id)->with('major')->first();
    }

    /**
     * Store Student in DB 
     *
     * @param array $data
     * @return void
     */
    public function storeStudent(array $data): void
    {
        Student::create($data);
    }

    /**
     * Update Student data in DB
     *
     * @param array $data
     * @param integer $id
     * @return void
     */
    public function updateStudent(array $data, int $id): void
    {
        $Student = Student::find($id);
        $Student->update($data);
    }

    /**
     * Delete Student in DB
     *
     * @param integer $id
     * @return void
     */
    public function deleteStudent(int $id): void
    {
        $Student = Student::find($id);
        $Student->delete();
    }

    /**
     * Export stadents data to CSV file
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportCsv(): BinaryFileResponse
    {
        return Excel::download(new StudentsExport, 'students.csv');
    }

    /**
     * Import students data from CSV file to database
     *
     * @param string|array $file
     * @return void
     */
    public function importCsv($file): void
    {
        Excel::import(new StudentsImport(), $file);
    }
}