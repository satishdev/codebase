<?php //print_r($sports_data);?>
<div id='content_header'>
	<div class='hdr-text'><?php if($this->userType==2) echo  anchor('',ucwords($this->userFname.' '.$this->userLname)).' Teams';else echo "Teams";?></div>
    <?php if($this->userType==2) echo smallButton(array('label'=>'Join teams', 'href'=>site_url('teams/allteams/'))); ?>
</div>

<div id="content_wrapper">
    <div class="opt_box_wrapper team">
         <?php if($total>0){ foreach($sports_data as $row){
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
				<span class="count" title="<?php echo $row->tname;?>"><a href="<?php echo site_url('teams/viewteam/'.$row->tid);?>"><?php echo $row->tname;?></a></span>
				<span class="play">Played<span class="count"> <?php echo $win_loss['win']+$win_loss['loss']+$win_loss['noresult'];?></span></span>
				<span class="won">Won <span class="count"><?php echo $win_loss['win'];?></span></span>
				<span class="loss">Loss <span class="count"><?php echo $win_loss['loss'];?></span></span>
				<span class="cap">Captain <span class="count" title="<?php echo $row->captain; ?>"><?php echo $row->captain;?></span></span>
			</div>
	
	
		<?php 
		}} else{
		?>
		<div class='contact_card fl'>
             No Teams Found
            </div>
			<?php } ?>
        <div class="clear"></div>
    </div>
	<div class="ca_page">	
		<?php echo $this->pagination->create_links();	?>
	</div>
   
</div>