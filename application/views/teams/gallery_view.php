<?php if($t_details){?>
<div id='content_header'>
	<div class='hdr-text'><?php  echo $t_details->name;?> Team</div>
</div>

<div id='content_wrapper' class="pad profile_wrapper">
        <div class="profile_content border bshadow posrel">
            <div class="left_panel border_r fl h100">
                <div class="profile_image border_b pad5">
        <img class="impfn" src="<?php echo base_url(); ?><?php if($t_details->logo!='') echo 'images/teams/'.$t_details->logo;else echo "css/images/no_team.png";?>" height="100" width="100" />
                </div>
                <div class="profile_actions">
                    <div class="actions_section pad5">
                       <?php if($t_details->is_approved=='1' && $this->userId!=$t_details->created_by){?>
                        	<a href="#">Remove Team.</a>
						<?php }else if($t_details->is_approved=='0' && $this->userId!=$t_details->created_by){?>
						 	<a href="#">Waiting for approval.</a>
						<?php } else if($t_details->is_approved=='' && $this->userId!=$t_details->created_by){?>
                        	<a href="#">Join Team.</a>
						<?php } ?>
						
                    </div>
					<div class="actions_section  pad5">
                       <?php if($this->userId==$t_details->created_by)
					{?>
                        <a style="padding-left:5px;" href="<?php echo site_url('teams/edit_teams/'.$t_details->id);?>">Edit Team.</a><br />
						 <a style="padding-left:5px;" href="<?php echo site_url('teams/addgallery/'.$t_details->id);?>">Add Gallery.</a>
						 <br />
						 <a style="padding-left:5px;" href="<?php echo site_url('teams/iviteplayers/'.$t_details->id);?>">Invite Players.</a>
						<?php } ?>
						
                    </div>
                </div>
            </div>
            
            <div class="middle_panel big_middle_panel border_r fl">
                <div class="panel_header hdr2">
                	<ul class='team_tabs'>
                    	<li class='left'><a class='hdr2-text' href="<?php echo site_url('teams/viewteam/'.$t_details->id);?>">Profile</a></li>
                        <li><a class='hdr2-text' href="<?php echo site_url('teams/gallery/'.$t_details->id);?>">Gallery</a></li>
                    </ul>
                </div>
               <p><img src="<?php echo base_url();?>images/icon_add.png" alt="Add new" /><a href="<?=site_url("teams/addgallery/".$id)?>">Add new</a></p>
		<table cellpadding="4" cellspacing="1" border="0" bgcolor="#cccccc" width="100%">
			<tr>
				<td bgcolor="#cccccc"><strong>Album</strong></td>
				<td bgcolor="#cccccc" colspan="4"><strong> Manage</strong></td>
			</tr>
		<?php if(isset($rows)) {
			foreach($rows['records'] as $r) { ?>
			<tr onmouseover="this.bgColor='#dddddd'" onmouseout ="this.bgColor='#ffffff'" bgcolor="#ffffff">
				<td><?php echo $r->name; ?></td>
				<td width="150"><img src="<?php echo base_url();?>images/icon_images.png" alt="Manage images" /> <a href="<?=site_url("teams/galimages/".$r->id)?>">Manage Images</a></td>
				<td width="100"><img src="<?php echo base_url();?>images/icon_view.png" alt="View" /> <a href="<?=site_url("teams/viewgallery/".$id.'/'.$r->id)?>">View</a></td>
				<td width="100"><img src="<?php echo base_url();?>images/icon_update.png" alt="Edit" /> <a href="<?=site_url("teams/updategallery/".$r->id)?>">Edit</a></td>
				<td width="100"><img src="<?php echo base_url();?>images/icon_delete.png" alt="Delete" /><a href="<?=site_url("teams/galdelete/".$r->id)?>">Delete</a></td>
			</tr>
		<?php } } ?>
		</table>
            </div>
            
            <div class="right_panel small_right_panel fl">
                <div class="panel_header hdr2"><div class='hdr2-text'>Players</div></div>
				<?php if($f_cnt>0){?>
                <div class="profile_rows ">
                    <div class="profile_galary pad3">
					<?php foreach($f_details as $frow){?>
                        <div class="image_wraper">
                        	<a class='img_support' href="#">
                            <img src="<?php echo base_url(); ?><?php if($frow->image!='') echo 'images/'.$frow->image;else echo $frow->gender=='m'?"css/images/empty_image.png":"css/images/female_image.png";?>" height="80" width="80" alt="No Image" />
                            </a>
                            <a class='rel_name'><a href="#">Shankar</a></div>
                        </div>
                        <?php }?>
                        <br class="clear"/>
                    </div>
                    <div class="galary_links">
                        <a class="more" href="<?php echo site_url('teams/teamusers/'.$frow->tid);?>">More...</a>
                    </div>
                </div>
				<?php }?>
                
            </div>


            <div class="clear"></div>
    </div><?php }?>
</div>