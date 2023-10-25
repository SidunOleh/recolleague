<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta property="og:image" content="{{ Storage::url($content['social_media_img'] ?? '') }}" /> 

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | REC</title>
    <link rel="icon" type="image/png" href="/favicon.png">
    
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap"
      rel="stylesheet"/>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
    
</head>
<body>

    <div class="wrapper">

        <header class="header">
            
            <a href="{{ route('pages.home') }}" class="logo-link">
                <img class="logo" src="{{ Storage::url($content['logo'] ?? '') }}" alt="" />
                <p class="title">Real Estate<span>Colleague</span></p>
            </a>
            
            @guest
            <div class="header-btn">
                <div class="sign-in btn">Sign in</div>
                <div class="sign-up btn">Sign up</div>
            </div>
            @endguest

            @auth
            <div class="header-account">
                <p class="text">My account</p>
                <p class="email text" id="userMail">
                    {{ Auth::user()->email }}
                </p>
                <img src="{{ asset('assets/img/ExpandArrow.svg') }}" alt="" />
                <ul class="menu-list">

                    @if (Auth::user()->is_admin)
                    <li class="menu-item">
                        <a href="{{ route('pages.chat') }}">Chat</a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('admin.index') }}">Admin</a>
                    </li>
                    @else
                        @if (Auth::user()->subscribed('default'))
                        <li class="menu-item">
                            <a href="{{ route('pages.chat') }}">Chat</a>
                        </li>
                        <li class="menu-item payment">
                            Payment
                        </li>
                        @else
                        <li class="menu-item pay">
                            Pay
                        </li>
                        @endif
                    @endif
                    
                    <li class="menu-item logout">
                        <a href="{{ route('auth.logout') }}">Logout</a>
                    </li>
                    
                </ul>
            </div>
            @endauth
        
        </header>

        @yield('content')

        <footer class="footer">
            <div class="container" style="justify-content: center">
                
                <div class="footer-left">
                    <img class="logo" src="{{ Storage::url($content['footer_logo'] ?? '') }}" alt="" />
                    <p class="text">{{ $content['footer_text'] ?? '' }}</p>
                </div>
            
                @guest
                <div class="footer-right">
                    <div class="sign-in btn">Sign in</div>
                    <div class="sign-up btn">Sign up</div>
                </div>
                @endguest
            </div>
        
        </footer>
    
    </div>

    @guest
        @include('popups.signin')
        @include('popups.signup')
        @include('popups.forgot-password')
        @include('popups.payment')
    @endguest

    @auth        
        @if (Auth::user()->subscribed('default'))
            @include('popups.change-payment')
        @else
            @include('popups.payment')
        @endif
    @endauth
        
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script src="{{ asset('assets/js/slick.min.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>
</body>
</html>