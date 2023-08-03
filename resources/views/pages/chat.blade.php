@extends('pages.layout') 

@section('title', 'Chat Page') 

@section('content')

<main class="main chat-main">
    <div class="square violet"></div>
    <div class="square blue"></div>
    <div class="square dark-blue"></div>
    <div class="square green"></div>
    <div class="square light-green"></div>
    <div class="square aquamarine"></div>
    <div class="container">
        
        <h2 class="section-title">{{ $content['chat_title'] ?? '' }}</h2>
        
        <div class="chat-top">
            <div class="left">
                <div class="domain-card">
                    <img src="{{ asset('assets/img/domain.svg') }}" alt="" />
                    @php 
                        $uri = session()->pull('chat_request.uri') 
                    @endphp
                    <input 
                        id="NewdomainInput" 
                        type="text" 
                        name="uri" 
                        required 
                        placeholder="Enter your URL" 
                        form="chat-form"
                        value="{{ $uri }}" />
                </div>
                <form action="{{ route('chat.request') }}" method="GET" id="chat-form">
                    <select name="style" class="style-answer" id="style">
                        <option value="No" selected>Select description style</option>

                        @foreach ($chatRequest->styles ?? [] as $style)
                            <option value="{{ $style['name'] }}">{{ $style['name'] }}</option>
                        @endforeach
                    </select>
                </form>
            </div>

            <button class="btn" type="submit" form="chat-form">Generate</button>
        </div>
        
        <div class="chat-container {{ $uri ? 'open' : '' }}">
            <div class="selected-style">
                <img src="{{ asset('assets/img/brain.svg') }}" alt="" />
                <p class="style-name text"><span></span> Style</p>
            </div>
            
            <div class="chat-body">
                <div class="left-bar">
                    <img src="{{ asset('assets/img/brain.svg') }}" alt="" />

                    <div class="coppy" id="copyButton">
                        <img src="{{ asset('assets/img/copy.svg') }}" alt="" />
                        <div class="success" id="success">
                            <img src="{{ asset('assets/img/check.svg') }}" alt="" />
                        </div>
                    </div>
                </div>
                
                <div class="generated-text">
                    <div class="text" id="textBlock">
                        @if (session()->has('chat_request.request_text'))
                            <div class="answer">
                                {!!session()->pull('chat_request.request_text') !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <!--<div class="chat-footer">-->
        <!--    <div class="call-toRegist">-->
        <!--        <img src="{{ asset('assets/img/Info.svg') }}" alt="" />-->
        <!--        <p class="text">-->
        <!--            {{ $content['chat_bottom_text'] ?? '' }}-->
        <!--        </p>-->
        <!--    </div>-->
        <!--    <input -->
        <!--        id="NewdomainInput" -->
        <!--        type="text" -->
        <!--        name="uri" -->
        <!--        required -->
        <!--        placeholder="Enter your URL" -->
        <!--        form="chat-form"-->
        <!--        value="{{ $uri }}" />-->
        <!--</div>-->
    
    </div>
</main>

@endsection