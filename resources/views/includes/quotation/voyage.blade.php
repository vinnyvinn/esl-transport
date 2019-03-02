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