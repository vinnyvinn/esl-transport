<div class="form-row">
    <div class="col">
        <div class="form-group">
            <label for="voyage_name">Voyage Name</label>
            <input type="text" required id="voyage_name" name="voyage_name" class="form-control" 
            placeholder="Name" value="{{ $quotation->voyage->voyage_name  or "" }}">
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label for="service_code">Service Code</label>
            <input type="text" required id="service_code" name="service_code" class="form-control" 
            placeholder="Service Code" value="{{ $quotation->voyage->service_code  or "" }}">
        </div>
    </div>

</div>

<div class="form-row">
        <div class="col">
            <div class="form-group">
                <label for="name">External Voyage No.</label>
                <input type="text" required id="voyage_no" name="voyage_no" class="form-control" 
                placeholder="Voyage No." value="{{ $quotation->voyage->voyage_no  or "" }}">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="name">Internal Voyage No.</label>
                <input type="text" required id="internal_voyage_no" name="internal_voyage_no" class="form-control" 
                placeholder="Internal Voyage No." value="{{ $quotation->voyage->internal_voyage_no  or "" }}">
            </div>
        </div>
    
    </div>

<div class="form-row">
    <div class="col">
        <div class="form-group">
            <label for="final_destination">Final Destination</label>
            <input type="text" required id="final_destination" name="final_destination" class="form-control" 
            placeholder="Final Destination" value="{{ $quotation->voyage->final_destination  or "" }}">
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label for="eta"> ETA </label>
            <input type="text" id="eta" required name="eta" class="datepicker form-control" 
            placeholder="ETA" value="{{ $quotation->voyage->eta or "" }}">
        </div>
    </div>
</div>