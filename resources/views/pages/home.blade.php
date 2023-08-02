@extends('pages.layout') 

@section('title', 'Home Page') 

@section('content')

<main class="main">

    <div class="hero">
        <div class="container">
            
            <div class="card">
                <h1 class="hero-title">
                    {{ $content['video_title'] ?? '' }}
                </h1>
                <p class="text">
                    {{ $content['video_subtitle'] ?? '' }}
                </p>
                <form action="{{ route('chat.request') }}" method="GET" id="preview-chat-form">
                    <input id="NewdomainInput" type="text" name="uri" required placeholder="Enter your URL" />
                    <button class="btn" type="submit">Generate</button>
                </form>
            </div>
            
            <div class="chat-prew">
                <div class="container">
                    <h2 class="section-title">chat with AI</h2>
                    <div class="domain-card">
                        <img src="{{ asset('assets/img/domain.svg') }}" alt="" />
                        <p class="text" id="preview-domain">realestate.com</p>
                    </div>
                    <div class="chat-body">
                        <div class="left-bar">
                            <img src="{{ asset('assets/img/brain.svg') }}" alt="" />
                        </div>
                        <div class="generated-text">
                            <div class="text">
                                <!-- Certainly! Here's a brief passage consisting of approximately 1000 symbols:<br /><br /> -->
                                <p class="answer">
                                    
                                </p>
                                <p class="blur-text">
                                    In a world where technology is advancing at an unprecedented pace, we find ourselves constantly adapting to new innovations and ideas. From artificial intelligence and virtual reality to the Internet of Things and blockchain technology, our lives are
                                    being transformed in ways we couldn't have imagined just a few decades ago. With the advent of smartphones, we are more connected than ever before. Social media platforms have become an integral part of our daily routines,
                                    allowing us to connect with friends, share our thoughts, and discover new content. However, this hyperconnectivity comes with its challenges, as we grapple with issues such as privacy concerns, information overload, and online
                                    harassment. <br><br>In a world where technology is advancing at an unprecedented pace, we find ourselves constantly adapting to new innovations and ideas. From artificial intelligence and virtual reality to the Internet of Things and
                                    blockchain technology, our lives are being transformed in ways we couldn't have imagined just a few decades ago. With the advent of smartphones, we are more connected than ever before. Social media platforms have become an
                                    integral part of our daily routines, allowing us to connect with friends, share our thoughts, and discover new content. However, this hyperconnectivity comes with its challenges, as we grapple with issues such as privacy concerns,
                                    information overload, and online harassment. <br><br>is advancing at an unprecedented pace, we find ourselves constantly adapting to new innovations and ideas. From artificial intelligence and virtual reality to the Internet of Things
                                    and blockchain technology, our lives are being transformed in ways we couldn't have imagined just a few decades ago. With the advent of smartphones, we are more connected than ever before. Social media platforms have become
                                    an integral part of our daily routines, allowing us to connect with friends, share our thoughts, and discover new content. However, this hyperconnectivity comes with its challenges, as we grapple with issues such as privacy
                                    concerns, information overload, and online harassment. nprecedented pace, we find ourselves constantly adapting to new innovations and ideas. From artificial intelligence and virtual reality to the Internet of Things and blockchain
                                    technology, our lives are being transformed in ways we couldn't have imagined just a few decades ago. With the advent of smartphones, we are more connected than ever before. Social media platforms have become an integral part
                                    of our daily routines, allowing.
                                </p>
                            </div>
                        </div>
                    </div>
                    <!--<div class="call-toRegist">-->
                    <!--    <img src="{{ asset('assets/img/Info.svg') }}" alt="" />-->
                    <!--    <p class="text">-->
                    <!--        {{ $content['chat_bottom_text'] ?? '' }}-->
                    <!--    </p>-->
                    <!--</div>-->
                   
                    @auth
                        @if(Auth::user()->subscribed('default'))
                        <div class="btn"><a href="{{ route('pages.chat') }}">Go to chat</a></div>
                        @else
                        <div class="btn pay-btn">Pay</div>
                        @endif
                    @endauth
                   
                    @guest
                        <div class="sign-in btn">Sign in</div>
                        <div class="sign-up btn">Sign up</div>
                    @endguest
                
                </div>
            </div>
            
            <div class="video-container" id="video-container">
                <video preload="" controls id="video" poster="{{ Storage::url($content['videopreview_img'] ?? '') }}">
                    <source src="{{ Storage::url($content['video'] ?? '') }}" type="video/mp4"/>
                </video>
                <div class="play-button-wrapper">
                    <div title="Play video" class="play-gif" id="circle-play-b">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80">
                            <path d="M40 0a40 40 0 1040 40A40 40 0 0040 0zM26 61.56V18.44L64 40z"/>
                        </svg>
                    </div>
                </div>
            </div>

        </div>
              <div class="square violet"></div>
      <div class="square blue"></div>
      <div class="square dark-blue"></div>
      <div class="square green"></div>
      <div class="square light-green"></div>
      <div class="square aquamarine"></div>
    </div>

    <section class="steps">
        <div class="container">
            <h2 class="section-title">
                {{ $content['steps_title'] ?? '' }}
            </h2>
            <ul class="step-list">

                @foreach ($content['steps'] ?? [] as $i => $step)
                    <li class="col-1">
                        @if ($i % 2 == 0) 
                            <img src="{{ Storage::url($step['img'] ?? '') }}" alt="" /> 
                        @endif
                        <div class="step-card">
                            <p class="num">{{  str_pad($i + 1, 2, 0, STR_PAD_LEFT) }}</p>
                            <p class="step-title">
                                {{ $step['title'] ?? '' }}
                            </p>
                            <p class="text">
                                {{ $step['text'] ?? '' }}
                            </p>
                        </div>
                        @if ($i % 2 != 0) 
                            <img src="{{ Storage::url($step['img'] ?? '') }}" alt="" /> 
                        @endif
                    </li>
                @endforeach

            </ul>
        </div>
    </section>

    <section class="reviews">
        <div class="container">
            <h2 class="section-title">
                {{ $content['slider_title'] ?? '' }}
            </h2>
            <div class="reviews-slider">
                
                @foreach ($content['slider'] ?? [] as $slide) 
                    <div class="review">
                        <p class="name">{{ $slide['name'] ?? '' }}</p>
                        <p class="position">{{ $slide['position'] ?? '' }}</p>
                        <p class="text">
                            {{ $slide['text'] ?? '' }}
                        </p>
                    </div>
                @endforeach
           
            </div>
        </div>
    </section>

    <section class="advantages">
        <div class="container">
            <h2 class="section-title">
                {{ $content['features_title'] ?? '' }}
            </h2>
            <p class="text">
                {{ $content['features_subtitle'] ?? '' }}
            </p>
            <!-- <a href="#" class="btn">Generate</a> -->
            <ul class="advantages-list">
                
                @foreach($content['features'] ?? [] as $feature)
                    <li class="advantages-item">
                        <img src="{{ Storage::url($feature['img'] ?? '') }}" alt="" />
                        <p class="card-title">{{ $feature['title'] ?? '' }}</p>
                        <p class="text">
                            {{ $feature['text'] ?? '' }}
                        </p>
                    </li>
                @endforeach

            </ul>
            <div class="imgBanner">
                <img src="{{ Storage::url($content['features_img'] ?? '') }}" alt="" />
            </div>
        </div>
    </section>

    <section class="faq">
        <div class="container">
            <h2 class="section-title">{{ $content['faq_title'] ?? '' }}</h2>
            <ul class="faq-list">

                @foreach($content['faq'] ?? [] as $faq)
                    <li class="faq-item">
                        <img src="{{ Storage::url($faq['img'] ?? '') }}" alt="" />
                        <p class="card-title">{{ $faq['title'] ?? '' }}</p>
                        <p class="text">
                            {{ $faq['text'] }}
                        </p>
                    </li>
                @endforeach

            </ul>
        </div>
    </section>

</main>

@endsection
