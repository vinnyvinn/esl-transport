@extends('layouts.main') 
@section('content') {{-- heading --}}
<div>
    @include('includes.dashboard.heading')</div>

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
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <h4><strong>Vendor Details</strong></h4>
                                        <div class="form-group">
                                            <label for="supplier_id">Search supplier</label>
                                            <select name="supplier_id" id="supplier_id" class="select2 form-control" style="width:100%;" >
                                                    <option value="">Search and select service</option>
                                                    {{-- @foreach(\Esl\helpers\Constants::COUNTRY_LIST as $value)
                                                    @if(!empty($quotation->vessel->country))
                                                        <option value="{{ $quotation->vessel->country }}" 
                                                            selected="selected">{{ $quotation->vessel->country }}</option>
                                                    @endif
                                                        <option value="{{$value}}"
                                                        >{{$value}}</option>
                                                    @endforeach --}}
                                                </select>
                                        </div>
                                </div>

                            <div class="col-sm-12 text-right"><span>Date: {{ \Carbon\Carbon::now()->format('d-m-Y')}}<span></div>
                            </div>

                            <hr/>

                            {{-- po number div start --}}
                            <div>
                            <h4>Generate Purchase Order</h4>
                            <div class="row">
                                <div class="col-sm-5">
                                        <div class="form-group">
                                                <label for="po_no">PO Number</label>
                                        <input type="text" class="form-control" id="po_no" name="po_no" value="{{ "LP0-000". App\Quotation::count() }}" disabled>
                                              </div>
                                </div>
                                <div class="col-sm-5">
                                        <div class="form-group">
                                                <label for="po_date">PO Date</label>
                                                <input type="text" id="po_date" name="po_date" class="form-control datepicker" placeholder="PO Date">
                                              </div>
                                </div>
                                <div class="col-sm-2" style="text-align:right;margin-top:30px;">
                                        <button type="button" class="btn btn-primary">Add Details</button>
                                </div>
                            </div>
                        </div>{{-- po number div end --}}
                        <hr/>
                        
                        <div>{{-- select item div start --}}
                        <h4>Select Item</h4>

                        <div class="row">
                            <div class="col-sm-12">
                                    <div class="form-group">
                                            <label for="items">Select Items </label><br/>
                                            <select name="items" id="items" class="select2 form-control" style="width:100%;">
                                                                <option value="">Search and select service</option>
                                                                {{-- @foreach(\Esl\helpers\Constants::COUNTRY_LIST as $value)
                                                                @if(!empty($quotation->vessel->country))
                                                                    <option value="{{ $quotation->vessel->country }}" 
                                                                        selected="selected">{{ $quotation->vessel->country }}</option>
                                                                @endif
                                                                    <option value="{{$value}}"
                                                                    >{{$value}}</option>
                                                                @endforeach --}}
                                                            </select>
                                        </div>
                            </div>{{-- item serach end --}}

                            <div class="col-sm-12">
                                    <div class="form-group">
                                            <label for="item_description">Item description</label>
                                            <textarea class="form-control" id="item_description" rows="2"></textarea>
                                          </div>
                            </div>{{-- description end --}}

                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="quantity" placeholder="Quantity" name="quantity">
                                            </div>
                                    </div>
                                    <div class="col-sm-2">
                                            <div class="form-group">
                                                    <input type="number" class="form-control" id="rate" placeholder="Rate" name="rate">
                                                </div>

                                    </div>
                                    <div class="col-sm-4">
                                            <div class="form-group">
                                                    <select class="form-control" name="tax">
                                                      <option>Select tax</option>
                                                      <option>tax one</option>
                                                      <option>tax two</option>
                                                    </select>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                        <button type="button" class="btn btn-primary" style="text-align:right;">Add Details</button>
                                </div>
                            </div>
                        </div>

                        </div>{{-- select item div end --}}

                        <hr/>

                        {{-- items table div start --}}
                        <div>

                                <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Description</th>
                                                <th class="text-center">Quantity</th>
                                                <th class="text-center">Rate</th>
                                                <th class="text-center">Tax</th>
                                                <th class="text-center">Total Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                            <tr><td colspan="5"></td></tr>
                                            <tr>
                                                <td colspan="3"></td>
                                                <td class="text-right font-weight-bold">Total:</td>
                                                <td class="text-right font-weight-bold">0</td>
                                            </tr>
                                        </tfoot>
                                </table>

                        </div>{{-- items table div end --}}

                        {{-- save po button div start --}}
                        <div style="text-align:right;">
                                <button type="button" class="btn btn-primary">Save Purchase Order</button>
                        </div>
                        {{-- save po button div end --}}

            </div>{{-- card body end --}}
        </div>{{-- card div end --}}
    </div>{{-- container div end --}}

<div>
@endsection