@extends('errors::illustrated-layout')

@section('title', __('Server Error'))
@section('code', '500')
@section('image')
	<img class="img-fluid" src="{{ asset('public/images/illustration/horse.svg') }}" alt="" style="width: 100%">
@endsection
@section('message', __('Server Error'))
