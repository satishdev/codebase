<div class="profile_image">
	<?php if($this->img_status=='not_empty'){ ?>
		<a target='_blank' href="#" onClick="window.open('<?php echo base_url().$this->org_image; ?>', '_blank', 'width=620, top=100,scrollbars=no');return false" >
	<?php } ?>
    <img class="impfn" src="<?php echo base_url(); ?><?php if($this->image!='') echo $this->image;else  echo $this->gender=='m'?"css/images/empty_image.png":"css/images/female_image.png";?>" height="100" width="100" />
	<?php if($this->img_status=='not_empty'){ ?></a><?php } ?>
	<?php if($this->img_status=='empty'){ ?><a class="t-act" href="<?php echo site_url('players/imageupload'); ?>" >Upload Image</a> <?php } ?>
</div>
<ul class="left_nav_list">
    <li><a href="<?php echo site_url('players/scheduler'); ?>" <?php if($this->uri->segment(2)=='scheduler') echo 'class="active"'?>>Calender</a></li>
   <!-- <li><a href="#">Events</a></li>-->
    <li><a href="<?php echo site_url('players/gallery'); ?>" <?php if($this->uri->segment(2)=='gallery' || $this->uri->segment(2)=='galimages') echo 'class="active"'?>>Photos</a></li>
   <!-- <li><a href="#">Videos</a></li>-->
</ul>