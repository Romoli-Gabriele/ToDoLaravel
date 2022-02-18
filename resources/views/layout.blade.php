<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </head>
    <body class="bg-secondary">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
              <a class="navbar-brand" href="/">Team To Do List</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                  </li>
                  @auth
                    <li class="nav-item">
                    <a class="nav-link" href="{{route('profile.index')}}">{{auth()->user()->name}}</a>
                    </li>
                    @role('teamleader')
                    <li class="nav-item">
                    <a class="nav-link" href="team/{{auth()->user()->team->id}}/users">Team {{auth()->user()->team->name}}</a>
                    </li>
                    @endrole
                    <li class="nav-item">
                    <a class="nav-link" href="/logout">{{__('layout.logout')}}</a>
                    </li>
                    @role('admin')
                    <li class="nav-item">
                    <a class="nav-link" href="/admin">{{__('layout.allUsers')}}</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="/admin/teams">{{__('layout.allTeam')}} </a>
                    </li>
                    @endrole
                    @endauth
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="/">{{__('layout.login')}}</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="{{route('register')}}">{{__('layout.signIn')}}</a>
                    </li>
                    @endguest
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Languages
                    </a>
                    <ul class="dropdown-menu bg-secondary" aria-labelledby="navbarDropdown">
                    @foreach(config('app.languages') as $langLocale => $langName)
                    <a class="dropdown-item mx-auto" href="/change?change_language={{ $langLocale }}">{{ strtoupper($langLocale) }} ({{ $langName }})</a>
                    @endforeach
                    </ul>
                    </li>
                </ul>
                @auth
                @yield('search')
                @endauth
              </div>
            </div>
          </nav>
        <br>
        @yield('content')
    </body>
</html>
