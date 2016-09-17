<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {
	function __construct() {
        parent::__construct();
        
        $this->load->model('Common_model');
        if (!$this->ion_auth->logged_in()) {
            redirect('admin/auth/login', 'refresh');
        }
    }

    public function index()
    {

    }

    /**
	 * @Method		-: getHotelType()
	 * @Description	-: This function used to display all hotel types
	 * @Created		-: 06-09-2016
	*/ 

	public function getHotelType()
	{
		$data = array(
			'title' => 'Hotel Types',
			'list_heading' => 'Hotel Types',
			'breadcrum' => '<li><a href="'.base_url('admin/settings/getHotelType').'">Hotel Types</a></li>',
		);

		$data['hotel_types']  = $this->Setting_model->getHotelTypes();
		$this->template->load('admin/base', 'admin/settings/hoteltypes', $data);
	}
}

?>