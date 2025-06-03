<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Human Resources Management System') }}</title>
    <!-- Animate.css CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @yield('head')
    <style>
        .btn:hover, .nav-link:hover {
            transition: transform 0.2s;
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
         <div class="container">
             <a class="navbar-brand" href="/">Human Resources Management System</a>
             <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                 <span class="navbar-toggler-icon"></span>
             </button>
             <div class="collapse navbar-collapse" id="navbarNav">
                 <ul class="navbar-nav ms-auto">
                     <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                     @auth
                         <li class="nav-item dropdown">
                             <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> {{ Auth::user()->name }} </a>
                             <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                 <li><a class="dropdown-item" href="{{ route('home') }}">Dashboard</a></li>
                                 <li><hr class="dropdown-divider"></li>
                                 <li>
                                     <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                                         @csrf
                                         <button type="submit" class="dropdown-item">Logout</button>
                                     </form>
                                 </li>
                             </ul>
                         </li>
                     @else
                         <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                         <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                     @endauth
                 </ul>
             </div>
         </div>
     </nav>
     <main class="container my-4">
         @yield('content')
     </main>
     <footer class="bg-dark text-light py-3 mt-5">
         <div class="container text-center">
             <p> © {{ date('Y') }} Human Resources Management System. All rights reserved. </p>
         </div>
     </footer>
     <script src="/js/app.js"></script>
</body>
</html>
