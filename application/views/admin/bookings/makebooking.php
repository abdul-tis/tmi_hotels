<script src="<?php echo  base_url(); ?>assets/admin/js/plugin/summernote/summernote.min.js"></script>
<link href="<?php echo  base_url(); ?>assets/admin/css/custom-main.css" rel="stylesheet">
<script src="http://maps.googleapis.com/maps/api/js?libraries=places" type="text/javascript"></script>
<?php  
    $this->load->view('themes/admin/breadcrumb');
?>
    <!-- MAIN CONTENT -->
    <div id="content">
        <div class="m-b-10">
           <div class="pull-left">
               <h3 class="pull-left">
                   <strong>Make Booking</strong>
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
                                    <a data-placement="top" rel="tooltip" data-toggle="tab" href="#tab1" data-original-title="" title="Booking" aria-expanded="false">
                                        Basic Information
                                    </a>
                                </li>
                            </ul>
                            <form class="smart-form" id="addBookingForm"  method="post" data-parsley-validate="" enctype="multipart/form-data" action="<?php echo base_url('admin/booking/makeBooking'); ?>">
                                <div class="tab-content padding-10">
                                    <div id="tab1" class="tab-pane active">
                                        <div class="row">
                                            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
                                                    <div class="col-lg-6 col-sm-6">
                                                        <fieldset>
                                                            <section>
                                                                <label class="label">Name</label>
                                                                <label class="input"> 
                                                                    <input type="text" placeholder="Name" required="" id="name" name="name" value="<?php echo set_value('name')?>">
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Email</label>
                                                                <label class="input"> 
                                                                    <input type="text" placeholder="Email" required="" id="email" name="email" value="<?php echo set_value('email')?>">
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Phone</label>
                                                                <label class="input"> 
                                                                    <input type="text" placeholder="Phone" required="" id="phone" name="phone" value="<?php echo set_value('phone')?>">
                                                                </label>
                                                            </section>
                                                            <div class="row">
                                                            <section>
                                                                <div class="input">
                                                                    <div class="col col-6">
                                                                        <label class="label">Checkin Date</label>
                                                                        <div class="form-group">
                                                                            <div class="input-group">
                                                                                <input class="form-control" id="from" name="from_date" required="" type="text" placeholder="Check In">
                                                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col col-6">
                                                                        <label class="label">Checkout Date</label>
                                                                        <div class="form-group">
                                                                            <div class="input-group">
                                                                                <input class="form-control" id="to" name="to_date" required="" type="text" placeholder="Check Out">
                                                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </section>
                                                            </div>
                                                            <div class="row">
                                                            <section>
                                                                <div class="col col-6">
                                                                    <label class="label">Location</label>
                                                                    <label class="input"> 
                                                                        <input type="text" placeholder="Location" required="" id="location" name="location" value="<?php echo set_value('location')?>">
                                                                    </label>
                                                                </div>
                                                                <div class="col col-6">
                                                                    <label class="label">Hotel</label>
                                                                    <label class="select"> 
                                                                        <select class="select2" name="hotel_id" id="hotel_id" style="width:100%" required="">

                                                                        </select>
                                                                        
                                                                    </label>
                                                                </div>
                                                            </section>
                                                            </div>
                                                            <div class="row">
                                                            <section>
                                                                <div class="col col-6">
                                                                    <label class="label">Room Type</label>
                                                                    <label class="select"> 
                                                                        <select class="input-sm" name="room_type" id="room_type" required="">
                                                                            <option value="">Select Room Type</option>
                                                                        </select> <i></i>
                                                                    </label>
                                                                </div>
                                                                <div class="col col-6">
                                                                    <label class="label">No of Rooms</label>
                                                                    <label class="select"> 
                                                                        <select class="input-sm" name="no_of_rooms" id="no_of_rooms" required="">
                                                                            <option value="">Select Room</option>
                                                                        </select> <i></i>
                                                                    </label>
                                                                </div>
                                                                
                                                            </section>
                                                            </div>
                                                            <div id="room_details">
                                                            <div class="row">
                                                                <div class="col col-4">
                                                                    <label class="label">Rooms</label>
                                                                    <label class="input"> 
                                                                        Room1:
                                                                    </label>
                                                                </div>
                                                                <div class="col col-4">
                                                                    <label class="label">Adult</label>
                                                                    <label class="select"> 
                                                                        <select class="input-sm adults" name="adults[]" id="">
                                                                            <option value="">Select Adult</option>
                                                                        </select> <i></i>
                                                                    </label>
                                                                </div>
                                                                <div class="col col-4">
                                                                    <label class="label">Children</label>
                                                                    <label class="select"> 
                                                                        <select class="input-sm children" name="children[]" id="">
                                                                            <option value="0">0</option>
                                                                        </select> <i></i>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            </div>
                                                            <section>
                                                                <label class="label">Extra Bed</label>
                                                                <label class="select"> 
                                                                    <select class="input-sm" name="extra_beds" id="extra_beds">
                                                                        <option value="">Extra Bed</option>
                                                                    </select> <i></i>
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <div class="row price_div"></div>
                                                            </section>
                                                            </fieldset>
                                                        </div>
                                                        <div class="col-lg-6 col-sm-6">
                                                            <fieldset>
                                                            <section>
                                                                <div class="row price_div"></div>
                                                            </section>
                                                            
                                                            <section>
                                                                <label class="label">Booked By</label>
                                                                <label class="select"> 
                                                                    <select class="input-sm" name="booked_by" id="booked_by">
                                                                        <option value="online">Online</option>
                                                                        <option value="admin">Admin</option>
                                                                    </select> <i></i>
                                                                </label>
                                                            </section>
                                                            <!-- <section>
                                                                <label class="label">Coupon</label>
                                                                <label class="input"> 
                                                                    <input type="text" placeholder="Coupon Code" id="coupon_code" name="coupon_code" value="<?php echo set_value('coupon_code')?>">
                                                                </label>
                                                            </section> 
                                                            <section>
                                                                <label class="label">Discount</label>
                                                                <label class="input"> 
                                                                    <input type="text" placeholder="Discount" id="campaign_discount" name="campaign_discount" value="<?php echo set_value('campaign_discount')?>">
                                                                </label>
                                                            </section>-->
                                                            <?php 
                                                                if(!empty($coupons)){
                                                                    echo '<label class="label">Coupons</label>';
                                                                    foreach($coupons as $coupon){

                                                            ?>
                                                                <section>
                                                                <label class="radio state-error">
                                                                    <input type="radio" class="coupon_code" value="<?php echo $coupon['id'];?>" name="coupon_id" data-parsley-multiple="status" data-parsley-id="1815">
                                                                    <i></i> Use Coupon Code <strong><?php echo $coupon['coupon_code'];?></strong> and get discount of <strong><?php echo $coupon['discount'];?>%</strong> on booking.
                                                                </label>
                                                            </section>
                                                            <?php }}?>   
                                                            
                                                            <?php 
                                                                if(!empty($campaigns)){
                                                                    echo '<label class="label">Campaigns</label>';
                                                                    foreach($campaigns as $campaign){

                                                            ?>
                                                                <section>
                                                                <label class="radio state-error">
                                                                    <input type="radio" class="campaign" value="<?php echo $campaign['id'];?>" name="campaign_id" data-parsley-multiple="status" data-parsley-id="1815">
                                                                    <i></i>Avail offer and get discount of <strong><?php echo $campaign['discount'];?>%</strong> on booking.
                                                                </label>
                                                            </section>
                                                            <?php }}?>                                
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
    
   var input = document.getElementById('location');
   var options = {
        componentRestrictions : {
            country : 'in' // What to pass here, If I want to allow search result from all country?
        },
        types: ['(regions)']
    };
   var autocomplete = new google.maps.places.Autocomplete(input,options);
   
   google.maps.event.addListener(autocomplete, 'place_changed', function () {
        /*place = autocomplete.getPlace();
        console.log(place);*/
        var place = $('#location').val();
        $.ajax({
            url:'<?php echo base_url("admin/booking/getHotelsByLocation");?>',
            type:'post',
            data:{'location':place},
            success:function(data){
                $('#hotel_id').html(data);
                $('#hotel_id').select2();
            }
        });
    });

    
    $(document).ready(function () {
        //****** Checking All tab validation ******//
        var instance = $('#addBookingForm').parsley();
        $('.frm-submit').click(function(){
            if(instance.isValid() === false){
            /*   display a messge to show users there is some more errors in form  */
                bootstrap_alert.danger('Please check all contents');
            }
        });

        // Date Range Picker
        $("#from").datepicker({
            defaultDate: "now",
            minDate: 'now',
            changeMonth: true,
            numberOfMonths: 1,
            prevText: '<i class="fa fa-chevron-left"></i>',
            nextText: '<i class="fa fa-chevron-right"></i>',
            onClose: function (selectedDate) {
                $("#to").datepicker("option", "minDate+1", selectedDate);
            }

        });
        $("#from").datepicker('setDate','+0');
        $("#to").datepicker({
            defaultDate: "+1d",
            minDate: '+1',
            changeMonth: true,
            numberOfMonths: 1,
            prevText: '<i class="fa fa-chevron-left"></i>',
            nextText: '<i class="fa fa-chevron-right"></i>',
            onClose: function (selectedDate) {
                $("#from").datepicker("option", "maxDate", selectedDate);
            }
        });
        $("#to").datepicker('setDate','+1');

        $('#hotel_id').change(function(){
            var hotel_id = $(this).val();
            if(hotel_id != ''){
                    $.ajax({
                    url:'<?php echo base_url("admin/booking/getRoomDetailsByHotel");?>',
                    type:'post',
                    data:{'hotel_id':hotel_id},
                    success:function(data){
                        $('#room_type').html(data);
                        $('#room_type').trigger('change');
                    }
                });
            }
        });

        $('#room_type').change(function(){
            var room_type = $(this).val();
            var hotel_id = $('#hotel_id').val();
            if(hotel_id != '' && room_type != ''){
                    $.ajax({
                    url:'<?php echo base_url("admin/booking/getRoomDetailsById");?>',
                    type:'post',
                    data:{'hotel_id':hotel_id,'room_type':room_type},
                    success:function(data){
                        if(data){
                            var newData = $.parseJSON(data);
                            $('.adults').html(newData.adult_html);
                            $('.children').html(newData.children_html);
                            $('#extra_beds').html(newData.extra_beds_html);
                            $('#no_of_rooms').html(newData.rooms_html);                    
                            $('.price_div').html('<strong>Price : Rs. </strong><span>'+newData.price+'</span>');
                            $('#no_of_rooms').trigger('change');
                        }
                    }
                });
            }
        });

        $('#no_of_rooms').change(function(){
            var room      = $(this).val();
            room          = parseInt(room); 
            var hotel_id  = $('#hotel_id').val();
            var room_type = $('#room_type').val();
            var from_date = $('#from').val();
            var to_date = $('#to').val();

            var html    = '';
            if(!isNaN(room) && room > 0){
                for(var i=1;i<=room;i++){
                html += '<div class="row">';
                html +=     '<div class="col col-4">';
                html +=         '<label class="label">Rooms</label>';
                html +=         '<label class="input">'; 
                html +=             'Room'+i+':'
                html +=         '</label>';
                html +=     '</div>';
                html +=      '<div class="col col-4">';
                html +=           '<label class="label">Adult</label>';
                html +=            '<label class="select">';
                html +=                   '<select class="input-sm adults" name="adults[]" id="">';
                html +=                            '<option value="">Select Adult</option>';
                html +=                    '</select> <i></i>';
                html +=             '</label>';
                html +=      '</div>';
                html +=       '<div class="col col-4">';
                html +=            '<label class="label">Children</label>';
                html +=             '<label class="select"> ';
                html +=                    '<select class="input-sm children" name="children[]" id="">';
                html +=                            '<option value="0">0</option>';
                html +=                     '</select> <i></i>';
                html +=              '</label>';
                html +=         '</div>';
                html += '</div>';
                }
                
                $('.price_div').html('<img src="<?php echo base_url('assets/admin/img/loading.gif');?>">');
                $.ajax({
                    url:'<?php echo base_url("admin/booking/checkRoomAvailability");?>',
                    type:'post',
                    data:{'hotel_id':hotel_id,'room_type':room_type,'no_of_rooms':room,'from_date':from_date,'to_date':to_date},
                    success:function(data){
                        if(data != ''){
                            var newData  = $.parseJSON(data);
                            if(newData.status == '1'){
                                $('#room_details').html(html);
                                $('.adults').html(newData.adult_html);
                                $('.children').html(newData.children_html);
                                $('.price_div').html('<strong>Price : Rs. </strong><span>'+newData.price+'</span>');
                                $('#extra_beds').val("0");
                                $('.coupon_code').prop('checked',false);
                                $('.campaign').prop('checked',false);
                            }else if(newData.status == '0'){
                                //$("#room_type").val('');
                                $('#room_details').html("");
                                $('.price_div').html("<strong>Rooms Unavailable</strong>");
                                $('#no_of_rooms').val("");
                                $('#extra_beds').val("0");
                                $('.coupon_code').prop('checked',false);
                                $('.campaign').prop('checked',false);
                            }else if(newData.status == '2'){
                                //$("#room_type").val('');
                                $('#room_details').html("");
                                $('.price_div').html("<strong>Rooms Unavailable</strong>");
                                $('#no_of_rooms').val('<option value="">No room available</option>');
                                $('#extra_beds').val("");
                                $('.coupon_code').prop('checked',false);
                                $('.campaign').prop('checked',false);
                            }else{
                                $('#room_details').html("");
                                $('.price_div').html("<strong>Rooms Unavailable</strong>");
                                $('#extra_beds').val("0");
                                $('.coupon_code').prop('checked',false);
                                $('.campaign').prop('checked',false);
                            }
                        }
                    }
                });
                
            }
        });

        $('#extra_beds').change(function(){
            var extra_beds  = $(this).val();
            var hotel_id    = $('#hotel_id').val();
            var room_type   = $('#room_type').val();
            var no_of_rooms = $('#no_of_rooms').val();
            $('.price_div').html('<img src="<?php echo base_url('assets/admin/img/loading.gif');?>">')
            getUpdatedPrice(hotel_id,room_type,no_of_rooms,extra_beds);
            $('.coupon_code').prop('checked',false);
            $('.campaign').prop('checked',false);
        });

        $('.coupon_code').click(function(){
            var coupon_id  = $(this).val();
            var extra_beds  = $('#extra_beds').val();
            var hotel_id    = $('#hotel_id').val();
            var room_type   = $('#room_type').val();
            var no_of_rooms = $('#no_of_rooms').val();
            var campaign_id = $('input[name=campaign_id]:checked').val();
            
            if(hotel_id == '' || hotel_id == null){
                alert("please select a hotel");
                return false;
            }
            if(room_type == '' || room_type == null){
                alert("please select a room type");
                return false;
            }
            if(campaign_id != ''){
                campaign_id = campaign_id;
            }else{
                campaign_id = 0;
            }
            $('.price_div').html('<img src="<?php echo base_url('assets/admin/img/loading.gif');?>">')
            getUpdatedPrice(hotel_id,room_type,no_of_rooms,extra_beds,coupon_id,campaign_id);
        });

        $('.campaign').click(function(){
            var coupon_id   = $('input[name=coupon_id]:checked').val();
            var extra_beds  = $('#extra_beds').val();
            var hotel_id    = $('#hotel_id').val();
            var room_type   = $('#room_type').val();
            var no_of_rooms = $('#no_of_rooms').val();
            var campaign_id = $(this).val();
            
            if(hotel_id == '' || hotel_id == null){
                alert("please select a hotel");
                return false;
            }
            if(room_type == '' || room_type == null){
                alert("please select a room type");
                return false;
            }
            if(coupon_id != ''){
                coupon_id = coupon_id;
            }else{
                coupon_id = 0;
            }
            $('.price_div').html('<img src="<?php echo base_url('assets/admin/img/loading.gif');?>">')
            getUpdatedPrice(hotel_id,room_type,no_of_rooms,extra_beds,coupon_id,campaign_id);
        });

        function getUpdatedPrice(hotel_id,room_type,no_of_rooms=1,extra_beds=0,coupon_id=0,campaign_id=0){
           $.ajax({
                url:'<?php echo base_url("admin/booking/getUpdatedPrice");?>',
                type:'post',
                data:{'hotel_id':hotel_id,'room_type':room_type,'no_of_rooms':no_of_rooms,'extra_beds':extra_beds,'coupon_id':coupon_id,'campaign_id':campaign_id},
                success:function(data){
                    $('.price_div').html('<strong>Price : Rs. </strong><span>'+data+'</span>');
                }
           });
            
        }
    });

</script>


