@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">User Edit</h5>
                <div class="col text-right">
                    <a href="{{ route('users.index') }}" class="btn btn-circle btn-info">
                        <i class="las la-chevron-left"></i>
                        Back
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <form class="p-4" action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <input name="_method" type="hidden" value="PATCH">
                	@csrf

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Username</label>
                        <div class="col-md-9">
                            <input type="text" name="username" value="{{ $user->username }}" class="form-control" id="username" placeholder="Username" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Name</label>
                        <div class="col-md-9">
                            <input type="text" name="name" value="{{ $user->name }}" class="form-control" id="name" placeholder="Name" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Email</label>
                        <div class="col-md-9">
                            <input type="text" name="email" value="{{ $user->email }}" class="form-control" id="email" placeholder="Email" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="new_password">Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" placeholder="Password" name="password" autocomplete="off" required>
                        </div>
                    </div>

                    <input type="hidden" name="employee_id" value="{{ $user->employee_id }}">

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">User Type</label>
                        <div class="col-md-9">
                            <select name="user_type" required class="form-control aiz-selectpicker mb-2 mb-md-0">
                                <option value="Super admin" @if ($user->user_type == 'Super admin') selected @endif>Super admin</option>
                                <option value="Admin" @if ($user->user_type == 'Admin') selected @endif>Admin</option>
                                <option value="HR" @if ($user->user_type == 'HR') selected @endif>HR</option>
                                <option value="Finance" @if ($user->user_type == 'Finance') selected @endif>Finance</option>
                                <option value="Employee" @if ($user->user_type == 'Employee') selected @endif>Employee</option>
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
