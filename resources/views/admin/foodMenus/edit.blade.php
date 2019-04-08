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
                    <label class="control-label">Name</label>
                      {!! Form::text('name',null,['class'=>'form-control','required'=>'true']) !!}
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

