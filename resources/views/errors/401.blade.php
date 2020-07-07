@extends('errors::illustrated-layout')

@section('title', __('Unauthorized'))
@section('code', '401')
@section('image')
	<img class="img-fluid" src="{{ asset('public/images/illustration/support.svg') }}" alt="" style="width: 100%">
@endsection
@section('message', __('Unauthorized'))
