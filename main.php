<?php 

function next_month_permanlink($yy,$mm){
	if($mm == 12){
		return get_site_url().'/wp-admin/admin.php?page=hotel-simple-reservation%2Fmain.php&yy='.($yy+1).'&mm=1';
	}else{
		return get_site_url().'/wp-admin/admin.php?page=hotel-simple-reservation%2Fmain.php&yy='.($yy).'&mm='.($mm+1);
	}
}

function prev_month_permanlink($yy,$mm){
	if($mm == 1){
		return get_site_url().'/wp-admin/admin.php?page=hotel-simple-reservation%2Fmain.php&yy='.($yy-1).'&mm=12';
	}else{
		return get_site_url().'/wp-admin/admin.php?page=hotel-simple-reservation%2Fmain.php&yy='.($yy).'&mm='.($mm-1);
	}
}

?>

<link rel="stylesheet" href="<?php echo plugin_dir_url(__FILE__);?>/style.css" />
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<?php
$yy = isset($_GET['yy'])?$_GET['yy']:date('Y');
$mm = isset($_GET['mm'])?$_GET['mm']:date('m');
$days = cal_days_in_month(CAL_GREGORIAN, $mm, $yy);
?>

<div id="hsr-controller">
	<a href="<?php echo prev_month_permanlink($yy,$mm);?>"><button> &lt; </button></a> <b><?php echo $yy;?> / <?php echo $mm;?></b> <a href="<?php echo next_month_permanlink($yy,$mm);?>"><button> &gt; </button></a>
</div>

