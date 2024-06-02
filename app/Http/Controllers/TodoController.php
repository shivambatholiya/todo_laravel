<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TasksModel;

class TodoController extends Controller
{
    public function showTasks()
    {
        $tasks = TasksModel::get();
        return view('index', ['pagedata'=>$tasks]);
    }

    public function add_task(Request $request)
    {
        $task = TasksModel::where('task_name', $request->task_name)->first();
        if($task) {
            return redirect()->back()->withErrors([''=> 'Can Not add Same task again']);
        }
        $data = [
            'task_name'=>$request->task_name,
            'status'=>0,
            'created_at'=>date('Y-m-d'),
        ];
        $res = TasksModel::create($data);
        if($res) {
            return redirect()->back()->with('success', 'Task Added');
        } else {
            return redirect()->back()->withErrors('', 'Something Went Wrong');
        }
    }
    public function update_task_status(Request $request, string $id)
    {
        $task = TasksModel::where('id', $id)->first();
       
        $res = $task->update(['status'=>1]);
        if($res) {
            return redirect()->back()->with('success', 'Task Completed');
        } else {
            return redirect()->back()->withErrors('', 'Something Went Wrong');
        }
    }
    public function delete_task(Request $request, string $id)
    {
        $task = TasksModel::where('id', $id)->first();
       
        $res = $task->delete();
        if($res) {
            return redirect()->back()->with('success', 'Task Deleted');
        } else {
            return redirect()->back()->withErrors('', 'Something Went Wrong');
        }
    }
}
