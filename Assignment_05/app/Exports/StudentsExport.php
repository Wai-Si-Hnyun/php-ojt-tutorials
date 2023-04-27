<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $students = Student::with('major')->get();

        return $students->map(function($student) {
            return [
                'id' => $student->id,
                'name' => $student->name,
                'major' => $student->major->name,
                'phone' => $student->phone,
                'email' => $student->email,
                'address' => $student->address,
            ];
        });
    }

    /**
     * Headings for CSV file
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Major',
            'Phone',
            'Email',
            'Address',
        ];
    }
}
