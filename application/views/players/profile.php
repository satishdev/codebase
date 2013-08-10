<div class="ol_sections">
<ol style="margin-left: 0px;">
        <li id="content_header" style="height: 21px;" >
            <b>General Info</b> &nbsp;<?php if($this->userId==$id){?><a href="<?php echo site_url('players/edit');?>">Edit</a><?php } ?>
        </li>
		<!-- <li>
            <label class="row_label">About me</label><span class="row_val"> <?php echo $u_details->about_me!=''? $u_details->about_me:'--';?> &nbsp;</span>
        </li>-->
        <li>
            <label class="row_label">First Name</label> <span class="row_val"> <?php echo $u_details->first_name;?> &nbsp; </span>
        </li>
        <li>
            <label class="row_label">Last Name</label><span class="row_val"><?php echo $u_details->last_name;?> &nbsp;</span>
        </li>
		 <li>
            <label class="row_label">Gender</label><span class="row_val"><?php echo $u_details->gender=='m'?'Male':'Female';?> &nbsp;</span>
        </li>
		 <li>
            <label class="row_label">City</label><span class="row_val"><?php echo $u_details->city!=''?$u_details->city:'--';?> &nbsp;</span>
        </li>
		 <li>
            <label class="row_label">Country</label> <span class="row_val"><?php echo $u_details->cname!=''? $u_details->cname:'--';?> &nbsp;</span>
        </li>
        <li>
            <label class="row_label">No of sPartners</label> <span class="row_val"><?php echo $f_count;?> &nbsp;</span>
        </li>
        <li>
            <label class="row_label">No of Sports</label> <span class="row_val"><?php echo $s_count;?> &nbsp;</span>
        </li>
        <li>
            <label class="row_label">No of Teams</label><span class="row_val"> <?php echo $t_count;?> &nbsp;</span>
        </li>
        
    </ol>
	<?php if($this->userId==$id || $is_frd!=0){?>
<ol style="margin-left: 0px;">
        <li class="section_header ui-widget-header">
            <b>Personal Info</b> &nbsp;<?php if($this->userId==$id){?><a href="<?php echo site_url('players/edit_personal');?>">Edit</a><?php } ?>
        </li>
        
        <li>
            <label class="row_label">Email ID</label> <span class="row_val"><?php echo $u_details->email;?> &nbsp;</span>
        </li>
		 <li>
            <label class="row_label">Skype id</label> <span class="row_val"><?php echo $u_details->skype_id!=''?$u_details->skype_id:'--';?> &nbsp;</span>
        </li>
		 <li>
            <label class="row_label">Facebook id</label> <span class="row_val"><?php echo $u_details->facebook_id!=''?$u_details->facebook_id:'--';?> &nbsp;</span>
        </li>
		 <li>
            <label class="row_label">Twitter id</label> <span class="row_val"><?php echo $u_details->twitter_id!=''?$u_details->twitter_id:'--';?> &nbsp;</span>
        </li>
		<li>
            <label class="row_label">Linkedin id</label> <span class="row_val"><?php echo $u_details->linkedin_id!=''?$u_details->linkedin_id:'--';?> &nbsp;</span>
        </li>
		 <li>
            <label class="row_label">DOB</label> <span class="row_val"><?php echo date('Y-m-d',strtotime($u_details->dob));?> &nbsp;</span>
        </li>
		
        <!--<li>
            <label class="row_label">Mobile</label> <span class="row_val"><?php echo $u_details->mobile!=0? $u_details->mobile:'--';?> &nbsp;</span>
        </li>-->
        <li>
            <label class="row_label">Phone No</label> <span class="row_val"><?php echo $u_details->phone!=0? $u_details->phone:'--';?> &nbsp;</span>
        </li>
       <!-- <li>
            <label class="row_label">Zip Code</label> <span class="row_val"><?php //echo $u_details->zip!=0? $u_details->zip:'--';?> &nbsp;</span>
        </li>
        <li>
            <label class="row_label">City</label> <span class="row_val"><?php //echo $u_details->city!='0'? $u_details->city:'--';?> &nbsp;</span>
        </li>
        <li>
            <label class="row_label">State</label> <span class="row_val"><?php //echo $u_details->state!=''? $u_details->state:'--';?> &nbsp;</span>
        </li>
        <li>
            <label class="row_label">Website</label><span class="row_val"> <?php //echo $u_details->web_site!=''? $u_details->web_site:'--';?> &nbsp;</span>
        </li>
        <li>
            <label class="row_label">Height</label><span class="row_val"> <?php //echo $u_details->height!=''? $u_details->height:'--';?> &nbsp;</span>
        </li>
        <li>
            <label class="row_label">weight</label><span class="row_val"> <?php //echo $u_details->weight!=''? $u_details->weight:'--';?> &nbsp;</span>
        </li>
        <li>
            <label class="row_label">Address</label> <span class="row_val"><?php //echo $u_details->address!=''? $u_details->address:'--';?> &nbsp;</span>
        </li>-->
       </ol>
	   <?php }?>
	   <ol style="margin-left: 0px;">
        <li class="section_header ui-widget-header">
            <b>Sport History</b> &nbsp;
        </li>
        
        <li>
           <table id="table-3" width="100%"  >
			<tr style="font-weight:bold">
            	<th>Sport Name</th>
                <th>Expertise Level</th>
				<th>Total</th>
                <th>Wins</th>
				<th>Losses</th>
                <th>No Results</th>
				<th>Details</th>
           	</tr>
			<?php foreach($u_sprts as $sp){
			$win_loss=$this->users_model->userschedule_win_loss($id,$sp->sid);?>
			<tr>
            	<td><?php echo $sp->sname;?></td>
                <td><?php echo $sp->ename;?></td>
				<td><?php echo $sp->total;?></td>
                <td><?php echo $win_loss['win'];?></td>
				<td><?php echo $win_loss['loss'];?></td>
                <td><?php echo $win_loss['noresult'];?></td>
				<td><a class="schedule_player_sports" rel="<?php echo $sp->sid;?>" uid="<?php echo $id;?>">Details</a></td>
           	</tr>
			<?php }?>
		</table>
        </li>
        
       </ol>
