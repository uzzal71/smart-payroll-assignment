<?php

namespace App\Imports;

use App\Models\AttendanceLog;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class AttendanceImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        $count = 0;

        foreach ($rows as $key =>  $row) 
        {   
            if ($row[0] != null) { 
                if ($row[0] != "Emp No.") {

                    $exists = AttendanceLog::where([
                        'employee_id' => $row[0],
                        'attendance_date' => date('Y-m-d', strtotime($row[2])),
                    ])->first();

                    if ($exists) {
                        AttendanceLog::where('employee_id', $row[0])
                          ->where('attendance_date', date('Y-m-d', strtotime($row[2])))
                          ->update([
                            'employee_id'     => $row[0],
                            'attendance_date'    => date('Y-m-d', strtotime($row[2])), 
                            'attendance_in' => date('H:i', strtotime($row[3])),
                            'attendance_out' => date('H:i', strtotime($row[4])),
                        ]);

                    } else {
                        AttendanceLog::create([
                            'employee_id'     => $row[0],
                            'attendance_date'    => date('Y-m-d', strtotime($row[2])), 
                            'attendance_in' => date('H:i', strtotime($row[3])),
                            'attendance_out' => date('H:i', strtotime($row[4])),
                        ]);
                    }
                }
            }
        }
    }
}
