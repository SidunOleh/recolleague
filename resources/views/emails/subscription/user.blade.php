@extends('emails.layout')

@section('title', 'Successfull Subscription')

@section('text')
Сongratulations, you have successfully subscribed.
<a href="{{ route('pages.home') }}">Go to site</a>
@endsection