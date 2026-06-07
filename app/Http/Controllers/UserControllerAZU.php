<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequestAZU;
use App\Http\Requests\UpdateUserRequestAZU;
use App\Models\UserAZU;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

//Controller responsible for user management operations.//
//Handles CRUD operations for users including creation, updates, role management, password hashing and account deletion.//
class UserControllerAZU extends Controller
{
    //Displays a paginates list of users with task statistics.//
    //Loads each user with counts of created and assigned tasks for administrative overview.//
    public function index(): View
    {
        return view('users.index', [
            'users' => UserAZU::query()
                ->withCount(['createdTasks', 'assignedTasks'])
                ->latest()
                ->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('users.create', ['user' => new UserAZU()]);
    }


    //Creates a new user account.//
    //Validates input data, securely hases the password and stores the user in the database.//
    public function store(StoreUserRequestAZU $request): RedirectResponse
    {
        $data = $request->validated();

        //Securely hash password before saving user record.//
        $data['password'] = Hash::make($data['password']);

        UserAZU::create($data);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }


    //Displays a specific user profile with recent activity.//
    //Loads latest creates and assigned tasks for dashboard preview.//
    public function show(UserAZU $user): View
    {
        $user->load([
            'createdTasks' => fn ($query) => $query->latest()->limit(8),
            'assignedTasks' => fn ($query) => $query->with('categories')->latest()->limit(8),
        ]);

        return view('users.show', compact('user'));
    }

    public function edit(UserAZU $user): View
    {
        return view('users.edit', compact('user'));
    }


    //Updates an existing user account.//
    //Allows updating profile details and optionally password.//
    public function update(UpdateUserRequestAZU $request, UserAZU $user): RedirectResponse
    {
        $data = $request->validated();

        //Only has password if a new one is provided./
        if (blank($data['password'] ?? null)) {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    //Deletes a user's account.//
    //Prevents users from deleting their own account via admin panel.//
    public function destroy(UserAZU $user): RedirectResponse
    {
        //Prevents self deletion for safety and account integrity.//
        if (auth()->id() === $user->id) {
            return back()->with('success', 'You cannot delete your own account from user management.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
