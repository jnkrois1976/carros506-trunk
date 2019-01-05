<html>
<head>
	<title><?=$this->lang->line('quick_msg_title')?></title>
</head>
<body>
	<table cellpadding="1" cellspacing="2" border="0" width="600">
		<tr>
			<td><img src="http://carros506.com/images/carros506.jpg" alt="<?=$this->lang->line('quick_brand_capitalized')?>"></td>
		</tr>
		<tr>
			<?=$buyer_info['contact_fullname'].$this->lang->line('quick_msg_part1')?><br />
			<?php echo $seller_info['ad_marca']." ".$seller_info['ad_modelo']." - ".$seller_info['ad_year']; ?><br /><br />
			<?=$this->lang->line('quick_msg_part1')?><a href="http://carros506.com"><?=$this->lang->line('quick_brand_lowercase')?></a>
		</tr>
	</table>
</body>
</html>
