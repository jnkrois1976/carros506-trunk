<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL);

//include 'ChromePhp.php';
		

class Ajax extends CI_Controller {
	
	public function ajaxmodels(){
		$this->load->model('ajax_model');
		$allmodels = $this->ajax_model->allmodels();
		foreach($allmodels as $allmodels_row){
			echo "<option value='". $allmodels_row->ad_modelo ."'>" . $allmodels_row->ad_modelo . "</option>";
		}
	}
	
	public function modelsnewlisting(){
		$this->load->model('ajax_model');
		$allmodels = $this->ajax_model->allmodels();
		foreach($allmodels as $allmodels_row){
			if($allmodels_row->ad_modelo == ''){
				echo "failed";
			}else{
				echo "<li class='modelDisplay'>". $allmodels_row->ad_modelo ."</li>";
			}
		}
	}
	
	public function pageModelModelsObject(){
		$this->load->model('ajax_model');
		$allmodelsraw = $this->ajax_model->allmodelsraw();
		if($allmodelsraw){
			/*$trim_objects = array_merge($allmodels);
			$trimKeys = array_values($trim_objects);
			ChromePhp::log($trimKeys);*/
			echo implode(',',$allmodelsraw);
		}else{
			echo "failed";
		}
	}
	
	public function cantones(){
		$this->load->model('ajax_model');
		$all_cantones = $this->ajax_model->all_cantones();
		$current_canton = $this->input->post("canton");
		foreach($all_cantones as $all_cantones_option){
			if($current_canton == $all_cantones_option->canton){
				echo "<option class='canton' value='".$all_cantones_option->canton."' selected='selected'>".$all_cantones_option->canton."</option>";
			}else{
				echo "<option class='canton' value='".$all_cantones_option->canton."'>".$all_cantones_option->canton."</option>";
			}
			
		}
	}
	
	public function distritos(){
		$this->load->model('ajax_model');
		$all_distritos = $this->ajax_model->all_distritos();
		$current_distrito = $this->input->post("distrito");
		foreach($all_distritos as $all_distritos_option){
			if($current_distrito == $all_distritos_option->distrito){
				echo "<option class='distrito' value='".$all_distritos_option->distrito."' selected='selected'>".$all_distritos_option->distrito."</option>";
			}else{
				echo "<option class='distrito' value='".$all_distritos_option->distrito."'>".$all_distritos_option->distrito."</option>";
			}
			
		}
	}
	
	public function quick_message(){
		$this->load->model('ajax_model');
		$save_message = $this->ajax_model->save_message();
		$this->load->model('profile_model');
		$buyer_info = $this->profile_model->buyer_info();
		$seller_info = $this->profile_model->seller_info();
		if(site_url() == 'http://carros506.local/'){
			$mail_server = 'localhost';
		}elseif(site_url() == 'http://carros506.com/' || site_url() == 'http://dev.carros506.com/'){
			$mail_server = 'relay-hosting.secureserver.net';
		}
		$email_template = '
			<html>
				<head>
					<title>Mensaje de Carros506.com</title>
				</head>
				<body>
					<table cellpadding="1" cellspacing="2" border="0" width="600">
						<tr>
							<td><img src="http://carros506.com/images/carros506.jpg" alt="Carros506.com"></td>
						</tr>
						<tr>
							<td>
							'.$buyer_info['contact_fullname'].' le ha enviado un mensaje acerca de su '.$seller_info['ad_marca'].' '.$seller_info['ad_modelo'].' - '.$seller_info['ad_year'].'<br /><br />
							Puede revisar el mensaje ingresando a su cuenta en <a href="http://carros506.com">carros506.com</a>
							</td>
						</tr>
					</table>
				</body>
			</html>
		';
		$config['protocol'] = 'sendmail';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['smtp_host'] = $mail_server;
		$config['smtp_port'] = '25';
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$this->email->from('manager@carros506.com', 'Carros506.com');
		$this->email->to($seller_info['ad_sellerEmail']);
		//$this->email->to('jnkrois@gmail.com');
		$this->email->reply_to('noreply@carros506.com');
		$this->email->subject('Has recibido un mensaje de '.$buyer_info['contact_fullname']);
		$this->email->message($email_template);
		$send_message = $this->email->send();
		if($save_message == true && $send_message == true){
			echo "success";
		}else{
			echo "failed";
		}
	}
	
