<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TaskController extends Controller
{
     public function index()
    {
        // Retrieve and display all tasks
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        // Show the form to create a new task
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        // Store a new task in the database
        Task::create($request->all());
        return redirect()->route('tasks.index');
    }


}