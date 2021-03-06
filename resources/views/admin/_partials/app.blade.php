@extends('admin.index')
@section('content')
<div class="container-fluid">
					
						<div class="row">
							<div class="col-xl-12">
									<div class="breadcrumb-holder">
											<h1 class="main-title float-left">Dashboard</h1>
											<ol class="breadcrumb float-right">
												<li class="breadcrumb-item">Home</li>
												<li class="breadcrumb-item active">Dashboard</li>
											</ol>
											<div class="clearfix"></div>
									</div>
							</div>
						</div>
						<!-- end row -->

						
						
						<div class="row">
									<div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
											<div class="card-box noradius noborder bg-primary">
													<i class="fa fa-file-text-o float-right text-white"></i>
													<h6 class="text-white text-uppercase m-b-20">Completed Orders</h6>
													<h1 class="m-b-20 text-white counter">{{ $active }}</h1>
													<span class="text-white">{{ $active }} Completed Orders</span>
											</div>
									</div>

									<div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
											<div class="card-box noradius noborder bg-default">
													<i class="fa fa-file-text-o float-right text-white"></i>
													<h6 class="text-white text-uppercase m-b-20">Pending Orders</h6>
													<h1 class="m-b-20 text-white counter">{{ $inactive }} </h1>
													<span class="text-white">{{ $inactive }}  Pending Orders</span>
											</div>
									</div>

										<div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
											<div class="card-box noradius noborder bg-danger">
													<i class="fa fa-file-text-o float-right text-white"></i>
													<h6 class="text-white text-uppercase m-b-20">Canceled Orders</h6>
													<h1 class="m-b-20 text-white counter">{{ $cancelOrder }}</h1>
													<span class="text-white">{{ $cancelOrder }} Canceled Orders</span>
											</div>
									</div>

									<div class="col-xs-12 col-md-6 col-lg-6 col-xl-3">
											<div class="card-box noradius noborder bg-success">
													<i class="fa fa-bell-o float-right text-white"></i>
													<h6 class="text-white text-uppercase m-b-20">Products</h6>
													<h1 class="m-b-20 text-white counter">{{ $products }}</h1>
													<span class="text-white">{{ $products }} Total Products</span>
											</div>
									</div>
							</div>
							<!-- end row -->
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">						
										<div class="card mb-3">
											<div class="card-header">
												<h3><i class="fa fa-file"></i> New Orders</h3>
												
											</div>
												
											<div class="card-body">
												
												<table id="example" class="table table-bordered table-responsive-xl table-hover display">
													<thead>
														<tr>
															
															<th>ORD-</th>
															<th>Delivery Type</th>
															<th>Date</th>
															<th>Customer</th>
															<th>Phone</th>
															<th>Delivery Times</th>
															<th>Sub Total</th>
															<th>Discount</th>
															<th>Fee</th>
															<th>Total</th>
														
														</tr>
													</thead>													
													<tbody>
														<?php
														$i=1;
														?>
														@foreach($orders as $order)
														<tr>
															
														  <td>	<a target="_blank" href="{{route('orders.show',$order->id)}}">ORD-{{ $order->id }}</a></td>
														<td>@if($order->tax==0) Collection @else Delivery @endif</td>
															<td>{{ $order->date }}</td>
															<td>{{ $order->customer_name }}</td>
															<td>{{ $order->contact }}</td>
															<td>{{ $order->delivery_times }}</td>
															<td>£{{ $order->sub_total }}</td>
															<td>£{{ $order->discount }}</td>
															<td>£{{ $order->tax }}</td>
															<td>£{{ $order->total }}</td>
															
														</tr>
														@endforeach
														
													</tbody>
												</table>
												
											</div>														
										</div><!-- end card-->					
									</div>
							</div>


            </div>
            @section('js')
<script type="text/javascript">
	$(document).ready(function() {
    $('#example').DataTable( {
        "order": [[ 2, "desc" ]]
    } );
} );
</script>

@endsection
@endsection