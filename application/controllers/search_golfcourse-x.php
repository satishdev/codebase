<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_golfcourse extends MY_Controller {

	function __construct() {

		// Call the Parent constructor

		parent::__construct();

		/*if($this->userType!=2){	

		redirect('login');exit;

		}*/

    }

	public function index()

	{

		$data1['contents']=$this->load->view('teetime_search','',true);

		$data1['my_title']='Golf Course';

		$this->load->view('template',$data1);

	}
	
	function cron_job()

	{

		$this->common_model->delete_all('gama_country');

		$this->common_model->delete_all('gama_state');

		$this->common_model->delete_all('gama_area');

		

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

							"Req"=>array("CountryId"=>"",

											"RegionId"=>"")));

	

	 

	    if($response->AreasResult->RetCd==0)

		{//check country data exist

		 $country=$response->AreasResult->Countries->Country;

		 $area_arr_id='';

		 $area_arr_nm='';

		 $region_arr_id='';

		 $region_arr_nm='';

		 $country_arr_id='';

		 $country_arr_nm='';

		  for($i=0; $i<count($country);$i++)

		  {//country for loop

			  $country_arr_id=$country[$i]->id;

			  $country_arr_nm=$country[$i]->nm;

			  

			  $db_fields['id']=$country_arr_id;

			  $db_fields['nm']=$country_arr_nm;

			  $country_insert_id=$this->common_model->insert_array('gama_country',$db_fields);

			  $db_fields='';

			  //check region is single or multiple record

			  $region=$country[$i]->Regions->Region;

			  if(count($region)==1)

			  {//if region data is single

					 $region_arr_id=$region->id;

					 $region_arr_nm=$region->nm;

					 

					 $db_fields['id']=$region_arr_id;

					 $db_fields['nm']=$region_arr_nm;

					 $db_fields['c_id']=$country_arr_id;

					 $db_fields['c_nm']=$country_arr_nm;

					 $db_fields['country_id']=$country_insert_id;

					 $region_insert_id=$this->common_model->insert_array('gama_state',$db_fields);

					 $db_fields='';

					 //check area is single or multiple record

					 $area=$region->Areas->Area;

					 if(count($area)==1)

					 {//if area data is single

					   $area_arr_id=$area->id;

					   $area_arr_nm=$area->nm;

					   

						$db_fields['id']=$area_arr_id;

						$db_fields['nm']=$area_arr_nm;

						$db_fields['s_id']=$region_arr_id;

						$db_fields['s_nm']=$region_arr_nm;

						$db_fields['state_id']=$region_insert_id;

						$db_fields['c_id']=$country_arr_id;

						$db_fields['c_nm']=$country_arr_nm;

						$db_fields['country_id']=$country_insert_id;

						$this->common_model->insert_array('gama_area',$db_fields);

						$db_fields='';

					 }//end if area data is single

					 else

					 {//if area data is more than single

						for($j=0; $j<count($area);$j++)

						{

						  $area_arr_id=$area[$j]->id;

						  $area_arr_nm=$area[$j]->nm;

						  

						  $db_fields['id']=$area_arr_id;

						  $db_fields['nm']=$area_arr_nm;

						  $db_fields['s_id']=$region_arr_id;

						  $db_fields['s_nm']=$region_arr_nm;

						  $db_fields['state_id']=$region_insert_id;

						  $db_fields['c_id']=$country_arr_id;

						  $db_fields['c_nm']=$country_arr_nm;

						  $db_fields['country_id']=$country_insert_id;

						  $this->common_model->insert_array('gama_area',$db_fields);

						  $db_fields='';

						}

					 }//end if area data is more than single 

			  }//end if region data is single

			  else if(count($region)>1)

			  {//if region data is more than single

					 for($k=0; $k<count($region);$k++)

					 {

						 $region_arr_id=$region[$k]->id;

						 $region_arr_nm=$region[$k]->nm;

						 

						 $db_fields['id']=$region_arr_id;

						 $db_fields['nm']=$region_arr_nm;

						 $db_fields['c_id']=$country_arr_id;

						 $db_fields['c_nm']=$country_arr_nm;

						 $db_fields['country_id']=$country_insert_id;

						 $region_insert_id=$this->common_model->insert_array('gama_state',$db_fields);

						 $db_fields='';

						 

						 //check area is single or multiple record

						 $area=$region[$k]->Areas->Area;   

						

						 if(count($area)==1)

						 {

							$area_arr_id=$area->id;

							$area_arr_nm=$area->nm;

							

							$db_fields['id']=$area_arr_id;

							$db_fields['nm']=$area_arr_nm;

							$db_fields['s_id']=$region_arr_id;

							$db_fields['s_nm']=$region_arr_nm;

							$db_fields['state_id']=$region_insert_id;

							$db_fields['c_id']=$country_arr_id;

							$db_fields['c_nm']=$country_arr_nm;

							$db_fields['country_id']=$country_insert_id;

							$this->common_model->insert_array('gama_area',$db_fields);

							$db_fields='';

						 }

						 else

						 {//if area data is more than single

							for($u=0;$u<count($area);$u++)

							{

							  $area_arr_id=$area[$u]->id;

							  $area_arr_nm=$area[$u]->nm;

							  

							  $db_fields['id']=$area_arr_id;

							  $db_fields['nm']=$area_arr_nm;

							  $db_fields['s_id']=$region_arr_id;

							  $db_fields['s_nm']=$region_arr_nm;

							  $db_fields['state_id']=$region_insert_id;

							  $db_fields['c_id']=$country_arr_id;

							  $db_fields['c_nm']=$country_arr_nm;

							  $db_fields['country_id']=$country_insert_id;

							  $this->common_model->insert_array('gama_area',$db_fields);

							  $db_fields='';

							}

						 }//end if area data is more than single 

					 }

				}//end if region data is more than single

				

				

			  }//end country for loop

		    }//end check country data exist

			//$countryArr = $response->AreasResult->Countries->Country;

			//print_r($countryArr);

			//echo "<pre>";

			redirect($_SERVER['HTTP_REFERER']);

	  }

	function country_change()

	{

	    //check for by default selected Arizona and onchange of country nothing selected.

		$state_set_unset=$this->input->post('state_set_unset');

		if($state_set_unset==2)

		{

		  $this->session->unset_userdata('state_id');

		}

		

		$country_id=$this->input->post('country_id');

	

		/*$client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");

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

													  "RegionId"=>"")));

		$region_arr = $response->AreasResult->Countries->Country->Regions->Region;*/

		

		$region_arr=$this->common_model->select_where('*','gama_state',array('c_id'=>$country_id));

		$region_arr=$region_arr->result();

		

		$html='';

		//if single record

		if(is_array($region_arr)==FALSE)

		{

			$html.='<select name="state_id" id="state_id" onchange="state_change(this.value,2)">';

			$html.='<option value="">--Select One--</option>';

			

			///////////

			$select=0;

			if($this->session->userdata('state_id')!='')

			{

				if($this->session->userdata('state_id')==$region_arr->id)

				{

				  $select=1;

				}

			}

			$selected='';

			if($select==1){

				$selected='selected="selected"';

			}

			/////////////

			

			$html.='<option '.$selected.' value="'.$region_arr->id.'">'.$region_arr->nm.'</option>';

			$html.='</select>';

		}//end if single record

		else

		{//if more than single record 

			$html.='<select name="state_id" id="state_id" onchange="state_change(this.value,2)">';

			$html.='<option value="">--Select One--</option>';

			for($i=0; $i<count($region_arr);$i++){

			

			///////////

			$select=0;

			if($this->session->userdata('state_id')!='')

			{

				if($this->session->userdata('state_id')==$region_arr[$i]->id)

				{

				  $select=1;

				}

			}

			$selected='';

			if($select==1){

				$selected='selected="selected"';

			}

			/////////////

			

			$html.='<option '.$selected.' value="'.$region_arr[$i]->id.'">'.$region_arr[$i]->nm.'</option>';}

			$html.='</select>';

	     }//end if more than single record

		 echo $html;

	 }

	function state_change()

	{

	    $state_id=$this->input->post('state_id');

		$country_id=$this->input->post('country_id');

		/*$client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");

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

				$area_arr = $response->AreasResult->Countries->Country->Regions->Region->Areas->Area;*/

		

		

		$area_arr=$this->common_model->select_where('*','gama_area',array('c_id'=>$country_id,'s_id'=>$state_id));

		$area_arr=$area_arr->result();

		

		$html='';

		if(is_array($area_arr)==FALSE)

		{

			$html.='<select name="area_id" id="area_id" onchange="area_change(this.value)">';

			$html.='<option value="">--Select One--</option>';

			

			///////////

			$select=0;

			if($this->session->userdata('area_id')!='')

			{

				if($this->session->userdata('area_id')==$area_arr->id)

				{

				  $select=1;

				}

			}

			$selected='';

			if($select==1){

				$selected='selected="selected"';

			}

			/////////////

			

			$html.='<option '.$selected.' value="'.$area_arr->id.'">'.$area_arr->nm.'</option>';

			$html.='</select>';

		}

		else

		{ 

			$html.='<select name="area_id" id="area_id" onchange="area_change(this.value)">';

			$html.='<option value="">--Select One--</option>';

			for($i=0; $i<count($area_arr);$i++){

			

			///////////

			$select=0;

			if($this->session->userdata('area_id')!='')

			{

				if($this->session->userdata('area_id')==$area_arr[$i]->id)

				{

				  $select=1;

				}

			}

			$selected='';

			if($select==1){

				$selected='selected="selected"';

			}

			/////////////

			

			$html.='<option '.$selected.' value="'.$area_arr[$i]->id.'">'.$area_arr[$i]->nm.'</option>';}

			$html.='</select>';

	    }

		echo $html;
	 }  

	function area_change()

	{
	    $state_id=$this->input->post('state_id');
		$country_id=$this->input->post('country_id');
		$area_id=$this->input->post('area_id');
		

		$client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");
	    $response = $client->CourseList(array("Hdr"=>array("ResellerId"=>"WPA",
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
													 "RegionId"=>$state_id,
													 "Area"=>$area_id,
													 "Latitude"=>"",
													 "Longitude"=>"",
													 "PostalCode"=>"",
													 "MaxDistance"=>"",
													 "MaxDistanceType"=>"",
													 "ShowAllStatus"=>"active",
													 "ShowDisConnected"=>"",
													 "FeaturedOnly"=>"",
													 "Sort"=>"")));	
	    //add	    
	    $response = $this->getCourseList($country_id, $state_id, $area_id);
	    //End add

		$RetCd=$response->CourseListResult->RetCd;		
		if($RetCd==0)
		{
			$course_arr = $response->CourseListResult->Courses->clCourse;
			
			$html='';
			if(is_array($course_arr)==FALSE)
			{
				$html.='<select name="course_id" id="course_id">';
				$html.='<option value="">--Select One--</option>';
				///////////
				$select=0;
				if($this->session->userdata('course_id')!='')
				{
					if($this->session->userdata('course_id')==$course_arr->id)
					{
					  $select=1;
					}
				}
				$selected='';
				if($select==1){
					$selected='selected="selected"';
				}

				/////////////
				

				$html.='<option '.$selected.' value="'.$course_arr->id.'">'.str_replace("&","",$course_arr->nm).'</option>';
				$html.='</select>';
			}
			 else
			{ 
				$html.='<select name="course_id" id="course_id">';
				$html.='<option value="">--Select One--</option>';
				for($i=0; $i<count($course_arr);$i++){	
					///////////
					$select=0;
					if($this->session->userdata('course_id')!='')
					{
						if($this->session->userdata('course_id')==$course_arr[$i]->id)
						{
						  $select=1;
						}
					}

					$selected='';
					if($select==1){
						$selected='selected="selected"';
					}

					/////////////		

					$html.='<option '.$selected.' value="'.$course_arr[$i]->id.'">'.$course_arr[$i]->nm.'</option>';
				}
				$html.='</select>';
		    }
			$json['RetCd']=$RetCd;			
			$json['mydata']= $html;
			echo json_encode($json);
		}
		else
		{
			$RetMsg=$response->CourseListResult->RetMsg;
			$RetCd=$response->CourseListResult->RetCd;
			$json['RetCd']=$RetCd;
			$json['RetMsg']=ucfirst($RetMsg);
			echo json_encode($json);
		} 		 

	}  

	function spcfic_goglelink($course_id)

	{

		$this->session->set_userdata('course_id',$course_id);

		$client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");

	    $response = $client->CourseInfo(array("Hdr"=>array("ResellerId"=>"WPA",

															"PartnerId"=>"",

															"SourceCd"=>"A",

															"Lang"=>"en",

															"UserIp"=>"66.147.244.227",

															"UserSessionId"=>"",

															"AccessKey"=>"",

															"Agent"=>"",

															"gsSource"=>"",

															"gsDebug"=>true),

											"Req"=>array("CourseId"=>$course_id,

															)));

		$area_id=$response->CourseInfoResult->Course->sAr;

		$this->session->set_userdata('area_id',$area_id);

		//print_r();

		//exit;													

		redirect('search_golfcourse/search_teetimes');

	}

	function teetimes()

	{
		$beginTimes = '';
		$endTimes = '';
			
		$country_id=$this->session->userdata('country_id');

		$state_id=$this->session->userdata('state_id');

		$area_id=$this->session->userdata('area_id');

		if($state_id=='')

		{

			$country_id='USA';

			$state_id='AZ';

			$area_id='Payson';

			$course_id='';

		

			//save in session

			$this->session->set_userdata('country_id',$country_id);

			$this->session->set_userdata('state_id',$state_id);

			$this->session->set_userdata('area_id',$area_id);

			$this->session->set_userdata('course_id',$course_id);

		}

		

		

		$date=$this->session->userdata('fin_date');

		if($date=='')

		$date=time();

		//save in session

		$this->session->set_userdata('fin_date',$date);

		

		$times=$this->session->userdata('times');
	#	echo "Day la time: ".$times;
		if($times==''){
			$times='700';
			$beginTimes = '0700';
			$endTimes = '1100';
		}else{
			$beginTimes = $times;
		}
		//save in session
 
		$this->session->set_userdata('times',$times);

		

		$players=$this->session->userdata('players');

		if($players=='')

		$players='1';

		//save in session

		$this->session->set_userdata('players',$players);

		$fin_date=date('Y-m-d',$date);


	$client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");

    $response = $client->CourseAvailList(array("Hdr"=>array("ResellerId"=>"WPA",

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

															"RegionId"=>$state_id,

															"Area"=>$area_id,

															"PlayBegDate"=>$fin_date."T00:00:00",

															"PlayEndDate"=>$fin_date."T00:00:00",

															"Time"=>"0600",

															"Players"=>"1",

															"MaxDistance"=>"",

															"FeaturedOnly"=>false,

															"ShowAllTimes"=>true,

															"ShowIfNoTimes"=>true,

															"BarterOnly"=>false,

															"ChargingOnly"=>false,

															"SpecialsOnly"=>false,

															"RegularRateOnly"=>false,

															"ProfileId"=>"")));				
  				//$course_obA = $this->getCourseAvail($fin_date,$course_id, $times);
  				//echo "<br><br>course_: <pre>"; print_r($course_obA); echo "</pre>";
				//add		
	#			echo "###########################".$beginTimes;				
				$course_ob = $this->getCourseAvailList($fin_date, $country_id, $state_id, $area_id, $beginTimes, $endTimes);
				//echo "<br><br>course_: <pre>"; print_r($course_ob); echo "</pre>";
				$response = $course_ob;
				// End add
				$RetCd=$response->CourseAvailListResult->RetCd;
				if($RetCd==0)

				{

					$course_arr=$response->CourseAvailListResult->Courses->alCourse;

					$altime=array();

					$tim=array();

					if(count($course_arr)==1)

					{

					   if(isset($course_arr->Dates->alDate->Times->alTime))

					   {

						   $tim=$course_arr->Dates->alDate->Times->alTime;

						   if(count($tim)==1)

						   {

						      //$altime[]=$tim;
						      $altime=$tim;//fix

						   }

						   if(count($tim)>1)

						   {

							   for($j=0;$j<count($tim);$j++)

							   {

								  $altime[]=$tim[$j];

							   }

						   }

					   }

					}

					else if( count($course_arr) >1)

					{

						for($i=0;$i< count($course_arr);$i++)
 
						{
						   if(isset($course_arr[$i]->Dates->alDate->Times->alTime))

						   {

							   $tim=$course_arr[$i]->Dates->alDate->Times->alTime;

							   if(count($tim)==1)

							   {								  
						      	  $altime[]=$tim;						      	  

							   }
							   elseif(count($tim)>1){//add
							   		for($j=0;$j< count($tim);$j++)

								   {	
									  $altime[]=$tim[$j];

								   }

							   }//add
							   

							}

						 }

					 }

				 }

				 else

				 {

					 $course_arr='';

					 $altime='';

				 }

				

				$results['RetCd']=$RetCd;

				$results['course_arr']=$course_arr;

				$results['altime']=$altime;

				

				$results['players']=$players;

				$results['fin_date']=$fin_date;

				$results['times']=$times;

				

				$results['sort']='times';

				$results['filter']='all_day';

				//echo "<br><br>altime: <pre>"; print_r($altime); echo "</pre>";

				$data1['contents']=$this->load->view('all_course_avail_listing',$results,true);

				$data1['my_title']='TeeTime';$this->load->view('template',$data1);

	}

	function ajax_pagi($page_start_from=0)

	{

		$filter=$this->input->post('filter_val');

		/*$ajax_course_id=$this->input->post('ajax_course_id');

		$ajax_players=$this->input->post('ajax_players');

		$ajax_fin_date=$this->input->post('ajax_fin_date');

		$ajax_times=$this->input->post('ajax_times');*/


		

		//$country_id=$this->session->userdata('country_id');

		//$state_id=$this->session->userdata('state_id');

		//$area_id=$this->session->userdata('area_id');

		$course_id=$this->session->userdata('course_id');

		$fin_date=$this->session->userdata('fin_date');

		$fin_date=date('Y-m-d',$fin_date);

		$times=$this->session->userdata('times');

		$players=$this->session->userdata('players');

	

		$client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");

		$response = $client->CourseAvail(array("Hdr"=>array("ResellerId"=>"WPA",

																"PartnerId"=>"",

																"SourceCd"=>"A",

																"Lang"=>"en",

																"UserIp"=>"127.0.0.1",

																"UserSessionId"=>"",

																"AccessKey"=>"",

																"Agent"=>"",

																"gsSource"=>"",

																"gsDebug"=>true),

													"Req"=>array("CourseAvailRequest"=>

														   array("CourseId"=>$course_id,

																"PlayBegDate"=>$fin_date."T00:00:00",

																"PlayEndDate"=>$fin_date."T00:00:00",

																"Time"=>$times,

																"Players"=>$players,

																"AltRateType"=>"",

																"PromoCode"=>"",

																"ShowAllTimes"=>true,

																"BarterOnly"=>false,

																"ChargingOnly"=>false,

																"SpecialsOnly"=>false,

																"RegularRateOnly"=>false,

																"ProfileId"=>""))));


				$record_per_page=20;


				$RetCd=$response->CourseAvailResult->RetCd;

				if($RetCd==0)

				{

					$course_arr=$response->CourseAvailResult->Courses->caCourse;

					$altime=array();

					$tim=array();

					   if(isset($course_arr->Dates->alDate->Times->alTime))

					   {

						  $row=$course_arr->Dates->alDate->Times->alTime;

						   

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

						  

						    //after all check remaining data save in $tim

							$tim[]=$row[$i];

						  }

						  

						   if(count($tim)==1)

						   {

						      $altime[]=$tim;

						   }

						   if(count($tim)>1)

						   {

							   //pagination 

							  $last_record=$page_start_from+$record_per_page;

							   

							   for($j=$page_start_from;$j<$last_record;$j++)

							   {

								  if($j< count($tim))

								  $altime[]=$tim[$j];

							   }

						       //end pagination

								$mypaging['total_rows']=count($tim);

								$mypaging['base_url']=base_url()."search_golfcourse/ajax_pagi/";

								$mypaging['per_page']=$record_per_page;

								$mypaging['uri_segment']=3;

								$this->pagination->initialize($mypaging);

								$results['paginglink']=$this->pagination->ajax_create_links();

						       

						   }

					   }

				 }

				 else

				 {

					 $course_arr='';

					 $altime='';

				 }

				 

					

				$results['RetCd']=$RetCd;

				$results['course_arr']=$course_arr;

				$results['altime']=$altime;

				

				$results['course_id']=$course_id;

				$results['players']=$players;

				$results['fin_date']=$fin_date;

				$results['times']=$times;

				

				$results['sort']='times';

				//$results['filter']=$filter;

				

                $html=$this->load->view('ajax_course_avail_listing',$results,true);

	            echo $html;   

	}

	function ajax_pagi_link($page_start_from=0)

	{

		$filter=$this->input->post('filter');

		/*$ajax_course_id=$this->input->post('ajax_course_id');

		$ajax_players=$this->input->post('ajax_players');

		$ajax_fin_date=$this->input->post('ajax_fin_date');

		$ajax_times=$this->input->post('ajax_times');*/

		

		//$country_id=$this->session->userdata('country_id');

		//$state_id=$this->session->userdata('state_id');

		//$area_id=$this->session->userdata('area_id');

		$course_id=$this->session->userdata('course_id');

		$fin_date=$this->session->userdata('fin_date');

		$fin_date=date('Y-m-d',$fin_date);

		$times=$this->session->userdata('times');

		$players=$this->session->userdata('players');

	

		$client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");

		$response = $client->CourseAvail(array("Hdr"=>array("ResellerId"=>"WPA",

																"PartnerId"=>"",

																"SourceCd"=>"A",

																"Lang"=>"en",

																"UserIp"=>"127.0.0.1",

																"UserSessionId"=>"",

																"AccessKey"=>"",

																"Agent"=>"",

																"gsSource"=>"",

																"gsDebug"=>true),

													"Req"=>array("CourseAvailRequest"=>

														   array("CourseId"=>$course_id,

																"PlayBegDate"=>$fin_date."T00:00:00",

																"PlayEndDate"=>$fin_date."T00:00:00",

																"Time"=>$times,

																"Players"=>$players,

																"AltRateType"=>"",

																"PromoCode"=>"",

																"ShowAllTimes"=>true,

																"BarterOnly"=>false,

																"ChargingOnly"=>false,

																"SpecialsOnly"=>false,

																"RegularRateOnly"=>false,

																"ProfileId"=>""))));


				$record_per_page=20;

				$RetCd=$response->CourseAvailResult->RetCd;

				if($RetCd==0)

				{

					$course_arr=$response->CourseAvailResult->Courses->caCourse;

					$altime=array();

					$tim=array();


					   if(isset($course_arr->Dates->alDate->Times->alTime))

					   {

						   $row=$course_arr->Dates->alDate->Times->alTime;

						  for($i=0;$i< count($row);$i++)

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

						  

							//after all check remaining data save in $tim

							$tim[]=$row[$i];

						  }

						  

						   if(count($tim)==1)

						   {

						      $altime[]=$tim;

						   }

						   if(count($tim)>1)

						   {

							    //for pagination 

							    $last_record=$page_start_from+$record_per_page;

							    for($j=$page_start_from;$j<$last_record;$j++)

							    {

								  if($j< count($tim))

								  $altime[]=$tim[$j];

							    }

							    //end for pagination

							    

								$mypaging['total_rows']=count($tim);

								$mypaging['base_url']=base_url()."search_golfcourse/ajax_pagi_link/";

								$mypaging['per_page']=$record_per_page;

								$mypaging['uri_segment']=3;

								$this->pagination->initialize($mypaging);

								$paginglink=$this->pagination->ajax_create_links();

								echo $paginglink;

						   }

					   }

				 }

				 else

				 {

					 $course_arr='';

					 $altime='';

				 }


	}

	function search_teetimes()
	{
		   $my_submit=$this->input->post('my_submit');
		   if($my_submit=='TRUE')
		   {
				$country_id=$this->input->post('country_id');
				$state_id=$this->input->post('state_id');
				$area_id=$this->input->post('area_id');
				$course_id=$this->input->post('course_id');
				
				if($state_id=='')
				{
					$country_id='USA';
					$state_id='AZ';
					$area_id='Payson';
					$course_id='';
				}

				//save in session
				$this->session->set_userdata('country_id',$country_id);
				$this->session->set_userdata('state_id',$state_id);
				$this->session->set_userdata('area_id',$area_id);
				$this->session->set_userdata('course_id',$course_id);				

				$date=$this->input->post('datepicker');
				if($date=='')
				$din=time();
				else
				$din=strtotime($date);

				//save in session
				$this->session->set_userdata('fin_date',$din);		
				$times=$this->input->post('times');
				//save in session
				$this->session->set_userdata('times',$times);				

				$players=$this->input->post('players');
				//save in session
				$this->session->set_userdata('players',$players);
				$fin_date=date('Y-m-d',$din);
			}
			else
			{
				$country_id=$this->session->userdata('country_id');
				$state_id=$this->session->userdata('state_id');
				$area_id=$this->session->userdata('area_id');
				$course_id=$this->session->userdata('course_id');
				
				$fin_date=$this->session->userdata('fin_date');
				$fin_date=date('Y-m-d',$fin_date);
				

				$times=$this->session->userdata('times');
				$players=$this->session->userdata('players');
			}
			

			if($course_id!='')
			{
				$client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");
				$response = $client->CourseAvail(array("Hdr"=>array("ResellerId"=>"WPA",
																"PartnerId"=>"",
																"SourceCd"=>"A",
																"Lang"=>"en",
																"UserIp"=>"127.0.0.1",
																"UserSessionId"=>"",
																"AccessKey"=>"",
																"Agent"=>"",
																"gsSource"=>"",
																"gsDebug"=>true),
													"Req"=>array("CourseAvailRequest"=>
														   array("CourseId"=>$course_id,
																"PlayBegDate"=>$fin_date."T00:00:00",
																"PlayEndDate"=>$fin_date."T00:00:00",
																"Time"=>$times,
																"Players"=>$players,
																"AltRateType"=>"",
																"PromoCode"=>"",
																"ShowAllTimes"=>true,
																"BarterOnly"=>false,
																"ChargingOnly"=>false,
																"SpecialsOnly"=>false,
																"RegularRateOnly"=>false,
																"ProfileId"=>""))));		
				$response = $this->getCourseAvail($fin_date,$course_id, $times);
  				//echo "<br><br>response11: <pre>"; print_r($response); echo "</pre>";
				$RetCd=$response->CourseAvailResult->RetCd;
				if($RetCd==0)
				{
					$course_arr=$response->CourseAvailResult->Courses->caCourse;
					$altime=array();
					$tim=array();
					   if(isset($course_arr->Dates->alDate->Times->alTime))
					   {
						   $tim=$course_arr->Dates->alDate->Times->alTime; 

						   if(count($tim)==1)
						   {
						      $altime[]=$tim;
						   		//$altime=$tim;//fix
						   }
						   if(count($tim)>1)
						   {
							   for($j=0;$j<count($tim);$j++)
							   {
								  $altime[]=$tim[$j];
							   }
						   }
					   }
				 }
				 else
				 {
					 $course_arr='';
					 $altime='';
				 }
					// print_r($response);

				// exit;
			

				$results['RetCd']=$RetCd;
				$results['course_arr']=$course_arr;
				$results['altime']=$altime;
				
				$results['course_id']=$course_id;
				$results['players']=$players;
				$results['fin_date']=$fin_date;
				$results['times']=$times;
				
				$results['sort']='times';
				$results['filter']='all_day';
				
				$data1['contents']=$this->load->view('specific_course_avail_listing',$results,true);
				$data1['my_title']='TeeTime';$this->load->view('template',$data1);
			}
			else
			{//if course id post value is empty
				$client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");
   				 $response = $client->CourseAvailList(array("Hdr"=>array("ResellerId"=>"WPA",
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
															"RegionId"=>$state_id,
															"Area"=>$area_id,
															"PlayBegDate"=>$fin_date."T00:00:00",
															"PlayEndDate"=>$fin_date."T00:00:00",
															"Time"=>$times,
															"Players"=>$players,
															"MaxDistance"=>"",
															"FeaturedOnly"=>false,
															"ShowAllTimes"=>true,
															"ShowIfNoTimes"=>true,
															"BarterOnly"=>false,
															"ChargingOnly"=>false,
															"SpecialsOnly"=>false,
															"RegularRateOnly"=>false,
															"ProfileId"=>"")));	
		
   				 //add
			    $course_ob = $this->getCourseAvailList($fin_date, $country_id, $state_id, $area_id);
				$response = $course_ob;
				//echo "<br><br>response: <pre>"; print_r($response); echo "</pre>";
				// End add
				$RetCd=$response->CourseAvailListResult->RetCd;
				if($RetCd==0)
				{
					$course_arr=$response->CourseAvailListResult->Courses->alCourse;				

					$altime=array();
					$tim=array();
					if(count($course_arr)==1)
					{
					   if(isset($course_arr->Dates->alDate->Times->alTime))
					   {
						   $tim=$course_arr->Dates->alDate->Times->alTime;
						   if(count($tim)==1)
						   {
						      //$altime[]=$tim;
						   		$altime=$tim; //fix
						   }
						   if(count($tim)>1)
						   {
							   for($j=0;$j< count($tim);$j++)
							   {
								  $altime[]=$tim[$j];
							   }
						   }
					   }
					}
					else if(count($course_arr)>1)
					{

						for($i=0;$i< count($course_arr);$i++)
						{
						   if(isset($course_arr[$i]->Dates->alDate->Times->alTime))
						   {
							   $tim=$course_arr[$i]->Dates->alDate->Times->alTime;
							   if(count($tim)==1)
							   {
								  $altime[]=$tim;
							   }
							   for($j=0;$j< count($tim);$j++)
							   {
								  $altime[]=$tim[$j];
							   }
							}
						 }		

					 }
				 }
				 else
				 {
					 $course_arr='';
					 $altime='';
				 }
				// print_r($response);
				// exit;
				 //print_r($altime);
					//print_r($course_arr);
					//exit;
				

				$results['RetCd']=$RetCd;
				$results['course_arr']=$course_arr;
				$results['altime']=$altime;
				

				$results['players']=$players;
				$results['fin_date']=$fin_date;
				$results['times']=$times;
				

				$results['sort']='times';
				$results['filter']='all_day';
				

				$data1['contents']=$this->load->view('all_course_avail_listing',$results,true);
				$data1['my_title']='TeeTime';$this->load->view('template',$data1);				

			}//end if course id post value is empty

			
	}//end function 

	//come from link of "search for teetime" exists in golf_course_listing

	function search_teetimes_two($course_id)

	{

		 $client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");

		 $response_course = $client->CourseInfo(array("Hdr"=>array("ResellerId"=>"WPA",

																"PartnerId"=>"",

																"SourceCd"=>"A",

																"Lang"=>"en",

																"UserIp"=>"66.147.244.227",

																"UserSessionId"=>"",

																"AccessKey"=>"",

																"Agent"=>"",

																"gsSource"=>"",

																"gsDebug"=>true),

												"Req"=>array("CourseId"=>$course_id,

															)));


			$country_id=$response_course->CourseInfoResult->Course->sCou;

			//save in session

			$this->session->set_userdata('country_id',$country_id);

			

			$state_id=$response_course->CourseInfoResult->Course->sReg;

			//save in session

			$this->session->set_userdata('state_id',$state_id);

			

			$area_id=$response_course->CourseInfoResult->Course->sAr;

			//save in session

			$this->session->set_userdata('area_id',$area_id);

			

			$course_id=$response_course->CourseInfoResult->Course->id;

			//save in session

			$this->session->set_userdata('course_id',$course_id);

			

			$date=$this->session->userdata('fin_date');

			if($date=='')

			$date=time();

			//save in session

		    $this->session->set_userdata('fin_date',$date);

			

			$times=$this->session->userdata('times');

			if($times=='')

			$times=600;

			//save in session

		    $this->session->set_userdata('times',$times);

			

			$players=$this->session->userdata('players');

			if($players=='')

			$players=2;

			//save in session

		    $this->session->set_userdata('players',$players);

					

		    $fin_date=date('Y-m-d',$date);
			

			$client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");

			$response = $client->CourseAvail(array("Hdr"=>array("ResellerId"=>"WPA",

																"PartnerId"=>"",

																"SourceCd"=>"A",

																"Lang"=>"en",

																"UserIp"=>"127.0.0.1",

																"UserSessionId"=>"",

																"AccessKey"=>"",

																"Agent"=>"",

																"gsSource"=>"",

																"gsDebug"=>true),

													"Req"=>array("CourseAvailRequest"=>

														   array("CourseId"=>$course_id,

																"PlayBegDate"=>$fin_date."T00:00:00",

																"PlayEndDate"=>$fin_date."T00:00:00",

																"Time"=>$times,

																"Players"=>$players,

																"AltRateType"=>"",

																"PromoCode"=>"",

																"ShowAllTimes"=>true,

																"BarterOnly"=>false,

																"ChargingOnly"=>false,

																"SpecialsOnly"=>false,

																"RegularRateOnly"=>false,

																"ProfileId"=>""))));

		
				$RetCd=$response->CourseAvailResult->RetCd;

				if($RetCd==0)

				{

					$course_arr=$response->CourseAvailResult->Courses->caCourse;

					$altime=array();

					$tim=array();

					

					   if(isset($course_arr->Dates->alDate->Times->alTime))

					   {

						   $tim=$course_arr->Dates->alDate->Times->alTime;

						   if(count($tim)==1)

						   {

						      $altime[]=$tim;

						   }

						   if(count($tim)>1)

						   {

							   for($j=0;$j<count($tim);$j++)

							   {

								  $altime[]=$tim[$j];

							   }

						   }

					   }

				 }

				 else

				 {

					 $course_arr='';

					 $altime='';

				 }

					

				$results['RetCd']=$RetCd;

				$results['course_arr']=$course_arr;

				$results['altime']=$altime;

				

				$results['course_id']=$course_id;

				$results['players']=$players;

				$results['fin_date']=$fin_date;

				$results['times']=$times;

				

				$results['sort']='times';

				$results['filter']='all_day';

				

				$data1['contents']=$this->load->view('specific_course_avail_listing',$results,true);

				$data1['my_title']='TeeTime';

				$this->load->view('template',$data1);


	}

	function price_filter()

	{

		$price_filtration=$this->input->post('price_filtration');

		$hid_filter=$this->input->post('hid_filter');

		

		if($hid_filter=='TRUE')

		{

			if(!empty($price_filtration))

			{

				$this->session->set_userdata('price_filtration',$price_filtration);

				$this->session->set_userdata('hid_filter',$hid_filter);

			}

			else

			{

				$this->session->unset_userdata('price_filtration');

				$this->session->unset_userdata('hid_filter');

			}

		}

		

		redirect($_SERVER['HTTP_REFERER']);

	}


	/*function silter_session_destory()

	{

		$this->session->set_userdata('price_filtration','');

		$this->session->set_userdata('hid_filter','');

		$url=$_SERVER['HTTP_REFERER'];

		redirect($url);

	}*/

	function time_filter()

	{

	    $time_filtration=$this->input->post('time_filtration');

		$hid_time_filter=$this->input->post('hid_time_filter');


		if($hid_time_filter=='TRUE')

		{

			if(!empty($time_filtration))

			{

				$this->session->set_userdata('time_filtration',$time_filtration);

				$this->session->set_userdata('hid_time_filter',$hid_time_filter);

			}

			else

			{

				$this->session->unset_userdata('time_filtration');

				$this->session->unset_userdata('hid_time_filter');

			}

		}

		redirect($_SERVER['HTTP_REFERER']);

	}

	function sorting($sort,$filter,$course_id,$players,$fin_date,$times)

	{

		  

		  $fin_date=date('Y-m-d',$fin_date);

		  

		  if($this->session->userdata('course_id')!='')

		  {

		  $client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");

		  $response = $client->CourseAvail(array("Hdr"=>array("ResellerId"=>"WPA",

																"PartnerId"=>"",

																"SourceCd"=>"A",

																"Lang"=>"en",

																"UserIp"=>"127.0.0.1",

																"UserSessionId"=>"",

																"AccessKey"=>"",

																"Agent"=>"",

																"gsSource"=>"",

																"gsDebug"=>true),

													"Req"=>array("CourseAvailRequest"=>

														   array("CourseId"=>$course_id,

																"PlayBegDate"=>$fin_date."T00:00:00",

																"PlayEndDate"=>$fin_date."T00:00:00",

																"Time"=>$times,

																"Players"=>$players,

																"AltRateType"=>"",

																"PromoCode"=>"",

																"ShowAllTimes"=>true,

																"BarterOnly"=>false,

																"ChargingOnly"=>false,

																"SpecialsOnly"=>false,

																"RegularRateOnly"=>false,

																"ProfileId"=>""))));

		

			   $RetCd=$response->CourseAvailResult->RetCd;

				if($RetCd==0)

				{

					$course_arr=$response->CourseAvailResult->Courses->caCourse;

					$altime=array();

					$tim=array();

					

					   if(isset($course_arr->Dates->alDate->Times->alTime))

					   {

						   $tim=$course_arr->Dates->alDate->Times->alTime;

						   if(count($tim)==1)

						   {

						      $altime[]=$tim;

						   }

						   if(count($tim)>1)

						   {

							   for($j=0;$j< count($tim);$j++)

							   {

								  $altime[]=$tim[$j];

							   }

						   }

					   }

				 }

				 else

				 {

					 $course_arr='';

					 $altime='';

				 }

					

				$results['RetCd']=$RetCd;

				$results['course_arr']=$course_arr;

				$results['altime']=$altime;

				

				$results['course_id']=$course_id;

				$results['players']=$players;

				$results['fin_date']=$fin_date;

				$results['times']=$times;

				

				$results['sort']=$sort;

				$results['filter']=$filter;

				

				$data1['contents']=$this->load->view('specific_course_avail_listing',$results,true);

				$data1['my_title']='TeeTime';$this->load->view('template',$data1);

			   

				/*if($sort=='price'){

				$data1['contents']=$this->load->view('specific_course_pric_avail_listing',$results,true);

				}

				if($sort=='course'){

				$data1['contents']=$this->load->view('specific_course_pric_avail_listing',$results,true);

				}

				if($sort=='times'){

				$data1['contents']=$this->load->view('specific_course_avail_listing',$results,true);

				}*/

				

		}

		else

		{

		

			$country_id=$this->session->userdata('country_id');

			$state_id=$this->session->userdata('state_id');

			$area_id=$this->session->userdata('area_id');

			$client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");

		$response = $client->CourseAvailList(array("Hdr"=>array("ResellerId"=>"WPA",

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

																"RegionId"=>$state_id,

																"Area"=>$area_id,

																"PlayBegDate"=>$fin_date."T00:00:00",

																"PlayEndDate"=>$fin_date."T00:00:00",

																"Time"=>$times,

																"Players"=>$players,

																"MaxDistance"=>"",

																"FeaturedOnly"=>false,

																"ShowAllTimes"=>true,

																"ShowIfNoTimes"=>true,

																"BarterOnly"=>false,

																"ChargingOnly"=>false,

																"SpecialsOnly"=>false,

																"RegularRateOnly"=>false,

																"ProfileId"=>"")));	

		  

		  

					$RetCd=$response->CourseAvailListResult->RetCd;

					if($RetCd==0)

					{

						$course_arr=$response->CourseAvailListResult->Courses->alCourse;

						$altime=array();

						$tim=array();

						if(count($course_arr)==1)

						{

						   if(isset($course_arr->Dates->alDate->Times->alTime))

						   {

							   $tim=$course_arr->Dates->alDate->Times->alTime;

							   if(count($tim)==1)

						       {

						           $altime[]=$tim;

						       }

							   if(count($tim)>1)

							   {

								   for($j=0;$j<count($tim);$j++)

								   {

									  $altime[]=$tim[$j];

								   }

							   }

						   }

						}

						else if(count($course_arr)>1)

						{

							for($i=0;$i<count($course_arr);$i++)

							{

							   if(isset($course_arr[$i]->Dates->alDate->Times->alTime))

							   {

								   $tim=$course_arr[$i]->Dates->alDate->Times->alTime;

								   if(count($tim)==1)

								   {

									  $altime[]=$tim;

								   }

								   for($j=0;$j<count($tim);$j++)

								   {

									  $altime[]=$tim[$j];

								   }

								}

							 }

						 }

					 }

					 else

					 {

						$course_arr='';

						$altime='';

					 }

					

					$results['RetCd']=$RetCd;

					$results['course_arr']=$course_arr;

					$results['altime']=$altime;

					

					$results['players']=$players;

					$results['fin_date']=$fin_date;

					$results['times']=$times;

					

					$results['sort']=$sort;

			        $results['filter']=$filter;

					

					$data1['contents']=$this->load->view('all_course_avail_listing',$results,true);

					$data1['my_title']='TeeTime';$this->load->view('template',$data1);     
		

		}		

	}
	
	function pagination($sort,$filter,$course_id,$players,$last_date,$times)

	{   

	    $this->session->set_userdata('fin_date',$last_date);

		$fin_date=date('Y-m-d',$last_date);

		if($this->session->userdata('course_id')!='')

		{
		   $client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");

		   $response = $client->CourseAvail(array("Hdr"=>array("ResellerId"=>"WPA",

																	"PartnerId"=>"",

																	"SourceCd"=>"A",

																	"Lang"=>"en",

																	"UserIp"=>"127.0.0.1",

																	"UserSessionId"=>"",

																	"AccessKey"=>"",

																	"Agent"=>"",

																	"gsSource"=>"",

																	"gsDebug"=>true),

														"Req"=>array("CourseAvailRequest"=>

															  array("CourseId"=>$course_id,

																	"PlayBegDate"=>$fin_date."T00:00:00",

																	"PlayEndDate"=>$fin_date."T00:00:00",

																	"Time"=>$times,

																	"Players"=>$players,

																	"AltRateType"=>"",

																	"PromoCode"=>"",

																	"ShowAllTimes"=>true,

																	"BarterOnly"=>false,

																	"ChargingOnly"=>false,

																	"SpecialsOnly"=>false,

																	"RegularRateOnly"=>false,

																	"ProfileId"=>""))));
				$RetCd=$response->CourseAvailResult->RetCd;

				if($RetCd==0)

				{

					$course_arr=$response->CourseAvailResult->Courses->caCourse;

					$altime=array();

					$tim=array();

					

					   if(isset($course_arr->Dates->alDate->Times->alTime))

					   {

						   $tim=$course_arr->Dates->alDate->Times->alTime;

						   if(count($tim)==1)

						   {

						      $altime[]=$tim;

						   }

						   if(count($tim)>1)

						   {

							   for($j=0;$j<count($tim);$j++)

							   {

								  $altime[]=$tim[$j];

							   }

						   }

					   }

				 }

				 else

				 {

					 $course_arr='';

					 $altime='';

				 }

					

				$results['RetCd']=$RetCd;

				$results['course_arr']=$course_arr;

				$results['altime']=$altime;

				

				$results['course_id']=$course_id;

				$results['players']=$players;

				$results['fin_date']=$fin_date;

				$results['times']=$times;

				

				$results['sort']=$sort;

				$results['filter']=$filter;

				

				$data1['contents']=$this->load->view('specific_course_avail_listing',$results,true);

				$data1['my_title']='TeeTime';$this->load->view('template',$data1);


					/*if($sort=='price'){

					$data1['contents']=$this->load->view('specific_course_pric_avail_listing',$results,true);

					}

					if($sort=='course'){

					$data1['contents']=$this->load->view('specific_course_pric_avail_listing',$results,true);

					}

					if($sort=='times'){

					$data1['contents']=$this->load->view('specific_course_avail_listing',$results,true);

					}

					$data1['my_title']='TeeTime';$this->load->view('template',$data1);*/

			}

			else

			{

			

				$country_id=$this->session->userdata('country_id');

				$state_id=$this->session->userdata('state_id');

				$area_id=$this->session->userdata('area_id');

				$client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");

	    		$response = $client->CourseAvailList(array("Hdr"=>array("ResellerId"=>"WPA",

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

															"RegionId"=>$state_id,

															"Area"=>$area_id,

															"PlayBegDate"=>$fin_date."T00:00:00",

															"PlayEndDate"=>$fin_date."T00:00:00",

															"Time"=>$times,

															"Players"=>$players,

															"MaxDistance"=>"",

															"FeaturedOnly"=>false,

															"ShowAllTimes"=>true,

															"ShowIfNoTimes"=>true,

															"BarterOnly"=>false,

															"ChargingOnly"=>false,

															"SpecialsOnly"=>false,

															"RegularRateOnly"=>false,

															"ProfileId"=>"")));	

    			//add
			    $course_ob = $this->getCourseAvailList($fin_date, $country_id, $state_id, $area_id);
				$response = $course_ob;
				// End add
			    $RetCd=$response->CourseAvailListResult->RetCd;

				if($RetCd==0)

				{

					$course_arr=$response->CourseAvailListResult->Courses->alCourse;

					$altime=array();

					$tim=array();

					if(count($course_arr)==1)

					{

					   if(isset($course_arr->Dates->alDate->Times->alTime))

					   {

						   $tim=$course_arr->Dates->alDate->Times->alTime;

						   if(count($tim)==1)

						   {

							   //$altime[]=$tim;
							   $altime=$tim;//fix

						   }

						   if(count($tim)>1)

						   {

							   for($j=0;$j<count($tim);$j++)

							   {

								  $altime[]=$tim[$j];

							   }

						   }

					   }

					}

					else if(count($course_arr)>1)

					{

						for($i=0;$i<count($course_arr);$i++)

						{

						   if(isset($course_arr[$i]->Dates->alDate->Times->alTime))

						   {

							   $tim=$course_arr[$i]->Dates->alDate->Times->alTime;

							   if(count($tim)==1)

							   {

								  $altime[]=$tim;

							   }

							   for($j=0;$j<count($tim);$j++)

							   {

								  $altime[]=$tim[$j];

							   }

							}

						 }

					 }

				}

				 else

				 {

				   $course_arr='';

				   $altime='';

				 }

				

				

				$results['RetCd']=$RetCd;

				$results['course_arr']=$course_arr;

				$results['altime']=$altime;

				

				$results['players']=$players;

				$results['fin_date']=$fin_date;

				$results['times']=$times;

				

				$results['sort']='times';

				$results['filter']='all_day';

				

				$data1['contents']=$this->load->view('all_course_avail_listing',$results,true);

				$data1['my_title']='TeeTime';$this->load->view('template',$data1);

				//print_r($maga_record);

				//exit;	

			}	

	  }

	  function ajax_pagination($state_name,$sort,$filter,$course_id,$players,$times,$fin_date)
	  {
	  	#echo "state_name: ".$state_name." - fin_date: ".$fin_date." - course_id: ".$course_id." - times:".$times. " - sort:".$sort." - filter: ".$filter. " - players: ".$players;
		$fin_date=date('Y-m-d',$fin_date);		

		if($this->session->userdata('course_id')!=''){ //echo "Hello";
			$client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");
			$response = $client->CourseAvail(array("Hdr"=>array("ResellerId"=>"WPA",
																"PartnerId"=>"",
																"SourceCd"=>"A",
																"Lang"=>"en",
																"UserIp"=>"127.0.0.1",
																"UserSessionId"=>"",
																"AccessKey"=>"",
																"Agent"=>"",
																"gsSource"=>"",
																"gsDebug"=>true),
													"Req"=>array("CourseAvailRequest"=>
														   array("CourseId"=>$course_id,

																"PlayBegDate"=>$fin_date."T00:00:00",

																"PlayEndDate"=>$fin_date."T00:00:00",

																"Time"=>$times,

																"Players"=>$players,

																"AltRateType"=>"",

																"PromoCode"=>"",

																"ShowAllTimes"=>true,

																"BarterOnly"=>false,

																"ChargingOnly"=>false,

																"SpecialsOnly"=>false,

																"RegularRateOnly"=>false,

																"ProfileId"=>""))));

						
				$response = $this->getCourseAvail($fin_date,$course_id, $times);
				
				$RetCd=$response->CourseAvailResult->RetCd;

				if($RetCd==0)

				{

					$course_arr=$response->CourseAvailResult->Courses->caCourse;

					$altime=array();

					$tim=array();

					

					   if(isset($course_arr->Dates->alDate->Times->alTime))

					   {

						   $tim=$course_arr->Dates->alDate->Times->alTime;

						   if(count($tim)==1)

						   {

						      //$altime[]=$tim;
						   		$altime=$tim;//fix

						   }

						   if(count($tim)>1)

						   {

							   for($j=0;$j<count($tim);$j++)

							   {

								  $altime[]=$tim[$j];

							   }

						   }

					   }

				 }

				 else

				 {

					 $course_arr='';

					 $altime='';

				 }

					

				$results['RetCd']=$RetCd;

				$results['course_arr']=$course_arr;

				$results['altime']=$altime;

				$results['state_name']=$state_name;

				

				$results['course_id']=$course_id;

				$results['players']=$players;

				$results['fin_date']=$fin_date;

				$results['times']=$times;

				

				$results['sort']=$sort;

				$results['filter']=$filter;
//echo "<pre>"; print_r($results); echo "</pre>";
				$this->load->view('ajax_course_avail_listing',$results,'');

				

				/*if($sort=='price'){

				    $this->load->view('ajax_course_pric_avail_listing',$results,'');

				}

				if($sort=='course'){

				    $this->load->view('ajax_course_pric_avail_listing',$results,'');

				}

				if($sort=='times'){

				    $this->load->view('ajax_course_avail_listing',$results,'');

				}*/

				

		}

			

		else

		{

			

			

			$country_id=$this->session->userdata('country_id');

			$state_id=$this->session->userdata('state_id');

			$area_id=$this->session->userdata('area_id');

			

			$client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");

   			 $response = $client->CourseAvailList(array("Hdr"=>array("ResellerId"=>"WPA",

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

															"RegionId"=>$state_id,

															"Area"=>$area_id,

															"PlayBegDate"=>$fin_date."T00:00:00",

															"PlayEndDate"=>$fin_date."T00:00:00",

															"Time"=>$times,

															"Players"=>$players,

															"MaxDistance"=>"",

															"FeaturedOnly"=>false,

															"ShowAllTimes"=>true,

															"ShowIfNoTimes"=>true,

															"BarterOnly"=>false,

															"ChargingOnly"=>false,

															"SpecialsOnly"=>false,

															"RegularRateOnly"=>false,

															"ProfileId"=>"")));	

			

				//add
			    $course_ob = $this->getCourseAvailList($fin_date, $country_id, $state_id, $area_id);
				// echo "<pre>";
				// print_r($course_ob);
				// echo "</pre>";
				$response = $course_ob;
				// End add

			    $RetCd=$response->CourseAvailListResult->RetCd;
			    
				if($RetCd==0)

				{

					$course_arr=$response->CourseAvailListResult->Courses->alCourse;

					$altime=array();

					$tim=array();

					if(count($course_arr)==1)

					{

					   if(isset($course_arr->Dates->alDate->Times->alTime))

					   {

						   $tim=$course_arr->Dates->alDate->Times->alTime;

						   if(count($tim)==1)

						   {

							   //$altime[]=$tim;
						   		$altime=$tim; //fix

						   }

						   if(count($tim)>1)

						   {

							   for($j=0;$j<count($tim);$j++)

							   {

								  $altime[]=$tim[$j];

							   }

						   }

					   }

					}

					else if(count($course_arr)>1)
					{
						for($i=0;$i<count($course_arr);$i++)
						{
						   if(isset($course_arr[$i]->Dates->alDate->Times->alTime))
						   {
							   $tim=$course_arr[$i]->Dates->alDate->Times->alTime;
							   if(count($tim)==1)
							   {
								  $altime[]=$tim;
							   }
							   for($j=0;$j<count($tim);$j++)
							   {
								  $altime[]=$tim[$j];
							   }
							}
						 }
					 }
				}
				 else
				 {
				   $course_arr='';
				   $altime='';
				}			

				

				$results['RetCd']=$RetCd;
				$results['course_arr']=$course_arr;
				$results['altime']=$altime;
				$results['state_name']=$state_name;
				

				$results['players']=$players;
				$results['fin_date']=$fin_date;
				$results['times']=$times;
				

				$results['sort']=$sort;
				$results['filter']=$filter;			

				$data1['contents']=$this->load->view('ajax_allcourse_avail_listing',$results,'');			

		/*	$client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");

			$response = $client->CourseList(array("Hdr"=>array("ResellerId"=>"WPA",

															"PartnerId"=>"",

															"SourceCd"=>"A","Lang"=>"en",

															"UserIp"=>"66.147.244.227",

															"UserSessionId"=>"",

															"AccessKey"=>"",

															"Agent"=>"",

															"gsSource"=>"",

															"gsDebug"=>true),

												"Req"=>array("CountryId"=>$country_id,

															 "RegionId"=>$state_id,

															 "Area"=>$area_id,

															 "Latitude"=>"",

															 "Longitude"=>"",

															 "PostalCode"=>"",

															 "MaxDistance"=>"",

															 "MaxDistanceType"=>"",

															 "ShowAllStatus"=>"active",

															 "ShowDisConnected"=>"",

															 "FeaturedOnly"=>"",

															 "Sort"=>"")));

	

			  $all_clcourse=$response->CourseListResult->Courses->clCourse;

			  $total=count($all_clcourse);

			  

			  $altime=array();

			  if($total==1)

			  {//if record is single

			     $course_id=$all_clcourse->id;

				 $client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");

				 $response = $client->CourseAvail(array("Hdr"=>array("ResellerId"=>"WPA",

																		"PartnerId"=>"",

																		"SourceCd"=>"A",

																		"Lang"=>"en",

																		"UserIp"=>"127.0.0.1",

																		"UserSessionId"=>"",

																		"AccessKey"=>"",

																		"Agent"=>"",

																		"gsSource"=>"",

																		"gsDebug"=>true),

															"Req"=>array("CourseAvailRequest"=>

																   array("CourseId"=>$course_id,

																		"PlayBegDate"=>$fin_date."T00:00:00",

																		"PlayEndDate"=>$fin_date."T00:00:00",

																		"Time"=>$times,

																		"Players"=>$players,

																		"AltRateType"=>"",

																		"PromoCode"=>"",

																		"ShowAllTimes"=>true,

																		"BarterOnly"=>false,

																		"ChargingOnly"=>false,

																		"SpecialsOnly"=>false,

																		"RegularRateOnly"=>false,

																		"ProfileId"=>""))));

				

						$course_arr=$response->CourseAvailResult->Courses->caCourse;

						//all record are saved in this array

						$all_courses_record[]=$course_arr;

						//only all times record are saved in this array

						if(isset($course_arr->Dates->alDate->Times->alTime))

						$altime[]=$course_arr->Dates->alDate->Times->alTime;

			  }//end if record is single

			  else

			  {//if record is more than single

				  if($total>5)

				  $total=5;

				  for($i=0;$i<$total;$i++)

				  {//for loop

					 $course_id=$all_clcourse[$i]->id;

					 

					 $client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");

					 $response = $client->CourseAvail(array("Hdr"=>array("ResellerId"=>"WPA",

																			"PartnerId"=>"",

																			"SourceCd"=>"A",

																			"Lang"=>"en",

																			"UserIp"=>"127.0.0.1",

																			"UserSessionId"=>"",

																			"AccessKey"=>"",

																			"Agent"=>"",

																			"gsSource"=>"",

																			"gsDebug"=>true),

																"Req"=>array("CourseAvailRequest"=>

																	   array("CourseId"=>$course_id,

																			"PlayBegDate"=>$fin_date."T00:00:00",

																			"PlayEndDate"=>$fin_date."T00:00:00",

																			"Time"=>$times,

																			"Players"=>$players,

																			"AltRateType"=>"",

																			"PromoCode"=>"",

																			"ShowAllTimes"=>true,

																			"BarterOnly"=>false,

																			"ChargingOnly"=>false,

																			"SpecialsOnly"=>false,

																			"RegularRateOnly"=>false,

																			"ProfileId"=>""))));

					

							$course_arr=$response->CourseAvailResult->Courses->caCourse;

							//all record are saved in this array

							$all_courses_record[]=$course_arr;

							

							//only all times record are saved in this array

							if(isset($course_arr->Dates->alDate->Times->alTime))

							$altime[]=$course_arr->Dates->alDate->Times->alTime;

			  }//end for loop

		   }//end if record is more than single*/

				

					

				/*$results['course_arr']=$all_courses_record;

				$results['altime']=$altime;

			

				$results['players']=$players;

				$results['fin_date']=$fin_date;

				$results['times']=$times;

				

				$results['sort']=$sort;

				$results['filter']=$filter;

				

				$this->load->view('ajax_allcourse_avail_listing',$results,'');*/				

	}	

  }

	function getCourseAvailList($fin_date, $country_id, $state_id, $area_id, $beginTimes='', $endTimes=''){//add function
		/*$country_id=$this->session->userdata('country_id');
		$state_id=$this->session->userdata('state_id');
		$area_id=$this->session->userdata('area_id');*/
		//echo "country_id: ".$country_id." - state_id: ".$state_id. "- area_id". $area_id;

		//add
		$where_course = '';
		if(!empty($country_id)) $where_course = " where sCou='".$country_id."'";
		if(!empty($state_id)){
			if(empty($where_course)) $where_course = " where sReg='".$state_id."'";
			else $where_course .= " and sReg='".$state_id."'";

		} 
		if(!empty($area_id)){
			if(empty($where_course)) $where_course = " where sAr='".$area_id."'";
			else $where_course .= " and sAr='".$area_id."'";
		} 

		//echo "where_course: ".$where_course;
		$courselist = $this->db->query("select * from CourseAvailList".$where_course);
		$courselist = $courselist->result();
		$allCourse = array();
		$i = 0;
		#echo "<br> select * from CourseAvailList".$where_course;
		#echo "<br><br>courselist: <pre>"; print_r($courselist); echo "</pre><br>";
		foreach ($courselist as $key => $course) {
			$dates = $this->db->query("select * from CoursesDates where course_id=".$course->id." and dates like '".$fin_date."%'");//

			$dates = $dates->result();			
			if(isset($dates[0])){
				$date = $dates[0];
				//foreach ($dates as $key_dt => $date) {
				if($beginTimes!='' && $endTimes!=''){
					$times_ = $this->db->query("select * from CoursesTimes where dates_id=".$date->id." AND `tm`>= '0707' AND `tm`<= '1107' ORDER BY `CoursesTimes`.`tm` ASC");	# Sua o day			
				}elseif($beginTimes!='' && $endTimes==''){
					$times_ = $this->db->query("select * from CoursesTimes where dates_id=".$date->id." AND `tm`>= '".$beginTimes."' ORDER BY `CoursesTimes`.`tm` ASC");	# Sua o day			
				}else{
					$times_ = $this->db->query("select * from CoursesTimes where dates_id=".$date->id);	# Sua o day			
				}

					$times_ = $times_->result();
					$allTimes = array();
					foreach ($times_ as $key_tm => $time) {
						$allTimes[$key_tm] = $time;
					}
					if(count($allTimes) == 1) $allTimes = $allTimes[0];
					$Times = array('alTime' => $allTimes);

					$Times = (object)$Times;
					$dt = $date->dates;
				//}
					$allDates = array('dt'=>$dt, 'Times'=>$Times);
					$allDates = (object)$allDates;
					$Dates = array('alDate'=>$allDates);
					$Dates = (object)$Dates;
					$course->Dates = $Dates;
					$allCourse[$i] = $course;
					$i++;
			}			
		}
		
		if(count($allCourse) == 1) $allCourse = $allCourse[0];
		$Courses = array('alCourse' => $allCourse);
		$Courses = (object)$Courses;

		$RetCd=0;
		$imgBase ='//devxml.golfswitch.com/img/course';
		$course_ = array('RetCd'=>$RetCd, 'RetMsg'=>'','imgBase'=>$imgBase, 'Courses'=>$Courses);
		$course_ = (object)$course_;
		$course_1['CourseAvailListResult'] = $course_;
		$course_ob = (object)$course_1;

		#echo "<br> select * from CoursesDates where course_id=".$course->id." and dates like '".$fin_date."%'";
		#echo "<br><br>Courses: <pre>"; print_r($allCourse); echo "</pre>";
		return $course_ob;
	}	

	function getCourseList($country_id, $state_id, $area_id){//add function		
		//add
		$where_course = '';
		if(!empty($country_id)) $where_course = " where sCou='".$country_id."'";
		if(!empty($state_id)){
			if(empty($where_course)) $where_course = " where sReg='".$state_id."'";
			else $where_course .= " and sReg='".$state_id."'";

		} 
		if(!empty($area_id)){
			if(empty($where_course)) $where_course = " where sAr='".$area_id."'";
			else $where_course .= " and sAr='".$area_id."'";
		} 

		
		$courselist = $this->db->query("select * from CourseAvailList".$where_course);
		$courselist = $courselist->result();
		$clCourse = array();
		
		foreach ($courselist as $key => $course) {					
			$clCourse[$key] = $course;	
			
		}
		
		if(count($clCourse) == 1) $clCourse = $clCourse[0];
		$Courses = array('clCourse' => $clCourse);
		$Courses = (object)$Courses;

		$RetCd=0;
		$imgBase ='//devxml.golfswitch.com/img/course';
		$course_ = array('RetCd'=>$RetCd, 'RetMsg'=>'','imgBase'=>$imgBase, 'Courses'=>$Courses);
		$course_ = (object)$course_;
		$course_1['CourseListResult'] = $course_;
		$course_ob = (object)$course_1;
		
		return $course_ob;
	}

	function getCourseAvail($fin_date, $course_id, $time){//add function		
		//echo "country_id: ".$country_id." - state_id: ".$state_id. "- area_id". $area_id;
		//add		
		$where_course = " where id='".$course_id."'";
		$where_time = '';
		if($time != '')
			$where_time = " and tm >= '".$time."'";

		
		$course = $this->db->query("select * from CourseAvailList".$where_course);

		$course = $course->result();
		$caCourse = array();		
		
		$dates = $this->db->query("select * from CoursesDates where course_id=".$course_id." and dates like '".$fin_date."%'");//
		$dates = $dates->result();	
		
		if(isset($course[0])){
			$course = $course[0];
			if(isset($dates[0])){
				$date = $dates[0];
				
				$times_ = $this->db->query("select * from CoursesTimes where dates_id=".$date->id.$where_time);	

				$times_ = $times_->result();
					
				$allTimes = array();
				foreach ($times_ as $key_tm => $time) {
					$allTimes[$key_tm] = $time;
				}
				if(count($allTimes) == 1) $allTimes = $allTimes[0];
				$Times = array('alTime' => $allTimes);

				$Times = (object)$Times;
				$dt = $date->dates;
			
				$allDates = array('dt'=>$dt, 'Times'=>$Times);
				$allDates = (object)$allDates;
				$Dates = array('alDate'=>$allDates);
				$Dates = (object)$Dates;					
				$course->Dates = $Dates;
				$caCourse = $course;
			}
		}		
				
		
		
		$Courses = array('caCourse' => $caCourse);
		$Courses = (object)$Courses;

		$RetCd=0;
		$imgBase ='//devxml.golfswitch.com/img/course';
		$course_ = array('RetCd'=>$RetCd, 'RetMsg'=>'','imgBase'=>$imgBase, 'Courses'=>$Courses);
		$course_ = (object)$course_;
		$course_1['CourseAvailResult'] = $course_;
		$course_ob = (object)$course_1;

		//echo "<br> select * from CoursesDates where course_id=".$course->id." and dates like '".$fin_date."%'";
		//echo "<br><br>Courses: <pre>"; print_r($course_ob); echo "</pre>";
		return $course_ob;
	}

	function area_wise($area_id)
	{

		$course_id=$this->session->set_userdata('course_id','');

		$country_id=$this->session->userdata('country_id');

		$state_id=$this->session->userdata('state_id');

		

		$area_id= urldecode($area_id);

		if($area_id=='Napa')

		$area_id='Napa/Sonoma';

		

		if($area_id=='Castle Rock')

		$area_id='Castle Rock/Larkspur';

		

		if($area_id=='Ft. Myers')

		$area_id='Ft. Myers/Naples';

		

		if($area_id=='Miami ')

		$area_id='Miami / Ft. Lauderdale';

		

		if($area_id=='Panama City ')

		$area_id='Panama City / Pensacola';

		

		if($area_id=='Dallas')

		$area_id='Dallas/Ft. Worth';

		

		if($area_id=='Lake Ozark')

		$area_id='Lake Ozark/Springfield';

		

		$arr=explode(' ',$area_id);

		if(!empty($arr) && $arr[0]=='Hawaii')

		{

			$area_id='Hawaii (Big Island)';

		}

		

		

		//end check for Hawaii (Big Island) area case

		$this->session->set_userdata('area_id',$area_id);

		//$course_id=$this->session->userdata('course_id');

		

		$fin_date=$this->session->userdata('fin_date');

		if($fin_date=='')

		$fin_date=time();

		//save in session

		$this->session->set_userdata('fin_date',$fin_date);

		$fin_date=date('Y-m-d',$fin_date);

		

		$times=$this->session->userdata('times');

		if($times=='')

		$times='600';

		$players=$this->session->userdata('players');

		if($players=='')

		$players='1';

		

		 

		if($country_id=='' || $state_id=='')

		{

			$country_id='USA';

			$state_id='AZ';

			$f_date=date('Y-m-d',time());

			$times='0600';

			$players='1';

		

			$this->session->set_userdata('country_id',$country_id);

			$this->session->set_userdata('state_id',$state_id);

		    $this->session->set_userdata('fin_date',time());

			$this->session->set_userdata('times',$times);

			$this->session->set_userdata('players',$players);

		}

		 

			

	$client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");

    $response = $client->CourseAvailList(array("Hdr"=>array("ResellerId"=>"WPA",

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

															"RegionId"=>$state_id,

															"Area"=>$area_id,

															"PlayBegDate"=>$fin_date."T00:00:00",

															"PlayEndDate"=>$fin_date."T00:00:00",

															"Time"=>$times,

															"Players"=>$players,

															"MaxDistance"=>"",

															"FeaturedOnly"=>false,

															"ShowAllTimes"=>true,

															"ShowIfNoTimes"=>true,

															"BarterOnly"=>false,

															"ChargingOnly"=>false,

															"SpecialsOnly"=>false,

															"RegularRateOnly"=>false,

															"ProfileId"=>"")));	

			

				

				$RetCd=$response->CourseAvailListResult->RetCd;

				if($RetCd==0)

				{

					$course_arr=$response->CourseAvailListResult->Courses->alCourse;

					$altime=array();

					$tim=array();

					if(count($course_arr)==1)

					{

					   if(isset($course_arr->Dates->alDate->Times->alTime))

					   {

						   $tim=$course_arr->Dates->alDate->Times->alTime;

						   if(count($tim)==1)

						   {

						      $altime[]=$tim;

						   }

						   if(count($tim)>1)

						   {

							   for($j=0;$j<count($tim);$j++)

							   {

								  $altime[]=$tim[$j];

							   }

						   }

					   }

					}

					else if(count($course_arr)>1)

					{

						for($i=0;$i<count($course_arr);$i++)

						{

						   if(isset($course_arr[$i]->Dates->alDate->Times->alTime))

						   {

							   $tim=$course_arr[$i]->Dates->alDate->Times->alTime;

							   if(count($tim)==1)

							   {

								  $altime[]=$tim;

							   }

							   for($j=0;$j<count($tim);$j++)

							   {

								  $altime[]=$tim[$j];

							   }

							}

						 }

					 }

				 }

				 else

				 {

					 $course_arr='';

					 $altime='';

				 }

				

				$results['RetCd']=$RetCd;

				$results['course_arr']=$course_arr;

				$results['altime']=$altime;

				

				$results['players']=$players;

				$results['fin_date']=$fin_date;

				$results['times']=$times;

				

				$results['sort']='times';

				$results['filter']='all_day';

				

				//////for area wise///////

				$results['area_wise']	='yes';

				$results['area_val']	=$area_id;

				//////end for area wise////////

				////////left hand all area and city blue////////

				$results['left_area_city']	='not_selected';

				////////end left hand all area and city blue////

				

				$data1['contents']=$this->load->view('all_course_avail_listing',$results,true);

				$data1['my_title']='TeeTime';$this->load->view('template',$data1);

	

	}


	

	function city_wise($area_id,$city)

	{

		$this->session->set_userdata('course_id','');

		$country_id=$this->session->userdata('country_id');

		$state_id=$this->session->userdata('state_id');

		$area_id=urldecode($area_id);

		

		$area_id= urldecode($area_id);

		if($area_id=='Napa')

		$area_id='Napa/Sonoma';

		

		if($area_id=='Castle Rock')

		$area_id='Castle Rock/Larkspur';

		

		if($area_id=='Ft. Myers')

		$area_id='Ft. Myers/Naples';

		

		if($area_id=='Miami ')

		$area_id='Miami / Ft. Lauderdale';

		

		if($area_id=='Panama City ')

		$area_id='Panama City / Pensacola';

		

		if($area_id=='Dallas')

		$area_id='Dallas/Ft. Worth';

		

		if($area_id=='Lake Ozark')

		$area_id='Lake Ozark/Springfield';

		

		if($this->uri->segment(5)!='')

		$city=$this->uri->segment(5);

		

		$arr=explode(' ',$area_id);

		if(!empty($arr) && $arr[0]=='Hawaii')

		{

			$area_id='Hawaii (Big Island)';

		}

		

		$this->session->set_userdata('area_id',$area_id);

		//$course_id=$this->session->userdata('course_id');

		

		$fin_date=$this->session->userdata('fin_date');

		if($fin_date=='')

		$fin_date=time();

		//save in session

		$this->session->set_userdata('fin_date',$fin_date);

		$f_date=date('Y-m-d',$fin_date);

		

		$times=$this->session->userdata('times');

		if($times=='')

		$times='600';

		$players=$this->session->userdata('players');

		if($players=='')

		$players='1';

		

		

		if($country_id=='' || $state_id=='')

		{

			$country_id='USA';

			$state_id='AZ';

			$f_date=date('Y-m-d',time());

		

			$this->session->set_userdata('country_id',$country_id);

			$this->session->set_userdata('state_id',$state_id);

		    $this->session->set_userdata('fin_date',time());

		}

		

		

		

		

		$client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");

		$response = $client->CourseAvailList(array("Hdr"=>array("ResellerId"=>"WPA",

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

															"RegionId"=>$state_id,

															"Area"=>$area_id,

															"PlayBegDate"=>$f_date."T00:00:00",

															"PlayEndDate"=>$f_date."T00:00:00",

															"Time"=>$times,

															"Players"=>$players,

															"MaxDistance"=>"",

															"FeaturedOnly"=>false,

															"ShowAllTimes"=>true,

															"ShowIfNoTimes"=>true,

															"BarterOnly"=>false,

															"ChargingOnly"=>false,

															"SpecialsOnly"=>false,

															"RegularRateOnly"=>false,

															"ProfileId"=>"")));	

															

				$RetCd=$response->CourseAvailListResult->RetCd;

				if($RetCd==0)

				{

					$course_arr=$response->CourseAvailListResult->Courses->alCourse;

					$altime=array();

					$tim=array();

					if(count($course_arr)==1)

					{

					   if(isset($course_arr->Dates->alDate->Times->alTime))

					   {

						   $tim=$course_arr->Dates->alDate->Times->alTime;

						   if(count($tim)==1)

						   {

						      $altime[]=$tim;

						   }

						   if(count($tim)>1)

						   {

							   for($j=0;$j<count($tim);$j++)

							   {

								  $altime[]=$tim[$j];

							   }

						   }

					   }

					}

					else if( count($course_arr)>1)

					{

						for($i=0;$i< count($course_arr);$i++)

						{

						   if(isset($course_arr[$i]->Dates->alDate->Times->alTime))

						   {

							   $tim=$course_arr[$i]->Dates->alDate->Times->alTime;

							   if(count($tim)==1)

							   {

								  $altime[]=$tim;

							   }

							   for($j=0;$j< count($tim);$j++)

							   {

								  $altime[]=$tim[$j];

							   }

							}

						 }

					 }

				 }

				 else

				 {

					 $course_arr='';

					 $altime='';

				 }

				

				$results['RetCd']=$RetCd;

				$results['course_arr']=$course_arr;

				$results['altime']=$altime;

				

				$results['players']=$players;

				$results['fin_date']=$f_date;

				$results['times']=$times;

				

				$results['sort']='times';

				$results['filter']='all_day';

				

				//////for city wise///////

				$results['city_wise']	='yes';

				$city=urldecode($city);

				$results['city']	=$city;

				$results['area_id']	=$area_id;

				//////end for city wise////////

				////////left hand all area and city blue////////
				$results['left_area_city']	='not_selected';
				////////end left hand all area and city blue////
				

				$data1['contents']=$this->load->view('all_course_avail_listing',$results,true);
				$data1['my_title']='TeeTime';$this->load->view('template',$data1);	

	}
}