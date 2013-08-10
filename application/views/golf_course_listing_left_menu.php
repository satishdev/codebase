   <!-- //use for datepicker-->
	<link rel="stylesheet" href="<?php echo base_url()?>asserts/css/themes/jquery.ui.all.css">
	
	<!--for dialog box-->
	<script src="<?php echo base_url()?>asserts/js/js_model/jquery.bgiframe-2.1.2.js"></script>
	<!--end for dialog box-->
		
	<script src="<?php echo base_url()?>asserts/js/ui/jquery.ui.core.js"></script>
	<script src="<?php echo base_url()?>asserts/js/ui/jquery.ui.widget.js"></script>
	<script src="<?php echo base_url() ?>asserts/js/js_model/jquery.ui.button.js"></script>
	<!--for dialog box-->
	<script src="<?php echo base_url()?>asserts/js/js_model/jquery.ui.position.js"></script>
	<script src="<?php echo base_url()?>asserts/js/js_model/jquery.ui.dialog.js"></script>
	<!--end for dialog box-->
	
	<script src="<?php echo base_url()?>asserts/js/ui/jquery-ui-1.8.23.custom.js"></script>
	<script src="<?php echo base_url()?>asserts/js/ui/jquery.ui.datepicker.js"></script>
	<link rel="stylesheet" href="<?php echo base_url()?>asserts/css/demos.css">
	<script>
	$(function() {
		$( "#datepicker" ).datepicker({ minDate: 0, maxDate: "+1M +10D" });
	});
	</script>
	<!--//end use for date picker-->
	
<input type="hidden" id="country_id_hid" />
<script>


$(document).ready(function(){
<? 
$country_id=$this->session->userdata('country_id');
$state_id=$this->session->userdata('state_id');

if($country_id=='' || $state_id=='')
{
	$country_id='USA';
	$state_id='AZ';
	$this->session->set_userdata('country_id',$country_id);
	$this->session->set_userdata('state_id',$state_id);
}


?>
country_change('<? echo $country_id;?>',1);
state_change('<? echo $state_id;?>');

<? //if($this->session->userdata('area_id')!=''){?>
//area_change('<?=$this->session->userdata('area_id')?>');
<? //}?>
})





function  country_change(country_id,state_set_unset)
{
	$('.state_class').removeClass('region');
	$('#my_state').html('<img src="<?=base_url()?>asserts/images/ajax-loader2.gif">');
	
	$('#country_id_hid').val(country_id);
	$.ajax({
		type:'post',
		data:'country_id='+country_id+'&state_set_unset='+state_set_unset,
		async:false,
		url:'<?php echo base_url()?>search_golfcourse/country_change',
		
		success:function(data){
		
		$('.state_class').addClass('region');
		$('#my_state').html(data);
		
		$('#my_area').html('<select><option>-- Any Area --</option></select>');
                    
		}
	});
}


function  state_change(state_id)
{
	$('.area_class').removeClass('region');
	$('#my_area').html('<img src="<?=base_url()?>asserts/images/ajax-loader2.gif">');
	
	var country_id=$('#country_id_hid').val();
	
	if(state_id!='')
	{
	$.ajax({
		type:'post',
		data:'state_id='+state_id+'&country_id='+country_id,
		//data: "jewellerId=" + filter+ "&locale=" +  locale,
		url:'<?php echo base_url()?>search_golfcourse/state_change',
		success:function(data){
		
		$('.area_class').addClass('region');
		$('#my_area').html(data);
		}
    });
	}
	else
	{
	    $('.area_class').addClass('region');
		$('#area_div').html('<select name="area_id" id="area_id"><option value="">--Any Area--</option></select>');
	}
}

</script>


<?php
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
									"Req"=>array("CountryId"=>"",
													"RegionId"=>"")));
	
	$countryArr = $response->AreasResult->Countries->Country;*/
	?>
