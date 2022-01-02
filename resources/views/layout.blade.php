<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    </head>
    <body>
        <nav>
            <a href="/"><h1>Team To Do List</h1></a>
            @auth
                <h3>Welcome Back {{auth()->user()->name}}</h3>
            @endauth
            <br>
            <a href="/delete"><b>Delete Done Task</b></a>
            @auth
                <a href="/add"><b>Add Task</b></a>
                <a href="/logout"><b>Logout</b></a>
            @else
                <a href="/login"><b>Login</b></a>
                <a href="/sing-in"><b>Sing In</b></a>
            @endauth
        </nav>
        <br>
        @yield('content')
    </body>
</html>
