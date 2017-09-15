
<link rel="stylesheet" href="<?php echo plugin_dir_url(__FILE__);?>/style.css" />
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<br/>
<br/>
Command: 
<br/><br/>

<input id="start" type="text" placeholder="start" class="datepicker" />
<input id="end" type="text" placeholder="end" class="datepicker" />
<select id="actionz">
	<option value="price">Change Price</option>
	<option value="room">Change Available Room Number</option>
	<option value="reset">Reset Everything</option>
</select>
<select id="roomtype" class="others">
	<option value="q">Queen</option>
	<option value="k">King</option>
	<option value="dq">Double Queen</option>
</select>
<input id="valuez" type="text" placeholder="value" class="others"/>
<input id="weekdays" type="text" placeholder="weekdays" class="others"/>

<br/><br/>
<button id="command-enter">Enter</button>

<br/><br/>
<div id="msg"></div>

<script>
jQuery(document).ready(function($){
	
    $( ".datepicker" ).datepicker({dateFormat: 'yy-m-d'});
  
	$('#actionz').change(function(){
		if($('#actionz').val()=='reset'){
			$('.others').hide();
		}else{
			$('.others').show();
		}
	});
	
	$('#command-enter').click(function(){
		$('#msg').html('Processing ...');
		$.ajax({
			url: ajaxurl,
			data: {
				'action':'command_ajax_request',
				'start' : $('#start').val().trim(),
				'end' : $('#end').val().trim(),
				'actionz' : $('#actionz').val().trim(),
				'roomtype' : $('#roomtype').val().trim(),
				'valuez' : $('#valuez').val().trim(),
				'weekdays' : $('#weekdays').val().trim(),
			},
			success:function(data) {
				// This outputs the result of the ajax request
				$('#msg').html(data);
			},
			error: function(errorThrown){
				console.log(errorThrown);
			}
		});	  
	});
  

});
</script>