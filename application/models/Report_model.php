<?php
Class Report_model extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

	function reportByCategory(){
		$this->db->select('c.hotel_category,COUNT(*) as total_booking');
		$this->db->join('hotel as h','c.id=h.hotel_category','LEFT');
		$this->db->join('reservation as r','r.hotel_id=h.hotel_id');
		$this->db->join('reservation_details as rd','rd.reservation_id=r.id','LEFT');
		$this->db->group_by('h.hotel_category');
		$result = $this->db->get('hotel_categories as c')->result_array();
		return $result;
	}
}