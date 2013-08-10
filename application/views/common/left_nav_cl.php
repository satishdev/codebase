<div class="profile_image">
    <img class="impfn" src="<?php echo base_url(); ?><?php if($this->image!='') echo $this->image;else  echo $this->gender=='m'?"css/images/empty_image.png":"css/images/female_image.png";?>" height="100" width="100" />
</div>
<ul class="left_nav_list">
    <li><a href="<?php echo site_url('clubs/scheduler'); ?>">Calender</a></li>
    <!--<li><a href="#">Events</a></li>-->
    <li><a href="<?php echo site_url('clubs/gallery'); ?>">Photos</a></li>
  <!--  <li><a href="#">Videos</a></li>-->
</ul>