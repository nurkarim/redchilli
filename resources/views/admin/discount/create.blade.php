<script type="text/javascript">
    $(".modal-title").text("Add Food Menu");
    $(".modal-dialog").addClass("modal-md").removeClass('modal-lg');
</script>
{!! Form::open(['route'=>'discounts.store','id'=>'myForm','novalidate'=>'']) !!}
<div class="col-sm-12">
    <div class="content">
        <div class="row">
 
            <div class="col-md-12">

         <div class="form-group animated-form filled">
                    <label class="control-label">Note</label>
                      {!! Form::text('note',null,['class'=>'form-control','required'=>'true']) !!}
        </div>  
        <div class="form-group animated-form filled">
                    <label class="control-label">Percent(%)</label>
                      {!! Form::text('percent',null,['class'=>'form-control','required'=>'true']) !!}
        </div>
        <div class="form-group animated-form filled">
                    <label class="control-label">Minimum order price</label>
                      {!! Form::text('amount',null,['class'=>'form-control','required'=>'true']) !!}
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
<input class="possible" type="hidden" placeholder="Possible characters" value="ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789">

<script type="text/javascript">
var generated = [],
    possible  = $(".possible").val() ? $(".possible").val() : "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
function generateCodes(number, length) {
    generated=[];
   $("#code").val(" ");
  for ( var i=0; i < number; i++ ) {
    generateCode(length);
  }
    
  $("#code").val(generated.join("\n"));

}
function generateCode(length) {
  var text = "";

  for ( var i=0; i < length; i++ ) {
    text += possible.charAt(Math.floor(Math.random() * possible.length));
  }

  if ( generated.indexOf(text) == -1 ) {
    generated.push(text);
  }else {
    generateCode();
  }
}
$(".generate").on("click", function(e) {

  var num = $(".count").val() ? $(".count").val() : 1,
      len = $(".length").val() ? $(".length").val() : 6;
      possible  = $(".possible").val() ? $(".possible").val() : "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
      
  generateCodes(num, len);
  
  
});

</script>

