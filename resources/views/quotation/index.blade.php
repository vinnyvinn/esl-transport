@extends('layouts.main') 
@section('content') {{-- heading --}}
<div>
    @include('includes.dashboard.heading')</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Quotations</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped dataTable table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Registered by</th>
                                    <th class="text-center">Lead/Customer</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Created at</th>
                                    <th class="text-center">See more</th>
                                </tr>
                            </thead>
                            <tbody id="customers">
                                @foreach($quotations as $quotation)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td class="text-center">{{ ucwords($quotation->user->name) }}</td>
                                    <td class="text-center">{{ ucwords($quotation->lead->name) }}</td>
                                    <td class="text-center">{{ $quotation->status }}</td>
                                    <td class="text-center">{{ \Carbon\Carbon::parse($quotation->created_at)->format('d-m-Y') }}</td>
                                    <td class="text-center">
                                            <a href=" {{ route('show-quotation', ['id' => $quotation->id ]) }}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a> 
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection