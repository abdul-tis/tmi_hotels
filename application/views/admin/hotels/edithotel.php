<script src="<?php echo base_url(); ?>assets/admin/js/plugin/summernote/summernote.min.js"></script>
<link href="<?php echo base_url(); ?>assets/admin/css/custom-main.css" rel="stylesheet">
<script src="http://maps.googleapis.com/maps/api/js?libraries=places" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/locationpicker.jquery.js"></script>
<style type="text/css">
.contact_addmore_list {
    float: left;
    margin-bottom: 10px;
    width: 100%;
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
                   <strong>Edit Hotel</strong>
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
                                    <a data-placement="top" rel="tooltip" data-toggle="tab" href="#tab2" data-original-title="" title="Hotel locations" aria-expanded="false">
                                        Location
                                    </a>
                                </li>
                                <li class="">
                                    <a data-placement="top" rel="tooltip" data-toggle="tab" href="#tab3" data-original-title="" title="Hotel Amenities" aria-expanded="false" disabled="disabled">
                                        Hotel Amenities
                                    </a>
                                </li>
                                <li class="">
                                    <a data-placement="top" rel="tooltip" data-toggle="tab" href="#tab4" data-original-title="" title="Hotel Contact Person" aria-expanded="false" disabled="disabled">
                                        Contact Person
                                    </a>
                                </li>
                                <li class="">
                                    <a data-placement="top" rel="tooltip" data-toggle="tab" href="#tab5" data-original-title="" title="Hotel Images" aria-expanded="false" disabled="disabled">
                                        Hotel Images
                                    </a>
                                </li>
                                <li class="">
                                    <a data-placement="top" rel="tooltip" data-toggle="tab" href="#tab6" data-original-title="" title="Hotel Images" aria-expanded="false" disabled="disabled">
                                        Seo Info
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
                                                            <section>
                                                                <label class="label">Hotel Name </label>
                                                                <label class="input"> 
                                                                    <input type="text" placeholder="Hotelname" id="hotel_name" name="hotel_name" data-parsley-length="[6, 100]" required="" value="<?php echo $hotel['hotel_name'];?>">
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Hotel Chain</label>
                                                                <label class="select">
                                                                    <select class="input-sm" name="hotel_chain" id="hotel_chain">
                                                                        <option value="">Select Hotel Chain</option>
                                                                        <?php 
                                                                            if(!empty($hotel_chains))
                                                                            {
                                                                                foreach($hotel_chains as $hotel_chain)
                                                                                {
                                                                        ?>
                                                                        <option value="<?php echo $hotel_chain['id'];?>" <?php echo (!empty($hotel['hotel_chain']) && $hotel['hotel_chain'] == $hotel_chain['id'])?'selected':'';?>><?php echo $hotel_chain['name'];?></option>
                                                                        <?php
                                                                                }
                                                                            }
                                                                        ?>
                                                                    </select> <i></i> 
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Hotel Type</label>
                                                                <label class="select">
                                                                    <select class="input-sm" name="hotel_type" id="hotel_type" required="">
                                                                        <option value="">Select Hotel Type</option>
                                                                        <?php 
                                                                            if(!empty($hotel_types))
                                                                            {
                                                                                foreach($hotel_types as $hotel_type)
                                                                                {
                                                                        ?>
                                                                        <option value="<?php echo $hotel_type['id'];?>" <?php echo (!empty($hotel['hotel_type']) && $hotel['hotel_type'] == $hotel_type['id'])?'selected':'';?>><?php echo $hotel_type['hotel_type'];?></option>
                                                                        <?php
                                                                                }
                                                                            }
                                                                        ?>
                                                                    </select> <i></i> 
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Star Rating</label>
                                                                <label class="select">
                                                                    <select class="input-sm" name="star_rating" id="star_rating" required="">
                                                                        <!-- <option value="0">No star</option> -->
                                                                        <option value="1" <?php echo (!empty($hotel['star_rating']) && $hotel['star_rating']=='1')?'selected':''?>>∗</option>
                                                                        <option value="2" <?php echo (!empty($hotel['star_rating']) && $hotel['star_rating']=='2')?'selected':''?>>∗∗</option>
                                                                        <option value="3" <?php echo (!empty($hotel['star_rating']) && $hotel['star_rating']=='3')?'selected':''?>>∗∗∗</option>
                                                                        <option value="4" <?php echo (!empty($hotel['star_rating']) && $hotel['star_rating']=='4')?'selected':''?>>∗∗∗∗</option>
                                                                        <option value="5" <?php echo (!empty($hotel['star_rating']) && $hotel['star_rating']=='5')?'selected':''?>>∗∗∗∗∗</option>
                                                                    </select> <i></i> 
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Base Currency</label>
                                                                <label class="select">
                                                                    <select class="input-sm" name="base_currency" id="base_currency">
                                                                        <?php 
                                                                            $currencies     = getAllCurrencies();
                                                                            if(!empty($currencies)){
                                                                                foreach($currencies as $currency){

                                                                        ?>
                                                                        <option value="<?php echo $currency['code'];?>" <?php echo (!empty($hotel['base_currency']) && $hotel['base_currency'] == $currency['code'])?'selected':'';?>><?php echo $currency['name'];?></option>
                                                                        
                                                                        <?php 

                                                                                }
                                                                            }
                                                                        ?>  
                                                                    </select> <i></i> 
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">No Of Rooms</label> 
                                                                <label class="input"> 
                                                                    <input type="text" placeholder="No Of Rooms" required="" id="no_of_rooms" name="no_of_rooms" data-parsley-min="1" data-parsley-type="digits" value="<?php echo (!empty($hotel['no_of_rooms']))?$hotel['no_of_rooms']:'';?>">
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">No Of TMI Rooms</label>
                                                                <label class="input"> 
                                                                    <input type="text" placeholder="No Of TMI Rooms" required="" id="tmi_rooms" name="tmi_rooms" data-parsley-min="1" data-parsley-max="no_of_rooms" data-parsley-type="digits" value="<?php echo (!empty($hotel['tmi_rooms']))?$hotel['tmi_rooms']:'';?>">
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Hotel Phone</label>
                                                                <label class="input"> 
                                                                    <input type="text" placeholder="Hotel Phone" name="hotel_phone" data-parsley-length="[10, 10]" data-parsley-type="digits" required=""  value="<?php echo (!empty($hotel['hotel_phone']))?$hotel['hotel_phone']:'';?>">
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Hotel Mobile</label>
                                                                <label class="input">
                                                                    <input type="text" placeholder="Hotel Mobile" id="hotel_mobile" name="hotel_mobile" data-parsley-length="[10, 10]" data-parsley-type="digits" required="" value="<?php echo (!empty($hotel['hotel_mobile']))?$hotel['hotel_mobile']:'';?>">
                                                                </label>
                                                            </section> 
                                                                       
                                                        </fieldset>
                                                    </div>
                                                    
                                                     <div class="col-lg-6 col-sm-6">
                                                        <fieldset>
                                                            <section>
                                                                <label class="label">Email List</label>
                                                                <label class="textarea">
                                                                    <textarea class="custom-scroll" rows="5" name="email_list" id="email_list" required=""><?php echo (!empty($hotel['email_list']))?$hotel['email_list']:'';?></textarea>
                                                                    <span>seprate two emails with comma","</span>
                                                                </label>
                                                            </section>        
                                                            <section>
                                                                <label class="label">Checkin Time</label>
                                                                <label class="input">
                                                                    <input class="timepicker" type="text" placeholder="Checkin Time" name="checkin_time" id="checkin_time" required="" data-time-format="H:i:s" value="<?php echo (!empty($hotel['checkin_time']))?$hotel['checkin_time']:'';?>"> 
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Checkout Time</label>
                                                                <label class="input">
                                                                    <input class="timepicker" type="text" class="hasTimepicker" placeholder="Checkout Time" name="checkout_time" id="checkout_time" required="" data-time-format="H:i:s" value="<?php echo (!empty($hotel['checkout_time']))?$hotel['checkout_time']:'';?>"> 
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Hotel Owner Commision (%)</label>
                                                                <label class="input"> 
                                                                    <input type="text" placeholder="Commision" required="" id="owner_commision" name="owner_commision" data-parsley-type="number" value="<?php echo (!empty($hotel['owner_commision']))?$hotel['owner_commision']:'';?>">
                                                                </label>
                                                            </section>
                                                            
                                                            <section>
                                                                <label class="label">Status</label>
                                                                <div class="input input-radio">
                                                                    <div class="col col-3">
                                                                        <label class="radio state-success">
                                                                            <input type="radio" <?php echo (!empty($hotel['hotel_status']) && $hotel['hotel_status'] == '1')?'checked':'';?> value="1" name="hotel_status" data-parsley-multiple="status" data-parsley-id="1815">
                                                                            <i></i>Enable
                                                                        </label><ul class="parsley-errors-list" id="parsley-id-multiple-status"></ul>
                                                                        </div>
                                                                        <div class="col col-3">
                                                                        <label class="radio state-error">
                                                                            <input type="radio" <?php echo (!empty($hotel['hotel_status']) && $hotel['hotel_status'] == '0')?'checked':'';?> value="0" name="hotel_status" data-parsley-multiple="status" data-parsley-id="1815">
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
                                                                <label class="label">Geo Location</label>
                                                                <div id="geo_location" style="width: 300px; height: 200px;"></div>
                                                            </section>
                                                             
                                                            <section>
                                                                <label class="label">Country</label>
                                                                <label class="select">
                                                                    <select class="input-sm country" name="loc_country" id="loc_country">
                                                                        <option value="">Select Country</option>
                                                                        <?php 
                                                                            if(!empty($countries))
                                                                            {
                                                                                foreach($countries as $country)
                                                                                {
                                                                        ?>
                                                                        <option value="<?php echo $country['id'];?>" <?php echo (!empty($hotel['loc_country']) && $hotel['loc_country']==$country['id'])?'selected':''?>><?php echo $country['country_name'];?></option>    

                                                                        <?php
                                                                                }
                                                                            }
                                                                        ?>
                                                                    </select> <i></i> 
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">State</label>
                                                                <label class="select">
                                                                    <select class="input-sm" name="loc_state" id="loc_state" required="">
                                                                        <option value="">Select State</option>
                                                                    </select> <i></i> 
                                                                </label>
                                                            </section>
                                                            
                                                            <section>
                                                                <label class="label">City</label>
                                                                <label class="select">
                                                                    <select class="input-sm" name="loc_city" id="loc_city" required="">
                                                                        <option value="">Select City</option>
                                                                    </select> <i></i> 
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Locality</label>
                                                                <label class="input">
                                                                    <input type="text" placeholder="Locality" name="locality" id="locality" value="<?php echo (!empty($hotel['locality']))?$hotel['locality']:'';?>" required=""> 
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Landmarks</label>
                                                                <label class="input">
                                                                    <input type="text" placeholder="Landmarks" name="landmarks" id="landmarks" required="" value="<?php echo (!empty($hotel['landmarks']))?$hotel['landmarks']:'';?>">
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Zipcode</label>
                                                                <label class="input">
                                                                    <input type="text" placeholder="Zipcode" name="zipcode" id="zipcode" value="<?php echo (!empty($hotel['zipcode']))?$hotel['zipcode']:'';?>" required=""> 
                                                                </label>
                                                            </section> 
                                                            <section>
                                                                <label class="label">Address</label>
                                                                <label class="textarea">
                                                                    <textarea class="custom-scroll" rows="5" name="address" id="address" required=""><?php echo (!empty($hotel['address']))?$hotel['address']:'';?></textarea>
                                                                </label>
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
                                                            <label class="label">Hotel Amenities</label>
                                                            <div id="accordion">
                                                                <?php 
                                                                    if(!empty($amenities))
                                                                    {
                                                                        foreach($amenities as $amenity)
                                                                        {
                                                                            $subServices = getSubServices($amenity['id'],1);

                                                                ?>
                                                                <div>
                                                                  <h4><?php echo $amenity['service_name']; ?></h4>
                                                                  <div>
                                                                    <div class="row">
                                                                    <?php if(!empty($subServices)){
                                                                        $i=1;
                                                                            foreach($subServices as $subService){
                                                                                $hotel_amenities = explode(',', $hotel['hotel_amenities'])
                                                                    ?>
                                                                    <div class="col col-3">
                                                                        <label class="input">
                                                                            <div class="row">
                                                                                <label class="checkbox">
                                                                                    <input type="checkbox" name="hotel_amenities[]" value="<?php echo $subService['id']?>" <?php echo (in_array($subService['id'], $hotel_amenities))?'checked':'';?>><i></i><?php echo $subService['service_name'];?>
                                                                                </label>
                                                                            </div>
                                                                        </label>
                                                                    </div>
                                                                    <?php if($i%4==0) echo '</div><div class="row">';$i++;}}?>
                                                                  </div>
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
                                    <div id="tab4" class="tab-pane">
                                        <div class="row">
                                            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
                                                <div class="col-lg-12 col-sm-12">
                                                    <fieldset>
                                                        <section>
                                                            Add Hotel Contact Person Details
                                                            <button class="btn btn-lg btn-success" type="button" id="addMore">
                                                                Add More
                                                            </button>
                                                        </section>
                                                        <div class="contact_form">
                                                            <?php 
                                                                if(!empty($hotalContacts)){
                                                                    foreach($hotalContacts as $contact){

                                                            ?>
                                                            <div class="contact_addmore_list">
                                                            <section>
                                                                <div class="col col-2">
                                                                    <label class="label">Designation</label>
                                                                    <label class="select">
                                                                        <select class="input-sm" name="designation[]" required="">
                                                                            <option value="">Select</option>
                                                                            <?php 
                                                                                $desig_options = '';
                                                                                if(!empty($designations)){
                                                                                    foreach($designations as $designation){
                                                                                        $selected = (!empty($contact['designation']) && $contact['designation'] == $designation['id'])?'selected':'';
                                                                            
                                                                            $desig_options .='<option value="'.$designation['id'].'" '.$selected.'>'.$designation['designation'].'</option>';
                                                                        
                                                                                }
                                                                            }

                                                                            echo $desig_options;
                                                                        ?>
                                                                        </select> <i></i> 
                                                                    </label>
                                                                </div>
                                                                <div class="col col-3">
                                                                    <label class="label">Name</label>
                                                                    <label class="input">
                                                                        <input type="text" placeholder="Name" id="" name="contact_name[]" data-parsley-length="[1, 100]" required="" value="<?php echo (!empty($contact['name']))?$contact['name']:'';?>">
                                                                    </label>
                                                                </div>
                                                                <div class="col col-3">
                                                                    <label class="label">Email</label>
                                                                    <label class="input">
                                                                        <input type="text" placeholder="Email" id="" name="contact_email[]" data-parsley-length="[6, 100]" required="" value="<?php echo (!empty($contact['email']))?$contact['email']:'';?>">
                                                                    </label>
                                                                </div>
                                                                <div class="col col-2">
                                                                    <label class="label">Phone</label>
                                                                    <label class="input">
                                                                        <input type="text" placeholder="Phone" id="" name="contact_phone[]" data-parsley-length="[10, 10]" data-parsley-type="digits" required="" value="<?php echo (!empty($contact['phone']))?$contact['phone']:'';?>">
                                                                    </label>
                                                                </div>
                                                                <div class="col col-2"></div>
                                                            
                                                            </section>
                                                            </div>
                                                            <?php 
                                                                    }
                                                                }else{
                                                            ?>
                                                            <div class="contact_addmore_list">
                                                            <section>
                                                                <div class="col col-2">
                                                                    <label class="label">Designation</label>
                                                                    <label class="select">
                                                                        <select class="input-sm" name="designation[]" required="">
                                                                            <option value="">Select</option>
                                                                            <?php 
                                                                                $desig_options = '';
                                                                                if(!empty($designations)){
                                                                                    foreach($designations as $designation){
                                                                                        
                                                                            
                                                                            $desig_options .='<option value="'.$designation['id'].'">'.$designation['designation'].'</option>';
                                                                        
                                                                                }
                                                                            }

                                                                            echo $desig_options;
                                                                        ?>
                                                                        </select> <i></i> 
                                                                    </label>
                                                                </div>
                                                                <div class="col col-3">
                                                                    <label class="label">Name</label>
                                                                    <label class="input">
                                                                        <input type="text" placeholder="Name" id="" name="contact_name[]" data-parsley-length="[1, 100]" required="" value="">
                                                                    </label>
                                                                </div>
                                                                <div class="col col-3">
                                                                    <label class="label">Email</label>
                                                                    <label class="input">
                                                                        <input type="text" placeholder="Email" id="" name="contact_email[]" data-parsley-length="[6, 100]" required="" value="">
                                                                    </label>
                                                                </div>
                                                                <div class="col col-2">
                                                                    <label class="label">Phone</label>
                                                                    <label class="input">
                                                                        <input type="text" placeholder="Phone" id="" name="contact_phone[]" data-parsley-length="[10, 10]" data-parsley-type="digits" required="" value="">
                                                                    </label>
                                                                </div>
                                                                <div class="col col-2"></div>
                                                            
                                                            </section>
                                                            </div>
                                                            <?php        
                                                                }
                                                            ?>
                                                            
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </article>
                                        </div>
                                    </div>
                                    <div id="tab5" class="tab-pane">
                                        <div class="row">
                                            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
                                                    <div class="col-lg-12 col-sm-12">
                                                        <fieldset>
                                                            <section>
                                                                <div class="input input-file uploadImaagebutton">
                                                                    <input type="button" name="" id="inputfile" value=" Upload Product Images"/>
                                                                        <input type="file" multiple="" name="uploadedimages[]" id="hotelImages" style="display:none;" >
                                                                         
                                                                        <p class="img-info">Image type-JPEG|JPG|PNG</p>
                                                                        <span id="hotelImagesMsg"></span>
                                                                </div>
                                                                
                                                                <div id="image_view">
                                                                    <?php 
                                                                        if(!empty($hotel['images'])){
                                                                            $images = explode(',',$hotel['images']);
                                                                            if(!empty($images)){
                                                                                foreach($images as $image){
                                                                                    echo '<img src="'.base_url().'uploads/hotel/original/'.$image.'" width="100" height="100">';
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
                                    <div id="tab6" class="tab-pane">
                                        <div class="row">
                                            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
                                                <div class="col-lg-12 col-sm-12">
                                                    <fieldset>
                                                        <section>
                                                            <label class="label">Meta Title</label>
                                                            <label class="input">
                                                                <input type="text" placeholder="Meta Title" name="meta_title" id="meta_title" value="<?php echo (!empty($hotel['meta_title']))?$hotel['meta_title']:'';?>"> 
                                                            </label>
                                                        </section>
                                                        <section>
                                                            <label class="label">Meta Description</label>
                                                            <label class="textarea">
                                                                <textarea class="custom-scroll" rows="5" name="meta_description" id="meta_description"><?php echo (!empty($hotel['meta_description']))?$hotel['meta_description']:'';?></textarea>
                                                            </label>
                                                        </section>  
                                                    </fieldset>
                                                </div>
                                            </article>
                                        </div>
                                    </div>
                                <footer>
                                    <hr class="simple">
                                    <input type="hidden" placeholder="Latitude" name="latitude" id="latitude" value="<?php echo (!empty($hotel['latitude']))?$hotel['latitude']:'';?>"> 
                                    <input type="hidden" placeholder="Longitude" name="longitude" id="longitude" value="<?php echo (!empty($hotel['longitude']))?$hotel['longitude']:'';?>"> 
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
    if($('input#locality').length > 0){
     function initialize() {
           var input = document.getElementById('locality');
           var options = {
                componentRestrictions : {
                    country : 'in' // What to pass here, If I want to allow search result from all country?
                },
                types: ['(regions)']
            };
           var autocomplete = new google.maps.places.Autocomplete(input,options);
       }
       google.maps.event.addDomListener(window, 'load', initialize);
    }
    if($('input#landmarks').length > 0){
     function initialize2() {
           var input2 = document.getElementById('landmarks');
           var options2 = {
                componentRestrictions : {
                    country : 'in' // What to pass here, If I want to allow search result from all country?
                },
                types: ['establishment']
            };
           var autocomplete2 = new google.maps.places.Autocomplete(input2,options2);
       }
       google.maps.event.addDomListener(window, 'load', initialize2);
    }
       
        $('#geo_location').locationpicker({
            location: {latitude: <?php echo $hotel["latitude"];?>, longitude: <?php echo $hotel["longitude"];?>},
            radius: 100,
            onchanged: function(currentLocation, radius, isMarkerDropped) {
                $('#latitude').val(currentLocation.latitude);
                $('#longitude').val(currentLocation.longitude);
                
            }
        });

        $('a[href="#tab2"]').on('click', function() { 
            setTimeout(function(){$('#geo_location').locationpicker('autosize'); },500);               // centers map correctly
        });
		

         $(function () {
            $("#hotelImages").change(function () {
                var FileUploadPath = jQuery('#hotelImages')[0].files;
                if (typeof (FileReader) != "undefined") {
                var dvPreview = $("#image_view").show();
                $("#hotelImagesMsg").html('');
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
                    $("#hotelImagesMsg").html("Please select images less then 10 MB.");
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
                       $("#hotelImagesMsg").html(file[0].name + " is not a valid image file.Please select only JPG,PNG,JPEG,GIF,BMP type files.");
                       $(this).val('');
                        $("#image_view").html("").hide();
                        return false;
                    }
                    
                });
            } else {
                $("#hotelImagesMsg").html("This browser does not support HTML5 FileReader.");
            }
        });
        });
			//****** Checking All tab validation ******//
            $(document).ready(function () {
        
			var instance = $('#editHotelForm').parsley();
			$('.frm-submit').click(function(){
				if(instance.isValid() === false){
				/*   display a messge to show users there is some more errors in form  */
					bootstrap_alert.danger('Please check all tab');
				}
			});

            $("#inputfile").click(function(){
                $("#hotelImages").click();
            });
            
            $('#image_view').on('click','.makePrimary',function(){
                /*ar primary = this.id;
                $('#image_view :checkbox').find('label').removeClass('check-right');
                //$('#image_view').find('#'+primary).attr('checked',true);
                $('#a'+primary).attr('class','check-right');*/
                $(".makePrimary").prop('checked', false);
                $(this).prop('checked', true);
            });

            /*$('#next_btn').click(function(){
                $('.nav-tabs > .active').next('li').find('a').trigger('click');

                $(this).css('display','none');
                $('#submit_btn').css('display','block');
            });*/

            var type    = null;
            function getSatesByCountry(country_id,type)
            {
                $.ajax({
                    url:'<?php echo base_url('admin/hotels/getStatesByCountry')?>',
                    type:'post',
                    data : {'country_id':country_id},
                    success:function(data){
                        if(type == 'basic')
                        {
                            $('#state').html(data);
                            $('#state').val('<?php echo $hotel["state"]?>');
                        }
                        else
                        {
                            $('#loc_state').html(data);
                            $('#loc_state').val('<?php echo $hotel["loc_state"]?>');
                        }
                    }
                });
            }

            function getCitiesByState(state_id,type)
            {
                $.ajax({
                    url:'<?php echo base_url('admin/hotels/getCitiesByState')?>',
                    type:'post',
                    data : {'state_id':state_id},
                    success:function(data){
                        if(type == 'basic')
                        {
                            $('#city').html(data);
                            $('#city').val('<?php echo $hotel["city"]?>');
                        }
                        else
                        {
                            $('#loc_city').html(data);
                            $('#loc_city').val('<?php echo $hotel["loc_city"]?>');
                        }
                        
                    }
                });
            }

            $('#country').on('change',function(){
                type           = 'basic';
                var country_id = $(this).val();
                getSatesByCountry(country_id,type);
                
            });

            $(document).on('change','#state',function(){
                type           = 'basic';
                var state_id    = $(this).val();
                getCitiesByState(state_id,type);
            });

            $('#loc_country').on('change',function(){
                type           = 'location';
                var country_id = $(this).val();
                getSatesByCountry(country_id,type);
                
            });

            $(document).on('change','#loc_state',function(){
                type           = 'location';
                var state_id    = $(this).val();
                getCitiesByState(state_id,type);
            });

            $('#country').trigger('change');
            $('#loc_country').trigger('change');
            setTimeout(function(){ $('#state').trigger('change');},500);
            setTimeout(function(){ $('#loc_state').trigger('change');},500);

            $('.timepicker').timepicker();

            $('#addMore').click(function(){

            var contact_detail = '<div class="contact_addmore_list"><section>';
                contact_detail +=   '<div class="col col-2">';
                contact_detail +=       '<label class="label"></label>';
                contact_detail +=       '<label class="select">';
                contact_detail +=           '<select class="input-sm" name="designation[]">';
                contact_detail +=           '<option value="">Select</option>';
                contact_detail +=           '<?php echo $desig_options;?>';
                contact_detail +=           '</select> <i></i>'; 
                contact_detail +=        '</label>';
                contact_detail +=    '</div>';
                contact_detail +=    '<div class="col col-3">';
                contact_detail +=       '<label class="label"></label>';
                contact_detail +=       '<label class="input">';
                contact_detail +=           '<input type="text" placeholder="Name" id="" name="contact_name[]" value="">';
                contact_detail +=       '</label>';
                contact_detail +=    '</div>';
                contact_detail +=   '<div class="col col-3">';
                contact_detail +=   '<label class="label"></label>';
                contact_detail +=   '<label class="input">';
                contact_detail +=   '<input type="text" placeholder="Email" id="" name="contact_email[]" value="">';
                contact_detail +=   '</label>';
                contact_detail +=   '</div>';
                contact_detail +=   '<div class="col col-2">';
                contact_detail +=       '<label class="label"></label>'
                contact_detail +=       '<label class="input">';
                contact_detail +=           '<input type="text" placeholder="Phone" id="" name="contact_phone[]" value="">';
                contact_detail +=       '</label>';
                contact_detail +=   '</div>';
                contact_detail +=   '<div class="col col-2">';
                contact_detail +=       '<label class="label"></label>';
                contact_detail +=       '<label class="">';
                contact_detail +=           '<button class="btn btn-sm btn-success close_btn" type="button">Close</button>';
                contact_detail +=       '</label>';
                contact_detail +=   '</div>';           
                contact_detail += '</section></div>';

                $('.contact_form').append(contact_detail);
            });
            $(document).on('click' , '.close_btn' , function(){
                $(this).closest('.contact_addmore_list').remove();
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
			
		});

    

</script>

