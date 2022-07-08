@extends('layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-auto">
            <h1 class="h3">All employees</h1>
        </div>
        <div class="col text-right">
            <a href="{{ route('employees.create') }}" class="btn btn-circle btn-info">
                <span>Add New Employee</span>
            </a>
        </div>
    </div>
</div>
<br>

<div class="card">
        <div class="card-header row gutters-5">
            <div class="col">
                <h5 class="mb-md-0 h6">All Employee</h5>
            </div>
            
            <div class="dropdown mb-2 mb-md-0">
                <button class="btn border dropdown-toggle" type="button" data-toggle="dropdown">
                    Bulk Action
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#"> Delete selection</a>
                </div>
            </div>

            <!-- Deepartment Search -->
            <div class="col-md-2 ml-auto">
                <select class="form-control form-control-sm aiz-selectpicker mb-2 mb-md-0" id="user_id" name="user_id" onchange="sort_products()">
                    <option value="">All Department</option>
                    @foreach (App\Models\Department::all() as $key => $department)
                            <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Deepartment Search -->

            <!-- Designation Search -->
            <div class="col-md-2 ml-auto">
                <select class="form-control form-control-sm aiz-selectpicker mb-2 mb-md-0" id="user_id" name="user_id" onchange="sort_products()">
                    <<option value="">All Designation</option>
                    @foreach (App\Models\Designation::all() as $key => $designation)
                            <option value="{{ $designation->id }}">{{ $designation->designation_name }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Designation Search -->
            
        </div>
    
        <div class="card-body">
            <table class="table aiz-table mb-0">
                <thead>
                    <tr>
                        <th>
                            <div class="form-group">
                                <div class="aiz-checkbox-inline">
                                    <label class="aiz-checkbox">
                                        <input type="checkbox" class="check-all">
                                        <span class="aiz-square-check"></span>
                                    </label>
                                </div>
                            </div>
                        </th>
                        <th>#</th>
                        <th>Name</th>
                        <th>Id</th>
                        <th>Card</th>
                        <th>Department</th>
                        <th>Designation</th>
                        <th>Schedule</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $key => $employee)
                    <tr>
                        <td>
                            <div class="form-group d-inline-block">
                                <label class="aiz-checkbox">
                                    <input type="checkbox" class="check-one" name="id[]" value="{{$employee->id}}">
                                    <span class="aiz-square-check"></span>
                                </label>
                            </div>
                        </td>
                        <td>{{ ($key+1) + ($employees->currentPage() - 1)*$employees->perPage() }}</td>
                        <td>
                            <div class="row gutters-5 w-200px w-md-200px mw-100">
                                <div class="col-auto">
                                    <img src="{{ static_asset('assets/img/avatar-place.png') }}" alt="Image" class="size-50px img-fit">
                                </div>
                                <div class="col">
                                    <span class="text-muted text-truncate-2">{{ $employee->employee_name }}</span>
                                </div>
                            </div>
                        </td>

                        <td>{{ $employee->employee_id_card }}</td>
                        <td>{{ $employee->employee_punch_card }}</td>
                        <td>{{ $employee->department->department_name }}</td>
                        <td>{{ $employee->designation->designation_name }}</td>
                        <td>{{ $employee->schedule->schedule_name }}</td>
                        
                        <td>

                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{ route('employees.show', $employee->id)  }}" title="View">
                                <i class="las la-eye"></i>
                            </a>

                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{ route('employees.edit', $employee->id)  }}" title="Edit">
                                <i class="las la-edit"></i>
                            </a>

                           <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{ route('employees.destroy', $employee->id) }}" title="Delete">
                                <i class="las la-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="aiz-pagination">
                {{ $employees->appends(request()->input())->links() }}
            </div>
        </div>
    </form>
</div>

@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection


@section('script')
    
@endsection
