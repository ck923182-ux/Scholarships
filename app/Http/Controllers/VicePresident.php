<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Psy\Command\WhereamiCommand;
use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests\StoreVicePresidentRequest;
use App\Http\Requests\UpdateVicePresidnetRequest;

class VicePresident extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role', 'vice-president')->get();
        return view('vicepresident.show', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vicepresident.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVicePresidentRequest $request)
    {
        $validated = $request->validated();
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => UserRole::VICE_PRESIDENT->value,
        ]);
        $user->assignRole(UserRole::VICE_PRESIDENT->value);
        return redirect()->back()->with('success', 'Registration successful! The Vice Presidnet has been created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        if ($user->role !== UserRole::VICE_PRESIDENT) {
            abort(403, 'Unauthorized');
        }

        return view('vicepresident.edit', ['User' => $user, 'user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVicePresidnetRequest $request, User $user)
    {
        $data = $request->validated();
        $update = [
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => UserRole::VICE_PRESIDENT->value,
        ];
        if (!empty($data['password'])) {
            $update['password'] = Hash::make($data['password']);
        }
        $user->update($update);

        return redirect()->back()->with('success', 'Registration successful! The Vice Presidnet has been created.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back()->with('success', 'User Delete successful! The Presidnet  has been Deleted.');
    }
}
