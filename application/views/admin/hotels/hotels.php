<link href="<?php echo base_url(); ?>assets/admin/css/custom-main.css" rel="stylesheet">
<script src="http://maps.googleapis.com/maps/api/js?libraries=places" type="text/javascript"></script>
<?php $this->load->view('themes/admin/breadcrumb');	?>
	<div id="content">
		<div class="m-b-10">
           <div class="pull-left">
               <h3 class="pull-left">
                   <strong>Hotels List</strong>
               </h3>
           </div>
           <div class="pull-right">
               <a href="<?php echo base_url('admin/hotels/addHotel');?>" class="btn btn-primary"><i class="fa fa-plus"></i>Add Hotel</a>
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
                                <div id="hotel-serach-form">
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
                                    
                                </div>
                                <table id="dt_basic" class="table table-striped table-bordered table-hover editable-seller-info" width="100%">
                                    <thead>
											<tr>
                                                <th>Hotel Name</th>
                                                <th>Rating</th>
                                                <th>City</th>
                                                <th>Price (Rs.)</th>
                                                <th>Total Rooms</th>
                                                <th>TMI Rooms</th>
                                                <th>Hotel Type</th>
                                                <th>Status</th>
                                                <th class="sorting">Action</th>
											</tr>
                                    </thead>
                                    <tbody id="hotels_html">
										<?php
                                          if (!empty($hotels)) {
                                             foreach ($hotels as $hotel) {
											 $hotel_type     = getHotelTypeById($hotel['hotel_type']);
                                             if($hotel['star_rating'] == '1')
                                             {
                                                $star_rating    = '<img src="'.base_url().'assets/admin/img/1-stars.png">';
                                             }
                                             elseif($hotel['star_rating'] == '2')
                                             {
                                                $star_rating    = '<img src="'.base_url().'assets/admin/img/2-stars.png">';
                                             }
                                             elseif($hotel['star_rating'] == '3')
                                             {
                                                $star_rating    = '<img src="'.base_url().'assets/admin/img/3-stars.png">';
                                             }
                                             elseif($hotel['star_rating'] == '4')
                                             {
                                                $star_rating    = '<img src="'.base_url().'assets/admin/img/4-stars.png">';
                                             }
                                             elseif($hotel['star_rating'] == '5')
                                             {
                                                $star_rating    = '<img src="'.base_url().'assets/admin/img/5-stars.png">';
                                             }
                                             else
                                             {
                                                $star_rating    = 'N/A';
                                             }

                                             $city = getCityById($hotel['loc_city']);
                                             //$state = getstateById($hotel['state']);
                                             //$country = getCountryById($hotel['country']);
										?>
                                        <tr id="<?php echo $hotel['hotel_id'];?>" >
											<form class="editForm<?php echo $hotel['hotel_id'];?>" enctype="multipart/form-data">
                                            <!-- <td>
												<span class="view_mode<?php echo $hotel['hotel_id'];?>">
												<?php
													/*$imgSrc = base_url('assets/admin/img/no-preview.png');
													if(!empty($hotel['image'])){
														$imgPath	= FCPATH.'upload-data/users/sellers/'.$hotel['image'];
														$imgSrc		= base_url('upload-data/users/sellers/'.$hotel['image']);
														if(file_exists($imgPath)){
															echo '<img src="'.$imgSrc.'" tag="Seller image" class="category-img-class">';
														}else{
															echo '<img src="'.$imgSrc.'" tag="Seller image" class="category-img-class">';
														}
													}else{
														echo '<img src="'.$imgSrc.'" tag="Seller image" class="category-img-class">';
													}*/
												?>
												</span>
											</td> -->
                                            <td>
												<span class="view_mode<?php echo $hotel['hotel_id'];?>"><?php echo (!empty($hotel['hotel_name'])) ? $hotel['hotel_name'] : "N/A";?></span>
                                            </td>
                                            
                                            <td>
												<span class="view_mode<?php echo $hotel['hotel_id'];?>"><?php echo $star_rating;?></span>
											</td>
											<td>
												<span class="view_mode<?php echo $hotel['hotel_id'];?>"><?php echo (!empty($city)) ? $city : "N/A";?></span>
											</td>
                                            <td>
                                                <span class="view_mode<?php echo $hotel['hotel_id'];?>"><?php echo (!empty($hotel['price'])) ? $hotel['price'] : "N/A";?></span>
                                            </td>
											<td>
												<span class="view_mode<?php echo $hotel['hotel_id'];?>"><?php echo (!empty($hotel['no_of_rooms'])) ? $hotel['no_of_rooms'] : "N/A";?></span>
											</td>
                                            
											<td>
												<span class="view_mode<?php echo $hotel['hotel_id'];?>"><?php echo (!empty($hotel['tmi_rooms'])) ? $hotel['tmi_rooms'] : "N/A";?></span>
											</td>
                                            <td>
                                                <span class="view_mode<?php echo $hotel['hotel_id'];?>"><?php echo (!empty($hotel_type)) ? '<a href="javascript:void(0)" title="'.$hotel_type.'"> <img src="'.base_url().'assets/admin/img/property-type-icon.png"></a>' : "N/A";?></span>
                                                
                                            </td>
                                            <td>
                                                <span class="view_mode<?php echo $hotel['hotel_id'];?>"><?php echo (!empty($hotel['hotel_status']) && $hotel['hotel_status'] == '1') ? "Active" : "Inactive";?></span>
                                            </td>
                                            
											<td>
												<a class="btn btn-success commonBtn" data-type ="edit" data-row-id="<?php echo 'hotel_'.$hotel['hotel_id'];?>" data-id="<?php echo $hotel['hotel_id'];?>" href="<?php echo base_url('admin/hotels/editHotel/'.$hotel['hotel_id'])?>">Edit</a>
                                                <a class="btn btn-success commonBtn" data-type ="edit" data-row-id="<?php echo 'hotel_'.$hotel['hotel_id'];?>" data-id="<?php echo $hotel['hotel_id'];?>" href="<?php echo base_url('admin/hotels/hotelRooms/'.$hotel['hotel_id'])?>">Manage Rooms</a>
												<a class="delete btn btn-sm btn-danger" data-target="#confirm-delete" data-toggle="modal" data-record-title="<?php echo $hotel['hotel_name'];?>" data-type="delete" data-record-id="<?php echo $hotel['hotel_id'];?>" data-remove-row="<?php echo 'hotel_'.$hotel['hotel_id'];?>" href="javascript:void(0)" >Delete</a>
											</td>
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
    function initialize() {
               var input = document.getElementById('location');
               var options = {
                componentRestrictions : {
                        country : 'in' // What to pass here, If I want to allow search result from all country?
                    },
                    types: ['(regions)']
            };
               var autocomplete = new google.maps.places.Autocomplete(input,options);

       }
       google.maps.event.addDomListener(window, 'load', initialize);

    $(document).ready(function () {
        /*$('#dt_basic').dataTable({
            "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                    "t" +
                    "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
            "autoWidth": true,

        });*/

        $('#confirm-delete').on('click', '.btn-ok', function (e) {
            var $modalDiv = $(e.delegateTarget);
            var id = $(this).data('recordId');
            var rowId = $(this).data('removeRow');
            var msg = 'Selected product successfully removed!';
            $.post("<?=base_url('admin/hotels/deleteHotel')?>",{'hotel_id':id}, function (response){
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

        var page_number     = 0;
        var total_page      = null;
        var filter_type     = null;
        $('#hotel-serach-form').on('change','#hotel_type',function (){
            filter_type     = 'select';
            $('#hotel_name').val('');
            var hotel_type  = $(this).val();
            var location    = $('#location').val();
            getHotelsByAjax(hotel_type,'',location,page_number);
        });

        $('#location').on('change',function (){
            filter_type     = 'location';
            $('#hotel_name').val('');
            var location   = $(this).val();
            var hotel_type  = $('#hotel_type').val();
            getHotelsByAjax(hotel_type,'',location,page_number);
        });

        $('#search_hotel').on('click',function(){
            filter_type     = 'search_btn';
            $('#hotel_type').val('');
            $('#location').val('');
            var hotel_name  = $('#hotel_name').val();
            getHotelsByAjax('',hotel_name,'',page_number);
        });
        
        $(document).on("click","#next",function(){
            if(filter_type == 'search_btn')
            {
                var hotel_name  = $('#hotel_name').val();
                var page_number  = $(this).attr('rel');
                $("#hotels_html").html("");
                getHotelsByAjax('',hotel_name,'',page_number);
            }
            else if(filter_type == 'location')
            {
                var location  = $('#location').val();
                var hotel_type  = $('#hotel_type').val();
                var page_number  = $(this).attr('rel');
                $("#hotels_html").html("");
                getHotelsByAjax(hotel_type,'',location,page_number);
            }
            else
            {
                var hotel_type   = $('select#hotel_type option:selected').val();
                var location  = $('#location').val();
                var page_number  = $(this).attr('rel');
                $("#hotels_html").html("");
                getHotelsByAjax(hotel_type,'',location,page_number);
            }
           
           
                
         });
             
         $(document).on("click","#previous",function(){
            if(filter_type == 'search_btn')
            {
                var hotel_name  = $('#hotel_name').val();
                var page_number  = $(this).attr('rel');
                $("#hotels_html").html("");
                getHotelsByAjax('',hotel_name,'',page_number);
            }
            else if(filter_type == 'location')
            {
                var location  = $('#location').val();
                var hotel_type  = $('#hotel_type').val();
                var page_number  = $(this).attr('rel');
                $("#hotels_html").html("");
                getHotelsByAjax(hotel_type,'',location,page_number);
            }
            else
            {
                var hotel_type   = $('select#hotel_type option:selected').val();
                var location     = $('#location').val();
                var page_number  = $(this).attr('rel');
                $("#hotels_html").html("");
                getHotelsByAjax(hotel_type,'',location,page_number);
            }
         });

         $(document).on("click",".page_num_click",function(){
            if(filter_type == 'search_btn')
            {
                var hotel_name  = $('#hotel_name').val();
                var page_number  = $(this).attr('rel');
                $("#hotels_html").html("");
                getHotelsByAjax('',hotel_name,'',page_number);
            }
            else if(filter_type == 'location')
            {
                var location  = $('#location').val();
                var hotel_type  = $('#hotel_type').val();
                var page_number  = $(this).attr('rel');
                $("#hotels_html").html("");
                getHotelsByAjax(hotel_type,'',location,page_number);
            }
            else
            {
                var hotel_type   = $('select#hotel_type option:selected').val();
                var location     = $('#location').val();
                var page_number  = $(this).attr('rel');
                $("#hotels_html").html("");
                getHotelsByAjax(hotel_type,'',location,page_number);
            }
                
         });

        function getHotelsByAjax(hotel_type='',hotel_name='',location='',page_number)
        {
            if(hotel_type!='' || hotel_name !='' || location != ''){
                
                if(page_number==0){
                    $("#previous").hide();
                }else{
                    $("#previous").show();
                }
                if(page_number==(total_page-1)){
                    $("#next").hide();
                }else{
                    $("#next").show();
                }

                            
                //$("#page_number").html(page_number+1);
                $("#hotels_html").html('<tr><td colspan="9" align="center"><span><img src="<?php echo base_url(); ?>assets/admin/img/ajax-loader-image.gif" align="center"></span></td></tr>');
                $.ajax({
                    url : '<?php echo base_url('admin/hotels/getHotelsByAjax');?>',
                    type : 'post',
                    data : {'hotel_type':hotel_type,'hotel_name':hotel_name,'location':location,'page_number':page_number},
                    success:function(data){
                        var mydata = $.parseJSON(data);
                        total_page = mydata.total_page;
                        $('#hotels_html').html(mydata.hotels);
                        
                        if(mydata.totalRecords == false)
                        {
                            $('#dt_basic_info').hide();
                        }
                        else
                        {
                            $('#dt_basic_info').show();
                            if(page_number > 0)
                            {
                                var recordsFrom = (parseInt(page_number))*parseInt(mydata.limit);
                                
                                $('#num_from').html(recordsFrom);
                            }
                            else
                            {
                                $('#num_from').html(mydata.recordsFrom);
                            }
                            
                            if(mydata.totalRecords < mydata.limit)
                            {
                                $('#num_to').html(mydata.totalRecords);
                            }
                            else
                            {
                                $('#num_to').html(mydata.limit);
                            }
                            
                            $('#total_page').html(mydata.totalRecords);
                        }
                        
                        $('.pagination').html(mydata.links);
                    }

                });
                /*$.post('<?=base_url('orders/getAjaxSellerOrders');?>',{'daterange':daterange,'sellerId':sellerId},function (){
            
                });*/
            }
        }

    })

</script>
