<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title></title>
    <link href="{{ public_path('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
</head>

<body>

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div style="margin-bottom:20px text-center"><img src="{{ public_path('images/logo.png') }}" alt=""></div>

                <div class="d-flex justify-content-between">
                    <div>
                            <div>Cannon Towers </div>
                            <div>6th Floor, Moi Avenue Mombasa - Kenya</div>
                            <div>Phone: +254 41 2229784</div>
                            <div>Email: agency@esl-eastafrica.com/ops@esl-eastafrica.com</div>
                            <div>Web: www.esl-eastafrica.com</div>
                            <br/>
                            <div>Tax Registration: 0121303W </div>
                            <div>Telephone: +254 41 2229784</div>
                    </div>

                    <div class="text-right">
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

                </div>

                </div>
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
                            </div>


                            <div style="margin-top:40px;">

                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div><strong>Prepared by</strong> : <span class="text-capitalize"> {{ $po->user->name }}</span></div>
                            <div><strong>Approval</strong> : <span class="text-uppercase"> {{ $po->status }}</span></div>
                            <div><strong>Date</strong> : <span>{{ \Carbon\Carbon::parse($po->created_at)->format('d-m-Y') }} </span></div>

                        </div>
                        <div class="col-sm-12 col-md-6 text-right">
                            <p>Total(Excl) {{ $po->input_currency }} : {{ $po->purchaseOrderItems->sum( function($item){ return
                                ($item->quantity * $item->rate); }) }}</p>
                            <p>Total Tax {{ $po->input_currency }} : {{ $po->purchaseOrderItems->sum( function($item){ return
                                (($item->quantity * $item->rate) * ($item->tax * 0.01)); }) }}</p>
                            <p class="font-weight-bold">Total(Incl){{ $po->input_currency }} : {{ $po->purchaseOrderItems->sum( function($item){ return
                                ($item->quantity * $item->rate) - (($item->quantity * $item->rate) * ($item->tax * 0.01));
                                }) }} </p>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

</body>

</html>