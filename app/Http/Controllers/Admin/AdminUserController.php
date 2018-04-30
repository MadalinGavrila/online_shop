<?php

namespace App\Http\Controllers\Admin;

use App\Permission;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(8);

        return view('admin.users.index', compact('users'));
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
        $user = User::findOrFail($id);

        $user_permissions = $user->permissions()->orderBy('created_at', 'desc')->paginate(8);

        $permissions = Permission::pluck('name', 'name')->all();

        return view('admin.users.show', compact('user', 'user_permissions', 'permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        $roles = Role::pluck('name', 'id')->all();

        return view('admin.users.edit', compact('user', 'roles'));
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
            'active' => 'required',
            'role' => 'required'
        ]);

        $user = User::findOrFail($id);

        $user->update(['active' => $request->active]);

        $user->giveRole($request->role);

        return redirect()->route('admin.users.edit', $user->id)->withSuccess('The user has been updated !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect()->route('admin.users.index')->withSuccess("User has been deleted !");
    }

    public function givePermission(Request $request, $id)
    {
        $this->validate($request, [
            'permission' => 'required'
        ]);

        $user = User::findOrFail($id);

        $user->givePermissionTo($request->permission);

        return redirect()->route('admin.users.show', $user->id)->withSuccess("Permission has been added !");
    }

    public function withdrawPermission(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->withdrawPermissionTo($request->permission);

        return redirect()->route('admin.users.show', $user->id)->withSuccess("Permission has been removed !");
    }
}
