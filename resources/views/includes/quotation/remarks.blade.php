<div>Remarks</div>
<div class="col-sm-12">
    <table class="table table-responsive table-striped">
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