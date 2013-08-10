

<link rel="stylesheet" href="<?php echo base_url() ?>asserts/css/css_model/jquery.ui.all.css">

<script type="text/javascript" src="<?=base_url()?>asserts/js/jquery-1.8.1.js"></script>

<!--<script src="<?php echo base_url() ?>js/jquery-1.8.2.js"></script>-->

<script src="<?php echo base_url() ?>asserts/js/jquery.bgiframe-2.1.2.js"></script>

<script src="<?php echo base_url() ?>asserts/js/js_model/jquery.ui.core.js"></script>

<script src="<?php echo base_url() ?>asserts/js/js_model/jquery.ui.widget.js"></script>

<script src="<?php echo base_url() ?>asserts/js/js_model/jquery.ui.position.js"></script>

<script src="<?php echo base_url() ?>asserts/js/js_model/jquery.ui.dialog.js"></script>







<!--<link type="text/css" href="<?=base_url()?>css/menu/menu.css" rel="stylesheet" />

<script type="text/javascript" src="<?=base_url()?>js/jquery-1.8.1.js"></script>

<script type="text/javascript" src="<?=base_url()?>css/menu/menu.js"></script>

<script>

function get_state()

{

   $.ajax({

   type:'post',

   url:'<?=base_url()?>teetime_golfcourse/dropdown_teetime/',

   success:function(data){

	  $('#hirarchy_teetime').html(data);

   }

   });

}



//$(document).ready(function()

//{

//	

//});

get_state();

</script>



<div id="hirarchy_teetime">

</div>

<div id="copyright"><a href="http://apycom.com/"></a></div>-->















<style>



.bold{ font-weight:bold;}