<ol style="margin-left: 0px;">
        <li class="section_header ui-widget-header">
            <b>Education Info</b> &nbsp;<?php if($this->userId==$id){?><a href="<?php echo site_url('players/add_education_information');?>">Add</a><?php } ?>
        </li>
		 <li>
		 <table id="table-3" width="100%"  >
			<tr style="font-weight:bold">
            	<th>School/Course Name</th>
                <th>Degree</th>
				<th>Field of Study </th>
				<th>From</th>
                <th>To</th>
				<!--<th>Country</th>
				<th>State</th>
				<th>Zip Code</th>-->
           	</tr>
			<?php foreach($e_details as $erow){
			?>
			<tr>
                <td><?php echo $erow->course_name;?></td>
				<td><?php echo $erow->degree;?></td>
                <td><?php echo $erow->major;?></td>
				<td><?php echo date('M Y',strtotime($erow->from_date));?></td>
                <td><?php echo date('M Y',strtotime($erow->to_date));?></td>
				
           	</tr>
			<?php }?>
		</table></li>

    </ol>
	
<!--<ol style="margin-left: 0px;">
        <li class="section_header ui-widget-header">
            <b>Interest Info</b> &nbsp;<?php if($this->userId==$id){?><a href="<?php echo site_url('players/add_interests');?>">Add</a><?php } ?>
        </li>
        <?php $i=0; foreach($i_details as $irow){$i++;?>
        <li>
            <label class="row_label">Interests</label><span class="row_val"><?php echo $irow->iname;?> &nbsp; <?Php if($this->userId==$id){?><a href="<?php echo site_url('players/edit_interests/'.$irow->id);?>">Edit</a>  &nbsp;<?Php if($i!=1){?><a href="<?php echo site_url('players/delete_interest/'.$irow->id);?>">Remove</a>  <?php } } ?></span>
        </li><li>
            <label class="row_label">Skills</label><span class="row_val"><?php echo $irow->skills;?> &nbsp;</span>
        </li>
<?php } ?>
</ol>-->
<!--<ol style="margin-left: 0px;">
        <li class="section_header ui-widget-header">
            <b>Alert Info</b> &nbsp;<?php if($this->userId==$id){?><a href="<?php echo site_url('players/add_alerts');?>">Add</a><?php } ?>
        </li>
        <?php $i=0; foreach($a_details as $arow){
		$i++;?>
        <li>
            <label class="row_label">Keywords</label><span class="row_val"><?php echo $arow->keywords;?> &nbsp;<?Php if($this->userId==$id){?> <a href="<?php echo site_url('players/edit_alerts/'.$arow->id);?>">Edit</a>  &nbsp; <?Php if($i!=1){?><a href="<?php echo site_url('players/delete_alert/'.$arow->id);?>">Remove</a>  <?php } }?></span>
        </li>
        <li>
            <label class="row_label">Sports</label><span class="row_val"><?php echo $arow->spname;?> &nbsp;</span>
        </li>
<?php } ?>

</ol>-->
<ol style="margin-left: 0px;">
        <li class="section_header ui-widget-header">
            <b>Company Info</b> &nbsp;<?php if($this->userId==$id){?><a href="<?php echo site_url('players/add_working_expierence');?>">Add</a><?php } ?>
        </li>
		<li>
		 <table id="table-3" width="100%"  >
			<tr style="font-weight:bold">
            	<th>Company Name</th>
                <th>Designation </th>
				<th>Location</th>
                <th>From</th>
				<th>To</th>
				<!--<th>Country</th>
                <th>State</th>
				<th>Zip Code</th>-->
				
           	</tr>
			<?php foreach($w_details as $wrow){
			?>
			<tr>
            	<td><?php echo $wrow->company;?></td>
                <td><?php echo $wrow->designation;?></td>
				<td><?php echo $wrow->location;?></td>
				<td><?php echo date('M Y',strtotime($wrow->from_date));?></td>
                <td><?php echo date('M Y',strtotime($wrow->to_date));?></td>
				<!--<td><?php //echo $wrow->cname;?></td>
                <td><?php //echo $wrow->state;?></td>
				 <td><?php //echo $wrow->zip;?></td>-->
           	</tr>
			<?php }?>
		</table></li>
           
</ol>
</div>
