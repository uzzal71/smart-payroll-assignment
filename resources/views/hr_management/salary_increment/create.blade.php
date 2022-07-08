@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">Salary Increment Create</h5>
                <div class="col-md-6 text-md-right">
                    <a href="{{ route('salary_increments.index') }}" class="btn btn-primary">
                        <i class="las la-chevron-left"></i>
                         Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                <!-- Search Form -->
                <form class="" id="sort_employee_leaves" action="" method="GET" autocomplete="off">
                    @csrf
                    <div class="box-inline pad-rgt pull-left">
                        <div class="" style="min-width: 200px;">
                            <input type="text" class="form-control" id="search" name="search" @isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="Type Employee Card & Enter">
                        </div>
                    </div>
                </form>
                <!-- Search Form -->
            </div>
        </div>

        <!-- Form Card -->
        @if(!empty($employee))
        <div class="card">
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('salary_increments.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Employee Name</label>
                        <div class="col-md-9">
                            <input type="text" name="employee_name" id="employee_name" class="form-control" value="{{ $employee->employee_name }}" required>
                            <input type="hidden" name="employee_id" id="employee_id" value="{{ $employee->id }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Gross Salary</label>
                        <div class="col-md-9">
                            <input type="number" placeholder="Gross Salary" id="gross_salary" name="gross_salary" class="form-control" onkeyup="calculate_salary()" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Basic Salary</label>
                        <div class="col-md-9">
                            <input type="number" placeholder="Basic Salary" id="basic_salary" name="basic_salary" class="form-control" readonly readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">House Allowance</label>
                        <div class="col-md-9">
                            <input type="number" placeholder="House Allowance" id="house_rent" name="house_rent" class="form-control" readonly readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Medical Allowance</label>
                        <div class="col-md-9">
                            <input type="number" placeholder="Medical Allowance" id="medical_allowance" name="medical_allowance" class="form-control"  readonly required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Transport Allowance</label>
                        <div class="col-md-9">
                            <input type="number" placeholder="Transport Allowance" id="transport_allowance" name="transport_allowance" class="form-control"  readonly required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Food Allowance</label>
                        <div class="col-md-9">
                            <input type="number" placeholder="Food Allowance" id="food_allowance" name="food_allowance" class="form-control" readonly required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Effective Date</label>
                        <div class="col-md-9">
                            <input type="text" placeholder="xxxx-xx-xx" id="effective_date" name="effective_date" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Remarks</label>
                        <div class="col-md-9">
                            <textarea class="form-control" name="remarks" placeholder="Remarks" required>
                                salary increment
                            </textarea>
                        </div>
                    </div>

                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
        @endif
        <!-- Form Card -->
    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
    function calculate_salary() {

        $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:"POST",
                url:'{{ route('Get.Salary.Setting') }}',
                data: {},
                success: function(data) {
                    var gross_salary = document.getElementById("gross_salary").value;

                    document.getElementById("basic_salary").value = (gross_salary * data.salary_info.basic_salary) / 100;
                    document.getElementById("house_rent").value = (gross_salary * data.salary_info.house_rent) / 100;
                    document.getElementById("medical_allowance").value = (gross_salary * data.salary_info.medical_allowance) / 100;
                    document.getElementById("transport_allowance").value = (gross_salary * data.salary_info.transport_allowance) / 100;
                    document.getElementById("food_allowance").value = (gross_salary * data.salary_info.food_allowance) / 100;

                }
            });
    };
</script>
@endsection
