<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index()
    {
        return view(
            'tasks.index',
            [
                'tasks' =>  Task::first()->filter(
                    [
                        'search' =>request('search'),
                        'team' =>auth()->user()->team->id,
                    ]
                )->get(),
            ]
        );
    }

    public static function create()
    {
        return view('tasks.add-task');
    }
    public static function store()
    {
        Task::addNew($_POST['descrizione'], false, Auth::id());
        return redirect('/');
    }
    public static function edit(Task $task)
    {
        return view(
            'tasks.edit',
            [
                'task' => $task
            ]
        );
    }
    public static function update(Task $task)
    {
        if (isset($_POST['terminata'])) {
            $task->terminata = true;
        } else {
            $task->terminata = false;
        }
        $task->update([
            'descrizione' => $_POST['descrizione']
        ]);
        $task->save();
        return redirect('/');
    }

    public static function delete()
    {
        return view(
            'tasks.delete',
            [
                'tasks' =>  Task::where('terminata', 1)->get()
            ]
        );
    }
    public static function destroy(Task $task)
    {
        $task->delete();
        return redirect('/delete');
    }
}
