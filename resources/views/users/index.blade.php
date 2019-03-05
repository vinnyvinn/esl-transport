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
                        <h4 class="card-title">Users
                                <span class="pull-right"><button data-toggle="modal" data-target=".add-user-modal" class="btn btn-primary">
                                                                        Add Users
                                                                    </button></span>
                             

                        {{-- add user modal start --}}
                        <div class="modal fade add-user-modal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true"
                            style="display: none;">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="addUserModalLabel">Add Users</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-material" method="POST" action="{{ route('users.store') }}">
                                            {{ csrf_field() }}
                                            @include('includes.user_form')
                                            <div style="text-align:right">
                                                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                                <input class="btn  btn-primary" type="submit" value="Add New User">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                                            {{-- add user modal end --}}

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Department</th>
                                    <th class="text-center">Created</th>
                                    <th class="text-center" class="text-nowrap">Action</th>
                                </tr>
                                </thead>
                                <tbody id="customers">
                                @foreach($users as $user)
                                    <tr>
                                        <td class="text-center">{{ ucwords($user->fname.' '.$user->lname) }}</td>
                                        <td class="text-center">{{ $user->email }}</td>
                                        <td class="text-center">{{ ucfirst($user->department) or "" }}</td>
                                        <td class="text-center"></td>
                                        {{-- <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d-m-Y') }}</td> --}}
                                        <td class="text-center">


                                                <div style="display:flex; flex-flow:row;justify-content:center">
                                                        <button data-toggle="modal" data-target=".user-edit-modal{{ $user->id }}" class="btn btn-sm btn-warning">
                                                                <i class="fa fa-pencil"></i>
                                                            </button>
                                                            <span style="width:10px;background:transparent"></span>
                                                            <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                                                    {{ csrf_field() }}
                                                                    {{ method_field('DELETE') }}
                                                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                                                </form>

                                                </div>
                                                {{-- flex div end --}}
                                        </td>

                                        {{-- user edit modal start --}}
                                    <div class="modal fade user-edit-modal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="userEditModalLabel" aria-hidden="true"
                                        style="display: none;">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="userEditModalLabel">Edit User</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                <form class="form-material" method="POST" action="{{ route('users.update',$user->id) }}">
                                                        {{ csrf_field() }}
                                                        {{ method_field('PUT') }}                                                                                                              

                                                        @include('includes.user_form')
                                                        <div style="text-align:right">
                                                            <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                                            <input class="btn  btn-primary" type="submit" value="Update User Details">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- user edit modal end --}}
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