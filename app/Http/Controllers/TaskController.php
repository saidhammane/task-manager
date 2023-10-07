<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{

    public function index()
    {
        // Retrieve all tasks from the database
        $tasks = Task::all();

        // Pass the tasks to the view for rendering
        // return view('tasks.index', compact('tasks'));
        return $tasks;
    }


    public function create(Request $request){
        $task = new Task();
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->save();
        return response()->json($task);
    }

    public function destroy($id){

        $task = Task::findOrFail($id);

        if ($task->deleteOrFail() === false) {
            return response(
                "Couldn't delete the task with id {$id}",
                Response::HTTP_BAD_REQUEST
            );
        }
        return redirect('/tasks')->with('success', 'Task deleted successfully');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
        ]);

        // Create a new task
        $task = new Task;
        $task->title = $validatedData['title'];
        $task->description = $validatedData['description'];
        $task->save();

        // Redirect to the task list with a success message
        return  response()->json($task);
    }

}