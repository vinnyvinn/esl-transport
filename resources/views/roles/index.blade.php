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
                        <h4 class="card-title">User Roles
                                <span class="pull-right"><button data-toggle="modal" data-target=".add-role-modal" class="btn btn-primary">
                                                                        Add Role
                                                                    </button></span>
                             

                        {{-- add role modal start --}}
                        <div class="modal fade add-role-modal" tabindex="-1" role="dialog" aria-labelledby="addRoleModalLabel" aria-hidden="true"
                            style="display: none;">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="addRoleModalLabel">Add Role</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-material" method="POST" action="{{ route('roles.store') }}">
                                            {{ csrf_field() }}
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" required id="name" name="name" class="form-control" placeholder="Name">
                                                    </div>
                                                </div>
                                                
                                            </div>
                        
                                            <div style="text-align:right">
                                                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                                <input class="btn  btn-primary" type="submit" value="Add Role">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                                            {{-- add role modal end --}}

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Created</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody id="customers">
                                @foreach($roles as $role)
                                    <tr>
                                        <td class="text-center">{{ ucwords($role->name) }}</td>
                                        <td class="text-center">{{ \Carbon\Carbon::parse($role->created_at)->format('d-M-y') }}</td>
                                        <td class="text-center">


                                                <div style="display:flex; flex-flow:row;justify-content:center">
                                                        <button data-toggle="modal" data-target=".role-edit-modal{{ $role->id }}" class="btn btn-sm btn-warning">
                                                                <i class="fa fa-pencil"></i>
                                                            </button>
                                                            <span style="width:10px;background:transparent"></span>
                                                            <form action="{{ route('roles.destroy', $role->id) }}" method="post">
                                                                    {{ csrf_field() }}
                                                                    {{ method_field('DELETE') }}
                                                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                                                </form>

                                                </div>
                                                {{-- flex div end --}}
                                        </td>

                                        {{-- role edit modal start --}}
                                    <div class="modal fade role-edit-modal{{ $role->id }}" tabindex="-1" role="dialog" aria-labelledby="roleEditModalLabel" aria-hidden="true"
                                        style="display: none;">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="roleEditModalLabel">Edit Role</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                <form class="form-material" method="POST" action="{{ route('roles.update',$role->id) }}">
                                                        {{ csrf_field() }}
                                                        {{ method_field('PUT') }}
                                                        <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <label for="name">Name</label>
                                                                        <input type="text" required id="name" name="name" class="form-control" placeholder="Name" value="{{ $role->name}}">
                                                                    </div>
                                                                </div>
                                                            </div>                                                        

                                                        <div style="text-align:right">
                                                            <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                                            <input class="btn  btn-primary" type="submit" value="Update role">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- role edit modal end --}}
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection