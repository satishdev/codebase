<? $row=$result->row();?>





<div class="wrapper">
      
        	<fieldset>

<div class="widget">
                    <div class="title"><img src="images/icons/dark/timer.png" alt="" class="titleIcon" /><h6>Booking All Detail</h6><div ><a style="float:right; margin-top:9px;" href="<?=base_url()?>admin/user_golf_booking/booking_listing/<?=@$back_page?>">Back Page</a></div></div>
                    <table cellpadding="0" cellspacing="0" width="100%" class="sTable taskWidget">
                        <!--<thead>
                            <tr>
                                <td>Description</td>
                                <td >Status</td>
                            </tr>
                        </thead>-->
                        <tbody>
				<tr>
				<td >User Name</td>
				<td><span > <? echo $row->user_fname.' '.$row->user_lname;?></span></td>
				</tr>
				<tr>
				<td >Email</td>
				<td><span ><? echo $row->email;?></span></td>
				</tr>
				
				<tr>
				<td >Course Name</td>
				<td><span ><a target="_blank" href="<?=base_url()?>search_golfcourse/search_teetimes_two/<?=$row->course_id?>"><? echo $row->course_name;?></a></span></td>
				</tr>
				<tr>
				<td >Price</td>
				<td><span ><? 
						$price_cur=explode(' ',$row->price);
						$cur=$price_cur[0];
						$price=$price_cur[1];
						$price=number_format($price,2);;
						echo $cur.$price;
						?></span></td>
				</tr>
				<tr>
				
				<td >players</td>
				<td><span ><? echo $row->players;?></span></td>
				</tr>
				<tr>
				<td >allow players</td>
				<td><span ><? echo $row->allow_players;?></span></td>
				</tr>
				<tr>
				<td >Time</td>
				<td><span >  <? echo $row->times;?></span></td>
				</tr>
				<tr>
				<td >Date</td>
				<td><span > <? echo date('d-m-Y',$row->dates);?></span></td>
				</tr>
				<tr>
				<td >Per person Surcharge</td>
				<td><span ><? echo $row->ppTxnFee;?>	</span></td>
				</tr>
				<tr>
				<td >Per Person Due Online</td>
				<td><span ><? echo $row->ppCharge;?></span></td>
				</tr>
				<tr>
				<td >Charging Currency</td>
				<td><span ><? echo $row->chrgCurr;?></span></td>
				</tr>
				<tr>
				<td >Per Person Non Refundable</td>
				<td><span ><? echo $row->ppNonRef;?></span></td>
				</tr>
				<tr>
				<td >Per Person Due at Course</td>
				<td><span ><? echo $row->ppNetRt;?></span></td>
				</tr>
				<tr>
				<td >Flags</td>
				<td><span ><? echo $row->flags;?></span></td>
				</tr>
				<tr>
				<td >Date of Birth</td>
				<td><span ><? echo $row->dob;?></span></td>
				</tr>
				<tr>
				<td >Country</td>
				<td>
				<span >  
					<? 
					$country_name=$this->common_model->select_where('name','country',array('id'=>$row->country));
					$country_name=$country_name->row();
					echo $country_name->name;?></span>
					</td>
				</tr>
				<tr>
				<td >State</td>
				<td><span ><? echo $row->state;?></span></td>
				</tr>
				<tr>
				<td >City</td>
				<td><span ><? echo $row->city;?></span></td>
				</tr>
				<tr>
				<td >Address</td>
				<td><span ><? echo $row->address;?></span></td>
				</tr>
				<tr>
				<td >Postal Code</td>
				<td><span ><? echo $row->postal_code;?></span></td>
				</tr>
				<tr>
				<td >Phone Number</td>
				<td><span ><? echo $row->phone_no;?></span></td>
				</tr>
                           
                           
                        
						
						
						</tbody>
                    </table>            
                </div>

</fieldset>
</div>









					 <!--<div class="formRow">
                    <strong>Credit Card Type</strong>:   
					<? 
					/*if($row->credit_card_type==1)
					{echo 'Visa';}
					if($row->credit_card_type==2)
					{echo 'Master Card';}
					if($row->credit_card_type==3)
					{echo 'Amex';}*/?>
                    </div>
					
					<div class="formRow">
                     <strong>Credit Card Number</strong>:   <? /*echo $row->credit_card_no;*/?>
                    </div>
	
					<div class="formRow">
					<strong>Credit Card Expiry Date</strong>:   
					<? 
					/*if($row->credit_card_expiry_month==1)
					{$ext='st';}
					else if($row->credit_card_expiry_month==2)
					{$ext='nd';}
					else
					{$ext='th';}*/
					?>
					<? /*echo $row->credit_card_expiry_month.$ext.' month  '.$row->credit_card_expiry_year;*/?>
					</div>            -->     
                    
                   
                 