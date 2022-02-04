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
                <a href="/logout"><b>Logout</b></a>
                @if(auth()->user()->isAdmin())
                    <a href="/admin"><b>All Users</b></a>
                @elseif(auth()->user()->isLeader())
                    <a href="team/users"><b>All Team Users</b></a>
                @endif
            @endauth
            @guest
                <a href="/"><b>Login</b></a>
                <a href="{{route('register')}}"><b>Sign In</b></a>
            @endguest
        </nav>
        <br>
        @yield('content')
    </body>
</html>
