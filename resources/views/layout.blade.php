<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    </head>
    <body>
        <nav>
            <form action="{{url()->current()}}" method="GET">
                <select name="change_language">
                @foreach (config('translations.languages') as $ln => $language)
                    <option value="{{$ln}}">{{$language}}</option>
                @endforeach
                </select>
                <button type="submit">{{__('Change')}}</button>
            </form>
            <a href="/"><h1>{{__('Team To Do List')}}</h1></a>
            @auth
                <h3>{{__('Welcome Back')}} <a href="{{route('profile.index')}}">{{auth()->user()->name}}</a>
                    @role('teamleader')
                    <a href="team/{{auth()->user()->team->id}}/users">Team {{auth()->user()->team->name}}</a>
                    @endrole
                </h3>
                <a href="/logout">{{__('Logout')}}</a>
                @role('admin')
                    <a href="/admin">{{__('All Users')}}</a>
                    <a href="/admin/teams">{{__('All Team')}} </a>
                @endrole
            @endauth
            @guest
                <a href="/">{{__('Login')}}</a>
                <a href="{{route('register')}}">{{__('Sign In')}}</a>
            @endguest
        </nav>
        <br>
        @yield('content')
    </body>
</html>
