
<script>
    function loadModalByUrl(url){
        var baseUrl='<?php echo URL::to('/'); ?>';
        $("#body-content").load(baseUrl+"/"+url);
    }
    function loadModal(url){
        $("#body-content").load(url);
    }

    function loadModalEdit(route, id, action){
        var baseUrl='<?php echo URL::to('/'); ?>';
        $("#body-content").load(baseUrl+"/"+ route +'/'+ id +'/'+ action);
    }
</script>


<div class="modal fade add-modal" id="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog customized-modal modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" ></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">×</span>
                                        </button>
            </div>
            <div class="modal-body" id="body-content">
                {{-- <img src="{{asset('public/images/loading.gif')}}" alt="Loading" title="Loading" height="20px"> --}}

            </div>

        </div>
    </div>
</div>
<script>
    $('#modal').on('shown.bs.modal', function () {

        //Animated form
        $(".animated-form .form-control").each(function () {
            if( $(this).val() ) {
                $(this).parent().addClass('filled');
            }
        });
        $(".animated-form .form-control").focus(function(){
            $(this).parent().addClass("focused");
        }).blur(function(){
            $(this).parent().removeClass("focused");
            if( $(this).val() ) {
                $(this).parent().addClass('filled');
            }
        });


    });
</script>
