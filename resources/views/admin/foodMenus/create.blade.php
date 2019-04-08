<script type="text/javascript">
    $(".modal-title").text("Add Food Menu");
    $(".modal-dialog").addClass("modal-md").removeClass('modal-lg');
</script>
{!! Form::open(['route'=>'foodMenus.store','id'=>'myForm','novalidate'=>'']) !!}
<div class="col-sm-12">
    <div class="content">
        <div class="row">
 
            <div class="col-md-12">

                <div class="form-group">
                    <label class="control-label">Name</label>
                    <input class="form-control" required name="name" type="text" />
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
<script>

</script>
