@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">Leave Create</h5>
                <div class="col text-right">
                    <a href="{{ route('leaves.index') }}" class="btn btn-circle btn-info">
                        <i class="las la-chevron-left"></i>
                        Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('leaves.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                	@csrf
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Leave Name</label>
                        <div class="col-md-9">
                            <input type="text" placeholder="Leave Name" id="leave_name" name="leave_name" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Short Name</label>
                        <div class="col-md-9">
                            <input type="text" placeholder="Short Name" id="short_name" name="short_name" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Leave Days</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="leave_days" id="leave_days" placeholder="Leave Days" value="0">
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
