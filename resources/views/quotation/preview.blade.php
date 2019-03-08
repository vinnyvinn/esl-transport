@extends('layouts.main')
@section('content')
   {{-- dashboard --}}
   <div>@include('includes.dashboard.heading')</div>
    <div class="container-fluid">
        <div class="card card-body qo-printable-area">

                {{-- company details --}}
                <div class="m-t-20">@include('includes.quotation.company')</div>

                {{-- header --}}
                <div class="row m-t-40">
                        <div class="col-sm-6">
                            <div class="heading-lines"></div>
                        </div>
                        <div class="col-sm-4">
                                @include('includes.quotation.header')
                        </div>
                        <div class="col-sm-2">
                            <div class="heading-lines"></div>
                        </div>
                    </div>

                {{-- sendee details --}}
                <div class="m-t-40">@include('includes.quotation.sendee')</div>
                {{-- voyage details --}}
                <div class="m-t-40">@include('includes.quotation.voyage')</div>
                {{-- cargo details --}}
                <div class="m-t-40">@include('includes.quotation.cargos')</div>

                {{-- services totals --}}
                <div class="m-t-40">@include('includes.quotation.sevices')</div>

                {{-- remarks --}}
                <hr>
                <div class="m-t-40">@include('includes.quotation.remarks')</div>     
        </div>
    </div>

    
    <div class="container-fluid" style="padding:0;">
            <div class="card">
                <div class="card-body">
                    <div style="text-align:right;">
                       
                        <div>
                        <a href="{{ route('download-customer-quotation',['id'=>$quotation->id])}}" class="btn btn-primary">
                                    <i class="fa fa-download">&nbsp Download Quotation</i>
                                    </a>
                            <button class="btn btn-primary" id="po_print_button">
                                    <i class="fa fa-print">&nbsp Print Quotation Order</i>
                                    </button>
                            
                        </div>
                    </div>

                </div>
            </div>
    </div>
@endsection
@section('scripts')

<script src="{{ asset('js/jquery.PrintArea.js')}}"></script>

<script>
        $(function(){
            'use strict';
        
            $('#po_print_button').click( function(){
                $('.qo-printable-area').printArea({mode:"popup",popClose : true,popHt: 800,popWd: 800 ,popX: 0,popY: 0,popTitle:"Print Purchase order"})
            })
        })
        </script>

@endsection