@extends('admin.index')
@section('broadcast')
			<div class="row">
							<div class="col-xl-12">
									<div class="breadcrumb-holder">
											<h1 class="main-title float-left">Dashboard</h1>
											<ol class="breadcrumb float-right">
												<li class="breadcrumb-item active">Order/ORD-{{ $order->id }}</li>
											</ol>
											<div class="clearfix"></div>
									</div>
							</div>
						</div>
@endsection
@section('content')
<div class="row">
						
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">						
							
							<div class="card mb-3">
										<div class="card-header">
											<h3><i class="fa fa-table"></i> Invoice Details 
												@if(!$order->status==2)<button type="button" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#modal" style="margin-left: 10px;" onclick="loadModal('{{route('orders.edit',$order->id)}}')"><i class="fa fa-edit"></i> Action</button>@endif  <button type="button" class="btn btn-info btn-sm btn-danger pull-right" onclick="Popup('{{route('orders.print',$order->id)}}')"><i class="fa fa-print"></i> Print </button>
											</h3>
										</div>
											
										<div class="card-body">
											
											<div class="container">
												
												<div class="row">
													<div class="col-md-12">
														<div class="invoice-title text-center mb-3">
															<h2>Invoice #ORD-{{ $order->id }}</h2>
															<strong>Date:</strong> {{ $order->date}}	<br>											
															<strong>Status:</strong> @if($order->status==1) <span class="label label-success bg-primary ">Active</span> @elseif($order->status==2) <span class="label label-danger bg-danger ">Cancel</span> @else <span class="label label-danger bg-warning ">Pending</span> @endif											
														</div>
														<hr>
														<div class="row">
															<div class="col-md-6">																
																<h5>Billed To:</h5>
																<address>
																	{{ $order->customer_name}}<br>
																	{{ $order->contact}}<br>
																	{{ $order->email}}<br>
																	{{ $order->delivery_address}}
																</address>
															</div>
															<div class="col-md-6 float-right text-right">																
																<h5>Shipped To:</h5><br>
																<address>
															{{ $order->customer_name}}<br>
																	{{ $order->contact}}<br>
																	{{ $order->email}}<br>
																	{{ $order->delivery_address}}
																</address>
															</div>
														</div>
														<div class="row">
															<div class="col-md-6">
																<h5>Payment Method:</h5>
																<address>
																	 @if($order->pay_type==1) <span style="text-transform: uppercase;font-weight: bold;">Cash on delivery</span> @else Master Card {{ $order->stripe_card}} @endif<br>
																	
																	{{ $order->email}}
																</address>
															</div>
															<div class="col-md-6 float-right text-right">
																<h5>Order Date:</h5>
																<address>
																	{{ $order->date }}<br>
																	{{ $order->delivery_times }}<br>
																</address>
															</div>
														</div>
													</div>
												</div>
												
												<div class="row">
													<div class="col-md-12">
														<div class="panel panel-default">
															<div class="panel-heading">
																<h3 class="panel-title"><strong>Order summary</strong></h3>
															</div>
															<div class="panel-body">
																<div class="table-responsive">
																	<table class="table table-condensed">
																		<thead>
																			<tr>
																				<td><strong>Item</strong></td>
																			
																				<td class="text-center"><strong>Quantity</strong></td>
																				<td class="text-right"><strong>Totals</strong></td>
																			</tr>
																		</thead>
																		<tbody>
																			@foreach($order->carts as $cart)
																			<tr>
																				<td>{{ $cart->name }} @if($cart->sub_items!=null) <br> <span style="font-size: 12px;">{{$cart->sub_items}}</span>  @endif</td>
																				
																				<td class="text-center">{{$cart->qty}}</td>
																				<td class="text-right">£{{$cart->total}}</td>
																			</tr>
																			@endforeach
																			<tr>
																				<td class="thick-line"></td>
																				
																				<td class="thick-line text-center"><strong>Subtotal</strong></td>
																				<td class="thick-line text-right">£{{ $order->sub_total }}</td>
																			</tr>
																			<tr>
																				<td class="no-line"></td>
																				
																				<td class="no-line text-center"><strong>Shipping</strong></td>
																				<td class="no-line text-right">£{{ $order->tax }}</td>
																			</tr>
																			<tr>
																				<td class="no-line"></td>
																				
																				<td class="no-line text-center"><strong>Total</strong></td>
																				<td class="no-line text-right">£{{ $order->total }}</td>
																			</tr>
																		</tbody>
																	</table>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
												  
											
										</div><!-- end card body -->															
										
									</div><!-- end card-->					
									
								</div><!-- end col-->			

					</div>

		<script type="text/javascript">
			         var left = (screen.width/2)-(800/2);
  var top = (screen.height/2)-(500/2);
    var stile = "top="+top+", left="+left+", width=1000, height=500 status=no, menubar=no, toolbar=no, scrollbar=yes, resizable=no, copyhistory=no,location=no, directories=no,titlebar=no";
     function Popup(apri) {
        window.open(apri, "", stile);
     }
		</script>

@endsection