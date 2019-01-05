	<?php $this->load->view('includes/header'); ?>
	<section>
		<div class="centerContainer">
			<div class="mainContent">
				<h1><?=$this->lang->line('pwd_reset_header')?></h1>
				<h5><?=$this->lang->line('pwd_reset_msg')?></h5>
				<form method="post" action="/password_reset/reset_pwd" id="resetPassword">
					<fieldset>
						<legend><?=$this->lang->line('legend_reset_pwd')?></legend>
						<label for="userEmail" class="fieldRequired"><?=$this->lang->line('label_your_email')?></label><br />
						<input type="email" name="userEmail" id="userEmail" value="" placeholder="<?=$this->lang->line('placeholder_email')?>" autocomplete="on" novalidate="novalidate" data-errorChar="<?=$this->lang->line('error_msg_email')?>" data-errorEmpty="<?=$this->lang->line('error_empty_email')?>" onclick="this.select();"/>
						<span id="fetch_email_failed"></span>
						<br /><br />
						<label for="pwdNew" class="fieldRequired"><?=$this->lang->line('label_new_password')?></label><br />
						<input type="password" name="pwdNew" id="pwdNew" value="" placeholder="<?=$this->lang->line('placeholder_new_password')?>" autocomplete="off'" novalidate="novalidate" data-errorEmpty="<?=$this->lang->line('error_pwd_empty')?>" onclick="this.select();"/><br /><br />
						<label for="pwdNewRepeat" class="fieldRequired"><?=$this->lang->line('label_confirm_new_pwd')?></label><br />
						<input type="password" name="pwdNewRepeat" id="pwdNewRepeat" value="" placeholder="<?=$this->lang->line('placeholder_confirm_new_password')?>" autocomplete="off'" novalidate="novalidate" data-errorEmpty="<?=$this->lang->line('error_pwd_repeat_empty')?>" data-errorMatch="<?=$this->lang->line('error_pwd_mismatch')?>" onclick="this.select();"/>
						<br /><br /><br /><br />
						<input type="submit" name="resetSubmit" id="resetSubmit" value="<?=$this->lang->line('pwd_reset_btn')?>" class="button" disabled="disabled" /><br /><br />
						<small>
							<?=$this->lang->line('pwd_reset_disclaimer')?> 
						</small>
					</fieldset>
				</form>
			</div>
		</div>
	</section>
	<script type="text/javascript" src="/js/common.js"></script>
	<?php $this->load->view('includes/footer'); ?>