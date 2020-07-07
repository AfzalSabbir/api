@extends('errors::illustrated-layout')

@section('title', __('Service Unavailable'))
@section('code', '503')
@section('image')
	<img class="img-fluid" src="{{ asset('public/images/illustration/launch.svg') }}" alt="" style="width: 100%">
@endsection
@section('message', __($exception->getMessage() ?: 'Service Unavailable'))
