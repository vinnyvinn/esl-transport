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
                <h3 class="text-center">DMS {{ ucwords( $dms->customer->Name)  }}</h3>
                <br>
                <div class="row">
                    <div class="card-body wizard-content">
                        <div class="col-md-12">
                            @if($update)
                                <div class="card">
                                    <div class="card-body">
                                        <h4>Update Client Details</h4>
                                        <div class="col-12">
                                            <form style="text-align: left !important;" id="update_service{{$dms->id}}" action="{{ url('/update-dms') }}" method="post">
                                                {{ csrf_field() }}
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="description text-left">Client Name</label>
                                                            <input type="text" value="{{ ucwords($dms->customer->Name) }}" readonly disabled class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="code_name">Code Name</label>
                                                            <input type="text" required id="code_name" name="code_name" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="seal_number">Seal Number</label>
                                                            <input type="text" required id="seal_number" name="seal_number" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="berth_number">Berth Number</label>
                                                            <input type="text" required id="berth_number" name="berth_number" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="laytime_start">Lay Time Start</label>
                                                            <input type="datetime-local" required id="laytime_start" name="laytime_start" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="date_of_loading">Date of Loading</label>
                                                            <input type="datetime-local" required id="date_of_loading" name="date_of_loading" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="place_of_receipt">Place of Receipt</label>
                                                            <input type="text" required id="place_of_receipt" name="place_of_receipt" class="form-control">
                                                        </div>
                                                        <input type="hidden" name="dms_id" value="{{ $dms->id }}">
                                                        <div class="form-group">
                                                            <label for="time_allowed">Time Allowed in Minutes </label>
                                                            <input type="text" required id="time_allowed" name="time_allowed" class="form-control" placeholder="Time Allowed in Minutes">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="number_of_crane">Number of Cranes </label>
                                                            <input type="text" required id="number_of_crane" name="number_of_crane" class="form-control" placeholder="Number of Cranes">
                                                        </div>
                                                        <div class="form-group">
                                                            <br>
                                                            <input class="btn pull-right btn-primary" type="submit" value="Update">
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @else
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Client Details</h4>
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#pda" role="tab">
                                                <span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">FDA</span>
                                            </a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#home" role="tab">
                                                <span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Vessel Details</span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                                                <span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Cargo</span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#messages" role="tab">
                                                <span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Voyage Details</span></a> </li>
                                         <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#agency" role="tab">
                                                <span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Actions</span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#sof" role="tab">
                                                <span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">SOF</span></a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#checklist1" role="tab">
                                                <span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Checklist Details</span></a> </li>
                                        {{--@foreach(\App\Stage::all() as $value)--}}
                                            {{--<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#{{ str_slug($value->name) }}" role="tab">--}}
                                                    {{--<span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">{{ ucwords($value->name) }}</span></a> </li>--}}
                                            {{--@endforeach--}}

                                    </ul>
                                    <div class="tab-content tabcontent-border">
                                        <div class="tab-pane active" id="pda" role="tabpanel">

                                            <div class="p-20">
                                                <div class="col-sm-12">
                                                    <h4>Client Files</h4>
                                                    <br>
                                                    <div class="col-sm-12">
                                                        @foreach($dms->vessel->vDocs as $doc)
                                                            {{ $loop->iteration }} . <a href="{{ url($doc->doc_path) }}" target="_blank" >{{ $doc->name }}</a>
                                                        @endforeach
                                                    </div>
                                                    <br>
                                                </div>
                                                <a href="{{ url('quotation/preview/'.$dms->quote_id) }}" target="_blank" class="btn btn-success">Preview FDA</a>
                                                <button data-toggle="modal" data-target=".bs-example-modal-lgvessel" class="btn btn-info">
                                                    Upload Client Doc
                                                </button>
                                                <div class="modal fade bs-example-modal-lgvessel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myLargeModalLabel">Upload</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="col-12">
                                                                    <form class="form-material m-t-40" action="{{ url('/vessel/doc/upload/') }}" method="post" enctype="multipart/form-data" id="vessel">
                                                                        <div class="row">
                                                                            {{ csrf_field() }}
                                                                            <input type="hidden" name="vessel_id" value="{{ $dms->vessel->id }}">
                                                                            <div class="col-sm-12">
                                                                                <div class="form-group">
                                                                                    <label for="name">Document Name</label>
                                                                                    <input type="text" required id="name" name="name" class="form-control" placeholder="Name">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="doc">Select Doc</label>
                                                                                    <input type="file" required id="doc" name="doc" class="form-control" placeholder="Select Doc">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <input class="btn btn-block btn-primary" type="submit" value="Upload">
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
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="tab-pane" id="home" role="tabpanel">
                                            <div class="p-20">
                                                <table class="table table-boarded">
                                                    <tr>
                                                        <td><strong>Name : </strong> {{ $dms->vessel->name }}</td>
                                                        <td><strong>Code Name : </strong> {{ $dms->code_name }}</td>
                                                        <td><strong>BL NO : </strong> {{ $dms->bl_number }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Time Allowed : </strong> {{ (new DateTime("@0"))->diff((new DateTime("@".($dms->time_allowed*60))))->format('%a Days, %h Hours, %i Minutes')}} </td>
                                                        <td><strong>Seal NO : </strong> {{ $dms->seal_number }}</td>
                                                        <td><strong>Berth NO : </strong> {{ $dms->berth_number }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Country : </strong> {{ $dms->vessel->country }}</td>
                                                        <td><strong>Call Sign : </strong> {{ $dms->vessel->call_sign }}</td>
                                                        <td><strong>IMO Number : </strong> {{ $dms->vessel->imo_number }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Cargo Discharge Rate : </strong> {{ $dms->discharge_rate }} MT / WWD</td>
                                                        <td><strong>Lay Time Start : </strong> {{ \Carbon\Carbon::parse($dms->laytime_start)->format('d-M-y') }}</td>
                                                        <td><strong>DWT : </strong> {{ $dms->vessel->dwt }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>LOA : </strong> {{ $dms->vessel->loa }}</td>
                                                        <td><strong>GRT : </strong> {{ $dms->vessel->grt }}</td>
                                                        <td><strong>Consignee Cargo : </strong> {{ $dms->vessel->consignee_good }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>NRT : </strong> {{ $dms->vessel->nrt }}</td>
                                                        <td><strong>Chargeable GRT : </strong> {{ $dms->vessel->grt }}</td>
                                                        <td><strong>Port of Loading: </strong> {{ $dms->vessel->port_of_loading }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Port of Discharge: </strong> {{ $dms->vessel->port_of_discharge }}</td>
                                                        <td><strong>Place of Receipt: </strong> {{ $dms->place_of_receipt }}</td>
                                                        <td><strong>Date of Loading : </strong> {{ \Carbon\Carbon::parse($dms->date_of_loading)->format('d-M-y') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Created On : </strong> {{ \Carbon\Carbon::parse($dms->vessel->created_at)->format('d-M-y') }}</td>

                                                    </tr>
                                                </table>
                                                <div class="modal fade bs-example-modal-lgvessel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myLargeModalLabel">Upload</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="col-12">
                                                                    <form class="form-material m-t-40" action="{{ url('/vessel/doc/upload/') }}" method="post" enctype="multipart/form-data" id="vessel">
                                                                        <div class="row">
                                                                            {{ csrf_field() }}
                                                                            <input type="hidden" name="vessel_id" value="{{ $dms->vessel->id }}">
                                                                            <div class="col-sm-12">
                                                                                <div class="form-group">
                                                                                    <label for="name">Document Name</label>
                                                                                    <input type="text" required id="name" name="name" class="form-control" placeholder="Name">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="doc">Select Doc</label>
                                                                                    <input type="file" required id="doc" name="doc" class="form-control" placeholder="Select Doc">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <input class="btn btn-block btn-primary" type="submit" value="Upload">
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
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane  p-20" id="profile" role="tabpanel">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Cargo Type</th>
                                                    <th>Discharge Rate</th>
                                                    <th>Port Stay</th>
                                                    <th>Shipping Type</th>
                                                    <th>Package</th>
                                                    <th>Weight</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($dms->cargo as $cargo)
                                                    <tr>
                                                        <td>{{ ucwords($cargo->name) }}</td>
                                                        <td>{{ ucfirst($cargo->goodType->name )}}</td>
                                                        <td>{{ $dms->discharge_rate }}</td>
                                                        <td>{{ $dms->grt/$dms->discharge_rate }} Days</td>
                                                        <td>{{ ucwords($cargo->shipping_type) }}</td>
                                                        <td>{{ $cargo->package }}</td>
                                                        <td>{{ $cargo->weight }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane p-20" id="messages" role="tabpanel">
                                            <div class="row">
                                                    <table class="table table-stripped">
                                                        <tbody>
                                                        <tr>
                                                            <td><strong>Name : </strong>{{ ucwords($dms->quote->voyage->name )}}</td>
                                                            <td><strong>Voyage NO : </strong> {{ strtoupper($dms->quote->voyage->voyage_no) }}</td>
                                                            <td><strong>Service Code : </strong> {{ strtoupper($dms->quote->voyage->service_code) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Name : </strong>{{ ucwords($dms->quote->voyage->name )}}</td>
                                                            <td><strong>Voyage NO : </strong> {{ strtoupper($dms->quote->voyage->voyage_no) }}</td>
                                                            <td><strong>Service Code : </strong> {{ strtoupper($dms->quote->voyage->service_code) }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Final Destination : </strong>{{ ucwords($dms->quote->voyage->final_destination )}}</td>
                                                            <td><strong>ETA : </strong> {{ \Carbon\Carbon::parse($dms->quote->voyage->eta)->format('d-M-y') }}</td>
                                                            <td><strong>Vessel Arrived : </strong> {{ \Carbon\Carbon::parse($dms->quote->voyage->vessel_arrived)->format('d-M-y')}}</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                        </div>
                                        <div class="tab-pane p-20" id="agency" role="tabpanel">
                                            <h3 class="text-center"></h3>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <button class="btn btn-success">Generate Cargo Manifest</button>
                                                </div> <div class="col-sm-3">
                                                    <button class="btn btn-success">Generate CFS Release Order</button>
                                                </div> <div class="col-sm-3">
                                                    <button class="btn btn-primary">Generate KPA Filezilla Doc</button>
                                                </div> <div class="col-sm-3">
                                                    <button class="btn btn-primary">Download SOF</button>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <button class="btn btn-success">Generate Outward Cargo Manifest</button>
                                                </div> <div class="col-sm-3">
                                                    <button class="btn btn-success">Generate Inward Cargo Manifest</button>
                                                </div> <div class="col-sm-3">
                                                    <button class="btn btn-primary">Generate BL Containerized</button>
                                                </div> <div class="col-sm-3">
                                                    <button class="btn btn-primary">Generate BL Convectional</button>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <button class="btn btn-success">Preview DO</button>
                                                </div> <div class="col-sm-3">
                                                    <button class="btn btn-success">Forward to Transport</button>
                                                </div> <div class="col-sm-3">
                                                    <button class="btn btn-primary">Generate BL Containerized</button>
                                                </div> <div class="col-sm-3">
                                                    <button class="btn btn-primary">Generate BL Convectional</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane p-20" id="sof" role="tabpanel">
                                            <h3 class="text-center">Statement Of Facts</h3>
                                            <div class="card">
                                                <div class="card-header">
                                                        <div class="pull-right">
                                                            <a href="{{ url('/generate/laytime/'.$dms->id) }}" class="btn btn-success">Generate Laytime</a>
                                                            <button class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-plus"></i></button>
                                                        </div>

                                                </div>
                                                <div class="card-body">
                                                    <table class="table table-boarded">
                                                        <thead>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>From</th>
                                                            <th>To</th>
                                                            <th>Crane</th>
                                                            <th>Remarks</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="sof_list">
                                                        @foreach($dms->sof as $sof)
                                                            <tr>
                                                        <td>{{\Carbon\Carbon::parse($sof->created_at)->format('d-M-y')}}</td>
                                                        <td> {{\Carbon\Carbon::parse($sof->from)->format('H:i') }} HRS</td>
                                                        <td> {{\Carbon\Carbon::parse($sof->to)->format('H:i') }} HRS</td>
                                                        <td> {{ $sof->crane_working}}</td>
                                                        <td> {{ucfirst($sof->remarks)}}</td>
                                                        </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
{{--                                        @foreach($stages as $stage)--}}
                                            <div class="tab-pane p-20" id="checklist1" role="tabpanel">
                                                @foreach($checklist as $key => $values)
                                                    <h3>{{ ucwords($key) }}</h3>
                                                    <table class="table table-responsive table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <th><b>Checklist</b></th>
                                                            <th><b>Type</b></th>
                                                            <th><b>Data</b></th>
                                                            <th><b>Sub checklist</b></th>
                                                            <th><b>Date Added</b></th>
                                                        </tr>
                                                        </thead>
                                                    @foreach($values as $inn)

                                                                <tbody>
                                                                <tr>
                                                                    <th><strong>{{ ucwords($inn[$key]['name'] )}}</strong></th>
                                                                    <th>{{ ucwords($inn[$key]['type']) }}</th>
                                                                    @if($inn[$key]['type'] == 'text')
                                                                        <th>{!!  $inn[$key]['type'] == 'text' ? ucfirst($inn[$key]['text'])  : implode("<br>",$inn[$key]['doc_links'])  !!}</th>
                                                                    @else
                                                                        <th>
                                                                            @foreach($inn[$key]['doc_links'] as $link)
                                                                                <a href="{{ url($link) }}" target="_blank">{{$link}} <br></a>
                                                                            @endforeach
                                                                        </th>
                                                                    @endif
                                                                    <th>{{ $inn[$key]['subchecklist'] != null ? implode(',',json_decode($inn[$key]['subchecklist'])) : ''}}</th>
                                                                    <th>{{ \Carbon\Carbon::parse( $inn[$key]['created_at'])->format('d-M-y') }}</th>
                                                                </tr>
                                                                </tbody>

                                                @endforeach
                                                    </table>
                                                @endforeach
                                            </div>
                                        {{--@endforeach--}}
                                    </div>
                                </div>
                            </div>
                            @foreach($stages as $stage)
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">{{ ucwords($stage->name) }}</h4>
                                        <form action="{{ url('/dms/store/') }}" method="post" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <table class="table table-stripped">
                                                <tbody>
                                                @foreach($stage->components as $component)
                                                    <tr>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                {{ ucfirst($component->name) }}
                                                            </div>
                                                            <input type="hidden" name="stage_component_id[]" value="{{$component->id}}">
                                                            <input type="hidden" name="dms_id" value="{{$dms->id}}">
                                                            <div class="col-sm-6 form-group">
                                                                <input name="{{  $component->type == 'file' ? 'doc_links' : 'text_value'}}[{{$component->id}}][]" class="form-control" {{ $component->required == true ? 'required' : '' }} type="{{ $component->type == 'file' ? 'file' : 'text' }}" multiple {{ $component->type == 'file' ? 'multiple' : '' }} >
                                                            </div>
                                                            @if($component->components != null )
                                                                <div class="col-sm-2">
                                                                    <i class="btn btn-success model_img img-responsive fa fa-check" data-toggle="modal" data-target="#responsive-modal{{$component->id}}">Sub checklist</i>
                                                                    <!-- sample modal content -->
                                                                    <div id="responsive-modal{{$component->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h4 class="modal-title">{{ ucwords($stage->name)  }} Sub checklist</h4>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="col-sm-12">
                                                                                        <ul class="icheck-list">
                                                                                            @foreach(json_decode($component->components) as $item)
                                                                                                <div class="form-group">
                                                                                                    <input type="checkbox" name="checklist[{{$component->id}}][{{$item}}][]" class="check" id="{{$item}}">
                                                                                                    <label for="{{$item}}">{{ $item }}</label>
                                                                                                </div>
                                                                                            @endforeach
                                                                                        </ul>
                                                                                    </div>
                                                                                  </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            <button class="btn btn-primary pull-right">Save</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bs-example-modal-lg" id="modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Add SOF </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <form id="checklist" action="{{ url('dms/add/sof') }}" onsubmit="event.preventDefault(); addSof(this, '{{ url('dms/add/sof') }}')" method="post">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-sm-4">
                                    <input type="hidden" name="bill_of_landing_id" value="{{ $dms->id }}">
                                    <div class="form-group">
                                        <label for="from">From</label>
                                        <input type="datetime-local"  required id="from" name="from" class="form-control" placeholder="From">
                                    </div>
                                    </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="to">To</label>
                                        <input type="datetime-local"  required id="to" name="to" class="form-control" placeholder="To">
                                    </div>
                                    </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="crane_working">Crane Working</label>
                                        <input type="number"  required id="crane_working" name="crane_working" class="form-control" placeholder="Crane Working">
                                    </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="remarks">Remarks</label>
                                            <textarea name="remarks" id="remarks" cols="5" rows="3"
                                                      class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <input class="btn btn-block btn-primary" type="submit" value="Save">
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
@endsection
@section('scripts')
    <script>
        function addSof(form, formUrl){

            var formId = form.id;

            var vessel = $('#'+formId);

            console.log(vessel);

            var data = vessel.serializeArray().reduce(function(obj, item) {
                obj[item.name] = item.value;
                return obj;
            }, {});

            console.log(data);
            axios.post(formUrl, data)
                .then(function (response) {
                    var details = response.data.success;

                    $('#sof_list').append(details);
                    $('#modal').modal('hide');

                })
                .catch(function (response) {
                    console.log(response.data);
                });

        }
    </script>
@endsection
