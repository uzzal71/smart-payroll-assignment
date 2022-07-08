@extends('layouts.app')

@section('content')
<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">All Provident Fund</h1>
        </div>
        <div class="col-md-6 text-md-right">
            <a href="{{ route('provident_funds.create') }}" class="btn btn-primary">
                <span>Add New Provident Fund</span>
            </a>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header d-block d-md-flex">
        <h5 class="mb-0 h6">Provident Fund</h5>
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
                    <th>Provident Fund Name</th>
                    <th>Percentage(%)</th>
                    <th>Status</th>
                    <th class="text-right">Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach($provident_funds as $key => $provident_fund)
                    <tr>
                        <td>{{ ($key+1) + ($provident_funds->currentPage() - 1)*$provident_funds->perPage() }}</td>
                        <td>{{ $provident_fund->provident_fund_name }}</td>
                        <td>{{ $provident_fund->percentage }}%</td>
                        <td>{{ $provident_fund->status }}</td>
                        <td class="text-right">
                            @if ($provident_fund->provident_fund_name != "Default")
                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{ route('provident_funds.edit', $provident_fund->id)  }}" title="Edit">
                                <i class="las la-edit"></i>
                            </a>
                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{ route('provident_funds.destroy', $provident_fund->id) }}" title="Delete">
                                <i class="las la-trash"></i>
                            </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $provident_funds->appends(request()->input())->links() }}
        </div>
    </div>
</div>
@endsection


@section('modal')
    @include('modals.delete_modal')
@endsection


@section('script')

@endsection
