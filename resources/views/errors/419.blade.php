@extends('errors::illustrated-layout')

@section('title', __('Page Expired'))
@section('code', '419')
@section('image')
	<img class="img-fluid" src="{{ asset('public/images/illustration/brain.svg') }}" alt="" style="width: 100%">
@endsection
@section('message', __('Page Expired'))
