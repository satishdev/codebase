<?php if($u_details){ ?>
<div id='content_header'>
	<div class='hdr-text'><?php  echo anchor('profile/view/'.$id,ucwords($u_details->first_name.' '.$u_details->last_name)); ?> Photos</div>
    <?php
	/*$obj = array();
	$obj['options'][] = array('id'=>'player_profile', 'label'=>'Profile', 'href'=>site_url('profile/view/'.$id));
	$obj['options'][] = array('id'=>'gallery', 'label'=>'Gallery', 'href'=>site_url('profile/gallery/'.$id), 'active'=>true);
    echo horizontalTab($obj);*/
	?>
</div>

<div id="content_wrapper">
    <div class="opt_box_wrapper <?php if(empty($album_id)){echo 'albums';}else{ echo 'inside-album';} ?>">
        <?php if(isset($rows) and !empty($rows['records'])) {
			foreach($rows['records'] as $r) { ?>
            <div class='thumbnail'>
                <a class='thumb-img' href="<?=site_url("profile/galimages/".$id."/".$r->id)?>">
                    <div class='thumb-wrap'>
                        <img class='thumb' src="<?php echo base_url();?>uploads/<?php echo $r->thumbnail;?>" />
                    </div>
                </a>
                <div class='thumb-info'>
                    <a class='t-name' href="<?=site_url("profile/galimages/".$id."/".$r->id)?>"><?php echo $r->name; ?></a>
                    <div class='t-content'>
                    	<span class='t-count'><?php if($r->cnt!=0){ echo $r->cnt; if($r->cnt==1) echo ' Photo';else  echo ' Photos';}else{ echo 'No Photos';}?> </span>
						<?php if($r->owner==$this->userId){?>
                        <a class='t-act edit' href="<?=site_url("profile/updategallery/".$r->id)?>">Edit</a>
                        <a class='t-act delete'>Delete</a>
						<?php }?>
                    </div>
                </div>
            </div>
            <?php } ?>
        <?php }else{ ?>
        	No Albums Found
			<?php } ?>
        <div class="clear"></div>
    </div>
</div>
<?php }?>