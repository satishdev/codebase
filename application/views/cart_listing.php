<script src="<?php echo base_url() ?>asserts/js/jquery-1.8.2.js"></script>

<link href="<?=base_url()?>asserts/css/cart_css/golfhub.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>asserts/css/cart_css/layout_main.css" rel="stylesheet" type="text/css">
	<link href="<?=base_url()?>asserts/css/cart_css/modules.css" rel="stylesheet" type="text/css">    
    <link href="<?=base_url()?>asserts/css/cart_css/forms.css" rel="stylesheet" type="text/css">
    
        <link href="<?=base_url()?>asserts/css/cart_css/shoppingcart.css" rel="stylesheet" type="text/css">

<style type="text/css" charset="utf-8">/* See license.txt for terms of usage */
  

p span{ line-height:14px;}

#cart-contents td p a{ margin-top: -5px;!important}
</style>






<!--start for only design-->
  <!--<div class="content">
            <div class="content_resize">
                <div class="mainbar left_true right_true">
      <div class="article" id="main_content" style="width:998px">		<div id="content_header">
		<div class="hdr-text"><a href="">Cart Listing</a></div>
		</div>
			<div id="content_wrapper">
				<div class="opt_box_wrapper team">-->
				
	<div id="innerwrapper" class="wrapper">
            <div id="ajaxareaselector" style="display: none;"></div>  
            <div  id="content" class="shoppingcart_index">
			<div id="new_work">
				<ul>
					<li class="blue">
						<b>1</b>
						<span>Check Out </span>
					</li>
					<li>
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
			
			
            <div id="toprow" class="clear">
    <h1>Your Shopping Cart</h1>
    <div id="breadcrumb-container">
    </div>
                 <div class="clear"></div>                
            </div>
            <div id="toprowsub">
            </div>
            <div id="main" class="twocol">			
	<!--<div class="cart-header">
    <p class="float-left">Need Assistance? Email <a href="mailto:customerservice@golfhub.com">customerservice@golfhub.com</a></p>
    <div class="float-right">
        <p><a href="">Accepted Payments Types</a> | <a href="">Rates Explained</a></p>         
        <div id="credit-types">                     
            
                <img src="ShoppingCart_files/visa.gif" alt="visa" height="20" width="32">
                <img src="ShoppingCart_files/mastercard.gif" alt="mastercard" height="20" width="32">
                <img src="ShoppingCart_files/amex.gif" alt="amex" height="20" width="32">
              
            <p class="caption">*Accepted credit cards vary by course.</p>          
        </div>     
    </div>   
</div>-->   			
				
				
<!--end for only design-->




