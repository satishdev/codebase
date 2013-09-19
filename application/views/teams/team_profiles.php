<?php if($t_details){?>
<div class="ol_sections">
<ol style="margin-left: 0px;">
        <li id="content_header" style="height: 21px;" >
            <b>General Info</b> <?php  echo $t_details->name;?> Team &nbsp;<?php if($this->userId==$t_details->created_by){?>
       <a style="padding-left:5px;" href="<?php echo site_url('teams/edit_teams/'.$t_details->id);?>">Edit</a>
        <?php } ?> &nbsp;   <div id="team_request_status">
        <?php
        if($t_details->is_approved == '0'){
            echo "<span class='tr_status'>Pending Request</span>";
        }else if($t_details->is_approved == '1'){
            if($from_page==0)
			echo "<span class='tr_status'>Already Joined</span>";
        }else{
            echo "<img id='team_request_spin' class='team_request_spin' src='".base_url()."css/images/loading_spin.gif' />".smallButton(array('label'=>'Join team', 'id'=>'join_team_in_profile', 'rel'=>$t_details->id));
        }
        ?>
        </div>
        </li>
		 <li>
            <label class="row_label">Name</label><span class="row_val"><?php echo $t_details->name;?>&nbsp;</span>
        </li>
        <li>
            <label class="row_label">Sports Name</label><span class="row_val"> <?php echo $t_details->sname;?>&nbsp;</span>
        </li>
		 <li>
            <label class="row_label">City</label><span class="row_val"> <?php echo $t_details->city!=''?$t_details->city:'--';?>&nbsp;</span>
        </li>
        <li>
            <label class="row_label">Description</label><span class="row_val"> <?php echo $t_details->description;?>&nbsp;</span>
        </li>
		 <li>
            <label class="row_label">Level</label><span class="row_val"><?php echo $t_details->lname;?>&nbsp;</span>
        </li>
        <li>
            <label class="row_label">About Team</label><span class="row_val"><?php echo $t_details->about_me;?>&nbsp;</span>
        </li>
        <li>
            <label class="row_label">Captain</label><span class="row_val"><?php echo $t_details->captain;?>&nbsp;</span>
        </li>
        <li>
            <label class="row_label">No of Players</label><span class="row_val"><?php echo $num_t_users;?>&nbsp;</span>
        </li>
    </ol>
    <?php 
    if(count($t_sprts))
    {
    ?>
	<ol style="margin-left: 0px;">
        <li class="section_header ui-widget-header">
            <b>Sport History</b> &nbsp;
        </li>
        
        <li>
           <table width="100%" id="table-3" >
			<tr style="font-weight:bold">
            	<td>Sport Name</td>
                <td>Expertise Level</td>
				<td>Total</td>
                <td>Wins</td>
				<td>Losses</td>
                <td>No Results</td>
				<td>Details</td>
           	</tr>
			<?php foreach($t_sprts as $sp){
			$win_loss=$this->teams_model->teamschedule_win_loss($id,$sp->sid);?>
			<tr>
            	<td><?php echo $sp->sname;?></td>
                <td><?php echo $sp->ename;?></td>
				<td><?php echo $sp->total;?></td>
                <td><?php echo $win_loss['win'];?></td>
				<td><?php echo $win_loss['loss'];?></td>
                <td><?php echo $win_loss['noresult'];?></td>
				<td><a class="schedule_team_sports" rel="<?php echo $sp->sid;?>" uid="<?php echo $id;?>">Details</a></td>
           	</tr>
			<?php }?>
		</table>
        </li>
        
       </ol>
    <?php
    }
    ?>
	</div>

<?php }?>