<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\TransportPayment;
use Illuminate\Http\Request;


class TransportBillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $transport_payments = TransportPayment::with(['employee'])->orderBy('id', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $transport_payments = $transport_payments->where('payment_month', 'like', '%'.$sort_search.'%');
        }
        $transport_payments = $transport_payments->paginate(50);
        return view('payment_management.transport_payments.index', compact('transport_payments', 'sort_search'));
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
        return view('payment_management.transport_payments.create', compact('employee', 'sort_search'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transport_payment = new TransportPayment;

        $transport_payment->employee_id = $request->employee_id;
        $transport_payment->payment_month = $request->payment_month;
        $transport_payment->payment_year = $request->payment_year;
        $transport_payment->amount = $request->amount;
        $transport_payment->remarks = $request->remarks;


        $transport_payment->save();

        flash('Transport payments has been inserted successfully')->success();
        return redirect()->route('transport_payments.index');
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
        $transport_payment = TransportPayment::with(['employee'])->findOrFail($id);

        return view('payment_management.transport_payments.edit', compact('transport_payment'));
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
        $transport_payment = TransportPayment::findOrFail($id);

        $transport_payment->employee_id = $request->employee_id;
        $transport_payment->payment_month = $request->payment_month;
        $transport_payment->payment_year = $request->payment_year;
        $transport_payment->amount = $request->amount;
        $transport_payment->remarks = $request->remarks;


        $transport_payment->save();

        flash('Transport payments has been updated successfully')->success();
        return redirect()->route('transport_payments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TransportPayment::find($id)->delete();
        flash('Transport payments has been deleted successfully')->success();

        return redirect()->route('transport_payments.index');
    }
}
