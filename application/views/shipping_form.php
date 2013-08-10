<?php
	$session_id=$this->session->userdata('session_id');

		$resultsz=$this->common_model->select_where('*','gama_add_cart',array('session_id'=>$session_id));
		
#		echo "<pre>"; print_r($resultsz->result()); echo "</pre>";
#		echo $time_in_24_hour_format  = DATE("H:i", STRTOTIME("9:49PM"));
?>  
	  <script type="text/javascript">
	  
	  function fill_form(id)
	  {
	   if(id==0)
	   window.location='<?=base_url()?>reserve_golfcourse/shipping_form';
	   else
	   window.location='<?=base_url()?>reserve_golfcourse/shiping_form/'+id;
	  
	  }
	  
	  </script>
	  
	  

<style>
	p{ margin:0px;padding:0px;}
	.region3 select{background: none repeat scroll 0 0 #F5F5F5;color: #7B7B7B;height: 18px;
	width: 138px;}
	.search_mid ul li.spacr {padding-left: 13px!important;}
	.search_mid{ width:618px!important;}
	.search_mid ul li{ width:267px!important;}
	.region3_outer { width:151px}
	.search_mid ul li label{ width: 89px!important;}
	.search_mid ul li.spacr label{ width: 104px!important;}
	.region3 select#expire_year,select#expire_month {width: 76px!important;}
	.search_mid ul li.spacr {width: 293px !important;}
	.search_mid ul li{padding-bottom:10px!important;}
	#rightnav.twocol {  margin-top: 25px;}
	
	.reg{background: url("../../images/sprits.png") repeat scroll 0 -368px transparent!important;
    height: 18px!important;
    padding: 4px!important;
    width: 138px!important;}
	
	.reg select{ background: none repeat scroll 0 0 #F5F5F5!important;
    color: #7B7B7B!important;
    height: 18px!important;
    width: 138px!important;}
	
</style>

<?
	if(!empty($result))
	{
	   $row=$result->row();
	}
	else
	{
	   $row='';
	}
	
	if(!empty($result2))
	{
	   $row1=$result2->row();
	}
	else
	{
	   $row1='';
	}
