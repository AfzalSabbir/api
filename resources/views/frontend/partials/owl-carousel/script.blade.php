
<script>
  $(document).ready(function(){
    $('.owl-carousel').owlCarousel({
      loop:true,
      margin:10,
      nav:true,
      lazyLoad:true,
      autoplay: true,
      smartSpeed: 500,
      nav:true,
      dots: false,
      loop : true,
      animateOut: "fadeOut",
      autoplayHoverPause: true,
      responsive:{
        0:{
          items:2
        },
        526:{
          items:3
        },
        768:{
          items:4
        }
      }
    });
  });
  // owl.on('mousewheel', '.owl-stage', function (e) {
  //   if (e.deltaY>0) {
  //       owl.trigger('next.owl');
  //   } else {
  //       owl.trigger('prev.owl');
  //   }
  //   e.preventDefault();
  // });
</script>