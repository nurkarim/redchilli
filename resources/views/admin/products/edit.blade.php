@extends('admin.index')
@section('broadcast')
      <div class="row">
              <div class="col-xl-12">
                  <div class="breadcrumb-holder">
                      <h1 class="main-title float-left">Dashboard</h1>
                      <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item">Items</li>
                        <li class="breadcrumb-item active">Edit Item</li>
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
                                                <h3><i class="fa fa-desktop"></i> Edit  Item</h3>
                                
                    
                                            </div>
                                                
                                            <div class="card-body">
                                    {!! Form::model($data,['route'=>['products.update',$data->id],'id'=>'myForm','method'=>'PUT']) !!}            
             
                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                  <select class="form-control" required="" name="category_id" id="category_id">
                                      <option selected="">Choose...</option>
                                      @foreach($categories as $category)
                                      <option @if($category->id==$data->category_id) selected=""  @endif value="{{ $category->id }}">{{ $category->name }}</option>

                                      @endforeach
                                  </select>
                                  </div>      
                                  <div class="form-group">
                                    <label for="food_menus_id">Food Menus</label>
                                  <select class="form-control" name="food_menus_id" id="food_menus_id">
                                      <option selected="">Choose...</option>
                                      @foreach($foodMenus as $value)
                                      <option  @if($value->id==$data->food_menus_id) selected=""  @endif value="{{ $value->id }}">{{ $value->name }}</option>

                                      @endforeach
                                  </select>
                                  </div>
                                  <div class="form-group">
                                    <label for="name">Item Name</label>
                                 {!! Form::text('name',null,['class'=>'form-control','required'=>'true']) !!}
                                    
                                  </div> 
                                  <div class="form-group">
                                    <label for="name">Item Details</label>
                                 {!! Form::text('details',null,['class'=>'form-control']) !!}
                                  </div>
                                  <div class="form-group">
                                    <label for="price">Price</label>
                             {!! Form::text('price',null,['class'=>'form-control','required'=>'true']) !!}
                                    
                                
                                  </div>
                           
                                   <div class="form-group">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td width="80%">Sub Items Name</td>
                                            <td><button type="button" class="btn-sm btn-success" onclick="addMore()"><i class="fa fa-plus"></i> Add </button></td>
                                        </tr>
                                        <tbody class="tbody">
                                        @if(count($data->subItems) > 0)
                                        @foreach($data->subItems as $cart)
                                        <tr id="tr_{{ $cart->id }}"><td><input type="text" name="items[]" class="form-control" value="{{ $cart->name }}"></td>
            <td>
            <button onclick="removeTd('{{ $cart->id }}')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
            </td>
          </tr>
                                        @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                    
                                  </div>
                                  
                                  <button type="submit" class="btn btn-primary">Edit</button>
                           {!! Form::close() !!}
                                                
                                            </div>                                                      
                                        </div><!-- end card-->                  
                                    </div>
                            </div>

@section('js')
<script type="text/javascript">
    var i=0;
    function addMore() {
         i++;
        $('.tbody').append(`<tr id="tr_`+i+`"><td><input type="text" name="items[]" class="form-control"></td>
            <td>
            <button onclick="removeTd(`+i+`)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
            </td>
          </tr>`);
       
    }

    function removeTd(id) {
        $('#tr_'+id).remove();
    }
</script>
@endsection
@endsection