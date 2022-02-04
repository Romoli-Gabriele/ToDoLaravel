<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    </head>
    <body>
        <nav>
            <a href="/"><h1>Team To Do List</h1></a>
            @auth
                <h3>Welcome Back <a href="{{route('profile.index')}}">{{auth()->user()->name}}</a> Team {{auth()->user()->team->name}}</h3>
                <a href="/logout">Logout</a>
                @if(auth()->user()->isAdmin())
                    <a href="/admin">All Users</a>
                    <a href="/admin/teams">All Team </a>
                @elseif(auth()->user()->isLeader())
                    <a href="team/users">All Team Users</a>
                @endif
            @endauth
            @guest
                <a href="/">Login</a>
                <a href="{{route('register')}}">Sign In</a>
            @endguest
        </nav>
        <br>
        @yield('content')
    </body>
</html>
