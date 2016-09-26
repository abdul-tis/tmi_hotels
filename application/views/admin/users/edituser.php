<script src="<?php echo  base_url(); ?>assets/admin/js/plugin/summernote/summernote.min.js"></script>
<link href="<?php echo  base_url(); ?>assets/admin/css/custom-main.css" rel="stylesheet">

<?php  
	$this->load->view('themes/admin/breadcrumb');
?>
	<!-- MAIN CONTENT -->
	<div id="content">
		<div class="m-b-10">
           <div class="pull-left">
               <h3 class="pull-left">
                   <strong>Edit User</strong>
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
                                    <a data-placement="top" rel="tooltip" data-toggle="tab" href="#tab1" data-original-title="" title="User" aria-expanded="false">
                                        Basic Information
                                    </a>
                                </li>
                            </ul>
                            <form class="smart-form" id="editUserForm"  method="post" data-parsley-validate="" enctype="multipart/form-data" action="<?php echo base_url('admin/users/editUser/'.$user->id); ?>">
                                <div class="tab-content padding-10">
                                    <div id="tab1" class="tab-pane active">
                                        <div class="row">
                                            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
                                                    <div class="col-lg-6 col-sm-6">
                                                        <fieldset>
                                                            <section>
                                                                <label class="label">First Name</label>
                                                                <label class="input"> 
                                                                    <input type="text" placeholder="First Name" required="" id="first_name" name="first_name" value="<?php echo $user->first_name?>">
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Last Name</label>
                                                                <label class="input"> 
                                                                    <input type="text" placeholder="Last Name" required="" id="last_name" name="last_name" value="<?php echo $user->last_name?>">
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Email</label>
                                                                <label class="input"> 
                                                                    <input type="text" placeholder="Email" required="" id="email" name="email" value="<?php echo $user->email?>">
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Company</label>
                                                                <label class="input"> 
                                                                    <input type="text" placeholder="Company" required="" id="company" name="company" value="<?php echo $user->company?>">
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Phone</label>
                                                                <label class="input"> 
                                                                    <input type="text" placeholder="Phone" required="" id="phone" name="phone" value="<?php echo $user->phone?>">
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Password</label>
                                                                <label class="input"> 
                                                                    <input type="password" placeholder="Password" id="password" name="password" value="<?php echo set_value('password')?>">
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Confirm Password</label>
                                                                <label class="input"> 
                                                                    <input type="password" placeholder="Confirm Password" id="password_confirm" name="password_confirm" value="<?php echo set_value('password_confirm')?>">
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <?php if ($this->ion_auth->is_admin()): ?>

                                                                  <label class="label">Roles</label>
                                                                  <?php foreach ($groups as $group):?>
                                                                      <label class="checkbox">
                                                                      <?php
                                                                          $gID=$group['id'];
                                                                          $checked = null;
                                                                          $item = null;
                                                                          foreach($currentGroups as $grp) {
                                                                              if ($gID == $grp->id) {
                                                                                  $checked = 'checked';
                                                                              break;
                                                                              }
                                                                              else
                                                                              {
                                                                                $checked = '';
                                                                              }
                                                                          }

                                                                      ?>
                                                                      <input type="checkbox" <?php echo (!empty($checked))?'checked':'';?> name="groups[]" value="<?php echo $group['id'];?>">
                                                                      <i></i> <?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?>
                                                                      </label>
                                                                  <?php endforeach?>
                                                                <?php endif ?>
                                                            </section>
                                                                                    
                                                        </fieldset>
                                                    </div>
                                                    
                                            </article>
                                        </div>
                                    </div>
                                <footer>
                                    <hr class="simple">
                                    <?php echo form_hidden('id', $user->id);?>
                                    <?php echo form_hidden($csrf); ?>
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
        //****** Checking All tab validation ******//
		$(document).ready(function () {
			var instance = $('#editUserForm').parsley();
			$('.frm-submit').click(function(){
				if(instance.isValid() === false){
				/*   display a messge to show users there is some more errors in form  */
					bootstrap_alert.danger('Please check all contents');
				}
			});
    });

</script>


