<div class="navigation_right">

        

      </div>



</div>













<link rel="stylesheet" href="<?php echo base_url()?>asserts/css/themes/jquery.ui.all.css">

	<script  src="<?php echo base_url()?>asserts/js/jquery-1.8.1.js"></script>

	<script src="<?php echo base_url()?>asserts/js/ui/jquery.ui.core.js"></script>

	<script src="<?php echo base_url()?>asserts/js/ui/jquery.ui.widget.js"></script>

	<script src="<?php echo base_url()?>asserts/js/ui/jquery-ui-1.8.23.custom.js"></script>

	<script src="<?php echo base_url()?>asserts/js/ui/jquery.ui.datepicker.js"></script>

	<link rel="stylesheet" href="<?php echo base_url()?>asserts/css/demos.css">

	

	

	<script type="text/javascript" src="<?php echo base_url()?>asserts/js/site_js/easySlider1.7.js"></script>

	<script type="text/javascript">

		$(document).ready(function(){	

			$("#slider").easySlider({

				auto: true, 

				continuous: true,

				numeric: true

			});

		});	

	</script>

	











<?php





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

	{

	 $country=$response->AreasResult->Countries->Country;

     $area_arr_id='';

	 $area_arr_nm='';

	 $region_arr_id='';

	 $region_arr_nm='';

	 $country_arr_id='';

	 $country_arr_nm='';

	  for($i=0; $i<count($country);$i++)

	  {//country data

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

				 {

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

				 } 

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

					 {

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

					 } 

				 }

		    }//end if region data is more than single

			

			

			

			

		$client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");

			$response2 = $client->CourseList(array("Hdr"=>array("ResellerId"=>"WPA",

														"PartnerId"=>"",

														"SourceCd"=>"A","Lang"=>"en",

														"UserIp"=>"66.147.244.227",

														"UserSessionId"=>"",

														"AccessKey"=>"",

														"Agent"=>"",

														"gsSource"=>"",

														"gsDebug"=>true),

										"Req"=>array("CountryId"=>$country_arr_id,

													 "RegionId"=>"",

													 "Area"=>"",

													 "Latitude"=>"",

													 "Longitude"=>"",

													 "PostalCode"=>"",

													 "MaxDistance"=>"",

													 "MaxDistanceType"=>"",

													 "ShowAllStatus"=>"active",

													 "ShowDisConnected"=>"",

													 "FeaturedOnly"=>"",

													 "Sort"=>"")));

			

			

			

			if($response2->CourseListResult->RetCd==0)

			{

			   $course=$response2->CourseListResult->Courses->clCourse;

			   if(count($course)==1)

			   {

			        $db_fields['id']=$course->id;

					$db_fields['xid']=$course->xid;

					$db_fields['nm']=$course->nm;

					$db_fields['cty']=$course->cty;

					$db_fields['st']=$course->st;

					$db_fields['cou']=$course->cou;

					$db_fields['sCou']=$course->sCou;

					$db_fields['sReg']=$course->sReg;

					$db_fields['sAr']=$course->sAr;

					$db_fields['lat']=$course->lat;

					$db_fields['lon']=$course->lon;

					$db_fields['advDays']=$course->advDays;

					$db_fields['insideDays']=$course->insideDays;

					$db_fields['dist']=$course->dist;

					$db_fields['promo']=$course->promo;

					$db_fields['rating']=$course->rating;

					$db_fields['img']=$course->img;

					$this->common_model->insert_array('gama_courses',$db_fields);

					$db_fields='';

			   }

			   else if(count($course)>1)

			   {

			      for($g=0;$g<count($course);$g++)

				  {

					$db_fields['id']=$course[$g]->id;

					$db_fields['xid']=$course[$g]->xid;

					$db_fields['nm']=$course[$g]->nm;

					$db_fields['cty']=$course[$g]->cty;

					$db_fields['st']=$course[$g]->st;

					$db_fields['cou']=$course[$g]->cou;

					$db_fields['sCou']=$course[$g]->sCou;

					$db_fields['sReg']=$course[$g]->sReg;

					$db_fields['sAr']=$course[$g]->sAr;

					$db_fields['lat']=$course[$g]->lat;

					$db_fields['lon']=$course[$g]->lon;

					$db_fields['advDays']=$course[$g]->advDays;

					$db_fields['insideDays']=$course[$g]->insideDays;

					$db_fields['dist']=$course[$g]->dist;

					$db_fields['promo']=$course[$g]->promo;

					$db_fields['rating']=$course[$g]->rating;

					$db_fields['img']=$course[$g]->img;

					$this->common_model->insert_array('gama_courses',$db_fields);

					$db_fields='';

				  }

			   }

			   

			

			}

			

			

			

			

			

	    }

	 }

	

	

	

	

	

	

	

	exit;

	

	

	

	

	

	//$countryArr = $response->AreasResult->Countries->Country;

	//print_r($countryArr);

 //echo "<pre>";	

	





