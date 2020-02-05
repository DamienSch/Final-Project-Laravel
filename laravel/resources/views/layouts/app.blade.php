<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--    Bootstrap style    --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" class="">
        @include('include.navbar')

        <main class="py-4">
            @if(Route::has('register'))
                <div class="container">
                    <div class="row justify-content-center">
                        <aside class="container col-md-4">
                            <div class="card">
                                <div class="card-header">Menu</div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        <li class="list-group-item list-group-item-action"><a class="adminNavLinks" href="{{ route('home') }}">Accueil</a></li>
                                        <li class="list-group-item list-group-item-action"><a class="adminNavLinks" href="{{ route('users_gestion') }}">Gestions des utilisateurs</a></li>
                                        <li class="list-group-item list-group-item-action"><a class="adminNavLinks" href="{{ route('crypto_moneys') }}">Crypto monnaies</a></li>
                                    </ul>
                                </div>
                            </div>
                        </aside>
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">Tableau de bord</div>
                                <div class="card-body">
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    @yield('content')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </main>
    </div>
    {{--    Bootstrap script    --}}
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
