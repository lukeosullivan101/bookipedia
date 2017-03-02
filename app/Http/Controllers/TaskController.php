<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TaskRepository;
use App\Task;

class TaskController extends Controller
{

    public function index(Request $request){
    	

    	return view('readinglist', [
    			'tasks' => $request->user()->tasks()->orderBy('created_at', 'asc')->get(),
    		]);
    }

    public function store(Request $request){
    	$this->validate($request, [
    			'name' => 'required|max:255',
    		]);
    	$request->user()->tasks()->create([
    		'name' => $request->name
    	]);

    	return redirect()->route('tasks');

    }

    public function destroy(Request $request, Task $task){
    	if($task->user_id == $request->user()->id || $request->user()->is_admin())
		{

			$task->delete();

	    	return redirect()->route('tasks');
    	}
    	else{
    		return redirect()->route('tasks');
    	}

    }
}
