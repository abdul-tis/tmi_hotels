<aside id="left-panel">

    <div class="login-info">
        <span>
            <a href="<?=base_url()?>" id="show-shortcut" data-action="toggleShortcut">
                <img src="<?php echo base_url(); ?>assets/admin/img/avatars/sunny.png" alt="me" class="online" /> 
                <span>
                     <?php 
                        $user_info =$this->ion_auth->user()->row();
                        echo !empty($user_info->first_name) ? $user_info->first_name : '';
                    ?>
                </span>
                <i class="fa fa-angle-down"></i>
            </a> 
        </span>
    </div>
    <nav>
        <ul>
            <li class="">
                <a title="Dashboard" href="<?php echo base_url('admin/dashboard')?>">
                    <i class="fa fa-lg fa-fw fa-home"></i><span class="menu-item-parent">Dashboard </span>
                    
                </a>
            </li>

        </ul>
        
        <?php $url_seg = $this->uri->segment(2); ?>
        <?php if(checkAccess($this->admin->accessLabelId,'users','view')){ ?>
        <ul>
            <li class="<?php echo (!empty($url_seg) && $url_seg=='users') ? 'open' : '';?>">
                <a title="Users" href="#">
                    <i class="fa fa-lg fa-fw fa-table"></i>
                    <span class="menu-item-parent">User Management</span>
                </a>
                <ul style="<?php echo (!empty($url_seg) && $url_seg=='users') ? 'display:block' : '';?>">
                    <li class="">
                        <a title="Hotels" href="<?=base_url('admin/users')?>">Users</a>
                    </li>
                </ul>
            </li>
        </ul>
        <?php } if(checkAccess($this->admin->accessLabelId,'hotels','view')){?>
        <ul>
            <li class="<?php echo (!empty($url_seg) && $url_seg=='hotels') ? 'open' : '';?>">
                <a title="Hotels" href="#">
                    <i class="fa fa-lg fa-fw fa-table"></i>
                    <span class="menu-item-parent">Hotel Management</span>
                </a>
                <ul style="<?php echo (!empty($url_seg) && $url_seg=='hotels') ? 'display:block' : '';?>">
                    <li class="">
                        <a title="Hotels" href="<?=base_url('admin/hotels')?>">Hotel Info</a>
                    </li>
                </ul>
            </li>
        </ul>
        <?php }?>
        <?php if(checkAccess($this->admin->accessLabelId,'booking','view')){ ?>
        <ul>
            <li class="<?php echo (!empty($url_seg) && $url_seg=='booking') ? 'open' : '';?>">
                <a title="Bookings" href="#">
                    <i class="fa fa-lg fa-fw fa-table"></i>
                    <span class="menu-item-parent">Manage Bookings</span>
                </a>
                <ul style="<?php echo (!empty($url_seg) && $url_seg=='booking') ? 'display:block' : '';?>">
                    <li class="">
                        <a title="Bookings" href="<?=base_url('admin/booking')?>">Booking Info</a>
                    </li>
                </ul>
            </li>
        </ul>
        <?php }?>
        <?php if(checkAccess($this->admin->accessLabelId,'reporting','view')){ ?>
        <ul>
            <li class="<?php echo (!empty($url_seg) && $url_seg=='reporting') ? 'open' : '';?>">
                <a title="Reporting" href="#">
                    <i class="fa fa-lg fa-fw fa-table"></i>
                    <span class="menu-item-parent">Reporting</span>
                </a>
                <ul style="<?php echo (!empty($url_seg) && $url_seg=='reporting') ? 'display:block' : '';?>">
                    <li class="">
                        <a title="Bookings" href="<?=base_url('admin/reporting')?>">Reporting</a>
                    </li>
                </ul>
            </li>
        </ul>
        <?php }?>
        <?php 
            $seg_setting     = $this->uri->segment(2); 
            $seg_setting_new = $this->uri->segment(3); 
        ?>
        <ul>
            <li class="<?php echo (!empty($seg_setting) && $seg_setting=='settings') ? 'open' : '';?>">
                <a title="Product Categories" href="#">
                    <i class="fa fa-lg fa-fw fa-table"></i>
                    <span class="menu-item-parent">Settings</span>
                </a>
                <ul style="<?php echo (!empty($seg_setting) && $seg_setting=='settings') ? 'display: block' : 'display: none';?>">
                    <li class="<?php echo (!empty($seg_setting_new) && $seg_setting_new=='amenities') ? 'active' : '';?>">
                        <a title="amenities" href="<?php echo base_url('admin/settings/amenities')?>">
                           Manage Amenities
                        </a>
                    </li>
                    <li class="<?php echo (!empty($seg_setting_new) && $seg_setting_new=='hotelChains') ? 'active' : '';?>">
                        <a title="hotel chains" href="<?php echo base_url('admin/settings/hotelChains')?>">
                           Manage Hotel Chains
                        </a>
                    </li>
                    <li class="<?php echo (!empty($seg_setting_new) && $seg_setting_new=='hotelCategories') ? 'active' : '';?>">
                        <a title="hotel categories" href="<?php echo base_url('admin/settings/hotelCategories')?>">
                           Manage Hotel Categories
                        </a>
                    </li>
                    <li class="<?php echo (!empty($seg_setting_new) && $seg_setting_new=='hotelTypes') ? 'active' : '';?>">
                        <a title="hotel types" href="<?php echo base_url('admin/settings/hotelTypes')?>">
                           Manage Hotel Types
                        </a>
                    </li>
                    <li class="<?php echo (!empty($seg_setting_new) && $seg_setting_new=='roomTypes') ? 'active' : '';?>">
                        <a title="room types" href="<?php echo base_url('admin/settings/roomTypes')?>">
                           Manage Room Types
                        </a>
                    </li>
                    <li class="<?php echo (!empty($seg_setting_new) && $seg_setting_new=='rateCategories') ? 'active' : '';?>">
                        <a title="Rate Categories" href="<?php echo base_url('admin/settings/rateCategories')?>">
                           Manage Rate Categories
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        
    </nav>
    <span class="minifyme" data-action="minifyMenu"> <i class="fa fa-arrow-circle-left hit"></i> </span>

</aside>
<!-- END NAVIGATION -->
