<div id="content">
		
		<div id="new_work">
				<ul>
					<li  class="black" >
						<b>1</b>
						<span>Check Out </span>
					</li>
					<li class="black" >
						<b>2</b>
						<span>Billing and Pyament</span>
					</li>
					<li class="black">
						<b>3</b>
						<span>Final your booking</span>
					</li>
					<li class="blue">
						<b>4</b>
						<span>Confirmation</span>
					</li>
				</ul>
			 <div class="clr"></div>
			</div>
			 
		  
		  <div id="home_content_left">  
		  <?
//to show the order information after submitting
		if($this->session->userdata('all_data_save')!='')
		{?>
              <div class="search">
              
			  
			  <style>
			  .search_rpt p{ color:#FF0000;}
			  </style>
              <div class="search_rpts">
                 <div class="search_mids">
                  
				  
			<?	  
				
			$html='';
			$all_data_save=$this->session->userdata('all_data_save');
#			echo '<pre>'; print_r($all_data_save); echo '</pre>';
			$count=count($all_data_save);
			
			
			for($i=1;$i<=$count;$i++)
			{
			   if($all_data_save[$i]['status']==1)
			   {
					if($this->session->userdata('status')=='success')
					{
						$html.='<p style="color:#009900"><strong>Note :</strong> You will shortly receive an email from GolfSwitch with confirmation.</p><br>';
						$this->session->set_userdata('status','');
					}
				  
				   $html.="<strong>Course Name:  </strong>".$all_data_save[$i]['courseName']."<br>";
				   $html.="<strong>Conformation No:  </strong>".$all_data_save[$i]['confirmationNo']."<br>";
				   $html.="<strong>Booking ID:  </strong>".$all_data_save[$i]['bookingId']."<br>";
				   $html.="<strong>Play Date:  </strong>".$all_data_save[$i]['playDate']."<br>";
				   $html.="<strong>Play Time:  </strong>".$all_data_save[$i]['playTime']."<br>";
				   $html.="<strong>Players:  </strong>".$all_data_save[$i]['numPlayers']."<br>";
				   $html.="<strong>Policy:  </strong>".$all_data_save[$i]['CxlPolicy']."<br>";
               }
			   else
			   {
				  if($all_data_save[$i]['courseName']!='')
				  $html.="<strong>Course Name:  </strong>".$all_data_save[$i]['courseName']."<br>";
				  $html.='<p style="color:#FF0000"> <strong>Error:  </strong>  '.$all_data_save[$i]['error'].'</p><br>';
			   } 
			   $html.='<br>..........<br>';			
  			}
			
			echo $html; 
			
			//print_r($all_data_save);
			$this->session->set_userdata('all_data_save','');
			
		?>
		
		
		
		
				  
				  
				  
				  
				  
                  <div class="clr"></div>
                </div>
                <div class="clr"></div>
              </div>
			  
			  
			  
			  
			 
			  <!--<div class="search_bottom">
                <div class="clr"></div>
              </div>-->
            </div>
          
          
     <?    } else
		{?>
	 <div class="region4_1">
<a href="<?=base_url()?>search_golfcourse/search_teetimes">Go for More Shopping</a>
</div>
		<? }?>
		</div>
		<!--///////////////-->
		
	<?php 
$g_total_price=0;
$g_ppTxnFee=0;
$g_ppCharge=0;
$g_ppNonRef=0;
$g_ppNetRt=0;

foreach($result->result() as $row)
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
		if($result->num_rows()>0)
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
