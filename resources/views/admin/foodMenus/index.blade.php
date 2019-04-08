@extends('admin.index')
@section('broadcast')
			<div class="row">
							<div class="col-xl-12">
									<div class="breadcrumb-holder">
											<h1 class="main-title float-left">Dashboard</h1>
											<ol class="breadcrumb float-right">
												<li class="breadcrumb-item">Home</li>
												<li class="breadcrumb-item active">Food Menus</li>
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
												<h3><i class="fa fa-desktop"></i> Food Menus <button data-toggle="modal" data-target="#modal" class="btn btn-primary btn-sm pull-right" onclick="loadModal('{{route('foodMenus.create')}}')"><i class="fa fa-plus"></i> Add New
								</button></h3>
								
					
											</div>
												
											<div class="card-body">
												
												<table id="example1" class="table table-bordered table-responsive-xl table-hover display">
													<thead>
														<tr style="max-height: 10px!important">
															<th>SL</th>
															<th>Name</th>
															<th>Note</th>
															
															<th>Action</th>
														</tr>
													</thead>													
													<tbody>
														<?php $i=1; ?>
														@foreach($categories as $category)
														<tr style="max-height: 10px!important">
															<td>{{$i++}}</td>
															<td>{{ $category->name }}</td>
															<td>{{ $category->note }}</td>
															<td><button class="btn btn-sm btn-danger">Delete</button> | <button data-toggle="modal" data-target="#modal" class="btn btn-primary btn-sm" onclick="loadModal('{{route('foodMenus.edit',$category->id)}}')">Edit</button></td>
														</tr>
														@endforeach
														
													</tbody>
												</table>
												
											</div>														
										</div><!-- end card-->					
									</div>
							</div>

@endsection