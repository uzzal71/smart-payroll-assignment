@extends('layouts.app')

@section('content')
<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">All Commission Payment</h1>
        </div>
        <div class="col-md-6 text-md-right">
            <a href="{{ route('commissions.create') }}" class="btn btn-primary">
                <span>Add Commission Payment</span>
            </a>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header d-block d-md-flex">
        <h5 class="mb-0 h6">Commission Payments</h5>
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
                    <th class="text-right">Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach($commission_payments as $key => $row)
                    <tr>
                        <td>{{ ($key+1) + ($commission_payments->currentPage() - 1)*$commission_payments->perPage() }}</td>
                        <td>
                            {{ $row->employee->employee_name  }}
                        </td>
                        <td>{{ $row->payment_month  }}</td>
                        <td>{{ $row->payment_year  }}</td>
                        <td>{{ $row->amount  }}</td>
                        <td class="text-right">
                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{ route('commissions.edit', $row->id)  }}" title="Edit">
                                <i class="las la-edit"></i>
                            </a>
                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{ route('commissions.destroy', $row->id) }}" title="Delete">
                                <i class="las la-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $commission_payments->appends(request()->input())->links() }}
        </div>
    </div>
</div>
@endsection


@section('modal')
    @include('modals.delete_modal')
@endsection


@section('script')

@endsection
