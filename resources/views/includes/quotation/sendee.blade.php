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