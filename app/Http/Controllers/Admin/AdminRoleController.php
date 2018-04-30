<?php

namespace App\Http\Controllers\Admin;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::orderBy('created_at', 'desc')->paginate(8);

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50'
        ]);

        Role::create(['name' => $request->name]);

        return redirect()->route('admin.roles.index')->withSuccess('A role has been created !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);

        $role_permissions = $role->permissions()->orderBy('created_at', 'desc')->paginate(8);

        $permissions = Permission::pluck('name', 'id')->all();

        return view('admin.roles.show', compact('role', 'role_permissions', 'permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);

        return view('admin.roles.edit', compact('role'));
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
        $this->validate($request, [
            'name' => 'required|string|max:50'
        ]);

        $role = Role::findOrFail($id);

        $role->update(['name' => $request->name]);

        return redirect()->route('admin.roles.edit', $role->id)->withSuccess('The role has been updated !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::findOrFail($id)->delete();

        return redirect()->route('admin.roles.index')->withSuccess('Role has been deleted !');
    }

    public function givePermission(Request $request, $id)
    {
        $this->validate($request, [
            'permission' => 'required'
        ]);

        $role = Role::findOrFail($id);

        $role->givePermission($request->permission);

        return redirect()->route('admin.roles.show', $role->id)->withSuccess("Permission has been added !");
    }

    public function withdrawPermission(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $role->withdrawPermission($request->permission);

        return redirect()->route('admin.roles.show', $role->id)->withSuccess("Permission has been removed !");
    }
}
