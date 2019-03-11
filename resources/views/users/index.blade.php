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

                                        <form id="register_user" novalidate>
                                            {{ csrf_field() }}
                                            @include('includes.user_form')
                                            <div style="text-align:right">
                                                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" id="saveUser">Add New User</button>
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
                                    <th class="text-center">Role</th>
                                    <th class="text-center">Department</th>
                                    <th class="text-center">Created</th>
                                    <th class="text-center" class="text-nowrap">Action</th>
                                </tr>
                                </thead>
                                <tbody id="customers">
                                @foreach($users as $user)                                
                                    <tr>
                                        <td class="text-center">{{ ucwords($user->fname.' '.$user->lname) }}</td>
                                        <td class="text-center">{{ $user->email or "" }}</td>
                                        <td class="text-center text-capitalize">{{ $user->getRoleNames()->first() }}</td>
                                        <td class="text-center text-capitalize">{{ $user->department->name or "" }}</td>
                                        <td class="text-center">{{ \Carbon\Carbon::parse($user->created_at)->format('d-m-Y') }}</td>
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

                                                <form id="update_user-{{ $user->id }}">
                                                        {{ csrf_field() }}
                                                        {{ method_field('PUT') }}     

                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="form-group">
                                                                            <label for="name">First Name</label>
                                                                            <input type="text" required id="fname" name="fname" class="form-control" placeholder="First Name" 
                                                                            value="{{$user->fname or "" }}">
                                                                            <p id="fname_error_{{ $user->id }}" class="esl-user-form-error"></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="form-group">
                                                                            <label for="name">Last Name</label>
                                                                            <input type="text" required id="lname" name="lname" class="form-control" placeholder="Last Name" 
                                                                            value="{{ $user->lname or "" }}">
                                                                            <p id="lname_error_{{ $user->id }}" class="esl-user-form-error"></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="name">Email</label>
                                                                    <input type="text" required id="email" name="email" class="form-control" placeholder="Email" 
                                                                    value="{{ $user->email or "" }}">
                                                                    <p id="email_error_{{ $user->id }}" class="esl-user-form-error"></p>
                                                                </div>
                                                            </div>
                                                        
                                                            
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="description">Department</label>
                                                                    <select name="department_id" id="department_id" style="width:100%" class="select2 form-control">
                                                                            <option value="">Select Department</option>
                                                                            @foreach(App\Department::all() as $value)
                                                                            @if($value->id == $user->department->id)
                                                                                <option value="{{$value->id}}" selected>{{ $value->name}}</option>
                                                                            @else
                                                                            <option value="{{$value->id}}">{{ $value->name}}</option>
                                                                            @endif
                                                                            @endforeach
                                                                        </select>
                                                                        <p id="department_id_error_{{ $user->id }}" class="esl-user-form-error"></p>                                                        
                                                                </div>
                                                            </div>
                                                        
                                                            <div class="col-sm-12">
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <div class="form-group">
                                                                                <label for="name">Password</label>
                                                                                <input type="text" id="password" name="password" class="form-control" placeholder="Password">
                                                                                <p id="password_error_{{ $user->id }}" class="esl-user-form-error"></p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col">
                                                                            <div class="form-group">
                                                                                <label for="password_confirmation">Confrim Password</label>
                                                                                <input type="text" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                                                                                <p id="password_confirmation_error_{{ $user->id }}" class="esl-user-form-error"></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                        <label for="role_id">Role</label>
                                                                        <select name="role_id" id="role_id" class="select2 form-control" style="width:100%;" required>
                                                                                <option value="">Select Role</option>
                                                                                @foreach( Spatie\Permission\Models\Role::all() as $role)

                                                                                @if($role->name == $user->getRoleNames()->first())
                                                                                <option value="{{$role->id}}" selected>{{ $role->name}}</option>
                                                                                @else
                                                                                <option value="{{$role->id}}">{{ $role->name}}</option>
                                                                                @endif
                                                                                @endforeach
                                                                            </select>
                                                                            <p id="role_id_error_{{ $user->id }}" class="esl-user-form-error"></p>
                                                                        </div>
                                                                </div>
                                                        </div>

                                                        <div style="text-align:right">
                                                            <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary" id="updateUser-"{{ $user->id }}>Update User Details</button>
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
@section('scripts')
<script src="{{ asset('js/parsley.js') }}"></script>
<script type="text/javascript">
    $(function(){
        'use strict';

    $(document).delegate('form', 'submit', function(event){
        event.preventDefault()

        var form = $(this);
        var formId = form.attr('id');

        if(formId == "register_user"){
            form.parsley().validate();
            if(form.parsley().isValid()){

                $('.esl-user-form-error').text('');
                $('#saveUser').html('...Adding New User').attr('disabled', true);

                var userData = form.serializeArray().reduce(function(obj, item){ obj[item.name] = item.value; return obj; },{});

                axios.post('{{ route('users.store') }}', userData )
                .then(function(response){
                    $('#saveUser').html('Add New User').attr('disabled', false);
                    $('.add-user-modal').modal('hide');
                        window.location.reload(); 
                })
                .catch(function(errors){
                    $.each(errors.response.data.errors, function (key, val) {
                        $("#" + key + "_error").text(val[0]);
                    });
                    $('#saveUser').html('Add New User').attr('disabled', false);
                });
            }// parsley vqalidation end
        }// register user form end
        
        if(formId != "register_user"){
            form.parsley().validate();
            if(form.parsley().isValid()){

                var userId = formId.split('-')[1];

                $('.esl-user-form-error').text('');
                $('#updateUser-'+userId).html('...Updating User Details').attr('disabled', true);

                var toUpdateData = form.serializeArray().reduce(function(obj, item){ obj[item.name] = item.value; return obj; },{});

                var url = '{{ route("users.update", ":id") }}';
                url = url.replace(':id',userId);
                axios.put(url, toUpdateData )
                .then(function(response){
                    $('#updateUser-'+userId).html('Update User Details').attr('disabled', false);
                    $('.user-edit-modal'+userId).modal('hide');
                    window.location.reload(); 
                })
                .catch(function(errors){
                    $.each(errors.response.data.errors, function (key, val) {
                        $("#" + key + "_error_" + userId).text(val[0]);
                    });
                    $('#updateUser-'+userId).html('Update User Details').attr('disabled', false);
                });
            
            }// parsley validation end
        }// other form end
        
        // parsley validation end
    })// form delegate method end

    })
</script>
@endsection