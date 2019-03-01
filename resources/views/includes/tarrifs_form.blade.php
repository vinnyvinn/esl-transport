<div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <select name="tariff" onchange="perday(this)" required id="tariff" class="form-control select2" style="width:100%;">
                @foreach($tariffs as $tariff)
                    <option value="{{$tariff}}">{{ ucwords($tariff->name) }} ~ {{ ucwords($tariff->unit) }}({{$tariff->unit_value}}) @ {{ $tariff->rate }}</option>
                @endforeach
            </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <input type="number" required id="service_units" name="service_units" placeholder="Units" class="form-control">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <select name="tax" required id="tax" class="form-control select2" style="width:100%;">
                @foreach($taxs as $tax)
                    <option value="{{$tax}}">{{ ucwords($tax->Description) }} - {{ $tax->TaxRate }} %</option>
                @endforeach
            </select>
                    </div>
                </div>
                <div class="col-sm-1">
                    <div class="btn btn-block btn-primary" onclick="addTariff()"><i class="fa fa-check"></i></div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <table class="table table-striped table-responsive">
                <thead>
                    <tr>
                        <tr>
                            <th>Description</th>
                            <th class="text-right">GRT/LOA</th>
                            <th class="text-right">RATE</th>
                            <th class="text-right">UNITS</th>
                            <th class="text-right">Tax</th>
                            <th class="text-right">Total (Incl)</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </tr>
                </thead>
                <tbody id="service">
                </tbody>
            </table>
        </div>
    </div>