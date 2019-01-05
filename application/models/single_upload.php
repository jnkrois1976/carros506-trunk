<?php

error_reporting(E_ALL);

include 'ChromePhp.php';


class Single_upload extends CI_Model {
	
	function update_listing(){
		$curr_img_count = $this->input->post('newImgCount');
		if($curr_img_count == "1"){
			$update_listing = array('ad_pictures' => $this->input->post('newImgCount'), 'ad_complete' => '1');
		}elseif($curr_img_count > "1"){
			$update_listing = array('ad_pictures' => $this->input->post('newImgCount'));
		}
		$this->db->where('ad_fullid', $this->input->post('ad_fullid'));
		$update_img_count = $this->db->update('anuncios', $update_listing);
		if($update_img_count){
			return true;
		}
	}
	
	function do_upload() {
		
		$ad_pics_folder = strtolower($this->input->post('ad_fullid'));
		$large_path = './cars/large_thumb/'.$ad_pics_folder;
		$small_path = './cars/small_thumb/'.$ad_pics_folder;
		$curr_img_count = $this->input->post('newImgCount');
		if($curr_img_count == "1"){
			mkdir("cars/large_thumb/".$ad_pics_folder, 0777);
			mkdir("cars/small_thumb/".$ad_pics_folder, 0777);
		}
		$newfilename = $this->input->post('image_name');
		$config['upload_path'] = $large_path;
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size']	= '8000';
		$config['file_name'] = $newfilename;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$field_name = "userfile";
		$uploadimages = $this->upload->do_upload($field_name);
		$image_data = $this->upload->data();
		$file_name = $image_data['full_path'];
		$file_width = intval($image_data['image_width']);
		$file_height = intval($image_data['image_height']);
		ChromePhp::log($this->upload->display_errors());
		ChromePhp::log($large_path);
		
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
		
		if($uploadimages && $resizelarge && $resizesmall){
			return true;
		}
		
	}
	
}

?>