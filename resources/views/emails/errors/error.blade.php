@extends('emails.layout')

@section('title', 'Error')

@section('text')
<h2>Message</h2>
<p>{{ $error->getMessage() }}</p>
<h2>Trace</h2>
<p>{{ $error->getTraceAsString() }}</p>
@endsection