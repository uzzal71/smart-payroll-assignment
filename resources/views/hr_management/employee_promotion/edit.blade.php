@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">Employee Promotion Edit</h5>
                <div class="col-md-6 text-md-right">
                    <a href="{{ route('employee_promotions.index') }}" class="btn btn-primary">
                        <i class="las la-chevron-left"></i>
                         Back
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <form class="p-4" action="{{ route('employee_promotions.update', $employee_promotion->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <input name="_method" type="hidden" value="PATCH">
                	@csrf
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Employee</label>
                        <div class="col-md-9">
                            <input type="text" name="employee_name" id="employee_name" class="form-control" value="{{ $employee_promotion->employee->employee_name }}" required>
                            <input type="hidden" name="employee_id" id="employee_id" value="{{ $employee_promotion->employee_id }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Department Name</label>
                        <div class="col-md-9">
                           <select class="form-control aiz-selectpicker" name="department_id" id="department_id" data-live-search="true" required>
                                <option value="">Select Department</option>
                                @foreach (\App\Models\Department::all() as $department)
                                <option value="{{ $department->id }}" @if($department->id == $employee_promotion->department_id) selected @endif>
                                    {{ $department->department_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Designation Name</label>
                        <div class="col-md-9">
                           <select class="form-control aiz-selectpicker" name="designation_id" id="designation_id" data-live-search="true" required>
                                <option value="">Select Designation</option>
                                @foreach (\App\Models\Designation::all() as $designation)
                                <option value="{{ $designation->id }}" @if($designation->id == $employee_promotion->designation_id) selected @endif>
                                    {{ $designation->designation_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Effective Date</label>
                        <div class="col-md-9">
                            <input type="text" placeholder="xxxx-xx-xx" id="effective_date" name="effective_date" class="form-control" value="{{ $employee_promotion->effective_date }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Remarks</label>
                        <div class="col-md-9">
                            <textarea class="form-control" name="remarks" placeholder="Remarks" required>
                                {{ $employee_promotion->remarks }}
                            </textarea>
                        </div>
                    </div>

                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
