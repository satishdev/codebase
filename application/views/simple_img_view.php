<link type="text/css" href="<?=base_url()?>asserts/css/menu/menu.css" rel="stylesheet" />
<script type="text/javascript" src="<?=base_url()?>asserts/js/jquery-1.8.1.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/css/menu/menu.js"></script>




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







<table>
<tr>
<td>
<? $row=$result->row();?>
<img src="<?php echo base_url();?>asserts/upload_img/user_golf_course/<?php echo $row->gama_golfcourse_img;?>" height="300px" width="300px" />
</td>
</tr>

<tr>
<td>
<a href="<?php echo base_url();?>golfcourse_detail/view_my_photo/<?php echo $id;?>/1">View My Photo</a>
<a href="<?php echo base_url();?>golfcourse_detail/upload_photo">Upload Another Photo</a>
</td>
</tr>
</table>