	public function add_comment(){
		$this->load->model('ajax_model');
		$save_comment = $this->ajax_model->save_comment();
		$this->load->model('profile_model');
		$buyer_info = $this->profile_model->buyer_info();
		$seller_info = $this->profile_model->seller_info();
		if(site_url() == 'http://carros506.local/'){
			$mail_server = 'localhost';
		}elseif(site_url() == 'http://carros506.com/' || site_url() == 'http://dev.carros506.com/'){
			$mail_server = 'relay-hosting.secureserver.net';
		}
		$email_template = '
			<html>
				<head>
					<title>Mensaje de Carros506.com</title>
				</head>
				<body>
					<table cellpadding="1" cellspacing="2" border="0" width="600">
						<tr>
							<td><img src="http://carros506.com/images/carros506.jpg" alt="Carros506.com"></td>
						</tr>
						<tr>
							<td>
							'.$buyer_info['contact_fullname'].' ha agregado un comentario a su anuncio publicado,
							acerca de su '.$seller_info['ad_marca'].' '.$seller_info['ad_modelo'].' - '.$seller_info['ad_year'].'<br /><br />
							Puede revisar el mensaje ingresando a su cuenta en <a href="http://carros506.com">carros506.com</a>
							</td>
						</tr>
					</table>
				</body>
			</html>
		';
		$config['protocol'] = 'sendmail';
		$config['mailpath'] = '/usr/sbin/sendmail -t -i';
		$config['smtp_host'] = $mail_server;
		$config['smtp_port'] = '25';
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$this->email->from('manager@carros506.com', 'Carros506.com');
		$this->email->to($seller_info['ad_sellerEmail']);
		//$this->email->to('jnkrois@gmail.com');
		$this->email->reply_to('noreply@carros506.com');
		$this->email->subject('Has recibido un mensaje de '.$buyer_info['contact_fullname']);
		$this->email->message($email_template);
		$send_message = $this->email->send();
		if($save_comment == true && $send_message == true){
			echo "success";
		}else{
			echo "failed";
		}
	}
	
	public function message_to_friend(){
		$buyer_name = $this->input->post("buyer_name");
		$buyer_link = $this->input->post("buyer_link");
		$image_link = $this->input->post("image_link");
		$email_friend = $this->input->post("email_friend");
		$actual_message = $this->input->post("actual_message");
		if(site_url() == 'http://carros506.local/'){
			$mail_server = 'localhost';
		}elseif(site_url() == 'http://carros506.com/' || site_url() == 'http://dev.carros506.com/'){
			$mail_server = 'relay-hosting.secureserver.net';
		}
		$email_template = '
			<html>
				<head>
					<title>Mensaje de Carros506.com</title>
				</head>
				<body>
					<table cellpadding="1" cellspacing="2" border="0" width="600">
						<tr>
							<td><img src="http://carros506.com/images/carros506.jpg" alt="Carros506.com"></td>
						</tr>
						<tr>
							<td>
							Su amigo(a) '.$buyer_name.' le envi&oacute; este mensaje para mostrarle un veh&iacute;culo este Carros506.com.<br /><br />
							<img src="'.$image_link.'" />
							Puede visitar el anuncio por medio de <a href="'.$buyer_link.'">este link</a>.<br /><br />
							El mensaje de su amigo es:<br /><br />
							'.$actual_message.'
							</td>
						</tr>
					</table>
				</body>
			</html>
		';
		$config['protocol'] = 'sendmail';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['smtp_host'] = $mail_server;
		$config['smtp_port'] = '25';
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$this->email->from('manager@carros506.com', 'Carros506.com');
		$this->email->to($email_friend);
		//$this->email->to('jnkrois@gmail.com');
		$this->email->reply_to('noreply@carros506.com');
		$this->email->subject('Has recibido un mensaje departe de '.$buyer_name);
		$this->email->message($email_template);
		$send_message = $this->email->send();
		if($send_message == true){
			echo "success";
		}else{
			echo "failed";
		}
	}

	public function report_post(){
		$this->load->model('ajax_model');
		$save_reported_post = $this->ajax_model->save_reported_post();
		$this->load->model('profile_model');
		$seller_info = $this->profile_model->seller_info();
		if(site_url() == 'http://carros506.local/'){
			$mail_server = 'localhost';
		}elseif(site_url() == 'http://carros506.com/' || site_url() == 'http://dev.carros506.com/'){
			$mail_server = 'relay-hosting.secureserver.net';
		}
		$email_template = '
			<html>
				<head>
					<title>Mensaje de Carros506.com</title>
				</head>
				<body>
					<table cellpadding="1" cellspacing="2" border="0" width="600">
						<tr>
							<td><img src="http://carros506.com/images/carros506.jpg" alt="Carros506.com"></td>
						</tr>
						<tr>
							<td>
							El administrador de Carros506.com le ha enviado un mensaje acerca de su '.$seller_info['ad_marca'].' '.$seller_info['ad_modelo'].' - '.$seller_info['ad_year'].'<br /><br />
							Este anuncio ha sido reportado por un posible comprador.<br /><br />
							Puede revisar los detalles del reporte ingresando a su cuenta en <a href="http://carros506.com/profile/dashboard/">carros506.com</a>
							</td>
						</tr>
					</table>
				</body>
			</html>
		';
		$config['protocol'] = 'sendmail';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['smtp_host'] = $mail_server;
		$config['smtp_port'] = '25';
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$this->email->from('manager@carros506.com', 'Carros506.com');
		$this->email->to($seller_info['ad_sellerEmail']);
		//$this->email->to('jnkrois@gmail.com');
		$this->email->reply_to('noreply@carros506.com');
		$this->email->subject('Has recibido un mensaje del administrador de Carros506.com');
		$this->email->message($email_template);
		$send_message = $this->email->send();
		if($save_reported_post == true && $send_message == true){
			echo "success";
		}else{
			echo "failed";
		}
	}

