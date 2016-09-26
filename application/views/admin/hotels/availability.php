<link href="<?php echo base_url(); ?>assets/admin/css/custom-main.css" rel="stylesheet">
<?php $this->load->view('themes/admin/breadcrumb');	?>
	<div id="content">
		<div class="m-b-10">
           <div class="pull-left">
               <h3 class="pull-left">
                   <strong>Room Availability</strong>
               </h3>
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
                                <div>
                                    Filter By Room Type : 
                                    <select name="room_type" id="room_type">
                                        <?php 
                                            $type_id  = $this->uri->segment(5);
                                            if(!empty($room_details)){
                                                foreach($room_details as $room_detail){

                                        ?>
                                            <option value="<?php echo $room_detail['type_id']?>" <?php echo (!empty($type_id) && $type_id==$room_detail['type_id'])?'selected':'';?>><?php echo $room_detail['room_type'];?></option>
                                        <?php }}?>    
                                    </select>

                                </div>
                                <div>
                                    Bulk Blocking Rooms : 
                                    <input id="from_date" name="from_date" required="" type="text" placeholder="From">
                                    <span><i class="fa fa-calendar"></i></span>
                                    <input id="to_date" name="to_date" required="" type="text" placeholder="To">
                                    <span><i class="fa fa-calendar"></i></span>
                                    <input type="text" placeholder="No of Rooms" name="number_rooms_blocked" id="number_rooms_blocked" value="">
                                    <select name="reserve_type" id="reserve_type">
                                        <option value="">Select</option>
                                        <option value="0">Not Available</option>
                                        <option value="1">Admin Blocking</option>
                                    </select>    
                                    <input type="button" class="btn btn-primary" id="bulk_blocking" class="form-control" value="Block Rooms" name="bulk_blocking">                
                                </div>        
                                <!-- content goes here -->
                                <div class="widget-body-toolbar">

                                    <div id="calendar-buttons">

                                        <div class="btn-group">
                                            <a href="javascript:void(0)" class="btn btn-default btn-xs" id="btn-prev"><i class="fa fa-chevron-left"></i></a>
                                            <a href="javascript:void(0)" class="btn btn-default btn-xs" id="btn-next"><i class="fa fa-chevron-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                
                                <div id="calendar"></div>

                                <footer>
                                    <hr class="simple">
                                    <a class="btn btn-success pull-right commonBtn" data-type ="back" href="<?php echo base_url('admin/hotels/hotelRooms/'.$this->uri->segment(4))?>">Back</a>
                                </footer>
                                <!-- end content -->
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
    $(document).ready(function(){
        // Date Range Picker
        $("#from_date").datepicker({
            //defaultDate: "+1w",
            minDate: 'now',
            changeMonth: true,
            numberOfMonths: 1,
            prevText: '<i class="fa fa-chevron-left"></i>',
            nextText: '<i class="fa fa-chevron-right"></i>',
            dateFormat  : 'yy-mm-dd',
            onClose: function (selectedDate) {
                $("#to_date").datepicker("option", "minDate", selectedDate);
            }

        });
        $("#to_date").datepicker({
            //defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            prevText: '<i class="fa fa-chevron-left"></i>',
            nextText: '<i class="fa fa-chevron-right"></i>',
            dateFormat  : 'yy-mm-dd',
            onClose: function (selectedDate) {
                $("#from_date").datepicker("option", "maxDate", selectedDate);
            }
        });

        $('#room_type').change(function(){
            var id = $(this).val();
            window.location.href = '<?php echo base_url("admin/hotels/roomAvailability/".$this->uri->segment(4)."/")?>'+id;
        });

        $('#bulk_blocking').click(function(){
            var from_date  = $('#from_date').val();
            var to_date    = $('#to_date').val();
            
            var number_rooms_blocked = $('#number_rooms_blocked').val();
            var reserve_type = $('#reserve_type').val();
            if(from_date == ''){
                alert('Please enter start date!');
                return false;
            }else if(to_date == ''){
                alert('Please enter end date!');
                return false;
            }else if(number_rooms_blocked == ''){
                alert('Please enter no of rooms!');
                return false;
            }else{


            $.ajax({
                    url: '<?php echo base_url("admin/hotels/reserveRoom");?>',
                    type : 'post',
                    dataType:'json',
                    data: {
                        hotel_id : "<?php echo $this->uri->segment(4);?>",
                        id       : "<?php echo $this->uri->segment(5);?>",
                        no_of_rooms    : number_rooms_blocked,
                        from_date     : from_date,
                        to_date       : to_date,
                        reserve_type  : reserve_type,
                        type          : 'search'
                    },
                    success: function(response){
                        if(response.status == 'success'){
                            $('#calendar').fullCalendar('removeEvents');
                            $('#calendar').fullCalendar('refetchEvents');
                            
                            $('#number_rooms_blocked').val('');
                            $('#reserve_type').val('');
                        }else{
                            alert('Available rooms is '+response.rooms);
                            $('#number_rooms_blocked').val('');
                            $('#reserve_type').val('');
                       }
                    }
                });
            }
        });
        /*
         * FULL CALENDAR JS
         */
        
        function getFullCalendar(){
            if ($("#calendar").length) {
                var calendar = $('#calendar').fullCalendar({

                    editable : true,
                    draggable : false,
                    selectable : false,
                    selectHelper : true,
                    unselectAuto : false,
                    disableResizing : false,
                    eventStartEditable:false,

                    header : {
                        left : 'title', //,today
                        center : 'prev, next, today',
                        right : 'month, agendaWeek, agenDay' //month, agendaDay,
                    },
                    
                    select : function(start, end, allDay) {
                        var title = prompt('Available Rooms:');
                        if (title) {
                            calendar.fullCalendar('renderEvent', {
                                title : title,
                                start : start,
                                end : end,
                                allDay : allDay
                            }, true // make the event "stick"
                            );
                        }
                        calendar.fullCalendar('unselect');
                    },
                    events: function(start, end, timezone, callback) {
                            var date1  = new Date(end);;
                                d      = date1.getDate();
                                m      = date1.getMonth();
                                y      = date1.getFullYear();
                            $.ajax({
                                url: '<?php echo base_url("admin/hotels/getRoomAvailabilityData");?>',
                                type : 'post',
                                dataType:'json',
                                data: {
                                    hotel_id : "<?php echo $this->uri->segment(4);?>",
                                    id       : "<?php echo $this->uri->segment(5);?>",
                                    month    : m,
                                    year     : y
                                },
                                success: function(doc) {
                                    var events = [];
                                    if(!!doc){
                                        $.map( doc, function( r ) {
                                            events.push({
                                                title: r.title,
                                                start: r.start,
                                                end: r.end,
                                                allDay:r.allDay,
                                                description:r.description,
                                                
                                            });
                                        });
                                    }
                                    callback(events);
                                }
                            });
                        },
                    eventRender : function(event, element, icon) {
                        if (!event.description == "") {
                            element.find('.fc-event-title').append("<br/><span class='ultra-light'>" + event.description + "</span>");
                        }
                        if (!event.icon == "") {
                            element.find('.fc-event-title').append("<i class='air air-top-right fa " + event.icon + " '></i>");
                        }
                    },

                    eventClick: function(event, jsEvent, view) {
                        var start = event.start.format("YYYY-MM-DD");
                        var end = event.end.format("YYYY-MM-DD");
                        
                       var description = prompt('Room Available:', event.description.split(' - ')[1], { buttons: { Ok: true, Cancel: false} });
                       description     = parseInt(description);
                       if (!isNaN(description)){
                       
                           $.ajax({
                            url: '<?php echo base_url("admin/hotels/reserveRoom");?>',
                            type : 'post',
                            dataType:'json',
                            data: {
                                hotel_id : "<?php echo $this->uri->segment(4);?>",
                                id       : "<?php echo $this->uri->segment(5);?>",
                                no_of_rooms    : description,
                                from_date     : start,
                                to_date       : end,
                                type     : 'edit'

                            },
                             success: function(response){
                               if(response.status == 'success'){
                                    event.description = 'Available - '+description;
                                    $('#calendar').fullCalendar('updateEvent',event);
                               }else{
                                    alert('Max capacity is '+response.capacity);
                                    event.description = 'Available - '+response.rooms;
                                    $('#calendar').fullCalendar('updateEvent',event);
                               }
                                
                             },
                             error: function(e){
                               alert('Error processing your request: '+e.responseText);
                             }
                           });
                       }else{
                            alert('Please Enter numbers only');
                       }
                    }
                });

            };


        } 
        
        getFullCalendar();
        /* hide default buttons */
        $('.fc-header-right, .fc-header-center').hide();

        // calendar prev
        $('#calendar-buttons #btn-prev').click(function() {
            $('.fc-button-prev').click();
            return false;
        });

        // calendar next
        $('#calendar-buttons #btn-next').click(function() {
            $('.fc-button-next').click();
            return false;
        });

        // calendar today
        $('#calendar-buttons #btn-today').click(function() {
            $('.fc-button-today').click();
            return false;
        });

        // calendar month
        $('#mt').click(function() {
            $('#calendar').fullCalendar('changeView', 'month');
        });

        // calendar agenda week
        $('#ag').click(function() {
            $('#calendar').fullCalendar('changeView', 'agendaWeek');
        });

        // calendar agenda day
        $('#td').click(function() {
            $('#calendar').fullCalendar('changeView', 'agendaDay');
        });
        
    });
</script>
