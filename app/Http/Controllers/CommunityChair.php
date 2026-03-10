<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Enums\UserRole; // 1. Import your Enum

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\userRegisterValidation;
use App\Http\Requests\StoreCommunityChairRequest;
use App\Http\Requests\UpdateCommunityChairRequest;


class CommunityChair extends Controller
{
    public function index()
    {
        $users = User::where('role', 'community-chair')->get();
        return view('communitychair.show', compact('users'));
    }

    public function create()
    {
        return view('communitychair.create');
    }

    public function store(StoreCommunityChairRequest $request)
    {
        $data = $request->validated();
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => UserRole::COMMUNITY_CHAIR->value,
        ]);
        $user->assignRole(UserRole::COMMUNITY_CHAIR->value);
        return redirect()->back()->with('success', 'Registration successful! The Community Chair has been created.');
    }

    public function chairregister(userRegisterValidation $request)
    {
        return $this->store(app(StoreCommunityChairRequest::class));
    }


    public function edit(User $user)
    {
        if ($user->role !== UserRole::COMMUNITY_CHAIR) {
            abort(403, 'Unauthorized');
        }
        return view('communitychair.edit', ['User' => $user, 'user' => $user]);
    }



    public function update(UpdateCommunityChairRequest $request, User $user)
    {
        $data = $request->validated();
        $update = [
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => UserRole::COMMUNITY_CHAIR->value,
        ];
        if (!empty($data['password'])) {
            $update['password'] = Hash::make($data['password']);
        }
        $user->update($update);

        return redirect()->back()->with('success', 'Registration successful! The Community Chair has been created.');
    }


    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back()->with('success', 'User Delete successful! The Community Chair has been Deleted.');
    }
}
