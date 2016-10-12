<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporting extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('Common_model');
        $this->load->model('Report_model');
        $this->load->library('form_validation');
        if (!$this->ion_auth->logged_in()) {
            redirect('admin/auth/login', 'refresh');
        }
        $this->load->library(array('pagination','admin'));
        $this->limit = 10;
        if(!checkAccess($this->admin->accessLabelId,'reporting','view'))	
		{
    		setMessage($this->admin->accessDenidMessage,'warning');
    		redirect('admin/dashboard', 'refresh');	
		}	
    }

     /**
     * @Method      -: index()
     * @Description -: This function used to display reportings
     * @Created     -: 05-10-2016
     */
     public function index(){

        $data = array(
            'title' => 'Reporting',
            'list_heading' => 'Reporting',
            'breadcrum' => '<li><a href="'.base_url('admin/reporting').'">Reporting</a></li>',
        );
        $report_category        = $this->Report_model->reportByCategory();
        //echo $this->db->last_query();
        $data['categories']     = $this->Common_model->getRateCategories();
        $this->template->load('admin/base', 'admin/reporting/reporting', $data);
     }  
}