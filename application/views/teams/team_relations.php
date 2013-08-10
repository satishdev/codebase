<div class="panel_header hdr2"><div class='hdr2-text'>Players</div></div>
<?php if($f_cnt>0){?>
<div class="profile_rows">
	<div class="profile_gallery">
	<?php foreach($f_details as $frow){?>
		<div class="image_wraper">
        	<a class='img_support' href="<?php echo site_url('profile/view/'.$frow->id);?>">
			<img src="<?php echo base_url(); ?><?php if($frow->image!='') echo 'images/th_'.$frow->image;else echo $frow->gender=='m'?"css/images/empty_image.png":"css/images/female_image.png";?>" height="80" width="80" alt="No Image" />
            </a>
            <div class='rel_name'><a href="<?php echo site_url('profile/view/'.$frow->id);?>"><?php echo $frow->first_name.' '.$frow->last_name;?></a></div>
		</div>
	<?php }?>
    <br class="clear"/>
	</div>
	<!--<div class="gallery_links">
		 <a class="more" href="<?php echo site_url('teams/teamusers/'.$frow->tid);?>">More..</a>
	</div>-->
</div>
<?php }else{?>
<div class="profile_rows">
	<div class="profile_gallery">
	No Players Found
    <br class="clear"/>
	</div>
	
</div>
<?php }?>