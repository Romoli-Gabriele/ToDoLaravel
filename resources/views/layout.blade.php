<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    </head>
    <body>
        <nav>
            <div class="dropdown-menu dropdown-menu-right">
                @foreach(config('app.languages') as $langLocale => $langName)
                    <a class="dropdown-item" href="/change?change_language={{ $langLocale }}">{{ strtoupper($langLocale) }} ({{ $langName }})</a>
                @endforeach
            </div>
            <a href="/"><h1>Team To Do List</h1></a>
            @auth
                <h3>{{__('layout.welcome')}} <a href="{{route('profile.index')}}">{{auth()->user()->name}}</a>
                    @role('teamleader')
                    <a href="team/{{auth()->user()->team->id}}/users">Team {{auth()->user()->team->name}}</a>
                    @endrole
                </h3>
                <a href="/logout">{{__('layout.logout')}}</a>
                @role('admin')
                    <a href="/admin">{{__('layout.allUsers')}}</a>
                    <a href="/admin/teams">{{__('layout.allTeam')}} </a>
                @endrole
            @endauth
            @guest
                <a href="/">{{__('layout.login')}}</a>
                <a href="{{route('register')}}">{{__('layout.signIn')}}</a>
            @endguest
        </nav>
        <br>
        @yield('content')
    </body>
</html>
