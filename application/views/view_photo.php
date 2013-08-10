
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
<strong><?php echo @$result->nm;?></strong>
</td>
</tr>





<tr>
<td>
<!--Images view-->
<div id="panel">
		<?php 
		if(isset($result->Imgs))
		{
			$images=$result->Imgs->img;
			for($i=0;$i<1;$i++)
			{
			echo '<img id="largeImage"   width="100px" height="100px" alt="#" src="http://xml.golfswitch.com/img/course/'.$result->id.'/'.$images[$i].'">';
			}
		}
		else
		{
			echo '<img  width="200" height="150" alt="#" src="'.base_url().'images/no_image.jpeg">';
		}
		?>
	</div>
	
<!--end Images view-->





<?php echo @$result->nm;?><br />
<?php echo @$result->addr1;?><br />
<?php echo @$result->cty .', '.@$result->st.' '.@$result->zip.' '.@$result->cou;?><br />
<?php echo @$result->shortPromo.'.....'; ?>
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






<table><tr>
<td>
		
	<script type="text/javascript" src="<?php echo base_url();?>asserts/js/easyslider/easySlider1.7.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){	
			$("#slider").easySlider({
				auto: false, 
				continuous: true,
				prevText	:	'Previous',
				nextText	: 	'Next',
			});
		});	
	</script>
	
<link href="<?php echo base_url();?>asserts/css/easyslider/screen.css" rel="stylesheet" type="text/css" media="screen" />
		
		<div id="container">
	<div id="content">
		<div id="slider">
			<ul>	
			<?
		if(isset($result->Imgs))
		{
			$images=$result->Imgs->img;
			for($j=0;$j<count($images);$j++)
			{
				echo '<li><a href="#."><img alt="#" src="http://xml.golfswitch.com/img/course/'.$result->id.'/'.$images[$j].'"  width="300px" height="200px"></a></li>';
			}
			?>
			
			<?php 
			foreach($result1->result() as $row1)
			{
				echo '<li><a href="#."><img  alt="#" src="'.base_url().'upload_img/user_golf_course/'.$row1->gama_golfcourse_img.'" width="300px" height="200px"></a></li>';
			}
		}
		else
		{
			echo '<img  width="200" height="150" alt="#" src="'.base_url().'images/no_image.jpeg">';
		}
		
		?>
			
			
			</ul>
			<div class="clr"></div>
		</div>
	</div>
</div>

	<br /><br />	
		
			
		
		
		<?php 
		if(isset($result->Imgs))
		{
			$images=$result->Imgs->img;
			$k=0;
			for($j=0;$j<count($images);$j++)
			{
				$k++;
				echo '<a href="'.base_url().'golfcourse_detail/view_my_photo/'.$j.'/0"><img id="largeImage"  width="75" height="60" alt="#" src="http://xml.golfswitch.com/img/course/'.$result->id.'/'.$images[$j].'"></a>&nbsp;&nbsp;';
				
				if($k==4)
				{
					echo '<br>';
					$k=0;
				}
			}
			?>
			
			<?php 
			foreach($result1->result() as $row1)
			{
				if($k==4)
				{
					echo '<br>';
					$k=0;
				}
				
				$k++;
				echo '<a href="'.base_url().'golfcourse_detail/view_my_photo/'.$row1->gama_golfcourse_img_id.'/1"><img width="75" height="60" alt="#" src="'.base_url().'upload_img/user_golf_course/'.$row1->gama_golfcourse_img.'"></a>&nbsp;&nbsp;';
				if($k==4)
				{
					echo '<br>';
					$k=0;
				}
			}
		}
		else
		{
			echo '<img  width="200" height="150" alt="#" src="'.base_url().'images/no_image.jpeg">';
		}
		?>
</td>
</tr>
</table>		

	<a href="<?php echo base_url()?>golfcourse_detail/upload_photo">Upload Photo</a>



