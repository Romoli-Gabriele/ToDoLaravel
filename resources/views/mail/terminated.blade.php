<!DOCTYPE html>
<body>
    <div>
        <h4>{{$user}} done a Task!</h4>
        <br>
        {{$task->descrizione}}
        <br>
        <br>
        <label>Created by </label>{{$task->user->name}}
    </div>
</body>
