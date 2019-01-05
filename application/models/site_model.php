<?php

	class Site_model extends CI_Model {
		
		function valid_ads_range(){
			$expireDay = date("d");
			$months = date("m");
			$expireYear = date("Y");
			$notformatted = $expireYear."-".$months."-".$expireDay;
			return $notformatted;
		}
			
		function allrows(){
			$date_limit = $this->valid_ads_range();
			$valid_ads_query = "SELECT * FROM anuncios WHERE ad_expires >= '$date_limit' AND ad_complete='1' ";
			$valid_ads_count = $this->db->query($valid_ads_query);
			$valid_ads_result = $valid_ads_count->num_rows();
			return $valid_ads_result;
		}
		
		function getminprice(){
			$date_limit = $this->valid_ads_range();
			$min_price_query = "SELECT MIN(ad_precio) AS ad_precio FROM anuncios WHERE ad_expires >= '$date_limit' AND ad_complete='1' LIMIT 1";
			$query = $this->db->query($min_price_query);
			if ($query->num_rows() > 0){
				return $query->row_array();
			}
		}
		
		function getmaxprice(){
			$date_limit = $this->valid_ads_range();
			$min_price_query = "SELECT MAX(ad_precio) AS ad_precio FROM anuncios WHERE ad_expires >= '$date_limit' AND ad_complete='1' LIMIT 1";
			$query = $this->db->query($min_price_query);
			if ($query->num_rows() > 0){
				return $query->row_array();
			}
		}
		
		function getminyear(){
			$date_limit = $this->valid_ads_range();
			$min_price_query = "SELECT MIN(ad_year) AS ad_year FROM anuncios WHERE ad_expires >= '$date_limit' AND ad_complete='1' LIMIT 1";
			$query = $this->db->query($min_price_query);
			if ($query->num_rows() > 0){
				return $query->row_array();
			}
		}
		
		function allmakes(){
		    $date_limit = $this->valid_ads_range();
			$makesquery = "SELECT DISTINCT ad_marca FROM anuncios WHERE ad_complete='1' AND ad_expires >= '$date_limit' ORDER BY ad_marca ASC";
			$allmakes = $this->db->query($makesquery);
			if ($allmakes->num_rows() > 0){
				foreach($allmakes->result() as $row){
					$allmakesresult[] = $row;
				}
				return $allmakesresult;
			}
		}
		
		function allmodels(){
		    $date_limit = $this->valid_ads_range();
			$make = $this->input->post('make');
			$modelsquery = "SELECT DISTINCT ad_modelo FROM anuncios WHERE ad_marca = '$make' AND ad_complete='1' AND ad_expires >= '$date_limit' ORDER BY ad_modelo ASC";
			$allmodels = $this->db->query($modelsquery);
			if ($allmodels->num_rows() > 0){
				foreach($allmodels->result() as $row){
					$allmodelsresult[] = $row;
				}
				return $allmodelsresult;
			}
		}
		
		// retrieve multiple rows
		function get_premier(){
			$date_limit = $this->valid_ads_range();
			$premier_query = "SELECT * FROM anuncios_premier WHERE ad_expires >= '$date_limit' ORDER BY ad_id DESC LIMIT 5";
			$query = $this->db->query($premier_query);
			if ($query->num_rows() > 0){
				foreach($query->result() as $row){
					$premier_result[] = $row;
				}
				return $premier_result;
			} 
		}
		
		function getpopular(){
			$date_limit = $this->valid_ads_range();
			$popularquery = "SELECT * FROM anuncios WHERE ad_expires >= '$date_limit' AND ad_complete='1' ORDER BY ad_visits DESC LIMIT 3";
			$query = $this->db->query($popularquery);
			if ($query->num_rows() > 0){
				foreach($query->result() as $row){
					$popularresult[] = $row;
				}
				return $popularresult;
			} 
		}
		
		
		function getfeatured(){
			$date_limit = $this->valid_ads_range();
			$adsquery = "SELECT * FROM anuncios WHERE ad_categoria = 'A' AND ad_expires >= '$date_limit' AND ad_complete='1' ORDER BY ad_id DESC LIMIT 3";
			$query = $this->db->query($adsquery);
			if ($query->num_rows() > 0){
				foreach($query->result() as $row){
					$alladsresult[] = $row;
				}
				return $alladsresult;
			} 
		}
		
		function getrecent(){
			$date_limit = $this->valid_ads_range();
			$recentadsquery = "SELECT * FROM anuncios WHERE ad_categoria = 'C' AND ad_expires >= '$date_limit' AND ad_complete='1' ORDER BY ad_postedOn DESC LIMIT 10";
			$recentquery = $this->db->query($recentadsquery);
			if ($recentquery->num_rows() > 0){
				foreach($recentquery->result() as $row){
					$allrecentadsresult[] = $row;
				}
				return $allrecentadsresult;
			} 
		}
		
		function get_user_questions_anuncios(){
			$questions_query = "SELECT * FROM user_questions WHERE public_question='1' AND question_topic='anuncios' ORDER BY question_date DESC";
			$make_query = $this->db->query($questions_query);
			if ($make_query->num_rows() > 0){
				foreach($make_query->result() as $row){
					$all_questions_result[] = $row;
				}
				return $all_questions_result;
			} 
		}
		
		function get_user_questions_perfil(){
			$questions_query = "SELECT * FROM user_questions WHERE public_question='1' AND question_topic='perfil' ORDER BY question_date DESC";
			$make_query = $this->db->query($questions_query);
			if ($make_query->num_rows() > 0){
				foreach($make_query->result() as $row){
					$all_questions_result[] = $row;
				}
				return $all_questions_result;
			} 
		}
		
		function get_user_questions_publicidad(){
			$questions_query = "SELECT * FROM user_questions WHERE public_question='1' AND question_topic='publicidad' ORDER BY question_date DESC";
			$make_query = $this->db->query($questions_query);
			if ($make_query->num_rows() > 0){
				foreach($make_query->result() as $row){
					$all_questions_result[] = $row;
				}
				return $all_questions_result;
			} 
		}
		
		function get_user_questions_comentarios(){
			$questions_query = "SELECT * FROM user_questions WHERE public_question='1' AND question_topic='comentarios' ORDER BY question_date DESC";
			$make_query = $this->db->query($questions_query);
			if ($make_query->num_rows() > 0){
				foreach($make_query->result() as $row){
					$all_questions_result[] = $row;
				}
				return $all_questions_result;
			} 
		}
		
		function get_user_questions_mensajes(){
			$questions_query = "SELECT * FROM user_questions WHERE public_question='1' AND question_topic='mensajes' ORDER BY question_date DESC";
			$make_query = $this->db->query($questions_query);
			if ($make_query->num_rows() > 0){
				foreach($make_query->result() as $row){
					$all_questions_result[] = $row;
				}
				return $all_questions_result;
			} 
		}
		
		function get_user_questions_generales(){
			$questions_query = "SELECT * FROM user_questions WHERE public_question='1' AND question_topic='generales' ORDER BY question_date DESC";
			$make_query = $this->db->query($questions_query);
			if ($make_query->num_rows() > 0){
				foreach($make_query->result() as $row){
					$all_questions_result[] = $row;
				}
				return $all_questions_result;
			} 
		}
		
		// retrieve multiple rows
		//function getads(){
		//	$member_Id = $this->session->userdata('member_id');
		//	$sql = "SELECT * FROM anuncios WHERE ad_sellerId = '$member_Id'";
		//	$query = $this->db->query($sql);
		//	if ($query->num_rows() > 0){
		//		foreach($query->result() as $row){
		//			$data[] = $row;
		//		}
		//		return $data;
		//	} 
		//}
		
		// retrieve only one row
		//function getcontact(){
		//	$member_Id = $this->session->userdata('member_id');
		//	$sql = "SELECT * FROM users WHERE contact_sellerId = '$member_Id' LIMIT 1";
		//	$query = $this->db->query($sql);
		//	if ($query->num_rows() > 0){
		//	   $row = $query->row_array();
		//	   return $row;
		//	} 
		//}
	}

?>