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
        $roles = Role::all();
        
        // Super admin can only see and manage admins, not regular users
        if ($currentUser->hasRole('super-admin')) {
            $users = User::role(['admin'])->with('roles')->get();
            $availableRoles = $roles->whereIn('name', ['admin']);
        }
        // Admin can see and manage regular users but not other admins or super-admins
        elseif ($currentUser->hasRole('admin')) {
            $users = User::role(['user'])->with('roles')->get();
            $availableRoles = $roles->whereIn('name', ['user']);
        }
        // Fallback to showing all users (should not happen due to middleware)
        else {
            $users = User::with('roles')->get();
            $availableRoles = $roles;
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
            'role' => 'required|exists:roles,name'
        ]);

        // Enforce role restrictions
        if ($currentUser->hasRole('super-admin') && $request->role !== 'admin') {
            return redirect()->back()->with('error', 'Super Admin can only create admin accounts');
        }
        
        if ($currentUser->hasRole('admin') && $request->role !== 'user') {
            return redirect()->back()->with('error', 'Admin can only create user accounts');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->role);

        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
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
        
        // Prevent editing users that the current user doesn't have permission for
        if ($currentUser->hasRole('super-admin') && !$user->hasRole('admin')) {
            abort(403, 'Super Admin can only manage admin accounts');
        }
        
        if ($currentUser->hasRole('admin') && !$user->hasRole('user')) {
            abort(403, 'Admin can only manage user accounts');
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
        
        // Enforce role restrictions
        if ($currentUser->hasRole('super-admin') && $validatedData['role'] !== 'admin') {
            return redirect()->back()->with('error', 'Super Admin can only assign admin role');
        }
        
        if ($currentUser->hasRole('admin') && $validatedData['role'] !== 'user') {
            return redirect()->back()->with('error', 'Admin can only assign user role');
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
        if ($currentUser->hasRole('super-admin') && !$user->hasRole('admin')) {
            abort(403, 'Super Admin can only manage admin accounts');
        }
        
        if ($currentUser->hasRole('admin') && !$user->hasRole('user')) {
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
