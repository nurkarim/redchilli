@extends('layouts.app')
@section('content')
<?php

$start = "17:00";
$end = "23:00";

$tStart = strtotime($start);
$tEnd = strtotime($end);
$tNow = $tStart;


?>
<section id="checkout">
	<div class="container-fluid">
		<div class="container">
			<div class="checkout-area">
				<div class="row">


					<div class="col-md-8">
						<div class="card">
						  <div class="card-header">
						    <i class="fa fa-th-list"></i> Order Form | Red Chilli Northallerton
						  </div>
						  <div class="card-body">

							<form method="POST" action="{{ route('checkouts.store') }}">
								@csrf
							  <div class="form-row">
							    <div class="form-group col-md-6">
							      <label>Name<em style="color: red">*</em></label>
							      <input type="name" name="full_name" class="form-control" required="" placeholder="Full Name" value="@if(Session::has('full_name')) {{Session::get('full_name')}} @else {{ old('full_name') }} @endif">
							    </div>
							    <div class="form-group col-md-6">
							      <label>Email<em style="color: red">*</em></label>
							      <input type="email" name="email" required="" class="form-control" placeholder="Enter Email" value="@if(Session::has('email')) {{Session::get('email')}} @else {{ old('email') }} @endif">
							    </div>
							  </div>
							  <div class="form-group">
							    <label>Phone<em style="color: red">*</em></label>
							    <input type="text" required="" name="phone" class="form-control" placeholder="Phone number" value="@if(Session::has('phone')) {{Session::get('phone')}} @else {{ old('phone') }} @endif">
							  </div>

							  <div class="form-group address">
							    <label for="inputAddress">Delivery Address<em style="color: red">*</em></label>
							    <input type="text" name="delivery_address" required="" class="form-control delivery_address" placeholder="Enter your correct address" value="@if(Session::has('delivery_address')) {{Session::get('delivery_address')}} @else {{ old('delivery_address') }} @endif">
							  </div>

							  <div class="form-group">
							    <label>Delivery Time<em style="color: red">*</em></label>
								<div class="dropdown">
									<select class="form-control" name="delivery_times" required="">
										
										<option value="As soon as possible">As soon as possible</option>
										<?php
										while($tNow <= $tEnd){
										?>
										<option value="{{ date("H:i A",$tNow) }}">{{ date("H:i A",$tNow) }}</option>
										<?php
										 $tNow = strtotime('+10 minutes',$tNow);
										}
										?>
									</select>
								
								</div>
							  </div>

							  <div class="form-group">
							    <label>Your Notes</label>
							    <input type="dropdown" name="notes" class="form-control" placeholder="Eg: add some extra spice" value="@if(Session::has('notes')){{Session::get('notes')}}@else{{ old('notes') }}@endif">
							  </div>

							  <div class="form-group">
							    <label>Coupons Code</label>
							    <input type="text"  name="coupon_code" class="form-control" placeholder="Enter coupons code if you have any" value="@if(Session::has('coupon_code')){{Session::get('coupon_code')}} @else{{ old('coupon_code') }}@endif">
							  </div>


							  <div class="form-group">
							  <!-- payment button -->
							  </div>

							<button class="btn btn-success btn-md">Place Order</button>
							</form>
						  </div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="card text-white bg-dark">
						  <div class="card-header">
						    <i class="fa fa-shopping-cart"></i> Order Details
						  </div>
						  <div class="card-body">

						  	<!-- item -->
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
						    <!-- item-end -->

						    <div class="row order-details">
                                <div class="col-sm-8">
                                    Subtotal 
                                </div>
                                <div class="col-sm-4">
                                    £<span id="sub_total">0</span>
                                </div>
                                <div class="col-sm-8 dcharge">
                                    Delivery fee
                                </div>
                                <div class="col-sm-4 dcharge">
                                    £2.00
                                    <input type="hidden" class="amt" id="charge" value="2">
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

						  </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@section('js')
<script type="text/javascript">
	function deleteCart(id) {
						$('#cart_id_'+id).remove();
            ajaxCartDelete(id);
						subTotal();
						grandTotal();
					}
	  function subTotal() {
							  var add = 0;
							 $(".subAmt").each(function() {
							  add += Number($(this).val());
							       });
							 $('#sub_total').html(parseFloat(add).toFixed(2));           
							} 
						function grandTotal() {
							  var add = 0;
							 $(".amt").each(function() {
							  add += Number($(this).val());
							       });

							 $('#grand_total').html(parseFloat(add).toFixed(2)); 

							}

			function ajaxCartDelete(pdt_id) {
                $.ajax({
                type: 'GET',
                async:false,
                url: '{{ route('ajaxCartdelete') }}?pdt='+pdt_id,
                dataType: "json",
                success: function(data) {
                if (data.status==true) {
                  toastr.success(data.sms,'Success');
                  
                }else{
                    toastr.error(data.sms,'Error');
                    }
                },
                error: function(data) {
                }
              });
            }
								subTotal();
						grandTotal();
</script>

@endsection
@endsection