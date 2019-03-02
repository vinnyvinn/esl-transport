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