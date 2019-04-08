@extends('admin.index')
@section('broadcast')
      <div class="row">
              <div class="col-xl-12">
                  <div class="breadcrumb-holder">
                      <h1 class="main-title float-left">Dashboard</h1>
                      <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item">Items</li>
                        <li class="breadcrumb-item active">Add New</li>
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
                                                <h3><i class="fa fa-desktop"></i> Add  Items</h3>
                                
                    
                                            </div>
                                                
                                            <div class="card-body">
                                                
                                   <form method="post" action="{{ route('products.store') }}">
                                    @csrf
                                <div class="form-group">
                                    <label for="category_id">Category</label>
                                  <select required="" class="form-control" name="category_id" id="category_id">
                                      <option selected="">Choose...</option>
                                      @foreach($categories as $category)
                                      <option value="{{ $category->id }}">{{ $category->name }}</option>

                                      @endforeach
                                  </select>
                                  </div>      
                                  <div class="form-group">
                                    <label for="food_menus_id">Food Menus</label>
                                  <select class="form-control" name="food_menus_id" id="food_menus_id">
                                      <option selected="" value="0">Choose...</option>
                                      @foreach($foodMenus as $value)
                                      <option value="{{ $value->id }}">{{ $value->name }}</option>

                                      @endforeach
                                  </select>
                                  </div>
                                  <div class="form-group">
                                    <label for="name">Item Name</label>
                                    <input type="text" class="form-control" id="name"  placeholder="Enter Item name" required="" name="name">
                                  </div> 
                                  <div class="form-group">
                                    <label for="details">Item Details</label>
                                    <input type="text" class="form-control" id="details"  placeholder="Enter sort details"  name="details">
                                  </div>
                                  <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="text" class="form-control" id="price"  placeholder="Enter price" required="" name="price">
                                
                                  </div>
                           
                                   <div class="form-group">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td width="80%">Sub Items Name</td>
                                            <td><button type="button" class="btn-sm btn-success" onclick="addMore()"><i class="fa fa-plus"></i> Add </button></td>
                                        </tr>
                                        <tbody class="tbody">
                                        
                                        </tbody>
                                    </table>
                                    
                                  </div>
                                  
                                  <button type="submit" class="btn btn-primary">Save</button>
                                </form>
                                                
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