<div id="content_left">
        <div class="arezona">
          <div class="arezona_top">
            <h4>SEARCH GOLF COURSES</h4>
          </div>
          <div class="arezona_mid">
            <form method="post" action="<?php echo base_url()?>teetime_golfcourse/golfcourse_form" onsubmit="hide_shows()">
			<div class="amazona_ineer">
              <ul>
                
				<li>
                  <label>Country:</label>
                  <div class="region">
	
	<? $countryArr=$this->common_model->select_all('*','gama_country');
$countryArr=$countryArr->result();
?>
	<select name="country_id" id="country_id" onChange="country_change(this.value,2)">
	<? for($i=0;$i<count($countryArr);$i++)
	{
		$select=0;
		$country_id=$this->session->userdata('country_id');
		if($country_id==$countryArr[$i]->id)
		{
		  $select=1;
		}?>
		<option <? if($select==1){?> selected="selected" <? }?> value="<?php echo $countryArr[$i]->id?>"><?php echo $countryArr[$i]->nm?></option>
	<? }?>
	</select>
	<input type="hidden" value="" id="country_id_hid">
				  
				  </div>
                </li>
				
				<li>
                  <label>Region:</label>
                  <div class="region state_class">
                    
					<div id="my_state">
					<select>
                      <option>-- Any Region --</option>
                    </select>
					</div>
                 
				  </div>
                </li>
                <li>
                  <label>Area:</label>
                  <div class="region area_class">
                    
					<div id="my_area">
					<select>
                      <option>-- Any Area --</option>
                    </select>
					</div>
                  
				  </div>
                </li>
                <li>
                  <label>Time:</label>
                  <div class="region">
				  
	<? @$sess_times=$this->session->userdata('times');?>
			  
