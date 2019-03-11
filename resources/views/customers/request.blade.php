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
                                <form class="form-material m-t-40" action="{{ route('add-lead-quotation')}}" id="lead-quotation" method="POST">
                                    {{csrf_field()}}
                                    <div class="tab-content tabcontent-border">

                                        <input type="hidden" name="lead_id" value="{{ $customer->id }}">

                                        <!-- first tab div end -->
                                        <div class="tab-pane active" id="home" role="tabpanel">
                                            <div class="p-20">
                                                @include('includes.vessel_form')
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
                                                <div style="text-align:right">
                                                    <input class="btn" type="button" style="margin-left:30px;" value="Back">
                                                    <input class="btn btn-primary" type="button" value="Next">
                                                </div>
                                            </div>
                                            <!-- padding div end -->
                                        </div>
                                        <!-- second tab div end -->

                                        <!-- third tab begin -->
                                        <div class="tab-pane" id="voyage" role="tabpanel">
                                            <div class="p-20">
                                                @include('includes.voyage_form')
                                                <div style="text-align:right">
                                                    <input class="btn" type="button" style="margin-left:30px;" value="Back">
                                                    <input class="btn  btn-primary" type="submit" value="Submit">                                                  
                                                </div>

                                            </div>
                                        </div>
                                        <!-- third tab end -->
                                      
                            </div>

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

<script>

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