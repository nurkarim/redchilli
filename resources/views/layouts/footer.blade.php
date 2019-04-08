 <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ url('public/layouts') }}/js/jquery-3.0.0.min.js" ></script>

    <script src="{{ url('public/layouts') }}/js/popper.min.js"></script>
    <script src="{{ url('public/layouts') }}/js/bootstrap.min.js"></script>
    <script src="{{ url('public/layouts') }}/js/parallax.min.js"></script>


    <script src="{{ url('public/layouts') }}/js/wow.js"></script>
    <script>
      new WOW().init();
    </script>

  <script type="text/javascript">
      $('a').click(function(){
        $('html, body').animate({
          scrollTop: $( $(this).attr('href') ).offset().top
        }, 500);
        return false;
      });
  </script> 

  <script>
    $(function () {
      $('[data-toggle="tooltip"]').tooltip() 
    });
  </script>
@yield('js')

@include('admin._partials.modal')
  