<select name="times" id="times">
<option <? if(@$sess_times=='500'){?> selected="selected"<? }?> value="500">5AM</option>
<option <? if(@$sess_times=='600'){?> selected="selected"<? }?> value="600">6AM</option>
<option <? if(@$sess_times=='700'){?> selected="selected"<? }?> value="700">7AM</option>
<option <? if(@$sess_times=='800'){?> selected="selected"<? }?> value="800">8AM</option>
<option <? if(@$sess_times=='900'){?> selected="selected"<? }?> value="900">9AM</option>
<option <? if(@$sess_times=='1000'){?> selected="selected"<? }?> value="1000">10AM</option>
<option <? if(@$sess_times=='1100'){?> selected="selected"<? }?> value="1100">11AM</option>
<option <? if(@$sess_times=='1200'){?> selected="selected"<? }?> value="1200">12AM</option>
<option <? if(@$sess_times=='1300'){?> selected="selected"<? }?> value="1300">1PM</option>
<option <? if(@$sess_times=='1400'){?> selected="selected"<? }?> value="1400">2PM</option>
<option <? if(@$sess_times=='1500'){?> selected="selected"<? }?> value="1500">3PM</option>
<option <? if(@$sess_times=='1600'){?> selected="selected"<? }?> value="1600">4PM</option>
<option <? if(@$sess_times=='1700'){?> selected="selected"<? }?> value="1700">5PM</option>
</select>
                    <!--<a href="#"><img src="<?=base_url()?>images/lander2.png" alt="#" /></a>--></div>
                </li> 
                <!--<li>
                  <label>Course:</label>
                  <div class="region">
                    <select>
                      <option>-- Any Course --</option>
                    </select>
                  </div>
                </li>-->
                <li>
                  <label>Date:</label>
                  <div class="region">
				<? 
				@$sess_date=$this->session->userdata('fin_date');
				@$sess_date=date('m/d/Y',$sess_date);
				?>
				<input type="text" name="datepicker" id="datepicker" value="<?=@$sess_date?>" width="100px" height="30px" style="position:relative; z-index:1; width:165px;">
                    <a href="#" style="margin-left:-17px;"><img src="<?=base_url()?>asserts/images/lander.png" alt="#" /></a></div>
                </li>
                
                <li>
                  <label>Players:</label>
                  <div class="region2">
	<? @$sess_players=$this->session->userdata('players');?>
	
	<select name="players" id="players">
	<option <? if(@$sess_players==1){?> selected="selected"<? }?> value="1">1</option>
	<option <? if(@$sess_players==2){?> selected="selected"<? }?> value="2">2</option>
	<option <? if(@$sess_players==3){?> selected="selected"<? }?> value="3">3</option>
	<option <? if(@$sess_players==4){?> selected="selected"<? }?> value="4">4</option>
	</select>
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
                <li class="last_li">
                  <div class="region4_1"><input style="font-size:12px;" type="submit" value="Search Golf Courses" /> </div>
                </li>
              </ul>
              <div class="clr"></div>
            </div>
			</form>
          </div>
          <div class="arezona_bottom"></div>
        </div>
       <!-- <div class="mape"> <img src="<?=base_url()?>images/mape.png" alt="#" /> </div>-->
        
		
		
	<!--start google map in a popup-->
	<script>
	function dialog_show()
	{
		$(function() {
			$( "#dialog-modal" ).dialog({
				height: 560,
				width: 678,
				//left:174.5,
				modal: true
			});
		});
		$("#gt").removeClass("mape_large");
	}
	</script>
		
	<style>
      body{
        text-align:center;
      }
      .gmap3{
        margin: 20px auto;
        border: 1px dashed #C0C0C0;
        width: 633px;
        height: 550px;
		margin-top:0px;
      }
	  .mape_large{ 
	   visibility:hidden; height:0px;
	  }
	  #phar{
	  width:318px;
	  height:300px;
	  }
    </style> 
	<div id="dialog-modal" title="All Golf Courses Map Addresses">
		<!--google map-->
		<div class="mape_large" id="gt">
		<div  class="gmap3 frt"  ></div>
		</div>
		<!--end google map-->
	</div> 
	<li><a href="#." onclick="dialog_show('map')">Large View</a></li>	
	<!--end start google map in a popup-->	
	
	
	<!--google map-->
		<div id="phar"  class="gmap3 frt"  ></div>
		<!--end google map-->	
		
		
		<div class="arezona">
          <div class="arezona_top arezona_top2">
           <h4 <? if($this->session->userdata('hid_filter')!=''){?> class="my_selected_color" <? }?>>FILTER RESULTS BY:</h4>
          </div>
          <div class="arezona_mid2">
            <div class="filter">
              <label>Price:</label>
              <div class="price">
                <div class="price_top"></div>
                <div class="price_rpt">
                  <div class="price_mid">
                    <ul>
