<div class="pop">
  <div class="pop_rpt">
    <div class="review">
      <h3>Review of <?php echo $result->nm;?></h3>
      <ul>
        
		
		
<?
if($result1->num_rows()>0)
{		
foreach($result1->result() as $row2)
{
	$review_rating_condition=$row2->review_rating_condition;
	$review_rating_facilities=$row2->review_rating_facilities;
	$review_rating_all=$row2->review_rating_all;
	$condition='';
	$facilities='';
	$all='';
	for($f=1;$f<=$review_rating_condition;$f++)
	{
	$condition.='<img src="'.base_url().'/asserts/css/images/ticket_star.png" alt="#" />';
	}
	for($f=$review_rating_condition+1;$f<=5;$f++)
	{
	$condition.='<img src="'.base_url().'/asserts/css/images/ticket_grey_star.png" alt="#" />';
	}
	
	for($f=1;$f<=$review_rating_facilities;$f++)
	{
	$facilities.='<img src="'.base_url().'/asserts/css/images/ticket_star.png" alt="#" />';
	}
	for($f=$review_rating_facilities+1;$f<=5;$f++)
	{
	$facilities.='<img src="'.base_url().'/asserts/css/images/ticket_grey_star.png" alt="#" />';
	}
	
	
	for($f=1;$f<=$review_rating_all;$f++)
	{
	$all.='<img src="'.base_url().'/asserts/css/images/ticket_star.png" alt="#" />';
	}
	for($f=$review_rating_all+1;$f<=5;$f++)
	{
	$all.='<img src="'.base_url().'/asserts/css/images/ticket_grey_star.png" alt="#" />';
	}
?>
<li>
  
        <div class="stars_out">
		<label><? echo '<strong>'.$row2->review_title.'</strong>';?></label>
		<div class="clr"></div>
		</div>
  
  
		<div class="stars_out">
		<label>Course:</label>
		<p class="stars"> 
		<?=$condition?>
		<b><?=$review_rating_condition?>/5</b></p>
		<div class="clr"></div>
		</div>
		  
		  
		  
		<div class="stars_out">
		<label>Service:</label>
		<p class="stars"> 
		<?=$facilities?>
		<b><?=$review_rating_facilities?>/5</b> </p>
		<div class="clr"></div>
		</div>
		  
		  
		  
		<div class="stars_out">
		<label>Overall:</label>
		<p class="stars"> 
	    <?=$all?>
		<b><?=$review_rating_all?>/5</b> </p>
		<div class="clr"></div>
		</div>
  
  	  
		<div class="stars_out">
		<label>Reviewed by:</label>
		<?
			$user_info=$this->common_model->select_where('first_name,last_name','players',array('id'=>$row2->user_id));
			$user_info=$user_info->row(); 
			$first_name=$user_info->first_name;
			$last_name=$user_info->last_name;
		?>
		<p><? echo $first_name.' '.$last_name;?></p>
		<div class="clr"></div>
		</div>
		
		<div class="stars_out">
		<label>Date:</label>
		<p><? echo date('l,F j,Y',$row2->dates);?></p>
		<div class="clr"></div>
		</div>
  
  
  
  <div class="star_bottom">
		<p><!-- <b> Havelte, Drenthe.</b>-->
		<? echo $row2->review_coment;?></p>
  </div>
</li>
<? }
}
else
{
echo '<p  style="color:#FF0000;">No Review Found.</p>';
}
?>
<li>
<div>
<?

if($this->db_session->userdata('user_object')!='')
{				
?>
<a href="#." onclick="golf_add_review(<?=$course_id?>)">Add Your Review</a>
<? }?>
</div>
</li>	 
 
	  </ul>
      <div class="clr"></div>
    </div>
  </div>
  <div class="pop_bottom">
    <div class="clr"></div>
  </div>
  <div class="clr"></div>
</div>










<?
//echo 'Course: '.$condition.'<br />';
 
/*$user_info=$this->common_model->select_where('user_name','gama_user',array('user_id'=>$row2->user_id));
$user_info=$user_info->row(); 
$user_name=$user_info->user_name;*/
//echo 'Reviewed by: <strong>'.$user_name.'</strong>';
//echo 'Service: '.$facilities.'<br />';



//echo date('l,F j,Y',$row2->dates);
//echo 'Overall: '.$all;



//}

//echo @$paginglink;

?>