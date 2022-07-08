<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\OtherPayment;
use Illuminate\Http\Request;


class OtherPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $other_payments = OtherPayment::with(['employee'])->orderBy('id', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $other_payments = $other_payments->where('payment_month', 'like', '%'.$sort_search.'%');
        }
        $other_payments = $other_payments->paginate(50);
        return view('payment_management.other_payments.index', compact('other_payments', 'sort_search'));
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
        return view('payment_management.other_payments.create', compact('employee', 'sort_search'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $other_payment = new OtherPayment;

        $other_payment->employee_id = $request->employee_id;
        $other_payment->payment_month = $request->payment_month;
        $other_payment->payment_year = $request->payment_year;
        $other_payment->amount = $request->amount;
        $other_payment->status = $request->status;
        $other_payment->remarks = $request->remarks;


        $other_payment->save();

        flash('Other payments has been inserted successfully')->success();
        return redirect()->route('other_payments.index');
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
        $other_payment = OtherPayment::with(['employee'])->findOrFail($id);

        return view('payment_management.other_payments.edit', compact('other_payment'));
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
        $other_payment = OtherPayment::findOrFail($id);

        $other_payment->employee_id = $request->employee_id;
        $other_payment->payment_month = $request->payment_month;
        $other_payment->payment_year = $request->payment_year;
        $other_payment->amount = $request->amount;
        $other_payment->status = $request->status;
        $other_payment->remarks = $request->remarks;


        $other_payment->save();

        flash('Other payments has been updated successfully')->success();
        return redirect()->route('other_payments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        OtherPayment::find($id)->delete();
        flash('Other payments has been deleted successfully')->success();

        return redirect()->route('other_payments.index');
    }
}
