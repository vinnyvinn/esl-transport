@extends('layouts.main') 
@section('content')

<div>@include('includes.dashboard.heading')</div>

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">

                    <h4 class="text-center">Purchase Order</h4>
                    <hr/>

                    <div class="row">
                            <div class="col-sm-8">
                                <div style="margin-bottom:20px"><img src="{{ asset('images/logo.png') }}" alt=""></div>

                                <div class="col-sm-12">
                                        <div>Cannon Towers </div>
                                        <div>6th Floor, Moi Avenue Mombasa - Kenya</div>
                                        <div>Phone: +254 41 2229784</div>
                                        <div>Email: agency@esl-eastafrica.com/ops@esl-eastafrica.com</div>
                                        <div>Web: www.esl-eastafrica.com</div>
                                        <br/>
                                    <div>Tax Registration: 0121303W </div>
                                    <div>Telephone: +254 41 2229784</div>
                                    </div>
                               
                            </div>
                            <div class="col-sm-4">
                                <h4>Order Number</h4>
                                <h4>{{ $po->po_no}}</h4>
                                <hr/>

                            <div>
                                <p>TO</p>
                                <div>Name : {{ $po->supplier->Name }}</div>
                                <div>Tax Registration : {{ $po->supplier->Tax_Number }}</div>
                                <div>Telephone : {{ $po->supplier->Telephone }}</div>
                                <div>Email : {{ $po->supplier->EMail }}</div>
                                    <br/>
                                <div>Date : <span>{{ \Carbon\Carbon::parse($po->created_at)->format('d-m-Y') }}<span></div>
                                    
                            </div>
                            </div>
                    </div>{{-- header row end --}}

                    <hr/>

                    <div>

                            <table class="table table-bordered">
                                    <thead>
                                      <tr>
                                            <td class="text-uppercase font-weight-bold">Description</td>
                                            <td class="text-uppercase font-weight-bold text-center">Quantity</td>
                                            <td class="text-uppercase font-weight-bold text-center">Rate</td>
                                            <td class="text-uppercase font-weight-bold text-center">Tax</td>
                                            <td class="text-uppercase font-weight-bold text-right">Total Amount</td>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($po->purchaseOrderItems as $item)
                                      <tr>
                                        <td>{{ $item->description }}</td>
                                        <td class="text-center">{{ $item->quantity }}</td>
                                        <td class="text-center">{{ $item->rate }}</td>
                                        <td class="text-center">{{ $item->tax }}</td>
                                        <td class="text-right">{{ ($item->quantity * $item->rate) - (($item->quantity * $item->rate) * ($item->tax * 0.01)) }}</td>
                                      </tr>
                                      @endforeach
                                      
                                    </tbody>
                                  </table>
                    </div>{{-- items table end --}}

                    <div style="margin-top:40px;">

                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div><strong>Prepared by</strong> : <span class="text-capitalize"> {{ $po->user->name }}</span></div>
                                <div><strong>Approval</strong> : <span class="text-uppercase"> {{ $po->status }}</span></div>
                                <div><strong>Date</strong> : <span>{{ \Carbon\Carbon::parse($po->created_at)->format('d-m-Y') }} </span></div>

                            </div>
                            <div class="col-sm-12 col-md-6 text-right">
                            <p>Total(Excl) {{ $po->input_currency }} : {{ $po->purchaseOrderItems->sum( function($item){
                                return ($item->quantity * $item->rate);
                            }) }}</p>
                            <p>Total Tax {{ $po->input_currency }} : {{  $po->purchaseOrderItems->sum( function($item){
                                    return (($item->quantity * $item->rate) * ($item->tax * 0.01));
                            }) }}</p>
                            <p class="font-weight-bold">Total(Incl){{ $po->input_currency }} : {{ $po->purchaseOrderItems->sum( function($item){
                                return ($item->quantity * $item->rate) - (($item->quantity * $item->rate) * ($item->tax * 0.01));
                            }) }} </p>
                               

                            </div>
                        </div>

                    </div>{{-- user and totals div end --}}

            </div>
        </div>
    </div>

    <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div style="display:flex;flex-flow:row;justify-content:space-between">
                        <div>
                            <a href="{{ route('approve-po',['id' => $po->id])}}" class="btn btn-primary">Approve</a>
                            <a href="{{ route('dissaprove-po',['id' => $po->id])}}" class="btn btn-danger">Dissaprove</a>
                        </div>
                        <div>
                            @if($po->status != 'approved')
                            <div class="btn btn-primary">
                                    <i class="fa fa-print"> Cannot Print. Waiting Approval</i>
                                 </div>
                            @else
                            <a href="{{ route('print-po',['id' => $po->id])}}" class="btn btn-primary">
                                    <i class="fa fa-print">&nbsp Print Purchase Order</i>
                                    </a>
                            @endif
                            
                        </div>
                    </div>

                </div>
            </div>
    </div>

@endsection
@section('scripts')
@endsection