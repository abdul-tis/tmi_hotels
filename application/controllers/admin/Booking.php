<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('Common_model');
        $this->load->model('Booking_model');
        $this->load->model('Hotel_model');
        $this->load->library('form_validation');
        if (!$this->ion_auth->logged_in()) {
            redirect('admin/auth/login', 'refresh');
        }
        $this->load->library(array('pagination','admin'));
        
        $this->limit = 10;

        if(!checkAccess($this->admin->accessLabelId,'booking','view'))	
		{
    		setMessage($this->admin->accessDenidMessage,'warning');
    		redirect('admin/dashboard', 'refresh');	
		}	
    }

    /**
 * @Method		-: index()
 * @Description	-: This function used to for display all bookings
 * @Created		-: 28-09-2016
 */  
	public function index($offset=0) 
	{
		$data = array(
			'title' => 'Bookings',
			'list_heading' => 'Bookings',
			'breadcrum' => '<li><a href="'.base_url('admin/booking/index').'">Bookings</a></li>',
		);

			$totalRow 	= $this->Booking_model->getAllBookings();
			
			$config 					= array();
			$data['totalRecords'] 		= $totalRow;
			$data['limit'] 				= $this->limit;
			$config["base_url"] 		= base_url('admin/booking/index/');
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

		$data['bookings']  		= $this->Booking_model->getAllBookings($page);
		
		$this->template->load('admin/base', 'admin/bookings/booking', $data);
	}

	/**
	 * @Method		-: addHotel()
	 * @Description	-: This function used to display all hotels
	 * @Created		-: 05-09-2016
	 */  
	public function makeBooking(){
		if(!checkAccess($this->admin->accessLabelId,'booking','add'))	
		{
    		setMessage($this->admin->accessDenidMessage,'warning');
    		redirect('admin/dashboard', 'refresh');	
		}	
		$data = array(
            'title' => 'Bookings',
            'list_heading' => 'Make Booking',
            'breadcrum' => '<li><a href="'.base_url('admin/booking').'">Bookings</a></li>
            <li><a href="'.base_url('admin/booking/makeBooking').'">Make Booking</a></li>',
        );

        $postData = $this->input->post();
        if($postData){
        	$this->form_validation->set_rules('name', 'Name', 'trim|required',array('required' => 'You must provide a %s.'));
        	$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email',array('required' => 'You must provide a %s.'));
        	$this->form_validation->set_rules('phone', 'Phone', 'trim|required|regex_match[/^[0-9]{10}$/]',array('required' => 'You must provide a %s.'));
        	$this->form_validation->set_rules('from_date', 'Checkin Date', 'trim|required',array('required' => 'You must provide a %s.'));
        	$this->form_validation->set_rules('to_date', 'Checkout Date', 'trim|required',array('required' => 'You must provide a %s.'));
        	$this->form_validation->set_rules('hotel_id', 'Hotel', 'trim|required',array('required' => 'You must provide a %s.'));
        	$this->form_validation->set_rules('room_type', 'Room Type', 'trim|required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('no_of_rooms', 'No of Rooms', 'trim|required',array('required' => 'You must provide a %s.'));

			if($this->form_validation->run()==true){
				$total_price 		= 0;
				$extra_bed_charge   = 0;
				$coupon_dis 		= 0;
				$campaign_dis 		= 0;
				$reservation 				= array();
				$booking_info 				= array();
				$customer 					= array();
				//customer array
				$customer['name']			= $postData['name'];
				$customer['email']			= $postData['email'];
				$customer['phone']			= $postData['phone'];
				//reserve array
				$reservation['hotel_id']    = $postData['hotel_id'];
				$reservation['room_type']   = $postData['room_type'];
				$reservation['booked_rooms']= $postData['no_of_rooms'];
 				$reservation['from_date'] 	= date('Y-m-d',strtotime($postData['from_date']));
				$reservation['to_date'] 	= date('Y-m-d',strtotime($postData['to_date']));
				$reservation['reserve_type']= '3';

				//booking details
				if(!empty($postData['adults'])){
					$adults 				= array_sum($postData['adults']);
				}else{
					$adults 				= 0;
				}
				if(!empty($postData['children'])){
					$children 				= array_sum($postData['children']);
				}else{
					$children 				= 0;
				}
				$booking_info['adult'] 		= $adults;
				$booking_info['children'] 	= $children;
				$booking_info['extra_bed']  = $postData['extra_beds'];
				$booking_info['booked_by'] 	= $postData['booked_by'];
				$booking_info['coupon_id']  = $postData['coupon_id'];
				$booking_info['campaign_id']  = $postData['campaign_id'];
				$booking_info['booked_by_user_id'] 	= $this->ion_auth->get_user_id();
				$booking_info['status'] 			= '0'; 
				$booking_info['booking_date'] 		= date('Y-m-d H:i:s'); 

				$room  					= $this->Common_model->getRoomDetailsById($reservation['hotel_id'],$reservation['room_type']);

				$reserved 			 	= $this->Common_model->getReservedRoom($reservation['room_type'],$reservation['from_date'],$reservation['to_date']);
				if(!empty($reserved)){
					$total_available  = $room['no_of_rooms']-$reserved['booked_rooms']-$reserved['blocked_rooms'];
				}else{
					$total_available  = $room['no_of_rooms'];
				}

				if($reservation['booked_rooms'] <= $total_available){
					$total_price 	= $reservation['booked_rooms']*$room['price'];
					if($booking_info['extra_bed'] > 0){
						$extra_bed_charge 	= $booking_info['extra_bed']*$room['extra_bed_charge'];
					}else{
						$extra_bed_charge   = 0;
					}
					$total_price 			+= $extra_bed_charge;
					if(!empty($booking_info['coupon_id'])){
						$coupon 	= $this->Common_model->getCouponById($booking_info['coupon_id']);
						if($coupon){
							$coupon_dis  = ($total_price*$coupon['discount'])/100;
							$total_price = $total_price - $coupon_dis;
						}
					}

					if(!empty($booking_info['campaign_id'])){
						$campaign 	= $this->Common_model->getCampaignById($booking_info['campaign_id']);
						if($campaign){
							$campaign_dis  = ($total_price*$campaign['discount'])/100;
							$total_price = $total_price - $campaign_dis;
						}
					}

					
					$booking_info['total_amount'] = $total_price; 

					$insert 	= $this->Hotel_model->saveBookingData($reservation);
					if($insert){
						$booking_info['reservation_id'] = $insert;
						$booking_info['booking_number'] = hexdec(substr(uniqid(),0,7)).$insert;
						$customer = $this->Booking_model->saveCustomer($customer);
						if($customer){
							$booking_info['customer_id']	= $customer;
							$this->Booking_model->saveBookingDetails($booking_info);

						}
						setMessage(' Hotel booking successfully','success');
						redirect('admin/booking');
					}
				}else{
					setMessage('Rooms Unavailable for selected room type','warning');
				}  

			}else{
				setMessage(' '.Validation_errors(),'warning');
			}
    	}

    	$data['coupons'] 	= $this->Common_model->getActiveCoupons();
    	$data['campaigns'] 	= $this->Common_model->getActiveCampaigns();
    	$this->template->load('admin/base', 'admin/bookings/makebooking', $data);
	}

	public function getHotelsByLocation(){
		$location 	= $this->input->post('location');
		if(!empty($location)){
			$hotels 	= $this->Common_model->getHotelsByLocality($location);

			$html       = '';
			if(!empty($hotels)){
				$html       .= '<option value="">Select Hotel</option>';
				foreach($hotels as $hotel){
					$html .= '<option value="'.$hotel['hotel_id'].'">'.$hotel['hotel_name'].'</option>';
				}
			}else{
				$html .= '<option value="">No hotel found!</option>';
			}

			echo $html;
			exit;

		}
	}

	public function getRoomDetailsByHotel(){
		$hotel_id 			= $this->input->post('hotel_id');
		if(!empty($hotel_id)){
			$rooms  		= $this->Common_model->getRoomDetailsByHotel($hotel_id);
			$room_type_html = '';
			$count = 0;
			if(!empty($rooms)){
				$room_type_html .= '<option value="">Select Room Type</option>';
				foreach($rooms as $room){
					$count++;
					if($count == 1){
						$selected = "selected";
					}else{
						$selected = "";
					}

					$room_type_html .= '<option value="'.$room['type_id'].'" '.$selected.'>'.$room['room_type_name'].' with '.$room['category_type'].'</option>';
				}
			}else{
				$room_type_html .= '<option value="">Select Room Type</option>';
			}

			echo $room_type_html;
			exit;
		}

		
	}

	public function getRoomDetailsById(){
		$hotel_id 			= $this->input->post('hotel_id');
		$room_type 			= $this->input->post('room_type');
		if((!empty($room_type)) && (!empty($hotel_id))){
			$room  			= $this->Common_model->getRoomDetailsById($hotel_id,$room_type);
			$adult 			= '';
			$children 		= '';
			$extra_beds 	= '';
			$no_of_rooms    = '';
			$data  			= array();
			if(!empty($room) && $room['no_of_rooms'] > 0){
				$children 	.= '<option value="0">0</option>';
				$extra_beds .= '<option value="0">0</option>';
				if($room['adults'] > 0){
					for($i=1;$i<=$room['adults'];$i++){
						$adult .= '<option value="'.$i.'">'.$i.'</option>';
					}
				}

				if($room['children'] > 0){
					for($j=1;$j<=$room['children'];$j++){
						$children .= '<option value="'.$j.'">'.$j.'</option>';
					}
				}

				if($room['extra_beds'] > 0){
					for($k=1;$k<=$room['extra_beds'];$k++){
						$extra_beds .= '<option value="'.$k.'">'.$k.'</option>';
					}
				}

				if($room['no_of_rooms'] > 0){
					for($l=1;$l<=$room['no_of_rooms'];$l++){
						$no_of_rooms .= '<option value="'.$l.'">'.$l.'</option>';
					}
				}
				
			}else{
				$adult 		.= '<option value="">No adult found</option>';
				$children 	.= '<option value="">0</option>';
				$extra_beds .= '<option value="">0</option>';
				$no_of_rooms.= '<option value="">No rooms found</option>';
			}
			$data['adult_html']  		= $adult;
			$data['children_html']  	= $children;
			$data['extra_beds_html']  	= $extra_beds;
			$data['rooms_html']  		= $no_of_rooms;
			$data['price'] 				= $room['price'];
			echo json_encode($data);
			exit;
		}
	}

	public function getUpdatedPrice(){
		$hotel_id 			= $this->input->post('hotel_id');
		$room_type 			= $this->input->post('room_type');
		$no_of_rooms 		= $this->input->post('no_of_rooms');
		$extra_beds 		= $this->input->post('extra_beds');
		$coupon_id 			= $this->input->post('coupon_id');
		$campaign_id 			= $this->input->post('campaign_id');
		$total_price 		= 0;
		$extra_bed_charge   = 0;
		$coupon_dis 		= 0;
		$campaign_dis 		= 0;
		if(!empty($hotel_id) && !empty($room_type)){
			$room  			= $this->Common_model->getRoomDetailsById($hotel_id,$room_type);

			if(!empty($room)){
				$total_price = $no_of_rooms*$room['price'];

				if($extra_beds > 0){
					$extra_bed_charge = $extra_beds*$room['extra_bed_charge'];
					$total_price += $extra_bed_charge; 
				}

				if(!empty($coupon_id)){
					$coupon 	= $this->Common_model->getCouponById($coupon_id);
					if($coupon){
						$coupon_dis  = ($total_price*$coupon['discount'])/100;
						$total_price = $total_price - $coupon_dis;
					}
				}

				if(!empty($campaign_id)){
					$campaign 	= $this->Common_model->getCampaignById($campaign_id);
					if($campaign){
						$campaign_dis  = ($total_price*$campaign['discount'])/100;
						$total_price = $total_price - $campaign_dis;
					}
				}

			}else{
				$total_price = "Price not available!";	
			}
			
			echo $total_price;
			exit;
		}else{
			echo "Rooms Unavailable";
			exit;
		}
	}

	public function checkRoomAvailability(){
		$hotel_id 			= $this->input->post('hotel_id');
		$room_type 			= $this->input->post('room_type');
		$no_of_rooms 		= $this->input->post('no_of_rooms');
		$from_date 			= $this->input->post('from_date');
		$from_date  		= date('Y-m-d',strtotime($from_date));
		$to_date 			= $this->input->post('to_date');
		$to_date  			= date('Y-m-d',strtotime($to_date));

		$total_price 		= 0;
		$data  				= array();
		if(!empty($hotel_id) && !empty($room_type)){
			$room  			= $this->Common_model->getRoomDetailsById($hotel_id,$room_type);
			if(!empty($room) && $room['no_of_rooms'] > 0){
				$reserved 			 = $this->Common_model->getReservedRoom($room_type,$from_date,$to_date);
				if(!empty($reserved)){
					$total_available  = $room['no_of_rooms']-$reserved['booked_rooms']-$reserved['blocked_rooms'];
				}else{
					$total_available  = $room['no_of_rooms'];
				}

				if($no_of_rooms <= $total_available){
					$adult 			= '';
					$children 		= '';
					$children 	.= '<option value="0">0</option>';
					
					if($room['adults'] > 0){
						for($i=1;$i<=$room['adults'];$i++){
							$adult .= '<option value="'.$i.'">'.$i.'</option>';
						}
					}

					if($room['children'] > 0){
						for($j=1;$j<=$room['children'];$j++){
							$children .= '<option value="'.$j.'">'.$j.'</option>';
						}
					}
					$total_price 				= $no_of_rooms*$room['price'];
					$data['adult_html']  		= $adult;
					$data['children_html']  	= $children;
					$data['price'] 				= $total_price;
					$data['status'] 			= '1';
					
				}else{
					$data['status'] 			= '0';
				}
			}else{
				$data['status'] 			= '2';
			}
			echo json_encode($data);
			exit;
		}


	}

}

?>