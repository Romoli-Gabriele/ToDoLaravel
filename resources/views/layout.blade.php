<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    </head>
    <body>
        <nav>
            <a href="/"><h1>Team To Do List</h1></a>
            @auth
                <h3>Welcome Back {{auth()->user()->name}} Team {{auth()->user()->team->name}}</h3>
            @endauth
            <br>
            
            @auth
                    <form method="GET" action="/">
                        @if(auth()->user()->isLeader())
                        <a href="admin/delete"><b>Delete Task</b></a>
                        @endif
                        <a href="/add"><b>Add Task</b></a>
                        <a href="/logout"><b>Logout</b></a>
                        @if (request('team'))
                            <input type="hidden" name="category" value="{{request('category')}}">
                        @endif
                        <input type="text" value="{{request('search')}}" name="search" placeholder="Find something" class="bg-transparent placeholder-black font-semibold text-sm">
                        <button type="submit">Search</button>
                    </form>
                </div>

            @else
                <a href="/login"><b>Login</b></a>
                <a href="/sing-in"><b>Sing In</b></a>
            @endauth
        </nav>
        <br>
        @yield('content')
    </body>
</html>
