<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\CommissionPayment;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $commission_payments = CommissionPayment::with(['employee'])->orderBy('id', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $commission_payments = $commission_payments->where('payment_month', 'like', '%'.$sort_search.'%');
        }
        $commission_payments = $commission_payments->paginate(50);
        return view('payment_management.commission_payments.index', compact('commission_payments', 'sort_search'));
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
        return view('payment_management.commission_payments.create', compact('employee', 'sort_search'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $commission_payment = new CommissionPayment;

        $commission_payment->employee_id = $request->employee_id;
        $commission_payment->payment_month = $request->payment_month;
        $commission_payment->payment_year = $request->payment_year;
        $commission_payment->amount = $request->amount;
        $commission_payment->remarks = $request->remarks;


        $commission_payment->save();

        flash('Commission payments has been inserted successfully')->success();
        return redirect()->route('commissions.index');
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
        $advance_salary = CommissionPayment::with(['employee'])->findOrFail($id);

        return view('payment_management.commission_payments.edit', compact('advance_salary'));
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
        $commission_payment = CommissionPayment::findOrFail($id);

        $commission_payment->employee_id = $request->employee_id;
        $commission_payment->payment_month = $request->payment_month;
        $commission_payment->payment_year = $request->payment_year;
        $commission_payment->amount = $request->amount;
        $commission_payment->remarks = $request->remarks;


        $commission_payment->save();

        flash('Commission payments has been updated successfully')->success();
        return redirect()->route('commissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CommissionPayment::find($id)->delete();
        flash('Commission payments has been deleted successfully')->success();

        return redirect()->route('commissions.index');
    }
}
