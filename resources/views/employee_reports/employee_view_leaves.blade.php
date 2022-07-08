@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">Filter</h5>
            </div>
            <div class="card-body">
                <!-- Search Form -->
                <form action="" method="GET" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" class="form-control" value="{{ Auth::user()->name; }}" readonly>
                        </div>
                        <div class="col-md-4">
                            <select name="month" id="month" required class="form-control aiz-selectpicker mb-2 mb-md-0">
                                <option value="0">Select Month</option>
                                <option value="01">January</option>
                                <option value="02">February</option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">August</option>
                                <option value="09">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select name="year" id="year" required class="form-control aiz-selectpicker mb-2 mb-md-0">
                                <option value="0">Select Year</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group mt-2">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
                <!-- Search Form -->
            </div>
        </div>
        <!-- Advance Salary View Result -->
        <div class="card">
            <div class="card-header">
                <h5>Employee Leave</h5>
                <a href="{{ route('employee.apply.leave') }}" class="btn btn-primary">Add New</a>
            </div>
            <div class="card-body">
                <table class="table aiz-table mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Employee Name</th>
                            <th>Leave Type</th>
                            <th>Form Date</th>
                            <th>To Date</th>
                            <th>Leave Days</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employee_leaves as $key => $employee_leave)
                            <tr>
                                <td>{{ ($key+1) + ($employee_leaves->currentPage() - 1)*$employee_leaves->perPage() }}</td>
                                <td>
                                    {{ $employee_leave->employee->employee_name  }}
                                    ({{ $employee_leave->employee->employee_punch_card  }})
                                </td>
                                <td>{{ $employee_leave->leave->leave_name  }}</td>
                                <td>{{ $employee_leave->from_date  }}</td>
                                <td>{{ $employee_leave->to_date  }}</td>
                                <td>{{ $employee_leave->leave_days  }}</td>
                                <td>{{ $employee_leave->status == 0 ? 'Pending' : 'Approve' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="aiz-pagination">
                    {{ $employee_leaves->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
        <!-- Advance Salary View Result -->
    </div>
</div>

@endsection
