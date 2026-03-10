<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Enums\UserRole; // 1. Import your Enum

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\userRegisterValidation;
use App\Http\Requests\UpdateCommunityMemberRequest;
use PhpParser\Node\Expr\AssignOp\Coalesce;

class CommunityMemberController extends Controller
{

    public function index()
    {

        $users = User::where('role', 'community-member')->get();
        return view('communitymember.show', compact('users'));
    }

    public function create()
    {
        return view('communitymember.create');
    }

    public function store(userRegisterValidation $request)
    {

        // 2. Create user with Enum value
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => UserRole::COMMUNITY_MEMBER->value, // Assigns 'community-chair'
        ]);
        $user->assignRole(UserRole::COMMUNITY_MEMBER->value);

        // return ('Registration successful! Please log in.');
        return redirect()->back()->with('success', 'Registration successful! The Community Member has been created.');
    }

    public function edit(User $user)
    {
        // Rename variable to $user for clarity
        
        if ($user->role !== UserRole::COMMUNITY_MEMBER) {
        abort(403, 'Unauthorized');
    }

        return view('communitymember.edit', ['User' => $user, 'user' => $user]);
    }



    public function update(UpdateCommunityMemberRequest $request, User $user)
    {
        $data = $request->validated();
        $update = [
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => UserRole::COMMUNITY_MEMBER->value,
        ];
        if (!empty($data['password'])) {
            $update['password'] = Hash::make($data['password']);
        }
        $user->update($update);

        return redirect()->back()->with('success', 'Registration successful! The Community Member has been created.');
    }


    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back()->with('success', 'User Delete successful! The Community meber has been Deleted.');
    }
}
