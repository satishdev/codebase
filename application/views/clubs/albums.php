<div id='content_header'>
	<div class='hdr-text'>My Albums</div>
    <?php echo smallButton(array('label'=>'Add New Album', 'href'=>site_url('clubs/addgallery'))); ?>
</div>

<div id="content_wrapper">
    <div class="opt_box_wrapper <?php if(empty($album_id)){echo 'albums';}else{ echo 'inside-album';} ?>">
        <?php if(isset($rows)) {
			foreach($rows['records'] as $r) { ?>
            <div class='thumbnail'>
                <a class='thumb-img' href="<?=site_url('clubs/galimages/'.$r->id)?>">
                    <div class='thumb-wrap'>
                        <img class='thumb' src="<?php echo base_url();?>uploads/<?php echo $r->thumbnail;?>" />
                    </div>
                </a>
                <div class='thumb-info'>
                    <a class='t-name' href="<?=site_url('clubs/galimages/'.$r->id)?>"><?php echo $r->name; ?></a>
                    <div class='t-content'>
                    	<span class='t-count'><?php if($r->cnt!=0){ echo $r->cnt; if($r->cnt==1) echo ' Photo';else  echo ' Photos';}else{ echo 'No Photos';}?> </span>
                        <a class='t-act edit' href="<?=site_url("clubs/updategallery/".$r->id)?>">Edit</a>
                        <a class='t-act delete'>Delete</a>
                    </div>
                </div>
            </div>
            <?php } ?>
        <?php } ?>
        	
        <div class="clear"></div>
    </div>
</div>