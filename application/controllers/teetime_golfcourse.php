<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



//CI_Controller

class Teetime_golfcourse extends  MY_Controller{



	

	/* public function index()

	{

		

		$results['title']='Golfhub';

		$temp['contents']=$this->load->view('teetime_search',$results,true);

		$this->load->view('template',$temp);

	}*/

	

	

	

	

	function golf_photo()

	{

	   $course_id=$this->input->post('course_id');

	

	?>

		<div class="pop">

  <div class="pop_rpt">

    <div class="container">

      <div class="wt-gallery">

        <div class="main-screen">

          <noscript>

          <!-- placeholder image when javascript is off --> 

          </noscript>

        </div>

        <div class="cpanel">

          <div class="thumbs-back"></div>

          <div class="thumbnails">

            <ul>

                

			  <?

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

					

				$result=$response->CourseInfoResult->Course;

			  

		if(isset($result->Imgs))

		{

			$images=$result->Imgs->img;

			for($j=0;$j<count($images);$j++)

			{

				echo '<li><div><a href="http://xml.golfswitch.com/img/course/'.$course_id.'/'.$images[$j].'"><img alt="#" width="125px" height="70px"    src="http://xml.golfswitch.com/img/course/'.$course_id.'/'.$images[$j].'"  width="300px" height="200px"></a></div>

				 <div class="data"><a href="http://codecanyon.net/user/webtako" target="_blank"></a> </div>

				</li>';

			}

		}

		else

		{

			echo '<img  width="200" height="150" alt="#" src="'.base_url().'asserts/images/no_image.jpeg">';

		}

			  

			  ?>

			  

             

              

            

			</ul>

          </div>

          <div class="thumbs-fwd"></div>

        </div>

      </div>

    </div>

  </div>

  <div class="pop_bottom">

    <div class="clr"></div>

  </div>

  <div class="clr"></div>

</div>

	<?	

	}

	

	

	

	

	

	function golf_course($page_start_from=0)

	{

		$country_id=$this->session->userdata('country_id');

		$state_id=$this->session->userdata('state_id');

		$area_id=$this->session->userdata('area_id');

		

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

		 

		$this->session->set_userdata('course_id',''); 

		 

		if($country_id=='' && $state_id=='' && $area_id=='')

		{

			$country_id='USA';

			$state_id='AZ';

			$f_date=date('Y-m-d',time());

		

			$this->session->set_userdata('country_id',$country_id);

			$this->session->set_userdata('state_id',$state_id);

		    $this->session->set_userdata('fin_date',time());

		}

		

		 

	    //first check

		//if($course_id==''){

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

				

				

				//check record is empty or not	

			  if($response->CourseAvailListResult->RetCd==0)

			  {	

					$filter_result=0;

					$single_record=count($response->CourseAvailListResult->Courses->alCourse);

					//if record is single

					if($single_record==1)

					{

						$results['result']=$response->CourseAvailListResult->Courses->alCourse;

						$results['imgpath']=$response->CourseAvailListResult->imgBase;

						//show on page pagination info...

						$results['first_no']=1;

						$results['last_no']=1;

						$results['total_no']=1;

						//end show on page pagination info...



					}

			   		else//if record are more than one

					{

						

					

					

					

					

					

					

					

					

					//////start new////

					$price_filtration=$this->session->userdata('price_filtration');

					$hid_filter=$this->session->userdata('hid_filter');

						

					if($price_filtration=='' && $hid_filter=='')

					{

					//////end new///////	

						

						

						$results['imgpath']=$response->CourseAvailListResult->imgBase;

						$record_per_page=20;

						$last_record=$page_start_from+$record_per_page;

						$j=count($response->CourseAvailListResult->Courses->alCourse);

						$result=array();

						//show on page pagination info...

						$results['first_no']=$page_start_from+1;

						$results['last_no']=$last_record;

						$results['total_no']=$j;

						//end show on page pagination info...

						for($i=$page_start_from;$i<$last_record;$i++)

						{

							if($i<$j)

							$result[]=$response->CourseAvailListResult->Courses->alCourse[$i];

						}

						

						$results['result']=$result;

						

						$mypaging['total_rows']=count($response->CourseAvailListResult->Courses->alCourse);

						$mypaging['base_url']=base_url()."teetime_golfcourse/golf_course/";

						$mypaging['per_page']=$record_per_page;

						$mypaging['uri_segment']=3;

						$this->pagination->initialize($mypaging);

						$results['paginglink']=$this->pagination->create_links();

					

					

					

					///////start new///////

					}

					else

					{

					    $results['imgpath']=$response->CourseAvailListResult->imgBase;

						

						$alcourse=$response->CourseAvailListResult->Courses->alCourse;

						$go_point=count($alcourse);

						$all_records=array();

						for($i=$page_start_from;$i<$go_point;$i++)

						{

							//price filtration

							$flag=0;

							foreach(@$price_filtration as $key=>$val)

							{

								if($val==0)

								{

								   $val=99999;

								}

								if($alcourse[$i]->fPrc>=$key && $alcourse[$i]->fPrc<=$val)

								{

								   $flag=1;

								}

							}

							if($flag==0)

							{

							   continue;

							}

							//end price filtration

							$all_records[]=$alcourse[$i];

						}

						if(!empty($all_records))

						{

							$record_per_page=20;

							$last_record=$page_start_from+$record_per_page;

							

							$j=count($all_records);

							$result=array();

							//show on page pagination info...

							$results['first_no']=$page_start_from+1;

							$results['last_no']=$last_record;

							$results['total_no']=$j;

							//end show on page pagination info...

							for($i=$page_start_from;$i<$last_record;$i++)

							{

								if($i<$j)

								$result[]=$all_records[$i];

							}

							

							$results['result']=$result;

							

							$mypaging['total_rows']=count($all_records);

							$mypaging['base_url']=base_url()."teetime_golfcourse/golf_course/";

							$mypaging['per_page']=$record_per_page;

							$mypaging['uri_segment']=3;

							$this->pagination->initialize($mypaging);

							$results['paginglink']=$this->pagination->create_links();

						}

						else

						{

						    $filter_result=1;

						}

					}

					///////end new///////////

					

					}

					

					$results['records']='not_empty';

					$results['option']	='first';

					////////left hand all area and city blue////////

					$results['left_area_city']	='selected';

					////////end left hand all area and city blue////

					//////not city wise///////

					$results['city_wise']='no';

					$results['area_wise']='no';

					//////end not city wise////////

					

					///////new///////////

					if(@$filter_result==1)

					{

						$results['result']='';

						$results['records']='empty';

					}

					///////end new///////////

					

					$data1['contents']=$this->load->view('golf_course_listing',$results,true);

					 $data1['golf_course_page']=1;	

					$data1['my_title']='Golf Course';$this->load->view('template',$data1);

				}			

				else

				{

					$results['result']='';

					$results['records']='empty';

					$results['option']	='first';

					$data1['contents']=$this->load->view('golf_course_listing',$results,true);

					 $data1['golf_course_page']=1;	

					$data1['my_title']='Golf Course';

					$this->load->view('template',$data1);

				}

		

		//}//end first check					

										

	 

	     //second check

		 /*if($course_id!='')

		 {

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

				$results['option']	='second';

				//show on page pagination info...

				$results['first_no']=1;

				$results['last_no']=1;

				$results['total_no']=1;

				//end show on page pagination info...



				////////left hand all area and city blue////////

				$results['left_area_city']	='selected';

				////////end left hand all area and city blue////

				//////for city wise///////

				$results['city_wise']	='no';

				//////end for city wise////////

				$results['course_listing']	=$response->CourseInfoResult;

				$data1['contents']=$this->load->view('golf_course_listing',$results,true);

				$this->load->view('template',$data1,'');		

	      }*///end second check	

  }//end function golf_course

  

  

  

  

  

  

  

  

  

  

  

