<?php

namespace App\Dao;

use App\Models\Student;
use App\Contracts\Dao\StudentDaoInterface;

class StudentDao implements StudentDaoInterface
{
    /**
     * Get all Students
     *
     * @return object
     */
    public function getStudents(): object
    {
        return Student::with('major')->orderBy('id', 'desc')->paginate(5);
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
     * @return object
     */
    public function storeStudent(array $data): object
    {
        $student = Student::create($data);

        return $student;
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
        $student = Student::find($id);
        $student->update($data);
    }

    /**
     * Delete Student in DB
     *
     * @param integer $id
     * @return void
     */
    public function deleteStudent(int $id): void
    {
        $student = Student::find($id);
        $student->delete();
    }
}