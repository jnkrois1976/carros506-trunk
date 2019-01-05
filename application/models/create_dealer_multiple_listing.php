<?php

error_reporting(E_ALL);

class Create_dealer_multiple_listing extends CI_Model {
	
	function create_multiple_listing(){
		$listings_values = $this->input->post("listings");
		$listings_decoded = json_decode($listings_values, TRUE);
		foreach ($listings_decoded as $key => $value) {
			$indvidual_listing = $value;
			$clean_listing = array_pop($indvidual_listing);
			$this->db->select_max('ad_id');
			$query = $this->db->get('anuncios');
			$largestid = $query->row_array();
			if($largestid['ad_id'] == 0){
				$ad_fullid = "AG".($largestid['ad_id'].'1000');
			}else{
				$ad_fullid = "AG".($largestid['ad_id']+1);
			}
			$indvidual_listing['ad_fullid'] = $ad_fullid;
			$insert = $this->db->insert('anuncios', $indvidual_listing);
		}
		return TRUE;
	}
	
}