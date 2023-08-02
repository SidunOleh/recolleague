@extends('emails.layout')

@section('title', 'Successfull Updated Payment')

@section('text')
You have successfully updated payment.
<a href="{{ route('pages.home') }}">Go to site</a>
@endsection