	public function verify_report(){
		$this->load->model('ajax_model');
		$update_report_verified = $this->ajax_model->update_report_verified();
		if($update_report_verified){
		echo "success";
		}else{
			echo "failed";
		}
	}

	public function rate_post(){
		$this->load->model('ajax_model');
		$updaterating = $this->ajax_model->updaterating();
		if($updaterating){
		echo "success";
		}else{
			echo "failed";
		}
	}

	public function renew_post(){
		$this->load->model('ajax_model');
		$extend_exp_date = $this->ajax_model->extend_exp_date();
		if($extend_exp_date){
		echo "success";
		}else{
			echo "failed";
		}
	}

	public function rate_post_premier(){
		$this->load->model('ajax_model');
		$update_rating_premier = $this->ajax_model->update_rating_premier();
		if($update_rating_premier){
		echo "success";
		}else{
			echo "failed";
		}
	}

	public function add_to_fav(){
		$this->load->model('ajax_model');
		$favorite_post = $this->ajax_model->favorite_post();
		if($favorite_post){
		echo "success";
		}else{
			echo "failed";
		}
	}
	
	public function remove_from_fav(){
		$this->load->model('ajax_model');
		$remove_favorite = $this->ajax_model->remove_favorite();
		if($remove_favorite){
		echo "success";
		}else{
			echo "failed";
		}
	}

	public function make_public(){
		$this->load->model('ajax_model');
		$make_comment_public = $this->ajax_model->make_comment_public();
		if($make_comment_public){
		echo "success";
		}else{
			echo "failed";
		}
	}
	
	public function make_private(){
		$this->load->model('ajax_model');
		$make_comment_private = $this->ajax_model->make_comment_private();
		if($make_comment_private){
		echo "success";
		}else{
			echo "failed";
		}
	}

	public function mark_as_read(){
		$this->load->model('ajax_model');
		$mark_as_reviewed = $this->ajax_model->mark_as_reviewed();
		if($mark_as_reviewed){
		echo "success";
		}else{
			echo "failed";
		}
	}
	
	public function mark_as_sold(){
		$this->load->model('ajax_model');
		$mark_ad_as_sold = $this->ajax_model->mark_ad_as_sold();
		if($mark_ad_as_sold){
		echo "success";
		}else{
			echo "failed";
		}
	}
	
	public function mark_for_sale(){
		$this->load->model('ajax_model');
		$mark_ad_for_sale = $this->ajax_model->mark_ad_for_sale();
		if($mark_ad_for_sale){
		echo "success";
		}else{
			echo "failed";
		}
	}
	
	public function mark_message_as_read(){
		$this->load->model('ajax_model');
		$mark_message_as_reviewed = $this->ajax_model->mark_message_as_reviewed();
		if($mark_message_as_reviewed){
		echo "success";
		}else{
			echo "failed";
		}
	}

	public function reply_to_comment(){
		$this->load->model('ajax_model');
		$post_seller_reply = $this->ajax_model->post_seller_reply();
		if($post_seller_reply){
		echo "success";
		}else{
			echo "failed";
		}
	}
	
	public function reply_to_message(){
		$this->load->model('ajax_model');
		$post_message_reply = $this->ajax_model->post_message_reply();
		if($post_message_reply){
			$this->load->model('profile_model');
			$seller_info = $this->profile_model->seller_info();
			if(site_url() == 'http://carros506.local/'){
				$mail_server = 'localhost';
			}elseif(site_url() == 'http://carros506.com/' || site_url() == 'http://dev.carros506.com/'){
				$mail_server = 'relay-hosting.secureserver.net';
			}
			$email_template = '
				<html>
					<head>
						<title>Mensaje de Carros506.com</title>
					</head>
					<body>
						<table cellpadding="1" cellspacing="2" border="0" width="600">
							<tr>
								<td><img src="http://carros506.com/images/carros506.jpg" alt="Carros506.com"></td>
							</tr>
							<tr>
								<td>
								'.$seller_info['ad_sellerName'].' ha respondido a su mensaje acerca del '.$seller_info['ad_marca'].' '.$seller_info['ad_modelo'].' - '.$seller_info['ad_year'].' que tiene a la venta.<br /><br />
								La respuesta a su mensaje es la siguiente: <br/ ><br />
								<strong>'.$this->input->post('seller_reply').'</strong>
								</td>
							</tr>
						</table>
					</body>
				</html>
			';
			$config['protocol'] = 'sendmail';
			$config['mailpath'] = '/usr/sbin/sendmail';
			$config['smtp_host'] = $mail_server;
			$config['smtp_port'] = '25';
			$config['mailtype'] = 'html';
			$this->email->initialize($config);
			$this->email->from('donotreply@carros506.com', 'Carros506.com');
			$this->email->to($this->input->post('buyer_email'));
			//$this->email->to('jnkrois@gmail.com');
			$this->email->reply_to('donotreply@carros506.com');
			$this->email->subject('Has recibido un mensaje de '.$seller_info['ad_sellerName']);
			$this->email->message($email_template);
			$send_message = $this->email->send();
			
			echo "success";
			
		}else{
			echo "failed";
		}
	}
	
