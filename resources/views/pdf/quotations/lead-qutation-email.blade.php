<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title></title>
    <link href="{{ public_path('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
</head>

<body>

    <div class="container-fluid">

            <div class="container-fluid">
                    <div class="">
                            <div class="m-t-20">
                                    <div class="row">
                                            {{-- logo --}}
                                            <div class="col-sm-3">
                                                    <img src="{{ public_path('images/logo.png') }}" alt="">
                                            </div>
                                        
                                            {{-- company details --}}
                                            <div class="col-sm-6">
                                                <div>Express Shipping & Logistics (EA) Limited</div>
                                                <div>Cannon Towers </div>
                                                <div>6th Floor, Moi Avenue Mombasa</div>
                                                <div>Kenya</div>
                                                <div>Phone: +254 41 2229784</div>
                                                <div>Email: agency@esl-eastafrica.com/ops@esl-eastafrica.com</div>
                                            </div>
                                        
                                            {{-- drafts --}}
                                            <div class="col-sm-3">
                                                    <div>Tax Registration: 0121303W</div>
                                                    <div>Currency Code: {{ $quotation->lead->currency or \Esl\helpers\Constants::DEFAULT_CURRENCY}}</div>
                                                    <div>Date: {{ \Carbon\Carbon::parse($quotation->created_at)->format('d-M-y') }}</div>
                                            </div>
                                            <div>
                                            </div>
                                        </div>
                            </div>
            
                           
                            <div class="row m-t-40">
                                    <div class="col-sm-6">
                                        <div class="heading-lines"></div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div>{{ $quotation->status == \Esl\helpers\Constants::LEAD_QUOTATION_CONVERTED ? 'FDA' : 'PROFORMA DISBURSEMENT ACCOUNT'
                                                }}</div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="heading-lines"></div>
                                    </div>
                                </div>
            
                            
                            <div class="m-t-40">
                                    <div class="row">
                                            <div class="col-sm-12">
                                                <div>To: {{ $quotation->lead->name or  "" }}</div>
                                                <div>Contact Person : {{ $quotation->lead->contact_person or "" }}</div>
                                                <div>
                                                    <div class="row">
                                                        <div class="col-sm-2">Tel: {{ $quotation->lead->telephone or ""}}</div>
                                                        <div class="col-sm-3">Email: {{ $quotation->lead->email or ""}}</div>
                                                        <div class="col-sm-2">Phone: {{ $quotation->lead->phone or ""}}</div>
                                                    </div>
                                            </div>
                                        </div>
                            </div>
                            
                            <div class="m-t-40">
                                    <div class="col-sm-12">Voyage Details</div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-2"><span>Voyage Name</span></div>
                                                <div class="col-sm-2">{{ $quotation->voyage->voyage_name or "" }}</div>
                                                <div class="col-sm-2"><span>Port</span></div>
                                                <div class="col-sm-2">{{ $quotation->vessel->port_of_discharge or "" }}</div>
                                                <div class="col-sm-2"><span>Loa</span></div>
                                                <div class="col-sm-2">{{ $quotation->vessel->loa or "" }}</div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-2"><span>Voyage No</span></div>
                                                <div class="col-sm-2">{{ $quotation->voyage->voyage_no or "" }}</div>
                                                <div class="col-sm-2"><span>Vessel</span></div>
                                                <div class="col-sm-2">{{ $quotation->vessel->name or "" }}</div>
                                                <div class="col-sm-2"><span>GRT</span></div>
                                                <div class="col-sm-2">{{ $quotation->vessel->grt or "" }}</div>
                                    
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            
                            <div class="m-t-40">
                                    <div>Cargos</div>
    <div>
        <table id="mytable" class="table table-bordred table-striped">
            <thead>
                <tr>
                <th>Name</th>
                <th>Good Type</th>
                <th>Consignee</th>
                <th>Cargo Quantity (MT)</th>
                <th>Discharge Rate (MT / WWD)</th>
                <th>Port Stay (Days)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($quotation->cargos as $cargo)
                <tr>
                    <td>{{ $cargo->cargo_name or "" }}</td>
                    <td>Irshad</td>
                    <td>{{ $cargo->consignee_name }}</td>
                    <td>{{ $cargo->weight }}</td>
                    <td>{{ $cargo->discharge_rate }}</td>
                    <td>{{ ceil(($cargo->weight)/$cargo->discharge_rate) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
                            </div>
            
                            
                            <div class="m-t-40">
                                    <div>Services</div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordred table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Description</th>
                                                            <th class="text-center">GRT/LOA</th>
                                                            <th class="text-center">RATE</th>
                                                            <th class="text-center">UNITS</th>
                                                            <th class="text-center">Tax</th>
                                                            <th class="text-center">Total (Incl)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="q_service">
                                                        @foreach($quotation->services as $service)
                                                        <tr>
                                                            <td>{{ ucwords($service->description) }}</td>
                                                            <td class="text-center">{{ $service->grt_loa }}</td>
                                                            <td class="text-center">{{ $service->rate }}</td>
                                                            <td class="text-center">{{ $service->units }}</td>
                                                            <td class="text-center">{{ $service->tax }}</td>
                                                            <td class="text-center">{{ number_format($service->total) }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-8"></div>
                                                <div class="col-sm-4">
                                                    <div class="row">
                                                        <div class="col-sm-6 text-right"> <span>Total (Excl) {{$quotation->lead->currency }}</span> :</div>
                                                        <div class="col-sm-6 text-right"> <span>{{ number_format($quotation->services->sum('total')) }}</span></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6 text-right"> <span>Tax {{$quotation->lead->currency }}</span> :</div>
                                                        <div class="col-sm-6 text-right"> <span>{{ number_format($quotation->services->sum('total_tax')) }}</span></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6 text-right"> <span>Total (Incl) {{$quotation->lead->currency }}</span> :</div>
                                                        <div class="col-sm-6 text-right"> <span>{{ number_format($quotation->services->sum('total')) }}</span></div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-sm-6 text-right"> <span>Total (Incl) {{$quotation->lead->currency }}</span> :</div>
                                                        <div class="col-sm-6 text-right"> <span>{{ number_format($quotation->services->sum('total')) }}</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
            
                           
                            <hr>
                            <div class="m-t-40">
                                    <div>Remarks</div>
                                    <div class="col-sm-12">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th width="50%">Remarks</th>
                                                    <th class="text-center">Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($quotation->remarks->sortByDesc('created_at') as $remark)
                                                <tr>
                                                    <td>{{ ucwords($remark->user->name) }}</td>
                                                    <td width="50%">{{ ucfirst($remark->remark) }}</td>
                                                    <td class="text-center">{{ \Carbon\Carbon::parse($remark->created_at)->format('d-M-y') }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                            </div>
                            
                    </div>
                </div>

    </div>

</body>
</html>