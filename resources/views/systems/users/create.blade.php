@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">User Create</h5>
                <div class="col text-right">
                    <a href="{{ route('users.index') }}" class="btn btn-circle btn-info">
                        <i class="las la-chevron-left"></i>
                        Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                <!-- Search Form -->
                <form class="" action="" method="GET" autocomplete="off">
                    @csrf
                    <div class="box-inline pad-rgt pull-left">
                        <div class="" style="min-width: 200px;">
                            <input type="text text-center" class="form-control" id="search" name="search" @isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="Type Employee Card & Enter">
                        </div>
                    </div>
                </form>
                <!-- Search Form -->
            </div>
        </div>
        <div class="card">
            @if($employee)
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Employee name</label>
                        <div class="col-md-9">
                            <input type="text" name="employee_name" class="form-control" id="employee_name" value="{{ $employee->employee_name }}" readonly>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Username</label>
                        <div class="col-md-9">
                            <input type="text" name="username" class="form-control" id="username" placeholder="Username" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Name</label>
                        <div class="col-md-9">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Name" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Email</label>
                        <div class="col-md-9">
                            <input type="text" name="email" class="form-control" id="email" placeholder="Email" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Password</label>
                        <div class="col-md-9">
                            <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">User Type</label>
                        <div class="col-md-9">
                            <select name="user_type" required class="form-control aiz-selectpicker mb-2 mb-md-0">
                                <option value="Super admin">Super admin</option>
                                <option value="Admin">Admin</option>
                                <option value="HR">HR</option>
                                <option value="Finance">Finance</option>
                                <option value="Employee">Employee</option>
                            </select>
                        </div>
                    </div>

                    <input type="hidden" name="employee_id" value="{{ $employee->id }}">

                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection
