
        <div class="form-row">
            <div class="col">
                <label for="cargo_name">Cargo Name</label>
                <input type="text" required id="cargo_name" name="cargo_name" class="form-control" placeholder="Cargo Name">
            </div>
        </div><br/>
        
        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="good_type_id">Good Type</label><br/>
                    <select name="good_type_id" id="country_of_loading" style="width:100%" class="select2 form-control">
                                <option value="">Select Good Type</option>
                                @foreach(\App\GoodType::all() as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="manifest_number">Manifest Number</label>
                    <input type="text" required id="manifest_number" name="manifest_number" class="form-control" placeholder="Manifest Number">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="seal_no">Seal No.</label>
                    <input type="text" required id="seal_no" name="seal_no" class="form-control" placeholder="Seal No.">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" required id="description" name="description" class="form-control" placeholder="Description">
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
                            <option value="{{$value->id}}">{{$value->name}}</option>
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
                                    <option value="{{$value->id}}">{{$value->shipping_type_name}}</option>
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
                            <option value="{{$value->id}}">{{$value->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="case_qty">Case QTY</label>
                    <input type="text" required id="case_qty" name="case_qty" class="form-control" placeholder="Case QTY">
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="t_net_weight">Total Net Weight</label>
                    <input type="text" required id="t_net_weight" name="t_net_weight" class="form-control" placeholder="Total Net Weight">
                </div>
            </div>
            <div class="col">

                <div class="form-group">
                    <label for="t_gross_weight">Total Gross Weight</label>
                    <input type="text" required id="t_gross_weight" name="t_gross_weight" class="form-control" placeholder="Total Gross Weight">
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="package">Package</label>
                    <input type="text" required id="package" name="package" class="form-control" placeholder="Package">
                </div>
            </div>
            <div class="col">

                <div class="form-group">
                    <label for="weight">Weight</label>
                    <input type="text" required id="weight" name="weight" class="form-control" placeholder="Weight">
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="total_package">Total Package</label>
                    <input type="text" required id="total_package" name="total_package" class="form-control" placeholder="Total Package">
                </div>
            </div>
            <div class="col">

                <div class="form-group">
                    <label for="discharge_rate">Discharge Rate</label>
                    <input type="text" required id="discharge_rate" name="discharge_rate" class="form-control" placeholder="Discharge Rate">
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="shipper">Shipper</label>
                    <input type="text" required id="shipper" name="shipper" class="form-control" placeholder="Shipper">
                </div>
            </div>
            <div class="col">

                <div class="form-group">
                    <label for="shipping_line">Shipping Line</label>
                    <input type="text" required id="shipping_line" name="shipping_line" class="form-control" placeholder="Shipping Line">
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="notifying_address">Notifying Address</label>
                    <input type="text" required id="notifying_address" name="notifying_address" class="form-control" placeholder="Notifying Address">
                </div>
            </div>
            <div class="col">
                    <label for="remarks">Remarks</label>
                <div class="form-group">
                    <input type="text" required id="remarks" name="remarks" class="form-control" placeholder="Remarks">
                </div>
            </div>
        </div>