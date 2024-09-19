<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $permissions = Permission::paginate(10);
        return view('backend.settings.users.permission.index', compact('permissions'));
    }

    public function create()
    {
        return view('backend.settings.users.permission.create');
    }

    public function store(Request $request)
    {
        $validateData  = $this->validate($request, [
            'name' => 'required|unique:permissions,name',
            'guard_name' => 'required|in:web,api',
        ]);

        try {
            Permission::create([
                'name' => $validateData['name'],
                'guard_name' => $validateData['guard_name'],
            ]);
            return redirect()->route('settings.permissions')->with('success', 'Permission created successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function edit(Permission $permission)
    {
        return view('backend.settings.users.permission.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $validateData  = $this->validate($request, [
            'name' => 'required|unique:permissions,name,' . $permission->id,
            'guard_name' => 'required|in:web,api',
            // 'description' => 'nullable|string|max:255',
        ]);

        try {
            $permission->update([
                'name' => $validateData['name'],
                'guard_name' => $validateData['guard_name'],
                // 'description' => $validateData['description'],
            ]);
            return redirect()->route('settings.permissions')->with('success', 'Permission updated successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function destroy(Permission $permission)
    {
        try {
            if ($permission->delete()) {
                return redirect()->route('settings.permissions')->with('success', 'Permission deleted successfully!');
            } else {
                return redirect()->route('settings.permissions')->with('error', 'Permission not deleted!');
            }
        } catch (\Exception $e) {
            return redirect()->route('settings.permissions')->with('error', $e->getMessage());
        }
    }
}
