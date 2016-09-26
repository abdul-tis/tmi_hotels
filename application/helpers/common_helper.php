<?php

/**
 * @Description -: This function used to remove extraspaces from givven string 
 * @Param		-: String ($str)
 * @Created on	-: 16-06-2016
 * @Return		-: String
 */ 
	function removeExtraspace($data) {
		$returnData = array();
		foreach($data as $k=>$v){
			if(is_array($v)){
				removeExtraspace($v);
			}else{
				$trimstr = trim($v);
				$val = preg_replace('/\s+/', ' ', $trimstr);
				$returnData[$k] = $val;
			}
		}
		return $returnData;
	}
	

/**
 * @Description -: This function used to print a variable with more details
 * @Param		-: String (Array/String/Int)
 * @Created on	-: 05-09-2016
 */ 

	function dump($array = array()){
		echo '<pre>';
		print_r($array);
		echo '</pre>';
	}

    /**
     * Sets a status message (for displaying small success/error messages).
     * This is used in place of the session->flashdata functions since you
     * don't always want to have to refresh the page to show the message.
     *
     * @param string $message The message to save.
     * @param string $type The string to be included as the CSS class of the containing div.
     */
    function setMessage($message = '', $type = 'info'){
		$CI = & get_instance();
        if (! empty($message)) {
			//dump($CI->session);
            if (isset($CI->session)) {
                $CI->session->set_flashdata('message', $type . '::' . $message);
            }
            $flashdata= array(
                'message_type' => $type,
                'message' => $message
            );
            $CI->session->set_userdata($flashdata);
        }
    }
    

    /**
     * Sets a data variable to be sent to the view during the render() method.
     *
     * @param string $name
     * @param mixed $value
     */
    function setVar($name, $value = null){
        if (is_array($name)) {
            foreach ($name as $k => $v) {
                $this->vars[$k] = $v;
            }
        } else {
            $this->vars[$name] = $value;
        }
    }

    /**
	 * @Function	-: getHotelTypeById()
	 * @Description	-: This function used hotel type by id
	 * @Param		-: $id (Int)
	 * @Created on	-: 07-09-2016
	 */ 
	function getHotelTypeById($id=0){
		if(empty($id) || !is_numeric($id)){
			return false;
		}
		$CI = & get_instance();
		try{
			$hotel_type = $CI->db->select('hotel_type')->where('id',$id)->get('hotel_type')->row_array();
			if($hotel_type){
				return $hotel_type['hotel_type'];
			}
		}catch(Exception $ex){
			log_message('error',' We are not getting product name correct '.$ex->getMessage());
			return false;
		}
	}

	/**
	 * @Function	-: getCountryById()
	 * @Description	-: This function used to get country name by id
	 * @Param		-: $id (Int)
	 * @Created on	-: 07-09-2016
	 */ 
	function getCountryById($id=0){
		if(empty($id) || !is_numeric($id)){
			return false;
		}
		$CI = & get_instance();
		try{
			$country = $CI->db->select('country_name')->where('id',$id)->get('country')->row_array();
			if($country){
				return $country['country_name'];
			}
		}catch(Exception $ex){
			log_message('error',' We are not getting product name correct '.$ex->getMessage());
			return false;
		}
	}

	/**
	 * @Function	-: getStateById()
	 * @Description	-: This function used to get state name by id
	 * @Param		-: $id (Int)
	 * @Created on	-: 07-09-2016
	 */ 
	function getStateById($id=0){
		if(empty($id) || !is_numeric($id)){
			return false;
		}
		$CI = & get_instance();
		try{
			$state = $CI->db->select('state_name')->where('id',$id)->get('state')->row_array();
			if($state){
				return $state['state_name'];
			}
		}catch(Exception $ex){
			log_message('error',' We are not getting product name correct '.$ex->getMessage());
			return false;
		}
	}

	/**
	 * @Function	-: getCityById()
	 * @Description	-: This function used to get city name by id
	 * @Param		-: $id (Int)
	 * @Created on	-: 07-09-2016
	 */ 
	function getCityById($id=0){
		if(empty($id) || !is_numeric($id)){
			return false;
		}
		$CI = & get_instance();
		try{
			$city = $CI->db->select('city_name')->where('id',$id)->get('cities')->row_array();
			if($city){
				return $city['city_name'];
			}
		}catch(Exception $ex){
			log_message('error',' We are not getting product name correct '.$ex->getMessage());
			return false;
		}
	}

	/**
	 * @Function	-: getHotelNameById()
	 * @Description	-: This function is used to get hotel name by id
	 * @Param		-: $id (Int)
	 * @Created on	-: 07-09-2016
	 */ 
	function getHotelNameById($id=0)
	{
		if(empty($id) || !is_numeric($id)){
			return false;
		}
		$CI = & get_instance();
		try{
			$hotel = $CI->db->select('hotel_name')->where('hotel_id',$id)->get('hotel')->row_array();
			if($hotel){
				return $hotel['hotel_name'];
			}
		}catch(Exception $ex){
			log_message('error',' We are not getting product name correct '.$ex->getMessage());
			return false;
		}
	}

	/**
	 * @Function	-: getRoomTypeById()
	 * @Description	-: This function is used to get room type by id
	 * @Param		-: $id (Int)
	 * @Created on	-: 16-09-2016
	 */ 
	function getRoomTypeById($id=0)
	{
		if(empty($id) || !is_numeric($id)){
			return false;
		}
		$CI = & get_instance();
		try{
			$room_type = $CI->db->select('room_type')->where('id',$id)->get('room_type')->row_array();
			if($room_type){
				return $room_type['room_type'];
			}
		}catch(Exception $ex){
			log_message('error',' We are not getting product name correct '.$ex->getMessage());
			return false;
		}
	}

	function getSubServices($id,$type) {
	  if(empty($id) || !is_numeric($id)){
			return false;
		}
	 $CI = & get_instance();
	  try{
	  		$CI->db->where('parent_id',$id);
			$CI->db->where('type',$type);
			$subServices = $CI->db->get('services')->result_array();
			
			if($subServices){
				return $subServices;
			}
		}catch(Exception $ex){
			log_message('error',' We are not getting services correct '.$ex->getMessage());
			return false;
		}
	}

	function getAllCurrencies(){
		$CI = & get_instance();
	  try{
			$currencies = $CI->db->get('currencies')->result_array();
			
			if($currencies){
				return $currencies;
			}
		}catch(Exception $ex){
			log_message('error',' We are not getting services correct '.$ex->getMessage());
			return false;
		}
	}

	function getTotalRoomsByHotel($hotel_id){
		if(empty($hotel_id) || !is_numeric($hotel_id)){
			return false;
		}
		$CI = & get_instance();
		try{
			$rooms = $CI->db->select('sum(no_of_rooms) as total_rooms,sum(tmi_rooms) as total_tmi_rooms')->where('hotel_id',$hotel_id)->get('room_info')->row_array();
			if($rooms){
				return $rooms;
			}
		}catch(Exception $ex){
			log_message('error',' We are not getting product name correct '.$ex->getMessage());
			return false;
		}
	}

	function getRoleTitle($id) {
	    $CI = & get_instance();
	    $CI->db->select('name');
	    $CI->db->where('id', $id);
	    $query = $CI->db->get('groups');
	    if ($query->num_rows() > 0) {
	        $row = $query->row_array();
	        return $row['name'];
	    }
	    return false;
	}
	
	
