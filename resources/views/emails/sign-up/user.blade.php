@extends('emails.layout')

@section('title', 'Successfull Sign Up')

@section('text')
Сongratulations, you have successfully registered.
<a href="{{ route('pages.home') }}">Go to site</a>
@endsection