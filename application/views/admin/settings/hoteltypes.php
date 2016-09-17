<link href="<?php echo base_url(); ?>assets/admin/css/custom-main.css" rel="stylesheet">
<?php $this->load->view('themes/admin/breadcrumb');	?>
	<div id="content">
		<div class="m-b-10">
           <div class="pull-left">
               <h3 class="pull-left">
                   <strong>Hotels List</strong>
               </h3>
           </div>
           <div class="pull-right">
               <a href="<?php echo base_url('admin/settings/addHotelType');?>" class="btn btn-primary"><i class="fa fa-plus"></i>Add Hotel Type</a>
           </div>
       </div>
        <!-- widget grid -->
        <section id="widget-grid" class="">

            <!-- row -->
            <div class="row">

                <!-- NEW WIDGET START -->
                <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                    <!-- Widget ID (each widget will need unique ID)-->
                    <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">
                        
                        <header>
                            <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                            <h2><?=$list_heading?></h2>
                        </header>

                        <!-- widget div-->
                        <div>
                            <div class="jarviswidget-editbox">
                            </div>
                            <!-- end widget edit box -->

                            <!-- widget content -->
                            <div class="widget-body no-padding">

                                <table id="dt_basic" class="table table-striped table-bordered table-hover editable-seller-info" width="100%">
                                    <thead>
											<tr>
                                                <th>Hotel Type</th>
                                                <th class="sorting">Action</th>
											</tr>
                                    </thead>
                                    <tbody>
										<?php
                                          if (!empty($hotel_types)) {
                                             foreach ($hotel_types as $hotel_type) {
												
										?>
                                        <tr id="<?php echo $hotel['hotel_id'];?>" >
											<form class="editForm<?php echo $hotel['hotel_id'];?>" enctype="multipart/form-data">
                                            
                                            <td>
												<span class="view_mode<?php echo $hotel['hotel_id'];?>"><?php echo (!empty($hotel['hotel_type'])) ? $hotel['hotel_type'] : "N/A";?></span>
												
											</td>
                                            
											<td>
												<a class="btn btn-success commonBtn" data-type ="edit" data-row-id="<?php echo $hotel['hotel_id'];?>" data-url="<?=base_url('users/editseller/'.$seller->id)?>" data-id="<?=$seller->id;?>" href="javascript:void(0)" >Edit</a>
												<a class="btn btn-danger commonBtn" data-type="delete" data-row-id="<?=$seller->id.'_A';?>" data-url="<?=base_url('users/editseller/'.$seller->id)?>" data-id="<?=$seller->id;?>" href="javascript:void(0)" >Delete</a>
											</td>
											</form>
                                        </tr>
                                        <?php } }?>
                                    </tbody>
                                </table>

                            </div>
                            <!-- end widget content -->

                        </div>
                        <!-- end widget div -->

                    </div>
                    <!-- end widget -->

                </article>
                <!-- WIDGET END -->
            </div>

        </section>

    </div>

<script src="<?php echo base_url(); ?>assets/admin/js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/dateformat.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#dt_basic').dataTable({
            "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                    "t" +
                    "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
            "autoWidth": true,

        });

    })

</script>
