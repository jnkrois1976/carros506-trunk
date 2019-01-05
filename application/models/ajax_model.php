<?php

	class Ajax_model extends CI_Model {
		
		function valid_ads_range(){
			$expireDay = date("d");
			$months = date("m");
			$expireYear = date("Y");
			$notformatted = $expireYear."-".$months."-".$expireDay;
			return $notformatted;
		}
		
		/*function valid_ads_range(){
			$expireMonth = date("m");
			if($expireMonth == 01){
				$expireDay = "31";
				$months = "12";
				$expireYear = date("Y")-1;
			}else{
				$expireDay = date("d");
				$months = date("m");
				$expireYear = date("Y");
			}
			$notformatted = $expireYear."-".$months."-".$expireDay;
			return $notformatted;
		}*/
		
		function allmodels(){
			$make = $this->input->post('make');
			$modelsquery = "SELECT DISTINCT ad_modelo FROM anuncios WHERE ad_marca = '$make' AND ad_complete='1' ORDER BY ad_modelo ASC";
			$allmodels = $this->db->query($modelsquery);
			if ($allmodels->num_rows() > 0){
				foreach($allmodels->result() as $row){
					$allmodelsresult[] = $row;
				}
				return $allmodelsresult;
			}
		}
		
		function allmodelsraw(){
			$make = $this->input->post('make');
			$modelsquery = "SELECT DISTINCT ad_modelo FROM anuncios WHERE ad_marca = '$make' AND ad_complete='1' ORDER BY ad_modelo ASC";
			$allmodels = $this->db->query($modelsquery);
			if ($allmodels->num_rows() > 0){
				foreach($allmodels->result() as $row){
					$allmodelsresult[] = $row->ad_modelo;
				}
				return $allmodelsresult;
			}
		}
		
		function all_cantones(){
			$provincia = $this->input->post('provincia');
			$canton_query = "SELECT DISTINCT canton FROM locations WHERE provincia = '$provincia' ORDER BY canton ASC";
			$all_cantones = $this->db->query($canton_query);
			if ($all_cantones->num_rows() > 0){
				foreach($all_cantones->result() as $row){
					$all_cantones_result[] = $row;
				}
				return $all_cantones_result;
			}
		}
		
		function all_distritos(){
			$canton = $this->input->post('canton');
			$distritos_query = "SELECT DISTINCT distrito FROM locations WHERE canton = '$canton' ORDER BY distrito ASC";
			$all_distritos = $this->db->query($distritos_query);
			if ($all_distritos->num_rows() > 0){
				foreach($all_distritos->result() as $row){
					$all_distritos_result[] = $row;
				}
				return $all_distritos_result;
			}
		}
		
		function getrequestedposts(){
			$notformatted = $this->valid_ads_range();
			$make = $this->input->post("make");
			$model = $this->input->post("model");
			$minamount = $this->input->post("minamount");
			$maxamount = $this->input->post('maxamount');
			$yearstart = $this->input->post('yearstart');
			$yearend = $this->input->post('yearend');
			$sql = "SELECT *
				FROM anuncios
				WHERE ad_marca = '$make'
				AND ad_modelo = '$model'
				AND ad_precio >= '$minamount'
				AND ad_precio <= '$maxamount'
				AND ad_year >= '$yearstart'
				AND ad_year <= '$yearend'
				AND ad_expires >= '$notformatted'
				AND ad_complete = '1' 
				ORDER BY ad_categoria ASC";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0){
				foreach($query->result() as $row){
					$data[] = $row;
				}
				return $data;
			}
		}
		
		function get_requested_basic_posts(){
			$notformatted = $this->valid_ads_range();
			$make = $this->input->post("make");
			$model = $this->input->post("model");
			$minamount = $this->input->post("minamount");
			$maxamount = $this->input->post('maxamount');
			$yearstart = $this->input->post('yearstart');
			$yearend = $this->input->post('yearend');
			$sql = "SELECT *
				FROM anuncios
				WHERE ad_marca = '$make'
				AND ad_modelo = '$model'
				AND ad_precio >= '$minamount'
				AND ad_precio <= '$maxamount'
				AND ad_year >= '$yearstart'
				AND ad_year <= '$yearend'
				AND ad_expires >= '$notformatted'
				AND ad_complete = '1' 
				ORDER BY ad_categoria ASC";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0){
				foreach($query->result() as $row){
					$data[] = $row;
				}
				return $data;
			}
		}
		
		function save_message(){
			$buyer_name = $this->input->post("buyer_name");
			$buyer_email = $this->input->post("buyer_email");
			$seller_id = $this->input->post("seller_id");
			$ad_fullid = $this->input->post("ad_fullid");
			$buyer_message = $this->input->post("buyer_message");
			$ad_expires = $this->input->post("ad_expires");
			$message_date = date("Y")."-".date("n")."-".date("j");
			$where_to_db = $this->input->post("where_to_save");
			$save_new_message = array(
				'buyer_name' => $buyer_name,
				'buyer_email' => $buyer_email,
				'seller_id' => $seller_id,
				'ad_fullid' => $ad_fullid,
				'buyer_message' => $buyer_message,
				'ad_expires' => $ad_expires,
				'message_date' => $message_date,
				'reviewed' => "0"
			);
			$insert = $this->db->insert('quick_messages', $save_new_message);
			
			if($where_to_db == "anuncios_premier"){
				$sql = "SELECT ad_messages FROM anuncios_premier WHERE ad_fullid = '$ad_fullid' LIMIT 1";
			}elseif($where_to_db == "anuncios"){
				$sql = "SELECT ad_messages FROM anuncios WHERE ad_fullid = '$ad_fullid' LIMIT 1";
			}
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0){
			   $messages_number = $query->row_array();
			}
			$update_messages_number = ($messages_number['ad_messages'] + 1);
			$update_messages = array('ad_messages' => $update_messages_number);
			$this->db->where('ad_fullid', $ad_fullid);
			if($where_to_db == "anuncios_premier"){
				$this->db->update('anuncios_premier', $update_messages);
			}elseif($where_to_db == "anuncios"){
				$this->db->update('anuncios', $update_messages);
			}
			return $insert;
		}
		
		function save_comment(){
			$buyer_name = $this->input->post("buyer_name");
			$buyer_comment = $this->input->post("buyer_comment");
			$comment_date = $this->input->post("comment_date");
			$ad_fullid = $this->input->post("ad_fullid");
			$ad_sellerId = $this->input->post("ad_sellerId");
			$ad_expires = $this->input->post("ad_expires");
			$where_to_db = $this->input->post("where_to_save");
			$save_new_comment = array(
				'buyer_name' => $buyer_name,
				'buyer_comment' => $buyer_comment,
				'comment_date' => $comment_date,
				'ad_fullid' => $ad_fullid,
				'ad_sellerId' => $ad_sellerId,
				'public' => "0",
				'reviewed' => "0",
				'ad_expires' => $ad_expires
			);
			$insert = $this->db->insert('comments', $save_new_comment);
			
			$sql = "SELECT ad_comments FROM anuncios WHERE ad_fullid = '$ad_fullid' LIMIT 1";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0){
			   $comments_number = $query->row_array();
			}
			$update_comments_number = ($comments_number['ad_comments'] + 1);
			$update_comments = array('ad_comments' => $update_comments_number);
			$this->db->where('ad_fullid', $ad_fullid);
			$this->db->update('anuncios', $update_comments);
			
			return $insert;
		}

		function updaterating(){
			$member_Id = $this->session->userdata('member_id');
			$ad_fullid = $this->input->post("ad_fullid");
			$ad_rating = $this->input->post("ad_rating");
			$create_new_rating = array(
				'ad_fullid' => $ad_fullid,
				'contact_fullid' => $member_Id,
				'rating_score' => $ad_rating
			);
			$create_rating = $this->db->insert('ratings', $create_new_rating);
			$rating_query = "SELECT * FROM anuncios WHERE ad_fullid = '$ad_fullid' LIMIT 1";
			$query = $this->db->query($rating_query);
			if ($query->num_rows() > 0){
			   $ratings_voter = $query->row_array();
			}
			$update_ad_rating = ($ratings_voter['ad_rating'] + $ad_rating);
			$update_ad_voters = ($ratings_voter['ad_voters'] + 1);
			$update_post_rating = array('ad_rating' => $update_ad_rating, 'ad_voters' => $update_ad_voters);
			$this->db->where('ad_fullid', $ad_fullid);
			$this->db->update('anuncios', $update_post_rating);
			return $create_rating;
		}
		
		function update_rating_premier(){
			$member_Id = $this->session->userdata('member_id');
			$ad_fullid = $this->input->post("ad_fullid");
			$ad_rating = $this->input->post("ad_rating");
			$create_new_rating = array(
				'ad_fullid' => $ad_fullid,
				'contact_fullid' => $member_Id,
				'rating_score' => $ad_rating
			);
			$create_rating = $this->db->insert('ratings', $create_new_rating);
			$rating_query = "SELECT * FROM anuncios_premier WHERE ad_fullid = '$ad_fullid' LIMIT 1";
			$query = $this->db->query($rating_query);
			if ($query->num_rows() > 0){
			   $ratings_voter = $query->row_array();
			}
			$update_ad_rating = ($ratings_voter['ad_rating'] + $ad_rating);
			$update_ad_voters = ($ratings_voter['ad_voters'] + 1);
			$update_post_rating = array('ad_rating' => $update_ad_rating, 'ad_voters' => $update_ad_voters);
			$this->db->where('ad_fullid', $ad_fullid);
			$this->db->update('anuncios_premier', $update_post_rating);
			return $create_rating;
		}
		
		function favorite_post(){
			$ad_fullid = $this->input->post("ad_fullid");
			$contact_fullid = $this->input->post("contact_fullid");
			$ad_expires = $this->input->post("ad_expires");
			$create_favorite = array(
				'ad_fullid' => $ad_fullid,
				'contact_fullid' => $contact_fullid,
				'ad_expires' => $ad_expires
			);
			$add_new_favorite = $this->db->insert('favorites', $create_favorite);
			return $add_new_favorite;
		}
		
		function remove_favorite(){
			$ad_fullid = $this->input->post("ad_fullid");
			$contact_fullid = $this->input->post("contact_fullid");
			$remove_favorite_post = array(
				'ad_fullid' => $ad_fullid,
				'contact_fullid' => $contact_fullid
			);
			$remove_favorite_now = $this->db->delete('favorites', $remove_favorite_post);
			return $remove_favorite_now;
		}
		
		function save_reported_post(){
			$buyer_fullid = $this->input->post("buyer_fullid");
			$seller_fullid = $this->input->post("seller_fullid");
			$ad_fullid = $this->input->post("ad_fullid");
			$ad_expires = $this->input->post("ad_expires");
			$ad_reports = $this->input->post("ad_reports");
			$message = $this->input->post("message");
			$message_date = date("Y")."-".date("n")."-".date("j");
			$where_to_db = $this->input->post("where_to_save");
			$save_report = array(
				'buyer_fullid' => $buyer_fullid,
				'seller_fullid' => $seller_fullid,
				'ad_fullid' => $ad_fullid,
				'ad_expires' => $ad_expires,
				'report_message' => $message,
				'report_date' => $message_date,
				'report_verified' => '0'
			);
			$insert = $this->db->insert('reportados', $save_report);
			$update_report_count = array('ad_reports' => $ad_reports);
			$this->db->where('ad_fullid' , $ad_fullid);
			$this->db->update('anuncios', $update_report_count);
			
			return $insert;
		}
		
		function update_report_verified(){
			$id = $this->input->post("id");
			$ad_fullid = $this->input->post("ad_fullid");
			$seller_fullid = $this->input->post("seller_fullid");
			$mark_as_verified = array('report_verified' => '1');
			$this->db->where('id', $id);
			$this->db->where('ad_fullid', $ad_fullid);
			$this->db->where('seller_fullid', $seller_fullid);
			$make_comment_public = $this->db->update('reportados', $mark_as_verified);
			return $make_comment_public;
		}
		
		function make_comment_public(){
			$ad_fullid = $this->input->post("ad_fullid");
			$comment_id = $this->input->post("comment_id");
			$publicar = $this->input->post("publicar");
			$make_public = array('public' => $publicar);
			$this->db->where('ad_fullid', $ad_fullid);
			$this->db->where('id', $comment_id);
			$make_comment_public = $this->db->update('comments', $make_public);
			
			$sql = "SELECT ad_publicComments FROM anuncios WHERE ad_fullid = '$ad_fullid' LIMIT 1";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0){
			   $comments_number = $query->row_array();
			}
			$update_public_comments = ($comments_number['ad_publicComments'] + 1);
			$update_comments = array('ad_publicComments' => $update_public_comments);
			$this->db->where('ad_fullid', $ad_fullid);
			$this->db->update('anuncios', $update_comments);
			
			return $make_comment_public;
		}
		
		function make_comment_private(){
			$ad_fullid = $this->input->post("ad_fullid");
			$comment_id = $this->input->post("comment_id");
			$despublicar = $this->input->post("publicar");
			$make_private = array('public' => $despublicar);
			$this->db->where('ad_fullid', $ad_fullid);
			$this->db->where('id', $comment_id);
			$make_comment_private = $this->db->update('comments', $make_private);
			
			$sql = "SELECT ad_publicComments FROM anuncios WHERE ad_fullid = '$ad_fullid' LIMIT 1";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0){
			   $comments_number = $query->row_array();
			}
			$update_public_comments = ($comments_number['ad_publicComments'] - 1);
			$update_comments = array('ad_publicComments' => $update_public_comments);
			$this->db->where('ad_fullid', $ad_fullid);
			$this->db->update('anuncios', $update_comments);
			
			return $make_comment_private;
		}
		
		function mark_as_reviewed(){
			$ad_fullid = $this->input->post("ad_fullid");
			$comment_id = $this->input->post("comment_id");
			$reviewed = $this->input->post("reviewed");
			$mark_comment = array('reviewed' => $reviewed);
			$this->db->where('ad_fullid', $ad_fullid);
			$this->db->where('id', $comment_id);
			$make_comment_read = $this->db->update('comments', $mark_comment);
			return $make_comment_read;
		}
		
		function mark_ad_as_sold(){
			$ad_fullid = $this->input->post("ad_fullid");
			$mark_ad = array('ad_status' => "1");
			$this->db->where('ad_fullid', $ad_fullid);
			$make_ad_sold = $this->db->update('anuncios', $mark_ad);
			return $make_ad_sold;
		}
		
		function mark_ad_for_sale(){
			$ad_fullid = $this->input->post("ad_fullid");
			$mark_ad = array('ad_status' => "0");
			$this->db->where('ad_fullid', $ad_fullid);
			$make_for_sale = $this->db->update('anuncios', $mark_ad);
			return $make_for_sale;
		}
		
		function mark_message_as_reviewed(){
			$ad_fullid = $this->input->post("ad_fullid");
			$comment_id = $this->input->post("comment_id");
			$reviewed = $this->input->post("reviewed");
			$mark_message = array('reviewed' => $reviewed);
			$this->db->where('ad_fullid', $ad_fullid);
			$this->db->where('id', $comment_id);
			$make_message_read = $this->db->update('quick_messages', $mark_message);
			return $make_message_read;
		}

		function post_seller_reply(){
			$ad_fullid = $this->input->post("ad_fullid");
			$comment_id = $this->input->post("comment_id");
			$seller_reply = $this->input->post("seller_reply");
			$update_reply = array('seller_reply' => $seller_reply, "public" => "1");
			$this->db->where('ad_fullid', $ad_fullid);
			$this->db->where('id', $comment_id);
			$update_seller_reply = $this->db->update('comments', $update_reply);
			
			$sql = "SELECT ad_publicComments FROM anuncios WHERE ad_fullid = '$ad_fullid' LIMIT 1";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0){
			   $comments_number = $query->row_array();
			}
			$update_public_comments = ($comments_number['ad_publicComments'] + 1);
			$update_comments = array('ad_publicComments' => $update_public_comments);
			$this->db->where('ad_fullid', $ad_fullid);
			$this->db->update('anuncios', $update_comments);
			
			return $update_seller_reply;
		}
		
		function post_message_reply(){
			$ad_fullid = $this->input->post("ad_fullid");
			$message_id = $this->input->post("message_id");
			$seller_reply = $this->input->post("seller_reply");
			$todays_date = date('Y-m-d');
			$message_reply = array('seller_reply' => $seller_reply, 'reply_date' => $todays_date);
			$this->db->where('ad_fullid', $ad_fullid);
			$this->db->where('id', $message_id);
			$update_message_reply = $this->db->update('quick_messages', $message_reply);
			return $update_message_reply;
		}
		
		function update_ad_details(){
			$ad_fullid = $this->input->post("ad_fullid");
			$db_field = $this->input->post("db_field");
			$new_value = $this->input->post("new_value");
			$update_value = array($db_field => $new_value);
			$this->db->where('ad_fullid', $ad_fullid);
			$perform_update = $this->db->update('anuncios', $update_value);
			return $perform_update;
		}
		
		function edit_profile_details(){
			$ad_fullid = $this->input->post("ad_fullid");
			$db_field = $this->input->post("db_field");
			$new_value = $this->input->post("new_value");
			$profile_complete = $this->input->post("profile_complete");
			if($profile_complete == "1"){
				$update_value = array($db_field => $new_value, 'profile_complete' => $profile_complete);
			}else{
				$update_value = array($db_field => $new_value);
			}
			$this->db->where('contact_fullid', $ad_fullid);
			$perform_update = $this->db->update('users', $update_value);
			return $perform_update;
		}
		
		function edit_profile_address(){
			$contact_fullid = $this->input->post("contact_fullid");
			$contact_provincia = $this->input->post("contact_provincia");
			$contact_canton = $this->input->post("contact_canton");
			$contact_distrito = $this->input->post("contact_distrito");
			$profile_complete = $this->input->post("profile_complete");
			if($profile_complete == "1"){
				$update_value = array('contact_fullid' => $contact_fullid, 'contact_provincia' => $contact_provincia, 'contact_canton' => $contact_canton, 'contact_distrito' => $contact_distrito, 'profile_complete' => $profile_complete);
			}else{
				$update_value = array('contact_fullid' => $contact_fullid, 'contact_provincia' => $contact_provincia, 'contact_canton' => $contact_canton, 'contact_distrito' => $contact_distrito);
			}
			$this->db->where('contact_fullid', $contact_fullid);
			$perform_update = $this->db->update('users', $update_value);
			return $perform_update;
		}
		
		function update_img_number(){
			$img_count = ($this->input->post("img_count") - 1);
			$ad_fullid = strtoupper($this->input->post("folder_name"));
			$update_img_count = array('ad_pictures' => $img_count );
			$this->db->where('ad_fullid', $ad_fullid);
			$perform_update = $this->db->update('anuncios', $update_img_count);
			return $perform_update;
		}
		
		function validate_email(){
			$typed_email = $this->input->post("contact_email");
			$sql = "SELECT contact_email FROM users WHERE contact_email = '$typed_email' LIMIT 1";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0){
				return TRUE;
			}else{
				return FALSE;
			}
		}
		
		function extend_exp_date(){
			$ad_fullid = $this->input->post('ad_fullid');
			$ad_expires = $this->input->post('ad_expires');
			$update_exp_date = array('ad_expires' => $ad_expires);
			$this->db->where('ad_fullid', $ad_fullid);
			$perform_update = $this->db->update('anuncios', $update_exp_date);
			$perform_update_comments = $this->db->update('comments', $update_exp_date);
			$perform_update_favorites = $this->db->update('favorites', $update_exp_date);
			$perform_update_messages = $this->db->update('quick_messages', $update_exp_date);
			$perform_update_reported = $this->db->update('reportados', $update_exp_date);
			return $perform_update;
		}
        
        function save_user_message(){
            $seller_name = $this->input->post("seller_name");
            $user_email = $this->input->post("user_email");
            $dealer_name = $this->input->post("dealer_name");
            $asunto = $this->input->post("asunto");
            $ad_code = $this->input->post("ad_code");
            $seller_code = $this->input->post("seller_code");
            $user_message = $this->input->post("user_message");
            $save_new_user_message = array(
                'user_name' => $seller_name,
                'user_email' => $user_email,
                'dealer_name' => $dealer_name,
                'user_code' => $seller_code,
                'user_issue' => $asunto,
                'listing_code' => $ad_code,
                'user_msg' => $user_message,
                'msg_date' => date("Y")."-".date("m")."-".date("d")
            );
            $insert = $this->db->insert('user_messages', $save_new_user_message);
            
            return $insert;
        }
		
		function save_user_question(){
            $question_topic = $this->input->post("question_topic");
        	$user_question = $this->input->post("user_question");
            $save_new_user_question = array(
                'question_topic' => $question_topic,
                'user_question' => $user_question,
                'question_date' => date("Y")."-".date("m")."-".date("d")
            );
            $insert = $this->db->insert('user_questions', $save_new_user_question);
            
            return $insert;
        }
		
	}

?>