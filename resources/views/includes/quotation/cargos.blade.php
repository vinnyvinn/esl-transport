    <div>Cargos</div>
    <div>
        <table id="mytable" class="table table-bordred table-striped">
            <thead>
                <th>Name</th>
                <th>Good Type</th>
                <th>Consignee</th>
                <th>Cargo Quantity (MT)</th>
                <th>Discharge Rate (MT / WWD)</th>
                <th>Port Stay (Days)</th>
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