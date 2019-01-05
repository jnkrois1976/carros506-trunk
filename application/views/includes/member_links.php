<?php
	$member_name = $this->session->userdata('member_name');
	$user_name = $this->session->userdata('username');
	$account_created = $this->session->userdata('accountcreated');
	if($member_name){
		echo "<li><a href='/profile/log_out'id='logmeout'>".$this->lang->line('body_logout')."</a></li>";
		//echo "<li><a href='/profile/member'>".$this->lang->line('nav_account_myprofile')."</a></li>";
		echo "<li class='welcome'>".$this->lang->line('body_welcome')." <strong>" . $member_name . "</strong>!</li>";
	}elseif($user_name){
		echo "<li><a href='/profile/log_out'id='logmeout'>".$this->lang->line('body_logout')."</a></li>";
		//echo "<li><a href='/profile/member'>".$this->lang->line('nav_account_myprofile')."</a></li>";
		echo "<li class='welcome'>".$this->lang->line('body_welcome')." <strong>" . $user_name . "</strong>!</li>";
	}else{
		echo "<li><a href='#' id='expandLogin'>".$this->lang->line('body_login')."</a></li>";
		if($account_created === false){
			echo "<li><a href='#' id='expandRegister'>".$this->lang->line('body_register')."</a></li>";
		}
	}
?>