  //>>>>>>>>>

  //>>>>>>>>>

  //>>>>>>>>>

  function golfcourse_form($page_start_from=0)

  {

		$country_id=$this->input->post('country_id');

		if(!empty($country_id)){

			$this->session->set_userdata('country_id',$country_id);

			$country_id=$this->session->userdata('country_id');

		}

		else

		{

			$country_id=$this->session->userdata('country_id');

		}

		

		

		$state_id=$this->input->post('state_id');

		if(!empty($state_id)){

			$this->session->set_userdata('state_id',$state_id);

			$state_id=$this->session->userdata('state_id');

		}

		else

		{

			$state_id=$this->session->userdata('state_id');

		}

		

		

		$area_id=$this->input->post('area_id');

		if(!empty($area_id)){

			$this->session->set_userdata('area_id',$area_id);

			$area_id=$this->session->userdata('area_id');

		}

		else

		{

			$area_id=$this->session->userdata('area_id');

		}

		

			

		$times=$this->input->post('times');

		if(!empty($times)){

			$this->session->set_userdata('times',$times);

			$times=$this->session->userdata('times');

		}

		else

		{

			$times=$this->session->userdata('times');

		}

		

		$players=$this->input->post('players');

		if(!empty($players)){

			$this->session->set_userdata('players',$players);

			$players=$this->session->userdata('players');

		}

		else

		{

			$players=$this->session->userdata('players');

		}

		

		$datepicker=$this->input->post('datepicker');

		if(empty($datepicker))

		$save_date=time();

		else

		{

			$save_date=strtotime($datepicker);

		}

		$datepicker=date('Y-m-d',$save_date);

		//save in session

		$this->session->set_userdata('fin_date',$save_date); 

		 

	    //first check

		//if($course_id==''){

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

															"PlayBegDate"=>$datepicker."T00:00:00",

															"PlayEndDate"=>$datepicker."T00:00:00",

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

				

				/*echo $this->session->userdata('country_id');

				echo $this->session->userdata('state_id');

				echo $this->session->userdata('area_id');*/

				//print_r($response);

				

				

				//check record is empty or not	

			  if($response->CourseAvailListResult->RetCd==0)

			  {	

					$single_record=count($response->CourseAvailListResult->Courses->alCourse);

					//if record is single

					if($single_record==1)

					{

						$results['result']=$response->CourseAvailListResult->Courses->alCourse;

						$results['imgpath']=$response->CourseAvailListResult->imgBase;

						//show on page pagination info...

						$results['first_no']=1;

						$results['last_no']=1;

						$results['total_no']=1;

						//end show on page pagination info...



					}

			   		else//if record are more than one

					{

						$results['imgpath']=$response->CourseAvailListResult->imgBase;

						$record_per_page=20;

						$last_record=$page_start_from+$record_per_page;

						$j=count($response->CourseAvailListResult->Courses->alCourse);

						$result=array();

						//show on page pagination info...

						$results['first_no']=$page_start_from+1;

						$results['last_no']=$last_record;

						$results['total_no']=$j;

						//end show on page pagination info...

						for($i=$page_start_from;$i<$last_record;$i++)

						{

							if($i<$j)

							$result[]=$response->CourseAvailListResult->Courses->alCourse[$i];

						}

						

						$results['result']=$result;

						

						$mypaging['total_rows']=count($response->CourseAvailListResult->Courses->alCourse);

						$mypaging['base_url']=base_url()."teetime_golfcourse/golf_course/";

						$mypaging['per_page']=$record_per_page;

						$mypaging['uri_segment']=3;

						$this->pagination->initialize($mypaging);

						$results['paginglink']=$this->pagination->create_links();

					}

					

					$results['records']='not_empty';

					$results['option']	='first';

					////////left hand all area and city blue////////

					$results['left_area_city']	='selected';

					////////end left hand all area and city blue////

					//////not city area wise///////

					$results['city_wise']='no';

					$results['area_wise']='no';

					//////end not city area wise////////

					$data1['contents']=$this->load->view('golf_course_listing',$results,true);

					 $data1['golf_course_page']=1;		

					$data1['my_title']='Golf Course';$this->load->view('template',$data1);

				}			

				else

				{

					$results['result']='';

					$results['records']='empty';

					$results['option']	='first';

					$data1['contents']=$this->load->view('golf_course_listing',$results,true);

					 $data1['golf_course_page']=1;	

					$data1['my_title']='Golf Course';$this->load->view('template',$data1);

				}

		

		//}//end first check					

										

	 

	     //second check

		 /*if($course_id!='')

		 {

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

				$results['option']	='second';

				//show on page pagination info...

				$results['first_no']=1;

				$results['last_no']=1;

				$results['total_no']=1;

				//end show on page pagination info...



				////////left hand all area and city blue////////

				$results['left_area_city']	='selected';

				////////end left hand all area and city blue////

				//////for city wise///////

				$results['city_wise']	='no';

				//////end for city wise////////

				$results['course_listing']	=$response->CourseInfoResult;

				$data1['contents']=$this->load->view('golf_course_listing',$results,true);

				$this->load->view('template',$data1,'');		

	      }*///end second check	

    }

  

  

  

  

  

  

     

	 

	 function price_filtration()

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

 

  

  

  

  

  

  

  

  

  

  

    

	//>>>>>>>>>>>>>>

	//>>>>>>>>>>>>>>

	//>>>>>>>>>>>>>>

	//golf course listing city wise

    function city_wise($area_id,$city)

	{

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

					

				

				

				//check record is empty or not	

			  if($response->CourseAvailListResult->RetCd==0)

			  {	

					$single_record=count($response->CourseAvailListResult->Courses->alCourse);

					//if record is single

					if($single_record==1)

					{

						$results['result']=$response->CourseAvailListResult->Courses->alCourse;

						$results['imgpath']=$response->CourseAvailListResult->imgBase;

						//show on page pagination info...

						$results['first_no']=1;

						$results['last_no']=1;

						$results['total_no']=1;

						//end show on page pagination info...



					}

			   		else//if record are more than one

					{

						$results['imgpath']=$response->CourseAvailListResult->imgBase;

						

						//show on page pagination info...

						$main_array=$response->CourseAvailListResult->Courses->alCourse;

						$count=count($main_array);

						$total=0;

						for($i=0;$i<$count;$i++)

						{

							if(strcmp(urldecode($city),$main_array[$i]->cty)==0)

							{

							   $total++;

							}

						}

						$results['first_no']=1;

						$results['last_no']=$total;

						$results['total_no']=$total;

						//end show on page pagination info...

						

						$result=$response->CourseAvailListResult->Courses->alCourse;

						$results['result']=$result;

					}

					

					$results['records']='not_empty';

					$results['option']	='first';

					//////for city wise///////

					$results['city_wise']	='yes';

					$city=urldecode($city);

					$results['city']	=$city;

					$results['area_id']	=$area_id;

					//////end for city wise////////

					////////left hand all area and city blue////////

					$results['left_area_city']	='not_selected';

					////////end left hand all area and city blue////

					$data1['contents']=$this->load->view('golf_course_listing',$results,true);

					 $data1['golf_course_page']=1;	

					$data1['my_title']='Golf Course';$this->load->view('template',$data1);

				}			

				else

				{

					$results['result']='';

					$results['records']='empty';

					$results['option']	='first';

					$data1['contents']=$this->load->view('golf_course_listing',$results,true);

					 $data1['golf_course_page']=1;	

					$data1['my_title']='Golf Course';$this->load->view('template',$data1);

				}

		

			

       }

	   

	   

	   

	   

	   

	   

	   

	   

	   //>>>>>>>>>>

	   //>>>>>>>>>>

	   //>>>>>>>>>>

	   //

	   function area_wise($area_id)

