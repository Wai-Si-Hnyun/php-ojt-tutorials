<?php

namespace App\Imports;

use App\Models\Major;
use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $majorName = $row['major'];
        $major = Major::firstorCreate(['name'=> $majorName]); 

        return new Student([
            'name' => $row['name'],
            'major_id' => $major->id,
            'phone' => $row['phone'],
            'email' => $row['email'],
            'address' => $row['address'],
        ]);
    }
}