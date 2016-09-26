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
							$update = $this->Setting_model->saveAminity($postData,$id);
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

	/**
	 * @Method		-: addHotelChain()
	 * @Description	-: This function used to add hotelchain
	 * @Created		-: 19-09-2016
	*/ 
	public function addHotelChain(){
		$data = array(
			'title' => 'Hotel Chain',
			'list_heading' => 'Hotel Chain',
			'breadcrum' => '<li><a href="'.base_url('admin/settings/hotelChains').'">Hotel Chain</a></li>',
		);

		$postData = $this->input->post();
        if($postData){
        	$this->form_validation->set_rules('name', 'Chain Name', 'trim|required',array('required' => 'You must provide a %s.'));

			if($this->form_validation->run()==true){
			 try{
					$insert = $this->Setting_model->saveHotelChain($postData);
					if($insert){
						setMessage(' Hotel Chain added successfully','success');
						redirect('admin/settings/hotelChains');
					}
				}catch(Exception $ex){
					load_message('error',' Hotel chain is not inserted! '.$ex->getMessage());
				}
				

			}else{
				setMessage(' '.Validation_errors(),'warning');
			}
    	}

		$this->template->load('admin/base', 'admin/settings/addhotelchain', $data);
	}

	/**
	 * @Method		-: editHoteChain()
	 * @Description	-: This function used to edit hotel chain
	 * @Created		-: 20-09-2016
	*/ 
	public function editHotelChain($id){

		if(empty($id) && !is_numeric($id)){
			redirect('admin/settings/hotelChains');
		}
		$data = array(
			'title' => 'Hotel Chains',
			'list_heading' => 'Edit Hotel Chain',
			'breadcrum' => '<li><a href="'.base_url('admin/settings/hotelChains').'">Hotel Chain</a></li>',
		);

		$hotel_chain 	= $this->Setting_model->getHotelChainById($id);

		if($hotel_chain){
			$data['hotel_chain'] 	= $hotel_chain;
		}else{
			redirect('admin/settings/hotelChains');
		}

		$postData = $this->input->post();
        if($postData){
        	$this->form_validation->set_rules('name', 'Chain Name', 'trim|required',array('required' => 'You must provide a %s.'));

			if($this->form_validation->run()==true){
				
				 try{
						$update = $this->Setting_model->saveHotelChain($postData,$id);
						if($update){
							setMessage(' Hotel Chain updated successfully','success');
							redirect('admin/settings/hotelChains');
						}
					}catch(Exception $ex){
						load_message('error',' Hotel Chain is not inserted! '.$ex->getMessage());
					}
				
			}else{
				setMessage(' '.Validation_errors(),'warning');
			}
    	}

		$this->template->load('admin/base', 'admin/settings/edithotelchain', $data);
	}

	/**
	 * @Method		-: deleteHotelChain()
	 * @Description	-: This function is used to remove hotel chain
	 * @Created		-: 19-09-2016
	 */ 
	public function deleteHotelChain(){
		$id 	= $this->input->post('id');
		try{
			$delete = $this->Setting_model->deleteHotelChain($id); 
			if($delete){
				echo "TRUE";
			}

		}catch(Exception $ex){
			log_message('error','Hotel did not remove'.$ex->getMessage());
			echo "FALSE";
		}
	}

	/**
	 * @Method		-: hotelCategories()
	 * @Description	-: This function used to display all hotel categories
	 * @Created		-: 23-09-2016
	*/ 
	public function hotelCategories(){
		$data = array(
			'title' => 'Hotel Categories',
			'list_heading' => 'Hotel Categories',
			'breadcrum' => '<li><a href="'.base_url('admin/settings/hotelCategories').'">Hotel Categories</a></li>',
		);

		$data['hotel_categories']  = $this->Setting_model->getHotelCategories();
		$this->template->load('admin/base', 'admin/settings/hotelcategories', $data);
	}

	/**
	 * @Method		-: addHotelCategory()
	 * @Description	-: This function used to add hotel category
	 * @Created		-: 23-09-2016
	*/ 
	public function addHotelCategory(){
		$data = array(
			'title' => 'Hotel Categories',
			'list_heading' => 'Add hotel category',
			'breadcrum' => '<li><a href="'.base_url('admin/settings/hotelCategories').'">Hotel Categories</a></li>',
		);

		$postData = $this->input->post();
        if($postData){
        	$this->form_validation->set_rules('hotel_category', 'Category Name', 'trim|required',array('required' => 'You must provide a %s.'));

			if($this->form_validation->run()==true){
			 try{
					$insert = $this->Setting_model->saveHotelCategory($postData);
					if($insert){
						setMessage(' Hotel Category added successfully','success');
						redirect('admin/settings/hotelCategories');
					}
				}catch(Exception $ex){
					load_message('error',' Hotel Category is not inserted! '.$ex->getMessage());
				}
				

			}else{
				setMessage(' '.Validation_errors(),'warning');
			}
    	}

		$this->template->load('admin/base', 'admin/settings/addcategory', $data);
	}

	/**
	 * @Method		-: editHotelCategory()
	 * @Description	-: This function is used to edit hotel category
	 * @Created		-: 23-09-2016
	*/ 
	public function editHotelCategory($id){

		if(empty($id) && !is_numeric($id)){
			redirect('admin/settings/hotelCategories');
		}
		$data = array(
			'title' => 'Hotel Categories',
			'list_heading' => 'Edit Hotel Category',
			'breadcrum' => '<li><a href="'.base_url('admin/settings/hotelCategories').'">Hotel Categories</a></li>',
		);

		$hotel_category 	= $this->Setting_model->getHotelCategoryById($id);

		if($hotel_category){
			$data['hotel_category'] 	= $hotel_category;
		}else{
			redirect('admin/settings/hotelCategories');
		}

		$postData = $this->input->post();
        if($postData){
        	$this->form_validation->set_rules('hotel_category', 'Category Name', 'trim|required',array('required' => 'You must provide a %s.'));

			if($this->form_validation->run()==true){
				
				 try{
						$update = $this->Setting_model->saveHotelCategory($postData,$id);
						if($update){
							setMessage(' Hotel Category updated successfully','success');
							redirect('admin/settings/hotelCategories');
						}
					}catch(Exception $ex){
						load_message('error',' Hotel Categories is not inserted! '.$ex->getMessage());
					}
				
			}else{
				setMessage(' '.Validation_errors(),'warning');
			}
    	}

		$this->template->load('admin/base', 'admin/settings/editcategory', $data);
	}

	/**
	 * @Method		-: deleteHotelCategory()
	 * @Description	-: This function is used to remove hotel category
	 * @Created		-: 23-09-2016
	 */ 
	public function deleteHotelCategory(){
		$id 	= $this->input->post('id');
		try{
			$delete = $this->Setting_model->deleteHotelCategory($id); 
			if($delete){
				echo "TRUE";
			}

		}catch(Exception $ex){
			log_message('error','Hotel did not remove'.$ex->getMessage());
			echo "FALSE";
		}
	}

	/**
	 * @Method		-: hotelTypes()
	 * @Description	-: This function used to display all hotel types
	 * @Created		-: 23-09-2016
	*/ 
	public function hotelTypes(){
		$data = array(
			'title' => 'Hotel Types',
			'list_heading' => 'Hotel Types',
			'breadcrum' => '<li><a href="'.base_url('admin/settings/hotelTypes').'">Hotel Types</a></li>',
		);

		$data['hotel_types']  = $this->Setting_model->getHotelTypes();
		$this->template->load('admin/base', 'admin/settings/hoteltypes', $data);
	}

	/**
	 * @Method		-: addHotelType()
	 * @Description	-: This function used to add hotel type
	 * @Created		-: 23-09-2016
	*/ 
	public function addHotelType(){
		$data = array(
			'title' => 'Hotel Types',
			'list_heading' => 'Add hotel type',
			'breadcrum' => '<li><a href="'.base_url('admin/settings/hotelTypes').'">Hotel Types</a></li>',
		);

		$postData = $this->input->post();
        if($postData){
        	$this->form_validation->set_rules('hotel_type', 'Type Name', 'trim|required',array('required' => 'You must provide a %s.'));

			if($this->form_validation->run()==true){
			 try{
					$insert = $this->Setting_model->saveHotelType($postData);
					if($insert){
						setMessage(' Hotel Type added successfully','success');
						redirect('admin/settings/hotelTypes');
					}
				}catch(Exception $ex){
					load_message('error',' Hotel Type is not inserted! '.$ex->getMessage());
				}
				

			}else{
				setMessage(' '.Validation_errors(),'warning');
			}
    	}

		$this->template->load('admin/base', 'admin/settings/addtype', $data);
	}

	/**
	 * @Method		-: editHotelType()
	 * @Description	-: This function is used to edit hotel type
	 * @Created		-: 23-09-2016
	*/ 
	public function editHotelType($id){

		if(empty($id) && !is_numeric($id)){
			redirect('admin/settings/hotelTypes');
		}
		$data = array(
			'title' => 'Hotel Types',
			'list_heading' => 'Edit Hotel Type',
			'breadcrum' => '<li><a href="'.base_url('admin/settings/hotelTypes').'">Hotel Types</a></li>',
		);

		$hotel_type 	= $this->Setting_model->getHotelTypeById($id);

		if($hotel_type){
			$data['hotel_type'] 	= $hotel_type;
		}else{
			redirect('admin/settings/hotelTypes');
		}

		$postData = $this->input->post();
        if($postData){
        	$this->form_validation->set_rules('hotel_type', 'Type Name', 'trim|required',array('required' => 'You must provide a %s.'));

			if($this->form_validation->run()==true){
				
				 try{
						$update = $this->Setting_model->saveHotelType($postData,$id);
						if($update){
							setMessage(' Hotel Type updated successfully','success');
							redirect('admin/settings/hotelTypes');
						}
					}catch(Exception $ex){
						load_message('error',' Hotel Type is not inserted! '.$ex->getMessage());
					}
				
			}else{
				setMessage(' '.Validation_errors(),'warning');
			}
    	}

		$this->template->load('admin/base', 'admin/settings/edittype', $data);
	}

	/**
	 * @Method		-: deleteHotelType()
	 * @Description	-: This function is used to remove hotel type
	 * @Created		-: 23-09-2016
	 */ 
	public function deleteHotelType(){
		$id 	= $this->input->post('id');
		try{
			$delete = $this->Setting_model->deleteHotelType($id); 
			if($delete){
				echo "TRUE";
			}

		}catch(Exception $ex){
			log_message('error','Hotel did not remove'.$ex->getMessage());
			echo "FALSE";
		}
	}

	/**
	 * @Method		-: roomTypes()
	 * @Description	-: This function used to display all room type
	 * @Created		-: 23-09-2016
	*/ 
	public function roomTypes(){
		$data = array(
			'title' => 'Room Types',
			'list_heading' => 'Room Types',
			'breadcrum' => '<li><a href="'.base_url('admin/settings/roomTypes').'">Room Types</a></li>',
		);

		$data['room_types']  = $this->Setting_model->getRoomTypes();
		$this->template->load('admin/base', 'admin/settings/roomtypes', $data);
	}

	/**
	 * @Method		-: addRoomType()
	 * @Description	-: This function used to add hotel type
	 * @Created		-: 23-09-2016
	*/ 
	public function addRoomType(){
		$data = array(
			'title' => 'Room Types',
			'list_heading' => 'Add Room Type',
			'breadcrum' => '<li><a href="'.base_url('admin/settings/roomTypes').'">Room Types</a></li>',
		);

		$postData = $this->input->post();
        if($postData){
        	$this->form_validation->set_rules('room_type', 'Room Type', 'trim|required',array('required' => 'You must provide a %s.'));

			if($this->form_validation->run()==true){
			 try{
					$insert = $this->Setting_model->saveRoomType($postData);
					if($insert){
						setMessage(' Room Type added successfully','success');
						redirect('admin/settings/roomTypes');
					}
				}catch(Exception $ex){
					load_message('error',' Room Type is not inserted! '.$ex->getMessage());
				}
				

			}else{
				setMessage(' '.Validation_errors(),'warning');
			}
    	}

		$this->template->load('admin/base', 'admin/settings/addroomtype', $data);
	}

	/**
	 * @Method		-: editRoomType()
	 * @Description	-: This function is used to edit room type
	 * @Created		-: 23-09-2016
	*/ 
	public function editRoomType($id){

		if(empty($id) && !is_numeric($id)){
			redirect('admin/settings/roomTypes');
		}
		$data = array(
			'title' => 'Room Types',
			'list_heading' => 'Edit Room Type',
			'breadcrum' => '<li><a href="'.base_url('admin/settings/roomTypes').'">Room Types</a></li>',
		);

		$room_type 	= $this->Setting_model->getRoomTypeById($id);

		if($room_type){
			$data['room_type'] 	= $room_type;
		}else{
			redirect('admin/settings/roomTypes');
		}

		$postData = $this->input->post();
        if($postData){
        	$this->form_validation->set_rules('room_type', 'Room Type', 'trim|required',array('required' => 'You must provide a %s.'));

			if($this->form_validation->run()==true){
				
				 try{
						$update = $this->Setting_model->saveRoomType($postData,$id);
						if($update){
							setMessage(' Room Type updated successfully','success');
							redirect('admin/settings/roomTypes');
						}
					}catch(Exception $ex){
						load_message('error',' Room Type is not inserted! '.$ex->getMessage());
					}
				
			}else{
				setMessage(' '.Validation_errors(),'warning');
			}
    	}

		$this->template->load('admin/base', 'admin/settings/editroomtype', $data);
	}

	/**
	 * @Method		-: deleteRoomType()
	 * @Description	-: This function is used to remove hotel type
	 * @Created		-: 23-09-2016
	 */ 
	public function deleteRoomType(){
		$id 	= $this->input->post('id');
		try{
			$delete = $this->Setting_model->deleteRoomType($id); 
			if($delete){
				echo "TRUE";
			}

		}catch(Exception $ex){
			log_message('error','Hotel did not remove'.$ex->getMessage());
			echo "FALSE";
		}
	}

	/**
	 * @Method		-: rateCategories()
	 * @Description	-: This function used to display all rate categories
	 * @Created		-: 23-09-2016
	*/ 
	public function rateCategories(){
		$data = array(
			'title' => 'Rate Categories',
			'list_heading' => 'Rate Categories',
			'breadcrum' => '<li><a href="'.base_url('admin/settings/rateCategories').'">Rate Categories</a></li>',
		);

		$data['rate_categories']  = $this->Setting_model->getRateCategories();
		$this->template->load('admin/base', 'admin/settings/ratecategories', $data);
	}

	/**
	 * @Method		-: addRateCategory()
	 * @Description	-: This function used to add rate category
	 * @Created		-: 23-09-2016
	*/ 
	public function addRateCategory(){
		$data = array(
			'title' => 'Rate Categories',
			'list_heading' => 'Add Rate Category',
			'breadcrum' => '<li><a href="'.base_url('admin/settings/rateCategories').'">Rate Categories</a></li>',
		);

		$postData = $this->input->post();
        if($postData){
        	$this->form_validation->set_rules('category_type', 'Rate Category', 'trim|required',array('required' => 'You must provide a %s.'));
        	$this->form_validation->set_rules('meal_plan', 'Meal Plan', 'trim|required',array('required' => 'You must provide a %s.'));

			if($this->form_validation->run()==true){
			 try{
					$insert = $this->Setting_model->saveRateCategory($postData);
					if($insert){
						setMessage(' Rate Category added successfully','success');
						redirect('admin/settings/rateCategories');
					}
				}catch(Exception $ex){
					load_message('error',' Rate Category is not inserted! '.$ex->getMessage());
				}
				

			}else{
				setMessage(' '.Validation_errors(),'warning');
			}
    	}

		$this->template->load('admin/base', 'admin/settings/addratecategory', $data);
	}

	/**
	 * @Method		-: editRateCategory()
	 * @Description	-: This function is used to edit rate category
	 * @Created		-: 23-09-2016
	*/ 
	public function editRateCategory($id){

		if(empty($id) && !is_numeric($id)){
			redirect('admin/settings/rateCategories');
		}
		$data = array(
			'title' => 'Rate Categories',
			'list_heading' => 'Edit Rate Category',
			'breadcrum' => '<li><a href="'.base_url('admin/settings/rateCategories').'">Rate Categories</a></li>',
		);

		$rate_category 	= $this->Setting_model->getRateCategoryById($id);

		if($rate_category){
			$data['rate_category'] 	= $rate_category;
		}else{
			redirect('admin/settings/rateCategories');
		}

		$postData = $this->input->post();
        if($postData){
        	$this->form_validation->set_rules('category_type', 'Rate Category', 'trim|required',array('required' => 'You must provide a %s.'));
        	$this->form_validation->set_rules('meal_plan', 'Meal Plan', 'trim|required',array('required' => 'You must provide a %s.'));

			if($this->form_validation->run()==true){
				
				 try{
						$update = $this->Setting_model->saveRateCategory($postData,$id);
						if($update){
							setMessage(' Rate Category updated successfully','success');
							redirect('admin/settings/rateCategories');
						}
					}catch(Exception $ex){
						load_message('error',' Rate Category is not inserted! '.$ex->getMessage());
					}
				
			}else{
				setMessage(' '.Validation_errors(),'warning');
			}
    	}

		$this->template->load('admin/base', 'admin/settings/editratecategory', $data);
	}

	/**
	 * @Method		-: deleteRateCategory()
	 * @Description	-: This function is used to remove rate category
	 * @Created		-: 23-09-2016
	 */ 
	public function deleteRateCategory(){
		$id 	= $this->input->post('id');
		try{
			$delete = $this->Setting_model->deleteRateCategory($id); 
			if($delete){
				echo "TRUE";
			}

		}catch(Exception $ex){
			log_message('error','Rate Category did not remove'.$ex->getMessage());
			echo "FALSE";
		}
	}

}

?>