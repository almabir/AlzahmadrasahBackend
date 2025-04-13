<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;

class StudentReportExport implements FromCollection
{
    public function collection()
    {
        return Student::with('class', 'parentDetail', 'localGuardian')
            ->select('name', 'email', 'mobile', 'dob', 'address', 'city', 'state', 'zip_code')
            ->get();
    }
}
