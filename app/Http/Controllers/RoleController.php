<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        Gate::authorize('haceaccess', 'role.index');
        $roles = Role::orderBy('id', 'Desc')->paginate(5);
        
        return view('app.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        Gate::authorize('haceaccess', 'role.create');
        $permissions = Permission::get();

        return view('app.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        Gate::authorize('haceaccess', 'role.create');
        $request->validate([
            'name'        => 'required|max:50|unique:roles,name',
            'slug'        => 'required|max:50|unique:roles,slug',
            'full-access' => 'required|in:yes,no',
        ]);

        $role = Role::create($request->all());
        // if ($permissions = $request->get('permission')) {
            $role->permissions()->sync($request->get('permission'));
        // }

        return redirect()->route('role.index')
            ->with('status_success', 'Role saved successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {   
        Gate::authorize('haceaccess', 'role.show');
        $permissions = Permission::get();
        $permission_role = [];

        foreach ($role->permissions as $permission) {
            $permission_role[] = $permission->id;
        }

        return view('app.role.view', compact('permissions', 'role', 'permission_role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {   
        Gate::authorize('haceaccess', 'role.edit');
        $permissions = Permission::get();
        $permission_role = [];

        foreach ($role->permissions as $permission) {
            $permission_role[] = $permission->id;
        }

        return view('app.role.edit', compact('permissions', 'role', 'permission_role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {   
        Gate::authorize('haceaccess', 'role.edit');
        $request->validate([
            'name'        => 'required|max:50|unique:roles,name,'.$role->id,
            'slug'        => 'required|max:50|unique:roles,slug,'.$role->id,
            'full-access' => 'required|in:yes,no',
        ]);

        $role->update($request->all());

        // if ($permissions = $request->get('permission')) {
            $role->permissions()->sync($request->get('permission'));
        // }

        return redirect()->route('role.index')
            ->with('status_success', 'Role update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {   
        Gate::authorize('haceaccess', 'role.destroy');
        $role->delete();

        return redirect()->route('role.index')
            ->with('status_success', 'Role successfully removed');
    }
}
