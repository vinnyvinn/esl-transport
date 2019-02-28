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
    @include('includes.cargos_form')
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="consignee_id">Consignee</label>
                                                            <select name="consignee_id" id="consignee_id" style="width:100%" class="select2 form-control">
                                                                <option value="">Select Consignee</option>
                                                                @foreach(\App\Consignee::all() as $value)
                                                                    <option value="{{$value->id}}">{{$value->consignee_name}} - {{$value->consignee_address}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                    </div>
                                                </div>
                                                <div style="text-align:right">
                                                    <input class="btn" type="button" style="margin-left:30px;" value="Back">
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
                                                            <label for="name">External Voyage No.</label>
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
                                                            <label for="voyage_name">Voyage Name</label>
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
                                                            <input type="text" required id="final_destination" name="final_destination" class="form-control" placeholder="Final Destination">
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
                                                    <input class="btn" type="button" style="margin-left:30px;" value="Back">
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