@extends('errors::illustrated-layout')

@section('title', __('Not Found'))
@section('code', '404')
@section('image')
	<img class="img-fluid" src="{{ asset('public/images/illustration/img-6.svg') }}" alt="" style="width: 100%">
@endsection
@section('message', __('Not Found'))
