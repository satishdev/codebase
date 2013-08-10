<?	

		

		@$fin_date=strtotime(@$fin_date);

		echo '<div class="tee_time_bottom_date"><h5>'.date(' l \,\  jS F \,\  Y',@$fin_date).'</h5></div>';

		

		// check if record is not empty.

		if(@$RetCd==0  && !empty($altime))

		{

			$state=$course_arr->st;

			$city=$course_arr->cty;

			$name=$course_arr->nm;

			$date=$course_arr->Dates->alDate->dt;

			

			$dat=explode('T',$date);

			$dat=strtotime($dat[0]);

			//echo '<strong>'.date(' l \,\  jS F \,\  Y',$dat).'</strong><br><br><br>';

			

			

			//all listing start here

			//$row=$course_arr->Dates->alDate->Times->alTime;

			

			$total_teetime=count($altime);

			$total_golfcourses=1;

			echo '<div class="tee_time_bottom_date"><h5>'.$total_teetime.' Tee Times available from '.$total_golfcourses.' Golf Course in '.$state_name.'</h5></div>';

			

			

			$row=$altime;

			$k=0;

			$pagination_count=0;

			for($i=0;$i<count($row);$i++)

			{

			    $ppTxnFee=$row[$i]->ppTxnFee;

				$ppCharge=$row[$i]->ppCharge;

				$chrgCurr=$row[$i]->chrgCurr;

				$ppNetRt=$row[$i]->ppNetRt;

				$ppRewPts=$row[$i]->ppRewPts;

				$flags=$row[$i]->flags;

			

			

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

                  <h4><? echo $name;?></h4>

                  <p><? echo $city.' , '.$state;?></p>

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

/*autoOpen: false,

		height: 300,

		width: 350,

		modal: true,

		buttons: false,*/

$(function(){

	$("#dialog-form").dialog({

	autoOpen: false,

		height: 678,

		width: 998,

		//left:174.5,

		modal: true

	});

	$( "#add_to_card_<?php echo $i;?>" ).click(function() {

		

		var my_ajax_date= $('#my_ajax_date').val();

		var ajx_allow=$('#ajx_allow_<?php echo $i?>').val();

		$.ajax({

			type:'post',

			data:'ajx_mytime=<?php echo $ajx_mytime;?>&date='+my_ajax_date+'&ajx_price=<?php echo $ajx_price;?>&ajx_select_playr='+ajx_allow+'&maxRewPts=<?php echo $course_arr->maxRewPts;?>&nm=<?php echo $course_arr->nm;?>&ppnonref=<?php echo @$row[$i]->ppNonRef;?>&course_id=<?php echo $course_arr->id;?>&img=<?php echo $course_arr->img;?>&allow_players=<?php echo $allow_players ?>&ppTxnFee=<?=$ppTxnFee?>&ppCharge=<?=$ppCharge?>&chrgCurr=<?=$chrgCurr?>&ppNetRt=<?=$ppNetRt?>&ppRewPts=<?=$ppRewPts?>&flags=<?=$flags?>' ,

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

	

	//end Add to card dialog box			

			

			

			//for pagination

		  /* $pagination_count++;

		   if($pagination_count==20)

		   {

		     break;

		   }*/

		   //end for pagination

			

			

			}

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

		<?  }

		 

		}

		else

		{?>

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

	<?	}//resulting data ending here....

		

		

?>





        <div class="clr"></div>

      </div>

      <div class="clr"></div>

	  

	  <?=@$paginglink?>

	  

    </div>

  </div>

			

			

		

  </div>         





	

		

		<div class="clr"></div>

		

		</div>