<?php

namespace App\Dao;

use App\Models\Student;
use App\Exports\StudentsExport;
use App\Imports\StudentsImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
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

    /**
     * Export stadents data to CSV file
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportCsv()
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

    /**
     * Student search
     *
     * @param string $searchTerm
     * @return object
     */
    public function search($searchTerm): object
    {
        $searchTerm = preg_replace("/[^a-zA-Z0-9\s]/", "", $searchTerm);
        $searchTerm = str_replace(" ", "%", $searchTerm);

        $students = DB::table('students')
                        ->join('majors', 'students.major_id', '=', 'majors.id')
                        ->select('students.*', 'majors.name as major_name')
                        ->where('students.name', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('majors.name', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('students.email', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('students.phone', 'LIKE', '%' . $searchTerm . '%')
                        ->orWhere('students.address', 'LIKE', '%' . $searchTerm . '%')
                        ->orderBy('students.id', 'desc')
                        ->paginate(5);
        
        return $students;
        
    }
}