	public function update_ad(){
		$this->load->model('ajax_model');
		$edit_ad_details = $this->ajax_model->update_ad_details();
		if($edit_ad_details){
		echo "success";
		}else{
			echo "failed";
		}
	}
	
	public function update_profile(){
		$this->load->model('ajax_model');
		$edit_profile_details = $this->ajax_model->edit_profile_details();
		if($edit_profile_details){
			echo "success";
		}else{
			echo "failed";
		}
	}
	
	public function update_address(){
		$this->load->model('ajax_model');
		$edit_profile_address = $this->ajax_model->edit_profile_address();
		if($edit_profile_address){
			echo "success";
		}else{
			echo "failed";
		}
	}
	
	public function delete_image(){
		$image_name = $this->input->post("image_name");
		$folder_name = $this->input->post("folder_name");
		//$img_count = $this->input->post("img_count");
		$large_image = "cars/large_thumb/".$folder_name."/".$image_name;
		$small_image = "cars/small_thumb/".$folder_name."/".$image_name;
		if(unlink($large_image) && unlink($small_image)){
			$this->load->model('ajax_model');
			$update_img_number = $this->ajax_model->update_img_number();
			if($update_img_number){
				echo "success";
			}else{
				echo "failed";
			}
		}else{
			
		}
	}
	
