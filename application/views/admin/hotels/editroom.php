<script src="<?php echo base_url(); ?>assets/admin/js/plugin/summernote/summernote.min.js"></script>
<link href="<?php echo base_url(); ?>assets/admin/css/custom-main.css" rel="stylesheet">
<style type="text/css">

#image_view2 img {
    border: 1px solid #ccc;
    margin: 0 18px 19px;
    padding: 5px;
}
#image_view3 img {
    border: 1px solid #ccc;
    margin: 0 18px 19px;
    padding: 5px;
}
</style>
<?php
	$this->load->view('themes/admin/breadcrumb');
?>
	<!-- MAIN CONTENT -->
	<div id="content">
		<div class="m-b-10">
           <div class="pull-left">
               <h3 class="pull-left">
                   <strong>Edit Hotel Room</strong>
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
                                    <a data-placement="top" rel="tooltip" data-toggle="tab" href="#tab1" data-original-title="" title="Basic Information of hotel" aria-expanded="false">
                                        Basic Information
                                    </a>
                                </li>
                                <li class="">
                                    <a data-placement="top" rel="tooltip" data-toggle="tab" href="#tab2" data-original-title="" title="Room Amenities" aria-expanded="false" disabled="disabled">
                                        Room Amenities
                                    </a>
                                </li>
                                <li class="">
                                    <a data-placement="top" rel="tooltip" data-toggle="tab" href="#tab3" data-original-title="" title="Room Amenities" aria-expanded="false" disabled="disabled">
                                        Images
                                    </a>
                                </li>
                            </ul>
                            <form class="smart-form" id="editHotelForm"  method="post" data-parsley-validate="" enctype="multipart/form-data" action="<?php echo current_url() ?>">
                                <div class="tab-content padding-10">
                                    <div id="tab1" class="tab-pane active">
                                        <div class="row">
                                            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
                                                <div class="col-lg-6 col-sm-6">
                                                    <fieldset>
                                                        <!-- <section>
                                                            <label class="label">Hotel</label>
                                                            <label class="select">
                                                                <select class="input-sm" name="hotel_id" id="hotel_id" required="">
                                                                    <option value="">Select Hotel</option>
                                                                    <?php 
                                                                        if(!empty($hotels))
                                                                        {
                                                                            foreach($hotels as $hotel)
                                                                            {
                                                                    ?>
                                                                    <option value="<?php echo $hotel['hotel_id'];?>" <?php echo (!empty($room['hotel_id']) && $room['hotel_id']==$hotel['hotel_id'])?'selected':'';?>><?php echo $hotel['hotel_name'];?></option>
                                                                    <?php
                                                                            }
                                                                        }
                                                                    ?>
                                                                </select> <i></i> 
                                                            </label>
                                                        </section> -->
                                                        <section>
                                                            <label class="label">Room Type</label>
                                                            <label class="select">
                                                                <select class="input-sm" name="room_type" id="room_type" required="">
                                                                    <option value="">Select Room Type</option>
                                                                    <?php 
                                                                        if(!empty($room_types))
                                                                        {
                                                                            foreach($room_types as $room_type)
                                                                            {
                                                                    ?>
                                                                    <option value="<?php echo $room_type['id'];?>" <?php echo (!empty($room['room_type']) && $room['room_type'] == $room_type['id'])?'selected':'';?>><?php echo $room_type['room_type'];?></option>
                                                                    <?php
                                                                            }
                                                                        }
                                                                    ?>
                                                                </select> <i></i> 
                                                            </label>
                                                        </section>
                                                        <section>
                                                            <label class="label">Max Adults</label>
                                                            <label class="input"> 
                                                                <input type="text" placeholder="Adults" required="" id="adults" name="adults" data-parsley-min="1" data-parsley-type="digits" value="<?php echo (!empty($room['adults']))?$room['adults']:'';?>">
                                                            </label>
                                                        </section>
                                                        <section>
                                                            <label class="label">Max Children</label>
                                                            <label class="input"> 
                                                                <input type="text" placeholder="Children" required="" id="children" name="children" data-parsley-min="0" data-parsley-type="digits" value="<?php echo (!empty($room['children']))?$room['children']:'';?>">
                                                            </label>
                                                        </section>
                                                        <section>
                                                            <label class="label">Maximum Extra Beds</label>
                                                            <label class="input"> 
                                                                <input type="text" placeholder="Extra Beds" required="" id="extra_beds" name="extra_beds" data-parsley-min="1" data-parsley-type="digits" value="<?php echo (!empty($room['extra_beds']))?$room['extra_beds']:'';?>">
                                                            </label>
                                                        </section>
                                                        <section>
                                                            <label class="label">Number of Rooms</label>
                                                            <label class="input"> 
                                                                <input type="text" placeholder="Number of Rooms" required="" id="no_of_rooms" name="no_of_rooms" data-parsley-min="1" data-parsley-type="digits" value="<?php echo (!empty($room['no_of_rooms']))?$room['no_of_rooms']:'0';?>">
                                                            </label>
                                                        </section>
                                                        <section>
                                                            <label class="label">Number of TMI Rooms</label>
                                                            <label class="input"> 
                                                                <input type="text" placeholder="Number of TMI Rooms" required="" id="tmi_rooms" name="tmi_rooms" data-parsley-min="1" data-parsley-type="digits" value="<?php echo (!empty($room['tmi_rooms']))?$room['tmi_rooms']:'0';?>">
                                                            </label>
                                                        </section>
                                                        <section>
                                                            <label class="label">Beds</label>
                                                            <label class="select">
                                                                <select class="input-sm country" name="beds" id="beds">
                                                                <?php 
                                                                    for($i=0;$i<=10;$i++)
                                                                    {
                                                                ?>
                                                                        <option value="<?php echo $i;?>" <?php echo (!empty($room['beds']) && $room['beds']==$i)?'selected':'';?>><?php echo $i;?></option>
                                                                <?php }?>
                                                                </select> <i></i> 
                                                            </label>
                                                        </section>
                                                        <section>
                                                            <label class="label">Price (Rs.)</label>
                                                            <label class="input"> 
                                                                <input type="text" placeholder="Price" required="" id="price" name="price" data-parsley-type="number" value="<?php echo (!empty($room['price']))?$room['price']:'';?>">
                                                            </label>
                                                        </section>
                                                        <div class="row">
                                                        <section>
                                                            <label class="label">Period</label>
                                                            <div class="input">
                                                                <div class="col col-6">
                                                                    <div class="form-group">
                                                                        <div class="input-group">
                                                                            <input class="form-control" id="from" name="period_from" required="" type="text" placeholder="From" value="<?php echo (!empty($room['period_from']))?date('m/d/Y',strtotime($room['period_from'])):'';?>">
                                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col col-6">
                                                                    <div class="form-group">
                                                                        <div class="input-group">
                                                                            <input class="form-control" id="to" name="period_to" required="" type="text" placeholder="To" value="<?php echo (!empty($room['period_to']))?date('m/d/Y',strtotime($room['period_to'])):'';?>">
                                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </section>
                                                        </div>
                                                        <section>
                                                            <label class="label"></label>
                                                            <div class="input input-radio">
                                                                <?php 
                                                                    if(!empty($rate_categories))
                                                                    {
                                                                        $k = 1;
                                                                        foreach($rate_categories as $rate_category)
                                                                        {

                                                                ?>
                                                                    <label class="radio state-success">
                                                                        <input type="radio" <?php echo (!empty($room['rate_category']) && $room['rate_category'] == $rate_category['id'])?'checked':'';?> value="<?php echo $rate_category['id'];?>" name="rate_category" data-parsley-multiple="status" data-parsley-id="1815">
                                                                        <i></i><?php echo $rate_category['category_type'];?> (<?php echo $rate_category['meal_plan'];?>)
                                                                    </label><?php if($k=='1'){?><ul class="parsley-errors-list" id="parsley-id-multiple-status"></ul><?php }?>
                                                                
                                                                <?php 
                                                                        $k++;
                                                                        }
                                                                    }
                                                                ?>
                                                            
                                                        </section> 
                                                        <section>
                                                            <label class="label">Extra Bed Charge (Rs.)</label>
                                                            <label class="input"> 
                                                                <input type="text" placeholder="Extra Bed Charge" required="" id="extra_bed_charge" name="extra_bed_charge" data-parsley-type="number" value="<?php echo (!empty($room['extra_bed_charge']))?$room['extra_bed_charge']:'';?>">
                                                            </label>
                                                        </section>
                                                        <section>
                                                            <label class="label">Cancellation Rules</label>
                                                            <div class="input input-radio">
                                                            <?php 
                                                                if(!empty($cancellation_rules)){
                                                                    $i=1;
                                                                    foreach($cancellation_rules as $rule){
                                                            ?>
                                                                <label class="radio state-success">
                                                                    <input type="radio" <?php echo (!empty($room['cancellation_rule']) && $room['cancellation_rule'] == $rule['id'])?'checked':'';?> value="<?php echo $rule['id']?>" name="cancellation_rule" data-parsley-multiple="cancellation_rule" data-parsley-id="1815">
                                                                    <i></i><?php echo $rule['cancellation_rule']?>
                                                                </label><?php if($i==1){?><ul class="parsley-errors-list" id="parsley-id-multiple-status"></ul><?php }?>
                                                            <?php 
                                                                    $i++;
                                                                    }
                                                                }
                                                            ?>    
                                                            </div>
                                                        </section>
                                                        <section>
                                                            <label class="label">Status</label>
                                                            <div class="input input-radio">
                                                                <div class="col col-3">
                                                                    <label class="radio state-success">
                                                                        <input type="radio" <?php echo (!empty($room['status']) && $room['status'] == '1')?'checked':'';?> value="1" name="status" data-parsley-multiple="status" data-parsley-id="1815">
                                                                        <i></i>Enable
                                                                    </label><ul class="parsley-errors-list" id="parsley-id-multiple-status"></ul>
                                                                    </div>
                                                                    <div class="col col-3">
                                                                    <label class="radio state-error">
                                                                        <input type="radio" <?php echo (!empty($room['status']) && $room['status'] == '0')?'checked':'';?> value="0" name="status" data-parsley-multiple="status" data-parsley-id="1815">
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
                                    
                                    <div id="tab2" class="tab-pane">
                                        <div class="row">
                                            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
                                                    <div class="col-lg-12 col-sm-12">
                                                        <fieldset>
                                                            <section>
                                                            <label class="label">Room Amenities</label>
                                                            <div id="accordion">
                                                                <?php 
                                                                    if(!empty($amenities))
                                                                    {
                                                                        foreach($amenities as $amenity)
                                                                        {
                                                                            $subServices = getSubServices($amenity['id'],2);

                                                                ?>
                                                                <div>
                                                                  <h4><?php echo $amenity['service_name']; ?></h4>
                                                                  <div>
                                                                    <div class="row">
                                                                    <?php if(!empty($subServices)){
                                                                            $i=1;
                                                                            foreach($subServices as $subService){
                                                                                $room_amenities = explode(',', $room['room_amenities'])
                                                                    ?>
                                                                    <div class="col col-3">
                                                                        <label class="input">
                                                                            <div class="row">
                                                                                <label class="checkbox">
                                                                                    <input type="checkbox" name="room_amenities[]" value="<?php echo $subService['id']?>" <?php echo (in_array($subService['id'], $room_amenities))?'checked':'';?>><i></i><?php echo $subService['service_name'];?>
                                                                                </label>
                                                                            </div>
                                                                        </label>
                                                                    </div>
                                                                    <?php if($i%4==0) echo '</div><div class="row">';$i++;}}?>
                                                                  </div>
                                                                  
                                                                </div>
                                                                <?php 
                                                                        }
                                                                    }
                                                                ?>  
                                                            </div>
                                                        </section> 
                                                            
                                                        </fieldset>
                                                    </div>
                                            </article>
                                        </div>
                                    </div>
                                    <div id="tab3" class="tab-pane">
                                        <div class="row">
                                            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
                                                    <div class="col-lg-12 col-sm-12">
                                                        <fieldset>
                                                            <section>
                                                                <label class="label">Lobby Images</label>
                                                                <div class="input input-file uploadImaagebutton">
                                                                    <input type="button" name="" id="inputfile" value=" Upload Lobby Images"/>
                                                                    <input type="file" multiple="" name="uploadedlobbyimages[]" id="lobbyImages" style="display:none;" >
                                                                     
                                                                    <p class="img-info">Image type-JPEG|JPG|PNG</p>
                                                                    <span id="lobbyImagesMsg"></span>
                                                                </div>
                                                                <div id="image_view">
                                                                    <?php 
                                                                        if(!empty($room['lobby_images'])){
                                                                            $images = explode(',',$room['lobby_images']);
                                                                            if(!empty($images)){
                                                                                foreach($images as $image){
                                                                                    echo '<img src="'.base_url().'uploads/room/lobby/'.$image.'" width="50" height="50">';
                                                                                }
                                                                            }
                                                                        }
                                                                        
                                                                    ?>
                                                                </div>
                                                            </section>

                                                            <section>
                                                                <label class="label">Lounge Images</label>
                                                                <div class="input input-file uploadImaagebutton">
                                                                    <input type="button" name="" id="inputfile2" value=" Upload Lounge Images"/>
                                                                    <input type="file" multiple="" name="uploadedloungeimages[]" id="loungeImages" style="display:none;" >
                                                                     
                                                                    <p class="img-info">Image type-JPEG|JPG|PNG</p>
                                                                    <span id="loungeImagesMsg"></span>
                                                                </div>
                                                                <div id="image_view2" style="border: 1px solid #ccc;padding: 20px 5px 0;">
                                                                    <?php 
                                                                        if(!empty($room['lounge_images'])){
                                                                            $images2 = explode(',',$room['lounge_images']);
                                                                            if(!empty($images2)){
                                                                                foreach($images2 as $image2){
                                                                                    echo '<img src="'.base_url().'uploads/room/lounge/'.$image2.'" width="50" height="50">';
                                                                                }
                                                                            }
                                                                        }
                                                                        
                                                                    ?>
                                                                </div>
                                                            </section>
                                                            <section>
                                                                <label class="label">Reception Images</label>
                                                                <div class="input input-file uploadImaagebutton">
                                                                    <input type="button" name="" id="inputfile3" value=" Upload Reception Images"/>
                                                                    <input type="file" multiple="" name="uploadedreceptionimages[]" id="receptionImages" style="display:none;" >
                                                                     
                                                                    <p class="img-info">Image type-JPEG|JPG|PNG</p>
                                                                    <span id="receptionImagesMsg"></span>
                                                                </div>
                                                                <div id="image_view3" style="border: 1px solid #ccc;padding: 20px 5px 0;">
                                                                    <?php 
                                                                        if(!empty($room['reception_images'])){
                                                                            $images3 = explode(',',$room['reception_images']);
                                                                            if(!empty($images3)){
                                                                                foreach($images3 as $image3){
                                                                                    echo '<img src="'.base_url().'uploads/room/reception/'.$image3.'" width="50" height="50">';
                                                                                }
                                                                            }
                                                                        }
                                                                        
                                                                    ?>
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
    $(function () {
            $("#lobbyImages").change(function () {
                var FileUploadPath = jQuery('#lobbyImages')[0].files;
                if (typeof (FileReader) != "undefined") {
                    var dvPreview = $("#image_view").show();
                    $("#lobbyImagesMsg").html('');
                    dvPreview.html("");
                                       var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
                    var k=0;
                    var fname='';
                    $($(this)[0].files).each(function () {
                        fname=fname+FileUploadPath[0].name+',';
                    var str=str+FileUploadPath[0].size;
                     str=str/(4*1024*1024);
                     if(str>=10)
                     {
                        $("#lobbyImagesMsg").html("Please select lobby images less then 10 MB.");
                            dvPreview.html("");
                            return false; 
                        }
                        var file = $(this);
                        if (regex.test(file[0].name.toLowerCase())) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                var check = "";
                                if(k==0){
                                    check = 'checked="checked"';
                                }
                                var img = $("<img style='height:100px;width: 100px'/><p><input type='checkbox'  class='makePrimary' id='primary"+k+"' "+check+" name='primary' value='"+k+"'/><label for='primary"+k+"' id='aprimary"+k+"' title='Checked for make primary image' ></label></p>");
                                img.attr("src", e.target.result);
                                dvPreview.append(img);
                                k++;
                            }
                            reader.readAsDataURL(file[0]);
                        } else {
                           $("#lobbyImagesMsg").html(file[0].name + " is not a valid image file.Please select only JPG,PNG,JPEG,GIF,BMP type files.");
                           $(this).val('');
                            $("#image_view").html("").hide();
                            return false;
                        }
                        
                    });
                } else {
                    $("#lobbyImagesMsg").html("This browser does not support HTML5 FileReader.");
                }
            });
        });
        // lounge images
        $(function () {
            $("#loungeImages").change(function () {
                var FileUploadPath = jQuery('#loungeImages')[0].files;
                if (typeof (FileReader) != "undefined") {
                    var dvPreview = $("#image_view2").show();
                    $("#loungeImagesMsg").html('');
                    dvPreview.html("");
                                       var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
                    var k=0;
                    var fname='';
                    $($(this)[0].files).each(function () {
                        fname=fname+FileUploadPath[0].name+',';
                    var str=str+FileUploadPath[0].size;
                     str=str/(4*1024*1024);
                     if(str>=10)
                     {
                        $("#loungeImagesMsg").html("Please select lounge images less then 10 MB.");
                            dvPreview.html("");
                            return false; 
                        }
                        var file = $(this);
                        if (regex.test(file[0].name.toLowerCase())) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                var check = "";
                                if(k==0){
                                    check = 'checked="checked"';
                                }
                                var img = $("<img style='height:100px;width: 100px'/><p><input type='checkbox'  class='makePrimary2' id='primary_lounge"+k+"' "+check+" name='primary2' value='"+k+"'/><label for='primary_lounge"+k+"' id='aprimary_lounge"+k+"' title='Checked for make primary image' ></label></p>");
                                img.attr("src", e.target.result);
                                dvPreview.append(img);
                                k++;
                            }
                            reader.readAsDataURL(file[0]);
                        } else {
                           $("#loungeImagesMsg").html(file[0].name + " is not a valid image file.Please select only JPG,PNG,JPEG,GIF,BMP type files.");
                           $(this).val('');
                            $("#image_view2").html("").hide();
                            return false;
                        }
                        
                    });
                } else {
                    $("#loungeImagesMsg").html("This browser does not support HTML5 FileReader.");
                }
            });
        });

        // reception images
        $(function () {
            $("#receptionImages").change(function () {
                var FileUploadPath = jQuery('#receptionImages')[0].files;
                if (typeof (FileReader) != "undefined") {
                    var dvPreview = $("#image_view3").show();
                    $("#receptionImagesMsg").html('');
                    dvPreview.html("");
                                       var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
                    var k=0;
                    var fname='';
                    $($(this)[0].files).each(function () {
                        fname=fname+FileUploadPath[0].name+',';
                    var str=str+FileUploadPath[0].size;
                     str=str/(4*1024*1024);
                     if(str>=10)
                     {
                        $("#receptionImagesMsg").html("Please select reception images less then 10 MB.");
                            dvPreview.html("");
                            return false; 
                        }
                        var file = $(this);
                        if (regex.test(file[0].name.toLowerCase())) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                var check = "";
                                if(k==0){
                                    check = 'checked="checked"';
                                }
                                var img = $("<img style='height:100px;width: 100px'/><p><input type='checkbox'  class='makePrimary3' id='primary_reception"+k+"' "+check+" name='primary3' value='"+k+"'/><label for='primary_reception"+k+"' id='aprimary_reception"+k+"' title='Checked for make primary image' ></label></p>");
                                img.attr("src", e.target.result);
                                dvPreview.append(img);
                                k++;
                            }
                            reader.readAsDataURL(file[0]);
                        } else {
                           $("#receptionImagesMsg").html(file[0].name + " is not a valid image file.Please select only JPG,PNG,JPEG,GIF,BMP type files.");
                           $(this).val('');
                            $("#image_view3").html("").hide();
                            return false;
                        }
                        
                    });
                } else {
                    $("#receptionImagesMsg").html("This browser does not support HTML5 FileReader.");
                }
            });
        });
	$(document).ready(function () {
		//****** Checking All tab validation ******//
		var instance = $('#editHotelForm').parsley();
		$('.frm-submit').click(function(){
			if(instance.isValid() === false){
			/*   display a messge to show users there is some more errors in form  */
				bootstrap_alert.danger('Please check all tab');
			}
		});

        $("#inputfile").click(function(){
            $("#lobbyImages").click();
        });
        
        $("#inputfile2").click(function(){
            $("#loungeImages").click();
        });

        $("#inputfile3").click(function(){
            $("#receptionImages").click();
        });

        $('#image_view').on('click','.makePrimary',function(){
            $(".makePrimary").prop('checked', false);
            $(this).prop('checked', true);
        });

        $('#image_view2').on('click','.makePrimary2',function(){
            $(".makePrimary2").prop('checked', false);
            $(this).prop('checked', true);
        });
        $('#image_view3').on('click','.makePrimary3',function(){
            $(".makePrimary3").prop('checked', false);
            $(this).prop('checked', true);
        });
        
        /*
        * ACCORDION
        */
        //jquery accordion
        
         var accordionIcons = {
             header: "fa fa-plus",    // custom icon class
             activeHeader: "fa fa-minus" // custom icon class
         };
         
        $("#accordion").accordion({
            autoHeight : false,
            heightStyle : "content",
            collapsible : true,
            animate : 300,
            icons: accordionIcons,
            header : "h4",
        })

        // Date Range Picker
        $("#from").datepicker({
            //defaultDate: "+1w",
            minDate: 'now',
            changeMonth: true,
            numberOfMonths: 1,
            prevText: '<i class="fa fa-chevron-left"></i>',
            nextText: '<i class="fa fa-chevron-right"></i>',
            onClose: function (selectedDate) {
                $("#to").datepicker("option", "minDate", selectedDate);
            }

        });
        $("#to").datepicker({
            //defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            prevText: '<i class="fa fa-chevron-left"></i>',
            nextText: '<i class="fa fa-chevron-right"></i>',
            onClose: function (selectedDate) {
                $("#from").datepicker("option", "maxDate", selectedDate);
            }
        });
	});

</script>

