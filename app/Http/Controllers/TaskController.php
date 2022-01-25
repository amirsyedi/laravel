<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function getTask(){
        $task = Task::where('user_id',Auth::user()->id)->get();

        return response()->json($task,200);
    }

    public function delete($id){

        $user =Task::find($id);
        $user->delete();

        return response()->json('Task Deleted');
    }

    public function createTask(Request $request){
        $task = $request->message;

        $newTask= Task::create([
            'message' => $task,
            'user_id' => Auth::user()->id
        ]);

        return response()->json('Success',200);
    }

    public function editTask($id){
        $task = Task::find($id);

        return response()->json($task);
    }

    public function updateTask($id, Request $request){

         $request -> validate([
             'message' => ['required'],
         ]);

         $task = Task::findOrFail($id);

         $task->message = $request->message;

         $task->save();

         return response()->json($task);
    }

    public function updateStatus($id){
        $stat = Task::where('id',$id)->update([
            'is_completed'=>'1'
        ]);

        return response()->json($stat,200);


    }
 }