?>







<script type="text/javascript">

function  country_change(country_id)

{

$('#country_id_hid').val(country_id);

$.ajax({

	type:'post',

	data:'country_id='+country_id,

	async:false,

	url:'<?php echo base_url()?>search_golfcourse/country_change',

	

    success:function(data){

	$('#state_div').html(data);



	}

	

});

}









function  state_change(state_id)

{

	$('#state_id_hid').val(state_id);

	var country_id=$('#country_id_hid').val();

	

	if(state_id!='')

	{

		$.ajax({

			type:'post',

			data:'state_id='+state_id+'&country_id='+country_id,

			//data: "jewellerId=" + filter+ "&locale=" +  locale,

			url:'<?php echo base_url()?>search_golfcourse/state_change',

			success:function(data){

			$('#area_div').html(data);

			}

			

		});

	}

	else

	{

	    $('#area_div').html('<select name="area_id" id="area_id"><option value="">--Any Area--</option></select>');

	}



}



function  area_change(area_id)

{

	$('#area_id_hid').val(area_id);

	var country_id=$('#country_id_hid').val();

	var state_id=$('#state_id').val();

	if(area_id!='')

    {

		$.ajax({

			type:'post',

			data:'state_id='+state_id+'&country_id='+country_id+'&area_id='+area_id,

			url:'<?php echo base_url()?>search_golfcourse/area_change',

			success:function(data){

			$('#course_div').html(data);

		

			}

		});

	}

	else

	{

		$('#course_div').html('<select name="course_id" id="course_id"><option value="">--Any Course--</option></select>');

	}	

}



</script>



<script>

	$(function() {

		$( "#datepicker" ).datepicker({ minDate: 0, maxDate: "+1M +10D" });

	});

	</script>





<div class="slider_outer">

		  <div id="slider">

            <ul>

              <li><img src="<?=base_url()?>asserts/images/slider_image1.png" alt="#" /> </li>

              <li><img src="<?=base_url()?>asserts/images/slider_image1.png" alt="#" /> </li>

              <li><img src="<?=base_url()?>asserts/images/slider_image1.png" alt="#" /> </li>

              <li><img src="<?=base_url()?>asserts/images/slider_image1.png" alt="#" /> </li>

              <li><img src="<?=base_url()?>asserts/images/slider_image1.png" alt="#" /> </li>

            </ul>

            <div class="clr"></div>

          </div>

        </div>

		

		

		

		

	<form method="post" name="" action="<?php echo base_url()?>search_golfcourse/search_teetimes">	

		<div id="content">

          <div id="home_content_left">

            <div class="search">

              <div class="search_top">

                <h3>Search for a Tee Time</h3>

                <div class="united">

<select name="country_id" id="country_id" onChange="country_change(this.value)">

<?

for($i=0;$i<count($countryArr);$i++)

{?>

<option value="<?php echo $countryArr[$i]->id?>"><?php echo $countryArr[$i]->nm?></option>

<? }?>

</select>

