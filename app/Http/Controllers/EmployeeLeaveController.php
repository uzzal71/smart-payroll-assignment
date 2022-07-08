<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeLeave;
use App\Models\EmployeeLeaveDetail;
use Illuminate\Http\Request;
use DateTime;

class EmployeeLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $employee_leaves = EmployeeLeave::with(['employee', 'leave'])->orderBy('id', 'asc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $employee_leaves = $employee_leaves->where('employee_id', 'like', '%'.$sort_search.'%');
        }
        $employee_leaves = $employee_leaves->paginate(10);
        return view('hr_management.employee_leave.index', compact('employee_leaves', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $sort_search = null;
        $employee = [];

        if ($request->has('search'))
        {
            $sort_search = $request->search;
            $employee = Employee::where('employee_punch_card', $sort_search)->first();
            
            if (empty($employee)) {
                flash('Employee not found!')->success();
            }
        }
        return view('hr_management.employee_leave.create', compact('employee', 'sort_search'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        $employee_leave->status	 = 1;

        $employee_leave->save();

        foreach ($dates as $value) {
            $employee_leave_detail = new EmployeeLeaveDetail;

            $employee_leave_detail->employee_leave_id  = $employee_leave->id;
            $employee_leave_detail->employee_id = $request->employee_id;
            $employee_leave_detail->leave_id = $request->leave_id;
            $employee_leave_detail->leave_date = $value;
            $employee_leave_detail->remarks = $request->remarks;
            $employee_leave_detail->status	 = 1;

            $employee_leave_detail->save();
        }

        flash('Employee leave has been inserted successfully')->success();
        return redirect()->route('employee_leaves.index');
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
        $employee_leave = EmployeeLeave::with(['employee'])->findOrFail($id);

        return view('hr_management.employee_leave.edit', compact('employee_leave'));
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
        $employee_leave = EmployeeLeave::findOrFail($id);
        EmployeeLeaveDetail::where('employee_leave_id', $id)->delete();

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
        $employee_leave->status	 = 1;

        $employee_leave->save();

        foreach ($dates as $value) {
            $employee_leave_detail = new EmployeeLeaveDetail;

            $employee_leave_detail->employee_leave_id  = $employee_leave->id;
            $employee_leave_detail->employee_id = $request->employee_id;
            $employee_leave_detail->leave_id = $request->leave_id;
            $employee_leave_detail->leave_date = $value;
            $employee_leave_detail->remarks = $request->remarks;
            $employee_leave_detail->status	 = 1;

            $employee_leave_detail->save();
        }

        flash('Employee leave has been updated successfully')->success();
        return redirect()->route('employee_leaves.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approval(Request $request, $id)
    {
        $employee_leave = EmployeeLeave::findOrFail($id);
        $employee_leave->status = $request->status;
        $employee_leave->save();

        EmployeeLeaveDetail::where('employee_leave_id', '=', $employee_leave->id)
            ->update([
                'status' => 1
        ]);

        flash('Approved')->success();
        return redirect()->route('employee_leaves.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        EmployeeLeaveDetail::where('employee_leave_id', $id)->delete();
        EmployeeLeave::find($id)->delete();
        flash('Employee leave has been deleted successfully')->success();

        return redirect()->route('employee_leaves.index');
    }
}
