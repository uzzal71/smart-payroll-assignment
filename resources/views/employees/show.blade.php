@extends('layouts.app')

@section('content')
<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">Employee View</h1>
        </div>
        <div class="col-md-6 text-md-right">
            <a href="{{ route('employees.index') }}" class="btn btn-primary">
                <i class="las la-chevron-left"></i>
                 Back
            </a>
        </div>
    </div>
</div>


<div class="">
    <div class="row gutters-5">
            <div class="col-lg-8">
                @csrf
                <input type="hidden" name="added_by" value="admin">

                <!-- Employee Information -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">Employee Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-md-3 col-from-label">Employee Name <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="employee_name" placeholder="Employee Name" value="{{ $employee->employee_name }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-from-label">Employee Id Card <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="employee_id_card" placeholder="Employee Id Card" value="{{ $employee->employee_id_card }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-from-label">Employee Punch Card <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="employee_punch_card" placeholder="Employee Punch Card" value="{{ $employee->employee_punch_card }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-from-label">Mobile <span class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="mobile" placeholder="Mobile" value="{{ $employee->mobile }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-from-label">Email </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="email" placeholder="Email" value="{{ $employee->email }}" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-from-label">NID </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="nid" placeholder="NID" value="{{ $employee->nid }}" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-from-label">Date Of Birth</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="date_of_birth" id="calendar2" placeholder="Date Of Birth" value="{{ $employee->date_of_birth }}" >
                            </div>
                        </div>

                        <div class="form-group row" id="brand">
                            <label class="col-md-3 col-from-label">Religion</label>
                            <div class="col-md-8">
                                <select class="form-control aiz-selectpicker" name="religion" id="religion" data-live-search="true">
                                    <option value="N/A">Select Religion</option>
                                    <option value="Islam" @if($employee->religion == 'Islam') selected @endif>Islam</option>
                                    <option value="Hinduism" @if($employee->religion == 'Hinduism') selected @endif>Hinduism</option>
                                    <option value="Buddhism" @if($employee->religion == 'Buddhism') selected @endif>Buddhism</option>
                                    <option value="Christianity" @if($employee->religion == 'Christianity') selected @endif>Christianity</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row" id="brand">
                            <label class="col-md-3 col-from-label">Sex</label>
                            <div class="col-md-8">
                                <select class="form-control aiz-selectpicker" name="sex" id="sex" data-live-search="true">
                                    <option value="N/A">Select Sex</option>
                                    <option value="Male" @if($employee->sex == 'Male') selected @endif>Male</option>
                                    <option value="Female" @if($employee->sex == 'Female') selected @endif>Female</option>
                                    <option value="Other" @if($employee->sex == 'Other') selected @endif>Other</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row" id="brand">
                            <label class="col-md-3 col-from-label">Marital Status</label>
                            <div class="col-md-8">
                                <select class="form-control aiz-selectpicker" name="marital_status" id="marital_status" data-live-search="true">
                                    <option value="N/A">Select Marital Status</option>
                                    <option value="Married" @if($employee->marital_status == 'Married') selected @endif>Married</option>
                                    <option value="Unmarried" @if($employee->marital_status == 'Unmarried') selected @endif>Unmarried</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group row" id="brand">
                            <label class="col-md-3 col-from-label">Blood group</label>
                            <div class="col-md-8">
                                <select class="form-control aiz-selectpicker" name="blood_group" id="blood_group" data-live-search="true">
                                <option value="N/A">Select Blood Group</option>
                                @foreach (\App\Models\BloodGroup::all() as $blood_group)
                                <option value="{{ $blood_group->title }}" @if($blood_group->title == $employee->blood_group) selected @endif>{{ $blood_group->title }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group row" id="brand">
                            <label class="col-md-3 col-from-label">Employee Status</label>
                            <div class="col-md-8">
                                <select class="form-control aiz-selectpicker" name="employee_status" id="employee_status" data-live-search="true">
                                    <option value="N/A">Select Status</option>
                                    <option value="Regular" @if($employee->employee_status == 'Regular') selected @endif>Regular</option>
                                    <option value="New" @if($employee->employee_status == 'New') selected @endif>New</option>
                                    <option value="Left" @if($employee->employee_status == 'Left') selected @endif>Left</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-from-label">Joining Date</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="joining_date" id="calendar3" placeholder="Date Of Birth" value="{{ $employee->joining_date }}" >
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Employee Information -->

                <!-- Family Information -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">Family Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-md-3 col-from-label">Father Name </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="father_name" placeholder="Father Name" value="{{ $employee->father_name }}" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-from-label">Mother Name </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="mother_name" placeholder="Mother Name" value="{{ $employee->mother_name }}" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-from-label">Emergency Contact Person Name </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="emergency_contact_person_name" placeholder="Emergency Contact Person Name" value="{{ $employee->emergency_contact_person_name }}" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-from-label">Emergency Contact Person Number </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="emergency_contact_person_number" placeholder="Emergency Contact Person Number" value="{{ $employee->emergency_contact_person_number }}" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-from-label">Present Address </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="present_address" placeholder="Present Address" value="{{ $employee->present_address }}" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-from-label">Permanent Address </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="permanent_address" placeholder="Permanent Address" value="{{ $employee->permanent_address }}" >
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Family Information -->

                <!-- Bank Information -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">Bank Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-md-3 col-from-label">Account Name </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="account_name" placeholder="Account Name" value="{{ $employee->bank->account_name }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-from-label">Account Number </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="account_number" placeholder="Account Number" value="{{ $employee->bank->account_number }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-from-label">Bank Name </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="bank_name" placeholder="Bank Name" value="{{ $employee->bank->bank_name }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-from-label">Branch Name </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="bank_branch_name" placeholder="Branch Name" value="{{ $employee->bank->bank_branch_name }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-from-label">Bank Address </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="bank_address" placeholder="Bank Address" value="{{ $employee->bank->bank_address }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-from-label">Swift Code </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="swift_code" placeholder="Swift Code" value="{{ $employee->bank->swift_code }}">
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Bank Information -->

                <!-- Last Education Information -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">Last Education Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-md-3 col-from-label">Last Degree Title </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="degree_title" placeholder="Last Degree Title" value="{{ $employee->education->degree_title }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-from-label">Faculty </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="faculty" placeholder="Faculty" value="{{ $employee->education->faculty }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-from-label">Institute Name </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="institute_name" placeholder="Institute Name" value="{{ $employee->education->institute_name }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-from-label">Duration </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="duration" placeholder="Duration" value="{{ $employee->education->duration }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-from-label">Passing Year </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="passing_year" placeholder="Passing Year" value="{{ $employee->education->passing_year }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-from-label">Result </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="result" placeholder="Result" value="{{ $employee->education->result }}">
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Last Education Information -->

                <!-- Last Experience Information -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">Last Experience Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-md-3 col-from-label">Designation Name </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="designation_name" placeholder="Designation Name" value="{{ $employee->experience->designation_name }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-from-label">Company Name </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="company_name" placeholder="Company Name" value="{{ $employee->experience->company_name }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-from-label">Duration </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="duration" placeholder="Duration" value="{{ $employee->experience->duration }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-from-label">Location </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="location" placeholder="Location" value="{{ $employee->experience->location }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-from-label">Description </label>
                            <div class="col-md-8">
                            <textarea class="aiz-text-editor" name="description">{{ $employee->experience->description }}</textarea>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Last Experience Information -->

                <!-- Employee Images -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">Employee Images</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="signinSrEmail">Images <small>(600x600)</small></label>
                            <div class="col-md-8">
                                <input type="file" name="employee_photo" class="selected-files">
                                <input type="hidden" name="old_employee_photo" value="{{ $employee->employee_photo }}" >
                                <br />
                                <small class="text-muted">These images are visible in employee details page. Use 600x600 sizes images.</small>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Employee Images -->

            </div>

            <div class="col-lg-4">

                <!-- Salary Information -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">Salary Information</h5>
                    </div>

                    <div class="card-body">

                        <div class="form-group row">
                            <label class="col-md-4 col-from-label">Gross</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="gross_salary" placeholder="0.00" value="{{ $employee->salary->gross_salary }}">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-4 col-from-label">Basic</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="basic_salary" placeholder="0.00" value="{{ $employee->salary->basic_salary }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-from-label">House Rent</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="house_rent" placeholder="0.00" value="{{ $employee->salary->house_rent }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-from-label">Medical</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="medical_allowance" placeholder="0.00" value="{{ $employee->salary->medical_allowance }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-from-label">Transport</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="transport_allowance" placeholder="0.00" value="{{ $employee->salary->transport_allowance }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-from-label">Food</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="food_allowance" placeholder="0.00" value="{{ $employee->salary->food_allowance }}">
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Salary Information -->

                <!-- Department -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">Department</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <select class="form-control aiz-selectpicker" name="department_id" id="department_id" data-live-search="true" required>
                                <option value="">Select Department</option>
                                @foreach (\App\Models\Department::all() as $department)
                                <option value="{{ $department->id }}" @if($department->id == $employee->department_id) selected @endif>{{ $department->department_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Department -->

                <!-- Designation -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">Designation</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <select class="form-control aiz-selectpicker" name="designation_id" id="designation_id" data-live-search="true" required>
                                <option value="">Select Designation</option>
                                @foreach (\App\Models\Designation::all() as $designation)
                                <option value="{{ $designation->id }}" @if($designation->id == $employee->designation_id) selected @endif>{{ $designation->designation_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Designation -->

                <!-- Schedule -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">Duty Schedule</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <select class="form-control aiz-selectpicker" name="schedule_id" id="schedule_id" data-live-search="true" required>
                                <option value="">Select Schedule</option>
                                @foreach (\App\Models\Schedule::all() as $schedule)
                                <option value="{{ $schedule->id }}" @if($schedule->id == $employee->schedule_id) selected @endif>{{ $schedule->schedule_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Schedule -->

                <!-- Tax Status -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">Tax Status</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <select class="form-control aiz-selectpicker" name="tax_status" id="tax_status" data-live-search="true" required>
                                <option value="0" @if($employee->tax_status == 0) selected @endif>No</option>
                                <option value="1" @if($employee->tax_status == 1) selected @endif>Yes</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Tax Status -->

                <!-- Provident found -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">Provident Found</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <select class="form-control aiz-selectpicker" name="provident_fund_status" id="provident_fund_status" data-live-search="true" required>
                                <option value="0" @if($employee->provident_fund_status == 0) selected @endif>No</option>
                                <option value="1" @if($employee->provident_fund_status == 1) selected @endif>Yes</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Provident found -->

                <!-- Transport allowance -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">Transport Allowance</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <select class="form-control aiz-selectpicker" name="transport_allowance_status" id="transport_allowance_status" data-live-search="true" required>
                                <option value="0" @if($employee->transport_allowance_status == 0) selected @endif>No</option>
                                <option value="1" @if($employee->transport_allowance_status == 1) selected @endif>Yes</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Transport allowance -->

                <!-- Commission -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">Commission Allowance</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <select class="form-control aiz-selectpicker" name="commission_status" id="commission_status" data-live-search="true" required>
                                <option value="0" @if($employee->commission_status == 0) selected @endif>No</option>
                                <option value="1" @if($employee->commission_status == 1) selected @endif>Yes</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Commission -->

                <!-- Salary Withdraw -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">Salary Withdraw</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <select class="form-control aiz-selectpicker" name="salary_withdraw" id="salary_withdraw" data-live-search="true" required>
                                <option value="cash" @if($employee->salary_withdraw == 'cash') selected @endif>Cash</option>
                                <option value="bank" @if($employee->salary_withdraw == 'bank') selected @endif>Bank</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Salary Withdraw -->

                <!-- Employee Status -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">Employee Status</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <select class="form-control aiz-selectpicker" name="status" id="status" data-live-search="true" required>
                                <option value="active" @if($employee->status == 'active') selected @endif>Active</option>
                                <option value="inactive" @if($employee->status == 'inactive') selected @endif>inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Employee Status -->
            </div>
        </div>
</div>

@endsection

@section('script')

@endsection
