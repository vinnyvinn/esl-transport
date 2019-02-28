<div class="form-row">
    <div class="col">
        <div class="form-group">
            <label for="name">Vessel Name</label>
            <input type="text" required id="name" name="name" class="form-control" 
            placeholder="Name" value="{{ $quotation->vessel->name or ""}}" size=50>
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label for="port_of_loading"> Port of Loading</label>
            <input type="text" id="port_of_loading" required name="port_of_loading" class="form-control" placeholder="Port of Loading"
                value="{{ $quotation->vessel->port_of_loading or ""}}">
        </div>
    </div>
</div>

<div class="form-row">
    <div class="col">
        <div class="form-group">
            <label for="call_sign">Call Sign</label>
            <input type="text" id="call_sign" name="call_sign" class="form-control" placeholder="Call Sign" value="{{ $quotation->vessel->call_sign
            or ""}}">
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label for="imo_number">IMO Number </label>
            <input type="text" id="imo_number" name="imo_number" class="form-control" placeholder="IMO Number" value="{{ $quotation->vessel->imo_number
            or ""}}">
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col">
        <div class="form-group">
            <label for="country">Country (Vessel Flag) </label><br/>
            <select name="country" id="country" class="select2 form-control" style="width:100%;">
                                <option value="">Select Country</option>
                                @foreach(\Esl\helpers\Constants::COUNTRY_LIST as $value)
                                @if(!empty($quotation->vessel->country))
                                    <option value="{{ $quotation->vessel->country }}" 
                                        selected="selected">{{ $quotation->vessel->country }}</option>
                                @endif
                                    <option value="{{$value}}"
                                    >{{$value}}</option>
                                @endforeach
                            </select>
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label for="country_of_discharge"> Country of Discharge</label>
            <select name="country_of_discharge" id="country_of_discharge" class="select2 form-control" style="width:100%;">
                                <option value="">Select Country</option>
                                @foreach(\Esl\helpers\Constants::COUNTRY_LIST as $value)
                                @if(!empty($quotation->vessel->country_of_discharge))
                                    <option value="{{ $quotation->vessel->country_of_discharge }}" 
                                        selected="selected">{{ $quotation->vessel->country_of_discharge }}</option>
                                @endif
                                    <option value="{{$value}}"
                                    >{{$value}}</option>
                                @endforeach
                            </select>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col">
        <div class="form-group">
            <label for="country_of_loading"> Country of Loading</label>
            <select name="country_of_loading" id="country_of_loading" class="select2 form-control" style="width:100%;">
                                <option value="">Select Country</option>
                                @foreach(\Esl\helpers\Constants::COUNTRY_LIST as $value)
                                @if(!empty($quotation->vessel->country_of_loading))
                                <option value="{{ $quotation->vessel->country_of_loading }}" 
                                    selected="selected">{{ $quotation->vessel->country_of_loading }}</option>
                                @endif
                                    <option value="{{$value}}"
                                    >{{$value}}</option>
                                @endforeach
                            </select>
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label for="port_of_discharge"> Port of Discharge</label>
            <input type="text" id="port_of_discharge" required name="port_of_discharge" class="form-control" placeholder="Port of Discharge"
                value="{{ $quotation->vessel->port_of_discharge or ""}}">
        </div>
    </div>
</div>

<div class="form-row">
    <div class="col">
        <div class="form-group">
            <label for="loa">Length Over All </label>
            <input type="number" id="loa" name="loa" required class="form-control" placeholder="Length Over All" 
            value="{{ $quotation->vessel->loa
            or ""}}">
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label for="grt">Gross Tonnage  GRT</label>
            <input type="number" id="grt" name="grt" class="form-control" placeholder="Gross Tonnage" 
            value="{{ $quotation->vessel->grt
            or ""}}">
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col">
        <div class="form-group">
            <label for="dwt"> Dead Weight - including provision</label>
            <input type="text" id="dwt" name="dwt" class="form-control" placeholder="Dead Weight - including provision" value="{{ $quotation->vessel->dwt
            or ""}}">
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label for="nrt"> Net Tonnage</label>
            <input type="text" id="nrt" name="nrt" class="form-control" placeholder="Net Tonnage" value="{{ $quotation->vessel->nrt
            or ""}}">
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col">
        <div class="form-group">
            <label for="eta"> ETA </label>
            <input type="text" id="eta" required name="eta" class="datepicker form-control" placeholder="ETA" value="{{ $quotation->vessel->eta
            or ""}}">
        </div>
    </div>
    <div class="col"></div>
</div>