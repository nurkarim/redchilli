<script type="text/javascript">
    $(".modal-title").text("{{$product->name}}");
    $(".modal-dialog").addClass("modal-md").removeClass('modal-lg');
</script>
<style type="text/css">
	.modal-title{
    padding: 5px;
    font-size: 28px;
    line-height: 40px;
	}
	.c-menupicker__options-header {
    border-bottom: 1px solid #cacaca;
    font-size: 20px;
    width: 100%;
    overflow: hidden;
}
.sub-items {
    display: block;
    font-size: 20px;
}
</style>
<div class="col-sm-12">
    <div class="content">
        <div class="row">
        	<div class="c-menupicker__options-header"><b>Select option:</b></div>
        	@foreach($subItem as $subvalue)
         <div class="col-md-12">
          <div style="box-sizing: border-box;"> <label class="sub-items" for="subitems_{{ $subvalue->id }}"><input type="checkbox" name="sitems[]" value="{{ $subvalue->id }}_{{ $subvalue->name }}" id="subitems_{{ $subvalue->id }}">{{ $subvalue->name }}</label></div>
          </div>  
          @endforeach
        </div>
    </div>
</div>
<div class="modal-footer">

    <button type="submit" class="btn btn-primary dp0 btn-md ripple" onclick="addCart()">Add To basket</button>
</div>

<script>
var checked = [];
var nameSItem = [];
function addCart() {
    $("input[name='sitems[]']:checked").each(function () {
    checked.push($(this).val());
    var namea=$(this).val().split('_');
    nameSItem.push(namea[1]);
});
    
addToCart('{{$product->id}}','{{$product->name}}','{{$product->price}}','{{$product->foodMenu->name}}',nameSItem);
}
</script>
