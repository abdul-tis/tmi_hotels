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
                    <b class="collapse-sign"><em class="fa fa-minus-square-o"></em></b>
                </a>
            </li>

        </ul>
        <!-- <ul>
            <li class="<?=(!empty($this->PageTitle) && $this->PageTitle=='User Sellers') ? 'open' : '';?>">
                <a title="Users" href="#">
                    <i class="fa fa-lg fa-fw fa-users"></i>
                    <span class="menu-item-parent">User Management</span>
                    <b class="collapse-sign"><em class="fa fa-minus-square-o"></em></b>
                </a>
                <ul style="<?=(!empty($this->PageTitle) && $this->PageTitle=='User Sellers') ? 'display: block' : 'display: none';?>">
                    <li class="">
                        <a title="Sellers" href="<?=base_url('users')?>">Sellers</a>
                    </li>
                </ul>
            </li>
        </ul> -->
        <?php $url_seg = $this->uri->segment(2); ?>
        <ul>
            <li class="<?php echo (!empty($url_seg) && $url_seg=='hotels') ? 'open' : '';?>">
                <a title="Hotels" href="#">
                    <i class="fa fa-lg fa-fw fa-table"></i>
                    <span class="menu-item-parent">Hotel Management</span>
                    <b class="collapse-sign"><em class="fa fa-minus-square-o"></em></b>
                </a>
                <ul style="<?php echo (!empty($url_seg) && $url_seg=='hotels') ? 'display:block' : '';?>">
                    <li class="">
                        <a title="Hotels" href="<?=base_url('admin/hotels')?>">Hotel Info</a>
                    </li>
                    <!-- <li class="">
                        <a title="Hotels" href="<?=base_url('admin/hotels/hotelRooms')?>">Room Management</a>
                    </li> -->
                </ul>
            </li>
        </ul>
       <!-- <ul>
            <li class="<?=(!empty($this->PageTitle) && $this->PageTitle=='Product Category') ? 'open' : '';?>">
                <a title="Product Categories" href="#">
                    <i class="fa fa-lg fa-fw fa-location-arrow"></i>
                    <span class="menu-item-parent">Product Category</span>
                    <b class="collapse-sign"><em class="fa fa-minus-square-o"></em></b>
                </a>
                <ul style="<?=(!empty($this->PageTitle) && $this->PageTitle=='Product Category') ? 'display: block' : 'display: none';?>">
                    <li class="">
                        <a title="categories" href="<?=base_url('category')?>">
                           Category
                        </a>
                    </li>
                    <li class="">
                        <a title="Products" href="<?=base_url('products')?>">
                           Products
                        </a>
                    </li>
                </ul>
            </li>
        </ul> -->
        
    </nav>
    <span class="minifyme" data-action="minifyMenu"> <i class="fa fa-arrow-circle-left hit"></i> </span>

</aside>
<!-- END NAVIGATION -->
