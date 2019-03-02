@extends('layouts.main')
@section('content')
   {{-- dashboard --}}
   <div>@include('includes.dashboard.heading')</div>
    <div class="container-fluid">
        <div class="card card-body printableArea">

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
@endsection