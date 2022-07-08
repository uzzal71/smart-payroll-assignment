@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-8 mx-auto">
        <!-- Form Card -->
        <div class="card">
            <div class="card-header">
                <h5>Submit Your Attendance</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('employee.submit.attendance') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Employee Name</label>
                        <div class="col-md-9">
                            <input type="text" name="employee_name" id="employee_name" class="form-control" value="{{ Auth::user()->name; }}" required>
                            <input type="hidden" name="employee_id" id="employee_id" value="{{ Auth::user()->employee_id; }}" required>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Attendance Date</label>
                        <div class="col-md-9">
                            <input type="text" placeholder="xxxx-xx-xx" name="attendance_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" readonly required>
                            <input type="hidden" name="attendance_in" value="09:00">
                            <input type="hidden" name="attendance_out" value="18:00">
                            <input type="hidden" name="status" value="N">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Remarks</label>
                        <div class="col-md-9">
                            <textarea class="form-control" name="remarks" placeholder="Remarks" required></textarea>
                        </div>
                    </div>


                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Form Card -->
    </div>
</div>

@endsection
