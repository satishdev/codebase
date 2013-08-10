
<div id='content_header'>

	<div class='hdr-text'>Advance Golf Courses Search</div>

</div>



<div id="content_wrapper" class="contacts">

		

    <div class="opt_box_wrapper">

    
	
	
	
	
	<link href="<?=base_url()?>asserts/css/site_css/stylesheet3.css" rel="stylesheet" type="text/css" />
	
	   <!-- //use for datepicker-->
	<link rel="stylesheet" href="<?php echo base_url()?>asserts/css/themes/jquery.ui.all.css">
	
	<!--for dialog box-->
	<script src="<?php echo base_url()?>asserts/js/js_model/jquery.bgiframe-2.1.2.js"></script>
	<!--end for dialog box-->
		
	<script src="<?php echo base_url()?>asserts/js/ui/jquery.ui.core.js"></script>
	<script src="<?php echo base_url()?>asserts/js/ui/jquery.ui.widget.js"></script>
	
	<!--for dialog box-->
	<script src="<?php echo base_url()?>asserts/js/js_model/jquery.ui.position.js"></script>
	<script src="<?php echo base_url()?>asserts/js/js_model/jquery.ui.dialog.js"></script>
	<!--end for dialog box-->
	
	<script src="<?php echo base_url()?>asserts/js/ui/jquery-ui-1.8.23.custom.js"></script>
	<script src="<?php echo base_url()?>asserts/js/ui/jquery.ui.datepicker.js"></script>
	<link rel="stylesheet" href="<?php echo base_url()?>asserts/css/demos.css">
	<script>
	$(function() {
		$( "#datepicker" ).datepicker({ minDate: 0, maxDate: "+3M +0D" });
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
		
		$('#my_area').html('<select name="area_id" id="area_id"><option value="">--Any Area--</option></select>');
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
		$('#my_area').html('<select name="area_id" id="area_id"><option value="">--Any Area--</option></select>');
	}
}

</script>


<?

/*  $client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");
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





<!--onsubmit="hide_show()"-->
<div id="home_content_left" style=" padding:0px; padding-left:10px; float:none;">
<div class="search">
<form method="post" action="<?php echo base_url()?>teetime_golfcourse/golfcourse_form" >
  <div class="search_top">
	<h3>Search for Golf Courses</h3>
	<div class="united">
	
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
  </div>
  <div class="search_rpt">
	<div class="search_mid">
	  <ul>
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
		<li class="spacr">
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
		  <label>Date:</label>
		  <div class="region">
			
			    <? 
				$sess_date=$this->session->userdata('fin_date');
				if($sess_date=='')
				{
				   $sess_date=time();
				   $this->session->set_userdata('fin_date',$sess_date);
				}
				$sess_date=date('m/d/Y',$sess_date);
				?>
				<input type="text" name="datepicker" id="datepicker" value="<?=@$sess_date?>" width="100px" height="30px" style="position:relative; z-index:1; width:165px;">
                    <a href="#" style="margin-left:-17px;"><img src="<?=base_url()?>asserts/images/lander.png" alt="#" /></a>
			
			</div>
		<input type="hidden" name="times" value="0600" />
		<input type="hidden" name="players" value="1" />
		</li>
		
		
		
		<li class="spacr">
		  <div class="region4">
		  <input type="hidden" name="my_submit" value="TRUE"> 
		  <input type="submit" style="cursor:pointer" name="submit" value="Search Golf Courses"> </div>
		</li>
	  </ul>
	  <div class="clr"></div>
	</div>
	<div class="clr"></div>
  </div>
  
  </form>

  <div class="search_bottom" style="float:left;" > 
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
<div class="clr"></div>
</div>
</div>








	
	
	
	
	
	
	

    </div>

    

    <div class="adv_search_results notifications">

	<?php 
	if(!empty($sports_data))
	{
	foreach($sports_data['records'] as $row){?>

    	<div class="msg_item player">

        <img class="u_icn" src="<?php echo base_url(); ?><?php if($row->image!='') echo 'images/th_'.$row->image;else echo $row->gender=='m'?"css/images/empty_image.png":"css/images/female_image.png";?>">

        <div class="msg_data">

            <div class="u_name"><?php echo $row->pname;?></div>

            <div class="u_msg"><?php echo $row->cname;?></div>

            <div class="msg_actions" rel='<?php echo $row->pid;?>'>

                <div class='n_actions'>

                	<?php

						$txt = 'Add';

						$status = 'a';

						if($row->is_approved!=''){

							if($row->is_approved=='0'){

								$txt = 'Waiting for Approval';

								$status = 'w';

							}else if($row->is_approved=='1'){

								$txt = 'Waiting for Approval';

								$status = 'r';

							}

						}

					?>

                    <div class='act_wrap'><a class='n_act btn act-status' rel='<?php echo $row->pid;?>' status='<?php echo $status; ?>'><?php echo $txt; ?></a></div>

                    <div class='clear'></div>

                </div>

            </div>

            <div class='more'><a href="<?php echo site_url('profile/view/'.$row->pid);?>">More..</a></div>

        </div>

        </div>

    

           

        <?php }
		} ?>	

            <div class="clear"></div>

        </div>

        <div class="clear"></div>

        <div id="pager_wrap">

            <div class="pager fr">

                <!--<div id="pager_prev" class="page_box fl">&nbsp;</div>-->

                <!--<div class="page_box fl">1</div>-->

				<?php echo $this->pagination->create_links();	?>

                <!--<div id="pager_next" class="page_box fl">&nbsp;</div>-->

            </div>

        </div>

</div>