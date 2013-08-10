<!--menu of country state area, golf.-->
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
<!--end menu of country state area, golf.-->





Your Review is submitted and display after admin approveal.
<a href="<?php echo base_url();?>golfcourse_detail/all_review_listing/<?php echo $course_id;?>">Go to this course listing page</a>