<?php

if(isset($_POST['zz_form-data'])){

	add_option('hsr_price_dq', $_POST['hsr_price_dq']);
	add_option('hsr_price_q', $_POST['hsr_price_q']);
	add_option('hsr_price_k', $_POST['hsr_price_k']);
	add_option('hsr_avail_dq', $_POST['hsr_avail_dq']);
	add_option('hsr_avail_q', $_POST['hsr_avail_q']);
	add_option('hsr_avail_k', $_POST['hsr_avail_k']);
	
	update_option('hsr_price_dq', $_POST['hsr_price_dq']);
	update_option('hsr_price_q', $_POST['hsr_price_q']);
	update_option('hsr_price_k', $_POST['hsr_price_k']);
	update_option('hsr_avail_dq', $_POST['hsr_avail_dq']);
	update_option('hsr_avail_q', $_POST['hsr_avail_q']);
	update_option('hsr_avail_k', $_POST['hsr_avail_k']);
	
	echo '<p class="fadeaway" style="color:#FFF;background:#007800;padding:5px;">Changes Saved!</p>';
	
}

?>

<link rel="stylesheet" href="<?php echo plugin_dir_url(__FILE__);?>/style.css" />

<div id="hsr-panel">

<h1>GLOBAL SETTINGS</h1>
<p> NOTE: All of these settings below will apply to any date that is not applied by any specific rules.</p>

<form action="#" method="post" enctype="multipart/form-data">
<table class="global_settings">
	<tr><td><b class="title">Price Settings : </b></td><td></td></tr>
	<tr>
		<td>Double Queens</td>
		<td>$ <input name="hsr_price_dq" type="text" value="<?php echo get_option('hsr_price_dq');?>" /></td>
	</tr>
	<tr>
		<td>Queen</td>
		<td>$ <input name="hsr_price_q" type="text" value="<?php echo get_option('hsr_price_q');?>" /></td>
	</tr>
	<tr>
		<td>King</td>
		<td>$ <input name="hsr_price_k" type="text" value="<?php echo get_option('hsr_price_k');?>" /></td>
	</tr>
	<tr>
		<td></td>
		<td>&nbsp;</td>
	</tr>
		<tr><td><b class="title">Room Availibility Settings : </b></td><td></td></tr>
	<tr>
		<td>Double Queens</td>
		<td><input name="hsr_avail_dq" type="text" value="<?php echo get_option('hsr_avail_dq');?>" /></td>
	</tr>
	<tr>
		<td>Queen</td>
		<td><input name="hsr_avail_q" type="text" value="<?php echo get_option('hsr_avail_q');?>" /></td>
	</tr>
	<tr>
		<td>King</td>
		<td><input name="hsr_avail_k" type="text" value="<?php echo get_option('hsr_avail_k');?>" /></td>
	</tr>
	<tr>
		<td></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td></td>
		<td><input name="zz_form-data" style="border:1px solid #DDD;cursor:pointer;background:#337AB7;color:#EEE;font-weight:bold;padding:7px;" type="submit" value="Save Changes" /></td>
	</tr>
</table>
</form>

 </div>

 <script>
	jQuery(document).ready(function($){
		$('.fadeaway').fadeOut(15000);
	});
 </script>
 
 