
<!doctype html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Red Chilli Northallerton prides itself on quality Indian food cooked by experienced Bangladeshi chefs">
    <meta name="keywords" content="Indian Restaurant in Northallerton Uk, red chilli Northallerton, spicy food in Northallerton, online food delivery in Northallerton">
    <title>Red Chilli Indian Restaurant in Northallerton Uk, Fully Licensed Indian Restaurant, red chilli, Northallerton Uk</title>
   @include('layouts.header')
  </head>
  <body>

  <header>
      <nav class="navbar navbar-expand-md navbar-dark fixed-top main-nav">
        <p> <i class="fa fa-phone"></i> <a href="tell:01609775552">01609775552</a> &nbsp;&nbsp;&nbsp;<i class="fa fa-envelope"></i> redchillinorthallertonuk@gmail.com
        </p>
        <div class="container">
        <a class="navbar-brand" href="https://redchillinorthallerton.co.uk"><img src="{{ url('public/layouts') }}/img/logo.png"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">

          <ul class="navbar-nav ml-auto">
            <!--<li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarWelcome" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Welcome
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarWelcome">
                <a class="dropdown-item  active " href="index.html">Image</a>
              </div>
            </li> -->
            <li class="nav-item "><a href="{{url('/')}}#" class="nav-link">Home</a></li>
            <li class="nav-item "><a href="{{url('/')}}#order" class="nav-link">Menu</a></li>
            <li class="nav-item "><a href="{{url('/')}}#offer" class="nav-link">Offers</a></li>
            <li class="nav-item "><a href="{{url('/')}}#about" class="nav-link">About</a></li>
            <li class="nav-item "><a href="{{url('/')}}#slider" class="nav-link">Gallery</a></li>
            <li class="nav-item "><a href="{{url('/')}}#footer" class="nav-link">Contact</a></li>
           <li class="nav-item "><a href="{{url('/')}}#ordernow" class="nav-link case">Order Now</a></li>
            
          </ul>
        </div>

        </div> <!--/container -->
      </nav>
  </header>  

            @yield('content')


   <section id="footer" >
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <h4>SOCIAL MEDIA</h4>
            <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FRed-Chilli-Northallerton-122239917801123%2F&tabs&width=340&height=214&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="340" height="214" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
          </div>
          <div class="col-md-4 contact">
            <h4>GET IN TOUCH</h4>
            <a href="mailto:redchillinorthallertonuk@gmail.com" target="_top"><i class="fa fa-envelope"></i> redchillinorthallertonuk@gmail.com</a>
            <p><i class="fa fa-phone"></i>01609775552 <br>
            <i class="fa fa-location-arrow"></i>297 High Street Northallerton, North Yorkshire DL7 8DW, UK</p>
          </div>
          <div class="col-md-4">
      <h4>WE ACCEPT</h4>
            <img src="{{ url('public/layouts') }}/img/secure_payments.png" alt="secure_payments" style="height:70px">
            <img src="{{ url('public/layouts') }}/img/ssl-logo.png" alt="SSL Logo" style="height:70px">
          </div>
        </div>
      </div>
    </section>
    <section id="copyright">
      <div class="container-fluid">
        <div class="row" style="margin-right: 0px;">
          <div class="col-md-12 text-center">
            <p> © Red Chilli Fully Licensed Indian Restaurant & Takeaway. </p>
          </div>
        </div>
      </div>
      
    </section>
   @include('layouts.footer')

   






</body>
</html>