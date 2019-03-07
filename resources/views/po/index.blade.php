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
                                <div class="col-sm-7">
                                    <div style="margin-bottom:20px"><img src="{{ asset('images/logo.png') }}" alt=""></div>
                                   
                                </div>
                                <div class="col-sm-5">
                                        <div class="col-sm-12">
                                                <div>Cannon Towers </div>
                                                <div>6th Floor, Moi Avenue Mombasa - Kenya</div>
                                                <div>Phone: +254 41 2229784</div>
                                                <div>Email: agency@esl-eastafrica.com/ops@esl-eastafrica.com</div>
                                                <div>Web: www.esl-eastafrica.com</div>
                                            </div>
                                       
                                </div>

                            <div class="col-sm-12 text-right" style="margin-top:30px;"><span>Date: {{ \Carbon\Carbon::now()->format('d-m-Y')}}<span></div>
                            </div>

                            <hr/>
                        <form data-parsley-validate="" id="quotationPo" novalidate>
                                {{ csrf_field() }}
                                <label for="po_no">PO Number</label>
                                        <input type="hidden" name="po_no" value="{{ "LP0-000". (App\Quotation::count() + 1) }}">

                            {{-- po number div start --}}
                            <div>
                            <h4>Generate Purchase Order</h4>
                            <div class="row">
                            <div class="col-sm-5">
                                    <div class="form-group">
                                            <label for="supplier_id">Search supplier</label>
                                            <select name="supplier_id" id="supplier_id" class="select2 form-control" style="width:100%;" required>
                                                    <option value="">Search and select service</option>
                                                    @foreach($suppliers as $supplier)
                                                        <option value="{{$supplier->DCLink}}">{{$supplier->Name}}</option>
                                                    @endforeach
                                                </select>
                                        </div>
                            </div>
                                <div class="col-sm-3">
                                        <div class="form-group">
                                                <label for="po_no">PO Number</label>
                                        <input type="text" class="form-control" id="po_no" name="po_no" value="{{ "LP0-000". (App\PurchaseOrder::count() + 1) }}" disabled>
                                              </div>

                                              
                                </div>
                                <div class="col-sm-4">
                                        <div class="form-group">
                                                <label for="po_date">PO Date</label>
                                                <input type="text" id="po_date" name="po_date" class="form-control datepicker" placeholder="dd/mm/yy" required>
                                              </div>
                                </div>
                            </div>
                        </div>{{-- po number div end --}}
                        <hr/>
                        
                        <div>{{-- select item div start --}}
                        <h4>Select Item</h4>

                        <div class="row">
                            <div class="col-sm-12">
                                    <div class="form-group">
                                            <label for="service">Select Items </label><br/>
                                            <select name="service" id="service" class="select2 form-control" style="width:100%;">
                                                                <option value="">Search and select service</option>
                                                                @foreach($services as $service)
                                                                    <option value="{{$service->name}}"
                                                                    >{{$service->name}}</option>
                                                                @endforeach
                                                            </select>
                                        </div>
                            </div>{{-- item serach end --}}

                            <div class="col-sm-12">
                                    <div class="form-group">
                                            <label for="description">Item description</label>
                                            <textarea class="form-control" id="description" name="description" rows="2"></textarea>
                                          </div>
                            </div>{{-- description end --}}

                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-5">
                                            <div class="form-group">
                                                <input type="number" class="form-control" id="quantity" placeholder="Quantity" name="quantity" >
                                            </div>
                                    </div>
                                    <div class="col-sm-2">
                                            <div class="form-group">
                                                    <input type="number" class="form-control" id="rate" placeholder="Rate" name="rate">
                                                </div>

                                    </div>
                                    <div class="col-sm-5">
                                            <div class="form-group">
                                                    <select name="tax" id="tax" class="select2 form-control" style="width:100%;" >
                                                            <option value="">Select Tax</option>
                                                            @foreach($taxes as $tax)
                                                                <option value="{{$tax->TaxRate}}">{{$tax->Description}} - {{$tax->TaxRate}}</option>
                                                            @endforeach
                                                        </select>
                                    </div>
                                </div>                                
                            </div>
                            <div style="text-align:right;">
                                    <a type="button" class="btn btn-warning" id="addPoItem">Add Details</a>
                            </div>
                        </div>

                        </div>{{-- select item div end --}}

                        <hr/>

                        {{-- items table div start --}}
                        <div>

                                <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Service</th>
                                                <th class="text-center">Description</th>
                                                <th class="text-center">Quantity</th>
                                                <th class="text-center">Rate</th>
                                                <th class="text-center">Tax</th>
                                                <th class="text-center">Total Amount</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="itemTableBody">
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr><td colspan="7"></td></tr>
                                            <tr>
                                                <td colspan="4"></td>
                                                <td class="text-right font-weight-bold">Total:</td>
                                                <td class="text-center font-weight-bold"><span id="totalId"></span></td>
                                            </tr>
                                        </tfoot>
                                </table>

                        </div>{{-- items table div end --}}

                        {{-- save po button div start --}}
                        <div style="text-align:right;">
                                <button type="submit" class="btn btn-primary" id="savePo">Save Purchase Order</button>
                        </div>
                        {{-- save po button div end --}}

                    </form>

            </div>{{-- card body end --}}
        </div>{{-- card div end --}}
    </div>{{-- container div end --}}