<input type="hidden" value="" id="country_id_hid">

                </div>

              </div>

              <div class="search_rpt">

                <div class="search_mid">

                  <ul>

                    <li>

                      <label>Region:</label>

                      <div class="region">

                        

						

						<div id="state_div">

						<select name="state_id" id="state_id">

						<option value="">--Any State--</option>

						</select>

						</div>

						<input type="hidden" id="state_id_hid" value="">

						

						

                      </div>

                    </li>

                    <li class="spacr">

                      <label>Area:</label>

                      <div class="region">

                        

					

					<div id="area_div">

					<select name="area_id" id="area_id">

					<option value="">--Any Area--</option>

					</select>

					</div>

					<input type="hidden" id="area_id_hid" value="">	

                      

					  </div>

                    </li>

                    <li>

                      <label>Course:</label>

                      <div class="region">

                        

					<div id="course_div">

					<select name="course_id" id="course_id">

					<option value="">--Any Course--</option>

					</select>

					</div>

						

                      </div>

                    </li>

                    <li class="spacr">

                      <label>Date:</label>

                      <div class="region">

                        

						<input type="text" name="datepicker" id="datepicker">

                        <a href="#"><img src="<?=base_url()?>asserts/images/lander.png" alt="#" /></a>

						

						</div>

                    </li>

                    <li>

                      <label>Time:</label>

                      <div class="region">

                       

					   

						<select name="times" id="times">

						<option value="500">5AM</option>

						<option value="600">6AM</option>

						<option value="700">7AM</option>

						<option value="800">8AM</option>

						<option value="900">9AM</option>

						<option value="1000">10AM</option>

						<option value="1100">11AM</option>

						<option value="1200">12AM</option>

						<option value="1300">1PM</option>

						<option value="1400">2PM</option>

						<option value="1500">3PM</option>

						<option value="1600">4PM</option>

						<option value="1700">5PM</option>

						</select>

                        

						

						

						<!--<a href="#"><img src="<?=base_url()?>images/lander2.png" alt="#" /></a>-->

						</div>

                    </li>

                    <li class="spacr">

                      <label>Players:</label>

                      <div class="region2">

					  <select name="players" id="players">

					  <option value="1">1</option>

					  <option value="2">2</option>

					  <option value="3">3</option>

					  <option value="4">4</option>

					  </select>

				<!--<input type="radio" id="players" name="players" value="1">1

				<input type="radio" id="players" name="players" value="2">2

				<input type="radio" id="players" name="players" value="3">3

				<input type="radio" id="players" name="players" value="4">4-->

                      </div>

                    </li>

                    <li>

                      <label>Promo Code:</label>

                      <div class="region3_outer">

                        <div class="region3">

                          <input type="text" value="" />

                        </div>

                        <a href="#"><img src="<?=base_url()?>asserts/images/lander3.png" alt="#" /></a> </div>

                    </li>

                    <li class="spacr">

                      <div class="region4">

					  <input type="hidden" name="my_submit" value="TRUE"> 

					  <input type="submit" style="cursor:pointer" name="submit" value="Search Tee Times"> </div>

                    </li>

                  </ul>

                  <div class="clr"></div>

                </div>

                <div class="clr"></div>

              </div>

              </form>

			  

			  

			  

			  

			  

			  <div class="search_bottom">

                <ul>

                  <li class="first_li"><a href="#">Additional Search Options </a></li>

                  <li>

                    <input type="checkbox" />

                    <label>Show redemption times only </label>

                  </li>

                  <li>

                    <input type="checkbox" />

                    <label>Show tee time specials only </label>

                  </li>

                </ul>

                <div class="clr"></div>

              </div>

            </div>

          </div>

          <div id="home_content_right">

			<? if($this->session->userdata('session_user_id')==''){?>

			<div class="register">

              <div class="register_top">

                <h4>Register now</h4>

              </div>

              <div class=" register_rpt">

                <div class="register_mid">

                  <ul>

                

				<li>    

				 <div class="input_error">

				<?

			if($this->session->userdata('msg_check')=='not_login')

			{

				if(validation_errors()!='')

				{

				echo validation_errors();

				}

				else

				{

					echo $this->session->userdata('user_front_msg');

					$this->session->set_userdata('user_front_msg','');

				}

				$this->session->set_userdata('msg_check','');

			 }

				?>

					</div>

					</li>

					

					

					

					<li>

                      <form method="post" action="<?=base_url()?>reserve_golfcourse/registration">

					  <label>Name:</label>

                      <div class="male">

                        <? @$user_fname=$this->input->post('user_fname');?>

						<input type="text" name="user_fname" value="<?=@$user_fname?>" />

                        <div class="clr"></div>

                      </div>

                      <div class="male">

                        <? @$user_lname=$this->input->post('user_lname');?>

						<input type="text" name="user_lname" value="<?=@$user_lname?>" />

                        <div class="clr"></div>

                      </div>

                    </li>

                    <li>

                      <label>Email:</label>

                      <div class="male2">

                        <? @$email=$this->input->post('email');?>

						<input type="text" name="email" value="<?=@$email?>" />

                      </div>

                    </li>

                    <li>

                      <label>Password:</label>

                      <div class="male2">

                        <? @$pasword=$this->input->post('pasword');?>

						<input type="password" name="pasword" value="<?=@$pasword?>" />

                      </div>

                    </li>

                    <li>

                      <label>Gender:</label>

                      <div class="male3">

                        <? @$gender=$this->input->post('gender');?>

						<select name="gender">

                          <option <? if(@$gender==1){?> selected="selected"<? }?> value="1">Male</option>

						   <option <? if(@$gender==2){?> selected="selected"<? }?> value="0">Female</option>

                        </select>

                      </div>

                      <small>DOB</small>

                      <div class="male4">

                        <?  @$days=$this->input->post('days');?>

						<select name="days">

                          <? for($i=1;$i<=30;$i++){?>

						  <option <? if(@$days!=''){if(@$days==$i){?> selected="selected"<? } }?> value="<?=$i?>"><?=$i?></option>

                          <? }?>

						</select>

                      </div>

                      <div class="male4">

					   <?  @$months=$this->input->post('months');?>

					  

                        <select name="months">

						  <? for($i=1;$i<=12;$i++){?>

                          <option <? if(@$months!=''){if(@$months==$i){?> selected="selected"<? }}?> value="<?=$i?>"><?=$i?></option>

                          <? }?>

						</select>

                      </div>

                      <div class="male5">

                        <?  @$years=$this->input->post('years');?>

						

						<select name="years">

                          <? $year=date('Y');

						  $last_year=date('Y', strtotime('-50 year'));

						  for($i=$year;$i>=$last_year;$i--){?>

						  <option <? if(@$years!=''){if(@$years==$i){?> selected="selected"<? }}?> value="<?=$i?>"><?=$i?></option>

						  <? }?>

                        </select>

                      </div>

                    </li>

                    <li>

                      <label>Country</label>

                      <div class="male2">

					   

					<?  $set_country=$this->input->post('country');?>

					  

					  <select name="country">

                          <option value="">select any</option>

                    <? $country_info=$this->common_model->select_all('name,fips_code','country');

					foreach($country_info->result() as $info)

					{?> 

						 <option <? if($set_country!=''){ if($set_country==$info->fips_code){?> selected="selected"<? } }?> value="<?=$info->fips_code ?>"><?=$info->name ?></option>

                 <? }?>

						</select>

                      </div>

                    </li>

                    <li class="last_li">

                      <input class="sum" type="submit"  style="cursor:pointer" value="Submit"  />

					  </form>

                    </li>

                  </ul>

                  <div class="clr"></div>

                </div>

                <div class="clr"></div>

              </div>

              <div class="register_bottom"></div>

            </div>

			<? }?>

          </div>

          <div class="clr"></div>

        </div>

		

		

		</div><!--wraper div end-->