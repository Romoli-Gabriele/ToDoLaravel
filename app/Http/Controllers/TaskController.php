<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public static function add()//
    {
        Task::addNew($_POST['descrizione'], false, Auth::id());
        return view('index',
        [
            'tasks' => Task::all()
        ]);
    }
    public static function done(Task $task)//update
    {

        DB::update("update tasks set terminata = 1 where id = $task->id");
        return view(
            'index',
            [
                'tasks' => Task::all()
            ]
        );
    }
    public static function delete()
    {
        DB::delete('delete from tasks where terminata = 1');
        return view(
            'index',
            [
                'tasks' => Task::all()
            ]
        );
    }
}
