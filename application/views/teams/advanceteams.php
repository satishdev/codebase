<?php //print_r($sports_data);?>

<div id='content_header'>
	<div class='hdr-text'>Teams</div>
</div>

<div id="content_wrapper" class="contacts">
		
    <div class="opt_box_wrapper">
    <form id="appl_form" method="post" action="<?php echo site_url('teams/advanceteams');?>" name="appl_form">
                     
		<table width="100%" border="0" cellspacing="10px" >
			<tr>
            	<td>Team Name: </td><td><input  type="text" style="padding: 3px;"  class="text" name="tname" value="<?=$this->input->request('tname')?$this->input->request('tname'):''?>"/></td>
                 <td>Sport:</td>
                <td>
                    <select name='sp' id='sp' class="text search_advance" >
                    <?php
                    echo selectBox('Select','sports','id,name','status="1"',$this->input->request('sp')?$this->input->request('sp'):0,' name'); ?>
                    </select>
                </td>
           	</tr>
			<tr>
            	<td>Postcode/City: </td><td><input type="text" class="text" style="padding: 3px;" name="poc" value="<?php if(isset($_POST['poc']))echo $_POST['poc']; ?>"/></td>
                <td>Distance KM:</td>
				<td>
					<?php if(isset($_POST['dist']))$dist=$_POST['dist'];else $dist='5';?><select name='dist' id='dist' class="text search_advance" >
                   <option value="5" <?=$this->input->request('dist')==5?"selected='selected'":''?>>5</option>
                    <option value="10" <?=$this->input->request('dist')==10?"selected='selected'":''?>>10</option>
                    <option value="25" <?=$this->input->request('dist')==25?"selected='selected'":''?>>25</option>
                    <option value="50" <?=$this->input->request('dist')==50?"selected='selected'":''?>>50</option>
                    <option value="100" <?=$this->input->request('dist')==100?"selected='selected'":''?>>100</option>
                    <option value="" <?=$this->input->request('dist')==''?"selected='selected'":''?>>Other</option>
                    </select>
                 </td>
            </tr>
			<tr >
               
                <td >Level:</td>
                <td>
                    <select name='level' id='level' class="text search_advance" >
                    <?php 
                    echo selectBox('Select', 'levels', 'id,name', 'status="1"',$this->input->request('level')?$this->input->request('level'):'');
                    ?>		
                    </select>
                </td>
				
             </tr>
			 <tr>
             	<td colspan="4" align="center"><input type="submit" name="submit" value="Search" class="button_img"/></td>
             </tr>
		</table>
	</form>
    </div>
    
    <div class="opt_box_wrapper notifications">
	<?php if(isset($total)){if($total>0){ foreach($team_data as $row){
	$win_loss=$this->teams_model->teamschedule_win_loss_team($row->tid);?>
			<div class="team_list_row">
			<?php $data=$this->teams_model->usersOfTeams($row->tid);
			if($row->logo!=''){?>
			<div class="team_list_ca fl">
				<a href="<?php echo site_url('teams/viewteam/'.$row->tid);?>"><img class="player_img" src="<?php echo base_url(); ?><?php echo 'images/teams/th_'.$row->logo;?>" height="48px" width="48px" /></a>
				<div class="p_name" title=""><a href="<?php echo site_url('teams/viewteam/'.$row->tid);?>"><?php echo $row->tname;?></a></div>
				</div>
			<? }
			foreach($data['records'] as $r){?>
				<div class="team_list_ca fl">
				<a href="<?php echo site_url('profile/view/'.$r->id);?>"><img class="player_img" src="<?php echo base_url(); ?><?php if($r->image!='') echo 'images/th_'.$r->image;else echo $r->gender=='m'?"css/images/player_empty_image.png":"css/images/female_image.png";?>" height="48px" width="48px" /></a>
				<div class="p_name" title=""><a href="<?php echo site_url('profile/view/'.$r->id);?>"><?php echo $r->first_name;?></a></div>
				</div>
				<?php } ?>
			
				<span class="fr player_more"><a href="<?php echo site_url('teams/viewteam/'.$row->tid);?>">More..</a></span>
			</div>
			<div class="team_list_details"> 
				<span class="count"><a href="<?php echo site_url('teams/viewteam/'.$row->tid);?>"><?php echo $row->tname;?></a></span>
				<span class="play">Played<span class="count"> <?php echo $win_loss['win']+$win_loss['loss']+$win_loss['noresult'];?></span></span>
				<span class="won">Won <span class="count"><?php echo $win_loss['win'];?></span></span>
				<span class="loss">Loss <span class="count"><?php echo $win_loss['loss'];?></span></span>
				<span class="cap">Captain: <span class="count"><?php echo $row->captain; ?></span></span>
				 <?php
					
					if($row->is_approved!='' && $row->is_approved=='0'){
						?>
						<span class="cap"><span class="count">Request Sent</span></span>
						<?php
					}else if($row->is_approved==''){
                                            ?>

                                                <span class="loss"> <span class="count"> <a class='act-status jtmprf' id="join_team_in_profile" rel='<?php echo $row->tid;?>' status='a'>Join</a></span></span>
				   <?php }?>
			</div>
	
	
		<?php 
		}} else{
		?>
             <div class="team_list_row" align='center' style="color:#FF0000; font-size:14px; font-weight:bold">No Teams Found</div>
			<?php } }?>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
        <div id="pager_wrap">
            <div class="ca_page">
				<?php echo $this->pagination->create_links();	?>
            </div>
        </div>
</div>