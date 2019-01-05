	<?php $this->load->view('includes/header'); ?>
	<section>
		<div class="centerContainer">
			<div class="mainContent">
				<h1>
					<?=$this->lang->line('locked_login_required')?>
				</h1>
				<br /><br />
				<h5><?=$this->lang->line('locked_login_prompt')?></h5>
				<form method="post" action="/login/validate" id="loginFormWidget" novalidate="novalidate">
					<fieldset>
						<legend><?=$this->lang->line('legend_please_login')?></legend>
						<label for="email"><?=$this->lang->line('label_email')?></label><br />
						<input autofocus="autofocus" type="email" name="emailWidget" id="emailLoginWidget" value="" placeholder="<?=$this->lang->line('placeholder_email')?>" data-error="<?=$this->lang->line('error_msg_email')?>" onclick="this.select();"/><br /><br />
						<label for="password"><?=$this->lang->line('label_password')?></label><br />
						<input type="password" name="passwordWidget" id="passwordLoginWidget" value="" placeholder="<?=$this->lang->line('placeholder_hidden_password')?>" data-error="<?=$this->lang->line('error_msg_password')?>" onclick="this.select();"/><br /><br />
						<input type="submit" value="<?=$this->lang->line('body_login')?>" name="loginWidget" id="loginWidget" class="button"/><span id="login_failedWidget"></span>
					</fieldset>
				</form>
			</div>
		</div>
	</section>
	<script type="text/javascript" src="/js/common.js"></script>
	<?php $this->load->view('includes/footer'); ?>