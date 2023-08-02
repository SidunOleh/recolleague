@extends('emails.layout')

@section('title', 'New Subscription')

@section('text')
New subscription, {{ $user->name }}({{ $user->email }}).
@endsection