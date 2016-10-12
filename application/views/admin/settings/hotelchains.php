<link href="<?php echo base_url(); ?>assets/admin/css/custom-main.css" rel="stylesheet">
<?php $this->load->view('themes/admin/breadcrumb');	?>
	<div id="content">
		<div class="m-b-10">
           <div class="pull-left">
               <h3 class="pull-left">
                   <strong>Hotel Chains</strong>
               </h3>
           </div>
           <div class="pull-right">
               <a href="<?php echo base_url('admin/settings/addHotelChain');?>" class="btn btn-primary"><i class="fa fa-plus"></i>Add Hotel Chain</a>
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
                                                <th>Name</th>
                                                <th>Status</th>
                                                <th class="sorting">Action</th>
											</tr>
                                    </thead>
                                    <tbody>
										<?php
                                          if (!empty($hotel_chains)) {
                                             foreach ($hotel_chains as $hotel_chain) {
												if($hotel_chain['status'] == '1'){
                                                    $status   = 'Active';
                                                }else{
                                                    $status   = 'Inactive';
                                                }

										?>
                                        <tr id="<?php echo $hotel_chain['id'];?>" >
											<form class="editForm<?php echo $hotel_chain['id'];?>" enctype="multipart/form-data">
                                            <td>
												<span class="view_mode<?php echo $hotel_chain['id'];?>"><?php echo (!empty($hotel_chain['name'])) ? $hotel_chain['name'] : "N/A";?></span>
											</td>
                                            <td>
                                                <span class="view_mode<?php echo $hotel_chain['id'];?>"><?php echo (!empty($status)) ? $status : "N/A";?></span>
                                            </td>
											<td>
												<a class="btn btn-success commonBtn" data-type ="edit" data-row-id="<?php echo 'chain_'.$hotel_chain['id'];?>" data-id="<?php echo $hotel_chain['id'];?>" href="<?php echo base_url('admin/settings/editHotelChain/'.$hotel_chain['id'])?>">Edit</a>
                                                <a class="delete btn btn-sm btn-danger" data-target="#confirm-delete" data-toggle="modal" data-record-title="<?php echo $hotel_chain['name'];?>" data-type="delete" data-record-id="<?php echo $hotel_chain['id'];?>" data-remove-row="<?php echo 'chain_'.$hotel_chain['id'];?>" href="javascript:void(0)" >Delete</a>
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

<!--**** Asking for Delete Confirmation ****-->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
            </div>
            <div class="modal-body">
                <p>You are about to delete <b><i class="title"></i></b> record, this procedure is irreversible.</p>
                <p>Do you want to proceed?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger btn-ok">Delete</button>
            </div>
        </div>
    </div>
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

        $('#confirm-delete').on('click', '.btn-ok', function (e) {
            var $modalDiv = $(e.delegateTarget);
            var id = $(this).data('recordId');
            var rowId = $(this).data('removeRow');
            var msg = 'Hotel chain successfully removed!';
            $.post("<?=base_url('admin/settings/deleteHotelChain')?>",{'id':id}, function (response){
                if(response){
                    bootstrap_alert.success(msg);
                    $('#confirm-delete').modal('hide');
                    $('#'+id).remove();
                }
            })
        });

        $('#confirm-delete').on('show.bs.modal', function (e) {
            var data = $(e.relatedTarget).data();
            $('.title', this).text(data.recordTitle);
            $('.btn-ok', this).data('recordId', data.recordId);
            $('.btn-ok', this).data('removeRow', data.removeRow);
        });

    });

</script>
