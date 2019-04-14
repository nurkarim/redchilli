@extends('layouts.app')
@section('content')
<section id="intro" data-parallax="scroll" data-image-src="{{ url('public/layouts') }}/img/bgheader.jpg">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="intro-content">
                    <h1>Quality Indian food cooked by experienced chefs</h1>
                    <h2>Fully Licensed Indian Restaurant</h2>
                    <i class="fa fa-clock-o" style="background-color: rgba(30, 116, 222, 0.5);" data-toggle="tooltip" data-placement="top" title="From 5PM to 11PM"></i> <i class="fa fa-phone" style="background-color:rgba(233, 47, 43, 0.5);" data-toggle="tooltip" data-placement="top" title="01609 775552"></i> <i class="fa fa-map-marker" style="background-color: rgba(97, 218, 0, 0.5); padding: 20px 23px 20px 23px;" data-toggle="tooltip" data-placement="top" title="297 High Street Northallerton, North Yorkshire DL7 8DW"></i>
                    @if(!empty($discount))
          <p class="coupon">Use Coupon Code <span style="background-color: #FF4D4D">"{{ $discount->code }}"</span> to enjoy {{ $discount->percent }}% discount on {{ date("d F", strtotime($discount->end_date)) }}</p>
          @endif
                </div>
                <a href="#ordernow" id="ordernow"><button class="btn btn-success">Order Now</button></a>
            </div>
        </div>
    </div>
</section>

<section id="order">
    <div class="container-fluid">
        <div class="container">
            <div class="order-area">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                          <div class="card-header">
                            <i class="fa fa-cutlery"></i> Categories
                          </div>
                          <div class="card-body categories">
                            <ul class="nav flex-column">
                               @include('layouts.category',['categories'=>$categories])
                            </ul>
                          </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                          <div class="card-header">
                            <i class="fa fa-th-list"></i> Menu | Red Chilli Northallerton
                          </div>
                               @include('layouts.menus',['categories'=>$categories])
                        

                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card text-white bg-dark">
                          <div class="card-header">
                            <i class="fa fa-shopping-cart"></i> Order Details
                          </div>
                          <div class="card-body">

                            <!-- item -->
                          <div class="shop_cart">
                           @if(Cart::count()>0)
                           @foreach(Cart::content() as $cartProduct) 
                            <div class="row cartitem" id="cart_id_{{ $cartProduct->id }}">
                                <div class="col-sm-8 cartitem-title"> <input type="hidden" id="pid_{{ $cartProduct->id }}" value="{{ $cartProduct->id }}">
                                    <p class="cart-text"><b id="pdt_cart_{{ $cartProduct->id }}">@if($cartProduct->qty==1) @else {{ $cartProduct->qty }}x @endif</b> {{ $cartProduct->name }}</p>
                                    <span class="cart-text">{{ $cartProduct->options->subItem }}</span>
                                    <input type="hidden" value="{{ $cartProduct->qty }}" id="qty_{{ $cartProduct->id }}">
                                </div>
                                <div class="col-sm-4 cart-action"> <input type="hidden" value="{{ $cartProduct->price }}" class="subAmt amt" id="cart_price{{ $cartProduct->id }}">
                                    <p>£<span id="cart_price_{{ $cartProduct->id }}">{{ number_format($cartProduct->price,2) }}</span> <a href="javascript:void()" onclick="deleteCart('{{ $cartProduct->id }}')"><i class="fa fa-times"></i></a></p> 
                                </div>
                            </div>
                           @endforeach
                           @endif
                          </div>
                            <!-- item-end -->

                            <div class="row order-details">
                                <div class="col-sm-8">
                                    Subtotal 
                                </div>
                                <div class="col-sm-4">
                                    £<span id="sub_total">0</span>
                                </div>
                                <div class="col-sm-8">
                                    Delivery fee
                                </div>
                                <div class="col-sm-4">
                                    £2.00
                                    <input type="hidden" class="amt" value="2">
                                </div>
                            </div>
                            <div class="row ordertotal">
                                <div class="col-sm-8">
                                    Total
                                </div>
                                <div class="col-sm-4">
                                    £<span id="grand_total">0</span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 order-footer">
                                    <a style="display: none" id="plcdrder"  href="{{route('checkouts.show')}}"><button class=" btn btn-danger btn-sm btn-block">Place Order</button></a>
                                    <span style="text-align: center;font-size: 12px">Place order must be above £10.00</span>
                                </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="about" >
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <img src="{{ url('public/layouts') }}/img/logo2.png" alt="">
                <p> We established in 2007, Red Chilli is a family run restaurant owned and managed by <span style="font-weight: 600">Mojibur Rahman</span> who lives in Northallerton with his family.
                Red Chilli prides itself on quality Indian food cooked by experienced Bangladeshi chefs who use only the finest ingredients to create the authentic flavours Red Chilli is so well known for.
                Red Chilli tries to source as many of the ingredients as possible locally and currently uses both a Northallerton based Butcher and Northallerton Greengrocer.
                The customer can choose to dine in the relaxed and friendly atmosphere of the restaurant or take their meal away. There is also the option of delivery on orders over £10 within a radius of 2 miles. Delivery further than 2 miles is available at an extra cost.
                Large parties can be catered for when booked in advance and outside catering is also available.</p>
            </div>
        </div>
    </div>
</section>

