
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
<strong><?php echo $result->nm;?></strong>
</td>
</tr>





<tr>
<td>
<!--Images view-->
<div id="panel">
		<?php 
		$images=$result->Imgs->img;
		for($i=0;$i<1;$i++)
		{
		echo '<img id="largeImage"   width="100px" height="100px" alt="#" src="http://xml.golfswitch.com/img/course/'.$result->id.'/'.$images[$i].'">';
		}
		
		?>
	</div>
	
<!--end Images view-->





<?php echo $result->nm;?><br />
<?php echo $result->addr1;?><br />
<?php echo $result->cty .', '.$result->st.' '.$result->zip.' '.$result->cou;?><br />
<?php echo $result->shortPromo.'.....'; ?>
</td>
</tr>


<tr>
<td>
<br /><br />
<? $course_id=$this->session->userdata('course_id');?>
<a href="<?php echo base_url();?>golfcourse_detail/golf_detail_page/<?php echo $course_id;?>" ><strong>Overview</strong></a> |
<a href="<?php echo base_url();?>golfcourse_detail/all_review_listing/<?php echo $course_id;?>"><strong>Review</strong></a> | 
<a href="<?php echo base_url();?>golfcourse_detail/view_photo/<?php echo $course_id;?>"><strong>Photos</strong></a> |
<br /><br />
</td>
</tr>
</table>





<style>
.bold{ font-weight:bold;}
</style>

<table>
<tr>
<td>


Sort By 
<a <?php if(@$sort=='date'){?> class="bold"<?php }?> href="<?php echo base_url();?>golfcourse_detail/review_sorting/date/<?php echo $course_id;?>">Date</a> 
| <a <?php if(@$sort=='rating'){?> class="bold"<?php }?> href="<?php echo base_url();?>golfcourse_detail/review_sorting/rating/<?php echo $course_id;?>">Rating</a><br /><br /><br />

<?php 

foreach($result1->result() as $row2)
{
?>
<img src="<?php echo base_url();?>" height="100px" width="100px" alt="#" />

<?

$review_rating_condition=$row2->review_rating_condition;
$review_rating_facilities=$row2->review_rating_facilities;
$review_rating_all=$row2->review_rating_all;
$condition='';
$facilities='';
$all='';
for($f=1;$f<=$review_rating_condition;$f++)
{
$condition.='*';
}

for($f=1;$f<=$review_rating_facilities;$f++)
{
$facilities.='*';
}

for($f=1;$f<=$review_rating_all;$f++)
{
$all.='*';
}


echo '<strong>'.$row2->review_title.'</strong>&nbsp;&nbsp;&nbsp;&nbsp;';
echo 'Course: '.$condition.'<br />';
 
$user_info=$this->common_model->select_where('user_name','gama_user',array('user_id'=>$row2->user_id));
$user_info=$user_info->row(); 
$user_name=$user_info->user_name;
echo 'Reviewed by: <strong>'.$user_name.'</strong>&nbsp;&nbsp;&nbsp;&nbsp;';
echo 'Service: '.$facilities.'<br />';



echo date('l,F j,Y',$row2->dates).'&nbsp;&nbsp;&nbsp;&nbsp;';
echo 'Overall: '.$all.'<br />';

echo $row2->review_coment.'<br /><br />';
echo '.......<br><br>';

}

echo @$paginglink;

?>

</td>
</tr>
</table>