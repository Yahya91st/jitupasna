<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $currentUser = Auth::user();
        $roles = [
            'operator',
            'pelapor',
            'pengkaji',
            'pimpinan',
        ];

        $users = collect();
        $availableRoles = [];

        if ($currentUser->role === 'operator') {

            $users = User::whereIn('role', [
                'pelapor',
                'pengkaji',
                'pimpinan',
            ])->paginate(15);

            $availableRoles = [
                'pelapor',
                'pengkaji',
                'pimpinan',
            ];
        }

        return view('users.index', compact(
            'users',
            'roles',
            'availableRoles',
            'currentUser'
        ));
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:operator,pelapor,pengkaji,pimpinan',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }

    /**
     * Show the form for creating a new user (admin).
     */
    public function create()
    {
        $roles = [
            'pelapor',
            'pengkaji',
            'pimpinan'
        ];

        return view('users.create', compact('roles'));
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        if (Auth::user()->role !== 'operator') {
            abort(403);
        }

        $roles = [
            'pelapor',
            'pengkaji',
            'pimpinan',
        ];

        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        if (Auth::user()->role !== 'operator') {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:pelapor,pengkaji,pimpinan',
            'password' => 'nullable|min:8',
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
        ];

        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $user->update($data);

        return redirect()->route('users.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $currentUser = Auth::user();

        if ($currentUser->role !== 'operator') {
            abort(403);
        }

        if ($currentUser->id == $user->id) {
            return back()->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        $user->delete();

        return back()->with('success', 'User berhasil dihapus.');
    }
}
