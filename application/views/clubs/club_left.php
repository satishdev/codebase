<div class="profile_image">
    <img class="impfn" src="<?php echo base_url(); ?><?php if($c_data->logo!='')  echo 'images/th_'.$c_data->logo;else echo "css/images/no_image.png";?>" height="100" width="100" />
</div>
<ul class="left_nav_list">
    <li><a href="<?php echo site_url('cb/scheduler/'.$c_data->clbid); ?>">Calender</a></li>
    <!--<li><a href="#">Events</a></li>-->
    <li><a href="<?php echo site_url('cb/gallery/'.$c_data->clbid); ?>">Photos</a></li>
   <!-- <li><a href="#">Videos</a></li>-->
</ul>