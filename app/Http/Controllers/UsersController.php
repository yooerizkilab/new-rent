<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $users = User::with('roles', 'permissions')->paginate(10);
        return view('backend.settings.users.user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('backend.settings.users.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|min:2|max:255',
            'last_name' => 'required|string|min:2|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed', // Memastikan password konfirmasi
            'role' => 'required|string|exists:roles,name', // Validasi role sebagai string
        ]);

        try {
            // Membuat user baru
            $user = User::create([
                'name' => $validatedData['name'],
                'last_name' => $validatedData['last_name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);

            // Menambahkan role ke user
            $user->assignRole($validatedData['role']); // Pastikan role adalah nama string

            // Redirect ke index dengan flash message sukses
            return redirect()->route('settings.users')->with('success', 'User created successfully');
        } catch (\Exception $e) {
            // Tangani jika terjadi error
            return redirect()->back()->with('error', 'There was an error creating the user: ' . $e->getMessage());
        }
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('backend.settings.users.user.edit', compact('user', 'roles'));
    }

    public function show(User $user)
    {
        $user->load('roles');
        return view('backend.settings.users.user.show', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'nullable|string|exists:roles,name', // Validasi role berdasarkan nama
        ]);

        // Update data user
        $data = $request->only('name', 'last_name');

        // Jika password diisi, lakukan update password
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Update user
        $user->update($data);

        // Sinkronisasi role jika ada
        if ($request->has('role')) {
            $role = $request->input('role');
            $user->syncRoles($role); // Gunakan nama role
        }

        // Redirect dengan pesan sukses
        return redirect()->route('settings.users')->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        try {
            // Cek jika penghapusan berhasil
            if ($user->delete()) {
                return redirect()->back()->with('success', 'User deleted successfully');
            } else {
                return redirect()->back()->with('error', 'Failed to delete user');
            }
        } catch (\Exception $e) {
            // Penanganan jika terjadi error saat penghapusan (misal relasi database)
            return redirect()->back()->with('error', 'An error occurred while trying to delete the user: ' . $e->getMessage());
        }
    }
}
