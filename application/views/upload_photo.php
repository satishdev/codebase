<link type="text/css" href="<?=base_url()?>asserts/css/menu/menu.css" rel="stylesheet" />
<script type="text/javascript" src="<?=base_url()?>asserts/js/jquery-1.8.1.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/css/menu/menu.js"></script>




<link rel="stylesheet" href="<?php echo base_url()?>asserts/css/themes/jquery.ui.all.css">
<script src="<?php echo base_url()?>asserts/js/ui/jquery.ui.core.js"></script>
<script src="<?php echo base_url()?>asserts/js/ui/jquery.ui.widget.js"></script>
<script src="<?php echo base_url()?>asserts/js/ui/jquery-ui-1.8.23.custom.js"></script>
<script src="<?php echo base_url()?>asserts/js/ui/jquery.ui.datepicker.js"></script>
<link rel="stylesheet" href="<?php echo base_url()?>asserts/css/demos.css">
<script>
	$(function() {
		$( "#dates" ).datepicker({ minDate: 0, maxDate: "+1M +10D" });
	});
</script>



<script>
function get_state()
{
   $.ajax({
   type:'post',
   url:'<?=base_url()?>teetime_golfcourse/dropdown_golfcorse/',
   success:function(data){
	  $('#hirarchy_golfcorse').html(data);
   }
   });
}

$(document).ready(function()
{
	get_state();
});
</script>

<div id="hirarchy_golfcorse">
</div>
<div id="copyright"><a href="http://apycom.com/"></a></div>






<?php 

echo validation_errors(); 

?>

UPLOAD COURSE PHOTO
<form action="" method="post" enctype="multipart/form-data">
<table>
<tr>
<td>
Title:
</td>
<td>
<input type="text" name="title" id="title"  />
</td>
</tr>


<tr>
<td>
Description:
</td>
<td>
<textarea name="description" id="description"></textarea>
</td>
</tr>


<tr>
<td>
Date Taken
</td>
<td>
<div class="demo">

<input type="text" name="dates" id="dates" /></div>
</td>
</tr>


<tr>
<td>
Photo
</td>
<td>
<input type="file" name="photos" id="photos" />
</td>
</tr>

<tr>
<td colspan="2">
<input type="submit" name="submit" value="Submit" />
</td>
</tr>


</table>
</form>