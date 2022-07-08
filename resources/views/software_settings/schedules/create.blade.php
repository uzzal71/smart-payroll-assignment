@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">Schedule Create</h5>
                <div class="col text-right">
                    <a href="{{ route('schedules.index') }}" class="btn btn-circle btn-info">
                        <i class="las la-chevron-left"></i>
                        Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('schedules.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                	@csrf
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Schedule Name</label>
                        <div class="col-md-9">
                            <input type="text" placeholder="Schedule Name" id="schedule_name" name="schedule_name" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Office Start</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="office_start" id="office_start" placeholder="Office Start">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Late Start</label>
                        <div class="col-md-9">
                            <input type="text" name="office_late_start" class="form-control" id="office_late_start" placeholder="Late Start" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Late End</label>
                        <div class="col-md-9">
                            <input type="text" name="office_late_end" class="form-control" id="office_late_end" placeholder="Late End" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Office End</label>
                        <div class="col-md-9">
                            <input type="text" name="office_end" class="form-control" id="office_end" placeholder="Office End" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">OT Start</label>
                        <div class="col-md-9">
                            <input type="text" name="office_over_time_start" class="form-control" id="office_over_time_start" placeholder="OT Start" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">OT End</label>
                        <div class="col-md-9">
                            <input type="text" name="office_over_time_end" class="form-control" id="office_over_time_end" placeholder="OT End" required>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Status</label>
                        <div class="col-md-9">
                            <select name="status" required class="form-control aiz-selectpicker mb-2 mb-md-0">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
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
