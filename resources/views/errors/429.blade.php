@extends('errors::illustrated-layout')

@section('title', __('Too Many Requests'))
@section('code', '429')
@section('image')
	<img class="img-fluid" src="{{ asset('public/images/illustration/img-5.png') }}" alt="" style="width: 100%">
@endsection
@section('message', __('Too Many Requests'))
