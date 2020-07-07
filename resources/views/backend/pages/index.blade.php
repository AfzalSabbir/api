@extends('backend.layouts.master')

@section('fav_title', __('backend/default.dashboard') )

@section('content')

<div class="app-title">
  <div>
    <h1><i class="fa fa-dashboard"></i> {{ __('backend/default.dashboard') }}</h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i> {{ __('backend/default.dashboard') }}</li>
  </ul>
</div>

<div class="form-row">

  <div class="col-md-4">
    <a href="" @click.prevent class="dashbox dash-1 pb-2 pt-0">
      <i class="fa fa-users fa-3x d-block mx-auto py-2"></i>
      <div class="mt-2">
        <h3 class="mb-0">Users</h3>
        <p class="mb-0">101</p>
      </div>
    </a>
  </div>
  <div class="col-md-4">
    <a href="" @click.prevent class="dashbox dash-2 pb-2 pt-0">
      <i class="fa fa-cubes fa-3x d-block mx-auto py-2"></i>
      <div class="mt-2">
        <h3 class="mb-0">Categories</h3>
        <p class="mb-0">224</p>
      </div>
    </a>
  </div>
  <div class="col-md-4">
    <a href="" @click.prevent class="dashbox dash-3 pb-2 pt-0">
      <i class="fa fa-envelope fa-3x d-block mx-auto py-2"></i>
      <div class="mt-2">
        <h3 class="mb-0">SMS</h3>
        <p class="mb-0">1209</p>
      </div>
    </a>
  </div>
  <div class="col-md-4 d-none">
    <a href="" @click.prevent class="dashbox dash-4 pb-2 pt-0">
      <i class="fa fa-star fa-3x d-block mx-auto py-2"></i>
      <div class="mt-2">
        <h3 class="mb-0">Stars</h3>
        <p class="mb-0">812</p>
      </div>
    </a>
  </div>
</div>

<hr>

<div class="form-row">
  <div class="col-md-3">
    <a href="" @click.prevent class="dashbox dash-12 py-0 d-flex text-left">
      <i class="fa fa-users fa-4x p-3 justify-content-center align-content-center"></i>
      <span class="mb-0 w-100 py-2 px-2">
        <h3 class="mb-0">Users</h3>
        <p class="mb-0">101</p>
      </span>
    </a>
  </div>
  <div class="col-md-3">
    <a href="" @click.prevent class="dashbox dash-11 py-0 d-flex text-left">
      <i class="fa fa-cubes fa-4x p-3 justify-content-center align-content-center"></i>
      <span class="mb-0 w-100 py-2 px-2">
        <h3 class="mb-0">Categories</h3>
        <p class="mb-0">224</p>
      </span>
    </a>
  </div>
  <div class="col-md-3">
    <a href="" @click.prevent class="dashbox dash-10 py-0 d-flex text-left">
      <i class="fa fa-envelope fa-4x p-3 justify-content-center align-content-center"></i>
      <span class="mb-0 w-100 py-2 px-2">
        <h3 class="mb-0">SMS</h3>
        <p class="mb-0">1209</p>
      </span>
    </a>
  </div>
  <div class="col-md-3">
    <a href="" @click.prevent class="dashbox dash-9 py-0 d-flex text-left">
      <i class="fa fa-star fa-4x p-3 justify-content-center align-content-center"></i>
      <span class="mb-0 w-100 py-2 px-2">
        <h3 class="mb-0">Stars</h3>
        <p class="mb-0">812</p>
      </span>
    </a>
  </div>
</div>

<hr>

<div class="form-row">
  <div class="col-md-6 col-lg-3">
    <div class="widget-small info coloured-icon">
      <i class="icon fa fa-users fa-3x"></i>
      <div class="info">
        <h4>Users</h4>
        <p><b>101</b></p>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-3">
    <div class="widget-small warning coloured-icon">
      <i class="icon fa fa-cubes fa-3x"></i>
      <div class="info">
        <h4>Categories</h4>
        <p><b>224</b></p>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-3">
    <div class="widget-small primary coloured-icon">
      <i class="icon fa fa-envelope fa-3x"></i>
      <div class="info">
        <h4>SMS</h4>
        <p><b>1209</b></p>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-3">
    <div class="widget-small danger coloured-icon">
      <i class="icon fa fa-star fa-3x"></i>
      <div class="info">
        <h4>Stars</h4>
        <p><b>812</b></p>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
@endsection