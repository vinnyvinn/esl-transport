@extends('layouts.main')
@section('content')
    <div class="row page-titles m-b-0">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Dashboard</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div>
        <div>
            <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Accepted PDAs</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    Search : <input type="text" id="search_lead">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Number</th>
                                    <th>Customer</th>
                                    <th>Vessel Name</th>
                                    <th>Port Of Discharge</th>
                                    <th>Port Of Loading</th>
                                    <th>Cargo Weight</th>
                                    <th>Created</th>
                                    <th class="text-nowrap">Action</th>
                                </tr>
                                </thead>
                                <tbody id="customers">
                                @foreach($dms as $dm)
                                    <tr>
                                        <td>{{ $dm->bl_number }}</td>
                                        <td>{{ ucwords($dm->customer->Name) }}</td>
                                        <td>{{ strtoupper($dm->vessel->name) }}</td>
                                        <td>{{ ucwords($dm->vessel->port_of_discharge ) }}</td>
                                        <td>{{ ucwords($dm->vessel->port_of_loading ) }}</td>
                                        <td>{{ $dm->cargo->sum('weight')}}</td>
                                        <td>{{ $dm->stage }}</td>
                                        <td>{{ \Carbon\Carbon::parse($dm->created_at)->format('d-M-y') }}</td>
                                        <td class="text-nowrap">
                                                <a href=" {{ url('dms/edit/'. $dm->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-check"></i></a>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="footable pagination">
                                {{ $dms->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var customer = $('#search_lead');

        customer.on('keyup', function () {
            axios.post('{{ url('/search-dms') }}',{
                'search_item': customer.val()
            }).then( function (response) {
                $('#customers').empty().append(response.data.output);
            })
                .catch( function (error) {
                    console.log(error)
                });
        });
    </script>
@endsection