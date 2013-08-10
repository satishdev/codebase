<?php //print_r($sports_data);?>
<div id='content_header'>
	<div class='hdr-text'><?php  echo $u_details->first_name; ?> <?php  echo $u_details->last_name; ?> Albums</div>
</div>

<div id="content_wrapper" class="contacts">
    <div class="opt_box_wrapper player">
    <!-- <h3>Gallery</h3>-->
		<p><img src="<?php echo base_url();?>images/icon_add.png" alt="Add new" /><a href="<?=site_url("players/addgallery")?>">Add new</a></p>
		<table cellpadding="4" cellspacing="1" border="0" bgcolor="#cccccc" width="100%">
			<tr>
				<td bgcolor="#cccccc"><strong>Album</strong></td>
				<td bgcolor="#cccccc" colspan="4"><strong> Manage</strong></td>
			</tr>
		<?php if(isset($rows)) {
			foreach($rows['records'] as $r) { ?>
			<tr onmouseover="this.bgColor='#dddddd'" onmouseout ="this.bgColor='#ffffff'" bgcolor="#ffffff">
				<td><?php echo $r->name; ?></td>
				<td width="150"><img src="<?php echo base_url();?>images/icon_images.png" alt="Manage images" /> <a href="<?=site_url("players/galimages/".$r->id)?>">Manage Images</a></td>
				<td width="100"><img src="<?php echo base_url();?>images/icon_view.png" alt="View" /> <a href="<?=site_url("players/viewgallery/".$r->id)?>">View</a></td>
				<td width="100"><img src="<?php echo base_url();?>images/icon_update.png" alt="Edit" /> <a href="<?=site_url("players/updategallery/".$r->id)?>">Edit</a></td>
				<td width="100"><img src="<?php echo base_url();?>images/icon_delete.png" alt="Delete" /><a href="<?=site_url("players/galdelete/".$r->id)?>">Delete</a></td>
			</tr>
		<?php } } ?>
		</table>
        <div class="clear"></div>
    </div>

   
</div>