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
        <div class="card card-body printableArea">
            <h3 class="text-center">PROFORMA DISBURSEMENT ACCOUNT</h3>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-left">
                        <address>
                                <img src="{{ asset('images/logo.png') }}" alt="">
                                <h4>Express Shipping & Logistics (EA) Limited</h4>
                                <h4>Cannon Towers <br>
                                    6th Floor, Moi Avenue Mombasa - Kenya <br>
                                    Email :agency@esl-eastafrica.com or ops@esl-eastafrica.com <br>
                                    Web: www.esl-eastafrica.com</h4>
                                <h4> &nbsp;<b>TO : {{ ucwords($quotation->lead->name) }}</b></h4>
                                <h4 class="m-l-5"><strong>Contact Person : </strong> {{ ucwords($quotation->lead->contact_person) }}
                                    <br/> <strong>Tel/Email : </strong> {{ $quotation->lead->telephone }} {{ $quotation->lead->email }}
                                    <br/> <strong>Phone : </strong> {{ $quotation->lead->phone }}
                                </h4>
                                <br>
                                @foreach($quotation->cargos as $cargo)
                                    <h4>&nbsp;<b>CARGO  </b> {{ ucwords($cargo->cargo_name) }}</h4>
                                    <h4>&nbsp;<b>CARGO  QUANTITY </b> {{ $cargo->weight }} MT</h4>
                                    <h4>&nbsp;<b>DISCHARGE RATE</b>  {{ $cargo->discharge_rate }}  MT / WWD</h4>
                                    <h4>&nbsp;<b>PORT STAY  </b> {{ ceil(($cargo->weight)/$cargo->discharge_rate) }} Days</h4>
                                @endforeach

                            </address>
                    </div>
                    <div class="pull-right">
                        <div class="row">
                            <div class="form-group">
                                <h1 style="color: {{ $quotation->status == 'pending' ? 'red' : ($quotation->status == 'accepted' || $quotation->status == 'converted' ? 'green' : 'gray') }}">{{ strtoupper($quotation->status == 'pending' ? 'DRAFT' : $quotation->status) }}</h1>
                                <h3>Tax Registration: 0121303W</h3>
                                <h3>Telephone: +254 41 2229784</h3>
                                {{--<label><h4><b>Currency</b></h4></label>--}} {{--
                                <select class="form-control" name="currency" id="currency">--}}
                                        {{--<option value="">Select Currency</option>--}}
                                        {{--<option value="usd">USD</option>--}}
                                        {{--<option value="kes">KES</option>--}}
                                    {{--</select>--}}
                            </div>
                        </div>
                        <address>
                                {{--<h4><b>Job No</b> ESL002634</h4>--}}
                                <h4><b>Voyage No</b> {{ $quotation->voyage == null ? '' : strtoupper($quotation->voyage->voyage_no) }}</h4>
                                <h4>Currency : {{ $quotation->lead->currency }}</h4>
                                <h4 id="vessel_name"><b>VESSEL</b> {{ strtoupper($quotation->vessel->name )}}</h4>
                                <h4 id="grt"><b>GRT</b> {{ $quotation->vessel->grt }} GT</h4>
                                <h4 id="loa"><b>LOA</b> {{ $quotation->vessel->loa }} M</h4>
                                <h4 id="port"><b>PORT</b> {{ strtoupper($quotation->vessel->port_of_discharge) }}</h4>
                                <br>
                                {{-- <p><b>Date : </b> {{ \Carbon\Carbon::parse($quotation->created_at)->format('d-M-y') }}</p> --}}
                            </address>
                    </div>
                </div>
                <hr>

                <div class="card-body wizard-content">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Customer Request Details</h4>

                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif


                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Vessel Details</span></a></li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Cargo Details</span></a>                                        </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Voyage Details</span></a></li>
                                </ul>
                                <div class="tab-content tabcontent-border">
                                    <div class="tab-pane active" id="home" role="tabpanel">
                                        <div class="p-20">
                                            <table class="table table-boarded">
                                                <tr>
                                                    <td><strong>Name : </strong> {{ $quotation->vessel->name }}</td>
                                                    <td><strong>Country : </strong> {{ $quotation->vessel->country }}</td>
                                                    <td><strong>Call Sign : </strong> {{ $quotation->vessel->call_sign }}</td>
                                                    <td><strong>IMO Number : </strong> {{ $quotation->vessel->imo_number }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>LOA : </strong> {{ $quotation->vessel->loa }}</td>
                                                    <td><strong>GRT : </strong> {{ $quotation->vessel->grt }}</td>
                                                    <td><strong>Consignee Goods : </strong> {{ $quotation->cargos->sum('weight')
                                                        }}
                                                    </td>
                                                    <td><strong>NRT : </strong> {{ $quotation->vessel->nrt }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>DWT : </strong> {{ $quotation->vessel->dwt }}</td>
                                                    <td><strong>Port of Discharge: </strong> {{ $quotation->vessel->port_of_discharge
                                                        }} , {{ $quotation->vessel->country_of_loading }}</td>
                                                    <td><strong>Port of Loading: </strong> {{ $quotation->vessel->port_of_loading
                                                        }} , {{ $quotation->vessel->country_of_loading }}</td>
                                                </tr>
                                            </table>
                                            <div style="text-align:right">
                                                <button data-toggle="modal" data-target=".bs-example-modal-lgvessel" class="btn btn-primary">
                                                            Edit Vessel Details
                                                        </button>
                                            </div>

                                            <div class="modal fade bs-example-modal-lgvessel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"
                                                style="display: none;">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myLargeModalLabel">Edit Vessel</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="form-material m-t-40" method="POST" action="{{ route( 'update-quotation-vessel',[ 'id'=>$quotation->vessel->id])}}">
                                                                {{ csrf_field() }}

                                                                <input type="hidden" name="lead_id" value="{{ $quotation->lead_id }}">
    @include('includes.vessel_form')
                                                                <div style="text-align:right">
                                                                    <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                                                    <input class="btn  btn-primary" type="submit" value="Update Vessel Details">
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="tab-pane  p-20" id="profile" role="tabpanel">
                                        <div style="text-align:right">
                                            <button class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lgcargo">Add Cargo</button>
                                        </div>
                                        <div class="modal fade bs-example-modal-lgcargo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"
                                            style="display: none;">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myLargeModalLabel">Add Cargo</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="col-12">
                                                            <form class="form-material m-t-40" method="POST" action="{{ route( 'add_cargo-to-quotation',[ 'id'=>$quotation->id])}}">

                                                                {{ csrf_field()}}
                                                                <input type="hidden" name="lead_id" value="{{ $cargo->lead_id }}">
    @include('includes.cargos_form')
                                                                <div style="text-align:right">
                                                                    <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                                                    <input class="btn  btn-primary" type="submit" value="Submit">
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Name</th>
                                                    <th class="text-center">Good Type</th>
                                                    <th class="text-center">Consignee</th>
                                                    <th class="text-center">Shipping Type</th>
                                                    <th class="text-center">Package</th>
                                                    <th class="text-center">Weight</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($quotation->cargos as $cargoMod)
                                                <tr>
                                                    <td class="text-center">{{ ucwords($cargoMod->cargo_name) }}</td>
                                                    <td class="text-center">{{ ucfirst($cargoMod->goodType->name )}}</td>
                                                    <td class="text-center">{{ $cargoMod->consignee_name }}</td>
                                                    <td class="text-center">{{ ucwords($cargoMod->shipping_type) }}</td>
                                                    <td class="text-center">{{ $cargoMod->package }}</td>
                                                    <td class="text-center">{{ $cargoMod->weight }}</td>
                                                    <td class="text-center">
                                                        <div style="display:flex; flex-flow:row;justify-content:space-around">
                                                            <div>
                                                                <button data-toggle="modal" data-target=".bs-example-modal-lg{{$cargoMod->id}}" class="btn btn-xs btn-primary">
                                                                    <i class="fa fa-pencil"></i>
                                                                </button>
                                                            </div>
                                                            <div>
                                                                <form method="POST" action="{{ route('delete-quotation-cargo',['id'=>$cargoMod->id]) }}">
                                                                    {{ csrf_field() }}
                                                                    <button type="submit" class="btn btn-xs btn-danger">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                                </form>
                                                            </div>
                                                            <div>
                                                    </td>
                                                    <td>
                                                        <div class="modal fade bs-example-modal-lg{{$cargoMod->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                                                            aria-hidden="true" style="display: none;">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title" id="myLargeModalLabel">Edit Cargo Details</h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="col-12">
                                                                            <form class="form-material m-t-40" method="POST" action="{{ route('update-quotation-cargo-details',['id'=>$cargoMod->id])}}">
                                                                                {{ csrf_field() }}
                                                                                <div class="form-row">
                                                                                    <div class="col">
    @include('includes.cargos_form')
                                                                                        <div style="text-align:right">
                                                                                            <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                                                                            <input class="btn  btn-primary" type="submit" value="Update Cargo Details">
                                                                                        </div>
                                                                            </form>

                                                                            </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        </div>
                                        <div class="tab-pane p-20" id="messages" role="tabpanel">
                                            <h3 class="text-center">Voyage Details</h3>
                                            @if($quotation->voyage == null)
                                            <form class="form-material m-t-40" method="POST" action="{{ route('add-quotation-voyage',['id'=>$quotation->id])}}" id="voyage">
                                                {{ csrf_field()}}
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="voyage_name">Voyage Name</label>
                                                            <input type="text" required id="voyage_name" name="voyage_name" class="form-control" placeholder="Name">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="voyage_no">External Voyage Number</label>
                                                            <input type="text" required id="voyage_no" name="voyage_no" class="form-control" placeholder="Voyage Number">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="internal_voyage_no">Internal Voyage No</label>
                                                            <input type="text" id="internal_voyage_no" name="internal_voyage_no" class="form-control" placeholder="Internal Voyage No">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="service_code">Service Code</label>
                                                            <input type="text" id="service_code" name="service_code" class="form-control" placeholder="Service Code">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="final_destination">Final Destination </label>
                                                            <input type="text" id="final_destination" name="final_destination" class="form-control" placeholder="Final Destination">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="eta"> ETA</label>
                                                            <input type="text" id="eta" name="eta" class="form-control datepicker" placeholder="ETA">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <input class="btn pull-right btn-primary" type="submit" value="Save">
                                                        </div>
                                                    </div>

                                                </div>
                                            </form>
                                            @else
                                            <div class="row">
                                                <table class="table table-stripped">
                                                    <tbody>
                                                        <tr>
                                                            <td><strong>Name : </strong>{{ ucwords($quotation->voyage->voyage_name
                                                                )}}
                                                            </td>
                                                            <td><strong>Voyage NO : </strong> {{ strtoupper($quotation->voyage->voyage_no)
                                                                }}
                                                            </td>
                                                            <td><strong>Service Code : </strong> {{ $quotation->voyage->service_code
                                                                }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Intrernal Voyage No. : </strong>{{ $quotation->voyage->internal_voyage_no
                                                                }}
                                                            </td>
                                                            <td><strong>Final Destination : </strong>{{ ucwords($quotation->voyage->final_destination
                                                                )}}
                                                            </td>
                                                            <td><strong>ETA : </strong> {{ \Carbon\Carbon::parse($quotation->voyage->eta)->format('d-M-y')
                                                                }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan=3>
                                                                <strong>Vessel Arrived:</strong> @if(!$quotation->voyage->vessel_arrived)
                                                                Arrives about {{ \Carbon\Carbon::parse($quotation->voyage->eta)->diffForHumans()
                                                                }} @else {{ \Carbon\Carbon::parse($quotation->voyage->vessel_arrived)->format('d-M-y')
                                                                }} @endif
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div style="text-align:right">
                                                <button data-toggle="modal" data-target=".voyage-modal" class="btn btn-primary">
                                                                Edit Voyage Details
                                                            </button>
                                            </div>

                                            <div class="modal fade voyage-modal" tabindex="-1" role="dialog" aria-labelledby="voyageEditModal" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="voyageEditModal">Edit Voyage Details</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method='POST' action="{{ route('update-quotation-voyage',['id'=>$quotation->voyage->id]) }}">
                                                                {{ csrf_field() }}
    @include('includes.voyage_form')
                                                                <div style="text-align:right">
                                                                    <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                                                    <input class="btn  btn-primary" type="submit" value="Update Voyage Details">
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            @endif
                                        </div>

                                        </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="table-responsive m-t-40" style="clear: both;">
                                        @if($quotation->status != \Esl\helpers\Constants::LEAD_QUOTATION_ACCEPTED && $quotation->status != \Esl\helpers\Constants::LEAD_QUOTATION_WAITING
                                        && $quotation->status != \Esl\helpers\Constants::LEAD_QUOTATION_CONVERTED)
                                        <h3>Add Tariff Service</h3>
    @include('includes.tarrifs_form')
                                        <div style="text-align:right;">
                                            <button onclick="addServiceToQuotaion()" class="btn btn-primary pull-right">Add</button>
                                        </div>
                                        @endif
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Description</th>
                                                    <th class="text-right">GRT/LOA</th>
                                                    <th class="text-right">RATE</th>
                                                    <th class="text-right">UNITS</th>
                                                    <th class="text-right">Tax</th>
                                                    <th class="text-right">Total (Incl)</th>
                                                    <th class="text-right">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="q_service">
                                                @foreach($quotation->services as $service)
                                                <tr>
                                                    <td>{{ ucwords($service->description) }}</td>
                                                    <td class="text-right">{{ $service->grt_loa }}</td>
                                                    <td class="text-right">{{ $service->rate }}</td>
                                                    <td class="text-right">{{ $service->units }}</td>
                                                    <td class="text-right">{{ $service->tax_amount }}</td>
                                                    <td class="text-right">{{ number_format($service->total) }}</td>
                                                    <td class="text-right">
                                                        <button data-toggle="modal" data-target=".bs-example-modal-lg{{$service->id}}" class="btn btn-xs btn-primary">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                                        <div class="modal fade bs-example-modal-lg{{$service->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                                                            aria-hidden="true" style="display: none;">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title" id="myLargeModalLabel">Edit Service</h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="col-12">
                                                                            <form style="text-align: left !important;" id="update_service{{$service->id}}" onsubmit="event.preventDefault(); submitForm(this, '/update-service');"
                                                                                action="" method="post">
                                                                                {{ csrf_field() }}
                                                                                <div class="row">
                                                                                    <div class="col-sm-12">
                                                                                        <div class="form-group">
                                                                                            <label for="description text-left">Description</label>
                                                                                            <input type="text" value="{{ ucwords($service->description) }}" required id="description" name="description" class="form-control"
                                                                                                placeholder="Description">
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="grt_loa">GRT/LOA</label>
                                                                                            <input type="text" required id="grt_loa" value="{{ $service->grt_loa  }}" name="grt_loa" class="form-control" placeholder="GRT/LOA"
                                                                                                readonly>
                                                                                        </div>
                                                                                        <input type="hidden" name="service_id" value="{{ $service->id }}">
                                                                                        <input type="hidden" name="tariff_type" value="{{ $service->tariff->type }}">
                                                                                        <div class="form-group">
                                                                                            <label for="rate">Rate </label>
                                                                                            <input type="text" required id="rate" {{ $service->tariff->type
                                                                                            == \Esl\helpers\Constants::TARIFF_KPA
                                                                                            ? 'readonly' : ' ' }} value="{{
                                                                                            $service->rate }}" name="rate"
                                                                                            class="form-control" placeholder="Rate">
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="units">Units </label>
                                                                                            <input type="text" required id="units" name="units" value="{{ $service->units }}" class="form-control" placeholder="Units">
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="tax">Tax Rate</label>
                                                                                            <select name="tax" required id="tax" class="form-control select2">
                                                                                            @foreach($taxs as $tax)
                                                                                                <option value="{{$tax}}">{{ ucwords($tax->Description) }} - {{ $tax->TaxRate }} %</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <br>
                                                                                            <input class="btn btn-block btn-primary" type="submit" value="Update">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                                <!-- /.modal-content -->
                                                            </div>
                                                            <!-- /.modal-dialog -->
                                                        </div>

                                                        <button onclick="deleteService({{ $service->id }})" class="btn btn-xs btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <hr> @if(empty($quotation->parties))
                                    <form method="POST" action={{ route( 'add-quotation-notifee') }}>
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-sm-3">Add Emails to CC</div>
                                            <div class="col-sm-6">
                                                <input type="hidden" name="quotation_id" value="{{$quotation->id}}">
                                                <div class="form-group">
                                                    <input type="text" name="notifying" placeholder="Add emails here separate with ( , ) " class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <button type="submit" class="btn btn-primary pull-right">Add</button>
                                            </div>
                                        </div>
                                    </form>
                                    @endif @if(!empty($quotation->parties))
                                    <div class="modal fade notifiees-modal" tabindex="-1" role="dialog" aria-labelledby="editEmailsModal" aria-hidden="true"
                                        style="display: none;">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="editEmailsModal">Edit Email Notifiees</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('update-quotation-notifee',['id'=>$quotation->parties->id])}}" method="POST">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="quotation_id" value="{{$quotation->id}}">
                                                        <div class="form-group">
                                                            <input type="text" name="notifying" placeholder="Add emails here separate with ( , ) " class="form-control" value="{{ implode(",",json_decode($quotation->parties->emails)) }}">
                                                        </div>
                                                        <div style="text-align:right">
                                                            <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                                            <input class="btn  btn-primary" type="submit" value="Update Email Notifiees">
                                                        </div>
                                                    </form>


                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <h3>Email Notifiees</h3>
                                    </div>
                                    <div class="col-sm-12">
                                        @if($quotation->parties != null) @foreach(json_decode($quotation->parties->emails) as $party)
                                        <b>{{$loop->iteration}}. </b> {{ $party }}&nbsp;&nbsp; @endforeach @endif
                                    </div>
                                    <div style="text-align:right">
                                        <button data-toggle="modal" data-target=".notifiees-modal" class="btn btn-primary">
                                                                                                    Update Emails Notifiees
                                                                                                </button>
                                    </div>
                                    @endif

                                    <hr>
                                    <div class="col-sm-12">

                                        @if(!empty($quotation->remarks->count() ))
                                        <h3>Remarks</h3>
                                        <table class="table table-responsive">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Name</th>
                                                    <th class="text-center">Remarks</th>
                                                    <th class="text-center">Made on</th>
                                                    <th>actions</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($quotation->remarks->sortByDesc('created_at') as $remark)
                                                <tr>
                                                    <td class="text-center">{{ ucwords($remark->user->name) }}</td>
                                                    <td class="text-center" width="500px">{{ ucfirst($remark->remark) }}</td>
                                                    <td class="text-center">{{ \Carbon\Carbon::parse($remark->created_at)->format('d-M-Y') }}</td>
                                                    <td class="text-center">
                                                        <div style="display:flex; flex-flow:row;justify-content:space-around">
                                                            <div>
                                                                <button data-toggle="modal" data-target=".editRemarkModal{{ $remark->id }}" class="btn btn-xs btn-primary">
                                                                                                                                                                                <i class="fa fa-pencil"></i>
                                                                                                                                                                            </button>
                                                            </div>
                                                            <div>
                                                                <form method="POST" action="{{ route('delete-quotation-remark',['id'=>$remark->id]) }}">
                                                                    {{ csrf_field() }}
                                                                    <button type="submit" class="btn btn-xs btn-danger">
                                                                    <i class="fa fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                            <div>

                                                                <div class="modal fade editRemarkModal{{ $remark->id }}" tabindex="-1" role="dialog" aria-labelledby="remarkEditModal" aria-hidden="true"
                                                                    style="display: none;">
                                                                    <div class="modal-dialog modal-lg">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title" id="remarkEditModal">Edit Remark Details</h4>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <form method="POST" action="{{ route('edit-quotation-remark',['id'=>$remark->id]) }}">
                                                                                    {{ csrf_field() }}
                                                                                    <input type="hidden" name="quotation_id" id="quotation_id" value="{{ $quotation->id }}">
                                                                                    <div class="form-group">
                                                                                        <label for="remarks">Add Remarks</label>
                                                                                    <textarea name="remarks" id="remarks" cols="30" rows="3" class="form-control">{{ $remark->remark }}</textarea>
                                                                                    </div>
                                                                                    <div style="text-align:right">
                                                                                        <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                                                                        <input class="btn  btn-primary" type="submit" value="Update Remark Details">
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                    </td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                        @endif
                                        </div>
                                        <div class="col-sm-12">
                                            <form action="{{ route('add-quotation-remark')}}" method="post">
                                                {{ csrf_field() }}
                                                <div class="form-group">
                                                    <label for="remarks">Add Remarks</label>
                                                    <textarea name="remarks" id="remarks" cols="30" rows="3" class="form-control"></textarea>
                                                </div>
                                                <input type="hidden" name="quotation_id" id="quotation_id" value="{{ $quotation->id }}">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <button class="btn btn-primary pull-right" type="submit">Add remark</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <hr>
                                        <div class="text-right">
                                            <a href="{{ url('/quotation/preview/'.$quotation->id) }}" class="btn btn btn-outline-success">Preview</a>
                                            @if($quotation->status == \Esl\helpers\Constants::LEAD_QUOTATION_APPROVED)
                                            <a href="{{ url('/quotation/send/'.$quotation->id) }}" class="btn btn btn-outline-success">Send To Customer</a>
                                            @endif 

                                            @if($quotation->status == \Esl\helpers\Constants::LEAD_QUOTATION_WAITING)
                                            <a href="{{ url('/quotation/customer/accepted/'.$quotation->id) }}" class="btn btn btn-primary">Accepted</a>
                                            <a href="{{ url('/quotation/customer/declined/'.$quotation->id) }}" class="btn btn-danger" type="submit"> Declined </a>                                            
                                            @endif 
                                            
                                            @if($quotation->status == \Esl\helpers\Constants::LEAD_QUOTATION_ACCEPTED)
                                            <a href="{{ url('/quotation/convert/'.$quotation->id) }}" class="btn btn btn-primary">Start Processing</a>
                                            @endif

                                            @if($quotation->status != \Esl\helpers\Constants::LEAD_QUOTATION_ACCEPTED &&
                                            $quotation->status != \Esl\helpers\Constants::LEAD_QUOTATION_WAITING && $quotation->status
                                            != \Esl\helpers\Constants::LEAD_QUOTATION_REQUEST && $quotation->status != \Esl\helpers\Constants::LEAD_QUOTATION_APPROVED
                                            && $quotation->status != \Esl\helpers\Constants::LEAD_QUOTATION_CONVERTED)
                                            <a href="{{ url('/quotation/request/'.$quotation->id) }}" class="btn btn-success" type="submit"> Request Approval </a>                                            
                                            @endif
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
@endsection
 
