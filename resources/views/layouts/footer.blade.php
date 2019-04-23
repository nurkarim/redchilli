 <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ url('public/layouts') }}/js/jquery-3.0.0.min.js" ></script>

    <script src="{{ url('public/layouts') }}/js/popper.min.js"></script>
    <script src="{{ url('public/layouts') }}/js/bootstrap.min.js"></script>
    <script src="{{ url('public/layouts') }}/js/parallax.min.js"></script>


    <script src="{{ url('public/layouts') }}/js/wow.js"></script>
    <script>
      new WOW().init();
    </script>

 

  <script>
    $(function () {
      $('[data-toggle="tooltip"]').tooltip() 
    });
  </script>
<script src="{{ url('public') }}/js/toastr.min.js"></script>
{!! Toastr::message() !!}
@yield('js')

  <script type="text/javascript">
      $('a').click(function(){
        $('html, body').animate({
          scrollTop: $( $(this).attr('href') ).offset().top
        }, 500);
        return false;
      });
  </script>
  <script type="text/javascript">
    
      $('#test1').change(function() {
        if ($(this).prop("checked")) {
           sessionStorage.setItem("type", "1");
           $(".dcharge").show();
           $("#charge").val(2);
           $(".address").show();
         $(".delivery_address").attr( "required",'true' );
        grandTotal();

        } else {
            sessionStorage.setItem("type", "2");
        }
    });

      $('#test2').change(function() {
   
        if ($(this).prop("checked")) {
           sessionStorage.setItem("type", "2");
            $(".dcharge").hide();
           $("#charge").val(0);
           $(".address").hide();
        $(".delivery_address").removeAttr( "required" );
        grandTotal();
        
        } else {
            sessionStorage.setItem("type", "1");
        }
    });

      if (Number(sessionStorage.getItem("type"))==1) {
        $("#test1").attr('checked', 'checked');
        $(".dcharge").show();
        $("#charge").val(2);
        grandTotal();
        $(".address").show();
         $(".delivery_address").attr( "required",'true' );
      }else{
        $("#test2").attr('checked', 'checked');
        $(".dcharge").hide();
        $("#charge").val(0);
        $(".address").hide();
        $(".delivery_address").removeAttr( "required" );
        grandTotal();
      }
   </script>
@include('admin._partials.modal')
  