<script type="text/javascript">
    $(".modal-title").text("Edit Food Menu");
    $(".modal-dialog").addClass("modal-md").removeClass('modal-lg');
   
</script>
{!! Form::model($data,['route'=>['foodMenus.update',$data->id],'id'=>'myForm','method'=>'PUT']) !!}
<div class="col-sm-12">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
 
       <div class="form-group animated-form filled">
                    <label class="control-label">Note</label>
                      {!! Form::text('note',null,['class'=>'form-control','required'=>'true']) !!}
        </div> 
         <div class="form-group animated-form filled">
                    <label class="control-label">End date</label>
                      {!! Form::date('end_date',null,['class'=>'form-control','required'=>'true']) !!}
        </div> 
 
      <div class="form-group">
            <label>Coupon  Code</label>
        <div class="input-group">
              <input type="text" id="code" class="form-control code-null" name="code"  autocomplete="off">
                <span class="input-group-btn">
                <button type="button"  readonly="true" class="btn btn-flat generate">Generate
                </button>
              </span>
         </div>
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

