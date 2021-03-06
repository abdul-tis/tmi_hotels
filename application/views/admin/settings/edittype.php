<script src="<?php echo  base_url(); ?>assets/admin/js/plugin/summernote/summernote.min.js"></script>
<link href="<?php echo  base_url(); ?>assets/admin/css/custom-main.css" rel="stylesheet">

<?php  
	$this->load->view('themes/admin/breadcrumb');
?>
	<!-- MAIN CONTENT -->
	<div id="content">
		<div class="m-b-10">
           <div class="pull-left">
               <h3 class="pull-left">
                   <strong>Edit Hotel Type</strong>
               </h3>
           </div>
       </div>
		<section id="widget-grid" class="">
            <div data-widget-editbutton="false" id="8521cbb7b77c1acb05ccf76f73014447" class="jarviswidget jarviswidget-sortable" role="widget">
                <div role="content">
                    <div class="jarviswidget-editbox"></div>
                    <div class="widget-body ">
                        <div class="tabbable">
                            <ul class="nav nav-tabs bordered">
                                <li class="active">
                                    <a data-placement="top" rel="tooltip" data-toggle="tab" href="#tab1" data-original-title="" title="Hotel type" aria-expanded="false">
                                        Basic Information
                                    </a>
                                </li>
                            </ul>
                            <form class="smart-form" id="editHotelTypeForm"  method="post" data-parsley-validate="" enctype="multipart/form-data" action="<?php echo base_url('admin/settings/editHotelType/'.$hotel_type['id']); ?>">
                                <div class="tab-content padding-10">
                                    <div id="tab1" class="tab-pane active">
                                        <div class="row">
                                            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
                                                    <div class="col-lg-6 col-sm-6">
                                                        <fieldset>
                                                            <section>
                                                                <label class="label">Name</label>
                                                                <label class="input"> 
                                                                    <input type="text" placeholder="Type Name" required="" id="hotel_type" name="hotel_type" value="<?php echo (!empty($hotel_type['hotel_type']))?$hotel_type['hotel_type']:'';?>">
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Status</label>
                                                                <div class="input input-radio">
                                                                    <div class="col col-3">
                                                                        <label class="radio state-success">
                                                                            <input type="radio" <?php echo (!empty($hotel_type['status']) && $hotel_type['status'] == '1')?'checked':''?> value="1" name="status" data-parsley-multiple="status" data-parsley-id="1815">
                                                                            <i></i>Enable
                                                                        </label><ul class="parsley-errors-list" id="parsley-id-multiple-status"></ul>
                                                                        </div>
                                                                        <div class="col col-3">
                                                                        <label class="radio state-error">
                                                                            <input type="radio" <?php echo ($hotel_type['status'] !='' && $hotel_type['status'] == '0')?'checked':''?> value="0" name="status" data-parsley-multiple="status" data-parsley-id="1815">
                                                                            <i></i>Disable
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </section>                         
                                                        </fieldset>
                                                    </div>
                                                    
                                            </article>
                                        </div>
                                    </div>
                                <footer>
                                    <hr class="simple">
                                    <button class="btn btn-success pull-right frm-submit" type="submit" id="submit_btn">
                                        Submit
                                    </button>
                                   
                                    <button onclick="window.history.back();" class="btn btn-default" type="button">Back</button>
                                </footer>

                            </form>
                        </div>
                        
                </div>
            </div>
        </section>
    </div>
</div>
</div>
<!-- PAGE RELATED PLUGIN(S) -->

<script type="text/javascript">
        //****** Checking All tab validation ******//
		$(document).ready(function () {
			var instance = $('#editHotelTypeForm').parsley();
			$('.frm-submit').click(function(){
				if(instance.isValid() === false){
				/*   display a messge to show users there is some more errors in form  */
					bootstrap_alert.danger('Please check all contents');
				}
			});
    });

</script>


