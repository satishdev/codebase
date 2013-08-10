<div class="profile_image border_b pad5">
    <img class="impfn" src="<?php echo base_url(); ?><?php if($t_details->logo!='') echo 'images/teams/th_'.$t_details->logo;else echo "css/images/no_image.jpg";?>" height="100" width="100" />
 
</div>
<ul class="left_nav_list">
  <li><a style="padding-left:5px;" href="<?php echo site_url('teams/scheduler/'.$t_details->id);?>" <?php if($this->uri->segment(2)=='scheduler') echo 'class="active"'?>>Calendar</a></li>
		 <li> <a style="padding-left:5px;" href="<?php echo site_url('teams/gallery/'.$t_details->id);?>" <?php if($this->uri->segment(2)=='gallery') echo 'class="active"'?>>Photos</a></li> 
		  
		<?php
		if(/*$t_details->is_approved=='1' || */$this->userId==$t_details->created_by){
		?>
		 <li> <a style="padding-left:5px;" href="<?php echo site_url('teams/addgallery/'.$t_details->id);?>" <?php if($this->uri->segment(2)=='addgallery') echo 'class="active"'?>>Add Gallery</a></li>
		 <?php if($this->userId==$t_details->created_by){?>
        <li><a style="padding-left:5px;" href="<?php echo site_url('teams/sendinvites/'.$t_details->id);?>" <?php if($this->uri->segment(2)=='sendinvites') echo 'class="active"'?>>Invite Players</a></li>
		<?php } ?>
		
		 <?php } ?>
</ul>