	public function anuncios(){
		$this->load->model('ajax_model');
		$requestedposts = $this->ajax_model->getrequestedposts();
		if($requestedposts){
			foreach($requestedposts as $post_row){
				$today = date('Y-m-d');
				$posted_date = date_create($post_row->ad_postedOn);
				$posted_date_format = date_format($posted_date, 'Y-m-d');
				$week_ahead = date_add($posted_date, date_interval_create_from_date_string('7 days'));
				$week_ahead_format = date_format($week_ahead, 'Y-m-d');
				$img_folder = strtolower($post_row->ad_idprefix).$post_row->ad_id;
				$folder_path = 'cars/large_thumb/'.$img_folder.'/';
				$images = get_filenames($folder_path);
				if($post_row->ad_categoria == "A"){
					$ad_type = 'anuncio/';
				}elseif($post_row->ad_categoria == "B"){
					$ad_type = 'anuncio_medio/';
				}elseif($post_row->ad_categoria == "C"){
					$ad_type = 'anuncio_basico/';	
				}
				if($today >= $posted_date_format && $today <= $week_ahead_format){
					$car_image = '<img src="/images/new_large_badge.png" class="newBadge" width="75" />';
				}elseif($post_row->ad_nuevo == "1"){
					$car_image = "<img src='/images/estrenar_badge.png' class='newBadge'  width='75'/>";
				}elseif($post_row->ad_nuevo == "0"){
					$car_image = "<img src='/images/usado_badge.png' class='newBadge'  width='75'/>";
				}
				setlocale(LC_MONETARY, 'it_IT');
				setlocale(LC_TIME, "es_ES");
				if($post_row->ad_categoria == "A"){
					$break_date_a = explode('-', $post_row->ad_postedOn);
					echo '<div class="carThumb ajaxFadeIn '.$condition = ($post_row->ad_nuevo == 1 ? "nuevo": "usado").'">
						<table cellpadding="0" cellspacing="0" border="0" class="postedAd" width="100%">
							<colgroup>
								<col width="35%"/>
								<col width="30%"/>
								<col width="35%" />
							</colgroup>
							<tbody>
								<tr>
									<td valign="top">
										<h5 class="postTitle">'.$post_row->ad_marca.' '.$post_row->ad_modelo.' - '.$post_row->ad_year.'</h5>
									</td>
									<td valign="top">
										<h6>Comentarios: '.$post_row->ad_publicComments.'</h6>
									</td>
									<td valign="top" align="right">
										<h6>Visitas: '.$post_row->ad_visits.'</h6>
									</td>
								</tr>
								<tr>
									<td style="position:relative;">
										'.$car_image.'
										<a href="/resultados/'.$ad_type.$post_row->ad_idprefix.$post_row->ad_id.'">
											<img src="/cars/large_thumb/'.$img_folder.'/'.$images[0].'" class="postThumb"/>
										</a><br />
										<a class="viewAdLink" href="/resultados/'.$ad_type.$post_row->ad_idprefix.$post_row->ad_id.'">Ver detalles</a>
									</td>
									<td style="vertical-align:top;">
										<ul class="listedDetails">
											<li>'.$post_row->ad_marca.'</li>
											<li>'.$post_row->ad_modelo.'</li>
											<li>'.$post_row->ad_year.'</li>
											<li>'.$post_row->ad_motor.' Cilindros</li>
											<li>'.$post_row->ad_transmision.'</li>
											<li>'.$post_row->ad_kilometraje.' Km</li>
											<li>&#8353; '.money_format('%!.0n', $post_row->ad_precio).'</li>
										</ul>
									</td>
									<td style="vertical-align:top;">
										<ul class="listedDetails">
											<li>'.$post_row->ad_estado.'</li>
											<li>'.$post_row->ad_color.'</li>
											<li>'.$post_row->ad_combustible.'</li>
											<li>Motor '.$post_row->ad_centimetros.' CC</li>
											<li>Tracci&oacute;n '.$post_row->ad_traccion.'</li>
											<li>Vendedor: '.$post_row->ad_sellerCategory.'</li>
											<li>Publicado el '.strftime("%e de %B, %Y", mktime(0, 0, 0, $break_date_a[1], $break_date_a[2], $break_date_a[0])).'</li>
										</ul>
									</td>
								</tr>
							</tbody>
						</table>
					</div>';
				}elseif($post_row->ad_categoria == "B"){
					$break_date_b = explode('-', $post_row->ad_postedOn);
					echo '<div class="carThumb ajaxFadeIn '.$condition = ($post_row->ad_nuevo == 1 ? "nuevo": "usado").'">
						<table cellpadding="0" cellspacing="0" border="0" class="postedAd" width="100%">
							<colgroup>
								<col width="35%"/>
								<col width="30%"/>
								<col width="35%" />
							</colgroup>
							<tbody>
								<tr>
									<td valign="top">
										<h5 class="postTitle">'.$post_row->ad_marca.' '.$post_row->ad_modelo.' - '.$post_row->ad_year.'</h5>
									</td>
									<td valign="top">
										<h6>Comentarios: '.$post_row->ad_publicComments.'</h6>
									</td>
									<td valign="top" align="right">
										<h6>Visitas: '.$post_row->ad_visits.'</h6>
									</td>
								</tr>
								<tr>
									<td style="position:relative;">
										'.$car_image.'
										<a href="/resultados/'.$ad_type.$post_row->ad_idprefix.$post_row->ad_id.'">
											<img src="/cars/large_thumb/'.$img_folder.'/'.$images[0].'" class="postThumb"/>
										</a><br />
										<a class="viewAdLink" href="/resultados/'.$ad_type.$post_row->ad_idprefix.$post_row->ad_id.'">Ver detalles</a>
									</td>
									<td style="vertical-align:top;">
										<ul class="listedDetails">
											<li>'.$post_row->ad_marca.'</li>
											<li>'.$post_row->ad_modelo.'</li>
											<li>'.$post_row->ad_year.'</li>
											<li>'.$post_row->ad_motor.' Cilindros</li>
											<li>'.$post_row->ad_transmision.'</li>
											<li>'.$post_row->ad_kilometraje.' Km</li>
											<li>&#8353; '.money_format('%!.0n', $post_row->ad_precio).'</li>
										</ul>
									</td>
									<td style="vertical-align:top;">
										<ul class="listedDetails">
											<li>'.$post_row->ad_combustible.'</li>
											<li>'.$post_row->ad_carroceria.'</li>
											<li>Vendedor: '.$post_row->ad_sellerCategory.'</li>
											<li>Publicado el '.strftime("%e de %B, %Y", mktime(0, 0, 0, $break_date_b[1], $break_date_b[2], $break_date_b[0])).'</li>
										</ul>
									</td>
								</tr>
							</tbody>
						</table>
					</div>';
				}elseif($post_row->ad_categoria == "C"){
					$break_date_c = explode('-', $post_row->ad_postedOn);
					echo '<div class="carThumb ajaxFadeIn '.$condition = ($post_row->ad_nuevo == 1 ? "nuevo": "usado").'">
						<table cellpadding="0" cellspacing="0" border="0" class="postedAd" width="100%">
							<colgroup>
								<col width="35%"/>
								<col width="35%"/>
								<col width="30%" />
							</colgroup>
							<tbody>
								<tr>
									<td valign="top">
										<h5 class="postTitle">'.$post_row->ad_marca.' '.$post_row->ad_modelo.' - '.$post_row->ad_year.'</h5>
									</td>
									<td valign="top">
										<h6>Visitas: '.$post_row->ad_visits.'</h6>
									</td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td style="position:relative;">
										'.$car_image.'
										<a href="/resultados/'.$ad_type.$post_row->ad_idprefix.$post_row->ad_id.'">
											<img src="/cars/large_thumb/'.$img_folder.'/'.$images[0].'" class="postThumb"/>
										</a><br />
										<a class="viewAdLink" href="/resultados/'.$ad_type.$post_row->ad_idprefix.$post_row->ad_id.'">Ver detalles</a>
									</td>
									<td style="vertical-align:top;">
										<ul class="listedDetails">
											<li>'.$post_row->ad_marca.'</li>
											<li>'.$post_row->ad_modelo.'</li>
											<li>'.$post_row->ad_year.'</li>
											<li>'.$post_row->ad_kilometraje.' Km</li>
											<li>&#8353; '.money_format('%!.0n', $post_row->ad_precio).'</li>
											<li>Vendedor: '.$post_row->ad_sellerCategory.'</li>
											<li>Publicado el '.strftime("%e de %B, %Y", mktime(0, 0, 0, $break_date_c[1], $break_date_c[2], $break_date_c[0])).'</li>
										</ul>
									</td>
									<td style="vertical-align:top;">&nbsp;</td>
								</tr>
							</tbody>
						</table>
					</div>';
				}
			}
		}elseif(!$requestedposts){
			echo 	'<div class="serverError">
						<table cellpadding="0" cellspacing="0" border="0" width="100%">
								<tr>
									<td width="90%" valign="center" align="center">
										<h5>
											No hay carros similares bajo ese criterio de busqueda. <br />Por favor cambie las opciones para actualizar los resultados.
										</h5>
									</td>
									<td width="10%" valign="center" align="left">
										<img src="/images/exclamation.png" />
									</td>
								</tr>
							</table>
					</div>';
		}
	}
	