	   {

	   

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

					

				

				

				//check record is empty or not	

			  if($response->CourseAvailListResult->RetCd==0)

			  {	

					$single_record=count($response->CourseAvailListResult->Courses->alCourse);

					$first_check=0;

					//if record is single

					if($single_record==1)

					{

						$results['result']=$response->CourseAvailListResult->Courses->alCourse;

						$results['imgpath']=$response->CourseAvailListResult->imgBase;

						//show on page pagination info...

						$results['first_no']=1;

						$results['last_no']=1;

						$results['total_no']=1;

						//end show on page pagination info...



					}

			   		else//if record are more than one

					{

						$results['imgpath']=$response->CourseAvailListResult->imgBase;

						

						//show on page pagination info...

						$main_array=$response->CourseAvailListResult->Courses->alCourse;

						$count=count($main_array);

						$total=0;

						for($i=0;$i<$count;$i++)

						{

							if(strcmp(urldecode($area_id),$main_array[$i]->sAr)==0)

							{

							   $total++;

							}

						}

						$results['first_no']=1;

						$results['last_no']=$total;

						$results['total_no']=$total;

						//end show on page pagination info...

						

						$result=$response->CourseAvailListResult->Courses->alCourse;

						$results['result']=$result;

					}

					

					$results['records']='not_empty';

					$results['option']	='first';

					//////for area wise///////

					$results['area_wise']	='yes';

					$results['area_val']	=$area_id;

					//////end for area wise////////

					////////left hand all area and city blue////////

					$results['left_area_city']	='not_selected';

					////////end left hand all area and city blue////

					$data1['contents']=$this->load->view('golf_course_listing',$results,true);	

					 $data1['golf_course_page']=1;

					$data1['my_title']='Golf Course';$this->load->view('template',$data1);

				}			

				else

				{

					$results['result']='';

					$results['records']='empty';

					$results['option']	='first';

					$data1['contents']=$this->load->view('golf_course_listing',$results,true);

					 $data1['golf_course_page']=1;	

					$data1['my_title']='Golf Course';$this->load->view('template',$data1);

				}

	   

	   }

	   

	   

	   

	 

	   

	  

	  //>>>>>>>>>>

	  //>>>>>>>>>>>

	  //>>>>>>>>>>>

	   function area_wise_sorting($para,$area_id)

