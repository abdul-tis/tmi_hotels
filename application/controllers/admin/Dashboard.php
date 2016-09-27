<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library(array('admin'));
    }

    public function index() {
        if (!$this->ion_auth->logged_in()) {
            redirect('admin/auth/login', 'refresh');
        }
        $data = array(
            'title' => 'Dashboard',
        );
		//setMessage(' Welcome back on Dashboard','success');
        $this->template->load('admin/base', 'admin/landing_page', $data);
    }

}
