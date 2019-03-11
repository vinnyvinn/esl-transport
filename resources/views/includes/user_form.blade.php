<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="name">First Name</label>
                    <input type="text" required id="fname" name="fname" class="form-control" placeholder="First Name">
                    <p id="fname_error" class="esl-user-form-error"></p>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="name">Last Name</label>
                    <input type="text" required id="lname" name="lname" class="form-control" placeholder="Last Name" >
                    <p id="lname_error" class="esl-user-form-error"></p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group">
            <label for="name">Email</label>
            <input type="text" required id="email" name="email" class="form-control" placeholder="Email">
            <p id="email_error" class="esl-user-form-error"></p>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group">
            <label for="description">Department</label>
            <select name="department_id" id="department_id" style="width:100%" class="select2 form-control" required>
                    <option value="">Select Department</option>
                    @foreach(App\Department::all() as $value)
                        <option value="{{$value->id}}"
                            >{{$value->name}}</option>
                    @endforeach
                </select>
            <p id="department_id_error" class="esl-user-form-error"></p>
        </div>
    </div>

    <div class="col-sm-12">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="name">Password</label>
                        <input type="text" required id="password" name="password" class="form-control" placeholder="Password">
                        <p id="password_error" class="esl-user-form-error"></p>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="password_confirmation">Confrim Password</label>
                        <input type="text" required id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                        <p id="password_confirmation_error" class="esl-user-form-error"></p>
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
                            <option value="{{ $role->id }}"
                            >{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
        </div>
</div>