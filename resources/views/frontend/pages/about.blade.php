@extends('frontend.layouts.master')

@section('fav_title', __('backend/default.about_us'))

@section('styles')
  @include('frontend.partials.owl-carousel.style')
@endsection

@section('content')
<!-- .page-inner -->
<div class="page-inner pt-2 pb-0">
  <div class="container px-0 px-lg-2">
    <div class="row">
      <div class="col-lg-6">
        {{-- <span style="font-family: 'Niconne';font-size: 3.5rem;font-weight: 600;line-height: 55px;">A<sup>rsss</sup>N</span> --}}
        <h1>About Us <sup class="text-muted">[demo]</sup></h1>
        <p class="text-justify">Welcome to ArsssN, your number one source for all things [product]. We're dedicated to giving you the very best of [product], with a focus on [store characteristic 1], [store characteristic 2], [store characteristic 3].</p>


        <p class="text-justify">Founded in [year] by [founder name], ArsssN has come a long way from its beginnings in [starting location]. When [founder name] first started out, [his/her/their] passion for [brand message - e.g. "eco-friendly cleaning products"] drove them to [action: quit day job, do tons of research, etc.] so that ArsssN can offer you [competitive differentiator - e.g. "the world's most advanced toothbrush"]. We now serve customers all over [place - town, country, the world], and are thrilled that we're able to turn our passion into [my/our] own website.</p>


        <p class="text-justify">[I/we] hope you enjoy [my/our] products as much as [I/we] enjoy offering them to you. If you have any questions or comments, please don't hesitate to contact [me/us].</p>


        <p class="text-justify">Sincerely,<br/>
        [founder name]</p>


      </div>
      <div class="offset-3 col-lg-3 d-none d-lg-block">
        @include('frontend.partials.grade', ['right_side' => $carousel])
        @include('frontend.partials.important_links')
      </div>
    </div>
  </div>
</div><!-- /.page-inner -->
@endsection

@section('scripts')
  @include('frontend.partials.owl-carousel.script')
@endsection