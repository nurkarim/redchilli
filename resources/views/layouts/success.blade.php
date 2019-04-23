@extends('layouts.app') 
@section('content')
<section id="checkout">
    <div class="container-fluid">
        <div class="container">
            <div class="checkout-area">
                <div class="row">

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-th-list"></i> Success
                            </div>
                            <div class="card-body">
                               <h1>Thank You For Your Order.</h1>
                               <p>Your order no: ORD-{{$order->id}}</p>
                               <p>Billing & Shipping information:</p>
                               <p>{{$order->delivery_address}}</p>
                               <p><a href="{{url('/')}}" class="btn btn-lg btn-primary">Continue Shopping</a></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


 @endsection