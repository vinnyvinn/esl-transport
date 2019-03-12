<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Esl\Repository\NotificationRepo;
use Illuminate\Support\Facades\Auth;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('roles.index', ['roles'=> $roles, 'permissions' => $permissions ]);
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

        $permissions = collect($request->except(['name','_token']))->transform(function($item){
            return Permission::find((int)$item);
        });
        
        // save permission
        $role = Role::create($request->only(['name']));
        $role->syncPermissions($permissions);

        NotificationRepo::create()->success('Role added successfully');
        return redirect()->back();
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
        // dd($request->except(['name','_token','_method']));
        $role = Role::findOrFail($id);
        // $role->syncPermissions();

        $permissions = collect($request->except(['name','_token','_method']))->transform(function($item){
            return Permission::find((int)$item);
        });

        $role->update($request->only(['name']));
        $role->syncPermissions($permissions);

        NotificationRepo::create()->success('Role updated successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::where('role_id',$role->id);
        // delete all permissions
        $role->syncPermissions();
        $role->delete();
        NotificationRepo::create()->success('Role deleted successfully');
        return redirect()->back();
    }
}
