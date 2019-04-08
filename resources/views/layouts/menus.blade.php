           @foreach($categories as $value)
           <div class="card-body" id="#cat_{{ $value->id }}">

                            <!-- item category -->
                            <h5 class="card-title">{{ $value->name }}</h5>
                            <p class="categoryDescription">{{ $value->note }}</p>
                              <!-- menu item -->
                              @if(count($value->foodMenus)>0)
                              @foreach($value->foodMenus as $food_Menu)
                              <h4  style="font-weight: 500;font-size: 15px;padding-top: 5px;">{{ $food_Menu->foodMenu->name }}</h4>
                              @if(count($food_Menu->foodMenu->items) > 0)
                              @foreach($food_Menu->foodMenu->items as $item)
                            <div class="row item">

                                <div class="col-sm-8">
                                    <p class="item-title" style="padding: 0px!important;">{{ $item->name }}</p>
                                    <p class="item-desc" style="padding: 0px!important;">{{ $item->details }}</p>
                                </div>
                                <div class="col-sm-4 cart-action">
                                    <p>£{{ $item->price }} 
                                    	@if(count($item->subItems))
                                    	<a href="javascript:void()" data-toggle="modal" data-target="#modal" onclick="loadModal('{{route('product.subItems',$item->id)}}')"><i class="fa fa-plus"></i></a>
                                    	@else
                                    	<a href="javascript:void()" onclick="addToCart('{{ $item->id }}','{{ $item->name }}','{{ $item->price }}','{{ $food_Menu->foodMenu->name }}','')"><i class="fa fa-plus"></i></a>

                                    	@endif
                                    </p> 
                                </div>
                            </div>
                            @endforeach
                            @endif
                            @endforeach
                            @endif
                            <!-- menu item-end -->

                            

                          </div>
               @endforeach
               @section('js')
				<script type="text/javascript">
					    function subTotal() {
							  var add = 0;
							 $(".subAmt").each(function() {
							  add += Number($(this).val());
							       });
							 $('#sub_total').html(add);           
							} 
						function grandTotal() {
							  var add = 0;
							 $(".amt").each(function() {
							  add += Number($(this).val());
							       });
							 $('#grand_total').html(add);           
							}
					function addToCart(id,name,price,item,subitem) {
					    var qty=$("#qty_"+id).val();
						var pdtid=$('#pid_'+id).val();
						
						if (Number(pdtid)==Number(id)) {
							qty++;
							$('#pdt_cart_'+id).html(qty+'x');
							$("#qty_"+id).val(qty)
							price=Number(qty)*Number(price);
							$('#cart_price_'+id).html(price);
							$('#cart_price'+id).val(price);
						}else{

						  $('.shop_cart').append(`<div class="row cartitem" id="cart_id_`+id+`">
                                <div class="col-sm-8 cartitem-title"> <input type="hidden" id="pid_`+id+`" value="`+id+`">
                                    <p class="cart-text"><b id="pdt_cart_`+id+`"></b> `+item+`,`+name+`</p>
                                    <span class="cart-text">`+subitem+`</span>
                                    <input type="hidden" value="1" id="qty_`+id+`">
                                </div>
                                <div class="col-sm-4 cart-action"> <input type="hidden" value="`+price+`" class="subAmt amt" id="cart_price`+id+`">
                                    <p>£<span id="cart_price_`+id+`">`+price+`</span> <a href="javascript:void()" onclick="deleteCart(`+id+`)"><i class="fa fa-times"></i></a></p> 
                                </div>
                            </div>`);	
						}
						subTotal();
						grandTotal();
						
					}
					function deleteCart(id) {
						$('#cart_id_'+id).remove();
						subTotal();
						grandTotal();
					}
				</script>
               @endsection