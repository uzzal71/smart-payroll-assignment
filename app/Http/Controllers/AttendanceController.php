<?php

namespace App\Http\Controllers;

use App\Models\AttendanceLog;
use App\Models\Employee;
use App\Models\EmployeeLeaveDetail;
use App\Models\Leave;
use App\Models\OfficeHolidayDetail;
use App\Models\Upload;
use Illuminate\Http\Request;
use Excel;
use App\Imports\AttendanceImport;
use DateTime;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->has('punch_card')){
            $punch_card = $request->punch_card;
            $from_date = $request->from_date;
            $to_date = $request->to_date;

            $begin = new DateTime( $from_date );
            $end   = new DateTime( $to_date );
            $attendances = [];

            $emp_info = Employee::where([
                    'employee_punch_card' => $punch_card
                ])->first();

            if (!empty($emp_info)) {

                for($i = $begin; $i <= $end; $i->modify('+1 day')){

                    $att_info = AttendanceLog::where([
                        'employee_id' => $punch_card,
                        'attendance_date' => $i->format("Y-m-d")
                    ])->first();

                    $leave_info = EmployeeLeaveDetail::where([
                        'employee_id' => $emp_info->id,
                        'leave_date' => $i->format("Y-m-d")
                    ])->first();

                    $holiday_info = OfficeHolidayDetail::where([
                        'holiday_date' => $i->format("Y-m-d")
                    ])->first();

                    $day_name = $i->format('l');

                    $status = '';
                    $remarks = '';

                    if ($day_name == 'Friday') {
                        $status = 'W';
                        $remarks = 'Weekend';
                    } elseif ($leave_info) {

                        $leave = Leave::where([
                            'id' => $leave_info->leave_id
                        ])->first();

                        $status = $leave->short_name;
                        $remarks = $leave->leave_name;

                    } elseif ($holiday_info) {
                        $status = 'H';
                        $remarks = $holiday_info->remarks;
                    }

                    if ($att_info) {
                        $object = [
                            "punch_card" => $punch_card,
                            "attendance_date" => $i->format("Y-m-d"),
                            "attendance_in" => $att_info->attendance_in,
                            "attendance_out" => $att_info->attendance_out,
                            "status" => $status,
                            "remarks" => $remarks,
                        ];
                    } else {
                        $object = [
                            "punch_card" => $punch_card,
                            "attendance_date" => $i->format("Y-m-d"),
                            "attendance_in" => '00:00',
                            "attendance_out" => '00:00',
                            "status" => $status,
                            "remarks" => $remarks,
                        ];
                    }

                    $attendances[] = $object;
                }
            } else {
                flash('Employee not found!')->success();
            }

            return view('payroll.manual_entry', compact(
                'attendances', 'punch_card', 'from_date', 'to_date', 'emp_info'));
        }

        return view('payroll.manual_entry');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $array_length = count($data["attendance_date"]);

        for($i=0; $i < $array_length; $i++){

            $att_info = AttendanceLog::where([
                'employee_id' => $data['employee_id'][$i],
                'attendance_date' => $data['attendance_date'][$i]
            ])->first();


            if ($att_info) {
                $log_info = AttendanceLog::where([
                    'employee_id' => $data['employee_id'][$i],
                    'attendance_date' => $data['attendance_date'][$i]
                ])->first();

                if (($log_info->attendance_in != $data['attendance_in'][$i]) || ($log_info->attendance_out != $data['attendance_out'][$i])) {
                    $log_info->status = 'N';
                }

                $log_info->employee_id = $data['employee_id'][$i];
                $log_info->attendance_date = $data['attendance_date'][$i];
                $log_info->attendance_in = $data['attendance_in'][$i];
                $log_info->attendance_out = $data['attendance_out'][$i];

                $log_info->save();

            } else {

                $attendance = new AttendanceLog;

                $attendance->employee_id = $data['employee_id'][$i];
                $attendance->attendance_date = $data['attendance_date'][$i];
                $attendance->attendance_in = $data['attendance_in'][$i];
                $attendance->attendance_out = $data['attendance_out'][$i];
                $attendance->status = 'N';

                $attendance->save();

            }

       }

       flash('Attendance log has been updated successfully')->success();
       return redirect()->route('attendances.create');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approval_attendance(Request $request)
    {
        $sort_search = null;
        $attendances = AttendanceLog::join('employees', 'employees.employee_punch_card', '=', 'attendance_logs.employee_id')->where('attendance_logs.status', 'N')->orderBy('employee_id', 'asc')->get();

        if ($request->has('search')){
            $sort_search = $request->search;
            $attendances = $attendances->where('employee_id', $sort_search);
        }

        return view('payroll.approval_attendance', compact('attendances', 'sort_search'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approval_attendance_save(Request $request)
    {
        $data = $request->all();
        $array_length = count($data["attendance_date"]);

        for($i=0; $i < $array_length; $i++){

            $attendance = explode(":", $data['attendance_date'][$i]);

            $attendance_date = $attendance[0];
            $employee_id = $attendance[1];

            $att_info = AttendanceLog::where([
                'employee_id'       => $employee_id,
                'attendance_date'   => $attendance_date,
            ])->first();

            if ($att_info) {
                $att_info->status = 'Y';
                $att_info->save();
            }
       }

        return response()->json(
            ['status' => true, "redirect_url" => route('approval.attendance')]
        );
    }
}
