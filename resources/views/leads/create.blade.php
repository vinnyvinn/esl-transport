@extends('layouts.main')
@section('content')
    <div class="row page-titles m-b-0">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Dashboard</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div>
        <div>
            <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Leads</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    Search : <input type="text" id="search_lead">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Contact Person</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Telephone</th>
                                    <th>Physical Location</th>
                                    <th>Created</th>
                                    <th class="text-nowrap">Action</th>
                                </tr>
                                </thead>
                                <tbody id="customers">
                                @foreach($leads as $lead)
                                    <tr>
                                        <td>{{ ucwords($customer->Name) }}</td>
                                        <td>{{ ucfirst($customer->Contact_Person) }}</td>
                                        <td>{{ $customer->Account }}</td>
                                        <td>
                                            {{ $customer->Telephone }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="footable pagination">
                                {{ $customers->links() }}
                            </div>
                        </div>
                    </div>search_lead
                </div>
            </div>
        </div>
    </div>
@endsection

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Basic Material inputs</h4>
        <h6 class="card-subtitle">Just add <code>form-material</code> class to the form that's it.</h6>
        <form class="form-material m-t-40">
            <div class="form-group">
                <label>Default Text <span class="help"> e.g. "George deo"</span></label>
                <input type="text" class="form-control form-control-line" value="Some text value..."> </div>
            <div class="form-group">
                <label for="example-email">Email <span class="help"> e.g. "example@gmail.com"</span></label>
                <input type="email" id="example-email2" name="example-email" class="form-control" placeholder="Email"> </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" value="password"> </div>
            <div class="form-group">
                <label>Placeholder</label>
                <input type="text" class="form-control" placeholder="placeholder"> </div>
            <div class="form-group">
                <label>Text area</label>
                <textarea class="form-control" rows="5"></textarea>
            </div>
            <div class="form-group">
                <label>Input Select</label>
                <select class="form-control">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>
            <div class="form-group">
                <label>File upload</label>
                <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                    <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div> <span class="input-group-addon btn btn-default btn-file"> <span class="fileinput-new">Select file</span> <span class="fileinput-exists">Change</span>
                                            <input type="hidden">
                                            <input type="file" name="..."> </span> <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a> </div>
            </div>
            <div class="form-group">
                <label>Helping text</label>
                <input type="text" class="form-control form-control-line"> <span class="help-block text-muted"><small>A block of help text that breaks onto a new line and may extend beyond one line.</small></span> </div>
        </form>
    </div>
</div>