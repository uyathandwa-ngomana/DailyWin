<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequestAZU;
use App\Http\Requests\UpdateUserRequestAZU;
use App\Models\UserAZU;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserControllerAZU extends Controller
{
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

    public function store(StoreUserRequestAZU $request): RedirectResponse
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        UserAZU::create($data);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

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

    public function update(UpdateUserRequestAZU $request, UserAZU $user): RedirectResponse
    {
        $data = $request->validated();

        if (blank($data['password'] ?? null)) {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(UserAZU $user): RedirectResponse
    {
        if (auth()->id() === $user->id) {
            return back()->with('success', 'You cannot delete your own account from user management.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
