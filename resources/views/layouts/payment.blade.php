@extends('layouts.app') @section('content')
<section id="checkout">
    <div class="container-fluid">
        <div class="container">
            <div class="checkout-area">
                <div class="row">

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-th-list"></i> Complete Payment | Red Chilli Northallerton
                            </div>
                            <div class="card-body">
                                <img src="{{url('public/layouts')}}/img/secure_payments.png" style="height: 60px;" alt="">
                                <form method="post" action="{{ route('payments.save') }}">
                                    @csrf

                                    <div class="form-group">
                                        <div class="form-check">
                                            <label class="form-check-label" for="gridCheck1">
                                                <input class="form-check-input" name="payment_type" value="1" type="radio" id="gridCheck1" checked=""> Cash on Delivery
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label" for="gridCheck">
                                                <input class="form-check-input" name="payment_type" value="2" type="radio" id="gridCheck"> Card Payment
                                            </label>
                                        </div>
                                    </div>

                                    <div class="card_form">
                                        <div class="form-group row">
                                            <label for="card_name" class="col-sm-3 col-form-label">Holder Name</label>
                                            <div class="col-sm-9">
                                                {!! Form::text('card_name',null , ['class'=>' form-control','id'=>'card_name','placeholder'=>'']) !!}
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="card_number" class="col-sm-3 col-form-label"> Card Number</label>
                                            <div class="col-sm-9">
                                                {!! Form::text('card_number', null, [ 'class' => 'form-control', 'data-stripe' => 'number', 'data-parsley-type' => 'number', 'maxlength' => '16', 'data-parsley-trigger' => 'change focusout', 'data-parsley-class-handler' => '#cc-group' ]) !!}

                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="exp_date" class="col-sm-3 col-form-label"> Exp.Month</label>
                                            <div class="col-sm-4">
                                                {!! Form::selectMonth('exp_date', null, [ 'class' => 'form-control selectpicker show-tick', 'data-style' => 'btn-white', 'data-stripe' => 'exp-month' ], '%m') !!}

                                            </div>
                                            <div class="col-sm-5">
                                                {!! Form::selectYear('exp_year', date('Y'), date('Y') + 10, null, [ 'class' => 'form-control', 'data-stripe' => 'exp-year', 'class' => 'form-control selectpicker show-tick', 'data-style' => 'btn-white', ]) !!}

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="card_cvv" class="col-sm-3 col-form-label"> CVV</label>
                                            <div class="col-sm-9">
                                                {!! Form::text('card_cvv', null, [ 'class' => 'form-control', 'data-stripe' => 'cvc', 'data-parsley-type' => 'number', 'data-parsley-trigger' => 'change focusout', 'maxlength' => '4', 'data-parsley-class-handler' => '#ccv-group' ]) !!}

                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-md">Confirm Order</button> | <a href="{{ route('checkouts.show') }}" class="btn btn-primary btn-md">Back Checkout</a>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card text-white bg-dark">
                            <div class="card-header">
                                <i class="fa fa-shopping-cart"></i> Order Details
                            </div>
                            <div class="card-body">

                                <!-- item -->
                                @if(Cart::count()>0) @foreach(Cart::content() as $cartProduct)
                                <div class="row cartitem" id="cart_id_{{ $cartProduct->id }}">
                                    <div class="col-sm-8 cartitem-title">
                                        <input type="hidden" id="pid_{{ $cartProduct->id }}" value="{{ $cartProduct->id }}">
                                        <p class="cart-text"><b id="pdt_cart_{{ $cartProduct->id }}">@if($cartProduct->qty==1) @else {{ $cartProduct->qty }}x @endif</b> {{ $cartProduct->name }}</p>
                                        <span class="cart-text">{{ $cartProduct->options->subItem }}</span>
                                        <input type="hidden" value="{{ $cartProduct->qty }}" id="qty_{{ $cartProduct->id }}">
                                    </div>
                                    <div class="col-sm-4 cart-action">
                                        <input type="hidden" value="{{ $cartProduct->price }}" class="subAmt amt" id="cart_price{{ $cartProduct->id }}">
                                        <p>£<span id="cart_price_{{ $cartProduct->id }}">{{ number_format($cartProduct->price,2) }}</span> </p>
                                    </div>
                                </div>
                                @endforeach @endif
                                <!-- item-end -->

                                <div class="row order-details">
                                    <div class="col-sm-8">
                                        Subtotal
                                    </div>
                                    <div class="col-sm-4">
                                        £<span id="sub_total">0</span>
                                    </div>
        @if(!empty(Session::get('discount')))
                                    <div class="col-sm-8">
                                        Discount
                                    </div>
                                    <div class="col-sm-4">
                                        £<span id="sub_total">{{ number_format(Session::get('discount'),2) }}</span>
                                        <input type="hidden" id="discount" name="discount" value="{{ number_format(Session::get('discount'),2) }}">
                                    </div>
                                    @endif

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
                                        £<span id="grand_total"> 0 </span>
                                        <input type="hidden" class="grandTotal" value="0">

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
<style type="text/css">
    .card_form {
        display: none;
    }
</style>

@section('js')
<script type="text/javascript">
    $('#gridCheck1').change(function() {
        if ($(this).prop("checked")) {

            $('.card_form').hide();
        } else {
            $('.card_form').show();
        }
    });

    $('#gridCheck').change(function() {
        if ($(this).prop("checked")) {
            $('.card_form').show();
        } else {
            $('.card_form').hide();
        }
    });

    function subTotal() {
        var add = 0;
        $(".subAmt").each(function() {
            add += Number($(this).val());
        });
        $('#sub_total').html(add);
    }

    function grandTotal() {
        var add = 0;
        $(".amt").each(function() {
            add += Number($(this).val());
        });
        $('#grand_total').html(add);
        $('.grandTotal').val(add);
        discount();
    }
    subTotal();
    grandTotal();

    function discount() {
        var disc=$("#discount").val();
        var gtotal=$(".grandTotal").val();
          $('#grand_total').html(Number(gtotal)-Number(disc));

    }
</script>

@endsection @endsection