<link href="<?php echo base_url(); ?>assets/admin/css/custom-main.css" rel="stylesheet">
<script src="http://maps.googleapis.com/maps/api/js?libraries=places" type="text/javascript"></script>
<?php $this->load->view('themes/admin/breadcrumb');	?>
	<div id="content">
		<div class="m-b-10">
           <div class="pull-left">
               <h3 class="pull-left">
                   <strong>Booking List</strong>
               </h3>
           </div>
           <div class="pull-right">
               <a href="<?php echo base_url('admin/booking/makeBooking');?>" class="btn btn-primary"><i class="fa fa-plus"></i>Make Booking</a>
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
                            <h2><?php echo $list_heading?></h2>
                        </header>

                        <!-- widget div-->
                        <div>
                            <div class="jarviswidget-editbox">
                            </div>
                            <!-- end widget edit box -->

                            <!-- widget content -->
                            <div class="widget-body no-padding">
                                <!-- <div id="hotel-serach-form">
                                    <select name="hotel_type" id="hotel_type">
                                        <option value="">Select Hotel Type</option>
                                        <?php 
                                            if(!empty($hotel_types)){
                                                foreach($hotel_types as $hotel_type){

                                        ?>
                                            <option value="<?php echo $hotel_type['id']?>"><?php echo $hotel_type['hotel_type'];?></option>
                                        <?php }}?>    
                                    </select>
                                    <input type="text" name="location" id="location" placeholder="Location" value="">
                                    <div style="float:right">
                                        <input type="text" id="hotel_name" name="hotel_name" placeholder="Hotel Name" class="">
                                        <input type="button" class="btn btn-primary" id="search_hotel" value="Search" name="search">
                                    </div>
                                    
                                </div> -->
                                <table class="table table-striped table-bordered table-hover editable-seller-info" width="100%">
                                    <thead>
											<tr>
                                                <th>Booking Number</th>
                                                <th>Check in-Check out</th>
                                                <th>Hotel</th>
                                                <th>Room Type</th>
                                                <th>Customer</th>
                                                <th>Rooms</th>
                                                <th>Payment (Rs)</th>
                                                <th>Status</th>
                                                <!-- <th class="sorting">Action</th> -->
											</tr>
                                    </thead>
                                    <tbody id="hotels_html">
										<?php
                                          if (!empty($bookings)) {
                                             foreach ($bookings as $booking) {
                                                $hotel_name = getHotelNameById($booking['hotel_id']);
                                                $room_type  = getRoomTypeById($booking['room_type']);
										?>
                                        <tr id="<?php echo $booking['id'];?>" >
											<form class="editForm<?php echo $booking['id'];?>" enctype="multipart/form-data">
                                            <td>
												<span class="view_mode<?php echo $booking['id'];?>"><?php echo (!empty($booking['booking_number'])) ? '#'.$booking['booking_number'] : "N/A";?></span>
                                            </td>
                                            <td>
												<span class="view_mode<?php echo $booking['id'];?>"><?php echo (!empty($booking['from_date'])) ? date('d M,Y',strtotime($booking['from_date'])).' - '.date('d M,Y',strtotime($booking['to_date'])) : "N/A";?></span>
											</td>
                                            <td>
                                                <span class="view_mode<?php echo $booking['id'];?>"><?php echo (!empty($hotel_name)) ? $hotel_name  : "N/A";?></span>
                                            </td>
											<td>
												<span class="view_mode<?php echo $booking['id'];?>"><?php echo (!empty($room_type)) ? $room_type : "N/A";?></span>
											</td>
											<td>
												<span class="view_mode<?php echo $booking['id'];?>"><?php echo (!empty($booking['name'])) ?$booking['name'] : "N/A";?></span>
											</td>
                                            <td>
                                                <span class="view_mode<?php echo $booking['id'];?>"><?php echo '<strong>Rooms : </strong>'.$booking['booked_rooms']."<br/><strong>Adults : </strong>".$booking['adult']."<br/><strong>Children : </strong>".$booking['children']."<br/><strong>Extra Bed : </strong>".$booking['extra_bed'];?></span>
                                            </td>
                                            <td>
                                                <span class="view_mode<?php echo $booking['id'];?>"><?php echo (!empty($booking['total_amount'])) ?$booking['total_amount'] : "N/A";?></span>
                                            </td>
                                            <td>
                                                <span class="view_mode<?php echo $booking['id'];?>"><?php echo (!empty($booking['status']) && $booking['status'] == '1') ? "Paid" : "Unpaid";?></span>
                                            </td>
											<!-- <td>
												<a class="btn btn-success commonBtn" data-type ="edit" data-row-id="<?php echo 'booking_'.$booking['id'];?>" data-id="<?php echo $booking['id'];?>" href="<?php echo base_url('admin/booking/editBooking/'.$booking['id'])?>">Edit</a>
												<a class="delete btn btn-sm btn-danger" data-target="#confirm-delete" data-toggle="modal" data-record-title="<?php echo $booking['booking_number'];?>" data-type="delete" data-record-id="<?php echo $booking['id'];?>" data-remove-row="<?php echo 'booking_'.$booking['id'];?>" href="javascript:void(0)" >Delete</a>
											</td> -->
											</form>
                                        </tr>
                                        <?php } } else {?>
                                        <tr>
                                            <td colspan="9" align="center">
                                                <span>No Records Found</span>
                                            </td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>

                                <div class="dt-toolbar-footer">
                                    <div class="col-sm-6 col-xs-6 hidden-xs">
                                        <div class="dataTables_info" id="dt_basic_info" role="status" aria-live="polite">Showing 
                                        <span class="txt-color-darken" id="num_from"><?=$recordsFrom;?></span> to <span class="txt-color-darken" id="num_to"><?=($totalRecords < $limit ) ? $totalRecords : $limit;?></span>
                                        of <span class="text-primary" id="total_page"><?=$totalRecords;?></span> entries
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-6 col-sm-6">
                                        <div class="dataTables_paginate paging_simple_numbers" id="dt_basic_paginate">
                                            <ul class="pagination pagination-sm">
                                            <?php
                                                echo $links;
                                            ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

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
        /*$('#dt_basic').dataTable({
            "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                    "t" +
                    "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
            "autoWidth": true,
            "columnDefs": [{
            "defaultContent": "-",
            "targets": "_all"
          }]

        });
*/
        $('#confirm-delete').on('click', '.btn-ok', function (e) {
            var $modalDiv = $(e.delegateTarget);
            var id = $(this).data('recordId');
            var rowId = $(this).data('removeRow');
            var msg = 'Selected product successfully removed!';
            $.post("<?=base_url('admin/hotels/deleteHotel')?>",{'hotel_id':id}, function (response){
                if(response == 'TRUE'){
                    bootstrap_alert.success(msg);
                    $('#confirm-delete').modal('hide');
                    $('#'+id).remove();
                }
                else{
                    bootstrap_alert.warning('Permission is not allowed for this page or internal server error');
                    $('#confirm-delete').modal('hide');
                }
            })
        });
        
        $('#confirm-delete').on('show.bs.modal', function (e) {
            var data = $(e.relatedTarget).data();
            $('.title', this).text(data.recordTitle);
            $('.btn-ok', this).data('recordId', data.recordId);
            $('.btn-ok', this).data('removeRow', data.removeRow);
        });

        $('[data-toggle="tooltip"]').tooltip();
    })

</script>