<? 
	 $first=0;
	 $second=0;
	 $third=0;
	 $fourth=0;
	 $fifth=0;
	 $sixth=0;
	 @$hid_filter=$this->session->userdata('hid_filter');
	 if($hid_filter=='TRUE')
	 {
		  $price_filtration=$this->session->userdata('price_filtration');
		  if(!empty($price_filtration))
		  {
			  foreach($price_filtration as $key=>$val)
			  {
				if($key==0)
				{
				$first=1;
				}
				
				if($key==25)
				{
				$second=1;
				}
				
				if($key==50)
				{
				$third=1;
				}
				
				if($key==75)
				{
				$fourth=1;
				}
				
				if($key==100)
				{
				$fifth=1;
				}
				
				if($key==125)
				{
				$sixth=1;
				}
			 }
	      }
	  }
	  ?>
					  
					  <form method="post" action="<?=base_url()?>teetime_golfcourse/price_filtration">
					  <!--<li>
                        <input type="checkbox" />
                        <small>Specials Only</small> </li>-->
                      <li>
                         <input type="checkbox" <? if($first==1){?> checked="checked" <? }?> name="price_filtration[0]" value="25" />
                        <small <? if($first==1){?> class="my_selected_color" <? }?>>Less than 25.00€</small> </li>
                      <li>
                       <input type="checkbox" <? if($second==1){?> checked="checked" <? }?> name="price_filtration[25]" value="50" />
                        <small <? if($second==1){?> class="my_selected_color" <? }?>>25.00€ - 50.00€ </small> </li>
                      <li>
                        <input type="checkbox" <? if($third==1){?> checked="checked" <? }?> name="price_filtration[50]" value="75" />
                        <small <? if($third==1){?> class="my_selected_color" <? }?>>50.00€ - 75.00€ </small> </li>
                      <li>
                       <input type="checkbox" <? if($fourth==1){?> checked="checked" <? }?> name="price_filtration[75]" value="100" />
                        <small <? if($fourth==1){?> class="my_selected_color" <? }?>>75.00€ - 100.00€ </small> </li>
                      <li>
                        <input type="checkbox" <? if($fifth==1){?> checked="checked" <? }?> name="price_filtration[100]" value="125" />
                        <small <? if($fifth==1){?> class="my_selected_color" <? }?>>100.00€ - 125.00€ </small> </li>
                      <li>
                        <input type="checkbox" <? if($sixth==1){?> checked="checked" <? }?> name="price_filtration[125]" value="0" />
                        <small <? if($sixth==1){?> class="my_selected_color" <? }?>>125.00€+ </small> </li>
                    </ul>
                    <div class="clr"></div>
                  </div>
                </div>
                <div class="price_bottom"></div>
                <div class="clr"></div>
              </div>
              <div class="region4_1"> 
			  <input type="hidden"  name="hid_filter" value="TRUE" />
			  <input type="submit" value="Update Result" /> 
			  </form>
			  </div>
              <div class="clr"></div>
            </div>
            <div class="clr"></div>
          </div>
          <div class="arezona_bottom"></div>
          <div class="clr"></div>
        </div>
		
		
		
			
		<div class="arezona">
          <div class="arezona_top">
            <h4><?=@$this->session->userdata('my_golfcourse_heading')?> Golf Courses</h4>
          </div>
          <div class="arezona_mid">
            <div class="amazona_ineer2">
              <ul>
               
			  
			  
			  
		<?
		$fin_date=$this->session->userdata('fin_date');
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
			
		   $main=$response->CourseAvailListResult->Courses->alCourse;
		   $total=count($main);
		   
		//if record is single
		if($total==1)
		{
			$area=$main->sAr;
			$cty=$main->cty;
			echo '<li><a  class="select"  href="'.base_url().'teetime_golfcourse/area_wise/'.$area.'"><span>'.$area.'(1)</span></a>';	  
			echo '<small><a class="select"  href="'.base_url().'teetime_golfcourse/city_wise/'.$area.'/'.$cty.'">'.$cty.'</a></small></li>';
		}//end if record is single
		
		
		//if record is more than single
		if($total>1)
		{
		   $area_save=array();
		   $city_save=array();
		   $u=0;   
			   
		  //if click of dropdown state all selected
		   $li=0; //manage <li> 
		   if(@$left_area_city=='selected')
		   {
			   for($i=0;$i<$total;$i++)
			   {
				 $area=$main[$i]->sAr;
				 $cty=$main[$i]->cty;
				 
					 if(in_array($area,$area_save))
					 {//second if area equal to every time saved area array.
						if(in_array($cty,$city_save))
						{//third if city equal to every time saved city array.
						//empty
						}
						else
						{
							if($u==5)
							{
							  $u=0;
							}
							echo '<small><a class="select"  href="'.base_url().'teetime_golfcourse/city_wise/'.$area.'/'.$cty.'">'.$cty.'</a>,</small>';
							$city_save[]=$cty;
							$u++;
						}
					 }//end second if
					 else
					 {//second else
						
						//count how many city of this area
						$city_count=0;
						for($d=0;$d<$total;$d++)
						{
							if(strcmp($area,$main[$d]->sAr)==0)
							$city_count++;
						}
						//end count how many city of this area
						
						if($li==1)
						echo '</li>';
						
						echo '<li><a  class="select"  href="'.base_url().'teetime_golfcourse/area_wise/'.$area.'"><span>'.$area.'('.$city_count.')</span></a>';              
						$area_save[]=$area;
						$li=1;
						$u=0;
						
						if(in_array($cty,@$city_save))
						{
						//empty
						}
						else
						{
							if($u==5)
							{
							  $u=0;
							}
							echo '<small><a  class="select" href="'.base_url().'teetime_golfcourse/city_wise/'.$area.'/'.$cty.'">'.$cty.'</a>,</small>';
							$city_save[]=$cty;
							$u++;
						}
					  }//end second else
			   }//end for loop										
		   }//end if click of dropdown state all selected
		   else
		   {//if click of left hand link
			  if(@$city_wise=='yes')
			  {
				   //find area of city which city you click.
				   for($i=0;$i<$total;$i++)
				   {
					   //save click city in another variable
					   @$click_city=@$city;
					   $cty=$main[$i]->cty;
					   $null_city=strcmp($click_city,$cty);
					   if($null_city==0)
					   {
						   @$area_click_city=$main[$i]->sAr;
						   break;
					   }
					}
			   }
			   
			   if(@$area_wise=='yes')
			   {
				  @$area_click_city=@$area_val;
			   }
			   
			   
			   //first show the area and city of those city or area who clicked 
			   for($i=0;$i<$total;$i++)
			   {
				 $area=$main[$i]->sAr;
				 $cty=$main[$i]->cty;
				 
				 if(strcmp($area,@$area_click_city)==0)
				 {//first if
					 if(in_array($area,$area_save))
					 {//second if
						if(in_array($cty,$city_save))
						{
						//empty
						}
						else
						{
							if($u==5)
							{
							  $u=0;
							}
							
							//check who city selected
							if(@$area_wise=='yes')
							{
							   $selected='class="select"';
							}
							if(@$city_wise=='yes')
							{
								$selected='';
								if(strcmp($cty,@$click_city)==0)
								{
								   $selected='class="select"';
								}
							}
							//end check who city selected
							
							echo '<small><a '.$selected.' href="'.base_url().'teetime_golfcourse/city_wise/'.$area.'/'.$cty.'">'.$cty.'</a>,</small>';
							$city_save[]=$cty;
							$u++;
						}
					 }//end second if
					 else
					 {//second else
						
						//count how many city of this area
						$city_count=0;
						for($d=0;$d<$total;$d++)
						{
							if(strcmp($area,$main[$d]->sAr)==0)
							$city_count++;
						}
						//end count how many city of this area
						
						if($li==1)
						echo '</li>';
						
						echo '<li><a class="select"  href="'.base_url().'teetime_golfcourse/area_wise/'.$area.'"><span>'.$area.'('.$city_count.')</span></a>';
						$li=1;
						$area_save[]=$area;
						$u=0;
						
						if(in_array($cty,$city_save))
						{
						//empty
						}
						else
						{
							if($u==5)
							{
							  $u=0;
							}
							
							//check who city selected
							if(@$area_wise=='yes')
							{
							   $selected='class="select"';
							}
							if(@$city_wise=='yes')
							{
								$selected='';
								if(strcmp($cty,@$click_city)==0)
								{
								   $selected='class="select"';
								}
							}
							//end check who city selected
							
							echo '<small><a '.$selected.' href="'.base_url().'teetime_golfcourse/city_wise/'.$area.'/'.$cty.'">'.$cty.'</a>,</small>';
							$city_save[]=$cty;
							$u++;
						}
					  }//end second else
				  }//first if
			   }//end first show the area of those city who click		
			   
			   
			   //show other areas
			   for($i=0;$i<$total;$i++)
			   {
				 $area=$main[$i]->sAr;
				 $cty=$main[$i]->cty;
				 
				 if(strcmp($area,@$area_click_city)!=0)
				 {//first if area equal to the click city area.
					 if(in_array($area,$area_save))
					 {//second if area equal to every time saved area array.
						if(in_array($cty,$city_save))
						{//third if city equal to every time saved city array.
						//empty
						}
						else
						{
							if($u==5)
							{
							  $u=0;
							}
							echo '<small><a  href="'.base_url().'teetime_golfcourse/city_wise/'.$area.'/'.$cty.'">'.$cty.'</a>,</small>';
							$city_save[]=$cty;
							$u++;
						}
					 }//end second if
					 else
					 {//second else
						
						//count how many city of this area
						$city_count=0;
						for($d=0;$d<$total;$d++)
						{
							if(strcmp($area,$main[$d]->sAr)==0)
							$city_count++;
						}
						//end count how many city of this area
						
						if($li==1)
						echo '</li>';
						
						echo '<li><a  href="'.base_url().'teetime_golfcourse/area_wise/'.$area.'"><span>'.$area.'('.$city_count.')</span></a>';
						$area_save[]=$area;
						$u=0;
						$li=1;
						
						if(in_array($cty,@$city_save))
						{
						//empty
						}
						else
						{
							if($u==5)
							{
							  $u=0;
							}
							echo '<small><a href="'.base_url().'teetime_golfcourse/city_wise/'.$area.'/'.$cty.'">'.$cty.'</a>,</small>';
							$city_save[]=$cty;
							$u++;
						}
					  }//end second else
				  }//end first if 
			   }//end show other areas									
		   }//end if click of left hand link
		   echo '</li>';
	   }//end if record is more than single
	   
	  
