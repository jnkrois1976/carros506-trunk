<?php

error_reporting(E_ALL);

class New_basic_listing_multiple_model extends CI_Model {
	
	function create_listing(){
		
		$profile_complete = $this->input->post('profile_complete');
		if($profile_complete == '0'){
			$define_seller_cat = $this->input->post('sellerCat');
		}elseif($profile_complete == '1'){
			$define_seller_cat = $this->input->post('sellerPrefix');
		}
		
		if($define_seller_cat == "Privado" || $define_seller_cat == "PR"){
			$seller_cat = "Privado";
			$seller_name = $this->input->post('sellerName');
			$seller_code = "VPR".$this->input->post('sellerCode');
		}elseif($define_seller_cat == "Agencia" || $define_seller_cat == "AG"){
			$seller_cat = "Agencia";
			$seller_name = $this->input->post('dealerName');
			$seller_code = "AGV".$this->input->post('sellerCode');
		}
		
		if($profile_complete == '0'){
			$seller_row_id = $this->input->post('sellerCode');
			if($define_seller_cat == "PR"){
				$member_data = array(
					'contact_categoria' => $this->input->post('sellerCat'),
					'contact_phone' => $this->input->post('sellerPhone'),
					'contact_provincia' => $this->input->post('sellerProvince'),
					'contact_canton' => $this->input->post('sellerCanton'),
					'contact_distrito' => $this->input->post('sellerDistrito'),
					'contact_direccion' => $this->input->post('sellerAddress'),
					'profile_complete' => "1"
				);
			}elseif($define_seller_cat == "AG"){
				$contact_prefix = 'AGV';
				$contact_fullid = 'AGV'.$this->input->post('sellerCode');
				$member_data = array(
					'dealer_name' => $this->input->post('dealerName'),
					'contact_prefix' => $contact_prefix,
					'contact_fullid' => $contact_fullid,
					'contact_categoria' => $this->input->post('sellerCat'),
					'contact_phone' => $this->input->post('sellerPhone'),
					'contact_provincia' => $this->input->post('sellerProvince'),
					'contact_canton' => $this->input->post('sellerCanton'),
					'contact_distrito' => $this->input->post('sellerDistrito'),
					'contact_direccion' => $this->input->post('sellerAddress'),
					'profile_complete' => "1"
				);
				$data = array('member_id' => $contact_fullid);
				$this->session->set_userdata($data);
			}
			
			$find_member = $this->db->where('contact_id', $seller_row_id);
			$update_member = $this->db->update('users', $member_data);
		}elseif($profile_complete == '1'){
			$seller_code = $this->input->post('sellerCode');
		}
		
		$this->db->select_max('ad_id');
		$query = $this->db->get('anuncios');
		if ($query->num_rows() > 0){
			$largestid = $query->row_array();
			if($largestid['ad_id'] == 0){
				if($define_seller_cat == "PR"){
					$ad_fullid = "PR".($largestid['ad_id'].'1000');
				}elseif($define_seller_cat == "AG"){
					$ad_fullid = "AG".($largestid['ad_id'].'1000');
				}
			}else{
				if($define_seller_cat == "PR"){
					$ad_fullid = "PR".($largestid['ad_id']+1);
				}elseif($define_seller_cat == "AG"){
					$ad_fullid = "AG".($largestid['ad_id']+1);
				}
			}
		}
		
		$create_new_listing = array(
			'ad_idprefix' => $define_seller_cat,
			'ad_fullid' => $ad_fullid,
			'ad_sellerId' => $seller_code,
			'ad_sellerName' => $seller_name,
			'ad_sellerEmail' => $this->input->post('sellerEmail'),
			'ad_sellerPhone' => $this->input->post('sellerPhone'),
			'ad_sellerCategory' => $seller_cat,
			'ad_location' => $this->input->post('adProvince'),
			'ad_categoria' => $this->input->post('listingCat'),
			'ad_pictures' => $this->input->post('totalImages'),
			'ad_expires' => $this->input->post('expiresOn'),
			'ad_marca' => $this->input->post('carMake'),
			'ad_modelo' => $this->input->post('carModel'),
			'ad_year' => $this->input->post('carYear'),
			'ad_legalstatus' => $this->input->post('legalStatus'),
			'ad_precio' => $this->input->post('carPrice'),
			'ad_transmision' => $this->input->post('carTrans'),
			'ad_kilometraje' => $this->input->post('carMileage'),
			'ad_postedOn' => $this->input->post('postedOn'),
			'ad_nuevo' => $this->input->post('carPlate'),
			'ad_complete' => "1"
		);
		
		$insert = $this->db->insert('anuncios', $create_new_listing);
		return true;
	}
	
