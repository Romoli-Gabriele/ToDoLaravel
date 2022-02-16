<!DOCTYPE html>
<body>
    <div>
        <h4>You have a new assigned Task!</h4>
        <label>Assigned by </label>{{$user->name}}
        <br>
        {{$task->descrizione}}
        <br>
        <label>Created by</label>{{$task->user->name}}
    </div>
</body>
