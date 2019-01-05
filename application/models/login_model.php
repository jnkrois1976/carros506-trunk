<?php

	class Login_model extends CI_Model {
			
		function validate(){
			$email = $this->input->post('email');
			$password = md5($this->input->post('password'));
			$sql = "SELECT * FROM users WHERE contact_email = '$email' AND contact_password = '$password'";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0){
			   $row = $query->row_array();
			   return $row;
			} 
		}
	}

?>