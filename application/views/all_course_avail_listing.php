<!--for add to card fency box-->

<link rel="stylesheet" href="<?php echo base_url() ?>asserts/css/css_model/jquery.ui.all.css">

 <!-- <script type="text/javascript" src="<?=base_url()?>asserts/js/jquery-1.8.1.js"></script>

<script src="<?php echo base_url() ?>js/jquery-1.8.2.js"></script>-->

<script src="<?php echo base_url() ?>asserts/js/jquery.bgiframe-2.1.2.js"></script>

<script src="<?php echo base_url() ?>asserts/js/js_model/jquery.ui.core.js"></script>

<script src="<?php echo base_url() ?>asserts/js/js_model/jquery.ui.widget.js"></script>

<script src="<?php echo base_url() ?>asserts/js/js_model/jquery.ui.position.js"></script>

<script src="<?php echo base_url() ?>asserts/js/js_model/jquery.ui.dialog.js"></script>



	

	

	



<link type="text/css" href="<?=base_url()?>asserts/css/menu/menu.css" rel="stylesheet" />

<script type="text/javascript" src="<?=base_url()?>asserts/css/menu/menu.js"></script>

<style>

.navigation_right ul li {height:21px!important;}

</style>

<script>

function get_state()

{

   $.ajax({

   type:'post',

   url:'<?=base_url()?>teetime_golfcourse/dropdown_teetime/',

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







<!--<div id="hirarchy_golfcorse"></div>

</div>-->







<div id="copyright"><a href="http://apycom.com/"></a></div>









<style>



.golf_div2 h4{padding-bottom: 0px;}

	.golf_div2 p{padding-bottom: 0px; margin: 0px 0;

    padding: 0px 0px;}

	

</style>









<!--<link type="text/css" href="<?=base_url()?>css/menu/menu.css" rel="stylesheet" />

<script type="text/javascript" src="<?=base_url()?>js/jquery-1.8.1.js"></script>

<script type="text/javascript" src="<?=base_url()?>css/menu/menu.js"></script>

<script>

$(document).ready(function()

//{

//});

get_state();

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

		

		<!--Sorting by:

		<a <? if(@$sort=='price'){?> class="bold"<? }?> href="<?=base_url()?>search_golfcourse/sorting/price/<?=@$filter?>/<?=@$course_id?>/<?=@$players?>/<?=@$fin_date?>/<?=@$times?>">Price</a>|

		

		<a <? if(@$sort=='times'){?> class="bold"<? }?> href="<?=base_url()?>search_golfcourse/sorting/times/<?=@$filter?>/<?=@$course_id?>/<?=@$players?>/<?=@$fin_date?>/<?=@$times?>">Time</a>| 

		

		<a <? if(@$sort=='course'){?> class="bold"<? }?> href="<?=base_url()?>search_golfcourse/sorting/course/<?=@$filter?>/<?=@$course_id?>/<?=@$players?>/<?=@$fin_date?>/<?=@$times?>">Course</a><br />

-->















<style>

#hirarchy_golfcorse{margin: -22px 0 22px;!important}

</style>





<div id="content">



<div id="hirarchy_golfcorse"></div>



        <?

		$country_id=$this->session->userdata('country_id');

		$state_id=$this->session->userdata('state_id');

		if($state_id=='' || $country_id=='')

		{

			$country_id='USA';

			$state_id='CA';

		}

		

		

		//showing full name of state

		$client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");

	    $response = $client->Areas(array("Hdr"=>array("ResellerId"=>"WPA",

													"PartnerId"=>"",

													"SourceCd"=>"A",

													"Lang"=>"en",

													"UserIp"=>"66.147.244.227",

													"UserSessionId"=>"",

													"AccessKey"=>"",

													"Agent"=>"",

													"gsSource"=>"",

													"gsDebug"=>true),

									"Req"=>array("CountryId"=>$country_id,

													"RegionId"=>$state_id)));

	

	    $state_name = $response->AreasResult->Countries->Country->Regions->Region->nm;
	    
	    if($state_name == '') $state_name = " ";
		$this->session->set_userdata('my_golfcourse_heading',$state_name);

		//end showing full name of state

		?>





      

		<? $this->load->view('all_course_listing_left_menu');?>

	  

	  

	  

	  

	  

	

	  <div id="content_right">

        <div class="tee_time">

          <div class="tee_time_top">

            <h3><?=@$state_name?> Tee Times</h3>

          </div>

          <div class="tee_time_mid">

           

		   

		   

		   

		   <div class="tee_time_mid_left">

             <!-- <ul>

                <li>

                  <label>Within</label>

                </li>

                <li>

                  <div class="mile">

                    <select>

                      <option>5 mile</option>

                    </select>

                  </div>

                </li>

                <li>

                  <label>of</label>

                </li>

                <li>

                  <div class="mile">

                    <input type="text" value="Postal Code" />

                  </div>

                </li>

                <li>

                  <div class="mile2"><input type="button" value="Sarch" /></div>

                </li>

              </ul>

              <div class="clr"></div>-->

            </div>

           

		 

			

			

		<div class="tee_time_mid_right">

		  <div class="clander">

		<!--pagination of listing-->

		<script type="text/javascript">

		

		$(document).ready(function(){

		$('#link1').addClass("select");

		});

		

		var pre=0;

		function pagintin(date,j)

		{

			$('#dash-loader').show();
		//alert('<?=base_url()?>search_golfcourse/ajax_pagination/<?=@$state_name?>/<?=@$sort?>/<?=@$filter?>/1493/<?=@$players?>/<?=@$times?>/'+date);
			$.ajax({

				type:'post',

				url:'<?=base_url()?>search_golfcourse/ajax_pagination/<?=@$state_name?>/<?=@$sort?>/<?=@$filter?>/1493/<?=@$players?>/<?=@$times?>/'+date,

				success:function(result){ 
				$('#dash-loader').hide();
				$('#replace').html(result);

				//change the value of left and date picker value

				//end change the value of left and date picker value	

				if(pre!=0)
				$('#link'+pre).removeClass("select");	

				if(pre==0)
				$('#link1').removeClass("select");			

				$('#link'+j).addClass("select");
				pre=j;
				}
		    });
		}
		</script>

		

		<ul>

		<?

		$my_month=date("M j D",$fin_date);

		$my_month=explode(' ',$my_month);

		$my_month=$my_month[0];

		$my_month=strtoupper($my_month);

		$my_month=str_split($my_month);

		?>

		

		<li class="first_li"><?=$my_month[0]?><br/>

							<?=$my_month[1]?><br/>

							<?=$my_month[2]?></li>

		<?php

		if($fin_date>time()){

		$pre_date=strtotime("-1 day",$fin_date);

		echo '<li><a href="'.base_url().'search_golfcourse/pagination/'.@$sort.'/'.@$filter.'/'.'1493'.'/'.@$players.'/'.@$pre_date.'/'.@$times.'"> << </a><li>';

		}

		

		$mydate=date("M j D",$fin_date);

		$date1=strtotime($mydate);

		for($j=1;$j<=5;$j++)

		{

		  if($j==1){

		     $date2=date('M j D',$date1);

		     $date2_explode=explode(' ',$date2);

			 $date2_1=$date2_explode[1];

			 $date2_2=$date2_explode[2];

			 echo '<li><a href="#." id="link1" onclick="pagintin('.$date1.','.$j.')"><span>'.$date2_1.'</span><br/>'.$date2_2.'</a></li>';

                    

		  }else{

			 $date1=strtotime("+1 day",$date1);

			 $date2=date('M j D',$date1);

		     $date2_explode=explode(' ',$date2);

			 $date2_1=$date2_explode[1];

			 $date2_2=$date2_explode[2];

			 echo '<li><a href="#." id="link'.$j.'" onclick="pagintin('.$date1.','.$j.')"><span>'.$date2_1.'</span><br/>'.$date2_2.'</a></li>';

			 $last_date=$date2;

		  }

		}

		

		$last_date=strtotime($last_date);

		$last_date=strtotime("+1 day",$last_date);

		echo '<li><a href="'.base_url().'search_golfcourse/pagination/'.@$sort.'/'.@$filter.'/'.'1493'.'/'.@$players.'/'.@$last_date.'/'.@$times.'"> >> </a></li>';

		//end pagination of listing?> 

		  </ul>		 

				 

	               

              

                <div class="clr"></div>

              </div>

              <div class="clr"></div>

            </div>

            <div class="clr"></div>

          </div>

          <div class="tee_time_bottom">

		  

		  <!--<div class="time_right">

			    <ul>

				   <li><a <? if(@$filter=='all_day'){?> class="bold"<? }?> href="<?=base_url()?>search_golfcourse/sorting/<?=@$sort?>/all_day/1493/<?=@$players?>/<?=@$fin_date?>/<?=@$times?>">All day</a></li>

                  <li>|<a <? if(@$filter=='early'){?> class="bold"<? }?> href="<?=base_url()?>search_golfcourse/sorting/<?=@$sort?>/early/1493/<?=@$players?>/<?=@$fin_date?>/<?=@$times?>">Early Brid</a></li>

                  <li>|<a <? if(@$filter=='10'){?> class="bold"<? }?> href="<?=base_url()?>search_golfcourse/sorting/<?=@$sort?>/10/1493/<?=@$players?>/<?=@$fin_date?>/<?=@$times?>">8am - 10am</a></li>

                  <li>|<a <? if(@$filter=='noon'){?> class="bold"<? }?> href="<?=base_url()?>search_golfcourse/sorting/<?=@$sort?>/noon/1493/<?=@$players?>/<?=@$fin_date?>/<?=@$times?>">10am - Noon</a></li>

                  <li>|<a <? if(@$filter=='2'){?> class="bold"<? }?> href="<?=base_url()?>search_golfcourse/sorting/<?=@$sort?>/2/1493/<?=@$players?>/<?=@$fin_date?>/<?=@$times?>">Noon - 2pm </a></li>

				  <li class="last_li"> |<a <? if(@$filter=='afternoon'){?> class="bold"<? }?> href="<?=base_url()?>search_golfcourse/sorting/<?=@$sort?>/afternoon/1493/<?=@$players?>/<?=@$fin_date?>/<?=@$times?>">Afternoon</a></li>

                </ul>

			    <div class="clr"></div>

              </div>-->

		  

		  

		

		

		<div id="replace"> <?	

		

		/*if($course_arr->rc==0)

		{

			$state=$course_arr->st;

			$city=$course_arr->cty;

			$name=$course_arr->nm;

			$date=$course_arr->Dates->alDate->dt;

			

			$dat=explode('T',$date);

			$dat=strtotime($dat[0]);

			echo '<strong>'.date(' l \,\  jS F \,\  Y',$dat).'</strong><br><br><br>';

		}*/

		echo '<div class="tee_time_bottom_date"><h5>'.date(' l \,\  jS F \,\  Y',@$fin_date).'</h5></div>';
	

	

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

	 

	     

		 $total_teetime=count($row);

		 if($total_teetime>1)

		 {$space='s';}else{$space='';}

	     echo '<div class="tee_time_bottom_date"><h5>'.$total_teetime.' Tee Times available from '.$arr_count.' Golf Course'.$space.' in '.$state_name.'</h5></div>';

	 

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

			<div class="golf_rpt">

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

      <div class="clr"></div>

    </div>

  </div>

			

			

		

  </div>         





	

		

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



<div class="clr"></div>

<div class="demo">		

	<div id="dialog-form" title="Add to Cart" >

	</div>

</div>	