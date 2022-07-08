@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-10 mx-auto">
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
        @if(!empty($advance_salaries))
        <div class="card">
            <div class="card-header">
                <h5>Your advance salary</h5>
                <a href="{{ route('employee.apply.advance_salary') }}" class="btn btn-primary">Add New</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Month</th>
                            <th>Year</th>
                            <th>Amount</th>
                            <th>Remarks</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($advance_salaries as $key => $row)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($row->created_at)->format('d-m-Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($row->created_at)->format('F') }}</td>
                            <td>{{ $row->payment_year }}</td>
                            <td>{{ $row->amount }}</td>
                            <td>{{ $row->remarks }}</td>
                            <td>{{ $row->status == 0 ? 'Pending' : 'Approved' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
        <!-- Advance Salary View Result -->
    </div>
</div>

@endsection
