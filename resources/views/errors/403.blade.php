@extends('errors::illustrated-layout')

@section('title', __('Forbidden'))
@section('code', '403')
@section('image')
	<img class="img-fluid" src="{{ asset('public/images/illustration/rocket.svg') }}" alt="" style="width: 100%">
@endsection
@section('message', __($exception->getMessage() ?: 'Forbidden'))
