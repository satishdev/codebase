<?php //print_r($sports_data);?>
<div id='content_header'>
	<div class='hdr-text'><?php  echo $u_details->first_name; ?> <?php  echo $u_details->last_name; ?> Album <?php echo $info->name;?> - Images</div>
</div>

<div id="content_wrapper" class="contacts">
    <div class="opt_box_wrapper player">
		<p><img src="<?php echo base_url();?>images/icon_add.png" alt="Add new" /> <a href="<?php echo site_url("players/addgalleryimage/".$info->id)?>">Add image</a></p>
		<?php if(!isset($rows)) { ?>
		<p>There are no images to display</p>
		<?php } else { ?>
		<table cellpadding="5" cellspacing="1" border="0" bgcolor="#cccccc" width="100%">
		<tr>
			<td><strong>Image</strong></td>
			<td><strong>Caption</strong></td>
			<td colspan="2"><strong>Action</strong></td>
		</tr>
		<?php foreach($rows as $r) : ?>
		<tr>
			<td class="gallerypic" bgcolor="#ffffff" width="70"><a href="<?php echo base_url();?>uploads/<?php echo $r->filename;?>"><img src="<?php echo base_url();?>uploads/<?php echo $r->thumbnail;?>" /></td>
				<td bgcolor="#ffffff"><?php echo $r->caption;?></td>

			<td bgcolor="#ffffff" width="70"><img src="<?php echo base_url();?>images/icon_update.png" alt="Edit" /> <a href="<?php echo site_url("players/editgalleryimage/".$r->img_id)?>">Edit</a></td>
			<td bgcolor="#ffffff" width="70"><img src="<?php echo base_url();?>images/icon_delete.png" alt="Delete" /> <a href="<?php echo site_url("gallery/removeimage/".$r->img_id)?>">Delete</a></td>
		</tr>
		<?php endforeach; ?>
		</table>
		<?php } ?>
        <div class="clear"></div>
    </div>

   
</div>