?>
		
		
		  <div id="content">
		  
		  
		  <div id="new_work">
				<ul>
					<li  class="black" >
						<b>1</b>
						<span>Check Out </span>
					</li>
					<li class="blue">
						<b>2</b>
						<span>Billing and Pyament</span>
					</li>
					<li>
						<b>3</b>
						<span>Final your booking</span>
					</li>
					<li>
						<b>4</b>
						<span>Confirmation</span>
					</li>
				</ul>
			 <div class="clr"></div>
			</div>
		  
		  
		  
          
		  <!--start sperate-->
		  <?php /*?><? if($this->db_session->userdata('user_object')!=''){?>
		  <div class="search_rpt" style="margin-left:14px;">
			<div align="center">
				<label>Billing Existing Addresses</label>
				<div class="reg">           
				<select name="exist_addr" id="exist_addr" onchange="fill_form(this.value)" >
				<option value="0" >--Select Any--</option>
				<?
				$unserialize=@unserialize($this->db_session->userdata('user_object'));
				$user_id=$unserialize->getuserid();
				$address_info=$this->common_model->select_where('user_shiping_info_id,address',' gama_user_shiping_info',array('user_id'=>$user_id));
				$address_info=$address_info->result();
				foreach($address_info as $addr){
				$selected=0;
				if($adres_id==$addr->user_shiping_info_id)
				{
				  $selected=1;
				}
				?>
				<option <? if($selected==1){ ?> selected="selected"<? }?> value="<?=$addr->user_shiping_info_id?>" ><?=$addr->address?></option>
				<? }?>
				</select>
				</div>
			</div>
		  </div>
		  <? }?><?php */?>
		  <!--end sperate-->
		 
		  
		  <div id="home_content_left">
              <div class="search">
              <div class="search_top">
                <h3>Billing and Payment Information</h3>
              </div>
			  
			  <style>
			  .search_rpt p{ color:#FF0000;}
			  </style>
			  <form method="post" name="" action="">
              <div class="search_rpt">
			  <?	if(validation_errors()!='')
					{
					    echo validation_errors();
					} ?>
                 <div class="search_mid">
                  <ul>
                   
				   
                    <li>
                      <label>Name on Card:</label>
                      <div class="region3_outer">
                        <div class="region3">
						
						<?   @$card_name=$this->input->post('card_name');?>
                          <input type="text" name="card_name" value="<?=@$card_name?>"     />
                        </div>
                        </div>
                    </li>
                    
                    
					<li class="spacr">
                      <label>Card Type:</label>
                      <div class="region3">
                        
					<div id="course_div">
					<? @$card_type=$this->input->post('card_type');?>
					<select name="card_type" id="card_type">
					<option value="">--Select--</option>
<option <? if($card_type==1){?>selected="selected"<? }?> value="1">Visa</option>
<option <? if($card_type==2){?>selected="selected"<? }?> value="2">Mastercard</option>
<option <? if($card_type==3){?>selected="selected"<? }?> value="3">Amex</option>
					</select>
					</div>
					</div>
						
                      
					
					<li>
                      <label>First Name:</label>
                      <div class="region3_outer">
                        <div class="region3">
                          <? 
						  @$user_fname=$this->input->post('user_fname');
						  if(!empty($row))
						  $db_user_fname=$row->first_name;
						  else
						  $db_user_fname='';
						  ?>
					<input type="text" name="user_fname" value="<? if($user_fname!=''){echo $user_fname;}else {echo @$db_user_fname;}?>" />
                        </div>
                        </div>
                    </li>
					
					
					<li class="spacr">
                      <label>Card Number:</label>
                      <div class="region3_outer">
                        <div class="region3">
					<? 	@$card_no=$this->input->post('card_no');?>
                      <input type="text" name="card_no" autocomplete="off" value="<?=@$card_no?>" />
                        </div>
                        </div>
                    </li>
					
					
					
					
					
					<li>
                      <label>Last Name:</label>
                      <div class="region3_outer">
                        <div class="region3">
                         <?  $user_lname=$this->input->post('user_lname');
						 if(!empty($row))
						 $db_user_lname=$row->last_name;
						 else
						 $db_user_lname='';
						 ?>
						<input type="text" name="user_lname" value="<? if($user_lname!=''){echo $user_lname;}else {echo @$db_user_lname;}?>" />
                        </div>
                        </div>
                    
					</li>
					<li class="spacr">
                      <label><!--Secret Number--> Security Code:</label>
                      <div class="region3">
					  <?  @$ccsecret_no=$this->input->post('ccsecret_no');?>
                        <input type="text" name="ccsecret_no"  autocomplete="off" value="<?=@$ccsecret_no?>" />
                      </div>
                    </li>
					<!--<li class="spacr">
                      <label>Card Address:</label>
                      <div class="region3_outer">
                        <div class="region3">
						<?  @$ccaddress=$this->input->post('ccaddress');?>
                          <input type="text" name="ccaddress" value="<?=@$ccaddress?>" />
                        </div>
                        </div>
                    </li>-->
					
					
					
					
					
					<li>
                      <label>Address:</label>
                      <div class="region3_outer">
                        <div class="region3">
						<?  
						if($read_only=='yes')
						{ 
							if(!empty($row1))
							$address=$row1->address;
							else
							$address='';
						}
						else
						@$address=$this->input->post('address');?>
						
						  <input type="text" name="address" value="<?=@$address?>" <? if($read_only=='yes'){?> <? }?> />
                        </div>
                        </div>
					
					<li class="spacr">
                      <label>Expiration Date:</label>
                      <div class="region5">
                        
					<div id="course_div">
					 <?  @$expire_month=$this->input->post('expire_month');?>
					<select name="expire_month" id="expire_month">
					<option value="">--Select--</option>
					<option value="1" <? if($expire_month!=''){if($expire_month==1){?> selected="selected"<? }}?>>January</option>
					<option value="2" <? if($expire_month!=''){if($expire_month==2){?> selected="selected"<? }}?>>February</option>
					<option value="3" <? if($expire_month!=''){if($expire_month==3){?> selected="selected"<? }}?>>March</option>
					<option value="4" <? if($expire_month!=''){if($expire_month==4){?> selected="selected"<? }}?>>April</option>
					<option value="5" <? if($expire_month!=''){if($expire_month==5){?> selected="selected"<? }}?>>May</option>
					<option value="6" <? if($expire_month!=''){if($expire_month==6){?> selected="selected"<? }}?>>June</option>
					<option value="7" <? if($expire_month!=''){if($expire_month==7){?> selected="selected"<? }}?>>July</option>
					<option value="8" <? if($expire_month!=''){if($expire_month==8){?> selected="selected"<? }}?>>August</option>
					<option value="9" <? if($expire_month!=''){if($expire_month==9){?> selected="selected"<? }}?>>September</option>
					<option value="10" <? if($expire_month!=''){if($expire_month==10){?> selected="selected"<? }}?>>October</option>
					<option value="11" <? if($expire_month!=''){if($expire_month==11){?> selected="selected"<? }}?>>November</option>
					<option value="12" <? if($expire_month!=''){if($expire_month==12){?> selected="selected"<? }}?>>December</option>
					</select>
					</div>
					 </div>
					 <div class="region5">
					<div id="course_div">
					<?  @$expire_year=$this->input->post('expire_year');?>
					<select name="expire_year" id="expire_year">
					<option value="">--Select--</option>
					<? for($i=2013;$i<=2021;$i++){?>
					<option <? if($expire_year!=''){if($expire_year==$i){?>selected="selected"<? }}?> value="<?=$i?>"><?=$i?></option>
					<? }?>
					</select>
					</div>
					
					 </div>
                    </li>
					
					
					
					<!--<li class="spacr">
                      <label>Card Country:</label>
                      <div class="region3_outer">
                        <div class="region3">
						<?  @$cccountry=$this->input->post('cccountry');?>
                          <input type="text" name="cccountry" value="<?=@$cccountry?>" />
                        </div>
                        </div>
                    </li>-->
					
					
					
					
					<li>
                      <label>City:</label>
                      <div class="region3_outer">
                        <div class="region3">
						<?  
						if($read_only=='yes')
						{ 
							if(!empty($row1))
							$city=$row1->city;
							else
							$city='';
						}
						else
						@$city=$this->input->post('city');?>
                          <input type="text" name="city" value="<?=@$city?>" <? if($read_only=='yes'){?> <? }?> />
                        </div>
                        </div>
                    </li>
					
					<li class="spacr">
                      <label>Save:</label>
						<div class="region3">                        
							<div id="course_div">
								<? @$card_type=$this->input->post('card_type');?>
								<select name="save" id="save">
									<option value="<?=$userID?>">--My calendar--</option>
									<?php if($save_team>0){ 
										for($i=0;$i<count($saveTeam); $i++){
											echo '<option value="'.$teamID[$i].'">'.$saveTeam[$i].'</option>';} 
										}									
									?>
									<?php if($save_user>0){ echo '<option value="user'.$userID.'">'.$name.'</option>';} ?>
									<?php //foreach($saves as $save) echo '<option value="'.$save.'">'.$save.'</option>'; ?>										
								</select>
							</div>
						</div>
					</li>
					
					
					
					<!--<li class="spacr">
                     <label>Card PostalCode:</label>
                      <div class="region3_outer">
                        <div class="region3">
						<?  @$ccpostalcode=$this->input->post('ccpostalcode');?>
                          <input type="text" name="ccpostalcode" value="<?=@$ccpostalcode?>" />
                        </div>
                        </div>
                    </li>-->
										
					<li>
                      <label>State:</label>
                      <div class="region3_outer">
                        <div class="region3">
						<?  
						if($read_only=='yes')
						{ 
							if(!empty($row1))
							$state=$row1->state;
							else
							$state='';
						}
						else
						@$state=$this->input->post('state');?>
                          <input type="text" name="state" value="<?=@$state?>" <? if($read_only=='yes'){?> <? }?> />
                        </div>
                        </div>
                    </li>
					<li class="spacr">
                      <label></label>
                      <div>
                      </div>
                    </li>
					
					
					
					
					<li>
                      <label>Postal Code:</label>
                      <div class="region3_outer">
                        <div class="region3">
						<?  
						if($read_only=='yes')
						{ 
							if(!empty($row1))
							$postal_code=$row1->postal_code;
							else
							$postal_code='';
						}
						else
						@$postal_code=$this->input->post('postal_code');?>
						
                        <input type="text" name="postal_code" value="<?=@$postal_code?>" <? if($read_only=='yes'){?><? }?> />
                        </div>
                        </div>
                    </li>
					<li class="spacr">
                      <label></label>
                      <div>
                      </div>
                    </li>
					
					
					
					
					
					
					
					<li>
                      <label>Country:</label>
                      <div class="region3">
                        
					<div id="course_div">
					
							
					<select name="country" id="country">
					<option value="">--Select--</option>
					
					<? $set_country=$this->input->post('country');
					if(!empty($row))
					$db_country=$row->country_id;
					else
					$db_country='';
					
					$country_info=$this->common_model->select_all('id,name,fips_code','country');
					foreach($country_info->result() as $info)
					{?> 
				        <option   <? if($set_country!=''){ if($set_country==$info->id){ ?> selected="selected"<? } }else{if($db_country==$info->id){ ?> selected="selected"<? }}?> value="<?=$info->id ?>"><?=$info->name ?></option>
                 <? }?>
					
					</select>
					</div>
						
                      </div>
                    </li>
					
					<li class="spacr">
                      <label></label>
                      <div>
                      </div>
                    </li>
					
					
					
					<li>
                      <label>Phone:</label>
                      <div class="region3_outer">
                        <div class="region3">
						<? 
						if($read_only=='yes')
						{ 
							if(!empty($row1))
							$phone=$row1->phone_no;
							else
							$phone='';
						}
						else
						@$phone=$this->input->post('phone');?>
                          <input type="text" name="phone" value="<?=@$phone?>" <? if($read_only=='yes'){?> <? }?> />
                        </div>
                        </div>
                    </li>
					
					<li class="spacr">
                      <label></label>
                      <div>
                      </div>
                    </li>
					
					
					<li>
                      <label>Email:</label>
                      <div class="region3_outer">
                        <div class="region3">
						<? 
						if(!empty($row))
						$db_email=$row->email;
						else
						$db_email=$this->input->post('email');
						?>
                          <input type="text" name="email" value="<? echo @$db_email;?>" 
<? if($db_email!=''){?>readonly="" <? }?> />
                        </div>
                        </div>
                    </li>
					
					<li class="spacr">
                      <label></label>
                      <div>
                      </div>
                    </li>
					
					
					
					
                    <li>
                      <div class="region4">
					  <input type="hidden" name="my_submit" value="TRUE"> 
					  <input type="submit" style="cursor:pointer" name="submit" value="Final your Booking"> </div>
                    </li>
                  </ul>
                  <div class="clr"></div>
                </div>
                <div class="clr"></div>
              </div>
              </form>
			  
			  
			  
			  
			  
			  <div class="search_bottom">
               
                <div class="clr"></div>
              </div>
            </div>
          </div>
          
          
	
		
		
		<!--///////////////-->
		
	<?php 
$g_total_price=0;
$g_ppTxnFee=0;
$g_ppCharge=0;
$g_ppNonRef=0;
$g_ppNetRt=0;

foreach($result1->result() as $row)
{
	$explode=explode(' ',$row->price);
	
	//Surcharge
	$ppTxnFee=$row->ppTxnFee*$row->players;
	$g_ppTxnFee=$g_ppTxnFee+$ppTxnFee;
	
	//total price
	$total_price=$explode[1]*$row->players;
	$total_price=$total_price+$ppTxnFee;
	$g_total_price=$g_total_price+$total_price;
	
	//due Online
	$ppCharge=$row->ppCharge*$row->players;
	$g_ppCharge=$g_ppCharge+$ppCharge;
	$chrgCurr=$row->chrgCurr;
	
	//NonRefundable
	$ppNonRef=$row->ppNonRef*$row->players;
	$g_ppNonRef=$g_ppNonRef+$ppNonRef;
	
	//Due at Course
	$ppNetRt=$row->ppNetRt*$row->players;
	$g_ppNetRt=$g_ppNetRt+$ppNetRt;
}
	//end all calculation are here
	?>
				
		
	
    
        <link href="<?=base_url()?>asserts/css/cart_css/shoppingcart.css" rel="stylesheet" type="text/css">

<style type="text/css" charset="utf-8">
p span{ line-height:14px;}
#cart-contents td p a{ margin-top: -5px;!important}


#rightnav.twocol {
width: 309px;
float: right;
margin-right: 5px;
}


