<link href="<?php echo base_url(); ?>assets/admin/css/custom-main.css" rel="stylesheet">

<?php $this->load->view('themes/admin/breadcrumb');	?>
	<div id="content">
        <?php echo form_open(current_url(),array('class' => 'edit-access-role', 'id' => 'edit-access-role'));?>
		<div class="m-b-10">
           <div class="pull-left">
               <h3 class="pull-left">
                   <strong>Access Level</strong><br/>
                    <strong>Group Name : </strong><?php echo $group->name;?>
               </h3>
               <div><?php echo form_input($group_name);?></div><br/>
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
                                
                                <?php if(!empty($acl_controllers)){?>
                                <table class="table access-specifier" width="100%">
                                    <thead>
											<tr>
                                                <th>Name</th>
                                                <th>View</th>
                                                <th>Add</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                                <th>View Rooms</th>
                                                <th>Add Room</th>
                                                <th>Edit Room</th>
                                                <th>Delete Room</th>
                                                <th>View Calendar</th>
											</tr>
                                    </thead>
                                    <tbody>
										<?php
                                             foreach ($acl_controllers as $controller) {
                                                $checked = null;
                                                if(checkInAssignedACLResource($controller->id,$ACLResource))
                                                        $checked    = ' checked="checked"';
                                                        $cdatalabel =$controller->title;
                                                        if($cdatalabel==""){
                                                            $cdatalabel = str_replace('_',' ',$controller->class_name);
                                                        }
                                                        $cntrolerMethos=array();            
                                                        ?>
                                                        <?php $conrollerACLMethods =acl_controller_methods($controller->id) ?>
                                                        <?php if($conrollerACLMethods) {?>          
                                                        <?php
                                                        $mchecked = null;
                                                        $mcheckedall = null;
                                                        foreach($conrollerACLMethods as $method)
                                                        {               
                                                            if(checkInAssignedACLResource($method->id,$ACLResource,'method'))
                                                                $mchecked= ' checked="checked"';
                                                            else
                                                                $mchecked='';
                                                                $datalabel=$method->title;
                                                                if($datalabel=="")
                                                                {
                                                                    $datalabel=str_replace('_',' ',$method->class_method_name);
                                                                }
                                                                if(strtolower($datalabel)==='view')
                                                                {
                                                                    $cntrolerMethos[$controller->id]['view_method_id']=$method->id;
                                                                    $cntrolerMethos[$controller->id]['view_label']=$datalabel;
                                                                    $cntrolerMethos[$controller->id]['view_chk']=$mchecked;
                                                                
                                                                }
                                                                elseif(strtolower($datalabel)==='add')
                                                                {
                                                                    $cntrolerMethos[$controller->id]['add_method_id']=$method->id;
                                                                    $cntrolerMethos[$controller->id]['add_label']=$datalabel;
                                                                    $cntrolerMethos[$controller->id]['add_chk']=$mchecked;
                                                                }
                                                                elseif(strtolower($datalabel)==='edit')
                                                                {
                                                                    $cntrolerMethos[$controller->id]['edit_method_id']=$method->id;
                                                                    $cntrolerMethos[$controller->id]['edit_label']=$datalabel;
                                                                    $cntrolerMethos[$controller->id]['edit_chk']=$mchecked;
                                                                }
                                                                elseif(strtolower($datalabel)==='delete')
                                                                {
                                                                    $cntrolerMethos[$controller->id]['delete_method_id']=$method->id;
                                                                    $cntrolerMethos[$controller->id]['delete_label']=$datalabel;
                                                                    $cntrolerMethos[$controller->id]['del_chk']=$mchecked;
                                                                }
                                                                elseif(strtolower($datalabel)==='view rooms')
                                                                {
                                                                    $cntrolerMethos[$controller->id]['viewrooms_method_id']=$method->id;
                                                                    $cntrolerMethos[$controller->id]['viewrooms_label']=$datalabel;
                                                                    $cntrolerMethos[$controller->id]['viewrooms_chk']=$mchecked;
                                                                }
                                                                elseif(strtolower($datalabel)==='add room')
                                                                {
                                                                    $cntrolerMethos[$controller->id]['addroom_method_id']=$method->id;
                                                                    $cntrolerMethos[$controller->id]['addroom_label']=$datalabel;
                                                                    $cntrolerMethos[$controller->id]['addroom_chk']=$mchecked;
                                                                }
                                                                elseif(strtolower($datalabel)==='edit rooms')
                                                                {
                                                                    $cntrolerMethos[$controller->id]['editrooms_method_id']=$method->id;
                                                                    $cntrolerMethos[$controller->id]['editrooms_label']=$datalabel;
                                                                    $cntrolerMethos[$controller->id]['editrooms_chk']=$mchecked;
                                                                }
                                                                elseif(strtolower($datalabel)==='delete rooms')
                                                                {
                                                                    $cntrolerMethos[$controller->id]['delrooms_method_id']=$method->id;
                                                                    $cntrolerMethos[$controller->id]['delrooms_label']=$datalabel;
                                                                    $cntrolerMethos[$controller->id]['delrooms_chk']=$mchecked;
                                                                }
                                                                elseif(strtolower($datalabel)==='view calendar')
                                                                {
                                                                    $cntrolerMethos[$controller->id]['viewcal_method_id']=$method->id;
                                                                    $cntrolerMethos[$controller->id]['viewcal_label']=$datalabel;
                                                                    $cntrolerMethos[$controller->id]['viewcal_chk']=$mchecked;
                                                                }
                                                            }
                                                            if($cntrolerMethos[$controller->id]['view_chk']!="" && $cntrolerMethos[$controller->id]['del_chk']!="" && $cntrolerMethos[$controller->id]['edit_chk']!="" && $cntrolerMethos[$controller->id]['add_chk'] !="")
                                                            {
                                                                $mcheckedall= ' checked="checked"';
                                                            }
                                                            else{
                                                                $mcheckedall="";
                                                            }
                                                            
										?>
                                        <tr>
                                            <td>
                                                <span><?php echo form_checkbox('acl_controllerAll['.$controller->id.']',$controller->id,'',$mcheckedall.' class="checkallrow" data-label="'.$cdatalabel.'" ');echo $cdatalabel;?> </span>
                                            </td>
											<td>
												<?php if(isset($cntrolerMethos[$controller->id]['view_method_id'])){
                                                    echo form_checkbox('acl_method['.$controller->id.'][]',$cntrolerMethos[$controller->id]['view_method_id'],'',$cntrolerMethos[$controller->id]['view_chk'].' class="achecked" data-label="'.$cntrolerMethos[$controller->id]['view_label'].'" '); 
                                                }?>
											</td>
											<td>
												<?php if(isset($cntrolerMethos[$controller->id]['add_method_id'])){
                                                    echo form_checkbox('acl_method['.$controller->id.'][]',$cntrolerMethos[$controller->id]['add_method_id'],'',$cntrolerMethos[$controller->id]['add_chk'].' class="achecked"  data-label="'.$cntrolerMethos[$controller->id]['add_label'].'" ');
                                                }?>
											</td>
                                            <td>
                                                <?php if(isset($cntrolerMethos[$controller->id]['edit_method_id'])){
                                                 echo form_checkbox('acl_method['.$controller->id.'][]',$cntrolerMethos[$controller->id]['edit_method_id'],'',$cntrolerMethos[$controller->id]['edit_chk'].' class="achecked" data-label="'.$cntrolerMethos[$controller->id]['edit_label'].'" ');
                                                  }?>
                                            </td>
                                            <td>
                                                <?php if(isset($cntrolerMethos[$controller->id]['delete_method_id'])){
                                                    echo form_checkbox('acl_method['.$controller->id.'][]',$cntrolerMethos[$controller->id]['delete_method_id'],'',$cntrolerMethos[$controller->id]['del_chk'].' class="achecked" data-label="'.$cntrolerMethos[$controller->id]['delete_label'].'" ');
                                                }?>
                                            </td>
                                            <td>
                                                <?php if(isset($cntrolerMethos[$controller->id]['viewrooms_method_id'])){
                                                    echo form_checkbox('acl_method['.$controller->id.'][]',$cntrolerMethos[$controller->id]['viewrooms_method_id'],'',$cntrolerMethos[$controller->id]['viewrooms_chk'].' class="achecked" data-label="'.$cntrolerMethos[$controller->id]['viewrooms_label'].'" ');
                                                }?>
                                            </td>
                                            
                                            <td>
                                                <?php if(isset($cntrolerMethos[$controller->id]['addroom_method_id'])){
                                                    echo form_checkbox('acl_method['.$controller->id.'][]',$cntrolerMethos[$controller->id]['addroom_method_id'],'',$cntrolerMethos[$controller->id]['addroom_chk'].' class="achecked" data-label="'.$cntrolerMethos[$controller->id]['addroom_label'].'" ');
                                                }?>
                                            </td>
                                            <td>
                                                <?php if(isset($cntrolerMethos[$controller->id]['editrooms_method_id'])){
                                                    echo form_checkbox('acl_method['.$controller->id.'][]',$cntrolerMethos[$controller->id]['editrooms_method_id'],'',$cntrolerMethos[$controller->id]['editrooms_chk'].' class="achecked" data-label="'.$cntrolerMethos[$controller->id]['editrooms_label'].'" ');
                                                }?>
                                            </td>
                                            <td>
                                                <?php if(isset($cntrolerMethos[$controller->id]['delrooms_method_id'])){
                                                    echo form_checkbox('acl_method['.$controller->id.'][]',$cntrolerMethos[$controller->id]['delrooms_method_id'],'',$cntrolerMethos[$controller->id]['delrooms_chk'].' class="achecked" data-label="'.$cntrolerMethos[$controller->id]['delrooms_label'].'" ');
                                                }?>
                                            </td>
                                            <td>
                                                <?php if(isset($cntrolerMethos[$controller->id]['viewcal_method_id'])){
                                                    echo form_checkbox('acl_method['.$controller->id.'][]',$cntrolerMethos[$controller->id]['viewcal_method_id'],'',$cntrolerMethos[$controller->id]['viewcal_chk'].' class="achecked" data-label="'.$cntrolerMethos[$controller->id]['viewcal_label'].'" ');
                                                }?>
                                            </td>
                                            
                                        </tr>
                                        <?php }}?>
                                    </tbody>
                                </table>
                                <?php }?>
                                
                            </div>
                            <!-- end widget content -->
                            <input type="submit" value="Save" class="btn btn-primary">
                            <a class="btn btn-primary commonBtn" href="<?php echo base_url(); ?>admin/users/userGroups">Cancel </a>
                            
                        </div>
                        <!-- end widget div -->

                    </div>
                    <!-- end widget -->

                </article>
                <!-- WIDGET END -->
            </div>

        </section>
        </form>
    </div>

<script src="<?php echo base_url(); ?>assets/admin/js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/dateformat.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.checkallrow').click(function() {
            var checkboxes = $(this).closest('tr').find(':checkbox');
            var lvl = $(this).closest('tr').find('label.achecked');
            if($(this).is(':checked')) {
                checkboxes.attr('checked', 'checked');
                lvl.addClass("active");
            } else {
                checkboxes.removeAttr('checked');
                lvl.removeClass("active");
            }
        });
        $('table').on('change', '.achecked', function (e) {
           var checkboxesall = $(this).closest('tr').find(".checkallrow");
            var lvl = $(this).closest('tr').find('label.checkallrow');
            checkboxesall.removeAttr('checked');
            lvl.removeClass("active");
        });
    });
</script>
