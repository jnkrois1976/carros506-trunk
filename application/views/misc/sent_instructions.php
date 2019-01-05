	<?php $this->load->view('includes/header'); ?>
	<section>
		<div class="centerContainer">
			<div class="mainContent">
				<h1><?=$this->lang->line('auth_inst_header')?></h1>
				<h5>
					<?=$this->lang->line('auth_inst_tip')?>
				</h5>
				<br /><br />
				<p style="margin-left:10px;">
					<?=$this->lang->line('auth_inst_link')?>
				</p>
			</div>
		</div>
	</section>
	<script type="text/javascript" src="/js/common.js"></script>
	<?php $this->load->view('includes/footer'); ?>