</style>	
		
		
		<div id="rightnav" class="twocol">            
                <div id="cart-totals">
			<? 
		if($result1->num_rows()>0)
		{
?>
	
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tbody><tr>
                        <td width="50%">Total:
                            <br><span style="font-weight: normal; font-size: 11px; color: #777777;">Surcharge:</span>                            
                        </td>
                        <td class="total"><? echo $explode[0].' '.number_format(@$g_total_price, 2);?>
                                <br><span style="font-weight: normal; font-size: 11px; color: #777777;"><? echo $explode[0].' '.number_format(@$g_ppTxnFee, 2);?></span>                            
                        </td>
                    </tr> 
                        <tr>
                            <td class="value cart-total">Due Online:</td>
                            <td class="total cart-total"><? echo @$chrgCurr.' '.number_format(@$g_ppCharge, 2);?></td>
                        </tr>
                    
                        <tr>
                            <td class="value non-refundable"><span class="caption">Non-Refundable:</span></td>
                            <td class="total non-refundable"><span class="caption"><? echo $explode[0].' '.number_format(@$g_ppNonRef, 2);?></span></td>
                        </tr>
                        <tr>
                            <td class="value due-at-course">Due At Course:</td>
                            <? //$late_price=$g_total-@$g_ppCharge;?>
							<td class="total due-at-course"><? echo $explode[0].' '.number_format(@$g_ppNetRt, 2)?></td>
                        </tr>
                       
                </tbody></table>
		<? 
		}?>
		
		</div>
		</div>
		
		<!--////////////////-->
		
		
		
		<div class="clr"></div>
        </div>
		
		
		
		</div>
		
		
		
		
		
		
		
		
		
		<!--</div>wraper div end-->