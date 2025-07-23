<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'all');
        $search = $request->query('search');

        $query = Task::query();
        
        match ($filter) {
            'completed' => $query->where('is_completed', true),
            'incompleted' => $query->where('is_completed', false),
            default => null
        };
        if ($search) {
            $query->where('title', 'like', "%{$search}%");
        }
        $tasks = $query->orderBy('created_at', 'desc')->get();

        return view('tasks.index', compact('tasks', 'filter', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:tasks|min:3'
        ]);
        Task::create([
            'title' => $request->input('title'),
            'is_completed' => $request->has('complete')
        ]);
        return redirect('/tasks');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|min:3'
        ]);
        $task->update([
            'title' => $request->input('title'),
            'is_completed' => $request->has('complete')
        ]);
        return redirect('/tasks');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect('/tasks');
    }
}
