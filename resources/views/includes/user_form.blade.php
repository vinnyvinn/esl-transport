<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="name">First Name</label>
                    <input type="text" required id="fname" name="fname" class="form-control" placeholder="First Name" value="{{ $user->fname or "
                        " }}">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="name">Last Name</label>
                    <input type="text" required id="lname" name="lname" class="form-control" placeholder="Last Name" value="{{ $user->lname or "
                        " }}">
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group">
            <label for="name">Email</label>
            <input type="text" required id="email" name="email" class="form-control" placeholder="Email" value="{{ $user->email or "
                " }}">
        </div>
    </div>

    <div class="col-sm-12">
        <div class="form-group">
            <label for="description">Department</label>
            <select name="department_id" id="department_id" style="width:100%" class="select2 form-control">
                    <option value="">Select Department</option>
                    @foreach(\App\Department::all() as $value)
                        <option value="{{$value->id}}"
                            {{ $value->id == !empty($user->department_id) ? 'selected = "selected"':''}}
                            >{{$value->name}}</option>
                    @endforeach
                </select>

        </div>
    </div>

    <div class="col-sm-12">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="name">Password</label>
                        <input type="text" required id="password" name="password" class="form-control" placeholder="Password">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="name">Confrim Password</label>
                        <input type="text" required id="lname" name="lname" class="form-control" placeholder="Confirm Password">
                    </div>
                </div>
            </div>
        </div>
</div>