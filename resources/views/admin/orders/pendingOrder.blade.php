@extends('admin.index')
@section('broadcast')
			<div class="row">
							<div class="col-xl-12">
									<div class="breadcrumb-holder">
											<h1 class="main-title float-left">Dashboard</h1>
											<ol class="breadcrumb float-right">
												<li class="breadcrumb-item active">Order New</li>
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
												<h3><i class="fa fa-desktop"></i> New Orders List </h3>
								
					
											</div>
												
											<div class="card-body">
											<table id="example1" class="table table-bordered table-responsive-xl table-hover display">
													<thead>
														<tr style="height:15px!important;">
															
															<th>ID No</th>
															<th>Date</th>
															<th>Delivery Times</th>
															<th>Customer</th>
															<th>Phone</th>
															<th>Sub Total</th>
															<th>Discount</th>
															<th>Fee</th>
															<th>Total</th>
														
															
														</tr>
													</thead>													
													<tbody>
														<?php $i=1; ?>
														@foreach($orders as $order)
														<tr>
															<td><a target="_balnk" href="{{route('orders.show',$order->id)}}">ORD-{{ $order->id }}</a></td>
															<td>{{ $order->date }}</td>
															<td>{{ $order->delivery_times }}</td>
															<td>{{ $order->customer_name }}</td>
															<td>{{ $order->contact }}</td>
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



@endsection