</style>





		

		

	    <!--check which sorting and filteration is on-->

		<input type="hidden" name="sort_val" id="sort_val" value="<?=@$sort?>" />

		<input type="hidden" name="filter_val" id="filter_val" value="<?=@$filter?>" />

		

		

		

		<!--check which course_id players, fin_date is on-->

		<input type="hidden" name="course_val" id="sort_val" value="<?=@$course_id?>" />

		<input type="hidden" name="player_val" id="sort_val" value="<?=@$players?>" />

		<? @$fin_date=strtotime($fin_date);?>

		<input type="hidden" name="fin_val" id="sort_val" value="<?=@$fin_date?>" />

		<input type="hidden" name="times" id="times" value="<?=@$times?>" />

		

		

	

	

		Sorting by:

		<a <? if(@$sort=='price'){?> class="bold"<? }?> href="<?=base_url()?>search_golfcourse/sorting/price/<?=@$filter?>/<?=@$course_id?>/<?=@$players?>/<?=@$fin_date?>/<?=@$times?>">Price</a>|

		

		<a <? if(@$sort=='times'){?> class="bold"<? }?> href="<?=base_url()?>search_golfcourse/sorting/times/<?=@$filter?>/<?=@$course_id?>/<?=@$players?>/<?=@$fin_date?>/<?=@$times?>">Time</a>| 

		

		<a <? if(@$sort=='course'){?> class="bold"<? }?> href="<?=base_url()?>search_golfcourse/sorting/course/<?=@$filter?>/<?=@$course_id?>/<?=@$players?>/<?=@$fin_date?>/<?=@$times?>">Course</a><br />

		

		

	Filter By:<a <? if(@$filter=='all_day'){?> class="bold"<? }?> href="<?=base_url()?>search_golfcourse/sorting/<?=@$sort?>/all_day/<?=@$course_id?>/<?=@$players?>/<?=@$fin_date?>/<?=@$times?>">All day</a>| 

		<a <? if(@$filter=='early'){?> class="bold"<? }?> href="<?=base_url()?>search_golfcourse/sorting/<?=@$sort?>/early/<?=@$course_id?>/<?=@$players?>/<?=@$fin_date?>/<?=@$times?>">Early Brid</a>|

		<a <? if(@$filter=='10'){?> class="bold"<? }?> href="<?=base_url()?>search_golfcourse/sorting/<?=@$sort?>/10/<?=@$course_id?>/<?=@$players?>/<?=@$fin_date?>/<?=@$times?>">8am - 10am</a>  | 

		<a <? if(@$filter=='noon'){?> class="bold"<? }?> href="<?=base_url()?>search_golfcourse/sorting/<?=@$sort?>/noon/<?=@$course_id?>/<?=@$players?>/<?=@$fin_date?>/<?=@$times?>">10am - Noon</a> | 

		<a <? if(@$filter=='2'){?> class="bold"<? }?> href="<?=base_url()?>search_golfcourse/sorting/<?=@$sort?>/2/<?=@$course_id?>/<?=@$players?>/<?=@$fin_date?>/<?=@$times?>">Noon - 2pm </a> | 

		<a <? if(@$filter=='afternoon'){?> class="bold"<? }?> href="<?=base_url()?>search_golfcourse/sorting/<?=@$sort?>/afternoon/<?=@$course_id?>/<?=@$players?>/<?=@$fin_date?>/<?=@$times?>">Afternoon</a><br />

	

	

	<!--pagination of listing-->

		

		<script type="text/javascript">

		

		$(document).ready(function(){

		$('#link1').addClass("bold");

		});

		

		var pre=0;

		function pagintin(date,j)

		{

			$.ajax({

				type:'post',

				url:'<?=base_url()?>search_golfcourse/ajax_pagination/ /<?=@$sort?>/<?=@$filter?>/<?=@$course_id?>/<?=@$players?>/<?=@$times?>/'+date,

				success:function(result){

				$('#replace').html(result);

				

				if(pre!=0)

				$('#link'+pre).removeClass("bold");

					

				$('#link'+j).addClass("bold");

				pre=j;

				}

		    });

		}

		

		</script>

		<?

		if($fin_date>time()){

		$pre_date=strtotime("-1 day",$fin_date);

		echo '<a href="'.base_url().'search_golfcourse/pagination/'.@$sort.'/'.@$filter.'/'.@$course_id.'/'.@$players.'/'.@$pre_date.'/'.@$times.'"> << </a>';

		}

		

		$mydate=date("M j D",$fin_date);

		$date1=strtotime($mydate);

		for($j=1;$j<=5;$j++)

		{

		  if($j==1){

		     $date2=date('M j D',$date1);

		     echo '<a href="#." id="link1" onclick="pagintin('.$date1.','.$j.')">'.$date2.'</a>&nbsp;|';

		  }else{

			 $date1=strtotime("+1 day",$date1);

			 $date2=date('M j D',$date1);

			 echo '<a href="#." id="link'.$j.'" onclick="pagintin('.$date1.','.$j.')">'.$date2.'</a>&nbsp;|';

			 $last_date=$date2;

		  }

		}

		

		$last_date=strtotime($last_date);

		$last_date=strtotime("+1 day",$last_date);

		echo '<a href="'.base_url().'search_golfcourse/pagination/'.@$sort.'/'.@$filter.'/'.@$course_id.'/'.@$players.'/'.@$last_date.'/'.@$times.'"> >> </a>';

		echo '<br><br>';

		//end pagination of listing

		

		

		

		//

		?>

		<div style="float:right;"> 

		<? $this->load->view('course_listing_left_menu');?>

		</div>

		<?

		//

		

		

		

		?><div id="replace"> <?	

		

		echo '<strong>'.date(' l \,\  jS F \,\  Y',@$fin_date).'</strong><br><br><br>';

		

		

		// check if record is not empty.

		if($course_arr->rc==0)

		{

			$state=$course_arr->st;

			$city=$course_arr->cty;

			$name=$course_arr->nm;

			$date=$course_arr->Dates->alDate->dt;

			

			$dat=explode('T',$date);

			$dat=strtotime($dat[0]);

			//echo '<strong>'.date(' l \,\  jS F \,\  Y',$dat).'</strong><br><br><br>';

			

			

			//all listing start here

			$row=$course_arr->Dates->alDate->Times->alTime;

			$k=0;

			for($i=0;$i<count($row);$i++)

			{

			 	

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

				$hid_filter=$this->session->userdata('hid_filter');

				if($hid_filter=='TRUE')

				{

					$flag=0;

					$price_filtration=$this->session->userdata('price_filtration');

					foreach($price_filtration as $key=>$val)

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

				

				

				

				

				$k++;

				$time_len=strlen($row[$i]->tm);

				$am=strtotime("0000:00:00 12:59:59");

				

				//heading of prices

				if($k==1){

				$heading_price=$row[$i]->ppPrice;

				echo '<strong>'.$row[$i]->curr.$heading_price.'</strong><br>';

				}

				if($heading_price==$row[$i]->ppPrice){

				//empty

				}else{

				$heading_price=$row[$i]->ppPrice;

				echo '<strong>'.$row[$i]->curr.$heading_price.'</strong><br>';

				}	

				

				

				//if start

				if($time_len==4)

				{

					$time_len=str_split($row[$i]->tm);

					$mytime=$time_len[0].$time_len[1].':'.$time_len[2].$time_len[3];

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

						}//end heading time set

					

						//echo  '<strong>'.$main_start.'-'. $main_end. '</strong><br>';

						$k++;

					}

					

				//if time range is between 1 hour, e.g 6 to7 excute if condition

					if($mytime_am_pm<$main_endc && $mytime_am_pm>$main_startc){

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

						//echo  '<strong>'.$main_start.'-'. $main_end. '</strong><br>';

						}//end heading time set

					

						//time set on every course

						if($mytime_am_pm>$am){

						$mytime=explode(':',$mytime);

						$$mytime[0]=$mytime[0]-12;

						$mytime=$$mytime[0].':'.$mytime[1];

						echo $mytime.'PM';

						}

						else{

						echo $mytime.'AM';

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

						   //echo  '<strong>'.$main_start.'-'. $main_end. '</strong><br>';

						}

						

						//if time range is between 1 hour, e.g 6 to7 excute if condition

						if($mytime_am_pm<$main_endc && $mytime_am_pm>$main_startc){

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

					    //echo  '<strong>'.$main_start.'-'. $main_end.'</strong><br>';

					}

					//time set to every course

					if($mytime_am_pm>$am){

					   echo $mytime.'PM';

					}

					else{

					   echo $mytime.'AM';

					}

				}

				

				

				echo '&nbsp;&nbsp;'.$name.'<br>';

				echo $city.' &nbsp;  '.$state;

				echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$row[$i]->curr.$row[$i]->ppPrice;

				

				

				

				

				

				

				

				

				////////

				///////

				//handle numbers of players

				$allow_players=$row[$i]->allow;

				$allow_players=strlen($allow_players);?>

				

				<select  onchange="player_change(this.value,<?php echo $i?>)">

				<?php for($j=1;$j<=$allow_players;$j++){?>

				<option <?php if($players==$j){?> selected="selected" <?php }?> value="<?php echo $j?>"><?php echo $j?></option>

				<?php }?>

				</select>

				

				<input type="hidden" name="ajx_allow_<?php echo $i?>" id="ajx_allow_<?php echo $i?>" value="<?php echo $players;?>" />

				

				

				<?  //}

				

				if($am_or_pm=0)

				$ajx_mytime=$mytime.'PM';

				if($am_or_pm=1)

				$ajx_mytime=$mytime.'AM';

				

				$ajx_price=$row[$i]->curr.' '.$row[$i]->ppPrice;



//start Add to card dialogbox	

?>

<script>

//maxWidth:600,

//maxHeight: 500,











$(function(){

	$("#dialog-form").dialog({

		autoOpen: false,

		height: 300,

		width: 350,

		modal: true,

		buttons: false,

	});

	$( "#add_to_card_<?php echo $i;?>" ).click(function() {

		

		var ajx_allow=$('#ajx_allow_<?php echo $i?>').val();

		$.ajax({

			type:'post',

			data:'ajx_mytime=<?php echo $ajx_mytime;?>&date=<?php echo time();?>&ajx_price=<?php echo $ajx_price;?>&ajx_select_playr='+ajx_allow+'&maxRewPts=<?php echo $course_arr->maxRewPts;?>&nm=<?php echo $course_arr->nm;?>&ppnonref=<?php echo $row[$i]->ppNonRef;?>&course_id=<?php echo $course_arr->id;?>&img=<?php echo $course_arr->img;?>&allow_players=<?php echo $allow_players ?>',

			url:'<?php echo base_url()?>reserve_golfcourse/add_cart',

			success:function(data)

			{

			   $("#dialog-form").html(data);

			} 

			});

			$( "#dialog-form" ).dialog( "open" );

		});

});











</script>	

				

	<?php	

	echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#." id="add_to_card_'.$i.'" >Add To Card</a>';

	//end Add to card dialog box			

				echo '<br><br>';

				////////

				////////

				

				

				

				

				

				

				

				

				

				

				

				

				

				

				

				

				

			}

			

			

			

			

			

			

			

			if($k==0)

			{

			   echo 'No Record Found in this catagory.';

			}

		}

		else

		{

		

		echo 'No Record Found.';

		}



?>

</div>











<script>

//if changing the total numbers of player 

function player_change(value,i_counter)

{

   $('#ajx_allow_'+i_counter).val(value);

}





function delete_cart(gama_add_cart_id)

{

	$.ajax({

	type:'post',

	data:'gama_add_cart_id='+gama_add_cart_id,

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





</script>











<div class="demo">		

	<div id="dialog-form" >

	</div>

</div>	