
        <div class="form-row">
            <div class="col">
                <label for="cargo_name">Cargo Name</label>
                <input type="text" required id="cargo_name" name="cargo_name" class="form-control" 
                placeholder="Cargo Name" value="{{ $cargoMod->cargo_name or ""}}">
            </div>
        </div><br/>
        
        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="good_type_id">Good Type</label><br/>
                    <select name="good_type_id" id="good_type_id" style="width:100%" class="select2 form-control">
                                <option value="">Select Good Type</option>
                                @foreach(\App\GoodType::all() as $value)
                                    <option value="{{$value->id}}" 
                                        {{ $value->id == !empty($cargoMod->good_type_id) ? 'selected = "selected"':''}} 
                                        >{{$value->name}}</option>
                                @endforeach
                            </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="manifest_number">Manifest Number</label>
                    <input type="text" required id="manifest_number" name="manifest_number" class="form-control" 
                    placeholder="Manifest Number" value="{{ $cargoMod->manifest_number or "" }}">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="seal_no">Seal No.</label>
                    <input type="text" required id="seal_no" name="seal_no" class="form-control" 
                    placeholder="Seal No." value="{{ $cargoMod->seal_no or "" }}">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" required id="description" name="description" class="form-control"
                    placeholder="Description" value="{{ $cargoMod->description or "" }}">
                </div>
            </div>

        </div>
        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="type">Type</label>
                    <select name="type" id="type" style="width:100%" class="select2 form-control">
                        <option value="">Select Type</option>
                        @foreach(\App\CargoTypes::all() as $value)
                            <option value="{{$value->id}}"
                                {{ $value->id == !empty($cargoMod->type) ? 'selected = "selected"':''}}
                                >{{$value->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col">

                    <div class="form-group">
                            <label for="shipping_type">Shipping Type</label>
                            <select name="shipping_type" id="shipping_type" style="width:100%" class="select2 form-control">
                                <option value="">Select Shipping Types</option>
                                @foreach(\App\ShippingTypes::all() as $value)
                                    <option value="{{$value->id}}"
                                        {{ $value->id == !empty($cargoMod->shipping_type) ? 'selected = "selected"':''}}
                                        >{{$value->shipping_type_name}}</option>
                                @endforeach
                            </select>
                        </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="country_of_loading">Container</label>
                    <select name="container_id" id="container_id" style="width:100%" class="select2 form-control">
                        <option value="">Select Container</option>
                        @foreach(\App\Container::all() as $value)
                            <option value="{{$value->id}}"
                                {{ $value->id == !empty($cargoMod->container_id) ? 'selected = "selected"':''}}
                                >{{$value->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="case_qty">Case QTY</label>
                    <input type="text" required id="case_qty" name="case_qty" class="form-control" 
                    placeholder="Case QTY" value="{{ $cargoMod->case_qty or "" }}">
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="t_net_weight">Total Net Weight</label>
                    <input type="text" required id="t_net_weight" name="t_net_weight" class="form-control" 
                    placeholder="Total Net Weight" value="{{ $cargoMod->t_net_weight or "" }}">
                </div>
            </div>
            <div class="col">

                <div class="form-group">
                    <label for="t_gross_weight">Total Gross Weight</label>
                    <input type="text" required id="t_gross_weight" name="t_gross_weight" class="form-control" 
                    placeholder="Total Gross Weight" value="{{ $cargoMod->t_gross_weight or "" }}">
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="package">Package</label>
                    <input type="text" required id="package" name="package" class="form-control" 
                    placeholder="Package" value="{{ $cargoMod->package or "" }}">
                </div>
            </div>
            <div class="col">

                <div class="form-group">
                    <label for="weight">Weight</label>
                    <input type="text" required id="weight" name="weight" class="form-control" 
                    placeholder="Weight" value="{{ $cargoMod->weight or "" }}">
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="total_package">Total Package</label>
                    <input type="text" required id="total_package" name="total_package" class="form-control" 
                    placeholder="Total Package" value="{{ $cargoMod->total_package or "" }}">
                </div>
            </div>
            <div class="col">

                <div class="form-group">
                    <label for="discharge_rate">Discharge Rate</label>
                    <input type="text" required id="discharge_rate" name="discharge_rate" class="form-control" 
                    placeholder="Discharge Rate" value="{{ $cargoMod->discharge_rate or "" }}">
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="shipper">Shipper</label>
                    <input type="text" required id="shipper" name="shipper" class="form-control" 
                    placeholder="Shipper" value="{{ $cargoMod->shipper or "" }}">
                </div>
            </div>
            <div class="col">

                <div class="form-group">
                    <label for="shipping_line">Shipping Line</label>
                    <input type="text" required id="shipping_line" name="shipping_line" class="form-control" 
                    placeholder="Shipping Line" value="{{ $cargoMod->shipping_line or "" }}">
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="notifying_address">Notifying Address</label>
                    <input type="text" required id="notifying_address" name="notifying_address" class="form-control" 
                    placeholder="Notifying Address" value="{{ $cargoMod->notifying_address or "" }}">
                </div>
            </div>
            <div class="col">
                    <label for="remarks">Remarks</label>
                <div class="form-group">
                    <input type="text" required id="remarks" name="remarks" class="form-control" 
                    placeholder="Remarks" value="{{ $cargoMod->remarks or "" }}">
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="consignee_name">Consignee Name</label>
                    <input type="text" required id="consignee_name" name="consignee_name" class="form-control" 
                    placeholder="Consignee Name" value="{{ $cargoMod->consignee_name or "" }}">
                </div>
            </div>
            <div class="col">
                    <label for="consignee_address">Consignee Address</label>
                <div class="form-group">
                    <input type="text" required id="consignee_address" name="consignee_address" class="form-control" 
                    placeholder="Consignee Address" value="{{ $cargoMod->consignee_address or "" }}">
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col">
                    <label for="consignee_email">Consignee Email</label>
                <div class="form-group">
                    <input type="email" required id="consignee_email" name="consignee_email" class="form-control" 
                    placeholder="Consignee Email" value="{{ $cargoMod->consignee_email or "" }}">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="consignee_telephone">Consignee Telephone</label>
                    <input type="text" required id="consignee_telephone" name="consignee_telephone" class="form-control" 
                    placeholder="Consignee Telephone" value="{{ $cargoMod->consignee_telephone or "" }}">
                </div>
            </div>
        </div>