@section('scripts')
                        <script>
                            var form = $('#pda_remarks_form');
        var currency = '{{$quotation->lead->currency }}';

        function remark() {
            var formData = form.serializeArray().reduce(function (obj, item){
                obj[item.name] = item.value;
                return obj;
            }, {});

            submitData(formData,'/agency/remark')
        }

        function submitData(data, formUrl) {
            console.log(data);
            axios.post('{{ url('/') }}' + formUrl, data)
                .then(function (response) {
                    console.log(response.data)
                    window.location.reload();
                })
                .catch(function (response) {
                    console.log(response.data);
                });
        }

        var vessel = $('#vessel');
        vessel.on('submit', function (e) {
            var data = vessel.serializeArray().reduce(function(obj, item) {
                obj[item.name] = item.value;
                return obj;
            }, {});

            axios.post('{{ url('/vessel-details') }}', data)
                .then(function (response) {
                    var details = response.data.success;
                    $('#port').empty().append("<b>Port : </b> " + details.port_of_discharge);
                    $('#loa').empty().append("<b>LOA : </b> " + details.loa + " M");
                    $('#grt').empty().append("<b>GRT : </b> " + details.grt + " GT");
                    $('#vessel_name').empty().append("<b>Vessel : </b>" + details.vessel_name);
                    $('#vessel').empty().append("<h4><b>Vessel Details Updated</b></h4>");
                })
                .catch(function (response) {
                    console.log(response.data);
                });
            e.preventDefault();
        });

        var data = {
            'grt' : '{{ $quotation->vessel->grt }}',
            'loa' : '{{ $quotation->vessel->loa }}',
            '_token' : '{{ csrf_token() }}',
            'quotation' : '{{ $quotation->id }}',
            'port_stay' : '{{ count($quotation->cargos) < 1 ? 0 : (ceil($quotation->cargos->first()->weight/$quotation->cargos->first()->discharge_rate))}}',
            'service': {}
        };

        function addTariff() {
            var selected = document.getElementById("tariff");
            var selectedTariff = JSON.parse(selected.options[selected.selectedIndex].value);

            var sTax = document.getElementById("tax");
            var selectedTax = JSON.parse(sTax.options[sTax.selectedIndex].value);

            var units = $('#service_units').val();

//            Calculation using grt/loa
            if(selectedTariff.unit_type === '{{ \Esl\helpers\Constants::TARIFF_UNIT_TYPE_GRT }}'){

                var  grt_loa = Math.ceil(parseFloat(this.data.grt) / parseFloat(selectedTariff.unit_value));
                var serviceUnit = units === "" ? 0 : units;
                var newId = 'serv'+(Object.keys(this.data.service).length + 1);

                var serviceData =  {
                    'id': newId,
                    'tariff_id' : selectedTariff.id,
                    'description' : selectedTariff.name,
                    'tax_code' : selectedTax.Code,
                    'tax_description' : selectedTax.Description,
                    'tax_id' : selectedTax.idTaxRate,
                    'tax_amount' : ((selectedTax.TaxRate * (parseFloat(grt_loa) * parseFloat(selectedTariff.rate )* parseFloat(serviceUnit))) / 100),
                    'grt_loa' : grt_loa,
                    'rate' : selectedTariff.rate,
                    'units' : serviceUnit,
                    'total' : ((parseFloat(grt_loa) * parseFloat(selectedTariff.rate )* parseFloat(serviceUnit)) + ((selectedTax.TaxRate * (parseFloat(grt_loa) * parseFloat(selectedTariff.rate )* parseFloat(serviceUnit))) / 100))
                }

                addService(serviceData);
            }

            else if(selectedTariff.unit_type === '{{ \Esl\helpers\Constants::TARIFF_UNIT_TYPE_LOA }}'){
                var  grt_loa = Math.ceil(parseFloat(this.data.loa) / parseFloat(selectedTariff.unit_value));
                var serviceUnit = units === "" ? 0 : units;
                var newId = 'serv'+(Object.keys(this.data.service).length + 1);

                var serviceData =  {
                    'id': newId,
                    'tariff_id' : selectedTariff.id,
                    'description' : selectedTariff.name,
                    'tax_code' : selectedTax.Code,
                    'tax_description' : selectedTax.Description,
                    'tax_id' : selectedTax.idTaxRate,
                    'tax_amount' : ((selectedTax.TaxRate * (parseFloat(grt_loa) * parseFloat(selectedTariff.rate )* parseFloat(serviceUnit))) / 100),
                    'grt_loa' : grt_loa,
                    'rate' : selectedTariff.rate,
                    'units' : serviceUnit,
                    'total' : (((selectedTax.TaxRate * (parseFloat(grt_loa) * parseFloat(selectedTariff.rate )* parseFloat(serviceUnit))) / 100) + (parseFloat(grt_loa) * parseFloat(selectedTariff.rate )* parseFloat(serviceUnit)))
                }

                addService(serviceData);
            }

            else if(selectedTariff.unit_type === '{{ \Esl\helpers\Constants::TARIFF_UNIT_TYPE_LUMPSUM }}'){
                var  grt_loa = selectedTariff.unit_type;
                var serviceUnit = units === "" ? 0 : units;
                var newId = 'serv'+(Object.keys(this.data.service).length + 1);

                            console.log(this.data.port_stay);
                var serviceData =  {
                    'id': newId,
                    'tariff_id' : selectedTariff.id,
                    'description' : selectedTariff.name,
                    'tax_code' : selectedTax.Code,
                    'tax_description' : selectedTax.Description,
                    'tax_id' : selectedTax.idTaxRate,
                    'tax_amount' : ((selectedTax.TaxRate * (parseFloat(selectedTariff.rate )* parseFloat(serviceUnit))) / 100),
                    'grt_loa' : grt_loa,
                    'rate' : selectedTariff.rate,
                    'units' : serviceUnit,
                    'total' : (((selectedTax.TaxRate * (parseFloat(selectedTariff.rate )* parseFloat(serviceUnit))) / 100) + (parseFloat(selectedTariff.rate )* parseFloat(serviceUnit)))
                }

                addService(serviceData);
            }

            else if(selectedTariff.unit_type === '{{ \Esl\helpers\Constants::TARIFF_UNIT_TYPE_PERDAY }}'){
                var  grt_loa = selectedTariff.unit_type;
                var serviceUnit = units === "" ? 0 : units;
                var newId = 'serv'+(Object.keys(this.data.service).length + 1);

                var serviceData =  {
                    'id': newId,
                    'tariff_id' : selectedTariff.id,
                    'description' : selectedTariff.name,
                    'tax_code' : selectedTax.Code,
                    'tax_description' : selectedTax.Description,
                    'tax_id' : selectedTax.idTaxRate,
                    'tax_amount' : ((selectedTax.TaxRate  * (parseFloat(selectedTariff.rate )* parseFloat(serviceUnit))) / 100),
                    'grt_loa' : grt_loa,
                    'rate' : selectedTariff.rate,
                    'units' : serviceUnit,
                    'total' : (((selectedTax.TaxRate  * (parseFloat(selectedTariff.rate )* parseFloat(serviceUnit))) / 100) + (parseFloat(selectedTariff.rate )* parseFloat(serviceUnit)))
                }

                addService(serviceData);
            }
            else {
                var  grt_loa = selectedTariff.unit_type;
                var serviceUnit = units === "" ? 0 : units;
                var newId = 'serv'+(Object.keys(this.data.service).length + 1);

                var serviceData =  {
                    'id': newId,
                    'tariff_id' : selectedTariff.id,
                    'description' : selectedTariff.name,
                    'tax_code' : selectedTax.Code,
                    'tax_description' : selectedTax.Description,
                    'tax_id' : selectedTax.idTaxRate,
                    'tax_amount' : ((selectedTax.TaxRate * (parseFloat(selectedTariff.rate )* parseFloat(serviceUnit))) / 100),
                    'grt_loa' : grt_loa,
                    'rate' : selectedTariff.rate,
                    'units' : serviceUnit,
                    'total' : (((selectedTax.TaxRate * (parseFloat(selectedTariff.rate )* parseFloat(serviceUnit))) / 100) + (parseFloat(selectedTariff.rate )* parseFloat(serviceUnit)))
                }

                addService(serviceData);
            }

        }

        function addService(data){
            $('#service').append('<tr id="' + data.id + '">' +
                '<td>' + data.description + '</td>' +
                '<td class="text-right">' + data.grt_loa + '</td>' +
                '<td class="text-right">' + Number(data.rate).toFixed(2) + '</td>' +
                '<td class="text-right">' + Number(data.units).toFixed(2) + '</td>' +
                '<td class="text-right">' + data.tax_amount +' </td>' +
                '<td class="text-right">' + Number(data.total).toFixed(2)+ '</td>' +
                '<td class="text-right"><button onclick="deleteRow(this)" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>' +
                '</tr>');
            this.data.service[data.id] = data;
        }

        function deleteRow(row) {
            var table_row = row.parentNode.parentNode;

            delete this.data.service[table_row.id];
            table_row.parentNode.removeChild(table_row);
        }

        function addServiceToQuotaion() {
            if(Object.keys(this.data.service).length < 1){
                alert('Please add Services First');
            }
            else {
                axios.post('{{ url('/quotation-service') }}', this.data)
                    .then(function (response) {
//                       TODO::validation
                        $('#q_service').empty().append(response.data.success.services);
                        $('#sub_ex').empty().append("Total (Excl) " + this.currency + " : " + response.data.success.exc_total);
                        $('#total_tax').empty().append("Tax " + this.currency + " : " + response.data.success.total_tax);
                        $('#sub_in').empty().append("Total (Incl) " + this.currency + " : " + response.data.success.inc_total);
                        $('#total_amount').empty().append("<b>Total (Incl) " + this.currency + " :</b>  " + response.data.success.inc_total);
                        $('#service').empty();
                        this.data['service'] = {};
                    })
                    .catch(function (response) {
                        console.log(response);
                    });
            }
        }

        function deleteService(id) {
            axios.post('{{ url('/quotation-service-delete') }}', {
                'service_id' : id,
                'quotation_id' : this.data.quotation,
                '_token' : '{{ csrf_token() }}'
            })
                .then(function (response) {
//                       TODO::validation
                    $('#q_service').empty().append(response.data.success.services);
                    $('#sub_ex').empty().append("Total (Excl) " + this.currency + " : " + response.data.success.exc_total);
                    $('#total_tax').empty().append("Tax " + this.currency + " : " + response.data.success.total_tax);
                    $('#sub_in').empty().append("Total (Incl) " + this.currency + " : " + response.data.success.inc_total);
                    $('#total_amount').empty().append("<b>Total (Incl) " + this.currency + " :</b>  " + response.data.success.inc_total);
                    $('#service').empty();
                    this.data['service'] = {};
                })
                .catch(function (response) {
                    console.log(response);
                });
        }

        function perday(selected) {

            if(JSON.parse($('#'+selected.id).val()).unit_type === 'per day'){
                $('#service_units').val(this.data.port_stay);
            }
        }
                        </script>
@endsection