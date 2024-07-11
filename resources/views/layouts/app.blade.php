@php
    $locale = app()->getLocale();
    $locales = config('app.locales');
    $flags = config('app.locale_flags');
@endphp

<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logo Bags</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
       <a class="navbar-brand js-scroll-trigger" href="{{ route('home') }}"><img src="{{ asset('/images/logo.png') }}" class="img-fluid" alt="Logo"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{Request::routeIs('home') ? 'active' : ''}}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link {{Request::routeIs('about') ? 'active' : ''}}" href="{{ route('about') }}">{{ __('messages.about') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{Request::routeIs('email') ? 'active' : ''}}" href="{{ route('email') }}">{{ __('messages.contacts') }}</a>
                </li>
                {{-- inizio --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ __('messages.search') }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        @foreach ($types as $type)
                            <li><a class="dropdown-item"
                                    href="{{ route('products.type', ['type' => $type->name]) }}">{{ $type->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                {{-- fine --}}
                <li class="nav-item">
                    <a class="nav-link {{Request::routeIs('admin.dashboard') ? 'active' : ''}}" href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown text-white">
                        <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            @if(isset($locale) && isset($flags[$locale]))
                                <img src="{{ $flags[$locale] }}" alt="{{ strtoupper($locale) }}" width="20"> {{ strtoupper($locale) }}
                            @else
                                {{ strtoupper($locale) }}
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark text-white"
                            aria-labelledby="languageDropdown">
                            @foreach ($locales as $lang => $language)
                                @if ($lang != $locale)
                                    <li>
                                        <a class="dropdown-item" href="{{ route('switchLang', $lang) }}">
                                            @if(isset($flags[$lang]))
                                                <img src="{{ $flags[$lang] }}" alt="{{ strtoupper($lang) }}" width="20"> {{ strtoupper($lang) }}
                                            @else
                                                {{ strtoupper($lang) }}
                                            @endif
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li> 
                </ul>       
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container text-center" >
        <h1>{{ __('messages.luxury') }}</h1>
        <h5>{{ __('messages.made') }}</h5><br><br><br>
    </div>
</section>

<!-- Content Section -->
<section class="content-section py-5">
    <div class="container">
        @yield('content')
    </div>
</section>

<!-- Footer -->
<footer class="footer-section ">
    <div class="container text-center">
        <p>&copy; 2024 Logo Bags p.iva 0000000000 Nadiro - {{ __('messages.italy') }}. <br>All Rights Reserved.</p>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