	public function anuncio_basico(){
		$this->load->model('ajax_model');
		$similar_post = $this->ajax_model->get_requested_basic_posts();
		$current_post = $this->uri->segment(3, 0);
		if($similar_post){
			foreach($similar_post as $similar_post_row){
				$today = date('Y-m-d');
				$posted_date = date_create($similar_post_row->ad_postedOn);
				$posted_date_format = date_format($posted_date, 'Y-m-d');
				$week_ahead = date_add($posted_date, date_interval_create_from_date_string('7 days'));
				$week_ahead_format = date_format($week_ahead, 'Y-m-d');
				$img_folder = strtolower($similar_post_row->ad_idprefix).$similar_post_row->ad_id;
				$folder_path = 'cars/large_thumb/'.$img_folder.'/';
				$images = get_filenames($folder_path);
				if($today >= $posted_date_format && $today <= $week_ahead_format){
					$car_image = '<img src="/images/new_large_badge.png" class="newBadge"  width="75"/>';
				}elseif($similar_post_row->ad_nuevo == "1"){
					$car_image = "<img src='/images/estrenar_badge.png' class='newBadge'  width='75'/>";
				}elseif($similar_post_row->ad_nuevo == "0"){
					$car_image = "<img src='/images/usado_badge.png' class='newBadge' width='75' />";
				}
				setlocale(LC_MONETARY, 'it_IT');
				if($similar_post_row->ad_categoria == "A" && $similar_post_row->ad_fullid != 'PR1079'){
					echo '<div class="carThumb ajaxFadeIn '.$condition = ($similar_post_row->ad_nuevo == 1 ? "nuevo": "usado").'">
						<table cellpadding="0" cellspacing="0" border="0" class="postedAd" width="100%">
							<colgroup>
								<col width="35%"/>
								<col width="35%"/>
								<col width="30%" />
							</colgroup>
							<tbody>
								<tr>
									<td valign="top">
										<h5 class="postTitle">'.$similar_post_row->ad_marca.' '.$similar_post_row->ad_modelo.' - '.$similar_post_row->ad_year.'</h5>
									</td>
									<td valign="top">
										<h6>Comentarios: '.$similar_post_row->ad_publicComments.'&nbsp;&nbsp;Visitas: '.$similar_post_row->ad_visits.'</h6>
									</td>
									<td valign="top" align="right">
										<a class="buttonLink" href="/resultados/anuncio/'.$similar_post_row->ad_idprefix.$similar_post_row->ad_id.'">Ver detalles</a>
									</td>
								</tr>
								<tr>
									<td style="position:relative;">
										'.$car_image.'
										<a href="/resultados/'.$ad_type.$similar_post_row->ad_idprefix.$similar_post_row->ad_id.'">
											<img src="/cars/large_thumb/'.$img_folder.'/'.$images[0].'" class="postThumb"/>
										</a><br />
										<a class="viewAdLink" href="/resultados/'.$ad_type.$similar_post_row->ad_idprefix.$similar_post_row->ad_id.'">Ver detalles</a>
									</td>
									<td>
										<ul class="listedDetails">
											<li>'.$similar_post_row->ad_marca.'</li>
											<li>'.$similar_post_row->ad_modelo.'</li>
											<li>'.$similar_post_row->ad_year.'</li>
											<li>'.$similar_post_row->ad_motor.' Cilindros</li>
											<li>'.$similar_post_row->ad_transmision.'</li>
											<li>'.$similar_post_row->ad_kilometraje.' Km</li>
											<li>&#8353; '.money_format('%!.0n', $similar_post_row->ad_precio).'</li>
										</ul>
									</td>
									<td>
										<ul class="listedDetails">
											<li>'.$similar_post_row->ad_estado.' estado</li>
											<li>'.$similar_post_row->ad_color.'</li>
											<li>'.$similar_post_row->ad_combustible.'</li>
											<li>Motor '.$similar_post_row->ad_centimetros.' CC</li>
											<li>Tracci&oacute;n '.$similar_post_row->ad_traccion.'</li>
											<li>Vendedor '.$similar_post_row->ad_sellerCategory.'</li>
											<li>Publicado en '.date( 'd/m/Y', strtotime($similar_post_row->ad_postedOn)).'</li>
										</ul>
									</td>
								</tr>
							</tbody>
						</table>
					</div>';
				}elseif($similar_post_row->ad_categoria == "B" && $similar_post_row->ad_fullid != 'PR1079'){
					echo '<div class="carThumb ajaxFadeIn '.$condition = ($similar_post_row->ad_nuevo == 1 ? "nuevo": "usado").'">
						<table cellpadding="0" cellspacing="0" border="0" class="postedAd" width="100%">
							<colgroup>
								<col width="35%"/>
								<col width="35%"/>
								<col width="30%" />
							</colgroup>
							<tbody>
								<tr>
									<td valign="top">
										<h5 class="postTitle">'.$similar_post_row->ad_marca.' '.$similar_post_row->ad_modelo.' - '.$similar_post_row->ad_year.'</h5>
									</td>
									<td valign="top">
										<h6>Comentarios: '.$similar_post_row->ad_publicComments.'&nbsp;&nbsp;Visitas: '.$similar_post_row->ad_visits.'</h6>
									</td>
									<td valign="top" align="right">
										<a class="buttonLink" href="/resultados/anuncio_medio/'.$similar_post_row->ad_idprefix.$similar_post_row->ad_id.'">Ver detalles</a>
									</td>
								</tr>
								<tr>
									<td style="position:relative;">
										'.$car_image.'
										<a href="/resultados/'.$ad_type.$similar_post_row->ad_idprefix.$similar_post_row->ad_id.'">
											<img src="/cars/large_thumb/'.$img_folder.'/'.$images[0].'" class="postThumb"/>
										</a><br />
										<a class="viewAdLink" href="/resultados/'.$ad_type.$similar_post_row->ad_idprefix.$similar_post_row->ad_id.'">Ver detalles</a>
									</td>
									<td style="vertical-align:top;">
										<ul class="listedDetails">
											<li>'.$similar_post_row->ad_marca.'</li>
											<li>'.$similar_post_row->ad_modelo.'</li>
											<li>'.$similar_post_row->ad_year.'</li>
											<li>'.$similar_post_row->ad_motor.' Cilindros</li>
											<li>'.$similar_post_row->ad_transmision.'</li>
											<li>'.$similar_post_row->ad_kilometraje.' Km</li>
											<li>&#8353; '.money_format('%!.0n', $similar_post_row->ad_precio).'</li>
										</ul>
									</td>
									<td style="vertical-align:top;">
										<ul class="listedDetails">
											<li>'.$similar_post_row->ad_combustible.' estado</li>
											<li>'.$similar_post_row->ad_carroceria.'</li>
											<li>'.$similar_post_row->ad_sellerCategory.'</li>
											<li>Publicado en '.date( 'd/m/Y', strtotime($similar_post_row->ad_postedOn)).'</li>
										</ul>
									</td>
								</tr>
							</tbody>
						</table>
					</div>';
				}elseif($similar_post_row->ad_categoria == "C" && $similar_post_row->ad_fullid != 'PR1079'){
					echo '<div class="carThumb ajaxFadeIn '.$condition = ($similar_post_row->ad_nuevo == 1 ? "nuevo": "usado").'">
						<table cellpadding="0" cellspacing="0" border="0" class="postedAd" width="100%">
							<colgroup>
								<col width="35%"/>
								<col width="35%"/>
								<col width="30%" />
							</colgroup>
							<tbody>
								<tr>
									<td valign="top">
										<h5 class="postTitle">'.$similar_post_row->ad_marca.' '.$similar_post_row->ad_modelo.' - '.$similar_post_row->ad_year.'</h5>
									</td>
									<td valign="top" colspan="2">
										<h6>Visitas: '.$similar_post_row->ad_visits.'</h6>
									</td>
								</tr>
								<tr>
									<td style="position:relative;">
										'.$car_image.'
										<a href="/resultados/'.$ad_type.$similar_post_row->ad_idprefix.$similar_post_row->ad_id.'">
											<img src="/cars/large_thumb/'.$img_folder.'/'.$images[0].'" class="postThumb"/>
										</a><br />
										<a class="viewAdLink" href="/resultados/'.$ad_type.$similar_post_row->ad_idprefix.$similar_post_row->ad_id.'">Ver detalles</a>
									</td>
									<td style="vertical-align:top;">
										<div><strong>Datos del carro</strong></div><br />
										<ul class="listedDetails">
											<li>'.$similar_post_row->ad_marca.'</li>
											<li>'.$similar_post_row->ad_modelo.'</li>
											<li>'.$similar_post_row->ad_year.'</li>
											<li>'.$similar_post_row->ad_kilometraje.' Km</li>
											<li>&#8353; '.money_format('%!.0n', $similar_post_row->ad_precio).'</li>
										</ul>
									</td>
									<td style="vertical-align:top;">
										<div><strong>Datos del vendedor</strong></div><br />
										<ul class="listedDetails">
											
											<li><a href="/resultados/vendedor/'.$similar_post_row->ad_sellerId.'" class="plainDarkLink">'.$similar_post_row->ad_sellerName.'</a></li>
											<li>'.$similar_post_row->ad_sellerPhone.'</li>
											<li>'.$similar_post_row->ad_sellerCategory.'</li>
											<li>Publicado en '.date( 'd/m/Y', strtotime($similar_post_row->ad_postedOn)).'</li>
										</ul>
									</td>
								</tr>
							</tbody>
						</table>
					</div>';
				}
			}
		}elseif(!$similar_post){
			echo 	'<div class="serverError">
						<table cellpadding="0" cellspacing="0" border="0" width="100%">
							<tr>
								<td width="90%" valign="center" align="center">
									<h5>
										No hay carros similares bajo ese criterio de busqueda. <br />Por favor cambie las opciones para actualizar los resultados.
									</h5>
								</td>
								<td width="10%" valign="center" align="left">
									<img src="/images/exclamation.png" />
								</td>
							</tr>
						</table>
					</div>';
		}
	}

