<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\AttendanceSummary;
use App\Models\SalarySheet;
use App\Models\AdvanceSalary;
use App\Models\EmployeeLeave;
use App\Models\EmployeeLeaveDetail;
use App\Models\Employee;
use App\Models\AttendanceLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DateTime;

class EmployeeReportController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function employee_view_attendance(Request $request)
    {
    	$month = date('m');
        $year = date('Y');
        $employee_id = Auth::user()->employee_id;

        $attendances  = Attendance::where([
                'employee_id' => $employee_id,
                'attendance_month' => $month,
                'attendance_year' => $year
            ])->orderBy('id', 'asc');

        $attendance_summary = AttendanceSummary::where([
                'employee_id' => $employee_id,
                'attendance_month' => $month,
                'attendance_year' => $year
            ])->orderBy('id', 'asc');

        if ($request->has('month')){
            $month = $request->month;
            $year = $request->year;

            $attendances  = Attendance::where([
                'employee_id' => $employee_id,
                'attendance_month' => $month,
                'attendance_year' => $year
            ])->orderBy('id', 'asc');

            $attendance_summary = AttendanceSummary::where([
                'employee_id' => $employee_id,
                'attendance_month' => $month,
                'attendance_year' => $year
            ])->orderBy('id', 'asc');
        }

        $attendances  = $attendances->get();
        $attendance_summary  = $attendance_summary->first();


        return view('employee_reports.employee_attendance', compact('attendances', 'attendance_summary', 'month', 'year'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function employee_apply_attendance(Request $request)
    {
        return view('employee_reports.employee_apply_attendance');
    } 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function employee_submit_attendance(Request $request)
    {
        $employee = Employee::find($request->employee_id);

        $employee_id = $employee->employee_punch_card;
        
        $attendance = AttendanceLog::where([
            'employee_id' => $employee_id,
            'attendance_date' => $request->attendance_date,
        ])->first();

        if (!$attendance) {
            $attendance = new AttendanceLog;
        } 

        $attendance->employee_id = $employee_id;
        $attendance->attendance_date = $request->attendance_date;
        $attendance->attendance_in = $request->attendance_in;
        $attendance->attendance_out = $request->attendance_out;
        $attendance->remarks = $request->remarks;
        $attendance->status = $request->status;

        $attendance->save();

        flash('Attendance has been Apply successfully')->success();
        return redirect()->route('employee.apply.attendance');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function employee_view_payslip(Request $request)
    {
        $month = date('m');
        $year = date('Y');
        $employee_id = Auth::user()->employee_id;

        $employee_payslips  = SalarySheet::where([
                'employee_id' => $employee_id,
                'salary_month' => $month,
                'salary_year' => $year
            ])->orderBy('id', 'asc');

        $employee = Employee::with(['department', 'designation', 'schedule'])->where('id', $employee_id)->first();

        if ($request->has('month')){
            $month = $request->month;
            $year = $request->year;

            $employee_payslips  = SalarySheet::where([
                'employee_id' => $employee_id,
                'salary_month' => $month,
                'salary_year' => $year
            ])->orderBy('id', 'asc');
        }

        $employee_payslips  = $employee_payslips->first();

        return view('employee_reports.employee_payslip', compact('employee_payslips', 'employee', 'month', 'year'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function employee_view_provident_fund(Request $request)
    {
        return view('employee_reports.employee_view_provident_fund');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function employee_view_tax(Request $request)
    {
        return view('employee_reports.employee_view_tax');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function employee_apply_advance_salary(Request $request)
    {
        $month = date('m');
        $year = date('Y');

        return view('employee_reports.employee_apply_advance_salary', compact('month', 'year'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function employee_apply_advance_salary_save(Request $request)
    {
        $advance_salary = new AdvanceSalary;

        $advance_salary->employee_id = $request->employee_id;
        $advance_salary->payment_month = $request->payment_month;
        $advance_salary->payment_year = $request->payment_year;
        $advance_salary->amount = $request->amount;
        $advance_salary->remarks = $request->remarks;
        $advance_salary->status = 0;

        $advance_salary->save();

        flash('Advance salary has been Apply successfully')->success();
        return redirect()->route('employee.view.advance_salary');
    }

    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function employee_view_advance_salary(Request $request)
    {

        $month = date('m');
        $year = date('Y');

        $employee_id = Auth::user()->employee_id;

        if ( $request->has('month') && $request->has('year') ) {
            $month = $request->month;
            $year = $request->year;

            $advance_salaries  = AdvanceSalary::Where([
                'employee_id' => $employee_id,
                'payment_month' => $month,
                'payment_year' => $year,
            ])->orderBy('id', 'asc');

        } else {
            $advance_salaries  = AdvanceSalary::Where([
                'employee_id' => $employee_id,
            ])->orderBy('id', 'asc');
        }

        $employee = Employee::with(['department', 'designation', 'schedule'])->where('id', $employee_id)->first();

        $advance_salaries  = $advance_salaries->get();

        return view('employee_reports.employee_view_advance_salary', compact('advance_salaries', 'employee', 'month', 'year'));
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function employee_apply_leave(Request $request)
    {
        $from_date = date('Y-m-d');
        $to_date = date('Y-m-d');

        return view('employee_reports.employee_apply_leave', compact('from_date', 'to_date'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function employee_apply_leave_save(Request $request)
    {
        $employee_leave = new EmployeeLeave;

        $begin = new DateTime( $request->from_date );
        $end   = new DateTime( $request->to_date );
        $year = $end->format('Y');
        $month = $end->format('m');

        $days = 0;
        $dates =array();

        for($i = $begin; $i <= $end; $i->modify('+1 day')) {
            $days += 1;
            $dates[] = $i->format('Y-m-d');
        }

        $employee_leave->employee_id = $request->employee_id;
        $employee_leave->leave_id = $request->leave_id;
        $employee_leave->from_date = $request->from_date;
        $employee_leave->to_date = $request->to_date;
        $employee_leave->leave_days = $days;
        $employee_leave->leave_month = $month;
        $employee_leave->leave_year = $year;
        $employee_leave->remarks = $request->remarks;
        $employee_leave->status  = 0;

        $employee_leave->save();

        foreach ($dates as $value) {
            $employee_leave_detail = new EmployeeLeaveDetail;

            $employee_leave_detail->employee_leave_id  = $employee_leave->id;
            $employee_leave_detail->employee_id = $request->employee_id;
            $employee_leave_detail->leave_id = $request->leave_id;
            $employee_leave_detail->leave_date = $value;
            $employee_leave_detail->remarks = $request->remarks;
            $employee_leave_detail->remarks = 0;

            $employee_leave_detail->save();
        }

        flash('Leave has been Apply successfully')->success();
        return redirect()->route('employee.view.leaves');
    }

    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function employee_view_leaves(Request $request)
    {

        $month = date('m');
        $year = date('Y');

        $employee_id = Auth::user()->employee_id;

        if ( $request->has('month') && $request->has('year') ) {
            $month = $request->month;
            $year = $request->year;

            $employee_leaves  = EmployeeLeave::Where([
                'employee_id' => $employee_id,
                'leave_month' => $month,
                'leave_year' => $year,
            ])->orderBy('id', 'asc');

        } else {
            $employee_leaves  = EmployeeLeave::Where([
                'employee_id' => $employee_id,
            ])->orderBy('id', 'asc');
        }

        $employee_leaves  = $employee_leaves->paginate(100);

        return view('employee_reports.employee_view_leaves', compact('employee_leaves', 'month', 'year'));
    }
}
