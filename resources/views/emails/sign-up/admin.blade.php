@extends('emails.layout')

@section('title', 'New Sign Up')

@section('text')
New user, {{ $user->name }}({{ $user->email }}).
@endsection