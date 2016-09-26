<link href="<?php echo base_url(); ?>assets/admin/css/custom-main.css" rel="stylesheet">

<?php $this->load->view('themes/admin/breadcrumb');	?>
	<div id="content">
		<div class="m-b-10">
           <div class="pull-left">
               <h3 class="pull-left">
                   <strong>Users List</strong>
               </h3>
           </div>
           <div class="pull-right">
               <a href="<?php echo base_url('admin/users/addUser');?>" class="btn btn-primary"><i class="fa fa-plus"></i>Add User</a>
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
                                <table class="table table-striped table-bordered table-hover editable-seller-info" width="100%">
                                    <thead>
											<tr>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                                <th>Groups</th>
                                                <th>Status</th>
                                                <th class="sorting">Action</th>
											</tr>
                                    </thead>
                                    <tbody>
										<?php
                                          if (!empty($users)) {
                                             foreach ($users as $user) {
										?>
                                        <tr id="<?php echo $user['id'];?>" >
											<form class="editForm<?php echo $user['id'];?>" enctype="multipart/form-data">
                                            <td>
												<span class="view_mode<?php echo $user['id'];?>"><?php echo (!empty($user['first_name'])) ? $user['first_name'] : "N/A";?></span>
                                            </td>
                                            
											<td>
												<span class="view_mode<?php echo $user['id'];?>"><?php echo (!empty($user['last_name'])) ? $user['last_name'] : "N/A";?></span>
											</td>
                                            
											<td>
												<span class="view_mode<?php echo $user['id'];?>"><?php echo (!empty($user['email'])) ? $user['email'] : "N/A";?></span>
											</td>
                                            
                                            <td>
                                                <?php foreach ($user['groups'] as $group):?>
                                                    <?php echo anchor("admin/users/edit_group/".$group['id'], htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8')) ;?><br />
                                                <?php endforeach?>
                                                </span>
                                            </td>
                                            <td><?php echo ($user['active']) ? anchor("admin/users/deactivate/".$user['id'], 'Active') : anchor("admin/users/activate/". $user['id'], 'Inactive');?></td>
											<td>
												<a class="btn btn-success commonBtn" data-type ="edit" data-row-id="<?php echo 'user_'.$user['id'];?>" data-id="<?php echo $user['id'];?>" href="<?php echo base_url('admin/users/editUser/'.$user['id'])?>">Edit</a>
                                                
												<a class="delete btn btn-sm btn-danger" data-target="#confirm-delete" data-toggle="modal" data-record-title="<?php echo $user['first_name'].' '.$user['last_name'];?>" data-type="delete" data-record-id="<?php echo $user['id'];?>" data-remove-row="<?php echo 'user_'.$user['id'];?>" href="javascript:void(0)" >Delete</a>
											</td>
											</form>
                                        </tr>
                                        <?php } }?>
                                    </tbody>
                                </table>
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
        $('#dt_basic').dataTable({
            "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                    "t" +
                    "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
            "autoWidth": true,
            "columnDefs": [{
            "defaultContent": "-",
            "targets": "_all"
          }]

        });

        $('#confirm-delete').on('click', '.btn-ok', function (e) {
            var $modalDiv = $(e.delegateTarget);
            var id = $(this).data('recordId');
            var rowId = $(this).data('removeRow');
            var msg = 'Selected user successfully removed!';
            window.location.href = "<?php echo base_url('admin/users/deleteUser/')?>"+id;
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
