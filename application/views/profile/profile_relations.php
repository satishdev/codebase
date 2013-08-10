<div class="panel_header hdr2">Sports</div>
<div class="profile_rows">
<?php if($s_cnt>0) {?>
    <div class="profile_gallery">
    <?php foreach($s_details as $srow){ ?>
        <div class="image_wraper">
        	
            <img src="<?php echo base_url(); ?><?php if($srow->logo!='') echo 'images/sports/th_'.$srow->logo;else echo "css/images/no_img_sp.jpg";?>" height="80" width="80" alt="No Image" />
            <div class='rel_name'><?php echo $srow->sname;?></div>
        </div>
    <?php } ?>
        <br class="clear"/>
    </div>
    <div class="gallery_links">
        <a href="<?php echo site_url('sports/moresports/'.$id);?>">More...</a>
    </div>
<?php }else{ ?>
 <div class="profile_gallery">
           <!-- <div class='rel_name'><a class="team_inner_link" href="<?php echo site_url('sports/allsports');?>">Sports you may know...</a></div>-->
		   <?php if($this->userId==$id){?>
			<div class='rel_name_add'><a class="team_inner_link" href="<?php echo site_url('sports/add_sports');?>">Add Sports</a></div>
			<?php }else{?>
			<div class='rel_name_add'>No Sports</div>
			<?php } ?>
    </div>
   
<?php } ?>
</div>

<div class="panel_header hdr2">Teams</div>
<div class="profile_rows">
<?php if($t_cnt>0) {?>
    <div class="profile_gallery">
    <?php  foreach($t_details as $trow){ ?>
        <div class="image_wraper">
        	<a class='img_support' href="<?php echo site_url('teams/viewteam/'.$trow->tid);?>">
            <img src="<?php echo base_url(); ?><?php if($trow->logo!='') echo 'images/teams/th_'.$trow->logo;else echo "css/images/no_team.jpg";?>" height="80" width="80" alt="No Image" />
            </a>
            <div class='rel_name'><a href="<?php echo site_url('teams/viewteam/'.$trow->tid);?>"><?php echo $trow->tname;?></a></div>
        </div>
        
         <?php } ?>
        <br class="clear"/>
    </div>
    <div class="gallery_links">
        <a href="<?php echo site_url('teams/moreteams/'.$id);?>">More...</a>
    </div><?php }else{ ?>
 <div class="profile_gallery">
        	
           <!-- <div class='rel_name'><a class="team_inner_link" href="<?php echo site_url('teams/allteams');?>">Teams you may know...</a></div>-->
			  <?php if($this->userId==$id){?>
			  <div class='rel_name_add_join'><a class="team_inner_link" href="<?php echo site_url('teams/allteams');?>">Join Teams </a></div>
			<div class='rel_name_add'><a class="team_inner_link" href="<?php echo site_url('teams/add_teams');?>">Create Teams </a></div>
			<?php }else{?>
			<div class='rel_name_add'>No Teams</div>
			<?php } ?>
    </div>
   
<?php } ?>
</div>

<div class="panel_header hdr2">Friends</div>
<div class="profile_rows">
<?php if($f_cnt>0) {?>
    <div class="profile_gallery">
    <?php foreach($f_details as $frow){ ?>
        <div class="image_wraper">
        	<a class='img_support' href="<?php echo site_url('profile/view/'.$frow->pid);?>">
            <img src="<?php echo base_url(); ?><?php if($frow->image!='') echo 'images/th_'.$frow->image;else echo $frow->gender=='m'?"css/images/empty_image.png":"css/images/female_image.png";?>" height="80" width="80" alt="No Image" />
            </a>
            <div class='rel_name'><a href="<?php echo site_url('profile/view/'.$frow->pid);?>"><?php echo $frow->pname;?></a></div>
        </div>
         <?php } ?>
        
        <br class="clear"/>
    </div>
    <div class="gallery_links">
        <a href="<?php echo site_url('players/morefriends/'.$id);?>">More...</a>
    </div><?php }else{ ?>
 <div class="profile_gallery">
           <!-- <div class='rel_name'><a class="team_inner_link" href="<?php echo site_url('players/allplayers');?>">Friends you may know...</a></div>-->
			  <?php if($this->userId==$id){?>
			 <div class='rel_name_add'><a class="team_inner_link" href="<?php echo site_url('players/allplayers');?>">Add sPartners</a></div>
			<?php }else{?>
			<div class='rel_name_add'>No sPartners</div>
			<?php } ?>
			
    </div>
   
<?php } ?>
</div>