
<link rel="stylesheet" href="<?php echo plugin_dir_url(__FILE__);?>/style.css" />
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<?php 
GLOBAL $wpdb;
$results = $wpdb->get_results( "SELECT * FROM hsr_order ORDER BY OrderId Desc");
?>
<div id="hsr-panel">
<table class="table table-striped">
	<tr>
		<th>Order Date Time</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Phone</th>
		<th>Email</th>
		<th>Detail</th>
	</tr>
<?php foreach($results AS $result):?>
	<tr>
		<td><?php echo $result->OrderDateTime;?></td>
		<td><?php echo $result->FirstName;?></td>
		<td><?php echo $result->LastName;?></td>
		<td><?php echo $result->Phone;?></td>
		<td><?php echo $result->Email;?></td>
		<td><a class="detail_link" href="#">Detail</a><div style="display:none" class="summery_div"><?php echo $result->Summery;?></div></td>
	</tr>
<?php endforeach;?>
<table>
</div>

<script>
jQuery(document).ready(function($){
	$('.detail_link').click(function(){
		var html_div = $(this).parent().find('.summery_div').html();
		$('#detailModal .modal-body').html(html_div);
		$('#detailModal').modal({
			show: 'false'
		}); 
	});
});
</script>

<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Detail</h4>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>