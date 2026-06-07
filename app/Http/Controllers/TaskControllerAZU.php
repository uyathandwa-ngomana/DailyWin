<?php

namespace App\Http\Controllers;

use App\Models\TaskAZU;
use App\Models\UserAZU;
use App\Models\CategoryAZU;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreTaskRequestAZU;
use App\Http\Requests\UpdateTaskRequestAZU;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


/* 1. Controller is responsible for task management operations.
2. Handles task creation, viewing, updaing, deletion, assignment, status updates and category relationships*/
class TaskControllerAZU extends Controller
{
    /*Display a paginated list of tasks.
     Administrators can view all tasks, while team members can only view 
     tasks they created or that are assigned to them.*/
    public function index(Request $request): View
    {
        Gate::authorize('viewAny', TaskAZU::class);

        $user = $request->user();
        $tasks = TaskAZU::query()
            ->with(['creator', 'assignee', 'categories'])

            /*Restrict non-admin users to their own created or assigned tasks.*/
            ->when(!$user->isAdmin(), function ($query) use ($user) {
                $query->where(function ($query) use ($user) {
                    $query->where('created_by', $user->id)
                        ->orWhere('assigned_to', $user->id);
                });
            })
            ->when($request->filled('status'), fn($query) => $query->where('status', $request->status))
            ->when($request->filled('priority'), fn($query) => $query->where('priority', $request->priority))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('tasks.index', compact('tasks'));
    }

    /*Displays the task creation form. 
    Loads available users and categories for task assignment*/
    public function create(): View
    {
        Gate::authorize('create', TaskAZU::class);

        return view('tasks.create', [
            'task' => new TaskAZU(['status' => 'pending', 'priority' => 'medium']),
            'users' => UserAZU::query()->where('role', '!=', 'guest')->orderBy('name')->get(),
            'categories' => CategoryAZU::query()->orderBy('name')->get(),
        ]);
    }

    /* Stores newly created tasks.
    Creates the task, assigns ownership to the authenticated user 
    and attaches any selected categories.*/
    public function store(StoreTaskRequestAZU $request): RedirectResponse
    {
        Gate::authorize('create', TaskAZU::class);

        $data = $request->validated();

        $data['created_by'] = Auth::id();

        //Only administrators may assign tasks to other users.//
        //Team members are automatically assigned their own tasks.//
        $data['assigned_to'] = $request->user()->isAdmin() ? ($data['assigned_to'] ?? null) : Auth::id();

        $task = TaskAZU::create($data);
        //Attach selected categories through the pivot table relationship.//
        $task->categories()->sync($request->input('categories', []));

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }


    //Display detailed information for a single task.//
    public function show(TaskAZU $task): View
    {
        Gate::authorize('view', $task);

        $task->load(['creator', 'assignee', 'categories']);

        return view('tasks.show', compact('task'));
    }


    //Display the task editing form.//
    //Loads task data together with available users and categories.//
    public function edit(TaskAZU $task): View
    {
        Gate::authorize('update', $task);

        return view('tasks.edit', [
            'task' => $task->load('categories'),
            'users' => UserAZU::query()->where('role', '!=', 'guest')->orderBy('name')->get(),
            'categories' => CategoryAZU::query()->orderBy('name')->get(),
        ]);
    }


    //Update an existing task.//
    //Administrators may update all task attributes, while team members have restricted permissions.//
    public function update(UpdateTaskRequestAZU $request, TaskAZU $task): RedirectResponse
    {
        Gate::authorize('update', $task);

        $data = $request->validated();


        //Prevents non-admin users from reassigning tasks.//
        if (!$request->user()->isAdmin()) {
            unset($data['assigned_to']);
        }

        $task->update($data);

        //Update category associations for the task.//
        $task->categories()->sync($request->input('categories', []));

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }


    //Update the workflow status of a task.//
    //Allowed statuses are pending in_progress and completed.//
    public function updateStatus(Request $request, TaskAZU $task): RedirectResponse
    {
        Gate::authorize('update', $task);

        $validated = $request->validate([
            'status' => ['required', 'in:pending,in_progress,completed'],
        ]);

        $task->update($validated);

        return back()->with('success', 'Task status updated.');
    }


    //Deletes a task from the system.//
    public function destroy(TaskAZU $task): RedirectResponse
    {
        Gate::authorize('delete', $task);

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
