<!--for add to card fency box-->
<link href="<?=base_url()?>asserts/css/site_css/stylesheet.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url() ?>asserts/css/css_model/jquery.ui.all.css">
  <script type="text/javascript" src="<?=base_url()?>asserts/js/jquery-1.8.1.js"></script>
<!--<script src="<?php echo base_url() ?>js/jquery-1.8.2.js"></script>-->
<script src="<?php echo base_url() ?>asserts/js/jquery.bgiframe-2.1.2.js"></script>
<script src="<?php echo base_url() ?>asserts/js/js_model/jquery.ui.core.js"></script>
<script src="<?php echo base_url() ?>asserts/js/js_model/jquery.ui.widget.js"></script>
<script src="<?php echo base_url() ?>asserts/js/js_model/jquery.ui.position.js"></script>
<script src="<?php echo base_url() ?>asserts/js/js_model/jquery.ui.dialog.js"></script>

	


<style>

.golf_div2 h4{padding-bottom: 0px;}
	.golf_div2 p{padding-bottom: 0px; margin: 0px 0;
    padding: 0px 0px;}
	
</style>



<style>
.bold{ font-weight:bold;}
</style>
		
	    


<div id='content_header'>
	<div class='hdr-text'>Tee Time Search</div>
</div>
<div id="content_wrapper" class="contacts">
    <div class="opt_box_wrapper">
	</div>
	 <div class="adv_search_results notifications">








      
	
	  
          
          
          <div class="tee_time_bottom" style="margin-left:13px">
		
		
		<div id="replace"> <?	
		
		
		/*echo '<div class="tee_time_bottom_date"><h5>'.date(' l \,\  jS F \,\  Y',@$fin_date).'</h5></div>';*/
		
	 $players=1;
	 if(!empty($altime) && @$RetCd==0)
	 {//if record time record exist
	     //sorting of all times of all golf courses
		 
		 
		 $arr_count=count($course_arr);
		
		 if($arr_count>1 || is_array($course_arr))
		 {//if golf course are more than one
			 for($b=0;$b<$arr_count;$b++)
			 {
				 //check if times of courses exists
				 if(isset($course_arr[$b]->Dates->alDate->Times->alTime))
				 $all_time=$course_arr[$b]->Dates->alDate->Times->alTime;
				 else
				 continue;
				 //if record of times is single
				 if(count($all_time)==1)
				 {
					 $all_time->arr_val=$b;
					 $row[]=$all_time;
				 }//end if record of times is single
				 else
				 {
					 for($i=0;$i<count($all_time);$i++)
					 {
						 $all_time[$i]->arr_val=$b;
						 $row[]=$all_time[$i];
					 }
				 }
			 }
			 sort($row);
	     //end sorting of all times of all golf courses
		 }//end if golf course are more than one
		 else
		 {//if golf course is single
			 //$all_time=$course_arr->Dates->alDate->Times->alTime;
			 $all_time=$altime;
			 if(count($all_time)==1)
			 {
				 $row[]=$all_time;
			 }//end if record of times is single
			 else
			 {
				 for($i=0;$i<count($all_time);$i++)
				 {
					 $row[]=$all_time[$i];
				 }
			 }
		 }//end if golf course is single
	 
	 #####################    
	//in this portion we are not developing the case in which a single time exist..	
	########################
		 
		 $k=0;
		 for($i=0;$i<count($row);$i++)
		 {//first for loop   
			
				$ppTxnFee=$row[$i]->ppTxnFee;
				$ppCharge=$row[$i]->ppCharge;
				$chrgCurr=$row[$i]->chrgCurr;
				$ppNetRt=$row[$i]->ppNetRt;
				$ppRewPts=$row[$i]->ppRewPts;
				$flags=$row[$i]->flags;
				
				if($arr_count>1 || is_array($course_arr))
				{
					$arr_val=$row[$i]->arr_val;
					$state=$course_arr[$arr_val]->st;
					$cty=$course_arr[$arr_val]->cty;
					$name=$course_arr[$arr_val]->nm;
					$name=str_replace("'",' ',$name);
					$img=$course_arr[$arr_val]->img;
					$id=$course_arr[$arr_val]->id;
					$maxRewPts=$course_arr[$arr_val]->maxRewPts;
					$date=$course_arr[$arr_val]->Dates->alDate->dt;
					
					//if city wise listing require
					if(@$city_wise=='yes')
					{
						$null=strcmp($city,$cty);
						
						if($null!=0)
						{
						   continue;
						}
					}
					//if city wise listing require
				}
				else
				{
					$state=$course_arr->st;
					$cty=$course_arr->cty;
					$name=$course_arr->nm;
					$name=str_replace("'",' ',$name);
					$img=$course_arr->img;
					$id=$course_arr->id;
					$maxRewPts=$course_arr->maxRewPts;
					$date=$course_arr->Dates->alDate->dt;
					
					//if city wise listing require
					if(@$city_wise=='yes')
					{
						$null=strcmp($city,$cty);
						
						if($null!=0)
						{
						   continue;
						}
					}
					//if city wise listing require
				}
				
				
				
				$dat=explode('T',$date);
				$dat=strtotime($dat[0]);
				
				
					//checks for filtration
					if(@$filter=='early'){	
						if($row[$i]->tm>800){
							continue;
						}
					}
					
					if(@$filter=='10'){	
						if($row[$i]->tm<800 || $row[$i]->tm>1000){
								continue;
							}
					}
					
					if(@$filter=='noon'){	
						if($row[$i]->tm<1000 || $row[$i]->tm>1200){
							continue;
						}
					}
					
					if(@$filter=='2'){	
						if($row[$i]->tm<1200 || $row[$i]->tm>1400){
							continue;
						}
					}
					
					if(@$filter=='afternoon'){	
						if($row[$i]->tm<1400){
							continue;
						}
					}
					//end checks for filtration
					
					
					//price filtration
					@$hid_filter=$this->session->userdata('hid_filter');
					if(@$hid_filter=='TRUE')
					{
						$flag=0;
						@$price_filtration=$this->session->userdata('price_filtration');
						foreach(@$price_filtration as $key=>$val)
						{
							if($val==0)
							{
							   $val=99999;
							}
							
							if($row[$i]->ppPrice>=$key && $row[$i]->ppPrice<=$val)
							{
							   $flag=1;
							}
						}
						if($flag==0)
						{
						   continue;
						}
					}
					//end price filtration
					
					
					
					
					
					//time filtration
					@$hid_time_filter=$this->session->userdata('hid_time_filter');
					if(@$hid_time_filter=='TRUE')
					{
						$flag=0;
						@$time_filtration=$this->session->userdata('time_filtration');
						foreach(@$time_filtration as $key=>$val)
						{
							if($row[$i]->tm>$key && $row[$i]->tm<$val)
							{
							   $flag=1;
							}
						}
						if($flag==0)
						{
						   continue;
						}
					}
					//end time filtration
					
					
					
						
					
					$k++;
					$time_len=strlen($row[$i]->tm);
					$am=strtotime("0000:00:00 12:59:59");
					
					//if start
					if($time_len==4)
					{
						$time_len=str_split($row[$i]->tm);
						$mytime=$time_len[0].$time_len[1].':'.$time_len[2].$time_len[3];
						$mytime_am_pm=strtotime("0000-00-00 $mytime:00");	
						
						//if first time loop excute values assign to $main_startc, $main_endc
						if($k==1){
							$main_time=explode(':',$mytime);
							$main_start=$main_time[0];
							$main_end=$main_start+1;
							$main_startc=strtotime("0000-00-00 $main_start:00:00");
							$main_endc=strtotime("0000-00-00 $main_end:00:00");
						
							//heading time set
							if($main_startc>$am){
								$main_start=$main_start-12;
								$main_start=$main_start.':00PM';
							}
							else{
								$main_start=$main_start.':00AM';
							}
							
							if($main_endc>$am){
								$main_end=$main_end-12;
								$main_end=$main_end.':00PM';
							}
							else{
								$main_end=$main_end.':00AM';
							}//end heading time set
						
							echo  '<div class="tee_time_bottom_time"><div class="time_left"><h5>'.$main_start.'-'. $main_end. '</h5></div><div class="clr"></div></div>';
		//echo '<div class="clr"></div></div><div class="clr"></div></div>';
							$k++;
						}
						
						
						
					
					
					//if time range is between 1 hour, e.g 6 to7 excute if condition
						if($mytime_am_pm<=$main_endc && $mytime_am_pm>=$main_startc){
						//empty
						}
						else
						{
							$main_time=explode(':',$mytime);
							$main_start=$main_time[0];
							$main_end=$main_start+1;
							$main_startc=strtotime("0000-00-00 $main_start:00:00");
							$main_endc=strtotime("0000-00-00 $main_end:00:00");
						
							//heading time set
							if($main_startc>$am){
								$main_start=$main_start-12;
								$main_start=$main_start.':00PM';
							}
							else{
								$main_start=$main_start.':00AM';
							}
							
							if($main_endc>$am){
								$main_end=$main_end-12;
								$main_end=$main_end.':00PM';
							}
							else{
								$main_end=$main_end.':00AM';
							}
							echo  '<div class="tee_time_bottom_time"><div class="time_left"><h5>'.$main_start.'-'. $main_end. '</h5></div><div class="clr"></div></div>';
						//echo '<div class="clr"></div></div><div class="clr"></div></div>';
							}//end heading time set
							
							?>
						
							<div class="golf_outer">
							<div class="golf">
							<div class="golf_top"></div>
							<div class="golf_rpt">
							<div class="golf_mid">
								
							<?
							//time set on every course
							if($mytime_am_pm>$am){
							$mytime=explode(':',$mytime);
							$$mytime[0]=$mytime[0]-12;
							$mytime=$$mytime[0].':'.$mytime[1];
							echo '<div class="golf_div1"><p>'.$mytime.'PM</p></div>';
							$am_or_pm=0;
							}
							else{
							echo '<div class="golf_div1"><p>'.$mytime.'AM</p></div>';
							$am_or_pm=1;
							}  	//time set on every course			
					}//end if start
					
					
					
					//else if
					else if($time_len==3)
					{
						$time_len=str_split($row[$i]->tm);
						$mytime=$time_len[0].':'.$time_len[1].$time_len[2];
						$mytime_am_pm=strtotime("0000-00-00 $mytime:00");
						
						//if first time loop excute values assign to $main_startc $main_endc	
						if($k==1){
							$main_time=explode(':',$mytime);
							$main_start=$main_time[0];
							$main_end=$main_start+1;
							$main_startc=strtotime("0000-00-00 $main_start:00:00");
							$main_endc=strtotime("0000-00-00 $main_end:00:00");
						
							//heading time set
							if($main_startc>$am){
								$main_start=$main_start-12;
								$main_start=$main_start.':00PM';
							}
							else{
								$main_start=$main_start.':00AM';
							}
							if($main_endc>$am){
								$main_end=$main_end-12;
								$main_end=$main_end.':00PM';
							}
							else{
								$main_end=$main_end.':00AM';
							}
							   echo  '<div class="tee_time_bottom_time"><div class="time_left"><h5>'.$main_start.'-'. $main_end. '</h5></div><div class="clr"></div></div>';
							}
							
							//if time range is between 1 hour, e.g 6 to7 excute if condition
							if($mytime_am_pm<=$main_endc && $mytime_am_pm>=$main_startc){
							//empty
							}
							else{
							$main_time=explode(':',$mytime);
							$main_start=$main_time[0];
							$main_end=$main_start+1;
							$main_startc=strtotime("0000-00-00 $main_start:00:00");
							$main_endc=strtotime("0000-00-00 $main_end:00:00");
						
							//heading time set
							if($main_startc>$am){
							$main_start=$main_start-12;
							$main_start=$main_start.':00PM';
							}
							else{
							$main_start=$main_start.':00AM';
							}
							if($main_endc>$am){
								$main_end=$main_end-12;
								$main_end=$main_end.':00PM';
							}
							else{
								$main_end=$main_end.':00AM';
							}
							echo  '<div class="tee_time_bottom_time"><div class="time_left"><h5>'.$main_start.'-'. $main_end. '</h5></div><div class="clr"></div></div>';
							//echo '<div class="clr"></div></div><div class="clr"></div></div>';
						}
						?>
						<div class="golf_outer">		
						<div class="golf">
						<div class="golf_top"></div>
						<div class="golf_rpt">
						<div class="golf_mid">
						
						<?
						//time set to every course
						if($mytime_am_pm>$am){
						   echo '<div class="golf_div1"><p>'.$mytime.'PM</p></div>';
						   $am_or_pm=0;
						}
						else{
						   echo '<div class="golf_div1"><p>'.$mytime.'AM</p></div>';
						   $am_or_pm=1;
						}//end time set to every course
					}
					
					
					
					?>
					
					
					
					
					
					
					<div class="golf_div2">
					  <h4><a href="<?=base_url()?>search_golfcourse/search_teetimes_two/<?=$id?>"><? echo $name;?></a></h4>
					  <p><? echo $cty.' , '.$state;?></p>
					  <a href="#">[+] More Info </a> 
					</div>
					<div class="golf_div3">
					  <h4><? echo $row[$i]->curr.number_format($row[$i]->ppPrice, 2);?></h4><img src="<?=base_url()?>asserts/images/euro_flag.png" alt="#" />
					</div>
					<div class="golf_div4">
					  <ul>
						<li><small>x</small>
						  <div class="play">
							<?
					//handle numbers of players
					$allow_players=$row[$i]->allow;
					$allow_players=strlen($allow_players);?>
					
					<select  onchange="player_change(this.value,<?php echo $i?>)">
					<?php for($j=1;$j<=$allow_players;$j++){?>
					<option <?php if($players==$j){?> selected="selected" <?php }?> value="<?php echo $j?>"><?php echo $j?></option>
					<?php }?>
					</select>
					
					<input type="hidden" name="ajx_allow_<?php echo $i?>" id="ajx_allow_<?php echo $i?>" value="<?php echo $players;?>" />
						  </div>
					</li>
					<li><label>1 - <?=$allow_players?> players</label></li>
					<li><? echo '<a href="#." id="add_to_card_'.$i.'" >Add To Card</a>';?></li>
					</ul>
					</div>
					<div class="clr"></div>
				  </div>
				</div>
				<div class="golf_bottom"></div>
				<div class="clr"></div>
			  </div>
			  
			 
		 
				<div class="clr"></div>
		  </div><!--golf_outer end-->
					
					
					
					
					
					
					<?  
					
					if($am_or_pm=0)
					$ajx_mytime=$mytime;
					if($am_or_pm=1)
					$ajx_mytime=$mytime;
					
					$ajx_price=$row[$i]->curr.' '.$row[$i]->ppPrice;
	
	//start Add to card dialogbox	
	?>
	<script>
	//maxWidth:600,
	//maxHeight: 500,
	
	$(function(){
		$("#dialog-form").dialog({
			autoOpen: false,
			height:678 ,
			width: 998,
			//left:174.5,
			modal: true
			
			/*autoOpen: false,
			height: 500,
		    width: 998,
			modal: true,
			buttons: false,*/
		});
		$( "#add_to_card_<?php echo $i;?>" ).click(function() {
			
			var ajx_allow=$('#ajx_allow_<?php echo $i?>').val();
			$.ajax({
				type:'post',
				data:'ajx_mytime=<?php echo $ajx_mytime;?>&date=<?php echo time();?>&ajx_price=<?php echo $ajx_price;?>&ajx_select_playr='+ajx_allow+'&maxRewPts=<?php echo $maxRewPts;?>&nm=<?php echo $name;?>&ppnonref=<?php echo $row[$i]->ppNonRef;?>&course_id=<?php echo $id;?>&img=<?php echo $img;?>&allow_players=<?php echo $allow_players ?>&ppTxnFee=<?=$ppTxnFee?>&ppCharge=<?=$ppCharge?>&chrgCurr=<?=$chrgCurr?>&ppNetRt=<?=$ppNetRt?>&ppRewPts=<?=$ppRewPts?>&flags=<?=$flags?>',
				url:'<?php echo base_url()?>reserve_golfcourse/add_cart',
				success:function(data)
				{
				   $("#dialog-form").html(data);
				} 
				});
				
				$('#dash-loader').show().delay(5100).fadeOut(300);
				setTimeout(function(){$( "#dialog-form" ).dialog( "open" );}, 5100);
				//$( "#dialog-form" ).dialog( "open" );
			
			});
	});
	
	</script>	
					
		<?php	
		}//end first for loop
				
				if($k==0)
				{?>
					<div class="golf_outer">
					<div class="golf">
					<div class="golf_top"></div>
					<div class="golf_rpt">
					<? echo 'No Record Found in this catagory.';?>
					</div>
					<div class="golf_bottom"></div>
					<div class="clr"></div>
					</div>
					<div class="clr"></div>
					</div>
			 <? }
			 
			
			
		}//end if record and time record exist
		else
		{//end else record exist?>
		    <div class="golf_outer">
			<div class="golf">
			<div class="golf_top"></div>
			<div class="golf_rpt" style="padding-left: 43px; color:#FF0000;">
			<?  echo 'No Record Found.';?>
			</div>
			<div class="golf_bottom"></div>
			<div class="clr"></div>
			</div>
			<div class="clr"></div>
            </div>
		  
	<? }//end else record exist
		
?>


        <div class="clr"></div>
      </div>
      
			
			
		
  </div>         


	
		
		





<script>
//if changing the total numbers of player 
function player_change(value,i_counter)
{
   $('#ajx_allow_'+i_counter).val(value);
}


function delete_cart(gama_add_cart_id,course_id)
{
	$.ajax({
	type:'post',
	data:'gama_add_cart_id='+gama_add_cart_id+'&course_id='+course_id,
	url:'<?php echo base_url();?>reserve_golfcourse/delete_cart',
	success:function(data)
		{
		   $("#dialog-form").html(data);
		}
	});
}


function hello()
{
   $("#dialog-form").dialog("close");
}


//increase quantity
function ajax_cart_listing(players,gama_add_cart_id)
{
	$.ajax({
		type:'post',
		data:'players='+players+'&gama_add_cart_id='+gama_add_cart_id,
		url:'<?php echo base_url()?>reserve_golfcourse/ajax_cart_listing_dialogbox',
		success:function(data){
		$('#innerwrapper').html(data);
		}
    });
}

</script>


<style>
#dialog-form{ height:300px!important;overflow:scroll!important; }
</style>


<div class="demo">		
	<div id="dialog-form" title="Add to Cart" >
	</div>
</div>



</div>
</div>