<div id="hsr-panel">
	
	<div id="hsr-head">
		<div class="unit weekdayz">Sunday</div><div class="unit weekdayz">Monday</div><div class="unit weekdayz">Tuesday</div><div class="unit weekdayz">Wednesday</div><div class="unit weekdayz">Thursday</div><div class="unit weekdayz">Friday</div><div class="unit weekdayz">Saturday</div>
	</div>
	
	<div id="hsr-calendar">

		<?php 
		
		$indent = date('w', strtotime('1-'.$mm.'-'.$yy));
		
		for($i=0; $i<$indent; $i++){
			echo '<div class="unit dummy"></div>';
		}
		
		$booked_results = $wpdb->get_results( "SELECT RoomType, BookDate, COUNT(*) AS BookedCount FROM hsr_booking WHERE YEAR(BookDate) = '$yy' AND MONTH(BookDate) = '$mm' GROUP BY BookDate, RoomType" );
		
		$booked_array = array();
		foreach($booked_results AS $result){
			$booked_date = str_replace('-0','-',$result->BookDate);
			$booked_postfix = '_'.str_replace('-','_',$booked_date);
			$booked_array[$result->RoomType.$booked_postfix] = $result->BookedCount;
		}
		
		for($i=0; $i<$days; $i++){
			$today = date("Y-m-d");
			$mm2 = $mm;
			if($mm2<10){$mm2='0'.$mm2;}
			$dd = $i+2;
			if($dd<10){$dd='0'.$dd;}
			$date = "$yy-$mm2-$dd";
			if($date < $today){
				$void = TRUE;
			}else{
				$void = FALSE;
			}
			if($void){
				echo '<div class="unit past">'.$mm.'/'.($i+1).'</div>';
			}else{
				?>
				<div class="unit" onclick="window.location='<?php echo get_site_url();?>/wp-admin/admin.php?page=hotel-simple-reservation%2Frule.php&yy=<?php echo $yy;?>&mm=<?php echo $mm;?>&dd=<?php echo $i+1;?>'">
					<?php echo $mm.'/'.($i+1);?><br/>
					<?php $postfix = '_'.$yy.'_'.$mm.'_'.($i+1);?>
					<table style="margin-top:20px;">
						<tr>
							<?php if(!empty(get_option('hsr_price_dq'.$postfix))):?>
								<td>DQ:</td><td class="highlighted">$<?php echo get_option('hsr_price_dq'.$postfix);?></td>
							<?php else:?>
								<td>DQ:</td><td>$<?php echo get_option('hsr_price_dq');?></td>
							<?php endif;?>
						</tr>
						<tr>
							<?php if(!empty(get_option('hsr_avail_dq'.$postfix))):?>
								<td></td><td class="highlighted"><?php echo isset($booked_array['dq'.$postfix])?$booked_array['dq'.$postfix]:'0';?> / <?php echo get_option('hsr_avail_dq'.$postfix);?></td><td><?php if(isset($booked_array['dq'.$postfix])) echo '<span style="color:#00FF00;" class="glyphicon glyphicon-tag" aria-hidden="true"></span>'?></td>
							<?php else:?>
								<td></td><td><?php echo isset($booked_array['dq'.$postfix])?$booked_array['dq'.$postfix]:'0';?> / <?php echo get_option('hsr_avail_dq');?></td><td><?php if(isset($booked_array['dq'.$postfix])) echo '<span style="color:#00FF00;" class="glyphicon glyphicon-tag" aria-hidden="true"></span>'?></td>
							<?php endif;?>
						</tr>
						<tr>
							<?php if(!empty(get_option('hsr_price_q'.$postfix))):?>
								<td>Q:</td><td class="highlighted">$<?php echo get_option('hsr_price_q'.$postfix);?></td>
							<?php else:?>
								<td>Q:</td><td>$<?php echo get_option('hsr_price_q');?></td>
							<?php endif;?>
						</tr>
						<tr>
							<?php if(!empty(get_option('hsr_avail_q'.$postfix))):?>
								<td></td><td class="highlighted"><?php echo isset($booked_array['q'.$postfix])?$booked_array['q'.$postfix]:'0';?> / <?php echo get_option('hsr_avail_q'.$postfix);?></td><td><?php if(isset($booked_array['q'.$postfix])) echo '<span style="color:#00FF00;" class="glyphicon glyphicon-tag" aria-hidden="true"></span>'?></td>
							<?php else:?>
								<td></td><td><?php echo isset($booked_array['q'.$postfix])?$booked_array['q'.$postfix]:'0';?> / <?php echo get_option('hsr_avail_q');?></td><td><?php if(isset($booked_array['q'.$postfix])) echo '<span style="color:#00FF00;" class="glyphicon glyphicon-tag" aria-hidden="true"></span>'?></td>
							<?php endif;?>
						</tr>
						<tr>
							<?php if(!empty(get_option('hsr_price_k'.$postfix))):?>
								<td>K:</td><td class="highlighted">$<?php echo get_option('hsr_price_k'.$postfix);?></td>
							<?php else:?>
								<td>K:</td><td>$<?php echo get_option('hsr_price_k');?></td>
							<?php endif;?>
						</tr>
						<tr>
							<?php if(!empty(get_option('hsr_avail_k'.$postfix))):?>
								<td></td><td class="highlighted"><?php echo isset($booked_array['k'.$postfix])?$booked_array['k'.$postfix]:'0';?> / <?php echo get_option('hsr_avail_k'.$postfix);?></td><td><?php if(isset($booked_array['k'.$postfix])) echo '<span style="color:#00FF00;" class="glyphicon glyphicon-tag" aria-hidden="true"></span>'?></td>
							<?php else:?>
								<td></td><td><?php echo isset($booked_array['k'.$postfix])?$booked_array['k'.$postfix]:'0';?> / <?php echo get_option('hsr_avail_k');?></td><td><?php if(isset($booked_array['k'.$postfix])) echo '<span style="color:#00FF00;" class="glyphicon glyphicon-tag" aria-hidden="true"></span>'?></td>
							<?php endif;?>
						</tr>
					</table>
				</div>
				<?php
			}
		}
		
		?>
	
		<div style="clear:both;"></div>
	
	</div>

</div>