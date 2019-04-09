@extends('admin.index')
@section('broadcast')
			<div class="row">
							<div class="col-xl-12">
									<div class="breadcrumb-holder">
											<h1 class="main-title float-left">Dashboard</h1>
											<ol class="breadcrumb float-right">
												<li class="breadcrumb-item">Home</li>
												<li class="breadcrumb-item active">Discounts</li>
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
												<h3><i class="fa fa-desktop"></i> Discounts <button data-toggle="modal" data-target="#modal" class="btn btn-primary btn-sm pull-right" onclick="loadModal('{{route('discounts.create')}}')"><i class="fa fa-plus"></i> Add New
								</button></h3>
								
					
											</div>
												
											<div class="card-body">
												
												<table id="example1" class="table table-bordered table-responsive-xl table-hover display">
													<thead>
														<tr style="max-height: 10px!important">
															<th>SL</th>
															<th>Code</th>
															<th>Percent(%)</th>
															<th>Minimum shopping price</th>
															<th>Note</th>
															<th>End Date</th>
															
															<th>Action</th>
														</tr>
													</thead>													
													<tbody>
														<?php $i=1; ?>
														@foreach($discounts as $discount)
														<tr style="max-height: 10px!important">
															<td>{{$i++}}</td>
															<td>{{ $discount->code }}</td>
															<td>{{ $discount->percent }}</td>
															<td>£{{ $discount->amount }}</td>
															<td>{{ $discount->note }}</td>
															<td>{{ $discount->end_date }}</td>
														
															<td>
																<form method="post" action="{{ route('discounts.destroy') }}">
																@csrf
																<input type="hidden" name="id" value="{{ $discount->id }}">
																<button onclick="return confirm('Are you sure you want to delete?');" type="submit" class="btn btn-sm btn-danger">Delete</button></td>

																</form>
														</tr>
														@endforeach
														
													</tbody>
												</table>
												
											</div>														
										</div><!-- end card-->					
									</div>
							</div>

@endsection