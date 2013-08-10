

<!-- Left side content -->



<!-- Right side -->
<div id="rightSide">

    <!-- Top fixed navigation -->
    
    
    <!-- Responsive header -->
    
    
    <!-- Title area -->
    <div class="titleArea">
        <div class="wrapper">
            <div class="pageTitle">
                <h5>Golf Course Booking Listing</h5>
                <span></span>
            </div>
            
            <div class="clear"></div>
        </div>
    </div>
    
   
    
    <!-- Page statistics area -->
    
    
   
    
    <!-- Main content wrapper -->
    <div class="wrapper">
	
	
	
	<? 
	$my_personal_error=$this->session->userdata('my_personal_error');
	if($my_personal_error!=''){?>
	<div class="nNote nWarning hideit">
	<p><strong>WARNING: </strong><? echo $my_personal_error;?></p>
	</div>
	<? 
	$this->session->set_userdata('my_personal_error','');
	}?> 
	
	<? 
	$my_personal_success=$this->session->userdata('my_personal_success');
	if($my_personal_success!=''){?>
	<div class="nNote nSuccess hideit">
	<p><strong>WARNING: </strong><? echo $my_personal_success;?></p>
	</div>
	<? 
	$this->session->set_userdata('my_personal_success','');
	}?> 
	
	
	
	
    
        <!-- Dynamic table -->
        <div class="widget">
            <div class="title"><img src="<?=base_url()?>asserts/admin_theme/images/icons/dark/full2.png" alt="" class="titleIcon" /><h6>Booking Listing</h6></div>                          
            
			
			
			
			<!-- dTable-->
			<table cellpadding="0" cellspacing="0" border="0" class="display">
            <thead>
            <tr>
            <th>User Name</th>
            <th>Email ID</th>
			<th>Booking Date</th>
            <th>Course Name</th>
           <!-- <th>Price</th>-->
			<th>Play Date</th>
			<th>Play Time</th>
			<th>Confirmation Number</th>
			<th>BookingID</th>
			<th>Option</th>
            </tr>
            </thead>
            <tbody>
             <!--sorting_1-->
			<? 
if($result->num_rows()>0)
{
	$conformation_no='';
	$booking_id='';
	$i=0;
	$set='';
	foreach($result->result() as $row)
	{
	$i++;
	if($i%2==0)
	{
	$set='class="gradeA odd"';
	}
	else
	{
	$set='class="gradeA even"';
	}
	?>
			<tr <?=$set?>>
            <td><? echo $row->user_fname.' '.$row->user_lname;?></td>
            <td><? echo $row->email;?></td>
			<td><? echo date("F j, Y, g:i a",$row->booking_date);?></td>
            <td><? echo $row->course_name;?></td>
            <!--<td ><? //echo $row->price;?></td>-->
			<td ><? echo date('d-m-Y',$row->dates);?></td>
			<td ><? echo $row->times;?></td>
			
			<td ><? echo $row->confirmationNo;?></td>
			<td ><? echo $row->bookingId;?></td>
			
			<td >
			<? echo '<a href="'.base_url().'admin/user_golf_booking/booking_detail/'.$row->gama_booking_id.'/'.$page_start_from.'">Detail</a> | ';?>
		
		<? if($row->action_status==0)
		{
		echo '<a href="'.base_url().'admin/user_golf_booking/booking_cancel/'.$row->course_id.'/'.$row->dates.'/'.$row->confirmationNo.'/'.$row->bookingId.'/'.$row->player_schedule_id.'/1">Booking Cancel</a>';
		}
		 if($row->action_status==1)
		 {
		echo 'Cancelled';
		}
		
		if($row->action_status==2)
		{
		echo '<a href="'.base_url().'admin/user_golf_booking/booking_cancel/'.$row->course_id.'/'.$row->dates.'/'.$row->confirmationNo.'/'.$row->bookingId.'/'.$row->player_schedule_id.'/3">Request Cash back</a>';
		}
		if($row->action_status==3)
		{
		echo 'Paid';
		}?>
		</td>
            </tr>
<?	}
}
else
{?>
<tr class="gradeA even">
<td>No Record Found.</td>
</tr>
<?
}
?>
             
            </tbody>
            </table>
			
			<table class="display dTable">
			<tr>
			<td align="right">
				<? //if($result->num_rows()>1)
				//{
				echo @$paginglink;
				
				//}?>
			</td>
			</tr>  
            </table>       
		</div>
    
    </div>