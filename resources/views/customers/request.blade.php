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
                                <h3> &nbsp;<b>TO : {{ ucwords($customer->name) }}</b></h3>
                                <h4 class="m-l-5"><strong>Contact Person : </strong> {{ ucwords($customer->contact_person) }}
                                    <br/> <strong>Tel/Email : </strong> {{ $customer->telephone }} {{ $customer->email }}
                                    <br/> <strong>Phone : </strong> {{ $customer->phone }}
                                </h4>
                                <br>
                                {{--<h3><b>CARGO  {{ ucwords($customer->name) }}</b></h3>--}}
                                {{--<h3><b>DISCHARGE RATE  {{ ucwords($customer->name) }}</b></h3>--}}
                                {{--<h3><b>PORT STAY  </b>{{ ucwords($customer->name) }}</h3>--}}

                            </address>
                    </div>
                    <div class="pull-right">
                        <div class="row">
                            <div class="form-group">
                                <h3> <b>Tax Registration :</b> 0121303W</h3>
                                <h3><b>Telephone :</b> +254 41 2229784</h3>
                            </div>
                        </div>
                        <address>
                                {{--<h4><b>Job No</b> ESL002634</h4>--}}
                                {{--<h4><b>Voyage No</b> TBA</h4>--}}
                                {{--<h4>Currency : USD</h4>--}}
                                {{--<h4 id="vessel_name"><b>VESSEL</b> MV TBN</h4>--}}
                                {{--<h4 id="grt"><b>GRT</b> 43753 GT</h4>--}}
                                {{--<h4 id="loa"><b>LOA</b> 229 M</h4>--}}
                                {{--<h4 id="port"><b>PORT</b> KEMBA</h4>--}}
                                {{--<p><b>Date :</b>23rd Jan 2017</p>--}}
                            </address>
                    </div>
                </div>
                <hr>
                <div class="card-body wizard-content">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Customer Request Details</h4>
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Vessel Details</span></a>                                        </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#cargo" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Cargo Details</span></a>                                        </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#voyage" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Voyage Details</span></a>                                        </li>
                                </ul>
                                <form class="form-material m-t-40" action="{{url('/vessel-details')}}" id="vessel" method="POST">
                                    {{csrf_field()}}
                                <div class="tab-content tabcontent-border">

                                    <!-- first tab div end -->
                                    <div class="tab-pane active" id="home" role="tabpanel">
                                        <div class="p-20">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="name">Vessel Name</label>
                                                            <input type="text" required id="name" name="name" class="form-control" placeholder="Name">
                                                        </div>
                                                        <input type="hidden" name="lead_id" value="{{ $customer->id }}">
                                                        <div class="form-group">
                                                            <label for="call_sign">Call Sign</label>
                                                            <input type="text" id="call_sign" name="call_sign" class="form-control" placeholder="Call Sign">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="imo_number">IMO Number </label>
                                                            <input type="text" id="imo_number" name="imo_number" class="form-control" placeholder="IMO Number">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="country">Country (Vessel Flag) </label>
                                                            <select name="country" id="country" class="select2 form-control">
                                                                    <option value="">Select Country</option>
                                                                    @foreach(\Esl\helpers\Constants::COUNTRY_LIST as $value)
                                                                        <option value="{{$value}}">{{$value}}</option>
                                                                    @endforeach
                                                                </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="eta"> ETA </label>
                                                            <input type="text" id="eta" required name="eta" class="datepicker form-control" placeholder="ETA">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="country_of_discharge"> Country of Discharge</label>
                                                            <select name="country_of_discharge" id="country_of_discharge" class="select2 form-control">
                                                                    <option value="">Select Country</option>
                                                                    @foreach(\Esl\helpers\Constants::COUNTRY_LIST as $value)
                                                                        <option value="{{$value}}">{{$value}}</option>
                                                                    @endforeach
                                                                </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="port_of_discharge"> Port of Discharge</label>
                                                            <input type="text" id="port_of_discharge" required name="port_of_discharge" class="form-control" placeholder="Port of Discharge">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="country_of_loading"> Country of Loading</label>
                                                            <select name="country_of_loading" id="country_of_loading" class="select2 form-control">
                                                                    <option value="">Select Country</option>
                                                                    @foreach(\Esl\helpers\Constants::COUNTRY_LIST as $value)
                                                                        <option value="{{$value}}">{{$value}}</option>
                                                                    @endforeach
                                                                </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="port_of_loading"> Port of Loading</label>
                                                            <input type="text" id="port_of_loading" required name="port_of_loading" class="form-control" placeholder="Port of Loading">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="loa">Length Over All </label>
                                                            <input type="number" id="loa" name="loa" required class="form-control" placeholder="Length Over All">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="grt">Gross Tonnage  GRT</label>
                                                            <input type="number" id="grt" name="grt" class="form-control" placeholder="Gross Tonnage ">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nrt"> Net Tonnage</label>
                                                            <input type="text" id="nrt" name="nrt" class="form-control" placeholder="Net Tonnage">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="dwt"> Dead Weight - including provision</label>
                                                            <input type="text" id="dwt" name="dwt" class="form-control" placeholder="Dead Weight - including provision">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="text-align:right">
                                                        <input class="btn btn-primary" type="button" value="Next">
                                                    </div>
                                        </div>
                                    </div>
                                    <!-- first tab div end -->

                                    <!-- second tab begin -->
                                    <div class="tab-pane" id="cargo" role="tabpanel">
                                        <div class="p-20">

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="good_type_id">Good Type</label><br/>
                                                        <select name="good_type_id" id="country_of_loading" style="width:100%" class="select2 form-control">
                                                                    <option value="">Select Good Type</option>
                                                                    @foreach(\App\GoodType::all() as $value)
                                                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="manifest_number">Manifest Number</label>
                                                        <input type="text" required id="manifest_number" name="manifest_number" class="form-control" placeholder="Manifest Number">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="seal_no">Seal No.</label>
                                                        <input type="text" required id="seal_no" name="seal_no" class="form-control" placeholder="Seal No.">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="description">Description</label>
                                                        <input type="text" required id="description" name="description" class="form-control" placeholder="Description">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="type">Type</label>
                                                        <select name="type" id="type" style="width:100%" class="select2 form-control">
                                                            <option value="">Select Type</option>
                                                            @foreach(\App\CargoTypes::all() as $value)
                                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col">

                                                    <div class="form-group">
                                                        <label for="shipping_type">Shipping Type</label>
                                                        <input type="text" required id="shipping_type" name="shipping_type" class="form-control" placeholder="Shipping Type">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="country_of_loading">Container</label>
                                                        <select name="container_id" id="container_id" style="width:100%" class="select2 form-control">
                                                            <option value="">Select Container</option>
                                                            @foreach(\App\Container::all() as $value)
                                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="case_qty">Case QTY</label>
                                                        <input type="text" required id="case_qty" name="case_qty" class="form-control" placeholder="Case QTY">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="t_net_weight">Total Net Weight</label>
                                                        <input type="text" required id="t_net_weight" name="t_net_weight" class="form-control" placeholder="Total Net Weight">
                                                    </div>
                                                </div>
                                                <div class="col">

                                                    <div class="form-group">
                                                        <label for="t_gross_weight">Total Gross Weight</label>
                                                        <input type="text" required id="t_gross_weight" name="t_gross_weight" class="form-control" placeholder="Total Gross Weight">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="package">Package</label>
                                                        <input type="text" required id="package" name="package" class="form-control" placeholder="Package">
                                                    </div>
                                                </div>
                                                <div class="col">

                                                    <div class="form-group">
                                                        <label for="weight">Weight</label>
                                                        <input type="text" required id="weight" name="weight" class="form-control" placeholder="Weight">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="total_package">Total Package</label>
                                                        <input type="text" required id="total_package" name="total_package" class="form-control" placeholder="Total Package">
                                                    </div>
                                                </div>
                                                <div class="col">

                                                    <div class="form-group">
                                                        <label for="discharge_rate">Discharge Rate</label>
                                                        <input type="text" required id="discharge_rate" name="discharge_rate" class="form-control" placeholder="Discharge Rate">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="shipper">Shipper</label>
                                                        <input type="text" required id="shipper" name="shipper" class="form-control" placeholder="Shipper">
                                                    </div>
                                                </div>
                                                <div class="col">

                                                    <div class="form-group">
                                                        <label for="shipping_line">Shipping Line</label>
                                                        <input type="text" required id="shipping_line" name="shipping_line" class="form-control" placeholder="Shipping Line">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="notifying_address">Notifying Address</label>
                                                        <input type="text" required id="notifying_address" name="notifying_address" class="form-control" placeholder="Notifying Address">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                        <label for="remarks">Remarks</label>
                                                    <div class="form-group">
                                                        <input type="text" required id="remarks" name="remarks" class="form-control" placeholder="Remarks">
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="text-align:right">
                                                <input class="btn" type="button"
                                                style="margin-left:30px;" value="Back">
                                                <input class="btn btn-primary" type="button" value="Next">
                                            </div>
                                        </div>
                                        <!-- padding div end -->
                                    </div>
                                    <!-- second tab div end -->

                                    <!-- last tab begin -->
                                    <div class="tab-pane" id="voyage" role="tabpanel">
                                        <div class="p-20">
                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="name">Voyage No.</label>
                                                        <input type="text" required id="voyage_no" name="voyage_no" class="form-control" placeholder="Voyage No.">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="name">Internal Voyage No.</label>
                                                        <input type="text" required id="internal_voyage_no" name="internal_voyage_no" class="form-control" placeholder="Internal Voyage No.">
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="voyage_name">Name</label>
                                                        <input type="text" required id="voyage_name" name="voyage_name" class="form-control" placeholder="Name">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="service_code">Service Code</label>
                                                        <input type="text" required id="service_code" name="service_code" class="form-control" placeholder="Service Code">
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="final_destination">Final Destination</label>
                                                        <input type="text" required id="final_destination" name="final_destination" class="form-control" placeholder="Final DEstination">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="eta"> ETA </label>
                                                        <input type="text" id="eta" required name="eta" class="datepicker form-control" placeholder="ETA">
                                                    </div>
                                                </div>
                                            </div>

                                            <div style="text-align:right">
                                                    <input class="btn" type="button"
                                                    style="margin-left:30px;" value="Back">
                                                    <input class="btn  btn-primary" type="submit" value="Submit">
                                            </div>

                                        </div>
                                    </div>
                                    <!-- third tab end -->
                                
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 
@section('scripts')
@endsection