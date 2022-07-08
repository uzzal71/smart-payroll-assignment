@extends('layouts.app')

@section('content')
<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">All Salary Increment</h1>
        </div>
        <div class="col-md-6 text-md-right">
            <a href="{{ route('salary_increments.create') }}" class="btn btn-primary">
                <span>Add New Increment</span>
            </a>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header d-block d-md-flex">
        <h5 class="mb-0 h6">Salary Increments</h5>
        <form class="" id="sort_categories" action="" method="GET" autocomplete="off">
            <div class="box-inline pad-rgt pull-left">
                <div class="" style="min-width: 200px;">
                    <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="Type name & Enter">
                </div>
            </div>
        </form>
    </div>
    <div class="card-body">
        <table class="table aiz-table mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Gross</th>
                    <th>Basic</th>
                    <th>House</th>
                    <th>Medical</th>
                    <th>Transport</th>
                    <th>Food</th>
                    <th>Effective</th>
                    <th>Remarks</th>
                    <th class="text-right">Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach($salary_increments as $key => $increment)
                    <tr>
                        <td>{{ ($key+1) + ($salary_increments->currentPage() - 1)*$salary_increments->perPage() }}</td>
                        <td>
                            {{ $increment->employee->employee_name  }}
                            ({{ $increment->employee->employee_punch_card  }})
                        </td>
                        <td>{{ $increment->gross_salary }}</td>
                        <td>{{ $increment->basic_salary }}</td>
                        <td>{{ $increment->house_rent }}</td>
                        <td>{{ $increment->medical_allowance }}</td>
                        <td>{{ $increment->transport_allowance }}</td>
                        <td>{{ $increment->food_allowance }}</td>
                        <td>{{ $increment->effective_date }}</td>
                        <td><?php echo $increment->remarks; ?></td>
                        <td class="text-right">
                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{ route('salary_increments.edit', $increment->id)  }}" title="Edit">
                                <i class="las la-edit"></i>
                            </a>
                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{ route('salary_increments.destroy', $increment->id) }}" title="Delete">
                                <i class="las la-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $salary_increments->appends(request()->input())->links() }}
        </div>
    </div>
</div>
@endsection


@section('modal')
    @include('modals.delete_modal')
@endsection


@section('script')

@endsection
