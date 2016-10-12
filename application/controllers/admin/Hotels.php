<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hotels extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('Hotel_model');
        $this->load->model('Common_model');
        $this->load->library('form_validation');
        if (!$this->ion_auth->logged_in()) {
            redirect('admin/auth/login', 'refresh');
        }
        $this->load->library(array('pagination','admin'));
        $this->limit = 10;
        if(!checkAccess($this->admin->accessLabelId,'hotels','view'))	
		{
    		setMessage($this->admin->accessDenidMessage,'warning');
    		redirect('admin/dashboard', 'refresh');	
		}	
    }

 /**
 * @Method		-: index()
 * @Description	-: This function used to for display all hotels
 * @Created		-: 05-09-2016
 */  
	public function index($offset=0) 
	{
		$data = array(
			'title' => 'Hotels',
			'list_heading' => 'Hotels',
			'breadcrum' => '<li><a href="'.base_url('admin/hotels/index').'">Hotels</a></li>',
		);

			$totalRow 	= $this->Hotel_model->getAllHotels();
			
			$config 					= array();
			$data['totalRecords'] 		= $totalRow;
			$data['limit'] 				= $this->limit;
			$config["base_url"] 		= base_url('admin/hotels/index/');
			$config["total_rows"] 		= $totalRow;
			$config["per_page"] 		= $this->limit;
			$config['uri_segment'] 		= 4;
			$config['use_page_numbers'] = TRUE;
			$config['num_links'] 		= $totalRow;
			$config['cur_tag_open'] 	= '<li class="table-red paginate_button active" ><a>';
			$config['cur_tag_close'] 	= '</a></li>';
			$config['num_tag_open'] 	= '<li class="paginate_button" >';
			$config['num_tag_close'] 	= '</li>';
			$config['full_tag_open'] 	= '<li class="paginate_button">';
			$config['full_tag_close'] 	= '</li>';
			$config['next_tag_open'] 	= '<li class="paginate_button next">';
			$config['prev_tag_open'] 	= '<li class="paginate_button previous">';
			$config['next_tag_close'] 	= '</li>';
			$config['prev_tag_close'] 	= '</li>';
			$config['num_tag_open'] 	= '<li class="paginate_button">';
			$config['num_tag_close'] 	= '</li>';
			$config['last_tag_close'] 	= '<li class="paginate_button next">';
			$config['last_tag_close'] 	= '</li>';
			$config['next_link'] 		= 'Next';
			$config['prev_link'] 		= 'Previous';
			$this->pagination->initialize($config);
			if($offset > 1){
				$page 	= ($offset - 1) * $this->limit;
			}
			else{
				 $page 	= $offset;
			}
			$data['recordsFrom'] 	= $page;
			$str_links 				= $this->pagination->create_links();
			$data["links"] 			= $str_links;
			$page 					= (empty($page)) ? 'P' : $page;

		$data['hotels']  		= $this->Hotel_model->getAllHotels(null,null,null,$page);
		$data['hotel_types'] 	= $this->Common_model->getHotelTypes();
		$this->template->load('admin/base', 'admin/hotels/hotels', $data);
	}

 /**
 * @Method		-: addHotel()
 * @Description	-: This function used to display all hotels
 * @Created		-: 05-09-2016
 */  
	public function addHotel()
	{
		if(!checkAccess($this->admin->accessLabelId,'hotels','add'))	
		{
    		setMessage($this->admin->accessDenidMessage,'warning');
    		redirect('admin/dashboard', 'refresh');	
		}	
		$data = array(
            'title' => 'Hotels',
            'list_heading' => 'Add Hotel',
            'breadcrum' => '<li><a href="'.base_url('admin/hotels').'">Hotel Info</a></li>
            <li><a href="'.base_url('admin/hotels/addHotel').'">Add Hotel</a></li>',
        );
        $postData = $this->input->post();
        if($postData)
        {
        	$this->form_validation->set_rules('hotel_name', 'Hotel Name', 'trim|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('hotel_type', 'Hotel Type', 'trim|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('no_of_rooms', 'No Of Rooms', 'trim|numeric|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('tmi_rooms', 'No Of TMI Rooms', 'trim|greater_than[0]|less_than[no_of_rooms]|numeric|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('hotel_phone', 'Hotel Phone ', 'trim|required|regex_match[/^[0-9]{10}$/]',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('hotel_mobile', 'Hotel Mobile ', 'trim|required|regex_match[/^[0-9]{10}$/]',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('email_list', 'Email List', 'trim|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('checkin_time', 'Checkin Time', 'trim|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('checkout_time', 'Checkout Time', 'trim|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('owner_commision', 'Hotel Owner Commision', 'trim|required',array('required' => 'You must provide a %s.'));
			
			$this->form_validation->set_rules('loc_country', 'Country', 'trim|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('loc_state', 'State', 'trim|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('loc_city', 'City', 'trim|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('locality', 'Locality', 'trim|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('landmarks', 'Landmarks', 'trim|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('zipcode', 'Zipcode', 'trim|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('address', 'Address', 'trim|required',array('required' => 'You must provide a %s.'));
			

			if($this->form_validation->run()==true)
			{
				$hotelImages 		= '';
				$hotelPrimaryImage 	= '';
				if(!empty($_FILES['uploadedimages']['tmp_name'][0]))
				{
					$files 				= $_FILES['uploadedimages'];
					$errors 			= '';
					$total_files 		= count($_FILES['uploadedimages']['tmp_name']);
					/*for($i=0;$i<$total_files;$i++){
						if($_FILES['uploadedimages']['error'][$i] != 0){
						  $errors .= 'Couldn\'t upload file '.$_FILES['uploadedimages']['name'][$i];
						}
					}*/

					if(empty($errors)){
						$this->load->library('upload');
						$config['upload_path'] 	 = FCPATH . 'uploads/hotel/original/';
						$config['allowed_types'] = 'gif|jpg|jpeg|png';
						
						for ($i = 0; $i < $total_files; $i++){
							$_FILES['uploadedimage']['name'] 		= $files['name'][$i];
							$_FILES['uploadedimage']['type'] 		= $files['type'][$i];
							$_FILES['uploadedimage']['tmp_name'] 	= $files['tmp_name'][$i];
							$_FILES['uploadedimage']['error'] 		= $files['error'][$i];
							$_FILES['uploadedimage']['size'] 		= $files['size'][$i];
							$this->upload->initialize($config);
							if($this->upload->do_upload('uploadedimage')){
								$uploads 		= $this->upload->data();
								if($postData['primary']==$i){
									$hotelPrimaryImage = $uploads['file_name'];
								}
								$hotelImages[$i] = $uploads['file_name'];
								// resize image to medium size 
								$config2['image_library'] 	= 'gd2';
								$config2['source_image'] 	= FCPATH . 'uploads/hotel/original/'.$uploads['file_name'];
								$config2['new_image'] 		= FCPATH . 'uploads/hotel/medium/';
								$config2['maintain_ratio'] 	= TRUE;
								$config2['width']         	= 308;
								$config2['height']       	= 204;

								$this->load->library('image_lib', $config2);

								$this->image_lib->resize();
								$this->image_lib->clear();
								// resize image to thumbnail
								$config3['image_library'] 	= 'gd2';
								$config3['source_image'] 	= FCPATH . 'uploads/hotel/original/'.$uploads['file_name'];
								$config3['new_image'] 		= FCPATH . 'uploads/hotel/thumbnail/';
								$config3['create_thumb'] 	= TRUE;
								$config3['maintain_ratio'] 	= TRUE;
								$config3['width']         	= 90;
								$config3['height']       	= 60;

								$this->load->library('image_lib', $config3);

								$this->image_lib->resize();
								$this->image_lib->clear();
								
							}else{
								$errors .= $this->upload->display_errors();
							}
						}
					}
				}
				if(empty($errors)){
					try{
						$basic_info 				= array();
						$location 					= array();
						
						$basic_info['hotel_name'] 	= $postData['hotel_name'];
						$basic_info['hotel_chain'] 	= $postData['hotel_chain'];
						$basic_info['hotel_type'] 	= $postData['hotel_type'];
						if(!empty($postData['hotel_category'])){
							$basic_info['hotel_category']= implode(',',$postData['hotel_category']);
						}
						$basic_info['star_rating'] 	= $postData['star_rating'];
						$basic_info['base_currency']= $postData['base_currency'];
						$basic_info['no_of_rooms'] 	= $postData['no_of_rooms'];
						$basic_info['tmi_rooms'] 	= $postData['tmi_rooms'];
						$basic_info['hotel_phone'] 	= $postData['hotel_phone'];
						$basic_info['hotel_mobile'] = $postData['hotel_mobile'];
						$basic_info['email_list']   = $postData['email_list'];
						$basic_info['checkin_time'] = $postData['checkin_time'];
						$basic_info['checkout_time']= $postData['checkout_time'];
						$slug 						= url_title($postData['hotel_name'],'dash',true);
						$basic_info['slug'] 		= $slug;
						if(!empty($postData['hotel_amenities']))
						{
							$basic_info['hotel_amenities']= implode(',',$postData['hotel_amenities']);
						}
						$basic_info['owner_commision'] 		= $postData['owner_commision'];
						
						$basic_info['meta_title'] 		= $postData['meta_title'];
						$basic_info['meta_description'] = $postData['meta_description'];

						$basic_info['hotel_status'] = $postData['hotel_status'];

						$location['latitude'] 		= $postData['latitude'];
						$location['longitude'] 		= $postData['longitude'];
						$location['loc_country'] 	= $postData['loc_country'];
						$location['loc_state'] 		= $postData['loc_state'];
						$location['loc_city'] 		= $postData['loc_city'];
						$location['locality'] 		= $postData['locality'];
						$location['landmarks'] 		= $postData['landmarks'];
						$location['zipcode'] 		= $postData['zipcode'];
						$location['address'] 		= $postData['address'];

						$insert = $this->Hotel_model->saveHotel($basic_info);
						if($insert)
						{
							$location['hotel_id']       = $insert;
							$this->Hotel_model->saveHotelLocation($location);
							$this->Hotel_model->saveHotelContactDetails($insert,$postData);
							$this->Hotel_model->saveHotelImages($insert,$hotelPrimaryImage,$hotelImages);
							setMessage(' Hotel added successfully','success');
							redirect('admin/hotels');
						}
					}catch(Exception $ex){
						load_message('error',' Hotel is not inserted! '.$ex->getMessage());
					}
				}else{
					setMessage($errors,'warning');
				}
			}
			else
			{
				setMessage(' '.Validation_errors(),'warning');
			}
        }

		$data['countries'] 		= $this->Common_model->getAllCountry();
		$data['hotel_types'] 	= $this->Common_model->getHotelTypes();
		$data['amenities'] 		= $this->Common_model->getAmenities($type=1);
		$data['designations'] 	= $this->Common_model->getDesignation();
		$data['hotel_chains']    = $this->Common_model->getHotelChains();
		$data['hotel_categories'] = $this->Common_model->getHotelCategories();
        $this->template->load('admin/base', 'admin/hotels/addhotel', $data);
	}

	/**
	 * @Methode		-: editHotel()
	 * @Description	-: This is used edit hotel details
	 * @Param		-: $id (int)
	 * @Created on	-: 07-09-2016
	 */

	public function editHotel($id)
	{
		if(!checkAccess($this->admin->accessLabelId,'hotels','edit'))	
		{
    		setMessage($this->admin->accessDenidMessage,'warning');
    		redirect('admin/dashboard', 'refresh');	
		}	

		if(empty($id) && !is_numeric($id))
		{
			redirect('admin/hotels/');
		}

		$data = array(
			'title' => 'Edit Hotel',
			'list_heading' => 'Edit Hotel',
			'breadcrum' => '<li><a href="'.base_url('admin/hotels').'">Hotels</a></li>
			<li><a href="">Edit Hotel</a></li>',
		);

		$hotel 	= $this->Hotel_model->getHotelDetailsById($id);
		if($hotel)
		{
			$data['hotel'] = $hotel;
			$hotelPrimaryImage 	= $hotel['primary_image'];
			$images 	 	    = $hotel['images'];
			
			$hotelImages 		= (!empty($images))?explode(',',$images):NULL;
		}
		else
		{
			redirect('admin/hotels/');
		}

		$postData = $this->input->post();
		if($postData)
		{
			$this->form_validation->set_rules('hotel_name', 'Hotel Name', 'trim|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('hotel_type', 'Hotel Type', 'trim|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('no_of_rooms', 'No Of Rooms', 'trim|numeric|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('tmi_rooms', 'No Of TMI Rooms', 'trim|greater_than[0]|less_than[no_of_rooms]|numeric|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('hotel_phone', 'Hotel Phone ', 'trim|required|regex_match[/^[0-9]{10}$/]',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('hotel_mobile', 'Hotel Mobile ', 'trim|required|regex_match[/^[0-9]{10}$/]',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('email_list', 'Email List', 'trim|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('checkin_time', 'Checkin Time', 'trim|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('checkout_time', 'Checkout Time', 'trim|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('owner_commision', 'Hotel Owner Commision', 'trim|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('loc_country', 'Country', 'trim|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('loc_state', 'State', 'trim|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('loc_city', 'City', 'trim|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('locality', 'Locality', 'trim|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('landmarks', 'Landmarks', 'trim|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('zipcode', 'Zipcode', 'trim|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('address', 'Address', 'trim|required',array('required' => 'You must provide a %s.'));

			if($this->form_validation->run()==true)
			{
				$errors 			= '';
				$totalHotelImages   = "";
				if(!empty($_FILES['uploadedimages']['tmp_name'][0]))
				{
					$files 			= $_FILES['uploadedimages'];

					$total_files 	= count($_FILES['uploadedimages']['tmp_name']);
					/*for($i=0;$i<$total_files;$i++){
						if($_FILES['uploadedimages']['error'][$i] != 0 ){
						  $errors .= 'Couldn\'t upload file '.$_FILES['uploadedimages']['name'][$i];
						}
					}*/

					if(empty($errors)){
						$this->load->library('upload');
						$config['upload_path'] = FCPATH . 'uploads/hotel/original/';
						$config['allowed_types'] = 'gif|jpg|jpeg|png';
						for ($i = 0; $i < $total_files; $i++){
							$_FILES['uploadedimage']['name'] 		= $files['name'][$i];
							$_FILES['uploadedimage']['type'] 		= $files['type'][$i];
							$_FILES['uploadedimage']['tmp_name'] 	= $files['tmp_name'][$i];
							$_FILES['uploadedimage']['error'] 		= $files['error'][$i];
							$_FILES['uploadedimage']['size'] 		= $files['size'][$i];
							$this->upload->initialize($config);
							if($this->upload->do_upload('uploadedimage')){
								$uploads 		= $this->upload->data();
								if($postData['primary']==$i){
									$hotelPrimaryImage = $uploads['file_name'];
								}
								$totalHotelImages[$i] = $uploads['file_name'];
								// resize image to medium size 
								$config2['image_library'] 	= 'gd2';
								$config2['source_image'] 	= FCPATH . 'uploads/hotel/original/'.$uploads['file_name'];
								$config2['new_image'] 		= FCPATH . 'uploads/hotel/medium/';
								$config2['maintain_ratio'] 	= TRUE;
								$config2['width']         	= 308;
								$config2['height']       	= 204;

								$this->load->library('image_lib', $config2);

								$this->image_lib->resize();
								$this->image_lib->clear();

								// resize image to thumbnail
								$config3['image_library'] 	= 'gd2';
								$config3['source_image'] 	= FCPATH . 'uploads/hotel/original/'.$uploads['file_name'];
								$config3['new_image'] 		= FCPATH . 'uploads/hotel/thumbnail/';
								$config3['create_thumb'] 	= TRUE;
								$config3['maintain_ratio'] 	= TRUE;
								$config3['width']         	= 90;
								$config3['height']       	= 60;

								$this->load->library('image_lib', $config3);

								$this->image_lib->resize();
								$this->image_lib->clear();
							}else{
								$errors .= $this->upload->display_errors();
							}
							
							$hotelImages 	= $totalHotelImages;

						}
					}
				}
				if(empty($errors)){
					try{
						
						$basic_info 				= array();
						$location 					= array();
						$basic_info['hotel_name'] 	= $postData['hotel_name'];
						$basic_info['hotel_chain'] 	= $postData['hotel_chain'];
						$basic_info['hotel_type'] 	= $postData['hotel_type'];
						if(!empty($postData['hotel_category'])){
							$basic_info['hotel_category']= implode(',',$postData['hotel_category']);
						}
						$basic_info['star_rating'] 	= $postData['star_rating'];
						$basic_info['base_currency']= $postData['base_currency'];
						$basic_info['no_of_rooms'] 	= $postData['no_of_rooms'];
						$basic_info['tmi_rooms'] 	= $postData['tmi_rooms'];
						$basic_info['hotel_phone'] 	= $postData['hotel_phone'];
						$basic_info['hotel_mobile'] = $postData['hotel_mobile'];
						$basic_info['email_list']   = $postData['email_list'];
						$basic_info['checkin_time'] = $postData['checkin_time'];
						$basic_info['checkout_time']= $postData['checkout_time'];
						$slug 						= url_title($postData['hotel_name'],'dash',true);
						$basic_info['slug'] 		= $slug;
						if(!empty($postData['hotel_amenities']))
						{
							$basic_info['hotel_amenities']= implode(',',$postData['hotel_amenities']);
						}
						$basic_info['owner_commision'] 	= $postData['owner_commision'];
						$basic_info['meta_title'] 		= $postData['meta_title'];
						$basic_info['meta_description'] = $postData['meta_description'];
						$basic_info['hotel_status'] = $postData['hotel_status'];

						$location['latitude'] 		= $postData['latitude'];
						$location['longitude'] 		= $postData['longitude'];
						$location['loc_country'] 	= $postData['loc_country'];
						$location['loc_state'] 		= $postData['loc_state'];
						$location['loc_city'] 		= $postData['loc_city'];
						$location['locality'] 		= $postData['locality'];
						$location['landmarks'] 		= $postData['landmarks'];
						$location['zipcode'] 		= $postData['zipcode'];
						$location['address'] 		= $postData['address'];

						if(!empty($hotelImages)){
							foreach($hotelImages as $key=>$img){
								if(!empty($postData['primary']) && $postData['primary']==$key){
									$hotelPrimaryImage = $img;
								}
								$hotelImages[$key] = $img;
							}
						}

						$update = $this->Hotel_model->saveHotel($basic_info,$id);
						if($update)
						{
							$this->Hotel_model->saveHotelLocation($location,$id);
							if(!empty($totalHotelImages)){
								$this->Hotel_model->saveHotelImages($id,$hotelPrimaryImage,$hotelImages);
							}
							$this->Hotel_model->saveHotelContactDetails($id,$postData);
							setMessage(' Hotel updated successfully','success');
							redirect('admin/hotels');
						}

					}catch(Exception $ex){
						load_message('error',' Hotel is not inserted! '.$ex->getMessage());
					}
				}else{
					setMessage($errors,'warning');
				}
			}
			else
			{
				setMessage(' '.Validation_errors(),'warning');
			}
		}

		$contacts = $this->db->where('hotel_id',$id)->get('hotel_contact_details')->result_array();
		
		if($contacts){
			$data['hotalContacts'] = $contacts;
		}
		$data['countries'] 		= $this->Common_model->getAllCountry();
		$data['hotel_types'] 	= $this->Common_model->getHotelTypes();
		$data['amenities'] 		= $this->Common_model->getAmenities($type=1);
		$data['designations'] 	= $this->Common_model->getDesignation();
		$data['hotel_chains']    = $this->Common_model->getHotelChains();
		$data['hotel_categories'] = $this->Common_model->getHotelCategories();
        $this->template->load('admin/base', 'admin/hotels/edithotel', $data);
	}

	/**
	 * @Method		-: deleteHotel()
	 * @Description	-: This function used to remove hotel
	 * @Created		-: 07-09-2016
	 */ 
	public function deleteHotel()
	{
		if(!checkAccess($this->admin->accessLabelId,'hotels','delete'))	
		{
    		echo "FALSE";
    		exit;
		}	

		$hotel_id 	= $this->input->post('hotel_id');
		try{
			$delete = $this->Hotel_model->deleteHotel($hotel_id); 
			if($delete)
			{
				echo "TRUE";
			}

		}catch(Exception $ex){
			log_message('error','Hotel did not remove'.$ex->getMessage());
			echo "FALSE";
		}
	}

	/**
	 * @Method		-: getStatesByCountry()
	 * @Description	-: This function used to get all states of a country
	 * @Created		-: 06-09-2016
	 */ 

	public function getStatesByCountry()
	{
		$country_id 	= $this->input->post('country_id');

		if(!empty($country_id))
		{
			$states 	= $this->Common_model->getStatesByCountry($country_id);
			$html 		= '<option value="">Select State</option>';
			if(!empty($states))
			{
				foreach($states as $state)
				{
					$html .= '<option value="'.$state['id'].'">'.$state['state_name'].'</option>';
				}

				echo $html;
				exit;
			}
		}
	}

	/**
	 * @Method		-: getCitiesByState()
	 * @Description	-: This function used to get all cities of a state
	 * @Created		-: 06-09-2016
	 */ 

	public function getCitiesByState()
	{
		$state_id 	= $this->input->post('state_id');

		if(!empty($state_id))
		{
			$cities 	= $this->Common_model->getCitiesByState($state_id);
			$html 		= '<option value="">Select City</option>';
			if(!empty($cities))
			{
				foreach($cities as $city)
				{
					$html .= '<option value="'.$city['id'].'">'.$city['city_name'].'</option>';
				}

				echo $html;
				exit;
			}
		}
	}

	/**
	 * @Method		-: getHotelRooms()
	 * @Description	-: This function used to display rooms of hotel
	 * @Created		-: 07-09-2016
	 */  
	public function hotelRooms($hotel_id,$offset=0) 
	{
		if(!checkAccess($this->admin->accessLabelId,'hotels','view rooms'))	
		{
    		setMessage($this->admin->accessDenidMessage,'warning');
    		redirect('admin/dashboard', 'refresh');	
		}	

		if(empty($hotel_id) && !is_numeric($hotel_id))
		{
			redirect('admin/hotels');
		}

		$data = array(
			'title' => 'Hotels',
			'list_heading' => 'Rooms Management',
			'breadcrum' => '<li><a href="'.base_url('admin/hotels').'">Hotels</a></li>',
		);

		$this->db->where('hotel_id',$hotel_id);
		$query = $this->db->get('hotel');
		if($query->num_rows() > 0)
		{
			$totalRow 					= $this->Hotel_model->getHotelRooms($hotel_id);
			
			$config 					= array();
			$data['totalRecords'] 		= $totalRow;
			$data['limit'] 				= $this->limit;
			$config["base_url"] 		= base_url('admin/hotels/hotelRooms/'.$hotel_id);
			$config["total_rows"] 		= $totalRow;
			$config["per_page"] 		= $this->limit;
			$config['uri_segment'] 		= 5;
			$config['use_page_numbers'] = TRUE;
			$config['num_links'] 		= $totalRow;
			$config['cur_tag_open'] 	= '<li class="table-red paginate_button active" ><a>';
			$config['cur_tag_close'] 	= '</a></li>';
			$config['num_tag_open'] 	= '<li class="paginate_button" >';
			$config['num_tag_close'] 	= '</li>';
			$config['full_tag_open'] 	= '<li class="paginate_button">';
			$config['full_tag_close'] 	= '</li>';
			$config['next_tag_open'] 	= '<li class="paginate_button next">';
			$config['prev_tag_open'] 	= '<li class="paginate_button previous">';
			$config['next_tag_close'] 	= '</li>';
			$config['prev_tag_close'] 	= '</li>';
			$config['num_tag_open'] 	= '<li class="paginate_button">';
			$config['num_tag_close'] 	= '</li>';
			$config['last_tag_close'] 	= '<li class="paginate_button next">';
			$config['last_tag_close'] 	= '</li>';
			$config['next_link'] 		= 'Next';
			$config['prev_link'] 		= 'Previous';
			$this->pagination->initialize($config);
			if($offset > 1){
				$page 	= ($offset - 1) * $this->limit;
			}
			else{
				 $page 	= $offset;
			}
			$data['recordsFrom'] 	= $page;
			$str_links 				= $this->pagination->create_links();
			$data["links"] 			= $str_links;
			$page 					= (empty($page)) ? 'P' : $page;

			$data['rooms']  = $this->Hotel_model->getHotelRooms($hotel_id,$page);
			
		}
		else
		{
			setMessage('Hotel does not exist!','warning');
			redirect('admin/hotels');
		}

		$data['hotel_id'] 	= $hotel_id;
		$this->template->load('admin/base', 'admin/hotels/hotelrooms', $data);
	}

	/**
	 * @Method		-: addHotelRooms()
	 * @Description	-: This function used to add room of hotel
	 * @Created		-: 07-09-2016
	 */  
	public function addHotelRoom($hotel_id)
	{
		if(!checkAccess($this->admin->accessLabelId,'hotels','add room'))	
		{
    		setMessage($this->admin->accessDenidMessage,'warning');
    		redirect('admin/dashboard', 'refresh');	
		}

		if(empty($hotel_id) && !is_numeric($hotel_id))
		{
			redirect('admin/hotels');
		}

		$data = array(
            'title' => 'Hotels',
            'list_heading' => 'Add Hotel Room',
            'breadcrum' => '<li><a href="'.base_url('admin/hotels/hotelRooms/'.$hotel_id).'">Hotel Room</a></li>
            <li><a href="'.base_url('admin/hotels/addHotel').'">Add Hotel Rooms</a></li>',
        );
        $data['hotel_id'] 	= $hotel_id;
        $postData = $this->input->post();

        if($postData){
        	
			$this->form_validation->set_rules('room_type', 'Room Type', 'trim|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('adults', 'Max Adults', 'trim|numeric|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('children', 'Max Children ', 'trim|numeric|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('extra_beds', 'Extra Beds', 'trim|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('no_of_rooms', 'Number of Rooms', 'trim|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('tmi_rooms', 'Number of TMI Rooms', 'trim|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('beds', 'Beds', 'trim|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('price', 'Price', 'trim|numeric|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('period_from', 'Period From', 'trim|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('period_to', 'Period To', 'trim|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('rate_category', 'Price Offer', 'trim|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('extra_bed_charge', 'Extra Bed Charge ', 'trim|numeric|required',array('required' => 'You must provide a %s.'));
			
			
			if($this->form_validation->run()==true){
				$lobbyImages 		= '';
				$lobbyPrimaryImage 	= '';
				if(!empty($_FILES['uploadedlobbyimages']['tmp_name'][0]))
				{
					$files 			= $_FILES['uploadedlobbyimages'];
					$errors 		= '';
					$total_files 	= count($_FILES['uploadedlobbyimages']['tmp_name']);
					/*for($i=0;$i<$total_files;$i++){
						if($_FILES['uploadedlobbyimages']['error'][$i] != 0){
						  $errors .= 'Couldn\'t upload file '.$_FILES['uploadedlobbyimages']['name'][$i];
						}
					}*/

					if(empty($errors)){
						$this->load->library('upload');
						$config['upload_path'] = FCPATH . 'uploads/room/lobby/';
						$config['allowed_types'] = 'gif|jpg|jpeg|png';
						for ($i = 0; $i < $total_files; $i++){
							$_FILES['uploadedlobbyimages']['name'] 		= $files['name'][$i];
							$_FILES['uploadedlobbyimages']['type'] 		= $files['type'][$i];
							$_FILES['uploadedlobbyimages']['tmp_name'] 	= $files['tmp_name'][$i];
							$_FILES['uploadedlobbyimages']['error'] 	= $files['error'][$i];
							$_FILES['uploadedlobbyimages']['size'] 		= $files['size'][$i];
							$this->upload->initialize($config);
							if($this->upload->do_upload('uploadedlobbyimages')){
								$uploads 		= $this->upload->data();
								if($postData['primary']==$i){
									$lobbyPrimaryImage = $uploads['file_name'];
								}
								$lobbyImages[$i] = $uploads['file_name'];
							}else{
								$errors .= $this->upload->display_errors();
							}
						}
					}
				}
				//lounge images
				$loungeImages 			= '';
				$loungePrimaryImage 	= '';
				if(!empty($_FILES['uploadedloungeimages']['tmp_name'][0]))
				{
					$files2 				= $_FILES['uploadedloungeimages'];
					
					$total_files2 			= count($_FILES['uploadedloungeimages']['tmp_name']);
					/*for($i=0;$i<$total_files2;$i++){
						if($_FILES['uploadedloungeimages']['error'][$i] != 0){
						  $errors .= 'Couldn\'t upload file '.$_FILES['uploadedloungeimages']['name'][$i];
						}
					}*/

					if(empty($errors)){
						$this->load->library('upload');
						$config2['upload_path'] = FCPATH . 'uploads/room/lounge/';
						$config2['allowed_types'] = 'gif|jpg|jpeg|png';
						for ($i = 0; $i < $total_files2; $i++){
							$_FILES['uploadedloungeimages']['name'] 		= $files2['name'][$i];
							$_FILES['uploadedloungeimages']['type'] 		= $files2['type'][$i];
							$_FILES['uploadedloungeimages']['tmp_name'] 	= $files2['tmp_name'][$i];
							$_FILES['uploadedloungeimages']['error'] 		= $files2['error'][$i];
							$_FILES['uploadedloungeimages']['size'] 		= $files2['size'][$i];
							$this->upload->initialize($config2);
							if($this->upload->do_upload('uploadedloungeimages')){
								$uploads2 		= $this->upload->data();
								if($postData['primary2']==$i){
									$loungePrimaryImage = $uploads2['file_name'];
								}
								$loungeImages[$i] = $uploads2['file_name'];
							}else{
								$errors .= $this->upload->display_errors();
							}
						}
					}
				}
				// reception images
				$receptionImages 			= '';
				$receptionPrimaryImage 		= '';
				if(!empty($_FILES['uploadedreceptionimages']['tmp_name'][0]))
				{
					$files3 					= $_FILES['uploadedreceptionimages'];
					
					$total_files3 				= count($_FILES['uploadedreceptionimages']['tmp_name']);
					/*for($i=0;$i<$total_files3;$i++){
						if($_FILES['uploadedreceptionimages']['error'][$i] != 0){
						  $errors .= 'Couldn\'t upload file '.$_FILES['uploadedreceptionimages']['name'][$i];
						}
					}*/

					if(empty($errors)){
						$this->load->library('upload');
						$config3['upload_path'] = FCPATH . 'uploads/room/reception/';
						$config3['allowed_types'] = 'gif|jpg|jpeg|png';
						for ($i = 0; $i < $total_files3; $i++){
							$_FILES['uploadedreceptionimages']['name'] 		= $files3['name'][$i];
							$_FILES['uploadedreceptionimages']['type'] 		= $files3['type'][$i];
							$_FILES['uploadedreceptionimages']['tmp_name'] 	= $files3['tmp_name'][$i];
							$_FILES['uploadedreceptionimages']['error'] 	= $files3['error'][$i];
							$_FILES['uploadedreceptionimages']['size'] 		= $files3['size'][$i];
							$this->upload->initialize($config3);
							if($this->upload->do_upload('uploadedreceptionimages')){
								$uploads3 		= $this->upload->data();
								if($postData['primary3']==$i){
									$receptionPrimaryImage = $uploads3['file_name'];
								}
								$receptionImages[$i] = $uploads3['file_name'];
							}else{
								$errors .= $this->upload->display_errors();
							}
						}
					}
				}
				if(empty($errors)){
					try{
						$room_info 						= array();
						$room_info['hotel_id'] 			= $hotel_id;
						$room_info['room_type'] 		= $postData['room_type'];
						$room_info['adults'] 			= $postData['adults'];
						$room_info['children']			= $postData['children'];
						$room_info['extra_beds'] 		= $postData['extra_beds'];
						$room_info['no_of_rooms'] 		= $postData['no_of_rooms'];
						$room_info['tmi_rooms'] 		= $postData['tmi_rooms'];
						$room_info['beds'] 				= $postData['beds'];
						$room_info['price'] 			= $postData['price'];
						$from_date 						= $postData['period_from'];
						$room_info['period_from'] 		= date('Y-m-d',strtotime($from_date));
						$to_date 						= $postData['period_to'];
						$room_info['period_to'] 		= date('Y-m-d',strtotime($to_date));
						$room_info['rate_category'] 	= $postData['rate_category'];
						$room_info['extra_bed_charge']	= $postData['extra_bed_charge'];
						if(!empty($postData['room_amenities'])){
							$room_info['room_amenities'] 	= implode(',',$postData['room_amenities']);
						}else{
							$room_info['room_amenities'] 	= '';
						}
						$room_info['cancellation_rule'] = $postData['cancellation_rule'];
						$room_info['status'] 			= $postData['status'];

						$insert 	= $this->Hotel_model->saveHotelRoom($room_info);
						if($insert){
							$this->Hotel_model->saveRoomImages($hotel_id,$insert,$lobbyPrimaryImage,$lobbyImages,$loungePrimaryImage,$loungeImages,$receptionPrimaryImage,$receptionImages);
							setMessage(' Hotel room added successfully','success');
							redirect('admin/hotels/hotelRooms/'.$hotel_id);
						}
					}catch(Exception $ex){
						load_message('error',' Hotel room is not inserted '.$ex->getMessage());
					}
				}else{
					setMessage($errors,'warning');
				}
				
			}else{
				setMessage(' '.Validation_errors(),'warning');
			}
        }

        $data['room_types']  			= $this->Common_model->getRoomTypes();
        $data['amenities'] 				= $this->Common_model->getAmenities($type=2);
        $data['rate_categories']		= $this->Common_model->getRateCategories();
        $data['cancellation_rules']		= $this->Common_model->getCancellationRules();
        $this->template->load('admin/base', 'admin/hotels/addhotelroom', $data);
	}


/**
	 * @Methode		-: editHotelRoom()
	 * @Description	-: This is used edit hotel room
	 * @Param		-: $id (int)
	 * @Created on	-: 08-09-2016
	 */

	public function editHotelRoom($hotel_id,$id)
	{
		if(!checkAccess($this->admin->accessLabelId,'hotels','edit rooms'))	
		{
    		setMessage($this->admin->accessDenidMessage,'warning');
    		redirect('admin/dashboard', 'refresh');	
		}

		if((empty($hotel_id) && !is_numeric($hotel_id)) && (empty($id) && !is_numeric($id)))
		{
			redirect('admin/hotels/hotelRooms/'.$hotel_id);
		}

		$data = array(
			'title' => 'Hotels',
			'list_heading' => 'Edit Hotel Room',
			'breadcrum' => '<li><a href="'.base_url('admin/hotels/hotelRooms/'.$hotel_id).'">Hotel Rooms</a></li>
			<li><a href="">Edit Hotel Room</a></li>',
		);

		$room 	= $this->Hotel_model->getRoomDetailsById($hotel_id,$id);
		if($room)
		{
			$data['room'] 		= $room;
			$lobbyPrimaryImage 	= $room['lobby_primary_image'];
			$lobbyimages 	 	= $room['lobby_images'];
			$lobbyImages 		= (!empty($lobbyimages))?explode(',',$lobbyimages):NULL;
			$loungePrimaryImage = $room['lounge_primary_image'];
			$loungeimages 	 	= $room['lounge_images'];
			$loungeImages 		= (!empty($loungeimages))?explode(',',$loungeimages):NULL;
			$receptionPrimaryImage = $room['reception_primary_image'];
			$receptionimages 	 	= $room['reception_images'];
			$receptionImages 		= (!empty($receptionimages))?explode(',',$receptionimages):NULL;

		}
		else
		{
			redirect('admin/hotels/hotelRooms/'.$hotel_id);
		}

		$postData = $this->input->post();
		if($postData){
        	
			$this->form_validation->set_rules('room_type', 'Room Type', 'trim|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('adults', 'Max Adults', 'trim|numeric|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('children', 'Max Children ', 'trim|numeric|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('extra_beds', 'Extra Beds', 'trim|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('no_of_rooms', 'Number of Rooms', 'trim|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('tmi_rooms', 'Number of TMI Rooms', 'trim|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('beds', 'Beds', 'trim|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('price', 'Price', 'trim|numeric|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('period_from', 'Period From', 'trim|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('period_to', 'Period To', 'trim|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('rate_category', 'Price Offer', 'trim|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('extra_bed_charge', 'Extra Bed Charge ', 'trim|numeric|required',array('required' => 'You must provide a %s.'));
			
			
			if($this->form_validation->run()==true){
				$errors 		= '';
				$totalLobbyImages = "";
				$totalLoungeImages = "";
				$totalReceptionImages = "";
				if(!empty($_FILES['uploadedlobbyimages']['tmp_name'][0]))
				{
					$files 			= $_FILES['uploadedlobbyimages'];

					$total_files 	= count($_FILES['uploadedlobbyimages']['tmp_name']);
					for($i=0;$i<$total_files;$i++){
						if($_FILES['uploadedlobbyimages']['error'][$i] != 0 ){
						  $errors .= 'Couldn\'t upload file '.$_FILES['uploadedlobbyimages']['name'][$i];
						}
					}

					if(empty($errors)){
						$this->load->library('upload');
						$config['upload_path'] = FCPATH . 'uploads/room/lobby/';
						$config['allowed_types'] = 'gif|jpg|jpeg|png';
						for ($i = 0; $i < $total_files; $i++){
							$_FILES['uploadedlobbyimages']['name'] 		= $files['name'][$i];
							$_FILES['uploadedlobbyimages']['type'] 		= $files['type'][$i];
							$_FILES['uploadedlobbyimages']['tmp_name'] 	= $files['tmp_name'][$i];
							$_FILES['uploadedlobbyimages']['error'] 	= $files['error'][$i];
							$_FILES['uploadedlobbyimages']['size'] 		= $files['size'][$i];
							$this->upload->initialize($config);
							if($this->upload->do_upload('uploadedlobbyimages')){
								$uploads 		= $this->upload->data();
								if($postData['primary']==$i){
									$lobbyPrimaryImage = $uploads['file_name'];
								}
								$totalRoomImages[$i] = $uploads['file_name'];
							}else{
								$errors .= $this->upload->display_errors();
							}

							$lobbyImages 	= $totalLobbyImages;								

						}
					}
				}

				if(!empty($_FILES['uploadedloungeimages']['tmp_name'][0]))
				{
					$files2 			= $_FILES['uploadedloungeimages'];

					$total_files2		= count($_FILES['uploadedloungeimages']['tmp_name']);
					for($i=0;$i<$total_files2;$i++){
						if($_FILES['uploadedloungeimages']['error'][$i] != 0 ){
						  $errors .= 'Couldn\'t upload file '.$_FILES['uploadedloungeimages']['name'][$i];
						}
					}

					if(empty($errors)){
						$this->load->library('upload');
						$config2['upload_path'] = FCPATH . 'uploads/room/lounge/';
						$config2['allowed_types'] = 'gif|jpg|jpeg|png';
						for ($i = 0; $i < $total_files2; $i++){
							$_FILES['uploadedloungeimages']['name'] 		= $files2['name'][$i];
							$_FILES['uploadedloungeimages']['type'] 		= $files2['type'][$i];
							$_FILES['uploadedloungeimages']['tmp_name'] 	= $files2['tmp_name'][$i];
							$_FILES['uploadedloungeimages']['error'] 		= $files2['error'][$i];
							$_FILES['uploadedloungeimages']['size'] 		= $files2['size'][$i];
							$this->upload->initialize($config2);
							if($this->upload->do_upload('uploadedloungeimages')){
								$uploads2 		= $this->upload->data();
								if($postData['primary2']==$i){
									$loungePrimaryImage = $uploads2['file_name'];
								}
								$totalLoungeImages[$i] = $uploads2['file_name'];
							}else{
								$errors .= $this->upload->display_errors();
							}

							$loungeImages 	= $totalLoungeImages;								

						}
					}
				}

				if(!empty($_FILES['uploadedreceptionimages']['tmp_name'][0]))
				{
					$files3				= $_FILES['uploadedreceptionimages'];

					$total_files3		= count($_FILES['uploadedreceptionimages']['tmp_name']);
					for($i=0;$i<$total_files3;$i++){
						if($_FILES['uploadedreceptionimages']['error'][$i] != 0 ){
						  $errors .= 'Couldn\'t upload file '.$_FILES['uploadedreceptionimages']['name'][$i];
						}
					}

					if(empty($errors)){
						$this->load->library('upload');
						$config3['upload_path'] = FCPATH . 'uploads/room/reception/';
						$config3['allowed_types'] = 'gif|jpg|jpeg|png';
						for ($i = 0; $i < $total_files3; $i++){
							$_FILES['uploadedreceptionimages']['name'] 		= $files3['name'][$i];
							$_FILES['uploadedreceptionimages']['type'] 		= $files3['type'][$i];
							$_FILES['uploadedreceptionimages']['tmp_name'] 	= $files3['tmp_name'][$i];
							$_FILES['uploadedreceptionimages']['error'] 	= $files3['error'][$i];
							$_FILES['uploadedreceptionimages']['size'] 		= $files3['size'][$i];
							$this->upload->initialize($config3);
							if($this->upload->do_upload('uploadedreceptionimages')){
								$uploads3 		= $this->upload->data();
								if($postData['primary3']==$i){
									$receptionPrimaryImage = $uploads3['file_name'];
								}
								$totalReceptionImages[$i] = $uploads3['file_name'];
							}else{
								$errors .= $this->upload->display_errors();
							}

							$receptionImages 	= $totalReceptionImages;								

						}
					}
				}
				
				if(empty($errors)){
					try{
						$room_info 						= array();
						$room_info['hotel_id'] 			= $hotel_id;
						$room_info['room_type'] 		= $postData['room_type'];
						$room_info['adults'] 			= $postData['adults'];
						$room_info['children']			= $postData['children'];
						$room_info['extra_beds'] 		= $postData['extra_beds'];
						$room_info['no_of_rooms'] 		= $postData['no_of_rooms'];
						$room_info['tmi_rooms'] 		= $postData['tmi_rooms'];
						$room_info['beds'] 				= $postData['beds'];
						$room_info['price'] 			= $postData['price'];
						$from_date 						= $postData['period_from'];
						$room_info['period_from'] 		= date('Y-m-d',strtotime($from_date));
						$to_date 						= $postData['period_to'];
						$room_info['period_to'] 		= date('Y-m-d',strtotime($to_date));
						$room_info['rate_category'] 	= $postData['rate_category'];
						$room_info['extra_bed_charge']	= $postData['extra_bed_charge'];
						if(!empty($postData['room_amenities'])){
							$room_info['room_amenities'] 	= implode(',',$postData['room_amenities']);
						}else{
							$room_info['room_amenities'] 	= '';
						}
						$room_info['cancellation_rule'] = $postData['cancellation_rule'];
						$room_info['status'] 			= $postData['status'];

						if(!empty($lobbyImages)){
							foreach($lobbyImages as $key=>$img){
								if(!empty($postData['primary']) && $postData['primary']==$key){
									$lobbyPrimaryImage = $img;
								}
								$lobbyImages[$key] = $img;
							}
						}

						if(!empty($loungeImages)){
							foreach($loungeImages as $key2=>$img2){
								if(!empty($postData['primary2']) && $postData['primary2']==$key2){
									$loungePrimaryImage = $img2;
								}
								$loungeImages[$key] = $img2;
							}
						}
						if(!empty($receptionImages)){
							foreach($receptionImages as $key3=>$img3){
								if(!empty($postData['primary3']) && $postData['primary3']==$key3){
									$receptionPrimaryImage = $img3;
								}
								$receptionImages[$key] = $img3;
							}
						}

						$update 	= $this->Hotel_model->saveHotelRoom($room_info,$id);
						if($update){
							if(!empty($totalLobbyImages) || !empty($totalLoungeImages) || !empty($totalReceptionImages)){
								$this->Hotel_model->saveRoomImages($hotel_id,$id,$lobbyPrimaryImage,$lobbyImages,$loungePrimaryImage,$loungeImages,$receptionPrimaryImage,$receptionImages);
							}
							
							setMessage(' Hotel room updated successfully','success');
							redirect('admin/hotels/hotelRooms/'.$hotel_id);
						}
					}catch(Exception $ex){
						load_message('error',' Hotel room is not updated '.$ex->getMessage());
					}
				}else{
					setMessage($errors,'warning');
				}
				
			}else{
				setMessage(' '.Validation_errors(),'warning');
			}
        }

		$data['room_types']  	= $this->Common_model->getRoomTypes();
        $data['amenities'] 		= $this->Common_model->getAmenities($type=2);
        $data['rate_categories']= $this->Common_model->getRateCategories();
        $data['cancellation_rules']	= $this->Common_model->getCancellationRules();
        $this->template->load('admin/base', 'admin/hotels/editroom', $data);
	}

	/**
	 * @Method		-: deleteHotelRoom()
	 * @Description	-: This function used to remove hotel room
	 * @Created		-: 08-09-2016
	 */ 
	public function deleteHotelRoom()
	{
		if(!checkAccess($this->admin->accessLabelId,'hotels','delete rooms'))	
		{
			log_message('error','You have not a permission to remove hotel room'.$ex->getMessage());
    		echo "FALSE";
    		exit;
		}
		$room_id 	= $this->input->post('room_id');
		try{
			$delete = $this->Hotel_model->deleteHotelRoom($room_id); 
			if($delete)
			{
				echo "TRUE";
			}

		}catch(Exception $ex){
			log_message('error','Hotel did not remove'.$ex->getMessage());
			echo "FALSE";
		}
	}

	/**
	 * @Method		-: getHotelsByAjax()
	 * @Description	-: This function used to serach hotels by ajax
	 * @Created		-: 15-09-2016
	 */

	 public function getHotelsByAjax(){
	 	$hotel_type 	= $this->input->post('hotel_type');
	 	$hotel_name 	= $this->input->post('hotel_name');
	 	$location 		= $this->input->post('location');

	 	$pageNumber		= $this->input->post('page_number');
		$page_number 	= !empty($pageNumber) ? $pageNumber :0;

		$totalRow 		= $this->Hotel_model->getAllHotels($hotel_type,$hotel_name,$location);

		$data['totalRecords'] = $totalRow;
		$data['limit'] = $this->limit;
		if($page_number > 0)
		{
			$page 	= ($page_number)*$this->limit;
		}
		else
		{
			$page 	= $page_number;
		}
		
		$total_page = ceil($totalRow/$this->limit);
		$data['recordsFrom'] = $page;
		$data['total_page']  = $total_page;
		
		$page 			= (empty($page)) ? 'P' : $page;
		$results 		= $this->Hotel_model->getAllHotels($hotel_type,$hotel_name,$location,$page);
		$html 			= '';
		$links          = '';
		if (!empty($results)) {
             foreach ($results as $hotel) {
				$hotel_type     = getHotelTypeById($hotel['hotel_type']);
				if($hotel['star_rating'] == '1'){
                    $star_rating    = '*';
                }elseif($hotel['star_rating'] == '2'){
                    $star_rating    = '**';
                }elseif($hotel['star_rating'] == '3'){
                    $star_rating    = '***';
                }elseif($hotel['star_rating'] == '4'){
                    $star_rating    = '****';
                }elseif($hotel['star_rating'] == '5'){
                    $star_rating    = '*****';
                }else{
                    $star_rating    = 'N/A';
                }

                 $city = getCityById($hotel['city']);

                 if(!empty($hotel['hotel_status']) && $hotel['hotel_status'] == '1'){
                 	$status = 'Active';
                 }else{
                 	$status = 'Inactive';
                 }
				 
		
			$html.='<tr id="'.$hotel['hotel_id'].'">
				<td>
					<span class="view_mode'.$hotel['hotel_id'].'">'.$hotel['hotel_name'].'</span>
                </td>
                <td>
					<span class="view_mode'.$hotel['hotel_id'].'">'.$hotel_type.'</span>
					
				</td>
                <td>
					<span class="view_mode'.$hotel['hotel_id'].'">'.$star_rating.'</span>
				</td>
				<td>
					<span class="view_mode'.$hotel['hotel_id'].'">'.$city.'</span>
				</td>
                <td>
                    <span class="view_mode'.$hotel['hotel_id'].'">'.$hotel['price'].'</span>
                </td>
				<td>
					<span class="view_mode'.$hotel['hotel_id'].'">'.$hotel['no_of_rooms'].'</span>
				</td>
                
				<td>
					<span class="view_mode'.$hotel['hotel_id'].'">'.$hotel['tmi_rooms'].'</span>
				</td>
                <td>
                    <span class="view_mode'.$hotel['hotel_id'].'">'.$status.'</span>
                </td>
                
				<td>
					<a class="btn btn-success commonBtn" data-type ="edit" data-row-id="'.'hotel_'.$hotel['hotel_id'].'" data-id="'.$hotel['hotel_id'].'" href="'.base_url("admin/hotels/editHotel/".$hotel['hotel_id']).'">Edit</a>
                    <a class="btn btn-success commonBtn" data-type ="edit" data-row-id="'.'hotel_'.$hotel['hotel_id'].'" data-id="'.$hotel['hotel_id'].'" href="'.base_url('admin/hotels/hotelRooms/'.$hotel['hotel_id']).'">Manage Rooms</a>
					<a class="delete btn btn-sm btn-danger" data-target="#confirm-delete" data-toggle="modal" data-record-title="'.$hotel['hotel_name'].'" data-type="delete" data-record-id="'.$hotel['hotel_id'].'" data-remove-row="'.'hotel_'.$hotel['hotel_id'].'" href="javascript:void(0)" >Delete</a>
				</td>
            </tr>';
            	} 
            	$links  .= ($page_number==0)?'<li class="paginate_button previous"><a href="javascript:void(0)" id="previous" style="display:none">Previous</a></li>':'<li class="paginate_button previous"><a href="javascript:void(0)" rel="'.($page_number-1).'" id="previous">Previous</a></li>';	 	
				for($i=1;$i<=$total_page;$i++)
				{
					if($page_number == $i-1)
					{
						$active = 'active';
					}
					else
					{
						$active = '';
					}
					
					$links 			.= '<li class="paginate_button '.$active.'"><a href="javascript:void(0)" class="page_num_click" rel="'.($i-1).'">'.$i.'</a></li>';
				}
				$links  			.= ($page_number==($total_page-1))?'<li class="paginate_button next"><a href="javascript:void(0)" id="next" style="display:none">Next</a></li>':'<li class="paginate_button next"><a href="javascript:void(0)" rel="'.($page_number+1).'" id="next">Next</a></li>';

            }else{ 
				$html.='<tr>
					<td colspan="9" align="center">
						<span>No Records Found</span>
					</td>
				</tr>';
			 	} 
		
		
		
		$data['links']  = $links;
		$data['hotels'] = $html;
		echo json_encode($data);
	 }

	public function getPricesByHotel(){
		$hotel_id 	= $this->input->post('hotel_id');

		$room_types = $this->Common_model->getRoomDetailsByHotel($hotel_id);
		echo $this->db->last_query();
		$html 		= '';
		if(!empty($room_types)){
			foreach($room_types as $room_type){
				$html .= '<tr>';
				$html .= '<td>'.$room_type['room_type'].'</td>';
				$html .= '<td>'.$room_type['price'].' with <a href="javascript:void(0)" data-toggle="tooltip" title="'.$room_type['category_type'].'">'.$room_type['meal_plan'].'</td>';
				$html .= '</tr>';
			}
		}else{
			$html .= '<tr>';
			$html .= '<td colspan="2">No room type available for this hotel</td>';
			$html .= '</tr>';
		}

		echo $html;
		die;
	}

	public function roomAvailability($hotel_id,$id){
		if(!checkAccess($this->admin->accessLabelId,'hotels','view calendar'))	
		{
    		setMessage($this->admin->accessDenidMessage,'warning');
    		redirect('admin/dashboard', 'refresh');	
		}

		if((empty($id) && !is_numeric($id)))
		{
			redirect('admin/hotels/hotelRooms/'.$hotel_id);
		}

		$data = array(
			'title' => 'Rooms Availability',
			'list_heading' => 'Rooms Availability',
			'breadcrum' => '<li><a href="'.base_url('admin/hotels/hotelRooms/'.$hotel_id).'">Hotel Rooms</a></li>
			<li><a href="javascript:void(0)">Rooms Availability</a></li>',
		);

		$data['room_details'] = $this->Common_model->getRoomDetailsByHotel($hotel_id);

		$this->template->load('admin/base', 'admin/hotels/availability', $data);
	} 

	public function getRoomAvailabilityData(){
		$hotel_id 		= $this->input->post('hotel_id');
		$id 	 		= $this->input->post('id');
		$month 			= $this->input->post('month');
		$year 			= $this->input->post('year');
		$this->load->library('calendar');
		
		$room 					= $this->Common_model->getRoomDetailsById($hotel_id,$id);

		$details                = array();
        $room_type              = getRoomTypeById($room['room_type']);
        $days_in_month          = $this->calendar->get_total_days($month,$year);
        $temp       = array();
        $available  	= 0;
        $booked_rooms 	= 0;
        $blocked_rooms 	= 0;
        for($i=1;$i<=$days_in_month;$i++){
        	$fromDate 			 = date('Y-m-d',strtotime($year.'-'.$month.'-'.$i));
        	$toDate 			 = date('Y-m-d',strtotime($year.'-'.$month.'-'.$i));
        	$reserved 			 = $this->Common_model->getReservedRoom($id,$fromDate,$toDate);
        	
        	if(!empty($reserved)){
        		$total_booked    = $reserved['booked_rooms']+$reserved['blocked_rooms'];
        		$available  	 = $room['no_of_rooms']-$total_booked; 
        		$booked_rooms    = $reserved['booked_rooms'];
        		$blocked_rooms   = $reserved['blocked_rooms'];
        	}
        	else
        	{
        		$available  	 = $room['no_of_rooms'];
        		$booked_rooms 	 = 0;
        		$blocked_rooms 	 = 0;
        	}

        	$fast_filling 		 = ($room['no_of_rooms']*80)/100;


            $temp['title']       = $room['room_type']."\n"."Booked Rooms: ".(int)$booked_rooms."\n"."Blocked Rooms: ".(int)$blocked_rooms;
            $temp['start']       = $year.','.$month.','.$i;
            $temp['end']         = $year.','.$month.','.$i;
            $temp['allDay']      = true;
            $temp['description'] = '<b>Available</b> - '.$available;
            if($available == $room['no_of_rooms'] || $total_booked <= $fast_filling){
            	$temp['textColor'] 		 	 = '#FFFFFF';
            	$temp['backgroundColor'] 	 = '#008000';
            }
            if($total_booked >= $fast_filling && $available != '0'){
            	$temp['textColor'] 		 	 = '#FFFFFF';
            	$temp['backgroundColor'] 	 = '#FFD700';
            }
            if($available == '0'){
            	$temp['textColor'] 		 	 = '#FFFFFF';
            	$temp['backgroundColor']  	 = '#FF0000';
            }
            
            

            array_push($details,$temp);
        }

        echo json_encode($details);
        exit;
	}

	public function reserveRoom(){
		if($this->input->post('type') == 'edit'){
		$hotel_id 		= $this->input->post('hotel_id');
		$id 	 		= $this->input->post('id');
		$from_date 		= $this->input->post('from_date');
		$to_date 		= $this->input->post('to_date');
		$no_of_rooms	= $this->input->post('no_of_rooms');

		$room 			= $this->Common_model->getRoomDetailsById($hotel_id,$id);
		if(!empty($room)){
				$reserved 			 = $this->Common_model->getReservedRoom($id,$from_date,$to_date);
				if(!empty($reserved)){
					$admin_availability  = $room['no_of_rooms']-$reserved['booked_rooms'];
					$total_available     = $room['no_of_rooms']-$reserved['booked_rooms']-$reserved['blocked_rooms'];
				}else{
					$admin_availability = $room['no_of_rooms'];
					$total_available    = $room['no_of_rooms'];
				}

				if($no_of_rooms <= $total_available){
					$data['blocked_rooms'] = $total_available - $no_of_rooms;
					$data['hotel_id']      = $hotel_id;
					$data['room_type']     = $id;
					$data['from_date'] 	   = $from_date;
					$data['to_date'] 	   = $to_date;
					$data['user_id'] 	   = $this->ion_auth->get_user_id();
					
					if($total_available!='0' && $no_of_rooms != '0'){
						$result 	= $this->Hotel_model->saveBookingData($data);
						if($result){
							echo json_encode(array('status'=>'success','rooms'=>$no_of_rooms));
							exit;
						}
					}else{
						echo json_encode(array('status'=>'failed','rooms'=>$total_available,'capacity'=>$admin_availability));
						exit;
					}
				}else{
					echo json_encode(array('status'=>'failed','rooms'=>$total_available,'capacity'=>$admin_availability));
					exit;
				}
			}

		}
		if($this->input->post('type') == 'search'){
			$hotel_id 		= $this->input->post('hotel_id');
			$id 	 		= $this->input->post('id');
			$from_date 		= $this->input->post('from_date');
			$to_date 		= $this->input->post('to_date');
			$no_of_rooms	= $this->input->post('no_of_rooms');
			$reserve_type   = $this->input->post('reserve_type');

			$room 			= $this->Common_model->getRoomDetailsById($hotel_id,$id);
			if(!empty($room)){
					$reserved 			 = $this->Common_model->getReservedRoom($id,$from_date,$to_date);

					if(!empty($reserved)){
						$admin_availability  = $room['no_of_rooms']-$reserved['booked_rooms'];
						$total_available  = $room['no_of_rooms']-$reserved['booked_rooms']-$reserved['blocked_rooms'];
					}else{
						$admin_availability = $room['no_of_rooms'];
						$total_available  = $room['no_of_rooms'];
					}
					
					if($no_of_rooms <= $total_available){
						$data['blocked_rooms'] = $no_of_rooms;
						$data['hotel_id']      = $hotel_id;
						$data['room_type']     = $id;
						$data['from_date'] 	   = $from_date;
						$data['to_date'] 	   = $to_date;
						$data['user_id'] 	   = $this->ion_auth->get_user_id();
						$data['reserve_type']  = $reserve_type;
						$result 	= $this->Hotel_model->saveBookingData($data);
						if($result){
							echo json_encode(array('status'=>'success','rooms'=>$no_of_rooms));
							exit;
						}
					}else{
						echo json_encode(array('status'=>'failed','rooms'=>$total_available,'capacity'=>$admin_availability));
						exit;
					}
				}

		}
		
	}


}

?>