<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	protected $user_id;
	function __construct() {
        parent::__construct();
        $this->load->model('Common_model');
        $this->load->library('form_validation');
        if (!$this->ion_auth->logged_in()) {
            redirect('admin/auth/login', 'refresh');
        }
        $this->load->library(array('pagination','admin'));
        
        $this->limit = 10;
        $this->user_id = $this->ion_auth->user()->row()->id;
    }

    /**
	 * @Method		-: index()
	 * @Description	-: This function used to display all users
	 * @Created		-: 26-09-2016
	 */
	 public function index(){
	 	$data = array(
			'title' => 'Users',
			'list_heading' => 'Users',
			'breadcrum' => '<li><a href="'.base_url('admin/users').'">Users</a></li>',
		);
	 	if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('admin/auth/login', 'refresh');
        } elseif (!$this->ion_auth->is_admin()) { // remove this elseif if you want to enable this for non-admins
            // redirect them to the home page because they must be an administrator to view this
            return setMessage('You must be an administrator to view this page.','warning');
            redirect('admin/dashboard', 'refresh');
        } else {
            // set the flash data error message if there is one
            setMessage(validation_errors() ? validation_errors() : $this->session->flashdata('message'),'warning');

            //list the users
            $data['users'] = $this->ion_auth->users()->result_array();
            foreach ($data['users'] as $k => $user) {
                $data['users'][$k]['groups'] = $this->ion_auth->get_users_groups($user['id'])->result_array();
            }

            $this->template->load('admin/base', 'admin/users/users', $data);
        }
		
	 }

	/**
	 * @Method		-: addUser()
	 * @Description	-: This function used to add user
	 * @Created		-: 26-09-2016
	 */
	 public function addUser(){
	 	$data = array(
			'title' => 'Users',
			'list_heading' => 'Add User',
			'breadcrum' => '<li><a href="'.base_url('admin/users').'">Users</a></li>',
		);
	 	if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('admin/users', 'refresh');
        }

        $tables = $this->config->item('tables', 'ion_auth');
        $identity_column = $this->config->item('identity', 'ion_auth');
        $data['identity_column'] = $identity_column;

        // validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required');
        $this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required');
        if ($identity_column !== 'email') {
            $this->form_validation->set_rules('identity', $this->lang->line('create_user_validation_identity_label'), 'required|is_unique[' . $tables['users'] . '.' . $identity_column . ']');
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
        } else {
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
        }
        $this->form_validation->set_rules('phone', 'Phone', 'trim');
        $this->form_validation->set_rules('company', 'Company', 'trim');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required');

        if ($this->form_validation->run() == true) {
            $email = strtolower($this->input->post('email'));
            $identity = ($identity_column === 'email') ? $email : $this->input->post('identity');
            $password = $this->input->post('password');

            $additional_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'company' => $this->input->post('company'),
                'phone' => $this->input->post('phone'),
            );

            $group_id = $this->input->post('group');
            $group_ids = array($group_id);

        }
        if ($this->form_validation->run() == true && $this->ion_auth->register($identity, $password, $email, $additional_data,$group_ids)) {
            // check to see if we are creating the user
            // redirect them back to the admin page
            setMessage($this->ion_auth->messages(),'success');
            redirect("admin/users", 'refresh');
        } else {
            // display the create user form
            // set the flash data error message if there is one
            //setMessage(' '.Validation_errors(),'warning');
            setMessage(validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')),'warning');

            $data['groups']  = getRoles();
            $this->template->load('admin/base', 'admin/users/adduser', $data);
        }
	 }

	 // edit a user
    function editUser($id) {
        $data = array(
			'title' => 'Users',
			'list_heading' => 'Edit User',
			'breadcrum' => '<li><a href="'.base_url('admin/users').'">Users</a></li>',
		);

        if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id))) {
            redirect('admin/users', 'refresh');
        }

        $user = $this->ion_auth->user($id)->row();
        $groups = $this->ion_auth->groups()->result_array();
        $currentGroups = $this->ion_auth->get_users_groups($id)->result();

        // validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required');
        $this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'required');
        $this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'required');
        $this->form_validation->set_rules('company', $this->lang->line('edit_user_validation_company_label'), 'required');

        if (isset($_POST) && !empty($_POST)) {
            // do we have a valid request?
            if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id')) {
                setMessage($this->lang->line('error_csrf'),'warning');
            }

            // update the password if it was posted
            if ($this->input->post('password')) {
                $this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
                $this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
            }

            if ($this->form_validation->run() === TRUE) {
                $data = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'company' => $this->input->post('company'),
                    'phone' => $this->input->post('phone'),
                );

                // update the password if it was posted
                if ($this->input->post('password')) {
                    $data['password'] = $this->input->post('password');
                }



                // Only allow updating groups if user is admin
                if ($this->ion_auth->is_admin()) {
                    //Update the groups user belongs to
                    $groupData = $this->input->post('groups');

                    if (isset($groupData) && !empty($groupData)) {

                        $this->ion_auth->remove_from_group('', $id);

                        foreach ($groupData as $grp) {
                            $this->ion_auth->add_to_group($grp, $id);
                        }
                    }
                }

                // check to see if we are updating the user
                if ($this->ion_auth->update($user->id, $data)) {
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    setMessage($this->ion_auth->messages(),'success');
                    if ($this->ion_auth->is_admin()) {
                        redirect('admin/users', 'refresh');
                    } else {
                        redirect('admin/dashboard', 'refresh');
                    }
                } else {
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    setMessage($this->ion_auth->errors(),'warning');
                    if ($this->ion_auth->is_admin()) {
                        redirect('admin/users', 'refresh');
                    } else {
                        redirect('admin/dashboard', 'refresh');
                    }
                }
            }
        }

        // display the edit user form
        $data['csrf'] = $this->_get_csrf_nonce();

        // set the flash data error message if there is one
        setMessage(validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')),'warning');

        // pass the user to the view
        $data['user'] = $user;
        $data['groups'] = getRoles();
        $data['currentGroups'] = $currentGroups;

        $this->template->load('admin/base', 'admin/users/edituser', $data);
    }

    function _get_csrf_nonce() {
        $this->load->helper('string');
        $key = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return array($key => $value);
    }

    function _valid_csrf_nonce(){
		if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
			$this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	/**
  * @method string delete_user()
  * @todo this method is for delete the user
  * @param int $id hold user id
  * @return true|false
  */
	function deleteUser($id = NULL)
	{
		if(!checkAccess($this->admin->accessLabelId,'users','delete'))	
		{
    		setMessage($this->admin->accessDenidMessage,'warning');
    		redirect('admin/users', 'refresh');	
		}
		$id = (int) $id;
		if($id == $this->user_id){ // user can not delete his account
			
			setMessage('You can not delete your account','warning'); 
			redirect('admin/users', 'refresh');
		}
		if($id > 1){
			// do we have the right userlevel?
			$this->ion_auth->delete_user($id);	
			setMessage('Selected user deleted','success'); 
		}
		else{
			setMessage('Top lebel user  can not be deleted','warning'); 
		}
			// redirect them back to the auth page
			redirect('admin/users', 'refresh');
	}

	  // activate the user
    function activate($id, $code = false) {
        if ($code !== false) {
            $activation = $this->ion_auth->activate($id, $code);
        } else if ($this->ion_auth->is_admin()) {
            $activation = $this->ion_auth->activate($id);
        }

        if ($activation) {
            // redirect them to the auth page
            setMessage('User activated','success');
            redirect("admin/users", 'refresh');
        } else {
            // redirect them to the forgot password page
            setMessage($this->ion_auth->errors(),'warning');
            redirect("admin/auth/forgot_password", 'refresh');
        }
    }

    // deactivate the user
    function deactivate($id = NULL) {
    	if(!checkAccess($this->admin->accessLabelId,'users','delete'))	
		{
    		setMessage($this->admin->accessDenidMessage,'warning');
    		redirect('admin/users', 'refresh');	
		}	
		$id = (int) $id;		
		if ($this->ion_auth->logged_in())
			{
				$this->ion_auth->deactivate($id);	
				setMessage('User deactivated','success'); 
			}

        // redirect them back to the auth page
        redirect('admin/users', 'refresh');
    }

    // create a new group
    function addGroup() {
        $data = array(
            'title' => 'Users',
            'list_heading' => 'Edit User',
            'breadcrum' => '<li><a href="'.base_url('admin/users').'">Users</a></li>',
        );

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('admin/users', 'refresh');
        }

        // validate form input
        $this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'), 'required|alpha_dash');

        if ($this->form_validation->run() == TRUE) {
            $new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
            if ($new_group_id) {
                // check to see if we are creating the group
                // redirect them back to the admin page
                setMessage('Group created successfully','success');
                redirect("admin/users", 'refresh');
            }
        } else {
            // display the create group form
            // set the flash data error message if there is one
            setMessage(validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')),'warning');
            $this->template->load('admin/base', 'admin/users/addgroup', $data);
        }
    }

    // edit a group
    function editGroup($id) {
        $data = array(
            'title' => 'Groups',
            'list_heading' => 'Edit Group',
            'breadcrum' => '<li><a href="'.base_url('admin/users').'">Users</a></li>',
        );
        // bail if no group id given
        if (!$id || empty($id)) {
            redirect('admin/users', 'refresh');
        }
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('admin/users', 'refresh');
        }

        $group = $this->ion_auth->group($id)->row();

        // validate form input
        $this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'), 'required|alpha_dash');

        if (isset($_POST) && !empty($_POST)) {
            if ($this->form_validation->run() === TRUE) {
                $group_update = $this->ion_auth->update_group($id, $_POST['group_name'], $_POST['group_description']);

                if ($group_update) {
                    setMessage($this->lang->line('edit_group_saved'),'success');
                } else {
                    setMessage($this->ion_auth->errors(),'warning');
                }
                redirect("admin/users", 'refresh');
            }
        }

        // set the flash data error message if there is one
        setMessage(validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')),'warning');

        // pass the user to the view
        $data['group'] = $group;
        $this->template->load('admin/base', 'admin/users/editgroup', $data);
    }

    /**
    * @method  userGroups()
    * @todo this method is for display  user groups
    * @return will return user group in the form of an array|false
    */
    function userGroups()
    {
        $data = array(
        'title' => 'Access Level',
        'list_heading' => 'Access Level',
        'breadcrum' => '<li><a href="'.base_url('admin/users').'">Users</a></li>',
        );
        $data['groups'] = $this->ion_auth->groups()->result();
        $this->template->load('admin/base', 'admin/users/usergroups', $data);
    }

    /**
  * @method  edit_role() method used for edit user role
  * @param int $id hold role id
  * @todo this method use for edit user role and redirect to user_roles page on success
  */
    function editUserGroup($id)
    {
        // bail if no group id given
        if(!$id || empty($id))
        {
            redirect('admin/users', 'refresh');
        }

        $data = array(
        'title' => 'Access Level',
        'list_heading' => 'Edit Access Level',
        'breadcrum' => '<li><a href="'.base_url('admin/users').'">Users</a></li>',
        );
        if(!checkAccess($this->admin->accessLabelId,'users','edit'))   
        { 
            setMessage($this->admin->accessDenidMessag,'warning');
            redirect('admin/users', 'refresh');   
        }   
        $group = $this->ion_auth->group($id)->row();
        // validate form input
        $this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'), 'required|alpha_dash');
        $group_update=false;
        if (isset($_POST) && !empty($_POST))
        {
            if ($this->form_validation->run() === TRUE)
            {
                $group_update = $this->ion_auth->update_group($id, $_POST['group_name'], $_POST['group_name']);
                $acl_controller_methods=$this->input->post('acl_method');
                if($acl_controller_methods && count($acl_controller_methods)>0)
                {
                    foreach($acl_controller_methods as $controllerIDkey=>$methodsId)
                    {
                        $this->controllerID=$controllerIDkey;
                        if(count($methodsId)>0)
                        {
                        foreach($methodsId as $methodId) {
                            $contactData[] = array(
                                    'access_level_id' => $id,
                                    'acl_sys_controller_id' => $this->controllerID,                             
                                    'acl_sys_method_id' => $methodId                                
                                );                          
                            }
                        }
                    }
                    $this->ion_auth->addRoleAclInfo($contactData,$id);
                }
                else
                {
                    $this->ion_auth->removeRoleAclInfo($id);
                }           
                if($group_update)
                {
                    setMessage('Access level is updated','success');
                }
                else
                {             
                    setMessage($this->ion_auth->errors(),'warning');
                }
                redirect("admin/users/userGroups", 'refresh');
            }
        }
        // pass the user to the view
        
        $readonly = $this->config->item('admin_group', 'ion_auth') === $group->name ? 'readonly' : '';
        $data['group_name'] = array(
            'name'    => 'group_name',
            'id'      => 'group_name',
            'type'    => 'text',
            'value'   => $this->form_validation->set_value('group_name', $group->name),
            $readonly => $readonly,
        );
        $data['group']            = $group;
        $data['acl_controllers']  = $this->ion_auth->acl_controllers();
        $data['ACLResource']      = $this->ion_auth->roleAssignedACLResource($id);
        $this->template->load('admin/base', 'admin/users/editusergroups', $data);
        
    }
}