<section id="slider" id="top">
    <div class="container">
      <div class="row">
        <div class="col-md-6" style="padding-right:0px;">
                <div id="mainSlider" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                      <li data-target="#mainSlider" data-slide-to="0" class="active"></li>
                      <li data-target="#mainSlider" data-slide-to="1"></li>
                      <li data-target="#mainSlider" data-slide-to="2"></li>
                      <li data-target="#mainSlider" data-slide-to="3"></li>
                      <li data-target="#mainSlider" data-slide-to="4"></li>
                      <li data-target="#mainSlider" data-slide-to="5"></li>
                    </ol>
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img class="first-slide" src="{{ url('public/layouts') }}/img/slider/s1.jpg" >
                        <div class="container">
                          <div class="carousel-caption">
                            <h1>Quality Indian food</h1></div>
                        </div>
                      </div>

                      <div class="carousel-item">
                        <img class="second-slide" src="{{ url('public/layouts') }}/img/slider/s2.jpg" >
                        <div class="container">
                          <div class="carousel-caption">
                            <h1>Relaxed and friendly atmosphere restaurant</h1>
                          </div>
                        </div>
                      </div>
                      <div class="carousel-item">
                        <img class="second-slide" src="{{ url('public/layouts') }}/img/slider/s3.jpg" >
                        <div class="container">
                          <div class="carousel-caption">
                            <h1>Good outdoor view</h1>
                          </div>
                        </div>
                      </div>
                      <div class="carousel-item">
                        <img class="second-slide" src="{{ url('public/layouts') }}/img/slider/s4.jpg" >
                        <div class="container">
                          <div class="carousel-caption">
                            <h1>Eexperienced Bangladeshi chefs</h1>
                          </div>
                        </div>
                      </div>
                      <div class="carousel-item">
                        <img class="second-slide" src="{{ url('public/layouts') }}/img/slider/s5.jpg" >
                        <div class="container">
                          <div class="carousel-caption">
                            <h1>Relaxed and friendly atmosphere restaurant</h1>
                          </div>
                        </div>
                      </div>

                      <div class="carousel-item">
                        <img class="second-slide" src="{{ url('public/layouts') }}/img/slider/s6.jpg" >
                        <div class="container">
                          <div class="carousel-caption">
                            <h1>Drinks</h1>
                          </div>
                        </div>
                      </div>


                    </div>

                  </div>
        </div>
        <div class="col-md-6">
            <div class="awards">
                <h2>Awards</h2>
                <p>Our food is some of the best in the area but if you don't want to take our word for it, here are some of the awards we have won.</p>
                <div class="row">
                    <div class="col-md-6 award">
                        <i class="fa fa-star"></i> Flavours of Hambleton Finalist 2009
                    </div>
                    <div class="col-md-6 award">
                        <i class="fa fa-star"></i> Flavours of Hambleton Highly Commended 2009
                    </div>
                    <div class="col-md-6 award">
                        <i class="fa fa-star"></i> Flavours of Hambleton Shortlisted 2010
                    </div>
                    <div class="col-md-6 award">
                        <i class="fa fa-star"></i> Flavours of Hambleton Finalist 2010
                    </div>
                    <div class="col-md-6 award">
                        <i class="fa fa-star"></i> Flavours of Hambleton Highly Commended 2010
                    </div>
                    <div class="col-md-6 award">
                        <i class="fa fa-star"></i> Flavours of Herriot Country Finalist 2011
                    </div>
                </div>
            </div>
            
        </div>
        <!-- <div class="col-md-6 ">
            <h2>Users Feedback</h2>
            <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2"></script>
<div class="fb-comments" data-href="https://www.redchillinorthallerton.co.uk" data-numposts="4"></div>
        </div> -->
      </div>


    </div>
    </section>

    <section id="offer">

        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <img src="{{ url('public/layouts') }}/img/sep.png" alt="">
                    <h2>DINE IN OFFERS</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card bg-offer" >
                      <div class="card-header offer-header">Banquet Night</div>
                      <div class="card-body offer-body">
                        <h5 class="card-titleo">4 Course Meal when dining with us every Wednesday & Sunday</h5>
                        <h4>Including:
                            <li>Poppadom & Pickles</li>
                            <li>Choice of starter</li>
                            <li>Choice of main course with rice or nan</li>
                            <li>Choice of Ice cream or Tea/Coffee</li>
                        </h4>
                        <p class="offer-footer">£10.95 per person</p>
                        <p class="offer-book">To book table please call us on 016097755552</p>
                      </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <img src="{{ url('public/layouts') }}/img/offer1.jpg" style="height: 370px;" alt="">
                </div>
            </div>
        </div>
    </section>
    
    <section id="party" data-parallax="scroll" data-image-src="{{ url('public/layouts') }}/img/party.jpg">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <h2>Celebrate your party with Red Chilli</h2>
          </div>
        </div>
      </div>
    </section>

    <section id="feedback">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="party-body">
              <h4>PARTY NIGHT</h4>
              <p>At Red Chilli we also cater for larger parties.
              If you are celebrating a special occasion we will provide ballons & party banners if booked in advance.
              For parties of 10 or more we can prepare a delicious indian buffet consisting of a selection of starters & main courses allowing you to sample several dishes you may have never tasted. We require these nights to be booked in advance and will tailor the dishes to suit your individual taste & price per head. Please call us on 01609 7755552 for further details or to dicuss your requirements.</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="feedback-body">
              <h4>Customers Feedback</h4>
                <div id="fb-root"></div>
                <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2"></script>
                <div class="fb-comments" data-href="https://www.redchillinorthallerton.co.uk" data-numposts="4"></div>
            </div>
          </div>
        </div>
      </div>
    </section>


    <a href="https://goo.gl/maps/ZhqZygHFVCk" target="_blank">
    <section id="map">
        
    </section>
    </a>
   @endsection