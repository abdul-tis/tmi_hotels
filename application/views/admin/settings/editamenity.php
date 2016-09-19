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
                   <strong>Edit Amenity</strong>
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
                                    <a data-placement="top" rel="tooltip" data-toggle="tab" href="#tab1" data-original-title="" title="Amenity" aria-expanded="false">
                                        Basic Information
                                    </a>
                                </li>
                            </ul>
                            <form class="smart-form" id="editAmenityForm"  method="post" data-parsley-validate="" enctype="multipart/form-data" action="<?php echo base_url('admin/settings/addAmenity'); ?>">
                                <div class="tab-content padding-10">
                                    <div id="tab1" class="tab-pane active">
                                        <div class="row">
                                            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
                                                    <div class="col-lg-6 col-sm-6">
                                                        <fieldset>
															<section>
																<label class="label">Main Service</label>
																<label class="select">
                                                                    <select class="input-sm" name="parent_id" id="parent_id">
                                                                        <option value="0">Select Service</option>
                                                                        <?php 
                                                                            if(!empty($main_service))
                                                                            {
                                                                                foreach($main_service as $service)
                                                                                {
                                                                        ?>
                                                                        <option value="<?php echo $service['id'];?>" <?php echo (!empty($amenity['parent_id']) && $amenity['parent_id'] == $service['id'])?'selected':'';?>><?php echo $service['service_name'];?></option>
                                                                        <?php
                                                                                }
                                                                            }
                                                                        ?>
                                                                    </select> <i></i> 
                                                                </label>
															</section>
                                                            <section>
                                                                <label class="label">Amenity Name</label>
                                                                <label class="input"> 
                                                                    <input type="text" placeholder="Name" required="" id="service_name" name="service_name" value="<?php echo (!empty($amenity['service_name']))?$amenity['service_name']:'';?>">
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Amenity Type</label>
                                                                <label class="select">
                                                                    <select class="input-sm" name="type" id="type" required="">
                                                                        <option value="">Select Type</option>
                                                                        <option value="1" <?php echo (!empty($amenity['type']) && $amenity['type'] == '1')?'selected':'';?>>Hotel</option>
                                                                        <option value="2" <?php echo (!empty($amenity['type']) && $amenity['type'] == '2')?'selected':'';?>>Room</option>
                                                                    </select>
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Upload Icon</label>
                                                                <label class="file">
                                                                    <input type="file" name="amenity_icon">
                                                                    <img src="<?php echo base_url('uploads/icons/'.$amenity['amenity_icon']);?>" width="25" height="25"/>
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label"></label>
                                                                    <label class="checkbox">
                                                                        <input type="checkbox" <?php echo (!empty($amenity['complimentary']) && $amenity['complimentary'] == '1')?'checked':'';?> name="complimentary" value="1"><i></i> Complimentary
                                                                    </label>
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
			var instance = $('#editAmenityForm').parsley();
			$('.frm-submit').click(function(){
				if(instance.isValid() === false){
				/*   display a messge to show users there is some more errors in form  */
					bootstrap_alert.danger('Please check all contents');
				}
			});
    });

</script>