    public function contact_us(){
        
        $seller_name = $this->input->post("seller_name");
        $user_email = $this->input->post("user_email");
        $dealer_name = $this->input->post("dealer_name");
        $asunto = $this->input->post("asunto");
        $ad_code = $this->input->post("ad_code");
        $seller_code = $this->input->post("seller_code");
        $user_message = $this->input->post("user_message");
        $this->load->model('ajax_model');
        $save_message = $this->ajax_model->save_user_message();
        if(site_url() == 'http://carros506.local/'){
            $mail_server = 'localhost';
        }elseif(site_url() == 'http://carros506.com/' || site_url() == 'http://dev.carros506.com/'){
            $mail_server = 'relay-hosting.secureserver.net';
        }
        $email_template = '
            <html>
                <head>
                    <title>Mensaje de usuario</title>
                </head>
                <body>
                    <table cellpadding="1" cellspacing="2" border="0" width="600">
                        <tr>
                            <td>Nombre del usuario:</td>
                            <td>'.$seller_name.'</td>
                        </tr>
                        <tr>
                            <td>Email del usuario:</td>
                            <td>'.$user_email.'</td>
                        </tr>
                        <tr>
                            <td>Nombre de la agencia:</td>
                            <td>'.$dealer_name.'</td>
                        </tr>
                        <tr>
                            <td>Codigo de anuncio:</td>
                            <td>'.$ad_code.'</td>
                        </tr>
                        <tr>
                            <td>Codigo de usuario:</td>
                            <td>'.$seller_code.'</td>
                        </tr>
                        <tr>
                            <td>Asunto del mensaje:</td>
                            <td>'.$asunto.'</td>
                        </tr>
                        <tr>
                            <td>Mensaje del usuario:</td>
                            <td>'.$user_message.'</td>
                        </tr>
                        
                    </table>
                </body>
            </html>
        ';
        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['smtp_host'] = $mail_server;
        $config['smtp_port'] = '25';
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $this->email->from('manager@carros506.com', 'Carros506.com');
        //$this->email->to($email_friend);
        $this->email->to('jnkrois@gmail.com');
        $this->email->reply_to('noreply@carros506.com');
        $this->email->subject('Has recibido un mensaje departe de '.$seller_name);
        $this->email->message($email_template);
        $send_message = $this->email->send();
        if($send_message == true){
            echo "success";
        }else{
            echo "failed";
        }
    }

