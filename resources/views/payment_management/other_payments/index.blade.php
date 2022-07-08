@extends('layouts.app')

@section('content')
<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">All Other Payment</h1>
        </div>
        <div class="col-md-6 text-md-right">
            <a href="{{ route('other_payments.create') }}" class="btn btn-primary">
                <span>Add Other Payment</span>
            </a>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header d-block d-md-flex">
        <h5 class="mb-0 h6">Other Payments</h5>
        <form class="" id="sort_categories" action="" method="GET">
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
                    <th>Employee Name</th>
                    <th>Payment Month</th>
                    <th>Payment Year</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th class="text-right">Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach($other_payments as $key => $row)
                    <tr>
                        <td>{{ ($key+1) + ($other_payments->currentPage() - 1)*$other_payments->perPage() }}</td>
                        <td>
                            {{ $row->employee->employee_name  }}
                        </td>
                        <td>{{ $row->payment_month  }}</td>
                        <td>{{ $row->payment_year  }}</td>
                        <td>{{ $row->amount  }}</td>
                        <td>{{ $row->status  }}</td>
                        <td class="text-right">
                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{ route('other_payments.edit', $row->id)  }}" title="Edit">
                                <i class="las la-edit"></i>
                            </a>
                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{ route('other_payments.destroy', $row->id) }}" title="Delete">
                                <i class="las la-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $other_payments->appends(request()->input())->links() }}
        </div>
    </div>
</div>
@endsection


@section('modal')
    @include('modals.delete_modal')
@endsection


@section('script')

@endsection
