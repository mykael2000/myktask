<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();

        return view('task-management', ['tasks' => $tasks]);
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
        return redirect()->back()->with('message', 'Task Created Successfully');


        // Validate the incoming request data
        // $validatedData = $request->validate([
        //     'client_id' => 'required|integer',
        //     'task_id' => 'required|string',
        //     'task_name' => 'required|string',
        //     'task_description' => 'required|string',
        //     'task_deadline' => 'required',
        //     'importance' => 'required|string',
        //     'status' => 'required|string',
        // ]);

        // Create a new Workflow instance and save it to the database
        // $task = Task::create($validatedData);

        // return response()->json(['message' => 'Workflow created successfully', 'workflow' => $task], 201);
    }

    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        if (!$task) {
            return redirect()->back()->with('error', 'Task not found');
        }
            // Validate the incoming request data
        $valData = $request->validate([
            'client_id' => 'required',
            'task_id' => 'required',
            'task_name' => 'required',
            'task_description' => 'required',
            'task_deadline' => 'required',
            'importance' => 'required',
            'status' => 'required',
        ]);

        // Update the task with the new data
        $task->update($valData);

        return redirect()->back()->with('message', 'Task Updated Successfully');
    }
    public function destroy($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return redirect()->back()->with('error', 'Task not found.');
        }

        $task->delete();

        return redirect()->back()->with('message', 'Task Deleted Successfully');
    }

}