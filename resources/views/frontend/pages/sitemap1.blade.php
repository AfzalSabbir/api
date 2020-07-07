<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
@php
  $paginate = 24;
@endphp

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

  {{-- 1.0 --}}
  <url>
    <loc>{{ url('/') }}</loc>
    <lastmod>{{ date('Y-m-d').'T'.date('H:i:s+06:00') }}</lastmod>
    <priority>1.0</priority>
  </url>
  <url>
    <loc>{{ url('/recover-username') }}</loc>
    <lastmod>{{ date('Y-m-d').'T'.date('H:i:s+06:00') }}</lastmod>
    <priority>1.0</priority>
  </url>
  <url>
    <loc>{{ url('/send-password-reset-code') }}</loc>
    <lastmod>{{ date('Y-m-d').'T'.date('H:i:s+06:00') }}</lastmod>
    <priority>1.0</priority>
  </url>
  <url>
    <loc>{{ url('/login') }}</loc>
    <lastmod>{{ date('Y-m-d').'T'.date('H:i:s+06:00') }}</lastmod>
    <priority>1.0</priority>
  </url>
  <url>
    <loc>{{ url('/register') }}</loc>
    <lastmod>{{ date('Y-m-d').'T'.date('H:i:s+06:00') }}</lastmod>
    <priority>1.0</priority>
  </url>
  <url>
    <loc>{{ url('/search') }}</loc>
    <lastmod>{{ date('Y-m-d').'T'.date('H:i:s+06:00') }}</lastmod>
    <priority>1.0</priority>
  </url>
  <url>
    <loc>{{ url('/about') }}</loc>
    <lastmod>{{ date('Y-m-d').'T'.date('H:i:s+06:00') }}</lastmod>
    <priority>1.0</priority>
  </url>
  <url>
    <loc>{{ url('/privacy-policy') }}</loc>
    <lastmod>{{ date('Y-m-d').'T'.date('H:i:s+06:00') }}</lastmod>
    <priority>1.0</priority>
  </url>
  <url>
    <loc>{{ url('/terms-and-conditions') }}</loc>
    <lastmod>{{ date('Y-m-d').'T'.date('H:i:s+06:00') }}</lastmod>
    <priority>1.0</priority>
  </url>
  <url>
    <loc>{{ url('/cookies-policy') }}</loc>
    <lastmod>{{ date('Y-m-d').'T'.date('H:i:s+06:00') }}</lastmod>
    <priority>1.0</priority>
  </url>


  {{-- 0.8 --}}
  <url>
    <loc>{{ url('/?dev=1/') }}</loc>
    <lastmod>{{ date('Y-m-d').'T'.date('H:i:s+06:00') }}</lastmod>
    <priority>0.8</priority>
  </url>
  <url>
    <loc>{{ url('/book/browse') }}</loc>
    <lastmod>{{ date('Y-m-d').'T'.date('H:i:s+06:00') }}</lastmod>
    <priority>0.8</priority>
  </url>
  <url>
    <loc>{{ url('/district/view') }}</loc>
    <lastmod>{{ date('Y-m-d').'T'.date('H:i:s+06:00') }}</lastmod>
    <priority>0.8</priority>
  </url>
  <url>
    <loc>{{ url('/upazila/view') }}</loc>
    <lastmod>{{ date('Y-m-d').'T'.date('H:i:s+06:00') }}</lastmod>
    <priority>0.8</priority>
  </url>
  <url>
    <loc>{{ url('/book/wish-list') }}</loc>
    <lastmod>{{ date('Y-m-d').'T'.date('H:i:s+06:00') }}</lastmod>
    <priority>0.8</priority>
  </url>


  {{-- 0.6 --}}
  <url>
    <loc>{{ url('/book/browse/free') }}</loc>
    <lastmod>{{ date('Y-m-d').'T'.date('H:i:s+06:00') }}</lastmod>
    <priority>0.6</priority>
  </url>


  {{-- 0.4 --}}
  @foreach($grades as $grade)

  <url>
    <loc>{{ route('book.grade.browse', $grade->slug) }}</loc>
    <lastmod>{{ date('Y-m-d').'T'.date('H:i:s+06:00') }}</lastmod>
    <priority>0.4</priority>
  </url>
  @endforeach
  @foreach($districts as $district)

  <url>
    <loc>{{ route('book.district.district_name.browse', $district->slug) }}</loc>
    <lastmod>{{ date('Y-m-d').'T'.date('H:i:s+06:00') }}</lastmod>
    <priority>0.4</priority>
  </url>
  @endforeach
  @foreach($upazilas as $upazila)

  <url>
    <loc>{{ route('book.upazila.upazila_name.browse', $upazila->slug) }}</loc>
    <lastmod>{{ date('Y-m-d').'T'.date('H:i:s+06:00') }}</lastmod>
    <priority>0.4</priority>
  </url>
  @endforeach
</urlset>