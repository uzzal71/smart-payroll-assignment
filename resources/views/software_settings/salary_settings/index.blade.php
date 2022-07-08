@extends('layouts.app')

@section('content')

<!-- get Attendance -->
<div class="row">
    <div class="col-lg-10 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5>Salary Settings</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Gross Salry</th>
                            <th>Basic Salary</th>
                            <th>House Rent</th>
                            <th>Medicale</th>
                            <th>Transport</th>
                            <th>Food</th>
                            <th class="text-right">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($salary_settings as $key => $salary_setting)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $salary_setting->gross_salary }} %</td>
                            <td>{{ $salary_setting->basic_salary }} %</td>
                            <td>{{ $salary_setting->house_rent }} %</td>
                            <td>{{ $salary_setting->medical_allowance }} %</td>
                            <td>{{ $salary_setting->transport_allowance }} %</td>
                            <td>{{ $salary_setting->food_allowance }} %</td>
                            <td class="text-right">
                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{ route('salary_settings.edit', $salary_setting->id)  }}" title="Edit">
                                <i class="las la-edit"></i>
                            </a>
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

@endsection
