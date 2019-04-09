@extends('admin.index')
@section('broadcast')
			<div class="row">
							<div class="col-xl-12">
									<div class="breadcrumb-holder">
											<h1 class="main-title float-left">Dashboard</h1>
											<ol class="breadcrumb float-right">
												<li class="breadcrumb-item">Home</li>
												<li class="breadcrumb-item">Items</li>
												<li class="breadcrumb-item active">Items List</li>
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
												<h3><i class="fa fa-desktop"></i> Items <a href="{{route('products.create') }}" class="pull-right" style="text-decoration: none;"><i class="fa fa-plus"></i> Add New
								</a></h3>
								
					
											</div>
												
											<div class="card-body">
												
												<table id="example1" class="table table-bordered table-responsive-xl table-hover display">
													<thead>
														<tr style="height:15px!important;">
															<th>SL</th>
															<th>Category</th>
															<th>Food Menus</th>
															<th>Name</th>
															<th>Price</th>
															<th>Action</th>
														</tr>
													</thead>													
													<tbody>
														<?php $i=1; ?>
														@foreach($products as $product)
														<tr>
															<td>{{$i++}}</td>
															<td>{{ $product->category->name }}</td>
															<td>{{ @$product->foodMenu->name }}</td>
															<td>{{ $product->name }}</td>
															<td>£{{ $product->price }}</td>
															<td><a href="{{route('products.edit',$product->id)}}" class="btn btn-primary btn-xs" >Edit</a></td>
														</tr>
														@endforeach
														
													</tbody>
												</table>
												
											</div>														
										</div><!-- end card-->					
									</div>
							</div>



@endsection