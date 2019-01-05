<?php

	class Resultados_model extends CI_Model {
		
		function valid_ads_range(){
			$expireDay = date("d");
			$months = date("m");
			$expireYear = date("Y");
			$notformatted = $expireYear."-".$months."-".$expireDay;
			return $notformatted;
		}
		
		function getposting(){
			$notformatted = $this->valid_ads_range();
			$postId = $this->uri->segment(3, 0);
			$prefix_pattern = "/[A-Z]{2}/";
			$id_pattern = "/[0-9]{4,8}/";
			preg_match($prefix_pattern, $postId, $prefix_matches);
			preg_match($id_pattern, $postId, $id_matches);
			if($id_matches && $prefix_matches){
				$sql = "SELECT * FROM anuncios WHERE ad_id = '$id_matches[0]' AND ad_idprefix = '$prefix_matches[0]' AND ad_expires >= '$notformatted' LIMIT 1";
				$query = $this->db->query($sql);
				if ($query->num_rows() > 0){
				   $row = $query->row_array();
				   return $row;
				}
			} 
		}
		
		function get_expired_posting(){
			$notformatted = $this->valid_ads_range();
			$postId = $this->uri->segment(3, 0);
			$prefix_pattern = "/[A-Z]{2}/";
			$id_pattern = "/[0-9]{4,8}/";
			preg_match($prefix_pattern, $postId, $prefix_matches);
			preg_match($id_pattern, $postId, $id_matches);
			$sql = "SELECT * FROM anuncios WHERE ad_id = '$id_matches[0]' AND ad_idprefix = '$prefix_matches[0]' AND ad_complete='1' LIMIT 1";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0){
			   $row = $query->row_array();
			   return $row;
			} 
		}
		
		function is_rated(){
			$member_Id = $this->session->userdata('member_id');
			$ad_fullid = $this->uri->segment(3, 0);
			$sql = "SELECT * FROM ratings WHERE ad_fullid = '$ad_fullid' AND contact_fullid = '$member_Id' LIMIT 1";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0){
			   return TRUE;
			}
		}
		
		function is_favorite(){
			$member_Id = $this->session->userdata('member_id');
			$ad_fullid = $this->uri->segment(3, 0);
			$sql = "SELECT * FROM favorites WHERE ad_fullid = '$ad_fullid' AND contact_fullid = '$member_Id' LIMIT 1";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0){
			   return TRUE;
			}
		}
		
		function is_reported(){
			$member_Id = $this->session->userdata('member_id');
			$ad_fullid = $this->uri->segment(3, 0);
			$sql = "SELECT * FROM reportados WHERE ad_fullid = '$ad_fullid' AND buyer_fullid = '$member_Id' LIMIT 1";
			$query = $this->db->query($sql);
			if ($query->num_rows() == 0){
			   return TRUE;
			}else{
				return FALSE;
			}
		}
		
		function self_report(){
			$member_Id = $this->session->userdata('member_id');
			$ad_fullid = $this->uri->segment(3, 0);
			$sql = "SELECT * FROM anuncios WHERE ad_fullid = '$ad_fullid' AND ad_sellerId = '$member_Id' AND ad_complete='1' LIMIT 1";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0){
			   return TRUE;
			}
		}
		
		function self_report_premier(){
			$member_Id = $this->session->userdata('member_id');
			$ad_fullid = $this->uri->segment(3, 0);
			$sql = "SELECT * FROM anuncios_premier WHERE ad_fullid = '$ad_fullid' AND ad_sellerId = '$member_Id' LIMIT 1";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0){
			   return TRUE;
			}
		}
		
		function advertisement(){
			$member_Id = $this->session->userdata('member_id');
			$this->db->select('contact_provincia');
			$this->db->where('contact_fullid', $member_Id);
			$query = $this->db->get('users');
			$find_location = $query->row_array();
			if($find_location['contact_provincia'] == "San José" || $find_location['contact_provincia'] == ""){
				$user_location = 'sanjose';
			}elseif($find_location['contact_provincia'] == "Limón"){
				$user_location = 'limon';
			}else{
				$user_location = strtolower($find_location['contact_provincia']);
			}
			if($member_Id){
				$total_banners = 1;
				$banner8 = "SELECT * FROM anunciantes WHERE location='$user_location' AND banner_type='8' ORDER BY RAND() LIMIT $total_banners";
				$banner_query[0] = $this->db->query($banner8);
				$banner_query_rows[0] = $banner_query[0]->num_rows();
				if($banner_query_rows[0] > 0){
					$total_banners = 2;
				}else{
					$total_banners = 3;
				}
				$banner7 = "SELECT * FROM anunciantes WHERE location='$user_location' AND banner_type='7' ORDER BY RAND() LIMIT $total_banners";
				$banner_query[1] = $this->db->query($banner7);
				$banner_query_rows[1] = $banner_query[1]->num_rows();
				if($banner_query_rows[1] > 0){
					$total_banners = 1;
				}else{
					$total_banners = 4;
				}
				$banner6 = "SELECT * FROM anunciantes WHERE location='$user_location' AND banner_type='6' ORDER BY RAND() LIMIT $total_banners";
				$banner_query[2] = $this->db->query($banner6);
				$banner_query_rows[2] = $banner_query[2]->num_rows();
				if($banner_query_rows[2] > 0){
					$total_banners = 2;
				}
				else{
					$total_banners = 6;
				}
				$banner5 = "SELECT * FROM anunciantes WHERE location='$user_location' AND banner_type='5' ORDER BY RAND() LIMIT $total_banners";
				$banner_query[3] = $this->db->query($banner5);
				$banner_query_rows[3] = $banner_query[3]->num_rows();
				if($banner_query_rows[3] > 0){
					$total_banners = 1;
				}else{
					$total_banners = 7;
				}
				$banner4 = "SELECT * FROM anunciantes WHERE location='$user_location' AND banner_type='4' ORDER BY RAND() LIMIT $total_banners";
				$banner_query[4] = $this->db->query($banner4);
				$banner_query_rows[4] = $banner_query[4]->num_rows();
				if($banner_query_rows[4] > 0){
					$total_banners = 2;
				}else{
					$total_banners = 9;
				}
				$banner3 = "SELECT * FROM anunciantes WHERE location='$user_location' AND banner_type='3' ORDER BY RAND() LIMIT $total_banners";
				$banner_query[5] = $this->db->query($banner3);
				$banner_query_rows[5] = $banner_query[5]->num_rows();
				if($banner_query_rows[5] > 0){
					$total_banners = 1;
				}else{
					$total_banners = 10;
				}
				$banner2 = "SELECT * FROM anunciantes WHERE location='$user_location' AND banner_type='2' ORDER BY RAND() LIMIT $total_banners";
				$banner_query[6] = $this->db->query($banner2);
				$banner_query_rows[6] = $banner_query[6]->num_rows();
				if($banner_query_rows[6] > 0){
					$total_banners = 2;
				}else{
					$total_banners = 12;
				}
				$banner1 = "SELECT * FROM anunciantes WHERE location='$user_location' AND banner_type='1' ORDER BY RAND() LIMIT $total_banners";
				$banner_query[7] = $this->db->query($banner1);
			}else{
				$total_banners = 1;
				$banner8 = "SELECT * FROM anunciantes WHERE banner_type='8' ORDER BY RAND() LIMIT $total_banners";
				$banner_query[0] = $this->db->query($banner8);
				$banner_query_rows[0] = $banner_query[0]->num_rows();
				if($banner_query_rows[0] > 0){
					$total_banners = 2;
				}else{
					$total_banners = 3;
				}
				$banner7 = "SELECT * FROM anunciantes WHERE banner_type='7' ORDER BY RAND() LIMIT $total_banners";
				$banner_query[1] = $this->db->query($banner7);
				$banner_query_rows[1] = $banner_query[1]->num_rows();
				if($banner_query_rows[1] > 0){
					$total_banners = 1;
				}else{
					$total_banners = 4;
				}
				$banner6 = "SELECT * FROM anunciantes WHERE banner_type='6' ORDER BY RAND() LIMIT $total_banners";
				$banner_query[2] = $this->db->query($banner6);
				$banner_query_rows[2] = $banner_query[2]->num_rows();
				if($banner_query_rows[2] > 0){
					$total_banners = 2;
				}
				else{
					$total_banners = 6;
				}
				$banner5 = "SELECT * FROM anunciantes WHERE banner_type='5' ORDER BY RAND() LIMIT $total_banners";
				$banner_query[3] = $this->db->query($banner5);
				$banner_query_rows[3] = $banner_query[3]->num_rows();
				if($banner_query_rows[3] > 0){
					$total_banners = 1;
				}else{
					$total_banners = 7;
				}
				$banner4 = "SELECT * FROM anunciantes WHERE banner_type='4' ORDER BY RAND() LIMIT $total_banners";
				$banner_query[4] = $this->db->query($banner4);
				$banner_query_rows[4] = $banner_query[4]->num_rows();
				if($banner_query_rows[4] > 0){
					$total_banners = 2;
				}else{
					$total_banners = 9;
				}
				$banner3 = "SELECT * FROM anunciantes WHERE banner_type='3' ORDER BY RAND() LIMIT $total_banners";
				$banner_query[5] = $this->db->query($banner3);
				$banner_query_rows[5] = $banner_query[5]->num_rows();
				if($banner_query_rows[5] > 0){
					$total_banners = 1;
				}else{
					$total_banners = 10;
				}
				$banner2 = "SELECT * FROM anunciantes WHERE banner_type='2' ORDER BY RAND() LIMIT $total_banners";
				$banner_query[6] = $this->db->query($banner2);
				$banner_query_rows[6] = $banner_query[6]->num_rows();
				if($banner_query_rows[6] > 0){
					$total_banners = 2;
				}else{
					$total_banners = 12;
				}
				$banner1 = "SELECT * FROM anunciantes WHERE banner_type='1' ORDER BY RAND() LIMIT $total_banners";
				$banner_query[7] = $this->db->query($banner1);
			}
						
			for($i = 0; $i < 8; $i++){
				if ($banner_query[$i]->num_rows() > 0){
					foreach($banner_query[$i]->result_array() as $row){
						$data[] = $row;
					}
				}
			}
			array_multisort($data);
			return $data;
		}
		
		function update_visits(){
			$ad_fullid = $this->uri->segment(3, 0);
			$sql = "SELECT ad_visits FROM anuncios WHERE ad_fullid = '$ad_fullid' AND ad_complete='1' LIMIT 1";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0){
			   $visits_number = $query->row_array();
				$update_visits_number = ($visits_number['ad_visits'] + 1);
				$update_visits = array('ad_visits' => $update_visits_number);
				$this->db->where('ad_fullid', $ad_fullid);
				$this->db->update('anuncios', $update_visits);
			}
			
		}
		
		function get_premier_posting(){
			$postId = $this->uri->segment(3, 0);
			$prefix_pattern = "/[A-Z]{3}/";
			$id_pattern = "/[0-9]{4,8}/";
			preg_match($prefix_pattern, $postId, $prefix_matches);
			preg_match($id_pattern, $postId, $id_matches);
			$sql = "SELECT * FROM anuncios_premier WHERE ad_id = '$id_matches[0]' AND ad_idprefix = '$prefix_matches[0]' LIMIT 1";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0){
			   $row = $query->row_array();
			   return $row;
			} 
		}
		
		function update_visits_premier(){
			$ad_fullid = $this->uri->segment(3, 0);
			$sql = "SELECT ad_visits FROM anuncios_premier WHERE ad_fullid = '$ad_fullid' LIMIT 1";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0){
			   $visits_number = $query->row_array();
			}
			$update_visits_number = ($visits_number['ad_visits'] + 1);
			$update_visits = array('ad_visits' => $update_visits_number);
			$this->db->where('ad_fullid', $ad_fullid);
			$this->db->update('anuncios_premier', $update_visits);
		}
		
		function get_similar_posting(){
			$notformatted = $this->valid_ads_range();
			$postId = $this->uri->segment(3, 0);
			$define_model = "SELECT ad_modelo FROM anuncios WHERE ad_fullid = '$postId' AND ad_complete='1' LIMIT 1";
			$find_model = $this->db->query($define_model);
			$offset = $this->uri->segment(4, 0);
			if ($find_model->num_rows() > 0){
			   $matched_model = $find_model->row_array();
			   $selected_model = $matched_model["ad_modelo"];
			   $sql = "SELECT * FROM anuncios
						WHERE ad_modelo LIKE '%$selected_model%'
						AND ad_fullid NOT LIKE '%$postId%'
						AND ad_expires >= '$notformatted' 
						AND ad_complete='1' 
						ORDER BY ad_categoria ASC
						LIMIT 10 OFFSET $offset";
				$query = $this->db->query($sql);
				if ($query->num_rows() > 0){
					foreach($query->result() as $row){
						$data[] = $row;
					}
					return $data;
				}
			}else{
				return FALSE;
			}
		}
		
		function count_similar_posting(){
			$postId = $this->uri->segment(3, 0);
			$define_model = "SELECT ad_modelo FROM anuncios WHERE ad_fullid = '$postId' AND ad_complete='1' LIMIT 1";
			$find_model = $this->db->query($define_model);
			$offset = $this->uri->segment(4, 0);
			if ($find_model->num_rows() > 0){
				$matched_model = $find_model->row_array();
				$selected_model = $matched_model["ad_modelo"];
				$sql = "SELECT * FROM anuncios WHERE ad_modelo LIKE '%$selected_model%' AND ad_fullid NOT LIKE '%$postId%' AND ad_complete='1'";
				$query = $this->db->query($sql);
				return $query->num_rows();
			}
		}
		
		function get_comments(){
			$ad_fullid = $this->uri->segment(3, 0);
			$offset = $this->uri->segment(4, 0);
			$sql = "SELECT * FROM comments WHERE ad_fullid = '$ad_fullid' AND public > 0 ORDER BY timestamp DESC LIMIT 10 OFFSET $offset";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0){
				foreach($query->result() as $row){
					$data[] = $row;
				}
				return $data;
			}
		}
		
		function get_public_comments_amount(){
			$ad_fullid = $this->uri->segment(3, 0);
			$offset = $this->uri->segment(4, 0);
			$sql = "SELECT * FROM comments WHERE ad_fullid = '$ad_fullid' AND public = 1";
			$query = $this->db->query($sql);
			return $query->num_rows();
		}
		
		function count_comments(){
			$ad_fullid = $this->uri->segment(3, 0);
			$offset = $this->uri->segment(4, 0);
			$sql = "SELECT * FROM comments WHERE ad_fullid = '$ad_fullid' AND public > 0";
			$query = $this->db->query($sql);
			return $query->num_rows();
		}
		
		function getrequestedposts(){
			$notformatted = $this->valid_ads_range();
			if($this->input->post("make")){
				$make = $this->input->post("make");
				$model = $this->input->post("model");
				$minamount = $this->input->post("minamount");
				$maxamount = $this->input->post('maxamount');
				$yearstart = $this->input->post('yearstart');
				$yearend = $this->input->post('yearend');
				
				setcookie('valuemake', $make);
				setcookie('valuemodel', $model);
				setcookie('valueminamount', $minamount);
				setcookie('valuemaxamount', $maxamount);
				setcookie('valueyearstart', $yearstart);
				setcookie('valueyearend', $yearend);
				
			}elseif(!$this->input->post("make")){
				$make = $_COOKIE['valuemake'];
				$model = $_COOKIE['valuemodel'];
				$minamount = $_COOKIE['valueminamount'];
				$maxamount = $_COOKIE['valuemaxamount'];
				$yearstart = $_COOKIE['valueyearstart'];
				$yearend = $_COOKIE['valueyearend'];
			}
			$offset = $this->uri->segment(3, 0);
			$sql = "SELECT *
				FROM anuncios
				WHERE ad_marca = '$make'
				AND ad_modelo = '$model'
				AND ad_precio >= '$minamount'
				AND ad_precio <= '$maxamount'
				AND ad_year >= '$yearstart'
				AND ad_year <= '$yearend'
				AND ad_expires >= '$notformatted'
				AND ad_complete='1' 
				ORDER BY ad_categoria ASC
				LIMIT 5 OFFSET $offset";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0){
				foreach($query->result() as $row){
					$data[] = $row;
				}
				return $data;
			}
		}
		
		function count_requested_posts(){
			$notformatted = $this->valid_ads_range();
			if($this->input->post("make")){
				$make = $this->input->post("make");
				$model = $this->input->post("model");
				$minamount = $this->input->post("minamount");
				$maxamount = $this->input->post('maxamount');
				$yearstart = $this->input->post('yearstart');
				$yearend = $this->input->post('yearend');
			}elseif(!$this->input->post("make")){
				$make = $_COOKIE['valuemake'];
				$model = $_COOKIE['valuemodel'];
				$minamount = $_COOKIE['valueminamount'];
				$maxamount = $_COOKIE['valuemaxamount'];
				$yearstart = $_COOKIE['valueyearstart'];
				$yearend = $_COOKIE['valueyearend'];
			}
			$sql = "SELECT *
				FROM anuncios
				WHERE ad_marca = '$make'
				AND ad_modelo = '$model'
				AND ad_precio >= '$minamount'
				AND ad_precio <= '$maxamount'
				AND ad_year >= '$yearstart'
				AND ad_year <= '$yearend'
				AND ad_expires >= '$notformatted'
				AND ad_complete='1'";
			$query = $this->db->query($sql);
			return $query->num_rows();
		}
		
		function post_by_seller(){
			$notformatted = $this->valid_ads_range();
			$seller_id = $this->uri->segment(3, 0);
			if($seller_id != "0"){
				$offset = $this->uri->segment(4, 0);
				$sql = "SELECT * FROM anuncios WHERE ad_sellerId = '$seller_id' AND ad_expires >= '$notformatted' AND ad_complete='1' ORDER BY ad_id DESC LIMIT 10 OFFSET $offset";
				$query = $this->db->query($sql);
				if ($query->num_rows() > 0){
					foreach($query->result() as $row){
						$data[] = $row;
					}
					return $data;
				}
			}else{
				return FALSE;
			}
		}
		
		function rows_by_seller(){
			$notformatted = $this->valid_ads_range();
			$seller_id = $this->uri->segment(3, 0);
			if($seller_id != "0"){
				$sql = "SELECT * FROM anuncios WHERE ad_sellerId = '$seller_id' AND ad_expires >= '$notformatted' AND ad_complete='1' ORDER BY ad_modelo ASC";
				$query = $this->db->query($sql);
				return $query->num_rows();
			}else{
				return FALSE;
			}
		}
		
		function post_by_dealer(){
			$notformatted = $this->valid_ads_range();
			$seller_id = $this->uri->segment(3, 0);
			if($seller_id != "0"){
				$offset = $this->uri->segment(4, 0);
				$sql = "SELECT * FROM anuncios_premier WHERE ad_sellerId = '$seller_id' AND ad_expires >= '$notformatted' 
						UNION ALL
						SELECT * FROM anuncios WHERE ad_sellerId = '$seller_id' AND ad_expires >= '$notformatted' AND ad_complete='1' ORDER BY ad_id ASC LIMIT 10 OFFSET $offset";
				$query = $this->db->query($sql);
				if ($query->num_rows() > 0){
					foreach($query->result() as $row){
						$data[] = $row;
					}
					return $data;
				}
			}else{
				return FALSE;
			}
		}
		
		function rows_by_dealer(){
			$notformatted = $this->valid_ads_range();
			$seller_id = $this->uri->segment(3, 0);
			if($seller_id != "0"){
				$sql = "SELECT * FROM anuncios WHERE ad_sellerId = '$seller_id' AND ad_expires >= '$notformatted' AND ad_complete='1' 
						UNION ALL
						SELECT * FROM anuncios_premier WHERE ad_sellerId = '$seller_id' AND ad_expires >= '$notformatted'";
				$query = $this->db->query($sql);
				return $query->num_rows();
			}else{
				return FALSE;
			}
		}
		
		function postbycat(){
			$notformatted = $this->valid_ads_range();
			$category_id = $this->uri->segment(3, 0);
			if($category_id != "0"){
				$catval = explode("_", $category_id);
				$searchby = "ad_".$catval[0];
				$searchval = $catval[1];
				if($searchval == "suv"){
					$searchval = "Sport Utility Vehicle (SUV)";
				}elseif($searchval == "station"){
				    $searchval = "Station Wagon";
				}
				$offset = $this->uri->segment(4, 0);
				$sql = "SELECT * FROM anuncios WHERE $searchby LIKE '%$searchval%' AND ad_expires >= '$notformatted' AND ad_complete='1' ORDER BY ad_categoria ASC LIMIT 10 OFFSET $offset";
				$query = $this->db->query($sql);
				if ($query->num_rows() > 0){
					foreach($query->result() as $row){
						$data[] = $row;
					}
					return $data;
				}
			}else{
				return FALSE;
			}
		}
		
		function rowsbycat(){
			$notformatted = $this->valid_ads_range();
			$category_id = $this->uri->segment(3, 0);
			if($category_id != "0"){
				$catval = explode("_", $category_id);
				$searchby = "ad_".$catval[0];
				$searchval = $catval[1];
				if($searchval == "suv"){
					$searchval = "Sport Utility Vehicle (SUV)";
				}elseif($searchval == "station"){
                    $searchval = "Station Wagon";
                }
				$sql = "SELECT * FROM anuncios WHERE $searchby LIKE '%$searchval%' AND ad_expires >= '$notformatted' AND ad_complete='1' ORDER BY ad_modelo ASC";
				$query = $this->db->query($sql);
				return $query->num_rows();
			}else{
				return FALSE;
			}
		}
		
		function get_son_to_expire(){
			$week_from_today = date('Y-m-d', strtotime('+7 days'));
			//$week_from_today = date('Y-m-d');
			$sql = "SELECT * FROM anuncios WHERE ad_expires = '$week_from_today' AND ad_complete='1' ";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0){
				foreach($query->result() as $row){
					$data[] = $row;
				}
				return $data;
			}
		}
		
		
		function get_populares(){
			$notformatted = $this->valid_ads_range();
			$sql = "SELECT * FROM anuncios WHERE ad_expires >= '$notformatted' AND ad_complete='1' ORDER BY ad_visits DESC LIMIT 30";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0){
				foreach($query->result() as $row){
					$data[] = $row;
				}
				return $data;
			}
		}
		
		function get_destacados(){
			$notformatted = $this->valid_ads_range();
			$sql = "SELECT * FROM anuncios WHERE ad_categoria = 'A' AND ad_expires >= '$notformatted' AND ad_complete='1' ORDER BY ad_postedOn DESC LIMIT 30";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0){
				foreach($query->result() as $row){
					$data[] = $row;
				}
				return $data;
			}
		}
		
		function get_recientes(){
			$notformatted = $this->valid_ads_range();
			$sql = "SELECT * FROM anuncios WHERE ad_categoria = 'C' AND ad_expires >= '$notformatted' AND ad_complete='1' ORDER BY ad_postedOn DESC LIMIT 30";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0){
				foreach($query->result() as $row){
					$data[] = $row;
				}
				return $data;
			}
		}
		
		function get_aduanas(){
			$notformatted = $this->valid_ads_range();
			$sql = "SELECT * FROM anuncios WHERE ad_legalstatus='0' AND ad_expires >= '$notformatted' AND ad_complete='1' ORDER BY ad_visits DESC LIMIT 30";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0){
				foreach($query->result() as $row){
					$data[] = $row;
				}
				return $data;
			}
		}
		
	}

?>