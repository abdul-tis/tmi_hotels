<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {
	function __construct() {
        parent::__construct();
        
        $this->load->model('Setting_model');
        $this->load->model('Common_model');
        $this->load->library('form_validation');
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

	public function getHotelType(){
		$data = array(
			'title' => 'Hotel Types',
			'list_heading' => 'Hotel Types',
			'breadcrum' => '<li><a href="'.base_url('admin/settings/getHotelType').'">Hotel Types</a></li>',
		);

		$data['hotel_types']  = $this->Common_model->getHotelTypes();
		$this->template->load('admin/base', 'admin/settings/hoteltypes', $data);
	}

	/**
	 * @Method		-: amenities()
	 * @Description	-: This function used to display all amenities
	 * @Created		-: 19-09-2016
	*/ 

	public function amenities(){
		$data = array(
			'title' => 'Amenities',
			'list_heading' => 'Amenities',
			'breadcrum' => '<li><a href="'.base_url('admin/settings/amenities').'">Amenities</a></li>',
		);

		$data['amenities']  = $this->Setting_model->getAmenities();
		$this->template->load('admin/base', 'admin/settings/amenities', $data);
	}

	/**
	 * @Method		-: addAmenity()
	 * @Description	-: This function used to save amenity
	 * @Created		-: 19-09-2016
	*/ 

	public function addAmenity(){
		$data = array(
			'title' => 'Add Amenity',
			'list_heading' => 'Add Amenity',
			'breadcrum' => '<li><a href="'.base_url('admin/settings/amenities').'">Amenities</a></li>',
		);

		$postData = $this->input->post();
        if($postData){
        	$this->form_validation->set_rules('service_name', 'Amity Name', 'trim|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('type', 'Aminity Type', 'trim|required',array('required' => 'You must provide a %s.'));

			if($this->form_validation->run()==true){
				$errors 			= '';

				if(!empty($_FILES['amenity_icon']['tmp_name'])){	
					if(empty($errors)){
						$this->load->library('upload');
						$config['upload_path'] = FCPATH . 'uploads/icons/';
						$config['allowed_types'] = 'gif|jpg|jpeg|png|svg|eps|psd';
						$this->upload->initialize($config);
						if($this->upload->do_upload('amenity_icon')){
							$uploads 		= $this->upload->data();
							$postData['amenity_icon'] 		= $uploads['file_name']; 
						}else{
							$errors .= $this->upload->display_errors();
						}

					}
				}
				if(empty($errors)){
				 try{
						$insert = $this->Setting_model->saveAminity($postData);
						if($insert){
							setMessage(' Aminity added successfully','success');
							redirect('admin/settings/amenities');
						}
					}catch(Exception $ex){
						load_message('error',' Amenity is not inserted! '.$ex->getMessage());
					}
				}else{
					setMessage($errors,'warning');
				}

			}else{
				setMessage(' '.Validation_errors(),'warning');
			}
    	}

		$data['main_service'] = $this->Setting_model->getMainServices();
		$this->template->load('admin/base', 'admin/settings/addamenity', $data);
	}

	/**
	 * @Method		-: editAmenity()
	 * @Description	-: This function used to edit amenity
	 * @Created		-: 19-09-2016
	*/ 

	public function editAmenity($id){

		if(empty($id) && !is_numeric($id)){
			redirect('admin/settings/amenities');
		}
		$data = array(
			'title' => 'Edit Amenity',
			'list_heading' => 'Edit Amenity',
			'breadcrum' => '<li><a href="'.base_url('admin/settings/amenities').'">Amenities</a></li>',
		);

		$amenity 	= $this->Setting_model->getAminityById($id);

		if($amenity){
			$data['amenity'] 	= $amenity;
		}else{
			redirect('admin/settings/amenities');
		}

		$postData = $this->input->post();
        if($postData){
        	$this->form_validation->set_rules('service_name', 'Amity Name', 'trim|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('type', 'Aminity Type', 'trim|required',array('required' => 'You must provide a %s.'));

			if($this->form_validation->run()==true){
				$errors 			= '';
				$postData['amenity_icon'] = $amenity['amenity_icon'];
				if(!empty($_FILES['amenity_icon']['tmp_name'])){	
					if(empty($errors)){
						$this->load->library('upload');
						$config['upload_path'] = FCPATH . 'uploads/icons/';
						$config['allowed_types'] = 'gif|jpg|jpeg|png|svg|eps|psd';
						$this->upload->initialize($config);
						if($this->upload->do_upload('amenity_icon')){
							$uploads 		= $this->upload->data();
							$postData['amenity_icon'] 		= $uploads['file_name']; 
						}else{
							$errors .= $this->upload->display_errors();
						}

					}
				}

				if(empty($errors)){
					 try{
							$update = $this->Setting_model->saveAminity($id,$postData);
							if($update){
								setMessage(' Aminity updated successfully','success');
								redirect('admin/settings/amenities');
							}
						}catch(Exception $ex){
							load_message('error',' Hotel is not inserted! '.$ex->getMessage());
						}
				}else{
					setMessage($errors,'warning');
				}
			}else{
				setMessage(' '.Validation_errors(),'warning');
			}
    	}

		$data['main_service'] = $this->Setting_model->getMainServices();
		$this->template->load('admin/base', 'admin/settings/editamenity', $data);
	}

	/**
	 * @Method		-: deleteAmenity()
	 * @Description	-: This function used to remove amenity
	 * @Created		-: 19-09-2016
	 */ 
	public function deleteAmenity(){
		$id 	= $this->input->post('id');
		try{
			$delete = $this->Setting_model->deleteAmenity($id); 
			if($delete){
				echo "TRUE";
			}

		}catch(Exception $ex){
			log_message('error','Hotel did not remove'.$ex->getMessage());
			echo "FALSE";
		}
	}

	/**
	 * @Method		-: hotelChains()
	 * @Description	-: This function used to display all hotelChains
	 * @Created		-: 19-09-2016
	*/ 

	public function hotelChains(){
		$data = array(
			'title' => 'Hotel Chains',
			'list_heading' => 'Hotel Chains',
			'breadcrum' => '<li><a href="'.base_url('admin/settings/hotelChains').'">Hotel Chains</a></li>',
		);

		$data['hotel_chains']  = $this->Setting_model->getHotelChains();
		$this->template->load('admin/base', 'admin/settings/hotelchains', $data);
	}
}

?>