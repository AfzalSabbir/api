@extends('backend.layouts.master')

@section('fav_title', 'Add brand')

@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-briefcase"></i> {{ __('backend/brand.brand_management') }}</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg fa-fw"></i><a href="{{ route('admin.home') }}">{{ __('backend/default.dashboard') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.brand.index') }}">{{ __('backend/brand.brand') }}</a></li>
        <li class="breadcrumb-item active">{{ __('backend/default.add_new') }}</li>
    </ul>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6 my-auto"><h2><i class="fa fa-plus-square"></i> {{ __('backend/brand.add_brand') }}</h2></div>
                    <div class="col-md-6"><a href="{{ route('admin.brand.index') }}" class="float-right btn btn-primary"><i class="fa fa-arrow-left"></i> {{ __('backend/default.list') }}</a></div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="card-body">
                @include('backend.partials.error_message')
                <form class="form-horizontal" id="myform" action="{{ route('admin.brand.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">
                        <label class="control-label col-md-3 text-right"><strong>
                            {{ __('backend/form_field.name') }} <span class="text-danger">*</span>
                        </strong></label>
                        <div class="col-md-5">
                            <input id="title" class="form-control" type="text" name="title"  required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-md-3 text-right">
                            <strong>
                                {{ __('backend/category.category') }} <span class="text-danger">*</span>
                            </strong>
                        </label>
                        <div class="col-md-5">
                            <select id="category_id" class="form-control" type="text" name="category_id"  required>
                                <option value="" selected disabled>{{ __('backend/form_field.select_category') }}</option>
                                @foreach($category as $key => $row)
                                <option value="{{ $row->id }}">{{ $row->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-3 text-right">
                            <strong>
                                {{ __('backend/subcategory.subcategory') }} <span class="text-danger">*</span>
                            </strong>
                        </label>
                        <div class="col-md-5">
                            <select id="sub_category_id" class="form-control" type="text" name="sub_category_id"  required>
                                <option value="" selected disabled>{{ __('backend/form_field.select_subcategory') }}</option>
                                @foreach($subCategory as $key => $row)
                                <option value="{{ $row->id }}">{{ $row->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-8 mt-3">
                            <button type="submit" name="save" class="btn btn-primary float-right">{{ __('backend/default.submit') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection
