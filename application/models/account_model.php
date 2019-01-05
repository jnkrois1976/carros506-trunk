<?php

	class Account_model extends CI_Model {
			
		function create_member(){
			$this->db->select_max('contact_id');
			$query = $this->db->get('users');
			if ($query->num_rows() > 0){
				$largestid = $query->row_array();
			}
			$username = $this->input->post('name');
			$userfirstname = explode(" ", $username);
			$splited_name = count($userfirstname,0);
			if($splited_name == 2){
				$formatted_first_name = mb_convert_case($userfirstname[0], MB_CASE_TITLE, "UTF-8");
				$formatted_first_lname = mb_convert_case($userfirstname[1], MB_CASE_TITLE, "UTF-8");
				$formatted_second_lname = "";
			}elseif($splited_name == 3){
				$formatted_first_name = mb_convert_case($userfirstname[0], MB_CASE_TITLE, "UTF-8");
				$formatted_first_lname = mb_convert_case($userfirstname[1], MB_CASE_TITLE, "UTF-8");
				$formatted_second_lname = mb_convert_case($userfirstname[2], MB_CASE_TITLE, "UTF-8");
			}elseif($splited_name == 4){
				$formatted_first_name = mb_convert_case($userfirstname[0], MB_CASE_TITLE, "UTF-8")." ".mb_convert_case($userfirstname[1], MB_CASE_TITLE, "UTF-8");
				$formatted_first_lname = mb_convert_case($userfirstname[2], MB_CASE_TITLE, "UTF-8");
				$formatted_second_lname = mb_convert_case($userfirstname[3], MB_CASE_TITLE, "UTF-8");
			}else{
				$formatted_first_name = mb_convert_case($userfirstname[0], MB_CASE_TITLE, "UTF-8");
				$formatted_first_lname = mb_convert_case($userfirstname[1], MB_CASE_TITLE, "UTF-8");
				$formatted_second_lname = "";
			}
			$formatted_full_name = mb_convert_case($this->input->post('name'), MB_CASE_TITLE, "UTF-8");
			$contact_fullid = "VPR".($largestid['contact_id']+1);
			$create_new_member = array(
				'contact_firstname' => $formatted_first_name,
				'contact_lname1' => $formatted_first_lname,
				'contact_lname2' => $formatted_second_lname,
				'contact_fullname' => $formatted_full_name,
				'contact_prefix' => "VPR",
				'contact_fullid' => $contact_fullid,
				'contact_email' => $this->input->post('email'),
				'contact_password' => md5($this->input->post('password'))
			);
			$insert = $this->db->insert('users', $create_new_member);
			return $insert;
		}
	}

?>