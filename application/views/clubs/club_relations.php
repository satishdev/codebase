<div class="panel_header hdr2">Sports</div>
<div class="profile_rows">
<?php if($sp_data) {?>
    <div class="profile_gallery">
    <?php foreach($sp_data as $srow){ ?>
        <div class="image_wraper">
        	
            <img src="<?php echo base_url(); ?><?php if($srow->logo!='') echo 'images/sports/th_'.$srow->logo;else echo "css/images/no_img_sp.jpg";?>" height="80" width="80" alt="No Image" />
            <div class='rel_name'><?php echo $srow->name;?></div>
        </div>
    <?php } ?>
        <br class="clear"/>
    </div>
    <div class="gallery_links">
       <!-- <a href="<?php echo site_url('sports/moresports/'.$id);?>">More...</a>-->
    </div>
<?php }else{ ?>
 <div class="profile_gallery">
        <div class="image_wraper">
        	
            <!--<div class='rel_name'><a href="<?php echo site_url('sports/allsports');?>">Sports you may know...</a></div>-->
        </div>
        <br class="clear"/>
    </div>
   
<?php } ?>
</div>

<div class="panel_header hdr2">Teams</div>
<div class="profile_rows">
<?php if($team_data) {?>
    <div class="profile_gallery">
    <?php  foreach($team_data as $trow){ ?>
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
        <!--<a href="<?php echo site_url('teams/moreteams/'.$id);?>">More...</a>-->
    </div><?php }else{ ?>
 <div class="profile_gallery">
        <div class="image_wraper">
        	
           <!-- <div class='rel_name'><a href="<?php echo site_url('teams/allteams');?>">Teams you may know...</a></div>-->
        </div>
        <br class="clear"/>
    </div>
   
<?php } ?>
</div>

<div class="panel_header hdr2">Members</div>
<div class="profile_rows">
<?php if($memb_data) {?>
    <div class="profile_gallery">
    <?php foreach($memb_data as $frow){ ?>
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
       <!-- <a href="<?php echo site_url('players/morefriends/'.$id);?>">More...</a>-->
    </div><?php }else{ ?>
 <div class="profile_gallery">
        <div class="image_wraper">
        	
           <!-- <div class='rel_name'><a href="<?php echo site_url('players/allplayers');?>">friends you may know...</a></div>-->
        </div>
        <br class="clear"/>
    </div>
   
<?php } ?>
</div>