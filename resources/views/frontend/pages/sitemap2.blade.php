<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
@php
  $paginate = 24;
@endphp

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

  {{-- 0.6 --}}
  @for($i=1; $i<=(int)ceil((count($books)/$paginate)); $i++)

  <url>
    <loc>{{ route('book.browse') }}?items={{ $paginate }}&amp;page={{ $i }}</loc>
    <lastmod>{{ date('Y-m-d').'T'.date('H:i:s+06:00') }}</lastmod>
    <priority>0.8</priority>
  </url>
  @endfor


  {{-- 0.6 --}}
  @foreach($books as $book)

  <url>
    <loc>{{ route('book.view.slug', $book->slug) }}</loc>
    <lastmod>{{ date('Y-m-d').'T'.date('H:i:s+06:00') }}</lastmod>
    <priority>0.6</priority>
  </url>
  @endforeach

</urlset>