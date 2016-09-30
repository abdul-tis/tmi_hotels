<?php
Class Hotel_model extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

	/**
	 * @Method		-: getAllHotels()
	 * @Description	-: This function is used to fetch all hotels
	 * @Created on	-: 05-09-2016
	 * @Return 		-: array()
	 */ 

	function getAllHotels($hotel_type=NULL,$hotel_name=NULL,$location=NULL,$start=NULL)
	{
		$this->db->select('h.*,r.type_id,r.price,l.loc_city');
		$this->db->join('room_info as r','h.hotel_id=r.hotel_id','left');
		$this->db->join('hotel_location as l','h.hotel_id=l.hotel_id');
		if(!empty($hotel_type)){
			$this->db->where('h.hotel_type',$hotel_type);
		}
		if(!empty($hotel_name)){
			$this->db->like('h.hotel_name',$hotel_name);
		}
		if(!empty($location)){
			$this->db->like('l.locality',$location);
		}
		if(!empty($start)){
			$start		= ($start=='P') ? 0 : $start;
			$result = $this->db->limit($this->limit,$start)->group_by('h.hotel_id')->get('hotel as h')->result_array();
		}else{
			$result = $this->db->group_by('h.hotel_id')->get('hotel as h')->num_rows();
		}
		
		return $result;
	}

	/**
	 * @Method		-: saveHotels()
	 * @Description	-: This function is used to save hotels
	 * @Created on	-: 06-09-2016
	 * @Return 		-: array()
	 */ 

	function saveHotel($data,$id=null)
	{
		if(!empty($id))
		{
			$this->db->where('hotel_id',$id);
			$result = $this->db->update('hotel',$data);
		}
		else
		{
			$this->db->insert('hotel',$data);
			$result = $this->db->insert_id();
		}
		
		return $result;
	}

	/**
	 * @Method		-: saveHotelLocation()
	 * @Description	-: This function is used to save hotel location
	 * @Created on	-: 06-09-2016
	 * @Return 		-: array()
	 */ 

	function saveHotelLocation($location,$hotel_id=null)
	{
		if(!empty($hotel_id))
		{
			$this->db->where('hotel_id',$hotel_id);
			$result = $this->db->update('hotel_location',$location);
		}
		else
		{
			$result = $this->db->insert('hotel_location',$location);
		}
		
		return $result;
	}

	/**
	 * @Method		-: getHotelDetailsById()
	 * @Description	-: This function is used get hotel details by id
	 * @Created on	-: 07-09-2016
	 * @Return 		-: array()
	 */ 
	function getHotelDetailsById($id)
	{
		$this->db->select('h.*,l.latitude,l.longitude,l.loc_city,l.loc_state,l.loc_country,l.locality,l.landmarks,l.zipcode,l.address,hg.images,hg.primary_image');
		$this->db->join('hotel_location as l','h.hotel_id=l.hotel_id','left');
		$this->db->join('hotel_gallery as hg','h.hotel_id=hg.hotel_id','left');
		$this->db->where('h.hotel_id',$id);
		$result = $this->db->get('hotel as h')->row_array();
		return $result;
	}

	/**
	 * @Method		-: deleteHotel()
	 * @Description	-: This function is used remove hotel
	 * @Created on	-: 07-09-2016
	 */

	function deleteHotel($hotel_id)
	{
		$this->db->where('hotel_id',$hotel_id);
		$result 	= $this->db->delete('hotel');
		return $result;

	}

	/**
	 * @Method		-: getHotelRooms()
	 * @Description	-: This function is used get hotel rooms
	 * @Created on	-: 07-09-2016
	 * @Return 		-: array()
	 */

	function getHotelRooms($hotel_id,$start=NULL)
	{
		$this->db->select('r.*,rg.lobby_primary_image,rc.category_type,rc.meal_plan');
		$this->db->join('room_gallery as rg','r.type_id=rg.room_id','left');
		$this->db->join('rate_categories as rc','rc.id=r.rate_category');
		$this->db->where('r.hotel_id',$hotel_id);
		if(!empty($start)){
			$start		= ($start=='P') ? 0 : $start;
			$result 	= $this->db->limit($this->limit,$start)->get('room_info as r')->result_array();;
		}
		else{
			$result = $this->db->get('room_info as r')->num_rows();
		}
		
		return $result;

	}

	/**
	 * @Method		-: saveHotelRoom()
	 * @Description	-: This function is used to save hotel room
	 * @Created on	-: 08-09-2016
	 * @Return 		-: insert id
	 */

	function saveHotelRoom($data,$room_id=null)
	{
		if(!empty($room_id))
		{
			$this->db->where('type_id',$room_id);
			$result 	= $this->db->update('room_info',$data);
		}
		else
		{
			$this->db->insert('room_info',$data);
			$result = $this->db->insert_id();
		}
		
		return $result;
	}

	/**
	 * @Method		-: saveRoomImages()
	 * @Description	-: This function is used to save room images
	 * @Created on	-: 08-09-2016
	 */

	function saveRoomImages($hotel_id,$room_id,$lobbyPrimaryImage="",$lobbyimages=array(),$loungePrimaryImage="",$loungeimages=array(),$receptionPrimaryImage="",$receptionimages=array())
	{
		$lobbyImages 		= (!empty($lobbyimages)) ? implode(',',$lobbyimages) : NULL;
		$loungeImages 		= (!empty($loungeimages)) ? implode(',',$loungeimages) : NULL;
		$receptionImages 	= (!empty($receptionimages)) ? implode(',',$receptionimages) : NULL;
		$data 	= array(
						'hotel_id'=>$hotel_id,
						'room_id'=>$room_id,
						'lobby_primary_image'=>$lobbyPrimaryImage,
						'lobby_images'=>$lobbyImages,
						'lounge_primary_image'=>$loungePrimaryImage,
						'lounge_images'=>$loungeImages,
						'reception_primary_image'=>$receptionPrimaryImage,
						'reception_images'=>$receptionImages
					);
		$this->db->where('hotel_id',$hotel_id);
		$this->db->where('room_id',$room_id);
		$this->db->delete('room_gallery');

		$result 	= $this->db->insert('room_gallery',$data);
		if($result){
			return true;
		}else{
			return false;
		}
	}

	function getRoomDetailsById($hotel_id,$id)
	{
		$this->db->select('r.*,rg.lobby_images,rg.lounge_images,rg.reception_images,rg.lobby_primary_image,rg.lounge_primary_image,rg.reception_primary_image');
		$this->db->join('room_gallery as rg','r.type_id=rg.room_id','left');
		$this->db->where('r.type_id',$id);
		$this->db->where('r.hotel_id',$hotel_id);
		$result = $this->db->get('room_info as r')->row_array();
		return $result;
	}

	/**
	 * @Method		-: deleteHotelRoom()
	 * @Description	-: This function is used remove hotel room
	 * @Created on	-: 07-09-2016
	 */

	function deleteHotelRoom($room_id)
	{
		$this->db->where('type_id',$room_id);
		$result 	= $this->db->delete('room_info');
		if($result)
		{
			$this->db->where('room_id',$room_id);
			$this->db->delete('room_gallery');
		}
		return $result;

	}

	/**
	 * @Method		-: saveHotelImages()
	 * @Description	-: This function is used to save hotel images
	 * @Created on	-: 09-09-2016
	 */
	function saveHotelImages($hotel_id,$primaryImage="",$images=array())
	{
		$hotelImages 	= (!empty($images)) ? implode(',',$images) : NULL;
		$data 	= array(
						'hotel_id'=>$hotel_id,
						'primary_image'=>$primaryImage,
						'images'=>$hotelImages
					);
		$this->db->where('hotel_id',$hotel_id);
		$this->db->delete('hotel_gallery');

		$result 	= $this->db->insert('hotel_gallery',$data);
		if($result){
			return true;
		}else{
			return false;
		}
	}

	/**
	 * @Method		-: saveHotelContactDetails()
	 * @Description	-: This function is used to save hotel contact details
	 * @Created on	-: 17-09-2016
	 */
	function saveHotelContactDetails($hotel_id=0,$data=array()){
		if(!empty($hotel_id) && is_numeric($hotel_id)){
			$designation 	= (isset($data['designation']))?$data['designation']:array();
			$contact_name 	= (isset($data['contact_name']))?$data['contact_name']:array();
			$contact_email 	= (isset($data['contact_email']))?$data['contact_email']:array();
			$contact_phone 	= (isset($data['contact_phone']))?$data['contact_phone']:array();

			if(count($designation) > 0){
				$this->db->where('hotel_id',$hotel_id);
				$this->db->delete('hotel_contact_details');
			}

			for($i=0;$i<count($designation);$i++){
				$contactDetails 			= array();
				$contactDetails['hotel_id'] = $hotel_id;
				if(!empty($designation[$i])){
					$contactDetails['designation'] 	= (!empty($designation[$i]))?$designation[$i]:null;
					$contactDetails['name'] 		= (!empty($contact_name[$i]))?$contact_name[$i]:null;
					$contactDetails['email'] 		= (!empty($contact_email[$i]))?$contact_email[$i]:null;
					$contactDetails['phone'] 		= (!empty($contact_phone[$i]))?$contact_phone[$i]:null;

					$this->db->insert('hotel_contact_details',$contactDetails);
				}
			}

			return true;
		}else{
			return false;
		}
	}

	/**
	 * @Method		-: saveBookingData()
	 * @Description	-: This function is used to save hotel contact details
	 * @Created on	-: 17-09-2016
	 */
	function saveBookingData($data){
		$this->db->where('from_date',$data['from_date']);
		$this->db->where('to_date',$data['to_date']);
		$this->db->where('room_type',$data['room_type']);
		$res = $this->db->get('reservation')->row_array();
		if(count($res)>0){
			$this->db->where('id',$res['id']);
			$this->db->update('reservation',$data);
			$result = $res['id'];
		}else{
			$this->db->insert('reservation',$data);
			$result = $this->db->insert_id();
		}

		return $result;
	}
}

?>