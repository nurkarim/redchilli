@extends('admin.index')
@section('broadcast')
      <div class="row">
              <div class="col-xl-12">
                  <div class="breadcrumb-holder">
                      <h1 class="main-title float-left">Dashboard</h1>
                      <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item">Settings</li>
                        <li class="breadcrumb-item active">App Setting</li>
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
                                                <h3><i class="fa fa-desktop"></i> App Setting</h3>
                                
                    
                                            </div>
                                                
                                            <div class="card-body">
                                                
                                   <form method="post" action="{{ route('settings.appSave') }}">
                                    @csrf
                                
                                  <div class="form-group">
                                    <label for="name">App Name</label>
                                    <input type="text" class="form-control" id="name"  placeholder="" required="" name="app_name" value="{{ @$app->app_name }}">
                                  </div> 
                                  <div class="form-group">
                                    <label for="app_contact">Contact Number</label>
                                    <input type="text" class="form-control" id="app_contact"  placeholder="" required="" name="app_contact" value="{{ @$app->app_contact }}">
                                  </div>
                                  <div class="form-group">
                                    <label for="app_vat">Vat Number</label>
                                    <input type="text" class="form-control" id="app_vat"  placeholder=" "  name="app_vat" value="{{ @$app->app_vat }}">
                                  </div>
                                   <div class="form-group">
                                    <label for="app_email">E-mail</label>
                                    <input type="text" class="form-control" id="app_email"  placeholder=" " required="" name="app_email" value="{{ @$app->app_email }}">
                                  </div>
                                  <div class="form-group">
                                    <label for="app_address">Address</label>
                                    <input type="text" class="form-control" id="app_address"  placeholder=" "  name="app_address" value="{{ @$app->app_address }}">
                                  </div> 
                                  <div class="form-group">
                                    <label for="app_logo">Logo</label>
                                    <input type="file" class="form-control" id="app_logo"  placeholder=" "  name="app_logo">
                                  </div>
                           
                                
                                  <button type="submit" class="btn btn-primary">Save</button>
                                </form>
                                                
                                            </div>                                                      
                                        </div><!-- end card-->                  
                                    </div>
                            </div>
@section('js')

@endsection
@endsection