<?

		
		@$fin_date=strtotime(@$fin_date);
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
				echo '<br><br>';
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