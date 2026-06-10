<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $currentUser = auth()->user();
        $roles = [
            'operator',
            'pelapor',
            'pengkaji',
            'pimpinan'
        ];
        
        if ($currentUser->role === 'operator') {

        $users = User::whereIn('role', [
            'pelapor',
            'pengkaji',
            'pimpinan'
        ])->paginate(15);

        $availableRoles = [
            'pelapor',
            'pengkaji',
            'pimpinan'
        ];
    }
        
        return view('users.index', compact('users', 'roles', 'availableRoles', 'currentUser'));
    }    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $currentUser = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:superadmin,admin,pelapor,pengkaji,pimpinan',
        ]);

        // Set role selalu 'user' untuk admin
        $role = 'user';

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($role);

        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }

    /**
     * Show the form for creating a new user (admin).
     */
    public function create()
    {
        $role = 'user';
        return view('users.create', compact('role'));
    }

    /**
     * Show the form for creating a new admin (super-admin).
     */
    public function createAdmin()
    {
        $role = 'admin';
        return view('admins.create', compact('role'));
    }


    /**
     * Show the form for editing the specified user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $currentUser = auth()->user();
        
        if ($currentUser->role === 'operator') {
            abort(403, 'Operator can only manage user accounts');
        }
        
        // Validate request data
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->getKey(),
            'role' => 'required|exists:roles,name',
        ];
        
        // Only validate password if it's provided
        if ($request->filled('password')) {
            $rules['password'] = 'string|min:8';
        }
        
        $validatedData = $request->validate($rules);
        
        if ($currentUser->role === 'operator' && $validatedData['role'] !== 'user') {
            return redirect()->back()->with('error', 'Operator can only assign user role');
        }
        
        // Prepare user data for update
        $userData = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ];
        
        // Update password only if provided
        if (isset($validatedData['password'])) {
            $userData['password'] = Hash::make($validatedData['password']);
        }
        
        // Update user information
        $user->update($userData);
        
        // Update user role
        $user->syncRoles([$validatedData['role']]);
        
        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }    /**
     * Remove the specified user from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $currentUser = auth()->user();
        
        // Prevent deleting users that the current user doesn't have permission for
        if ($currentUser->role === 'super-admin') {
            abort(403, 'Super Admin can only manage admin accounts');
        }
        
        if ($currentUser->role === 'admin') {
            abort(403, 'Admin can only manage user accounts');
        }
        
        // Prevent self-deletion
        if ($user->id === $currentUser->id) {
            return redirect()->back()->with('error', 'You cannot delete your own account');
        }
        
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
}
