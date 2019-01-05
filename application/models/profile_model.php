<?php

	class Profile_model extends CI_Model {
		
		function valid_ads_range(){
			$expireDay = date("d");
			$months = date("m");
			$expireYear = date("Y");
			$notformatted = $expireYear."-".$months."-".$expireDay;
			return $notformatted;
		}
		
		function active_ads_per_member(){
			$notformatted = $this->valid_ads_range();
			$member_Id = $this->session->userdata('member_id');
			$sql = "SELECT * FROM anuncios WHERE ad_sellerId = '$member_Id' AND ad_expires >= '$notformatted'";
			$query = $this->db->query($sql);
			return $query->num_rows();
		}
		
		function expired_ads_per_member(){
			$notformatted = $this->valid_ads_range();
			$member_Id = $this->session->userdata('member_id');
			$sql = "SELECT * FROM anuncios WHERE ad_sellerId = '$member_Id' AND ad_expires <= '$notformatted'";
			$query = $this->db->query($sql);
			return $query->num_rows();
		}
		
		function reported_ads_per_member(){
			$notformatted = $this->valid_ads_range();
			$member_Id = $this->session->userdata('member_id');
			$sql = "SELECT * FROM anuncios WHERE ad_sellerId = '$member_Id' AND ad_expires <= '$notformatted'";
			$query = $this->db->query($sql);
			return $query->num_rows();
		}
		
		function ads_per_member(){
			$member_Id = $this->session->userdata('member_id');
			$sql = "SELECT * FROM anuncios WHERE ad_sellerId = '$member_Id'";
			$query = $this->db->query($sql);
			return $query->num_rows();
		}
				
		function count_messages(){
			$notformatted = $this->valid_ads_range();
			$member_Id = $this->session->userdata('member_id');
			$sql = "SELECT * FROM quick_messages WHERE seller_id = '$member_Id' AND ad_expires >= '$notformatted'";
			$query = $this->db->query($sql);
			return $query->num_rows();
		}
		
		function count_comments(){
			$notformatted = $this->valid_ads_range();
			$member_Id = $this->session->userdata('member_id');
			$sql = "SELECT * FROM comments WHERE ad_sellerId = '$member_Id' AND ad_expires >= '$notformatted'";
			$query = $this->db->query($sql);
			return $query->num_rows();
		}
		
		function get_post_messages(){
			$notformatted = $this->valid_ads_range();
			$member_Id = $this->session->userdata('member_id');
			$offset = $this->uri->segment(3, 0);
			$sql = "SELECT DISTINCT * 
					FROM anuncios 
					WHERE ad_sellerId='$member_Id' 
					AND (ad_comments > '0' OR ad_messages > '0') 
					AND ad_expires >= '$notformatted'
					ORDER BY ad_fullid DESC LIMIT 10 OFFSET $offset";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0){
				foreach($query->result() as $row){
					$data[] = $row;
				}
				return $data;
			}
		}
		
		function all_posts_comments(){
			$member_Id = $this->session->userdata('member_id');
			$sql = "SELECT * FROM comments WHERE ad_sellerId='$member_Id' ORDER BY timestamp DESC";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0){
				foreach($query->result() as $row){
					$data[] = $row;
				}
				return $data;
			}
		}
		
		function count_new_comments(){
			$notformatted = $this->valid_ads_range();
			$member_Id = $this->session->userdata('member_id');
			$sql = "SELECT * FROM comments WHERE ad_sellerId='$member_Id' AND reviewed='0' AND ad_expires >= '$notformatted'";
			$query = $this->db->query($sql);
			return $query->num_rows();
		}
		
		function count_private_comments(){
			$notformatted = $this->valid_ads_range();
			$member_Id = $this->session->userdata('member_id');
			$sql = "SELECT * FROM comments WHERE ad_sellerId='$member_Id' AND public='0' AND ad_expires >= '$notformatted'";
			$query = $this->db->query($sql);
			return $query->num_rows();
		}
		
		function count_unanswered_comments(){
			$notformatted = $this->valid_ads_range();
			$member_Id = $this->session->userdata('member_id');
			$sql = "SELECT * FROM comments WHERE ad_sellerId='$member_Id' AND seller_reply='' AND ad_expires >= '$notformatted'";
			$query = $this->db->query($sql);
			return $query->num_rows();
		}
		
		function all_posts_messages(){
			$member_Id = $this->session->userdata('member_id');
			$sql = "SELECT * FROM quick_messages WHERE seller_id='$member_Id' ORDER BY timestamp DESC";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0){
				foreach($query->result() as $row){
					$data[] = $row;
				}
				return $data;
			}
		}
		
		function count_new_messages(){
			$notformatted = $this->valid_ads_range();
			$member_Id = $this->session->userdata('member_id');
			$sql = "SELECT * FROM quick_messages WHERE seller_id='$member_Id' AND reviewed='0' AND ad_expires >= '$notformatted'";
			$query = $this->db->query($sql);
			return $query->num_rows();
		}
		
		function count_unanswered_messages(){
			$notformatted = $this->valid_ads_range();
			$member_Id = $this->session->userdata('member_id');
			$sql = "SELECT * FROM quick_messages WHERE seller_id='$member_Id' AND seller_reply='' AND ad_expires >= '$notformatted'";
			$query = $this->db->query($sql);
			return $query->num_rows();
		}
		
		function count_with_messages(){
			$notformatted = $this->valid_ads_range();
			$member_Id = $this->session->userdata('member_id');
			$offset = $this->uri->segment(3, 0);
			$sql = "SELECT DISTINCT ad_fullid FROM comments WHERE ad_sellerId='$member_Id' AND ad_expires >= '$notformatted'  
					UNION 
					SELECT DISTINCT ad_fullid FROM quick_messages WHERE seller_id='$member_Id' AND ad_expires >= '$notformatted'";
			$query = $this->db->query($sql);
			return $query->num_rows();
		}
		
		
		function validate_ads(){
			$member_id = $this->session->userdata('member_id');
			$ad_fullid = $this->uri->segment(3, 0);
			$sql = "SELECT * FROM anuncios WHERE ad_sellerId = '$member_id' AND ad_fullid = '$ad_fullid' LIMIT 1";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0){
			   return true;
			}elseif($query->num_rows() == 0){
				return false;
			}
		}
		
		function getads(){
			$notformatted = $this->valid_ads_range();
			$offset = $this->uri->segment(3, 0);
			$member_Id = $this->session->userdata('member_id');
			$sql = "SELECT * FROM anuncios WHERE ad_sellerId = '$member_Id' AND ad_expires >= '$notformatted' ORDER BY ad_expires ASC LIMIT 10 OFFSET $offset";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0){
				foreach($query->result() as $row){
					$data[] = $row;
				}
				return $data;
			} 
		}
		
		function expired_ads_query(){
			$notformatted = $this->valid_ads_range();
			$offset = $this->uri->segment(3, 0);
			$member_Id = $this->session->userdata('member_id');
			$sql = "SELECT * FROM anuncios WHERE ad_sellerId = '$member_Id' AND ad_expires <= '$notformatted' ORDER BY ad_marca ASC LIMIT 10 OFFSET $offset";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0){
				foreach($query->result() as $row){
					$data[] = $row;
				}
				return $data;
			} 
		}
		
		function reported_ads_query(){
			$notformatted = $this->valid_ads_range();
			$offset = $this->uri->segment(3, 0);
			$member_Id = $this->session->userdata('member_id');
			$sql = "SELECT DISTINCT anuncios.* 
					FROM anuncios 
					INNER JOIN reportados 
					ON anuncios.ad_fullid=reportados.ad_fullid 
					WHERE seller_fullid = '$member_Id' 
					AND reportados.ad_expires >= '$notformatted' 
					ORDER BY reportados.timestamp DESC 
					LIMIT 10 OFFSET $offset";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0){
				foreach($query->result() as $row){
					$data[] = $row;
				}
				return $data;
			}
		}
		
		function count_new_reports(){
			$notformatted = $this->valid_ads_range();
			$offset = $this->uri->segment(3, 0);
			$member_Id = $this->session->userdata('member_id');
			$sql = "SELECT ad_fullid FROM reportados WHERE seller_fullid = '$member_Id' AND report_verified = '0' AND ad_expires >= '$notformatted'";
			$query = $this->db->query($sql);
			return $query->num_rows();
		}
		
		function count_admin_verified(){
			$notformatted = $this->valid_ads_range();
			$offset = $this->uri->segment(3, 0);
			$member_Id = $this->session->userdata('member_id');
			$sql = "SELECT ad_fullid FROM reportados WHERE seller_fullid = '$member_Id' AND admin_verified = '0' AND ad_expires >= '$notformatted'";
			$query = $this->db->query($sql);
			return $query->num_rows();
		}
		
		function get_total_reported(){
			$notformatted = $this->valid_ads_range();
			$member_Id = $this->session->userdata('member_id');
			$sql = "SELECT DISTINCTROW(ad_fullid) FROM reportados WHERE seller_fullid = '$member_Id' AND ad_expires >= '$notformatted'";
			$query = $this->db->query($sql);
			return $query->num_rows();
		}
		
		function get_all_reports(){
			$notformatted = $this->valid_ads_range();
			$member_Id = $this->session->userdata('member_id');
			$sql = "SELECT * FROM reportados WHERE seller_fullid = '$member_Id' AND ad_expires >= '$notformatted'";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0){
				foreach($query->result() as $row){
					$data[] = $row;
				}
				return $data;
			}
		}
	
		
		function find_favorites(){
			$notformatted = $this->valid_ads_range();
			$offset = $this->uri->segment(3, 0);
			$member_Id = $this->session->userdata('member_id');
			$sql = "SELECT * FROM favorites WHERE contact_fullid = '$member_Id' AND ad_expires >= '$notformatted' LIMIT 1";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0){
				return TRUE;
			}
		}
		
		function get_favorites(){
			$notformatted = $this->valid_ads_range();
			$offset = $this->uri->segment(3, 0);
			$member_Id = $this->session->userdata('member_id');
			$sql = "SELECT anuncios.* 
					FROM anuncios 
					INNER JOIN favorites 
					ON anuncios.ad_fullid=favorites.ad_fullid 
					WHERE contact_fullid = '$member_Id' 
					AND anuncios.ad_expires >= '$notformatted' 
					ORDER BY ad_expires DESC 
					LIMIT 10 OFFSET $offset";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0){
				foreach($query->result() as $row){
					$data[] = $row;
				}
				return $data;
			}
		}
		
		function get_favorites_premier(){
			$notformatted = $this->valid_ads_range();
			$offset = $this->uri->segment(3, 0);
			$member_Id = $this->session->userdata('member_id');
			$sql = "SELECT anuncios_premier.* 
					FROM anuncios_premier 
					INNER JOIN favorites 
					ON anuncios_premier.ad_fullid=favorites.ad_fullid 
					WHERE contact_fullid = '$member_Id' 
					AND anuncios_premier.ad_expires >= '$notformatted' 
					ORDER BY ad_expires DESC 
					LIMIT 10 OFFSET $offset";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0){
				foreach($query->result() as $row){
					$data[] = $row;
				}
				return $data;
			}
		}
		
		function get_total_favorites(){
			$notformatted = $this->valid_ads_range();
			$member_Id = $this->session->userdata('member_id');
			$sql = "SELECT * FROM favorites WHERE contact_fullid = '$member_Id' AND ad_expires >= '$notformatted'";
			$query = $this->db->query($sql);
			return $query->num_rows();
		}
		
		function getcontact(){
			$member_Id = $this->session->userdata('member_id');
            if($member_Id){
                $prefix_pattern = "/[A-Z]{3}/";
                $id_pattern = "/[0-9]{4,8}/";
                preg_match($prefix_pattern, $member_Id, $prefix_matches);
                preg_match($id_pattern, $member_Id, $id_matches);
                $sql = "SELECT * FROM users WHERE contact_prefix = '$prefix_matches[0]' AND contact_id = '$id_matches[0]' LIMIT 1";
                $query = $this->db->query($sql);
                if ($query->num_rows() > 0){
                   $row = $query->row_array();
                   return $row;
                }
            }else{
                return FALSE;
            }
		}
		
		function get_table_headers(){
			$headers = $this->db->list_fields('anuncios');
			$table_headers = array();
			foreach($headers as $field){
				array_push($table_headers, $field);
			} 
			return $table_headers;
		}
		
		function buyer_info(){
			$buyer_id = $this->input->post("buyer_id");
			$sql = "SELECT * FROM users WHERE contact_fullid = '$buyer_id' LIMIT 1";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0){
			   $row = $query->row_array();
			   return $row;
			} 
		}
		
		function seller_info(){
			$ad_fullid = $this->input->post("ad_fullid");
			$where_to_db = $this->input->post("where_to_save");
			if($where_to_db == "anuncios_premier"){
				$sql = "SELECT * FROM anuncios_premier WHERE ad_fullid = '$ad_fullid' LIMIT 1";
			}elseif($where_to_db == "anuncios" || $where_to_db == "" || $where_to_db == NULL){
				$sql = "SELECT * FROM anuncios WHERE ad_fullid = '$ad_fullid' LIMIT 1";
			}
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0){
			   $row = $query->row_array();
			   return $row;
			} 
		}
		
		function last_ad(){
			$member_Id = $this->session->userdata('member_id');
			$this->db->select_max('ad_id');
			$this->db->where('ad_sellerId', $member_Id);
			$query = $this->db->get('anuncios');
			if ($query->num_rows() > 0){
				$largestid = $query->row_array();
			}
			$ad_fullid = $largestid['ad_id'];
			$sql = "SELECT MAX(ad_fullid) AS ad_fullid, ad_categoria, ad_marca, ad_modelo, ad_year FROM anuncios WHERE ad_sellerId = '$member_Id' AND ad_id ='$ad_fullid' LIMIT 1";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0){
			   $row = $query->row_array();
			   return $row;
			} 
		}
		
		function last_multiple_posting(){
			$member_Id = $this->session->userdata('member_id');
			$notformatted = $this->valid_ads_range();
			$sql = "SELECT * FROM anuncios WHERE ad_sellerId = '$member_Id' AND ad_postedOn = '$notformatted' AND ad_complete='0' LIMIT 10";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0){
				foreach($query->result() as $row){
					$data[] = $row;
				}
				return $data;
			}
		}
		
		function save_new_password(){
			$current_email = $this->input->post("userEmail");
			$new_password = $this->input->post("pwdNew");
			$repeat_new_password = $this->input->post("pwdNewRepeat");
			if($new_password == $repeat_new_password){
				$encrypted_pwd = md5($repeat_new_password);
				$update_pwd = array('contact_password' => $encrypted_pwd );
				$this->db->where('contact_email', $current_email);
				$perform_update = $this->db->update('users', $update_pwd);
				return $perform_update;
			}
		}
		
		function authenticate(){
			$logged_member = $this->session->userdata('member_id');
			if(empty($logged_member) == FALSE){
				$authenticate = array('authenticate' => "1");
				$this->db->where('contact_fullid', $logged_member);
				$perform_update = $this->db->update('users', $authenticate);
				if($perform_update){
					return TRUE;
				}else{
					return FALSE;
				}
			}
		}
		
		function is_account_auth(){
			$logged_member = $this->session->userdata('member_id');
			$account_auth_query = "SELECT authenticate, contact_categoria, profile_complete FROM users WHERE contact_fullid = '$logged_member' LIMIT 1";
			$account_auth_verify = $this->db->query($account_auth_query);
			if ($account_auth_verify->num_rows() > 0){
				$auth_retrieved = $account_auth_verify->row_array();
			}
			$account_auth_result = array('auth' => $auth_retrieved['authenticate'], 'cat' => $auth_retrieved['contact_categoria'], 'profile_complete' => $auth_retrieved['profile_complete']);
			return $account_auth_result;
		}
		
		function set_seller_dealer(){
			$logged_member = $this->session->userdata('member_id');
			$seller_type_query = "SELECT contact_id FROM users WHERE contact_fullid = '$logged_member' LIMIT 1";
			$query = $this->db->query($seller_type_query);
			if ($query->num_rows() > 0){
			   $row = $query->row();
			}
			$contact_fullid = 'AGV'.$row->contact_id;
			$member_data = array(
					'contact_prefix' => "AGV",
					'contact_fullid' => $contact_fullid,
					'contact_categoria' => "AG"
				);
			$this_member = $this->db->where('contact_fullid', $logged_member);
			$update_member = $this->db->update('users', $member_data);
			if($update_member){
				$data = array(
					'member_id' => $contact_fullid
				);
				$this->session->set_userdata($data);
				return TRUE;
			}
		}
		
		function set_seller_private(){
			$logged_member = $this->session->userdata('member_id');
			$member_data = array(
					'contact_categoria' => "PR"
				);
			$this_member = $this->db->where('contact_fullid', $logged_member);
			$update_member = $this->db->update('users', $member_data);
			if($update_member){
				return TRUE;
			}
		}
		
	}

?>