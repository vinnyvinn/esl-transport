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
                        <h4 class="card-title">Departments
                                <span class="pull-right"><button data-toggle="modal" data-target=".add-department-modal" class="btn btn-primary">
                                                                        Add Department
                                                                    </button></span>
                             

                        {{-- add department modal start --}}
                        <div class="modal fade add-department-modal" tabindex="-1" role="dialog" aria-labelledby="addDepartmentModalLabel" aria-hidden="true"
                            style="display: none;">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="addDepartmentModalLabel">Add Department</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-material" method="POST" action="{{ route('departments.store') }}">
                                            {{ csrf_field() }}
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" required id="name" name="name" class="form-control" placeholder="Name">
                                                    </div>
                                                </div>
                        
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="description">Description</label>
                                                        <textarea name="description" id="description" cols="30" rows="3" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                        
                                            <div style="text-align:right">
                                                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                                <input class="btn  btn-primary" type="submit" value="Add Department">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                                            {{-- add department modal end --}}

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Created</th>
                                    <th class="text-nowrap">Action</th>
                                </tr>
                                </thead>
                                <tbody id="customers">
                                @foreach($departments as $department)
                                    <tr>
                                        <td>{{ ucwords($department->name) }}</td>
                                        <td>{{ ucfirst($department->description) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($department->created_at)->format('d-M-y') }}</td>
                                        <td class="text-center">


                                                <div style="display:flex; flex-flow:row;justify-content:center">
                                                        <button data-toggle="modal" data-target=".department-edit-modal{{ $department->id }}" class="btn btn-sm btn-warning">
                                                                <i class="fa fa-pencil"></i>
                                                            </button>
                                                            <div style="width:10px;"></div>

                                                            <form action="{{ route('departments.destroy', $department->id) }}" method="post">
                                                                    {{ csrf_field() }}
                                                                    {{ method_field('DELETE') }}
                                                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                                                </form>

                                                </div>
                                                {{-- flex div end --}}
                                        </td>

                                        {{-- department edit modal start --}}
                                    <div class="modal fade department-edit-modal{{ $department->id }}" tabindex="-1" role="dialog" aria-labelledby="departmentEditModalLabel" aria-hidden="true"
                                        style="display: none;">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="departmentEditModalLabel">Edit Department</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                <form class="form-material" method="POST" action="{{ route('departments.update',$department->id) }}">
                                                        {{ csrf_field() }}
                                                        {{ method_field('PUT') }}
                                                        <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <label for="name">Name</label>
                                                                        <input type="text" required id="name" name="name" class="form-control" placeholder="Name" value="{{ $department->name}}">
                                                                    </div>
                                                                </div>
                                        
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <label for="description">Description</label>
                                                                        <textarea name="description" id="description" cols="30" rows="3" class="form-control">{{ $department->description}}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>                                                        

                                                        <div style="text-align:right">
                                                            <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                                            <input class="btn  btn-primary" type="submit" value="Update Department">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- department edit modal end --}}
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="footable pagination">
                                {{ $departments->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection