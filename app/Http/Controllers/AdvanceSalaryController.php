<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\AdvanceSalary;
use Illuminate\Http\Request;

class AdvanceSalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $advance_salaries = AdvanceSalary::with(['employee'])->orderBy('id', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $advance_salaries = $advance_salaries->where('payment_month', 'like', '%'.$sort_search.'%');
        }
        $advance_salaries = $advance_salaries->paginate(50);
        return view('payment_management.advance_salaries.index', compact('advance_salaries', 'sort_search'));
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
        return view('payment_management.advance_salaries.create', compact('employee', 'sort_search'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $advance_salary = new AdvanceSalary;

        $advance_salary->employee_id = $request->employee_id;
        $advance_salary->payment_month = $request->payment_month;
        $advance_salary->payment_year = $request->payment_year;
        $advance_salary->amount = $request->amount;
        $advance_salary->remarks = $request->remarks;

        $advance_salary->save();

        flash('Advance salary has been inserted successfully')->success();
        return redirect()->route('advance_salaries.index');
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
        $advance_salary = AdvanceSalary::with(['employee'])->findOrFail($id);

        return view('payment_management.advance_salaries.edit', compact('advance_salary'));
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
        $advance_salary = AdvanceSalary::findOrFail($id);

        $advance_salary->employee_id = $request->employee_id;
        $advance_salary->payment_month = $request->payment_month;
        $advance_salary->payment_year = $request->payment_year;
        $advance_salary->amount = $request->amount;
        $advance_salary->remarks = $request->remarks;
        $advance_salary->status = 1;


        $advance_salary->save();

        flash('Advance salary has been updated successfully')->success();
        return redirect()->route('advance_salaries.index');
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
        $advance_salary = AdvanceSalary::findOrFail($id);

        $advance_salary->status = $request->status;

        $advance_salary->save();

        flash('Advance salary has been approve successfully')->success();
        return redirect()->route('advance_salaries.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AdvanceSalary::find($id)->delete();
        flash('Advance salary has been deleted successfully')->success();

        return redirect()->route('advance_salaries.index');
    }
}