	function do_upload() {
		
		$this->db->select_max('ad_id');
		$query = $this->db->get('anuncios');
		if ($query->num_rows() > 0){
			$largestid = $query->row_array();
		}
		$profile_complete = $this->input->post('profile_complete');
		if($profile_complete == '0'){
			$ad_pics_folder = strtolower($this->input->post('sellerCat')).$largestid['ad_id'];
			$folder_type = strtolower($this->input->post('sellerCat'));
		}elseif($profile_complete == '1'){
			$ad_pics_folder = strtolower($this->input->post('sellerPrefix')).$largestid['ad_id'];
			$folder_type = strtolower($this->input->post('sellerPrefix'));
		}
		
		mkdir("cars/large_thumb/".$ad_pics_folder, 0777);
		mkdir("cars/small_thumb/".$ad_pics_folder, 0777);
		$large_path = './cars/large_thumb/'.$ad_pics_folder;
		$small_path = './cars/small_thumb/'.$ad_pics_folder;
		
		$config['upload_path'] = $large_path;
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size']	= '10000';
		$this->load->library('upload', $config);
	    foreach($_FILES['userfile'] as $key => $file){
	        $i = 0;
	        foreach ($file as $item) {
	            $data[$i][$key] = $item;
	            $i++;
	        }
	    }
	    $file = ''; 
	    $_FILES = $data; 
	    for($j=0;$j<count($data);$j++){
	    	$pic_number = $j + 1;
	    	$newfilename = $folder_type.$largestid['ad_id']."_".$pic_number.".jpg";
	        $config['file_name'] = $newfilename;	
	        $this->upload->initialize($config); 
			$uploadimages = $this->upload->do_upload($j);
	        if($uploadimages){
	            $image_data = $this->upload->data();
				$file_name = $image_data['full_path'];
				$file_width = intval($image_data['image_width']);
				$file_height = intval($image_data['image_height']);
				
				if($file_width > $file_height){
					$horizontal = true;
					$vertical = false;
					$difference = $file_width - $file_height;
					$division = $file_width / 4;
					if($difference == $division){
						$aspect = true;
					}elseif($difference > $division){
						$aspect = false;
					}
				}
				if($file_height > $file_width){
					$horizontal = false;
					$vertical = true;
					$difference = $file_height - $file_width;
					$division = $file_height / 4;
					if($difference == $division){
						$aspect = true;
					}elseif($difference > $division){
						$aspect = false;
					}
				}
		
				if($aspect == false){
					if($horizontal){
						
						$calc_width = $file_height / 3;
						$new_width = $calc_width * 4;
						$cropping = $file_width - $new_width;
						list($current_width, $current_height) = getimagesize($file_name);
						$left = $cropping;
						$top = 0;
						$crop_width = $new_width;
						$crop_height = $file_height;
						$canvas = imagecreatetruecolor($crop_width, $crop_height);
						$current_image = imagecreatefromjpeg($file_name);
						imagecopy($canvas, $current_image, 0, 0, $left, $top, $current_width, $current_height);
						imagejpeg($canvas, $file_name, 100);
						
						$configlarge = array(
							'source_image' => $image_data['full_path'],
							'new_image' => $large_path,
							'maintain_ratio' => true,
							'quality' => 70,
							'width' => 700,
							'height' => 525
						);
						$this->load->library('image_lib', $configlarge);
						$this->image_lib->initialize($configlarge);
						$resizelarge = $this->image_lib->resize();
						
						$wat_mark['source_image'] = $file_name;
						$wat_mark['wm_overlay_path'] = 'images/logo.png';
						$wat_mark['wm_opacity'] = 50;
						$wat_mark['wm_type'] = 'overlay';
						$wat_mark['wm_vrt_alignment'] = 'bottom';
						$wat_mark['wm_hor_alignment'] = 'left';
						$wat_mark['wm_padding'] = '0';
						$wat_mark['wm_hor_offset'] = '10';
						$wat_mark['wm_vrt_offset'] = '10';
						$this->load->library('image_lib', $wat_mark);
						$this->image_lib->initialize($wat_mark);
						$this->image_lib->watermark();
						
						$configsmall = array(
							'source_image' => $image_data['full_path'],
							'new_image' => $small_path,
							'maintain_ratio' => true,
							'quality' => 50,
							'width' => 100,
							'height' => 75
						);
						$this->load->library('image_lib', $configsmall);
						$this->image_lib->initialize($configsmall);
						$resizesmall = $this->image_lib->resize();
						
					}elseif($vertical){
						
						$calc_height = $file_width / 4;
						$new_height = $calc_height * 3;
						$cropping = $file_height - $new_height;
						list($current_width, $current_height) = getimagesize($file_name);
						$left = 0;
						$top = $cropping;
						$crop_width = $file_width;
						$crop_height = $new_height;
						$canvas = imagecreatetruecolor($crop_width, $crop_height);
						$current_image = imagecreatefromjpeg($file_name);
						imagecopy($canvas, $current_image, 0, 0, $left, $top, $current_width, $current_height);
						imagejpeg($canvas, $file_name, 100);
						
						$configlarge = array(
							'source_image' => $image_data['full_path'],
							'new_image' => $large_path,
							'maintain_ratio' => true,
							'quality' => 70,
							'width' => 700,
							'height' => 525
						);
						$this->load->library('image_lib', $configlarge);
						$this->image_lib->initialize($configlarge);
						$resizelarge = $this->image_lib->resize();
						
						$wat_mark['source_image'] = $file_name;
						$wat_mark['wm_overlay_path'] = 'images/logo.png';
						$wat_mark['wm_opacity'] = 50;
						$wat_mark['wm_type'] = 'overlay';
						$wat_mark['wm_vrt_alignment'] = 'bottom';
						$wat_mark['wm_hor_alignment'] = 'left';
						$wat_mark['wm_padding'] = '0';
						$wat_mark['wm_hor_offset'] = '10';
						$wat_mark['wm_vrt_offset'] = '10';
						$this->load->library('image_lib', $wat_mark);
						$this->image_lib->initialize($wat_mark);
						$this->image_lib->watermark();
						
						$configsmall = array(
							'source_image' => $image_data['full_path'],
							'new_image' => $small_path,
							'maintain_ratio' => true,
							'quality' => 50,
							'width' => 100,
							'height' => 75
						);
						$this->load->library('image_lib', $configsmall);
						$this->image_lib->initialize($configsmall);
						$resizesmall = $this->image_lib->resize();
						
					}
				}elseif($aspect == true){
					if($vertical){
						
						$calc_height = $file_width / 4;
						$new_height = $calc_height * 3;
						$cropping = $file_height - $new_height;
						list($current_width, $current_height) = getimagesize($file_name);
						$left = 0;
						$top = $cropping;
						$crop_width = $file_width;
						$crop_height = $new_height;
						$canvas = imagecreatetruecolor($crop_width, $crop_height);
						$current_image = imagecreatefromjpeg($file_name);
						imagecopy($canvas, $current_image, 0, 0, $left, $top, $current_width, $current_height);
						imagejpeg($canvas, $file_name, 100);
						
						$configlarge = array(
							'source_image' => $image_data['full_path'],
							'new_image' => $large_path,
							'maintain_ratio' => true,
							'quality' => 70,
							'width' => 700,
							'height' => 525
						);
						$this->load->library('image_lib', $configlarge);
						$this->image_lib->initialize($configlarge);
						$resizelarge = $this->image_lib->resize();
						
						$wat_mark['source_image'] = $file_name;
						$wat_mark['wm_overlay_path'] = 'images/logo.png';
						$wat_mark['wm_opacity'] = 50;
						$wat_mark['wm_type'] = 'overlay';
						$wat_mark['wm_vrt_alignment'] = 'bottom';
						$wat_mark['wm_hor_alignment'] = 'left';
						$wat_mark['wm_padding'] = '0';
						$wat_mark['wm_hor_offset'] = '10';
						$wat_mark['wm_vrt_offset'] = '10';
						$this->load->library('image_lib', $wat_mark);
						$this->image_lib->initialize($wat_mark);
						$this->image_lib->watermark();
						
						$configsmall = array(
							'source_image' => $image_data['full_path'],
							'new_image' => $small_path,
							'maintain_ratio' => true,
							'quality' => 50,
							'width' => 100,
							'height' => 75
						);
						$this->load->library('image_lib', $configsmall);
						$this->image_lib->initialize($configsmall);
						$resizesmall = $this->image_lib->resize();
						
					}elseif($horizontal){
						$configlarge = array(
							'source_image' => $image_data['full_path'],
							'new_image' => $large_path,
							'maintain_ratio' => true,
							'quality' => 70,
							'width' => 700,
							'height' => 525
						);
						$this->load->library('image_lib', $configlarge);
						$this->image_lib->initialize($configlarge);
						$resizelarge = $this->image_lib->resize();
						
						$wat_mark['source_image'] = $file_name;
						$wat_mark['wm_overlay_path'] = 'images/logo.png';
						$wat_mark['wm_opacity'] = 50;
						$wat_mark['wm_type'] = 'overlay';
						$wat_mark['wm_vrt_alignment'] = 'bottom';
						$wat_mark['wm_hor_alignment'] = 'left';
						$wat_mark['wm_padding'] = '0';
						$wat_mark['wm_hor_offset'] = '10';
						$wat_mark['wm_vrt_offset'] = '10';
						$this->load->library('image_lib', $wat_mark);
						$this->image_lib->initialize($wat_mark);
						$this->image_lib->watermark();
						
						$configsmall = array(
							'source_image' => $image_data['full_path'],
							'new_image' => $small_path,
							'maintain_ratio' => true,
							'width' => 100,
							'height' => 75
						);
						$this->load->library('image_lib', $configsmall);
						$this->image_lib->initialize($configsmall);
						$resizesmall = $this->image_lib->resize();
					}
				}
	        }
	    }
		
		if($uploadimages && $resizelarge && $resizesmall){
			return true;
		}
	}
	
}

?>