	public function user_question(){
        
        $question_topic = $this->input->post("question_topic");
        $user_question = $this->input->post("user_question");
        $this->load->model('ajax_model');
        $save_question = $this->ajax_model->save_user_question();
        if(site_url() == 'http://carros506.local/'){
            $mail_server = 'localhost';
        }elseif(site_url() == 'http://carros506.com/' || site_url() == 'http://dev.carros506.com/'){
            $mail_server = 'relay-hosting.secureserver.net';
        }
        $email_template = '
            <html>
                <head>
                    <title>Pregunta de usuario</title>
                </head>
                <body>
                    <table cellpadding="1" cellspacing="2" border="0" width="600">
                        <tr>
                            <td>Tema de la pregunta:</td>
                            <td>'.$question_topic.'</td>
                        </tr>
                        <tr>
                            <td>Pregunta del usuario:</td>
                            <td>'.$user_question.'</td>
                        </tr>
                        
                    </table>
                </body>
            </html>
        ';
        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['smtp_host'] = $mail_server;
        $config['smtp_port'] = '25';
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $this->email->from('manager@carros506.com', 'Carros506.com');
        //$this->email->to($email_friend);
        $this->email->to('jnkrois@gmail.com');
        $this->email->reply_to('noreply@carros506.com');
        $this->email->subject('Ha recibido una pregunta de un usuario');
        $this->email->message($email_template);
        $send_message = $this->email->send();
        if($send_message == true){
            echo "success";
        }else{
            echo "failed";
        }
    }
	
}