<?
if($result->num_rows()>0)
{
?>


<table id="cart-contents" class="mod cart" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th class="desc">Description</th>
                    <th class="align-center" width="100">Price</th>
                    <th class="align-center" width="100">Quantity/Players</th>
                    <th class="align-center" width="100">Total</th>
                </tr>
            </thead>


<?php 
$g_total_price=0;
$g_ppTxnFee=0;
$g_ppCharge=0;
$g_ppNonRef=0;
$g_ppNetRt=0;

foreach($result->result() as $row)
{
  ?>  
		<tbody><tr>     
		<td valign="top">           
		<div class="overview-image">
                               <? echo '<img src="'.base_url().'asserts/upload_img/golf_course/'.$row->course_id.'_'.$row->img.'" width="68" height="52" >';?>
                            </div>
                            <p>
                               <!-- <a class="cart-item-name" href="https://www.golfhub.com/PhoenixNortheast-Arizona/TeeTimes/DesertCanyonGolfClub">Desert Canyon Golf Club</a>            --> 
							   <a class="cart-item-name" href="#."><? echo $row->course_name;?></a>      
                                    <span class="cart-item-desc"><strong>Tee Date: </strong><? echo date('l, F j, Y ',$row->dates);?></span>
	
                                    <span class="cart-item-desc"><strong>Tee Time: </strong><? echo $row->times;?></span>                      
                                    <!--<span class="rewards precolon">
                                          <a href="#.">Login, or create an account</a> to earn: <span class="postcolon">780 points</span></span>-->
                            </p>
                        </td> 
                        <td class="align-center">
						<?
						//echo 'Sur Charge: '.$row->sur_charge.'<br>';
						//show price
						$explode=explode(' ',$row->price);
						$price=number_format($explode[1], 2);
						echo $explode[0].' '.$price;
						?>                   
                        </td>                        
                        <td class="align-center">
                            
		<select onchange="ajax_cart_listing(this.value,<?php echo $row->gama_add_cart_id;?>)">
		<?php  for($i=1;$i<=$row->allow_players;$i++){?>
		<option <?php if($row->players==$i){?> selected="selected"<?php } ?> value="<?php echo $i;?>"><?php echo $i;?></option>
		<?php }?>
		</select>
                                    
	<a href="#." onclick="delete_cart(<?php echo $row->gama_add_cart_id?>)">[x] remove</a>
                                                               
				</td>                    
				<td class="align-center">
				<?
					//all calculation are here
					//$sur_charge=$this->config->item('sur_charge')*$row->players;
					
					//Surcharge
					$ppTxnFee=$row->ppTxnFee*$row->players;
					$g_ppTxnFee=$g_ppTxnFee+$ppTxnFee;
					
					//total price
					$total_price=$explode[1]*$row->players;
					$total_price=$total_price+$ppTxnFee;
					echo @$explode[0].' '.number_format($total_price, 2);
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
				
				</td>      
				</tr>
				</tbody>
	
	
	          <tfoot>      
                <tr>
                    <td colspan="2" class="footer-note">&nbsp;
                                                   
                  </td>
                    <td class="align-right"><label>Total:</label></td>
                    <td class="total"><?php echo @$explode[0].' '.number_format(@$g_total_price, 2); ?></td>
                </tr>  
              </tfoot>  
                     
        </table>
	
		<div class="halfright">
	
	
	<style>
	.region4_1{margin-left:34px!important;text-align: center!important;width: 151px!important; padding-top:3px!important;}
	.second{margin-left:4px!important; width: 171px!important;}
	.region4_1 a{font-size: 13px;color:#FFFFFF;font-weight: bold;line-height: 30px;    text-align: center;text-transform: uppercase;text-decoration:none;}
	</style>
	
	
<div class="region4_1">
<a href="<?=base_url()?>search_golfcourse/search_teetimes">Continue Shopping</a>
</div>
<div class="region4_1 second">
<a   href="<?php echo base_url();?>reserve_golfcourse/shipping_form">Proceed To Checkout</a>
</div>
	
           
        </div>
	<div class="clear"></div>
            </div>  
            <div id="rightnav" class="twocol">            
                <div id="cart-totals">
	
	
	<? 
/*$sur_charge=$this->config->item('sur_charge')*$count_players;
$g_total=$sur_charge+$g_total;*/
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
	   
	


<? }else{?>
<p style="color:#FF0000"> No Golf Course in Cart.</p>
<div class="region4_1">
<a href="<?=base_url()?>search_golfcourse/search_teetimes">Continue Shopping</a>
</div>
<? }?>


</div>
	   </div>
            <div id="bottomrow" class="clear">
            </div>     
            </div>
</div>

</div>
<!--</div>wraper div end-->
<!--start for only design
 <div class="clear"></div>
				</div>
			</div>
	    </div><!--main content
                     <div class="clr"></div>
                </div>
            </div>
        </div>-->
<!--end for only design-->



<script>

function ajax_cart_listing(players,gama_add_cart_id)
{
	$.ajax({
		type:'post',
		data:'players='+players+'&gama_add_cart_id='+gama_add_cart_id,
		url:'<?php echo base_url()?>reserve_golfcourse/ajax_cart_listing',
		success:function(data){
		$('#innerwrapper').html(data);
		}
    });
}



function delete_cart(gama_add_cart_id)
{
	$.ajax({
	type:'post',
	data:'gama_add_cart_id='+gama_add_cart_id,
	url:'<?php echo base_url();?>reserve_golfcourse/delete_cart_listing',
	success:function(data)
		{
		   $("#innerwrapper").html(data);
		}
	});
}

</script>