<div>
@endsection

@section('scripts')
<script src="{{ asset('js/parsley.js') }}"></script>
<script>
$(function () {
    'use strict';

    var items = [];
    var count = 0;
    
    $('#totalId').html(0);

    // remove service item
    // use on because items are added after page has loaded
    $('#itemTableBody').on('click','.remove-item', function(){
        var rowId = $(this).attr('id');
        var newTotal = parseInt($('td span#totalId').text()) - parseInt($('td#tdTotalId'+rowId).text());
        $('#totalId').html(newTotal);
        $(this).closest('tr').remove();
        items.splice(rowId, 1);
        return false;
    });

    // add service items
    $('#addPoItem').click(function(e){
        // e.preventDefault();

        var data = {
            'service' : $('select#service').val(),
            'description' : $('textarea#description').val(),
            'quantity' : $('input#quantity').val(),
            'rate' : $('input#rate').val(),
            'tax' : $('select#tax').val()
        }
        
        $('#itemTableBody').append(
            "<tr style=\"text-align:center;\" id=\"row"+ count +"\"><td>"
                        + data['service'] + "</td><td>"  
                        + data['description'] + "</td><td>"
                        + data['quantity'] + "</td><td>" 
                        + data['rate'] + "</td><td>" 
                        + data['tax'] + "</td><td id=\"tdTotalId" + count + "\" >" 
                        + (parseInt(data['quantity']) * parseInt(data['rate'])) + "</td><td>"
                        + "<a  id=\""+ count + "\" class=\"btn btn-xs btn-danger remove-item\"><i class=\"fa fa-trash\"></i></a>" + 
                        "</td></tr>"
                        ); 
        count ++;
        var gtotal = parseInt($('td span#totalId').text()) + (parseInt(data['quantity']) * parseInt(data['rate']));
        $('#totalId').html(gtotal);
        items.push(data);          
    });

    // submit po form
    var quotationPoForm = $('#quotationPo');
    quotationPoForm.on('submit',function(e){
        e.preventDefault();

        // var form = $(this);
        quotationPoForm.parsley().validate();
        if(quotationPoForm.parsley().isValid()){

        $('#savePo').html('... Saving Purchase Order').attr('disabled', true);

        var poData = quotationPoForm.serializeArray().reduce(function(obj, item){
        obj[item.name] = item.value;
        return obj;
        },{});

        // add po items
        poData['purchase_order_items'] = items;

        axios.post('{{ route('save-po',['id'=>$dms]) }}', poData)
        .then(function(response){
            window.location.replace('{{ route('edit-bill-of-landing',['id'=>$dms,'budget'=>'true' ]) }}');
        })
        .catch(function(errors){
            console.log(errors.response);
            $('#savePo').html('Save Purchase Order').attr('disabled', false);
        });

        }     
    });

});
    
</script>

@endsection