	<?php $this->load->view('includes/header'); ?>
	<section>
		<div class="centerContainer">
			<div class="mainContent">
				<?php if($authenticate == TRUE): ?>
					<h1><?=$this->lang->line('auth_acct_success')?></h1>
					<h5>
						<?=$this->lang->line('auth_login_tip')?>
					</h5>
					<br />
					<h5><?=$this->lang->line('auth_next_tip')?></h5>
					<div class="newListingBox">
						<span style="text-align: left;">
							<h5><?=$this->lang->line('auth_new_ad_header')?></h5>
						</span>
						<br />
						<a href="/profile/choose_ad">
							<img class="" src="/images/new_ad.jpg" />
						</a>
						<br /><br />
						<a href="/profile/choose_ad" class="secondaryButton"><?=$this->lang->line('auth_new_ad_btn')?></a>
					</div>
					<div class="newListingBox">
						<span style="text-align: left;">
							<h5><?=$this->lang->line('auth_car_search')?></h5>
						</span>
						<br />
						<a href="/site/index">
							<img class="" src="/images/go_home.jpg" />
						</a>
						<br /><br />
						<a href="/site/index" class="secondaryButton"><?=$this->lang->line('auth_go_home_btn')?></a>
					</div>
					<div class="newListingBox" style="margin-right: 0px">
						<span style="text-align: left;">
							<h5><?=$this->lang->line('auth_edit_profile_header')?></h5>
						</span>
						<br />
						<a href="/profile/member">
							<img class="" src="/images/goto_profile.jpg" />
						</a>
						<br /><br />
						<a href="/profile/member" class="secondaryButton"><?=$this->lang->line('auth_edit_profile_btn')?></a>
					</div>
				<?php elseif($authenticate == FALSE): ?>
					<h1><?=$this->lang->line('sw_please_login')?></h1>
					<h5><?=$this->lang->line('sw_login_tip')?></h5>
					<form method="post" action="/login/validate" id="loginFormWidget" novalidate="novalidate">
    					<fieldset>
    						<legend><?=$this->lang->line('legend_please_login')?></legend>
    						<label for="email"><?=$this->lang->line('label_email')?></label><br />
    						<input type="email" name="emailWidget" id="emailLoginWidget" value="" placeholder="<?=$this->lang->line('placeholder_email')?>" data-error="<?=$this->lang->line('error_msg_email')?>" onclick="this.select();"/><br /><br />
    						<label for="password"><?=$this->lang->line('label_password')?></label><br />
    						<input type="password" name="passwordWidget" id="passwordLoginWidget" value="" placeholder="<?=$this->lang->line('placeholder_hidden_password')?>" data-error="<?=$this->lang->line('error_msg_password')?>" onclick="this.select();"/><br /><br />
    						<input type="submit" value="<?=$this->lang->line('body_login')?>" name="loginWidget" id="loginWidget" class="button"/><span id="login_failedWidget"></span>
    					</fieldset>
    				</form>
				<?php endif; ?>
				
			</div>
		</div>
	</section>
	<script type="text/javascript" src="/js/common.js"></script>
	<?php $this->load->view('includes/footer'); ?>