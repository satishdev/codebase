
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






<table><tr>
<td>
		<?php 
		//for showing the big image
		//if you come on this page after uploading image.
		if(@$select==1)
		{
			foreach($result1->result() as $row1)
			{
				if($row1->gama_golfcourse_img_id==$id)
				{
					echo '<img width="300px" height="300px" alt="#" src="'.base_url().'upload_img/user_golf_course/'.$row1->gama_golfcourse_img.'"><br>';
					$name=$this->common_model->select_where('user_name','gama_user',array('user_id'=>$row1->user_id));
					$name=$name->row();
					echo 'Photo by: '.$name->user_name.'<br>';
					echo 'Date Taken: '.date('l, F j,Y',$row1->dates).'<br>';
					echo 'Title: '.$row1->title.'<br>';
					echo 'Description: '.$row1->description.'<br>';
				}   date(' h:i:s A');
			}
		}
		else if(@$select==0) //if not upload image 
		{
			$images=$result->Imgs->img;
			for($j=0;$j<count($images);$j++)
			{
				if($j==$id)
				{
				  echo '<img id="largeImage"  width=300px" height=300px" alt="#" src="http://xml.golfswitch.com/img/course/'.$result->id.'/'.$images[$j].'"><br>';
				  
				  echo 'Photo By: GolfHub.com <br>';
				  echo 'Title: GolfHub Course Image - '.$images[$j].'<br>';
				  echo 'Description: GolfHub professional course image - '.$images[$j].'<br>';
			    }
			}
		}
		?>
		
		
		
	<a href="<?php echo base_url();?>golfcourse_detail/view_photo/<?php echo $course_id;?>"><strong>More Photo of <?php echo $result->nm;?></strong></a><br />	
		
		<?php 
		$images=$result->Imgs->img;
		$k=0;
		for($j=0;$j<count($images);$j++)
		{
			$k++;
			echo '<a href="'.base_url().'golfcourse_detail/view_my_photo/'.$j.'/0"><img id="largeImage"  width="75" height="60" alt="#" src="http://xml.golfswitch.com/img/course/'.$result->id.'/'.$images[$j].'"></a>&nbsp;&nbsp;';
			
			if($k==5)
			{
				echo '<br>';
				$k=0;
			}
		}
		?>
		
		<?php 
		foreach($result1->result() as $row1)
		{
			if($k==5)
			{
				echo '<br>';
				$k=0;
			}
			
			$k++;
			echo '<a href="'.base_url().'golfcourse_detail/view_my_photo/'.$row1->gama_golfcourse_img_id.'/1"><img width="75" height="60" alt="#" src="'.base_url().'upload_img/user_golf_course/'.$row1->gama_golfcourse_img.'"></a>&nbsp;&nbsp;';
			if($k==5)
			{
				echo '<br>';
				$k=0;
			}
		}
		?>
</td>
</tr>
</table>		