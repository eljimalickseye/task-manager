<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::query();

        // 🔍 Filtrage
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        if ($request->filled('status')) {
            $status = $request->status === 'completed' ? 1 : 0;
            $query->where('completed', $status);
        }

        // 📅 Tri
        $sort = $request->get('sort', 'latest');
        if ($sort === 'due_soon') {
            $query->orderBy('due_at', 'asc');
        } else {
            $query->latest();
        }

        $tasks = $query->get();

        // 📊 Statistiques de progression
        $totalTasks = Task::count();
        $completedTasks = Task::where('completed', true)->count();
        $progress = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;

        return view('tasks.index', compact('tasks', 'progress'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'due_at' => 'nullable|date',
            'category' => 'required|string|max:100',
        ]);

        Task::create($request->all());
        return redirect()->route('tasks.index')->with('success', 'Tâche créée avec succès !');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'nullable|boolean',
            'priority' => 'required|in:low,medium,high',
            'due_at' => 'nullable|date',
            'category' => 'required|string|max:100',
        ]);

        $task->update($request->all());
        return redirect()->route('tasks.index')->with('success', 'Tâche mise à jour !');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }
}
