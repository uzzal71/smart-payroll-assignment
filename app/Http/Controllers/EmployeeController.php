<?php

namespace App\Http\Controllers;

use App\Models\BankInformation;
use App\Models\EducationInformation;
use App\Models\Employee;
use App\Models\ExperienceInformation;
use App\Models\SalaryInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Artisan;
use Cache;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $employees = Employee::with(['department', 'designation', 'schedule'])->orderBy('id', 'asc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $employees = $employees->where('employee_id_card', 'like', '%'.$sort_search.'%');
        }

        $employees = $employees->paginate(200);

        return view('employees.index', compact('employees', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $employee = new Employee;
        $salary = new SalaryInformation;
        $education = new EducationInformation;
        $bank = new BankInformation;
        $experience = new ExperienceInformation;

        $filename = '';
        if($request->file('employee_photo')){
            $file = $request->employee_photo;
            $destinationPath = public_path() .'\uploads\employees';
            $filename = date('YmdHi') . '.'.$file->clientExtension();
            $file->move($destinationPath, $filename);
        }

        $employee->employee_name        = $request->employee_name;
        $employee->employee_id_card     = $request->employee_id_card;
        $employee->employee_punch_card  = $request->employee_punch_card;
        $employee->mobile               = $request->mobile;
        $employee->email                = $request->email;
        $employee->nid                  = $request->nid;
        $employee->date_of_birth        = $request->date_of_birth;
        $employee->religion             = $request->religion;
        $employee->sex                  = $request->sex;
        $employee->marital_status       = $request->marital_status;
        $employee->blood_group          = $request->blood_group;
        $employee->employee_status      = $request->employee_status;
        $employee->joining_date         = $request->joining_date;
        $employee->father_name          = $request->father_name;
        $employee->mother_name          = $request->mother_name;
        $employee->emergency_contact_person_name    = $request->emergency_contact_person_name;
        $employee->emergency_contact_person_number  = $request->emergency_contact_person_number;
        $employee->department_id                    = $request->department_id ;
        $employee->designation_id                   = $request->designation_id ;
        $employee->schedule_id                      = $request->schedule_id;
        $employee->present_address                  = $request->present_address;
        $employee->permanent_address                = $request->permanent_address;
        $employee->tax_status                       = $request->tax_status;
        $employee->tax_id                           = $request->tax_id;
        $employee->provident_fund_status            = $request->provident_fund_status;
        $employee->provident_fund_id                = $request->provident_fund_id;
        $employee->transport_allowance_status       = $request->transport_allowance_status;
        $employee->commission_status                = $request->commission_status;
        $employee->salary_withdraw                  = $request->salary_withdraw;
        $employee->employee_photo                   = $filename;
        $employee->status	                        = $request->status;

        $employee->save();

        // Salary Information
        $salary->employee_id            = $employee->id;
        $salary->gross_salary           = $request->gross_salary;
        $salary->basic_salary           = $request->basic_salary;
        $salary->house_rent             = $request->house_rent;
        $salary->medical_allowance      = $request->medical_allowance;
        $salary->transport_allowance    = $request->transport_allowance;
        $salary->food_allowance         = $request->food_allowance;

        $salary->save();

        // Edicatopm Information
        $education->employee_id     = $employee->id;
        $education->degree_title    = $request->degree_title;
        $education->faculty         = $request->faculty;
        $education->institute_name  = $request->institute_name;
        $education->duration        = $request->duration;
        $education->passing_year    = $request->passing_year;
        $education->result          = $request->result;

        $education->save();

        // Bank Information
        $bank->employee_id      = $employee->id;
        $bank->account_name     = $request->account_name;
        $bank->account_number   = $request->account_number;
        $bank->bank_name        = $request->bank_name;
        $bank->bank_branch_name = $request->bank_branch_name;
        $bank->bank_address     = $request->bank_address;
        $bank->swift_code       = $request->swift_code;

        $bank->save();

        // Experience Information
        $experience->employee_id            = $employee->id;
        $experience->designation_name       = $request->designation_name;
        $experience->company_name           = $request->company_name;
        $experience->duration               = $request->duration;
        $experience->location               = $request->location;
        $experience->description            = $request->description;

        $experience->save();

        flash('Employee has been inserted successfully')->success();

        return redirect()->route('employees.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::with(['salary', 'education', 'bank', 'experience'])->findOrFail($id);

        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::with(['salary', 'education', 'bank', 'experience'])->findOrFail($id);

        return view('employees.edit', compact('employee'));
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
        $employee = Employee::findOrFail($id);
        $salary = SalaryInformation::where('employee_id', $id)->first();
        $education = EducationInformation::where('employee_id', $id)->first();
        $bank = BankInformation::where('employee_id', $id)->first();
        $experience = ExperienceInformation::where('employee_id', $id)->first();

        $filename = '';
        if($request->file('employee_photo')){
            $file = $request->employee_photo;
            $destinationPath = public_path() .'\uploads\employees';
            $filename = date('YmdHi') . '.'.$file->clientExtension();
            $file->move($destinationPath, $filename);
        } else {
            $filename = $request->old_employee_photo;
        }

        $employee->employee_name        = $request->employee_name;
        $employee->employee_id_card     = $request->employee_id_card;
        $employee->employee_punch_card  = $request->employee_punch_card;
        $employee->mobile               = $request->mobile;
        $employee->email                = $request->email;
        $employee->nid                  = $request->nid;
        $employee->date_of_birth        = $request->date_of_birth;
        $employee->religion             = $request->religion;
        $employee->sex                  = $request->sex;
        $employee->marital_status       = $request->marital_status;
        $employee->blood_group          = $request->blood_group;
        $employee->employee_status      = $request->employee_status;
        $employee->joining_date         = $request->joining_date;
        $employee->father_name          = $request->father_name;
        $employee->mother_name          = $request->mother_name;
        $employee->emergency_contact_person_name    = $request->emergency_contact_person_name;
        $employee->emergency_contact_person_number  = $request->emergency_contact_person_number;
        $employee->department_id                    = $request->department_id ;
        $employee->designation_id                   = $request->designation_id ;
        $employee->schedule_id                      = $request->schedule_id;
        $employee->present_address                  = $request->present_address;
        $employee->permanent_address                = $request->permanent_address;
        $employee->tax_status                       = $request->tax_status;
        $employee->tax_id                           = $request->tax_id;
        $employee->provident_fund_status            = $request->provident_fund_status;
        $employee->provident_fund_id                = $request->provident_fund_id;
        $employee->transport_allowance_status       = $request->transport_allowance_status;
        $employee->commission_status                = $request->commission_status;
        $employee->salary_withdraw                  = $request->salary_withdraw;
        $employee->employee_photo                   = $filename;
        $employee->status	                        = $request->status;

        $employee->save();

        // Salary Information
        $salary->employee_id            = $employee->id;
        $salary->gross_salary           = $request->gross_salary;
        $salary->basic_salary           = $request->basic_salary;
        $salary->house_rent             = $request->house_rent;
        $salary->medical_allowance      = $request->medical_allowance;
        $salary->transport_allowance    = $request->transport_allowance;
        $salary->food_allowance         = $request->food_allowance;

        $salary->save();

        // Edicatopm Information
        $education->employee_id     = $employee->id;
        $education->degree_title    = $request->degree_title;
        $education->faculty         = $request->faculty;
        $education->institute_name  = $request->institute_name;
        $education->duration        = $request->duration;
        $education->passing_year    = $request->passing_year;
        $education->result          = $request->result;

        $education->save();

        // Bank Information
        $bank->employee_id      = $employee->id;
        $bank->account_name     = $request->account_name;
        $bank->account_number   = $request->account_number;
        $bank->bank_name        = $request->bank_name;
        $bank->bank_branch_name = $request->bank_branch_name;
        $bank->bank_address     = $request->bank_address;
        $bank->swift_code       = $request->swift_code;

        $bank->save();

        // Experience Information
        $experience->employee_id            = $employee->id;
        $experience->designation_name       = $request->designation_name;
        $experience->company_name           = $request->company_name;
        $experience->duration               = $request->duration;
        $experience->location               = $request->location;
        $experience->description            = $request->description;

        $experience->save();

        flash('Employee has been updated successfully')->success();

        return redirect()->route('employees.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(true) {
            SalaryInformation::where('employee_id', $id)->delete();
            ExperienceInformation::where('employee_id', $id)->delete();
            BankInformation::where('employee_id', $id)->delete();
            EducationInformation::where('employee_id', $id)->delete();
            Employee::where('id', $id)->delete();

            Artisan::call('view:clear');
            Artisan::call('cache:clear');

            flash('Employee has been deleted successfully')->success();
        }

        return redirect()->route('employees.index');
    }
}
