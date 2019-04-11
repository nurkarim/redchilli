<script type="text/javascript">
    $(".modal-title").text("Order Edit #ORD-{{ $order->id }}");
    $(".modal-dialog").addClass("modal-md").removeClass('modal-lg');
   
</script>
{!! Form::model($order,['route'=>['orders.update',$order->id],'id'=>'myForm','method'=>'PUT']) !!}
<div class="col-sm-12">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
 
                <div class="form-group animated-form filled">
                    <label class="control-label">Status</label>
                    <select class="form-control" name="status" required="">
                    	<option>Choose...</option>
                    	<option value="1" @if($order->status==1) selected="" @endif>Approved</option>
                    	<option value="2" @if($order->status==2) selected="" @endif>Cancel</option>
                    </select>
                    
                </div>   
    

                
            </div>
        </div>

    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger ripple btn-sm" data-dismiss="modal"
            >Cancel
    </button>
    <button type="submit" class="btn btn-primary dp0 btn-sm ripple ">Save</button>
</div>
{!! Form::close() !!}

