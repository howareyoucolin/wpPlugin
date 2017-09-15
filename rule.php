<?php

if(isset($_POST['zz_form-data']) or isset($_POST['zz_form-restore'])){
	$prev_page = $_POST['prev_page'];
}else{
	$prev_page = $_SERVER['HTTP_REFERER'];
}

$yy = isset($_GET['yy'])?$_GET['yy']:date('Y');
$mm = isset($_GET['mm'])?$_GET['mm']:date('m');
$dd = isset($_GET['dd'])?$_GET['dd']:date('d');
$postfix = '_'.$yy.'_'.$mm.'_'.$dd;

if(isset($_POST['zz_form-data'])){

	add_option('hsr_price_dq'.$postfix, $_POST['hsr_price_dq'.$postfix]);
	add_option('hsr_price_q'.$postfix, $_POST['hsr_price_q'.$postfix]);
	add_option('hsr_price_k'.$postfix, $_POST['hsr_price_k'.$postfix]);
	add_option('hsr_avail_dq'.$postfix, $_POST['hsr_avail_dq'.$postfix]);
	add_option('hsr_avail_q'.$postfix, $_POST['hsr_avail_q'.$postfix]);
	add_option('hsr_avail_k'.$postfix, $_POST['hsr_avail_k'.$postfix]);
	
	update_option('hsr_price_dq'.$postfix, $_POST['hsr_price_dq'.$postfix]);
	update_option('hsr_price_q'.$postfix, $_POST['hsr_price_q'.$postfix]);
	update_option('hsr_price_k'.$postfix, $_POST['hsr_price_k'.$postfix]);
	update_option('hsr_avail_dq'.$postfix, $_POST['hsr_avail_dq'.$postfix]);
	update_option('hsr_avail_q'.$postfix, $_POST['hsr_avail_q'.$postfix]);
	update_option('hsr_avail_k'.$postfix, $_POST['hsr_avail_k'.$postfix]);
	
	echo '<p class="fadeinto" style="display:none;color:#FFF;background:#007800;padding:5px;">Changes Saved!</p>';
	
}

if(isset($_POST['zz_form-restore'])){
	delete_option('hsr_price_dq'.$postfix);
	delete_option('hsr_price_q'.$postfix);
	delete_option('hsr_price_k'.$postfix);
	delete_option('hsr_avail_dq'.$postfix);
	delete_option('hsr_avail_q'.$postfix);
	delete_option('hsr_avail_k'.$postfix);
}

?>

<link rel="stylesheet" href="<?php echo plugin_dir_url(__FILE__);?>/style.css" />

<div id="hsr-panel">

<a href="<?php echo $prev_page;?>"><button>GO BACK</button></a> 
<br/><br/>

<h1>CUSTOM RULES FOR <?php echo $yy;?>-<?php echo $mm;?>-<?php echo $dd;?></h1>

<div class="orderlist">
	<h2>RESERVATIONS FOR TODAY</h2>
	<?php 
	$orders = array();
	GLOBAL $wpdb;
	$results = $wpdb->get_results( "SELECT OrderId FROM hsr_booking WHERE BookDate = '$yy-$mm-$dd'");
	foreach($results as $result){
		$orders[] = $result->OrderId;
	}
	$ordersStr = implode(',',$orders);
	//GET BOOKING RESULTS:
	$results = $wpdb->get_results( "SELECT * FROM hsr_order WHERE OrderId IN ($ordersStr)");
	foreach($results as $result){
		echo '<div class="order">';
		echo 'TransactionID: '.$result->TransactionCode.'<br/>';
		echo $result->Summery;
		echo '</div>';
	}
	if(!$results){
		echo '<div class="order">';
		echo 'No Reservation for today.';
		echo '</div>';
	}
	?>
</div>

<form action="#" method="post" enctype="multipart/form-data">
<input type="hidden" name="prev_page" value="<?php echo $prev_page;?>"/>
<table class="global_settings">
	<tr><td><b class="title">Price Settings : </b></td><td></td></tr>
	<tr>
		<td>Double Queens</td>
		<td>$ <input name="hsr_price_dq<?php echo $postfix;?>" type="text" value="<?php echo get_option('hsr_price_dq'.$postfix);?>" /> Global:<?php echo get_option('hsr_price_dq');?></td>
	</tr>
	<tr>
		<td>Queen</td>
		<td>$ <input name="hsr_price_q<?php echo $postfix;?>" type="text" value="<?php echo get_option('hsr_price_q'.$postfix);?>" /> Global:<?php echo get_option('hsr_price_q');?></td>
	</tr>
	<tr>
		<td>King</td>
		<td>$ <input name="hsr_price_k<?php echo $postfix;?>" type="text" value="<?php echo get_option('hsr_price_k'.$postfix);?>" /> Global:<?php echo get_option('hsr_price_k');?></td>
	</tr>
	<tr>
		<td></td>
		<td>&nbsp;</td>
	</tr>
		<tr><td><b class="title">Room Availibility Settings : </b></td><td></td></tr>
	<tr>
		<td>Double Queens</td>
		<td><input name="hsr_avail_dq<?php echo $postfix;?>" type="text" value="<?php echo get_option('hsr_avail_dq'.$postfix);?>" /> Global:<?php echo get_option('hsr_avail_dq');?></td>
	</tr>
	<tr>
		<td>Queen</td>
		<td><input name="hsr_avail_q<?php echo $postfix;?>" type="text" value="<?php echo get_option('hsr_avail_q'.$postfix);?>" /> Global:<?php echo get_option('hsr_avail_q');?></td>
	</tr>
	<tr>
		<td>King</td>
		<td><input name="hsr_avail_k<?php echo $postfix;?>" type="text" value="<?php echo get_option('hsr_avail_k'.$postfix);?>" /> Global:<?php echo get_option('hsr_avail_k');?></td>
	</tr>
	<tr>
		<td></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td></td>
		<td><input name="zz_form-data" style="border:1px solid #DDD;cursor:pointer;background:#337AB7;color:#EEE;font-weight:bold;padding:7px;" type="submit" value="Save Changes" /> <input name="zz_form-restore" onclick="return confirm('Are you sure to do that?');" style="border:1px solid #DDD;cursor:pointer;background:#D00;color:#EEE;font-weight:bold;padding:7px;" type="submit" value="Restore to Default" /></td>
	</tr>
</table>

</form>

<div class="clear:both;"></div>

</div>

<script>
	jQuery(document).ready(function($){
		$('.fadeinto').fadeIn(1500);
	});
</script>

 