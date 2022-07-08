<?php

namespace App\Http\Controllers;

use App\Models\SalarySetting;
use Illuminate\Http\Request;

class SalarySettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $salary_settings = SalarySetting::orderBy('id', 'desc')->get();
        return view('software_settings.salary_settings.index', compact('salary_settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
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
        $salary_setting = SalarySetting::findOrFail($id);

        return view('software_settings.salary_settings.edit', compact('salary_setting'));
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
        $salary_setting = SalarySetting::findOrFail($id);

        $salary_setting->gross_salary = $request->gross_salary;
        $salary_setting->basic_salary = $request->basic_salary;
        $salary_setting->house_rent   = $request->house_rent;
        $salary_setting->medical_allowance   = $request->medical_allowance;
        $salary_setting->transport_allowance = $request->transport_allowance;
        $salary_setting->food_allowance     = $request->food_allowance;

        $salary_setting->save();

        flash('Salary Setting has been updated successfully')->success();
        return redirect()->route('salary_settings.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get_salary_settings(Request $request)
    {
        $salary_info = SalarySetting::orderBy('id', 'desc')->first();

        return response()->json([
            'status' => true,
            'salary_info' => $salary_info,
        ]);
    }

    
}
