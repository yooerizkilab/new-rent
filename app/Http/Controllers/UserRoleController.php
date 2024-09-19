<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class UserRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }


    public function index()
    {
        $roles = Role::paginate(10);
        return view('backend.settings.users.role.index', compact('roles'));
    }

    public function create()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('backend.settings.users.role.create', compact('roles', 'permissions'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|unique:roles,name',
            'guard_name' => 'required|in:web,api',
            // 'description' => 'nullable|string',
        ]);

        try {
            // Membuat role baru
            Role::create([
                'name' => $validatedData['name'],
                'guard_name' => $validatedData['guard_name'],
                // 'description' => $validatedData['description'],
            ]);
            // Redirect ke halaman index
            return redirect()->route('settings.roles')->with('success', 'Role created successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function edit(Role $role)
    {
        return view('backend.settings.users.role.edit', compact('role'));
    }

    public function show(Role $role)
    {
        return view('backend.settings.users.show', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $validateData  = $this->validate($request, [
            'name' => 'required|unique:roles,name,' . $role->id,
            'guard_name' => 'required|in:web,api',
            // 'description' => 'nullable|string|max:255',
        ]);

        try {
            $role->update([
                'name' => $validateData['name'],
                'guard_name' => $validateData['guard_name'],
                // 'description' => $validateData['description'],
            ]);
            return redirect()->route('settings.roles')->with('success', 'Role updated successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function destroy(Role $role)
    {
        try {
            if ($role->delete()) {
                return redirect()->back()->with('success', 'Role deleted successfully');
            } else {
                return redirect()->back()->with('error', 'Role not found');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function assignPermission(Role $role)
    {
        // Mengambil semua permission
        $permissions = Permission::all();

        // Mengambil ID permission yang sudah dimiliki oleh role
        $rolePermissions = $role->permissions->pluck('id')->toArray();

        return view('backend.settings.users.role.manage', compact('role', 'permissions', 'rolePermissions'));
    }

    public function assignPermissionStore(Request $request, Role $role)
    {
        // Validasi request untuk memastikan permissions diisi
        $validatedData = $request->validate([
            'permissions' => 'required',
            'permissions.*' => 'exists:permissions,name',
        ]);

        try {
            $role->syncPermissions($validatedData['permissions']);
            return redirect()->back()->with('success', 'Permissions assigned successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