?>
			   
                
              </ul>
              <div class="clr"></div>
            </div>
          </div>
          <div class="arezona_bottom"></div>
        </div>
        
		
		
		
		
		
		
		
		<div class="arezona">
          <div class="arezona_top arezona_top2">
            <h4><?=@$this->session->userdata('my_golfcourse_heading')?> popularity rankings</h4>
          </div>
          <div class="arezona_mid2">
            <div class="numaric">
              <ul>
                
				
				<? 
				//sorting of golf courses according to their rating
				$main=$response->CourseAvailListResult->Courses->alCourse;
				$total=count($main);
				if($total==1)
				{//if record is single?>
					<li>
					<div class="holt_left gray">
					<label>1</label>
					</div>
					<div class="holt gray">
					<a href="<?=base_url()?>search_golfcourse/search_teetimes_two/<?=$main->id?>"><? echo $main->nm;?> </a>
					<p><? echo $main->cty.','.$main->sReg;?></p>
					</div>
					</li>
			 <? }//end if record is single
				
				if($total>1)
				{//if recods are more than single
					for($i=0;$i<$total;$i++)
					{
					   $all_rating[$i]=$main[$i]->rating;
					}
					arsort($all_rating);
					$i=0;
					foreach($all_rating as $key=>$val)
					{
						$i++;?>
						<li>
						<div <? if($i%2!=0){?>class="holt_left gray"<? }else{?> class="holt_left"<? }?>>
						<label><? echo $i;?></label>
						</div>
						<div <? if($i%2!=0){?>class="holt gray"<? }else{?> class="holt"<? }?>>
						<a href="<?=base_url()?>search_golfcourse/search_teetimes_two/<?=$main[$key]->id?>"><? echo $main[$key]->nm;?> </a>
						<p><? echo $main[$key]->cty.','.$main[$key]->sReg;?></p>
						</div>
						</li>
						<? 
						if($i==5)
						{
						   break;
						}
					}//end sorting of golf courses according to their rating
				}//end if recods are more than single
				?>
				
	           </ul>
              <div class="clr"></div>
            </div>
            <div class="clr"></div>
          </div>
          <div class="arezona_bottom"></div>
          <div class="clr"></div>
        </div>
      </div>	
	  
	  
	  
	  
	
	
	<!--
	////////////////////
	//show Map View ///
	///////////////////
	-->
	<?
	        $country_id=$this->session->userdata('country_id');
			$state_id=$this->session->userdata('state_id');
			if($country_id=='' || $state_id=='')
			{
				$country_id='USA';
				$state_id='CA';
			}
			
			$area_id=$this->session->userdata('area_id');
	
	       $client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");
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
	
		  //if($response->CourseListResult->RetCd==0)
		  $all_clcourse=$response->CourseListResult->Courses->clCourse;
	
	
	?>
	
	
	
	
	
	
	<script type="text/javascript">
      $(function(){
      
        $('.frt')
          .gmap3(
          { action:'init',
            options:{
           <? if(count($all_clcourse)==1)
			  {?>
				  center:['<?=$all_clcourse->lat?>','<?=$all_clcourse->lon?>'],
		   <? }
		      else
		      {
				  for($i=0;$i<count($all_clcourse);$i++)
				  {
					if($all_clcourse[$i]->lat==0 || $all_clcourse[$i]->lon==0)
					{
					   continue;
					}?>
				     center:['<?=$all_clcourse[1]->lat?>','<?=$all_clcourse[1]->lon?>'],
				  <? break;
			       }
			    }?>
			  zoom: 5
            }
          },
          { action: 'addMarkers',
		   markers:[
		   
	 <?php  if(count($all_clcourse)==1)
			{
			   $go_page=base_url().'search_golfcourse/spcfic_goglelink/'.$all_clcourse->id;
				$promo=addslashes($all_clcourse->promo);
				$promo = preg_replace("/[\r\n]+/","", $promo);
				?>
				{lat:'<?=$all_clcourse->lat?>', lng:'<?=$all_clcourse->lon?>', data:'<a href="<?=$go_page?>"><?=$all_clcourse->nm?></a><br><?=$promo?>'},  
		<?  }
			else
			{
			   for($i=0;$i<count($all_clcourse);$i++)
			   {
				   if($all_clcourse[$i]->lat==0 || $all_clcourse[$i]->lon==0)
				   {
				      continue;
				   }
			    $go_page=base_url().'search_golfcourse/spcfic_goglelink/'.$all_clcourse[$i]->id;
				$promo=addslashes($all_clcourse[$i]->promo);
				$promo = preg_replace("/[\r\n]+/","", $promo);
				?>
				{lat:'<?=$all_clcourse[$i]->lat?>', lng:'<?=$all_clcourse[$i]->lon?>', data:'<a href="<?=$go_page?>"><?=str_replace("'"," ",$all_clcourse[$i]->nm)?></a><br><?=str_replace("'"," ",$promo)?>'},
				
		 <?     }
		     }?>
            ],
			marker:{
              options:{
                draggable: false,
				icon:'<?=base_url()?>asserts/images/icon_green.png'
              },
              events:{
                
				
				
				
				mouseover: function(marker, event, data){
                  var map = $(this).gmap3('get'),
                  infowindow = $(this).gmap3({action:'get', name:'infowindow'});
                  if (infowindow){
                    infowindow.open(map, marker);
                    infowindow.setContent(data);
                  } else {
                    $(this).gmap3({action:'addinfowindow',
					 anchor:marker, 
					 options:{content: data}});
                  }
                },
				/*mouseout: function(){
				infowindow = $(this).gmap3({action:'get', name:'infowindow'});
                if (infowindow){
                  infowindow.close();
                }
              }*/
			  }
            }
          }
        );
      });
    </script>
	<!--
	////////////////////////
	//end show Map View ///
	///////////////////////
	--> 