<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use Spatie\Permission\Models\Role;
use Esl\Repository\NotificationRepo;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', ['users'=> $users ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'department_id' => 'required',
            'role_id' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'name' => $request->fname." ".$request->lname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'department_id' => $request->department_id,
        ]);

        $role = Role::find($request->role_id);
        $user->assignRole($role->name);

        return response()->json(["created"=>'true','data'=>$user]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id);
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'department_id' => 'required',
            'role_id' => 'required',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        if(!empty($request->password)){
            $data = $request->all();
            $data['password'] = bcrypt($request->password);
            $user->update($data);
        }else{
            $user->update($request->except(['password']));
        }

        $role = Role::find($request->role_id);
        $user->syncRoles($role->name);
        
        return response()->json(["updated"=>'true','data'=>$user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        NotificationRepo::create()->success('User deleted successfully');
        return redirect()->back();
    }
}
