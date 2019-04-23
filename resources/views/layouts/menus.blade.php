         <?php
         $itemArray=array();
         ?>
           @foreach($categories as $value)
           <div class="card-body">

                <div id="accordion">
                  <div class="card">
                    <div class="card-header" id="headingOne">
                      <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#call{{ $value->id }}" aria-expanded="true" aria-controls="call{{ $value->id }}">
                          <h5 class="card-title" id="cat_{{ $value->id }}">{{ $value->name }}</h5>
                        </button>
                      </h5>
                    </div>

                    <div id="call{{$value->id}}" class="collapse 
                      @if($loop->first)
                      show
                      @endif
                      " aria-labelledby="headingOne" data-parent="#accordion">
                      <div class="card-body">
                        <p class="categoryDescription">{{ $value->note }}</p>

                              <!-- menu item -->
                              @if(count($value->foodMenus)>0)
                              @foreach($value->foodMenus as $food_Menu)
                              <h4 class="menu-title">{{ $food_Menu->foodMenu->name }}</h4>
                              <span>{{ $food_Menu->foodMenu->note }}</span>
                              @if(count($food_Menu->foodMenu->items) > 0)
                              @foreach($food_Menu->foodMenu->items as $item)
                              <?php 
                                $itemArray[]=$item->id;
                              ?>
                            <div class="row item">
                                <div class="col-sm-8 col-8">
                                    <p class="item-title" >{{ $item->name }}</p>
                                    <p class="item-desc">{{ $item->details }}</p>
                                </div>
                                <div class="col-sm-4 col-4 cart-action">
                                    <p>£{{ $item->price }} 
                                      @if(count($item->subItems))
                                      <a href="javascript:void(0)"  data-toggle="modal" data-target="#modal" onclick="loadModal('{{route('product.subItems',$item->id)}}')"><i class="fa fa-plus"></i></a>
                                      @else
                                      <a href="javascript:void(0)"  onclick="addToCart('{{ $item->id }}','{{ $item->name }}','{{ $item->price }}','{{ $food_Menu->foodMenu->name }}','')"><i class="fa fa-plus"></i></a>

                                      @endif
                                    </p> 
                                </div>
                            </div>
                            @endforeach
                            @endif
                            @endforeach
                            @endif


                            
                              @foreach($value->items as $catItem)
                              @if(in_array($catItem->id, $itemArray))
                              @else
                                  <div class="row item">

                                <div class="col-sm-8 col-8">
                                    <p class="item-title" style="padding: 0px!important;">{{ $catItem->name }}</p>
                                    <p class="item-desc" style="padding: 0px!important;margin-top: -7px;font-size: 13px">{{ $catItem->details }}</p>
                                </div>
                                <div class="col-sm-4 col-4 cart-action">
                                    <p>£{{ $catItem->price }} 
                                     
                                   @if(count($catItem->subItems)>0)
                                      <a href="javascript:void(0)"  data-toggle="modal" data-target="#modal" onclick="loadModal('{{route('product.subItems',$catItem->id)}}')"><i class="fa fa-plus"></i></a>
                                      @else
                                      <a href="javascript:void(0)"  onclick="addToCart('{{ $catItem->id }}','{{ $catItem->name }}','{{ $catItem->price }}','','')"><i class="fa fa-plus"></i></a>

                                      @endif

                                    </p> 
                                </div>
                            </div>
                            @endif
                               @endforeach 

                      </div>
                    </div>
                  </div>

                </div>

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
               if (Number(add) >= Number(10)) {
                $('#plcdrder').show();
               }
               $('#sub_total').html(parseFloat(add).toFixed(2));           
              } 
            function grandTotal() {
                var add = 0;
               $(".amt").each(function() {
                add += Number($(this).val());
                     });
               $('#grand_total').html(parseFloat(add).toFixed(2));           
               $('.grand_total').html(parseFloat(add).toFixed(2));           
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
               ajaxAddCart(id,name,price,item,subitem,1);
            }else{

              ajaxAddCart(id,name,price,item,subitem,1);

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
            ajaxCartDelete(id);
            subTotal();
            grandTotal();
          }

          function ajaxAddCart(pdt_id,name,price,item,subitem,qty) {
                $.ajax({
                type: 'GET',
                async:false,
                url: '{{ route('ajaxAddCart') }}?pdt='+pdt_id+'&name='+name+'&price='+price+'&item='+item+'&subitem='+subitem+'&qty='+qty,
                dataType: "json",
                success: function(data) {
                if (data.status==true) {
                  toastr.success(data.sms,'Success');
                  
                }else{
                    toastr.error(data.sms,'Error');
                    }
                },
                error: function(data) {
                }
              });
            }
             function ajaxCartDelete(pdt_id) {
                $.ajax({
                type: 'GET',
                async:false,
                url: '{{ route('ajaxCartdelete') }}?pdt='+pdt_id,
                dataType: "json",
                success: function(data) {
                if (data.status==true) {
                  toastr.success(data.sms,'Success');
                  
                }else{
                    toastr.error(data.sms,'Error');
                    }
                },
                error: function(data) {
                }
              });
            }

              subTotal();
            grandTotal();
        </script>
               @endsection