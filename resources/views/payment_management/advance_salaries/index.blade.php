@extends('layouts.app')

@section('content')
<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">All Advance Salary</h1>
        </div>
        <div class="col-md-6 text-md-right">
            <a href="{{ route('advance_salaries.create') }}" class="btn btn-primary">
                <span>Add Advance Salary</span>
            </a>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header d-block d-md-flex">
        <h5 class="mb-0 h6">Advance Salaries</h5>
        <form class="" id="sort_categories" action="" method="GET">
            <div class="box-inline pad-rgt pull-left">
                <div class="" style="min-width: 200px;">
                    <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="Type Payment Month & Enter">
                </div>
            </div>
        </form>
    </div>
    <div class="card-body">
        <table class="table aiz-table mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Employee Name</th>
                    <th>Payment Month</th>
                    <th>Payment Year</th>
                    <th>Amount</th>
                    <th>Remarks</th>
                    <th>Status</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach($advance_salaries as $key => $row)
                    <tr>
                        <td>{{ ($key+1) + ($advance_salaries->currentPage() - 1)*$advance_salaries->perPage() }}</td>
                        <td>
                            {{ $row->employee->employee_name  }}
                        </td>
                        <td>{{ $row->payment_month  }}</td>
                        <td>{{ $row->payment_year  }}</td>
                        <td>{{ $row->amount  }}</td>
                        <td>{{ $row->remarks  }}</td>
                        <td>{{ $row->status == 0 ? 'Pending' : 'Approved'  }}</td>
                        <td>
                            <form action="{{ route('advance_salaries.approval', $row->id) }}" style="display: inline-block;" method="post">
                                @csrf
                                @if($row->status == 0)
                                <input type="hidden" name="status" value="1">
                                <button type="submit" class="btn btn-soft-primary btn-icon btn-circle btn-sm" title="Approved">
                                    AP
                                </button>
                                @else
                                    <input type="hidden" name="status" value="0">
                                    <button type="submit" class="btn btn-soft-primary btn-icon btn-circle btn-sm" title="Unapproved">
                                        UP
                                    </button>
                                @endif
                            </form>
                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{ route('advance_salaries.edit', $row->id)  }}" title="Edit">
                                <i class="las la-edit"></i>
                            </a>
                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{ route('advance_salaries.destroy', $row->id) }}" title="Delete">
                                <i class="las la-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $advance_salaries->appends(request()->input())->links() }}
        </div>
    </div>
</div>
@endsection


@section('modal')
    @include('modals.delete_modal')
@endsection


@section('script')

@endsection