	   {

	    if(@$this->session->userdata('no_record_found')==1)

		{

		   redirect($_SERVER["HTTP_REFERER"]);

		}

		$country_id=$this->session->userdata('country_id');

		$state_id=$this->session->userdata('state_id');

		$area_id=urldecode($area_id);

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

		

		

		//if course id is empty and country id is not empty

		//if($country_id!='' && $course_id=='')

		//{

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

																"MaxDistanceType"=>"",

																"FeaturedOnly"=>false,

																"ShowAllTimes"=>true,

																"ShowIfNoTimes"=>true,

																"BarterOnly"=>false,

																"ChargingOnly"=>false,

																"SpecialsOnly"=>false,

																"RegularRateOnly"=>false,

																"ProfileId"=>"")));	

					 

			 

			 if($para=='alpha')

			 {

				//if record is single

				$single_record=count($response->CourseAvailListResult->Courses->alCourse);

				if($single_record==1)

				{

				   $results['result']=$response->CourseAvailListResult->Courses->alCourse;

				   $results['imgpath']=$response->CourseAvailListResult->imgBase;

				   $pagination=0;

				}

				else//if records are more than one

				{

					$results['imgpath']=$response->CourseAvailListResult->imgBase;

					$all_data=$response->CourseAvailListResult->Courses->alCourse;

					for($u=0;$u< count($all_data);$u++)

					{

					   $save_index[]=$all_data[$u]->nm;

					}

					asort($save_index);

					//all name record of after sorting in $save_index

					foreach($save_index as $key=>$val)

					{

					   $result1[] =$all_data[$key];

					} 

					

					$results['result']=$result1;

					$pagination=1;

				 }

			  }

			  

			  

			  if($para=='price')

			  {

			    //if record is single

				$single_record=count($response->CourseAvailListResult->Courses->alCourse);

				if($single_record==1)

				{

				   $results['result']=$response->CourseAvailListResult->Courses->alCourse;

				   $results['imgpath']=$response->CourseAvailListResult->imgBase;

				   $pagination=0;

				}

				else //if record is more than one

				{

					$results['imgpath']=$response->CourseAvailListResult->imgBase;

					$all_data=$response->CourseAvailListResult->Courses->alCourse;

					for($u=0;$u< count($all_data);$u++)

					{

					   $save_index[]=$all_data[$u]->fPrc;

					}

					asort($save_index);

					

					//all data of prices after sorting in $save_index 

					foreach($save_index as $key=>$val)

					{

					   $result1[] =$all_data[$key];

					} 

					

					$results['result']=$result1;

					$pagination=1;

				  }

			  }

			  

			  //Number of customer reviews.

			  if($para=='favorite')

			  {

			    //if record is single

				$single_record=count($response->CourseAvailListResult->Courses->alCourse);

				if($single_record==1)

				{

				   $results['result']=$response->CourseAvailListResult->Courses->alCourse;

				   $results['imgpath']=$response->CourseAvailListResult->imgBase;

				   $pagination=0;

				}

				else//if records are more than one

				{

					$results['imgpath']=$response->CourseAvailListResult->imgBase;

					$all_data=$response->CourseAvailListResult->Courses->alCourse;

					for($u=0;$u< count($all_data);$u++)

					{

					   $save_index[]=$all_data[$u]->ratingCnt;

					}

					arsort($save_index);

					

					//sorting of all ratingcnt save in $save_index 

					foreach($save_index as $key=>$val)

					{

					   $result1[] =$all_data[$key];

					} 

					

					$results['result']=$result1;

					$pagination=1;

				 }

			  }

			  

			  

			  if($para=='rating')

			  {

			    //if record is single

				$single_record=count($response->CourseAvailListResult->Courses->alCourse);

				if($single_record==1)

				{

				   $results['result']=$response->CourseAvailListResult->Courses->alCourse;

				   $results['imgpath']=$response->CourseAvailListResult->imgBase;

				   $pagination=0;

				}

				else//if records are more than one

				{

					$results['imgpath']=$response->CourseAvailListResult->imgBase;

					$all_data=$response->CourseAvailListResult->Courses->alCourse;

					for($u=0;$u< count($all_data);$u++)

					{

					   $save_index[]=$all_data[$u]->rating;

					}

					arsort($save_index);

					

					//sorting of all rating save in $save_index

					foreach($save_index as $key=>$val)

					{

					   $result1[] =$all_data[$key];

					} 

					

					$results['result']=$result1;

					$pagination=1;

				 }	

			   }

			  

			   

			   if($pagination==0)

			   {

					//show on page pagination info...

					$results['first_no']=1;

					$results['last_no']=1;

					$results['total_no']=1;

					//end show on page pagination info...

			   }

			   

			   if($pagination==1)

			   {

					//show on page pagination info...

					$main_array=$response->CourseAvailListResult->Courses->alCourse;

					$count=count($main_array);

					$total=0;

					for($i=0;$i<$count;$i++)

					{

						if(strcmp($area_id,$main_array[$i]->sAr)==0)

						{

						   $total++;

						}

					}

					$results['first_no']=1;

					$results['last_no']=$total;

					$results['total_no']=$total;

					//end show on page pagination info...

			   }

			   

			   

			   $results['records']='not_empty';

			   $results['option']='first';

			   //////area wise/////////

			   $results['area_wise']='yes';

			   ////end city wise///////

				////////left hand all area and city blue////////

				$results['left_area_city']	='not_selected';

				////////end left hand all area and city blue////

			   $results['area_val']	=$area_id;

			   $data1['contents']=$this->load->view('golf_course_listing',$results,true);

			    $data1['golf_course_page']=1;	

			   $data1['my_title']='Golf Course';$this->load->view('template',$data1);

			 //} //end of check one

			

			 //if course id is not empty.	  

			 /*if($course_id!='')

			 {

				redirect('teetime_golfcourse/city_wise/'.$area_id.'/'.$city);

			 } */

	   

	   

	   

	   

	   }

	   

	   

	   

	   

	   

	   

	   

	   

 

  

  

    //>>>>>>>>>>>>>>

	//>>>>>>>>>>>>>>

	//>>>>>>>>>>>>>>

	//sorting of golf course listing city wise

	function city_wise_sorting($para,$area_id,$city)

	{

		if(@$this->session->userdata('no_record_found')==1)

		{

		   redirect($_SERVER["HTTP_REFERER"]);

		}

		$country_id=$this->session->userdata('country_id');

		$state_id=$this->session->userdata('state_id');

		$area_id=urldecode($area_id);

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

		

		

		//if course id is empty and country id is not empty

		if($country_id!='')

		{

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

																"MaxDistanceType"=>"",

																"FeaturedOnly"=>false,

																"ShowAllTimes"=>true,

																"ShowIfNoTimes"=>true,

																"BarterOnly"=>false,

																"ChargingOnly"=>false,

																"SpecialsOnly"=>false,

																"RegularRateOnly"=>false,

																"ProfileId"=>"")));	

					 

			 

			 if($para=='alpha')

			 {

				//if record is single

				$single_record=count($response->CourseAvailListResult->Courses->alCourse);

				if($single_record==1)

				{

				   $results['result']=$response->CourseAvailListResult->Courses->alCourse;

				   $results['imgpath']=$response->CourseAvailListResult->imgBase;

				   $pagination=0;

				}

				else//if records are more than one

				{

					$results['imgpath']=$response->CourseAvailListResult->imgBase;

					$all_data=$response->CourseAvailListResult->Courses->alCourse;

					for($u=0;$u< count($all_data);$u++)

					{

					   $save_index[]=$all_data[$u]->nm;

					}

					asort($save_index);

					//all name record of after sorting in $save_index

					foreach($save_index as $key=>$val)

					{

					   $result1[] =$all_data[$key];

					} 

					

					$results['result']=$result1;

					$pagination=1;

				 }

			  }

			  

			  

			  if($para=='price')

			  {

			    //if record is single

				$single_record=count($response->CourseAvailListResult->Courses->alCourse);

				if($single_record==1)

				{

				   $results['result']=$response->CourseAvailListResult->Courses->alCourse;

				   $results['imgpath']=$response->CourseAvailListResult->imgBase;

				   $pagination=0;

				}

				else //if record is more than one

				{

					$results['imgpath']=$response->CourseAvailListResult->imgBase;

					$all_data=$response->CourseAvailListResult->Courses->alCourse;

					for($u=0;$u< count($all_data);$u++)

					{

					   $save_index[]=$all_data[$u]->fPrc;

					}

					asort($save_index);

					

					//all data of prices after sorting in $save_index 

					foreach($save_index as $key=>$val)

					{

					   $result1[] =$all_data[$key];

					} 

					

					$results['result']=$result1;

					$pagination=1;

				  }

			  }

			  

			  //Number of customer reviews.

			  if($para=='favorite')

			  {

			    //if record is single

				$single_record=count($response->CourseAvailListResult->Courses->alCourse);

				if($single_record==1)

				{

				   $results['result']=$response->CourseAvailListResult->Courses->alCourse;

				   $results['imgpath']=$response->CourseAvailListResult->imgBase;

				   $pagination=0;

				}

				else//if records are more than one

				{

					$results['imgpath']=$response->CourseAvailListResult->imgBase;

					$all_data=$response->CourseAvailListResult->Courses->alCourse;

					for($u=0;$u< count($all_data);$u++)

					{

					   $save_index[]=$all_data[$u]->ratingCnt;

					}

					arsort($save_index);

					

					//sorting of all ratingcnt save in $save_index 

					foreach($save_index as $key=>$val)

					{

					   $result1[] =$all_data[$key];

					} 

					

					$results['result']=$result1;

					$pagination=1;

				 }

			  }

			  

			  

			  if($para=='rating')

			  {

			    //if record is single

				$single_record=count($response->CourseAvailListResult->Courses->alCourse);

				if($single_record==1)

				{

				   $results['result']=$response->CourseAvailListResult->Courses->alCourse;

				   $results['imgpath']=$response->CourseAvailListResult->imgBase;

				   $pagination=0;

				}

				else//if records are more than one

				{

					$results['imgpath']=$response->CourseAvailListResult->imgBase;

					$all_data=$response->CourseAvailListResult->Courses->alCourse;

					for($u=0;$u< count($all_data);$u++)

					{

					   $save_index[]=$all_data[$u]->rating;

					}

					arsort($save_index);

					

					//sorting of all rating save in $save_index

					foreach($save_index as $key=>$val)

					{

					   $result1[] =$all_data[$key];

					} 

					

					$results['result']=$result1;

					$pagination=1;

				 }	

			   }

			  

			   

			   if($pagination==0)

			   {

					//show on page pagination info...

					$results['first_no']=1;

					$results['last_no']=1;

					$results['total_no']=1;

					//end show on page pagination info...

			   }

			   

			   if($pagination==1)

			   {

					//show on page pagination info...

					$main_array=$response->CourseAvailListResult->Courses->alCourse;

					$count=count($main_array);

					$total=0;

					for($i=0;$i<$count;$i++)

					{

						if(strcmp(urldecode($city),$main_array[$i]->cty)==0)

						{

						   $total++;

						}

					}

					$results['first_no']=1;

					$results['last_no']=$total;

					$results['total_no']=$total;

					//end show on page pagination info...

			   }

			   

			   

			   $results['records']='not_empty';

			   $results['option']='first';

			   //////city wise/////////

			   $results['city_wise']='yes';

			   $city=urldecode($city);

			   $results['city']=$city;

			   ////end city wise///////

				////////left hand all area and city blue////////

				$results['left_area_city']	='not_selected';

				////////end left hand all area and city blue////

			   $results['area_id']	=$area_id;

			   $data1['contents']=$this->load->view('golf_course_listing',$results,true);

			   $data1['golf_course_page']=1;	

			   $data1['my_title']='Golf Course';$this->load->view('template',$data1);

			 } //end of check one

			

			 //if course id is not empty.	  

			 /*if($course_id!='')

			 {

				redirect('teetime_golfcourse/city_wise/'.$area_id.'/'.$city);

			 } */

	   }//end of function city_wise_sorting

  

  

  

  

  

  

  

	

	

	

	

	

	//>>>>>>>>>>>>>>>>>>>>>>>

	//>>>>>>>>>>>>>>>>>>>>>>>

	//>>>>>>>>>>>>>>>>>>>>>>>

	function miles_distance($page_start_from=0)

	{

		$miles=$this->input->post('miles');

		$zipcode=$this->input->post('zipcode');

		

		$country_id=$this->session->userdata('country_id');

		$state_id=$this->session->userdata('state_id');

		$area_id=$this->session->userdata('area_id');

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

															"PostalCode"=>$zipcode,

															"MaxDistance"=>$miles,

															"MaxDistanceType"=>"M",

															"FeaturedOnly"=>false,

															"ShowAllTimes"=>true,

															"ShowIfNoTimes"=>true,

															"BarterOnly"=>false,

															"ChargingOnly"=>false,

															"SpecialsOnly"=>false,

															"RegularRateOnly"=>false,

															"ProfileId"=>"")));		

				

			  //check if record is not empty or not

			  if($response->CourseAvailListResult->RetCd==0)

			  {	

					$single_record=count($response->CourseAvailListResult->Courses->alCourse);

					//if record is single

					if($single_record==1)

					{

						$results['result']=$response->CourseAvailListResult->Courses->alCourse;

						$results['imgpath']=$response->CourseAvailListResult->imgBase;                        $results['records']='not_empty';

						//show on page pagination info...

						$results['first_no']=1;

						$results['last_no']=1;

						$results['total_no']=1;

						//end show on page pagination info...

						

					}

					else//if record are more than one

					{

						$results['imgpath']=$response->CourseAvailListResult->imgBase;

						$record_per_page=20;

						$last_record=$page_start_from+$record_per_page;

						

						$j=count($response->CourseAvailListResult->Courses->alCourse);

						$result=array();

						for($i=$page_start_from;$i<$last_record;$i++)

						{

							if($i<$j)

							$result[]=$response->CourseAvailListResult->Courses->alCourse[$i];

						}

						$results['result']=$result;

						$mypaging['total_rows']=count($response->CourseAvailListResult->Courses->alCourse);

						$mypaging['base_url']=base_url()."teetime_golfcourse/miles_distance/";

						$mypaging['per_page']=$record_per_page;

						$mypaging['uri_segment']=3;

						$this->pagination->initialize($mypaging);

						$results['paginglink']=$this->pagination->create_links();

						$results['records']='not_empty';

						

                        //show on page pagination info...

						$results['first_no']=$page_start_from+1;

						$results['last_no']=$last_record;

						$results['total_no']=$j;

						//end show on page pagination info...

					}

			     

				 

				  }

				  else//if record is empty

				  {

					$results['result']='';

					$results['records']='empty';

				  }

				  //general use of it

				  $results['option']='first';

				  $results['select_miles']=$miles;

				  $results['select_zipcode']=$zipcode;

				  //////city wise/////////

				  $results['city_wise']='no';

				  ////end city wise///////

				  ////////left hand all area and city blue////////

				  $results['left_area_city']	='not_selected';

				  ////////end left hand all area and city blue////

				  $data1['contents']=$this->load->view('golf_course_listing',$results,true);

				  $data1['golf_course_page']=1;	

				  $data1['my_title']='Golf Course';$this->load->view('template',$data1);

		    }//end of function  

	

	

	

	

	

	//>>>>>>>>>>>>>>>>>

	//>>>>>>>>>>>>>>>>>

	//>>>>>>>>>>>>>>>>>

	function dropdown_golfcorse()

	{

		$country_id=$this->session->userdata('country_id');

		$state_id=$this->session->userdata('state_id');

		$area_id=$this->session->userdata('area_id');

		$course_id=$this->session->userdata('course_id');

		//get all country, state and area data in it

		$results='';

		if($country_id!='')

		{

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

															"RegionId"=>"")));*/

			$response=$this->common_model->select_where('id,nm','gama_state',array('c_id'=>$country_id));													

			$response=$response->result();

			$results['response']=$response;

		}//end get all country, state and area data in it

		

		//get all courses data.

		if($country_id!='' && $state_id!='' && $area_id!='')

		{	

			$client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");

			$response1 = $client->CourseList(array("Hdr"=>array("ResellerId"=>"WPA",

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

			                                 

											 $results['response1']=$response1;

		}//end get all courses data

		

		//get specific course info	

        if($course_id!='')

		{

			$client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");

			$response2 = $client->CourseInfo(array("Hdr"=>array("ResellerId"=>"WPA",

																"PartnerId"=>"",

																"SourceCd"=>"A",

																"Lang"=>"en",

																"UserIp"=>"66.147.244.227",

																"UserSessionId"=>"",

																"AccessKey"=>"",

																"Agent"=>"",

																"gsSource"=>"",

																"gsDebug"=>true),

												   "Req"=>array("CourseId"=>$course_id,)));

				

												  $results['response2']=$response2;

		}//end get specific course info 		

			

							$html=$this->load->view('ajax_dropdown_golfcorse',$results);

							echo $html;

	}

	

	

	

	

	

	



	function dropdown_teetime()

	{

		$country_id=$this->session->userdata('country_id');

		$state_id=$this->session->userdata('state_id');

		$area_id=$this->session->userdata('area_id');

		$course_id=$this->session->userdata('course_id');

		

		//check one get all country, state and area data in it

		$results='';

		if($country_id!='')

		{

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

															"RegionId"=>"")));/**/

			

			$response=$this->common_model->select_where('id,nm','gama_state',array('c_id'=>$country_id));													

			$response=$response->result();											

			$results['response']=$response;

		}//end check one

		

		//check two get all courses data.

		if($country_id!='' && $state_id!='' && $area_id!='')

		{	

			$client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");

			$response1 = $client->CourseList(array("Hdr"=>array("ResellerId"=>"WPA",

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

			                                 

											 $results['response1']=$response1;

		}//end check two

		

		//check three get specific course info	

        if($course_id!='')

		{

			$client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");

			$response2 = $client->CourseInfo(array("Hdr"=>array("ResellerId"=>"WPA",

																"PartnerId"=>"",

																"SourceCd"=>"A",

																"Lang"=>"en",

																"UserIp"=>"66.147.244.227",

																"UserSessionId"=>"",

																"AccessKey"=>"",

																"Agent"=>"",

																"gsSource"=>"",

																"gsDebug"=>true),

												   "Req"=>array("CourseId"=>$course_id,)));

				

												  $results['response2']=$response2;

		}//end check three 		

			

							$html=$this->load->view('ajax_dropdown_teetime',$results);

							echo $html;

	}

	

	

	

	

	//>>>>>>>>>>>>>>

	//>>>>>>>>>>>>>>

	//>>>>>>>>>>>>>>

	function sorting($para,$page_start_from=0)

	{

		if(@$this->session->userdata('no_record_found')==1)

		{

		   redirect($_SERVER["HTTP_REFERER"]);

		}

		

		$country_id=$this->session->userdata('country_id');

		$state_id=$this->session->userdata('state_id');

		$area_id=$this->session->userdata('area_id');

		//$course_id=$this->session->userdata('course_id');

		

		$fin_date=$this->session->userdata('fin_date');

		$f_date=date('Y-m-d',$fin_date);

		

		

		//if course id is empty and country id is not empty

		//if($country_id!='')

		//{

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

																"Time"=>"0600",

																"Players"=>"1",

																"MaxDistance"=>"",

																"MaxDistanceType"=>"",

																"FeaturedOnly"=>false,

																"ShowAllTimes"=>true,

																"ShowIfNoTimes"=>true,

																"BarterOnly"=>false,

																"ChargingOnly"=>false,

																"SpecialsOnly"=>false,

																"RegularRateOnly"=>false,

																"ProfileId"=>"")));	

					 

			 

			 if($para=='alpha')

			 {

				//if record is single

				$single_record=count($response->CourseAvailListResult->Courses->alCourse);

				if($single_record==1)

				{

				   $results['result']=$response->CourseAvailListResult->Courses->alCourse;

				   $results['imgpath']=$response->CourseAvailListResult->imgBase;

				   $pagination=0;

				}

				else//if records are more than one

				{

					$results['imgpath']=$response->CourseAvailListResult->imgBase;

					$all_data=$response->CourseAvailListResult->Courses->alCourse;

					for($u=0;$u< count($all_data);$u++)

					{

					   $save_index[]=$all_data[$u]->nm;

					}

					asort($save_index);

					//all name record of after sorting in $save_index

					foreach($save_index as $key=>$val)

					{

					   $result1[] =$all_data[$key];

					} 

					

					//pagination

					$record_per_page=20;

					$last_record=$page_start_from+$record_per_page;

					$j=count($result1);

					for($i=$page_start_from;$i<$last_record;$i++)

					{

						if($i<$j)

						$result[]=$result1[$i];

					}

					

					$results['result']=$result;

					$mypaging['total_rows']=count($save_index);

					$pagination=1;

				 }

			  }

			  

			  

			  if($para=='price')

			  {

			    //if record is single

				$single_record=count($response->CourseAvailListResult->Courses->alCourse);

				if($single_record==1)

				{

				   $results['result']=$response->CourseAvailListResult->Courses->alCourse;

				   $results['imgpath']=$response->CourseAvailListResult->imgBase;

				   $pagination=0;

				}

				else //if record is more than one

				{

					$results['imgpath']=$response->CourseAvailListResult->imgBase;

					$all_data=$response->CourseAvailListResult->Courses->alCourse;

					for($u=0;$u< count($all_data);$u++)

					{

					   $save_index[]=$all_data[$u]->fPrc;

					}

					asort($save_index);

					

					//all data of prices after sorting in $save_index 

					foreach($save_index as $key=>$val)

					{

					   $result1[] =$all_data[$key];

					} 

					

					//pagination

					$record_per_page=20;

					$last_record=$page_start_from+$record_per_page;

					$j=count($result1);

					for($i=$page_start_from;$i<$last_record;$i++)

					{

						if($i<$j)

						$result[]=$result1[$i];

					}

					$results['result']=$result;

					$mypaging['total_rows']=count($save_index);

					$pagination=1;

				  }

			  }

			  

			  

			  //Number of customer reviews.

			  if($para=='favorite')

			  {

			    //if record is single

				$single_record=count($response->CourseAvailListResult->Courses->alCourse);

				if($single_record==1)

				{

				   $results['result']=$response->CourseAvailListResult->Courses->alCourse;

				   $results['imgpath']=$response->CourseAvailListResult->imgBase;

				   $pagination=0;

				}

				else//if records are more than one

				{

					$results['imgpath']=$response->CourseAvailListResult->imgBase;

					$all_data=$response->CourseAvailListResult->Courses->alCourse;

					for($u=0;$u< count($all_data);$u++)

					{

					   $save_index[]=$all_data[$u]->ratingCnt;

					}

					arsort($save_index);

					

					//sorting of all ratingcnt save in $save_index 

					foreach($save_index as $key=>$val)

					{

					   $result1[] =$all_data[$key];

					} 

					

					//pagination

					$record_per_page=20;

					$last_record=$page_start_from+$record_per_page;

					$j=count($result1);

					for($i=$page_start_from;$i<$last_record;$i++)

					{

						if($i<$j)

						$result[]=$result1[$i];

					}

					$results['result']=$result;

					$mypaging['total_rows']=count($save_index);

					$pagination=1;

				 }

			  }

			  

			  

			  if($para=='rating')

			  {

			    //if record is single

				$single_record=count($response->CourseAvailListResult->Courses->alCourse);

				if($single_record==1)

				{

				   $results['result']=$response->CourseAvailListResult->Courses->alCourse;

				   $results['imgpath']=$response->CourseAvailListResult->imgBase;

				   $pagination=0;

				}

				else//if records are more than one

				{

					$results['imgpath']=$response->CourseAvailListResult->imgBase;

					$all_data=$response->CourseAvailListResult->Courses->alCourse;

					for($u=0;$u< count($all_data);$u++)

					{

					   $save_index[]=$all_data[$u]->rating;

					}

					arsort($save_index);

					

					//sorting of all rating save in $save_index

					foreach($save_index as $key=>$val)

					{

					   $result1[] =$all_data[$key];

					} 

					

					//pagination

					$record_per_page=20;

					$last_record=$page_start_from+$record_per_page;

					$j=count($result1);

					for($i=$page_start_from;$i<$last_record;$i++)

					{

						if($i<$j)

						$result[]=$result1[$i];

					}

					$results['result']=$result;

					$mypaging['total_rows']=count($save_index);

					$pagination=1;

				 }	

			   }

			  

			 

			   //pagination for all above checks.....

			   if(@$pagination==1)

			   {

					$mypaging['base_url']=base_url()."teetime_golfcourse/sorting/".$para.'/';

					$mypaging['per_page']=$record_per_page;

					$mypaging['uri_segment']=4;

					$this->pagination->initialize($mypaging);

					$results['paginglink']=$this->pagination->create_links();

					

					$results['records']='not_empty';

				    $results['option']='first';

					//show on page pagination info...

					$results['first_no']=$page_start_from+1;

					$results['last_no']=$last_record;

					$results['total_no']=$j;

					//end show on page pagination info...

			   }

			   

			   if(@$pagination==0)

			   {

					$results['records']='not_empty';

				    $results['option']='first';

					//show on page pagination info...

					$results['first_no']=1;

					$results['last_no']=1;

					$results['total_no']=1;

					//end show on page pagination info...

			   }

			   

				//////city wise/////////

				$results['city_wise']='no';

				////end city wise///////

				////////left hand all area and city blue////////

				$results['left_area_city']	='not_selected';

				////////end left hand all area and city blue////

			   $data1['contents']=$this->load->view('golf_course_listing',$results,true);

			    $data1['golf_course_page']=1;	

			   $data1['my_title']='Golf Course';$this->load->view('template',$data1);

			 //} //end of check one

			

			 //if course id is not empty.	  

			 /*if($course_id!='')

			 {

				redirect('teetime_golfcourse/golf_course');

			 } */

	   }//end of function sorting

	

	



	

	

	//>>>>>>>>>>>>>>>>>

	//>>>>>>>>>>>>>>>>>

	//>>>>>>>>>>>>>>>>>

	function sorting_mile($para,$miles,$zipcode,$page_start_from=0)

	{

		if(@$this->session->userdata('no_record_found')==1)

		{

		   redirect($_SERVER["HTTP_REFERER"]);

		}

		

		$country_id=$this->session->userdata('country_id');

		$state_id=$this->session->userdata('state_id');

		$area_id=$this->session->userdata('area_id');

		//$course_id=$this->session->userdata('course_id');

		

		$fin_date=$this->session->userdata('fin_date');

		$f_date=date('Y-m-d',$fin_date);

		

		

		$results['select_miles']=$miles;

		$results['select_zipcode']=$zipcode;

		

		

		//if($country_id!='' && $course_id==''){

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

															"Time"=>"0600",

															"Players"=>"1",

															"PostalCode"=>$zipcode,

															"MaxDistance"=>$miles,

															"MaxDistanceType"=>"M",

															"FeaturedOnly"=>false,

															"ShowAllTimes"=>true,

															"ShowIfNoTimes"=>true,

															"BarterOnly"=>false,

															"ChargingOnly"=>false,

															"SpecialsOnly"=>false,

															"RegularRateOnly"=>false,

															"ProfileId"=>"")));	

	          

			  

			 if($para=='alpha')

			 {

				//if record is single

				$single_record=count($response->CourseAvailListResult->Courses->alCourse);

				if($single_record==1)

				{

				   $results['result']=$response->CourseAvailListResult->Courses->alCourse;

				   $results['imgpath']=$response->CourseAvailListResult->imgBase;

				   $pagination=0;

				}

				else//if records are more than one

				{

					$results['imgpath']=$response->CourseAvailListResult->imgBase;

					$all_data=$response->CourseAvailListResult->Courses->alCourse;

					for($u=0;$u< count($all_data);$u++)

					{

					   $save_index[]=$all_data[$u]->nm;

					}

					asort($save_index);

					//all name record of after sorting in $save_index

					foreach($save_index as $key=>$val)

					{

					   $result1[] =$all_data[$key];

					} 

					

					//pagination

					$record_per_page=20;

					$last_record=$page_start_from+$record_per_page;

					$j=count($result1);

					for($i=$page_start_from;$i<$last_record;$i++)

					{

						if($i<$j)

						$result[]=$result1[$i];

					}

					

					$results['result']=$result;

					$mypaging['total_rows']=count($save_index);

					$pagination=1;

				 }

			  }

			  

			  

			  if($para=='price')

			  {

			    //if record is single

				$single_record=count($response->CourseAvailListResult->Courses->alCourse);

				if($single_record==1)

				{

				   $results['result']=$response->CourseAvailListResult->Courses->alCourse;

				   $results['imgpath']=$response->CourseAvailListResult->imgBase;

				   $pagination=0;

				}

				else //if record is more than one

				{

					$results['imgpath']=$response->CourseAvailListResult->imgBase;

					$all_data=$response->CourseAvailListResult->Courses->alCourse;

					for($u=0;$u< count($all_data);$u++)

					{

					   $save_index[]=$all_data[$u]->fPrc;

					}

					asort($save_index);

					

					//all data of prices after sorting in $save_index 

					foreach($save_index as $key=>$val)

					{

					   $result1[] =$all_data[$key];

					} 

					

					//pagination

					$record_per_page=20;

					$last_record=$page_start_from+$record_per_page;

					$j=count($result1);

					for($i=$page_start_from;$i<$last_record;$i++)

					{

						if($i<$j)

						$result[]=$result1[$i];

					}

					$results['result']=$result;

					$mypaging['total_rows']=count($save_index);

					$pagination=1;

				  }

			  }

			  

			  

			  //Number of customer reviews.

			  if($para=='favorite')

			  {

			    //if record is single

				$single_record=count($response->CourseAvailListResult->Courses->alCourse);

				if($single_record==1)

				{

				   $results['result']=$response->CourseAvailListResult->Courses->alCourse;

				   $results['imgpath']=$response->CourseAvailListResult->imgBase;

				   $pagination=0;

				}

				else//if records are more than one

				{

					$results['imgpath']=$response->CourseAvailListResult->imgBase;

					$all_data=$response->CourseAvailListResult->Courses->alCourse;

					for($u=0;$u< count($all_data);$u++)

					{

					   $save_index[]=$all_data[$u]->ratingCnt;

					}

					arsort($save_index);

					

					//sorting of all ratingcnt save in $save_index 

					foreach($save_index as $key=>$val)

					{

					   $result1[] =$all_data[$key];

					} 

					

					//pagination

					$record_per_page=20;

					$last_record=$page_start_from+$record_per_page;

					$j=count($result1);

					for($i=$page_start_from;$i<$last_record;$i++)

					{

						if($i<$j)

						$result[]=$result1[$i];

					}

					$results['result']=$result;

					$mypaging['total_rows']=count($save_index);

					$pagination=1;

				 }

			  }

			  

			  

			  if($para=='rating')

			  {

			    //if record is single

				$single_record=count($response->CourseAvailListResult->Courses->alCourse);

				if($single_record==1)

				{

				   $results['result']=$response->CourseAvailListResult->Courses->alCourse;

				   $results['imgpath']=$response->CourseAvailListResult->imgBase;

				   $pagination=0;

				}

				else//if records are more than one

				{

					$results['imgpath']=$response->CourseAvailListResult->imgBase;

					$all_data=$response->CourseAvailListResult->Courses->alCourse;

					for($u=0;$u< count($all_data);$u++)

					{

					   $save_index[]=$all_data[$u]->rating;

					}

					arsort($save_index);

					

					//sorting of all rating save in $save_index

					foreach($save_index as $key=>$val)

					{

					   $result1[] =$all_data[$key];

					} 

					

					//pagination

					$record_per_page=20;

					$last_record=$page_start_from+$record_per_page;

					$j=count($result1);

					for($i=$page_start_from;$i<$last_record;$i++)

					{

						if($i<$j)

						$result[]=$result1[$i];

					}

					$results['result']=$result;

					$mypaging['total_rows']=count($save_index);

					$pagination=1;

				 }	

			   }

			  

			  //pagination for all above checks.....

			   if(@$pagination==1)

			   {

					$mypaging['base_url']=base_url()."teetime_golfcourse/sorting/".$para.'/';

					$mypaging['per_page']=$record_per_page;

					$mypaging['uri_segment']=4;

					$this->pagination->initialize($mypaging);

					$results['paginglink']=$this->pagination->create_links();

					

					$results['records']='not_empty';

				    $results['option']='first';

					//show on page pagination info...

					$results['first_no']=$page_start_from+1;

					$results['last_no']=$last_record;

					$results['total_no']=$j;

					//end show on page pagination info...

			   }

			   if(@$pagination==0)

			   {

					$results['records']='not_empty';

				    $results['option']='first';

					//show on page pagination info...

					$results['first_no']=1;

					$results['last_no']=1;

					$results['total_no']=1;

					//end show on page pagination info...

			   }

			   

				//////city wise/////////

				$results['city_wise']='no';

				////end city wise///////

				////////left hand all area and city blue////////

				$results['left_area_city']	='not_selected';

				////////end left hand all area and city blue//// 

			   $data1['contents']=$this->load->view('golf_course_listing',$results,true);	

			    $data1['golf_course_page']=1;

			   $data1['my_title']='Golf Course';$this->load->view('template',$data1);

			 //} //end of check one

			

			 //if course id is not empty.	  

			/* if($course_id!='')

			 {

				redirect('teetime_golfcourse/golf_course');

			 }*/  

	   }//end of function sorting miles 

	

	

	

	

	

	

	

	

	

	

	

	

	

	

	

	/////////////////////////////////////////////////////////////

	/////////////////////////////////////////////////////////////

	/////////if we come in this controller multi menu is not display///////////

	////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////

	

	

	

	

	

	

	

	function state($para,$country_id,$state_id,$page_start_from=0)

	{

	$state_id=urldecode($state_id);

	$this->session->set_userdata('country_id',$country_id);

	$this->session->set_userdata('state_id',$state_id);

	$this->session->set_userdata('area_id','');

	$this->session->set_userdata('course_id','');

	

	$fin_date=$this->session->userdata('fin_date');

	if($fin_date=='')

	$fin_date=time();

	$this->session->set_userdata('fin_date',$fin_date);

	$f_date=date('Y-m-d',$fin_date);

	

	$players=$this->session->userdata('players');

	if($players=='')

	$players=1;

	$this->session->set_userdata('players',$players);

	

	$times=$this->session->userdata('times');

	if($times=='')

	$times="0600";

	$this->session->set_userdata('times',$times);

	

			

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

															"Area"=>'',

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

		

			 //print_r($response);

			 //exit;

			 if($para=='golfcourse')

		     {

			    //check record are empty or not

			    if($response->CourseAvailListResult->RetCd==0)

			    {	

					$single_record=count($response->CourseAvailListResult->Courses->alCourse);

					//if record is single

					if($single_record==1)

					{

						$results['result']=$response->CourseAvailListResult->Courses->alCourse;

						$results['imgpath']=$response->CourseAvailListResult->imgBase;

						//show on page pagination info...

						$results['first_no']=1;

						$results['last_no']=1;

						$results['total_no']=1;

						//end show on page pagination info...

					}

					else

					{

						$results['imgpath']=$response->CourseAvailListResult->imgBase;

						

						//pagination

						$record_per_page=20;

						$last_record=$page_start_from+$record_per_page;

						

						$j=count($response->CourseAvailListResult->Courses->alCourse);

						//show on page pagination info...

						$results['first_no']=$page_start_from+1;

						$results['last_no']=$last_record;

						$results['total_no']=$j;

						//end show on page pagination info...

						$result=array();

						for($i=$page_start_from;$i<$last_record;$i++)

						{

							if($i<$j)

							$result[]=$response->CourseAvailListResult->Courses->alCourse[$i];

						}

						

						$results['result']=$result;

						$mypaging['total_rows']=count($response->CourseAvailListResult->Courses->alCourse);

						$mypaging['base_url']=base_url()."teetime_golfcourse/state/".$para.'/'.$country_id.'/'.$state_id;

						$mypaging['per_page']=$record_per_page;

						$mypaging['uri_segment']=6;

						$this->pagination->initialize($mypaging);

						$results['paginglink']=$this->pagination->create_links();

					}

					$results['records']='not_empty';

					$results['option']	='first';

					//////not city wise///////

					$results['city_wise']='no';

					//////end not city wise////////

					////////left hand all area and city blue////////

					$results['left_area_city']	='selected';

					////////end left hand all area and city blue////

					$data1['contents']=$this->load->view('golf_course_listing',$results,true);

					 $data1['golf_course_page']=1;	

					$data1['my_title']='Golf Course';$this->load->view('template',$data1);

				}

				else

				{

					$results['result']='';

					$results['records']='empty';

					$results['option']	='first';

					$data1['contents']=$this->load->view('golf_course_listing',$results,true);

					 $data1['golf_course_page']=1;	

					$data1['my_title']='Golf Course';$this->load->view('template',$data1);

				}

		     }			

		

		

		

		

		

		

		

		

		 if($para=='teetime')

		 {

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

				$results['fin_date']=$f_date;

				$results['times']=$times;

				

				$results['sort']='times';

				$results['filter']='all_day';

				

				$data1['contents']=$this->load->view('all_course_avail_listing',$results,true);

				$data1['my_title']='TeeTime';$this->load->view('template',$data1);

				

				

		     }

	   }//end of function state

	

	

		

	

	

	

	function area($para,$country_id,$state_id,$area_id,$page_start_from=0)

	{

		$page_start_from=urldecode($page_start_from);

		$area_id= urldecode($area_id);

		

		if($area_id=='Napa')

		$area_id='Napa/Sonoma';

		if($page_start_from=='Sonoma')

		$page_start_from=0;

		

		if($area_id=='Castle Rock')

		$area_id='Castle Rock/Larkspur';

		if($page_start_from=='Larkspur')

		$page_start_from=0;

		

		if($area_id=='Ft. Myers')

		$area_id='Ft. Myers/Naples';

		if($page_start_from=='Naples')

		$page_start_from=0;

		

		if($area_id=='Miami ')

		$area_id='Miami / Ft. Lauderdale';

		if($page_start_from==' Ft. Lauderdale')

		$page_start_from=0;

		

		if($area_id=='Panama City ')

		$area_id='Panama City / Pensacola';

		if($page_start_from==' Pensacola')

		$page_start_from=0;

		

		

		

		if($area_id=='Dallas')

		$area_id='Dallas/Ft. Worth';

		if($page_start_from=='Ft. Worth')

		$page_start_from=0;

		

		if($area_id=='Lake Ozark')

		$area_id='Lake Ozark/Springfield';

		if($page_start_from=='Ft. Springfield')

		$page_start_from=0;

		

		

		if($this->uri->segment(8)!='')

		$page_start_from=$this->uri->segment(8);

		

		$arr=explode(' ',$area_id);

		if(!empty($arr) && $arr[0]=='Hawaii')

		{

			$area_id='Hawaii (Big Island)';

		}

		

		$state_id= urldecode($state_id);

		$this->session->set_userdata('country_id',$country_id);

		$this->session->set_userdata('state_id',$state_id);

		$this->session->set_userdata('area_id',$area_id);

		$this->session->set_userdata('course_id','');

		

		$fin_date=$this->session->userdata('fin_date');

		if($fin_date=='')

		$fin_date=time();

		$this->session->set_userdata('fin_date',$fin_date);

		$f_date=date('Y-m-d',$fin_date);

		

		$players=$this->session->userdata('players');

		if($players=='')

		$players=1;

		$this->session->set_userdata('players',$players);

		

		$times=$this->session->userdata('times');

		if($times=='')

		$times="0600";

		$this->session->set_userdata('times',$times);

		

				

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

		

		

		

		if($para=='golfcourse')

		{

					//if record found.

					if($response->CourseAvailListResult->RetCd==0)

					{

						$single_record=count($response->CourseAvailListResult->Courses->alCourse);

						if($single_record==1)

						{

							

							$results['result']=$response->CourseAvailListResult->Courses->alCourse;

							$results['imgpath']=$response->CourseAvailListResult->imgBase;

							//show on page pagination info...

							$results['first_no']=1;

							$results['last_no']=1;

							$results['total_no']=1;

							//end show on page pagination info...

						}

						else

						{

							$results['imgpath']=$response->CourseAvailListResult->imgBase;

							$record_per_page=20;

							$last_record=$page_start_from+$record_per_page;

						

							$j=count($response->CourseAvailListResult->Courses->alCourse);

							//show on page pagination info...

							$results['first_no']=$page_start_from+1;

							$results['last_no']=$last_record;

							$results['total_no']=$j;

							//end show on page pagination info...

							$result=array();

							for($i=$page_start_from;$i<$last_record;$i++)

							{

								if($i<$j)

								$result[]=$response->CourseAvailListResult->Courses->alCourse[$i];

							}

							

							$results['result']=$result;

							

							$mypaging['total_rows']=count($response->CourseAvailListResult->Courses->alCourse);

							

							

							if($this->uri->segment(8)=='')

							{

								$mypaging['base_url']=base_url()."teetime_golfcourse/area/".$para.'/'.$country_id.'/'.$state_id.'/'.$area_id;

								$mypaging['uri_segment']=7;

							}

							else if($this->uri->segment(8)!='')

							{//if / have between area name  

								$mypaging['base_url']=base_url()."teetime_golfcourse/area/".$para.'/'.$country_id.'/'.$state_id.'/'.$area_id.'/'.$this->uri->segment(8);

								$mypaging['uri_segment']=8;

							}//end if / have between area name  

							

							$mypaging['per_page']=$record_per_page;

							$this->pagination->initialize($mypaging);

							$results['paginglink']=$this->pagination->create_links();

							}

							$results['records']='not_empty';

							$results['option']	='first';

							//////not for city wise///////

							$results['city_wise']='no';

							//////end not for city wise////////

							////////left hand all area and city blue////////

							$results['left_area_city']	='area_selected';

							////////end left hand all area and city blue////

							$data1['contents']=$this->load->view('golf_course_listing',$results,true);	

							 $data1['golf_course_page']=1;

							$data1['my_title']='Golf Course';$this->load->view('template',$data1);

							}

						

						else

						{

							$results['result']='';

							$results['records']='empty';

							$results['option']	='first';

							$data1['contents']=$this->load->view('golf_course_listing',$results,true);

							 $data1['golf_course_page']=1;	

							$data1['my_title']='Golf Course';$this->load->view('template',$data1);

						}

			 }

			 if($para=='teetime')

			 {

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

					$results['fin_date']=$f_date;

					$results['times']=$times;

					

					$results['sort']='times';

					$results['filter']='all_day';

					

					$data1['contents']=$this->load->view('all_course_avail_listing',$results,true);

					$data1['my_title']='TeeTime';$this->load->view('template',$data1);     

			 }

	}

	

	

	

	

	

	

	

	function courses($para,$course_id)

	{

		$this->session->set_userdata('course_id',$course_id);

		

		$fin_date=$this->session->userdata('fin_date');

		if($fin_date=='')

		$fin_date=time();

		$this->session->set_userdata('fin_date',$fin_date);

		$fin_date=date('Y-m-d',$fin_date);

		

		$players=$this->session->userdata('players');

		if($players=='')

		$players=1;

		$this->session->set_userdata('players',$players);

		

		$times=$this->session->userdata('times');

		if($times=='')

		$times="0600";

		$this->session->set_userdata('times',$times);

	

		if($para=='teetime')

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

					

					   if(isset($course_arr->Dates->alDate->Times->caTime))

					   {

						   $tim=$course_arr->Dates->alDate->Times->caTime;

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

				$data1['my_title']='TeeTime';$this->load->view('template',$data1);

			

		}



	}

	

	

	

	



	





}?>