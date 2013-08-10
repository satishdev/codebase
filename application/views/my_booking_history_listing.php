<link href="<?=base_url()?>asserts/admin_theme/css/main2.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/jquery-1.7.2.min.js"></script>

<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/spinner/ui.spinner.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/spinner/jquery.mousewheel.js"></script>

<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/jquery-ui-1.8.22.custom.min.js"></script>

<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/charts/excanvas.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/charts/jquery.sparkline.min.js"></script>

<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/forms/uniform.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/forms/jquery.cleditor.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/forms/jquery.validationEngine-en.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/forms/jquery.validationEngine.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/forms/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/forms/autogrowtextarea.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/forms/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/forms/jquery.dualListBox.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/forms/jquery.inputlimiter.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/forms/chosen.jquery.min.js"></script>

<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/wizard/jquery.form.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/wizard/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/wizard/jquery.form.wizard.js"></script>

<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/uploader/plupload.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/uploader/plupload.html5.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/uploader/plupload.html4.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/uploader/jquery.plupload.queue.js"></script>

<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/tables/datatable.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/tables/tablesort.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/tables/resizable.min.js"></script>

<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/ui/jquery.tipsy.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/ui/jquery.collapsible.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/ui/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/ui/jquery.progress.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/ui/jquery.timeentry.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/ui/jquery.colorpicker.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/ui/jquery.jgrowl.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/ui/jquery.breadcrumbs.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/ui/jquery.sourcerer.js"></script>

<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/calendar.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/elfinder.min.js"></script>

<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/custom.js"></script>








<div id='content_header'>
	<div class='hdr-text'>My Booking History</div>
</div>




<? 
	$my_personal_error=$this->session->userdata('my_personal_error');
	if($my_personal_error!=''){?>
	<div class="nNote nWarning hideit" style="margin:0px;">
	<p><strong>WARNING: </strong><? echo $my_personal_error;?></p>
	</div>
	<? 
	$this->session->set_userdata('my_personal_error','');
	}?> 
	
	<? 
	$my_personal_success=$this->session->userdata('my_personal_success');
	if($my_personal_success!=''){?>
	<div class="nNote nSuccess hideit" style="margin:0px;">
	<p><strong>WARNING: </strong><? echo $my_personal_success;?></p>
	</div>
	<? 
	$this->session->set_userdata('my_personal_success','');
	}?> 





<div id="content_wrapper" class="contacts">
   
   
   
   <div class="ol_sections">                         
				
				<?
				if($result->num_rows() >0)
				{
				?>
				<table width="866px" align="center" border="0" class="display">
			  <tr align="center">
			    <td><strong>Booking Date</strong></td>
				<!--<td><strong>User Name</strong></td>
				<td><strong>User Email</strong></td>-->
				<td width="111px"><strong>Course Name</strong></td>
				<td><strong>Play Date</strong></td>
				<td><strong>Play Time</strong></td>
				<td><strong>Conformation Number</strong></td>
				<td><strong>Booking Id</strong></td>
				<td><strong>Action</strong></td>
			  </tr></td>
			  <?
			foreach($result->result() as $row)
			{
			/*echo '<tr><td>';
			$user_info=$this->common_model->select_where('first_name,last_name,email','players',array('id'=>$row->user_id));
			$user_info=$user_info->row();
			echo $user_info->first_name.' '.$user_info->last_name; 
			echo '</td><td>';
			echo $user_info->email;F j, Y, g:i a*/
			echo '<tr><td>';
			echo date("Y-m-d H:i:s",$row->booking_date);
			echo '</td><td>';
			echo  substr($row->course_name, 0, 24);;
			echo '</td><td>';
			echo date('d-m-Y',$row->dates);
			echo '</td><td>';
			echo $row->times;
			echo '</td><td>';
			echo $row->confirmationNo;
			
			echo '</td><td>';
			echo $row->bookingId;
			echo '</td><td>';
			
			if($row->action_status==0)
			{
			    echo '<a href="'.base_url().'reserve_golfcourse/booking_cancel/'.$row->course_id.'/'.$row->dates.'/'.$row->confirmationNo.'/'.$row->bookingId.'/'.$row->player_schedule_id.'">Cancel Booking</a>| ';
				echo '<a href="'.base_url().'reserve_golfcourse/cash_back/'.$row->course_id.'/'.$row->dates.'/'.$row->confirmationNo.'/'.$row->bookingId.'/'.$row->player_schedule_id.'">Request for Cash Back offer</a> ';
			}
			/*echo '<a href="#.">Request for Cancellation</a> | ';*/
			if($row->action_status==1)
		    {
				echo 'Cancelled | ';
				echo 'Request for Cash Back offer';
			}
			if($row->action_status==2)
		    {
				echo 'Cancel Booking | ';
				echo 'Request has been Sent';
			}
			if($row->action_status==3)
		    {
				echo 'Cancel Booking | ';
				echo 'Paid';
			}
			echo '</td></tr>';
			}?>
			  
			
			
			
			<tr>
			<td colspan="7">
			<? echo @$paginglink;?>
			</td></tr>
			
			</table>
			<?
			}
			else
			{
			   echo "No Record Found.";
			}
			?>
			
		</div>		
      </div>