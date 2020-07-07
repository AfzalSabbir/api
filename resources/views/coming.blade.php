<!DOCTYPE html>
<html lang="en">
<?php

    if(!empty($_GET['ref'])) {
        if($_GET['ref']==1) echo 'Thank You!<br />'.'<a href="https://boinaw.com">Go Back</a>';
        else echo 'Ooops..<br />'.'<a href="https://boinaw.com">Go Back</a>';
        die();
    }
    // header('Access-Control-Allow-Origin: *');
    // header('Access-Control-Allow-Methods: *');
    // header('Access-Control-Allow-Headers: Origin, X-Requested-With, Authorization, Content-Type, Accept');
?>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><!-- End Required meta tags -->
    <!-- Begin SEO tag -->
    <title> শীঘ্রই চালু হচ্ছে  </title>
    <meta property="og:title" content="Coming Soon">
    <meta name="author" content="Beni Arisandi">
    <meta property="og:locale" content="en_US">
    <meta name="description" content="Responsive admin theme build on top of Bootstrap 4">
    <meta property="og:description" content="Responsive admin theme build on top of Bootstrap 4">
    <link rel="canonical" href="index-2.html">
    <meta property="og:url" content="index-2.html">
    <meta property="og:site_name" content="Looper - Bootstrap 4 Admin Theme">
    <script type="application/ld+json">
      {
        "name": "Looper - Bootstrap 4 Admin Theme",
        "description": "Responsive admin theme build on top of Bootstrap 4",
        "author":
        {
          "@type": "Person",
          "name": "Beni Arisandi"
        },
        "@type": "WebSite",
        "url": "",
        "headline": "Coming Soon",
        "@context": "https://schema.org"
      }
    </script><!-- End SEO tag -->
    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('public/images/settings/favicon-1588629704.png') }}">
    <link rel="shortcut icon" href="{{ asset('public/images/settings/favicon-1588629704.png') }}">
    <meta name="theme-color" content="#3063A0"><!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600" rel="stylesheet"><!-- End Google font -->
    <!-- BEGIN PLUGINS STYLES -->
    <!--<link rel="stylesheet" href="{{ asset('public/vendor/%40fontawesome/fontawesome-free/css/all.min.css') }}">-->
    <!-- END PLUGINS STYLES-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- END PLUGINS STYLES-->
    <!-- BEGIN THEME STYLES -->
    <link rel="stylesheet" href="{{ asset('public/stylesheets/theme.min.css') }}" data-skin="default">
    <link rel="stylesheet" href="{{ asset('public/stylesheets/theme-dark.min.css') }}" data-skin="dark">
    <link rel="stylesheet" href="{{ asset('public/stylesheets/custom.css') }}">
    <script>
      var skin = localStorage.getItem('skin') || 'default';
      var isCompact = JSON.parse(localStorage.getItem('hasCompactMenu'));
      var disabledSkinStylesheet = document.querySelector('link[data-skin]:not([data-skin="' + skin + '"])');
      // Disable unused skin immediately
      disabledSkinStylesheet.setAttribute('rel', '');
      disabledSkinStylesheet.setAttribute('disabled', true);
      // add flag class to html immediately
      if (isCompact == true) document.querySelector('html').classList.add('preparing-compact-menu');
    </script><!-- END THEME STYLES -->
  </head>
  <body>
    <?php
        $starts_at  = strtotime(date('2020-07-20 00:00:00'));
        $now        = time();
        // echo file_get_contents('https://dev.boinaw.com/myapi');
        // die();
    ?>
    <!--[if lt IE 10]>
    <div class="page-message" role="alert">You are using an <strong>outdated</strong> browser. Please <a class="alert-link" href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</div>
    <![endif]-->
    <!-- .empty-state -->
    <main class="empty-state empty-state-fullpage bg-warning text-black" style="background-image: url({{ asset('public/images/illustration/img-1.png') }};">
      <!-- .empty-state-container -->
      <div class="empty-state-container">
        <div id="clock" class="countdown display-1 text-white bg-warning">
          <div class="countdown-item"> -- <small>দিন</small>
          </div>
          <div class="countdown-item"> -- <small>ঘন্টা</small>
          </div>
          <div class="countdown-item"> -- <small>মিনিট</small>
          </div>
          <div class="countdown-item"> -- <small>সেকেন্ড</small>
          </div>
        </div>
        @php($setting = \App\Models\Setting::first())
        <h1 class="state-header" style="letter-spacing: 4px;"> শীঘ্রই চালু হচ্ছে </h1>
        <p class="state-description lead"> সাবস্ক্রাইব করে রাখুন,<br />আমরা লাইভ হবার পর আপনাকে ইমেইল-এর মাধ্যমে জানাবো।<br />ডেমো দেখতে <a href="{{ url('/?dev=1') }}" title="ডেভেলাপার ভার্সন-এর জন্য ক্লিক করুন">এখানে ক্লিক করুন</a>।</p>
        <p class="state-description lead mb-0"><a href="{{ url('/?dev=1') }}" class="text-secondary" title="ডেভেলাপার ভার্সন-এর জন্য ক্লিক করুন"><i class="fa fa-home fa-3x"></i></a></p>
        <form class="w-75 mx-auto" method="POST" action="{{ url('/my-api/guest/subscribe') }}">
          <div class="form-group">
            <div class="input-group bg-white border-white input-group-lg circle">
              <input type="email" name="email" autocomplete="off" class="form-control text-black" placeholder="আপনার ইমেইল">
              <div class="input-group-append">
                <button type="submit" class="btn btn-primary circle"><span class="d-none d-sm-inline">সাবস্ক্রাইব</span> <span class="d-inline d-sm-none" aria-label="Subcribe"><i class="fa fa-arrow-right"></i></span></button>
              </div>
            </div>
          </div>
        </form>
        <div class="state-action">
          <a href="{{ url($setting->facebook) }}" terget="_blank" class="btn btn-reset"><i class="fa fa-fw fa-facebook"></i></a> <a href="{{ url($setting->twitter) }}" class="btn btn-reset"><i class="fa fa-fw fa-twitter"></i></a> <a href="{{ '#' }}" class="btn btn-reset"><i class="fa fa-fw fa-instagram"></i></a> <a href="{{ url($setting->youtube) }}" class="btn btn-reset"><i class="fa fa-fw fa-youtube"></i></a> <a href="{{ url($setting->linkedin) }}" class="btn btn-reset"><i class="fa fa-fw fa-linkedin"></i></a>
        </div>
      </div><!-- /.empty-state-container -->
      
      <a style="position: absolute; bottom: 0;" class="copyrighted-badge" title="Copyrighted.com Registered &amp; Protected" target="_blank" href="https://www.copyrighted.com/website/IQ7kTZ6PBYUn6GjO"><img alt="Copyrighted.com Registered &amp; Protected" border="0" width="125" height="25" srcset="https://static.copyrighted.com/badges/125x25/01_2_2x.png 2x" src="https://static.copyrighted.com/badges/125x25/01_2.png" /></a><script src="https://static.copyrighted.com/badges/helper.js"></script>
    </main><!-- /.empty-state -->
    <!-- BEGIN BASE JS -->
    <script src="{{ asset('public/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('public/vendor/popper.js/umd/popper.min.js') }}"></script>
    <script src="{{ asset('public/vendor/bootstrap/js/bootstrap.min.js') }}"></script> <!-- END BASE JS -->
    <!-- BEGIN THEME JS -->
    <script src="{{ asset('public/javascript/theme.min.js') }}"></script> <!-- END THEME JS -->
    <!-- BEGIN JS -->
    <script>
      // Set the date we're counting down to
      var countDownDate = new Date('July 20, 2020 00:00:00').getTime();
      var countDownFormater = function(i)
      {
        return i < 10 ? '0' + i : i;
      }
      // Update the count down every 1 second
      var countDown = setInterval(function()
      {
        // Get todays date and time
        var now = new Date().getTime();
        // Find the distance between now an the count down date
        var distance = countDownDate - now;
        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        // Display the result in the element with id='clock'
        document.querySelector('#clock').innerHTML = '' + '<div class="countdown-item">' + countDownFormater(days) + ' <small>দিন<\/small><\/div>' + '<div class="countdown-item">' + countDownFormater(hours) + ' <small>ঘন্টা<\/small><\/div>' + '<div class="countdown-item">' + countDownFormater(minutes) + ' <small>মিনিট<\/small><\/div>' + '<div class="countdown-item">' + countDownFormater(seconds) + ' <small>সেকেন্ড<\/small><\/div>';
        // If the count down is finished, write some text
        if (distance < 0)
        {
          clearInterval(countDown);
          document.querySelector('#clock').innerHTML = 'We\'ll Live Soon';
        }
      }, 1000);
    </script> <!-- END JS -->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-116692175-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag()
      {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      gtag('config', 'UA-116692175-1');
    </script>
    
    <script>
        $.post("{{ url('/my-api/guest/getVisitor') }}",
        {param1: 'value1'},
        function(data, textStatus, xhr) {
            console.log(data);;
        });
        // $.ajax({
        //     type: 'POST',
        //     url: 'https://dev.boinaw.com/my-api/guest/getVisitor',
        //     success: function(jsondata){
        //         console.log(jsondata);
        //     },
        //     error: function(error){
        //         console.log(error);
        //     }
        // })
    </script>
  </body>
</html>