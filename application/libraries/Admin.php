<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin {
  	protected $paginateConfig = array();
  	protected $languages = array();
	protected $userId;
	protected $lang_id;
	public $curentControler;
	public $controlerMethod;
	public $accessDenidMessage;
	public $accessLabelId;

    public function __construct()
    {
    	$CI =& get_instance();
		$CI->load->helper('date_helper');
		$CI->load->library('session');

		/*$lastActivity = $CI->session->userdata('last_activity');
		
		$curr_time = now();
		$diff = $curr_time - $lastActivity;
		
		$interval = 10*60;
		if($diff > $interval*60 ){
			$CI->session->sess_destroy();
			 redirect('admin/auth/login', 'refresh');
		}else{
			$CI->session->set_userdata('last_activity',time());
		}*/
		$CI->load->library(array('ion_auth','user_agent'));
        $CI->load->helper(array('url','common_helper'));
		$this->accessDenidMessage = 'You are not allowed to access this page';

      // if not logged in - go to home page
        if (!$CI->ion_auth->logged_in())
        {
            redirect('admin/auth/login', 'refresh');
        } 
	$user_info = $CI->ion_auth->user()->row();
	$user_name = $user_info->first_name.' '.$user_info->last_name;
	
	if ($CI->ion_auth->logged_in()){
		$this->curentControler=$CI->router->fetch_class(); // current class
		$this->controlerMethod=$CI->router->fetch_method(); // curent class method
		$user = $CI->ion_auth->user()->row();	
		$this->accessLabelId = $CI->ion_auth->get_users_groups($user->id)->row()->id;	
		
			if(!$CI->ion_auth->is_admin() && ($this->curentControler!='users' && $this->controlerMethod!='index'))// check user access for class/methods 
			{
				$ac=checkAccess($this->accessLabelId,$this->curentControler,'view');// if user have permession to see
				if(!$ac)
				{
					setMessage('Permession required to access this page','warning');
					if ($CI->agent->is_referral() && $CI->agent->is_referral()!=site_url('admin/auth/login'))	
					{
						redirect($CI->agent->referrer());
					}
					else
					{
					 redirect('admin/dashboard', 'refresh');
					}
				}
			}
		}
    }

}
