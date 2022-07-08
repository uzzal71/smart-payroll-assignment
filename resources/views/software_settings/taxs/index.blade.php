@extends('layouts.app')

@section('content')
<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="h3">All Tax</h1>
        </div>
        <div class="col-md-6 text-md-right">
            <a href="{{ route('taxs.create') }}" class="btn btn-primary">
                <span>Add New Tax</span>
            </a>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header d-block d-md-flex">
        <h5 class="mb-0 h6">Tax</h5>
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
                    <th>Tax Name</th>
                    <th>Percentage(%)</th>
                    <th>Status</th>
                    <th class="text-right">Options</th>
                </tr>
            </thead>
            <tbody>
                @foreach($taxs as $key => $tax)
                    <tr>
                        <td>{{ ($key+1) + ($taxs->currentPage() - 1)*$taxs->perPage() }}</td>
                        <td>{{ $tax->tax_name }}</td>
                        <td>{{ $tax->percentage }} %</td>
                        <td>{{ $tax->status }}</td>
                        <td class="text-right">
                            @if($tax->tax_name != "Default")
                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{ route('taxs.edit', $tax->id)  }}" title="Edit">
                                <i class="las la-edit"></i>
                            </a>
                            <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{ route('taxs.destroy', $tax->id) }}" title="Delete">
                                <i class="las la-trash"></i>
                            </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $taxs->appends(request()->input())->links() }}
        </div>
    </div>
</div>
@endsection


@section('modal')
    @include('modals.delete_modal')
@endsection


@section('script')

@endsection
