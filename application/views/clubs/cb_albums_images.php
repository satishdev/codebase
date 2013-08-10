<script type="text/javascript" language="javascript">
	$(function(){
		$('.inside-album .thumb-img').fancybox();
	});
</script>
<div id='content_header'>
	<div class='hdr-text'><?php echo $c_data->name;?>'s Club <?php echo $info->name;?> Gallery</div>
	
</div>

<div id="content_wrapper">
    <div class="opt_box_wrapper inside-album">
    	<?php if(isset($rows)) { ?>
        	<?php foreach($rows as $r) { ?>
            <div class='thumbnail'>
                <a class='thumb-img' rel='g1' href="<?php echo base_url();?>uploads/<?php echo $r->filename;?>">
                	<img class='thumb' src="<?php echo base_url();?>uploads/<?php echo $r->thumbnail;?>" />
                </a>
                <div class='thumb-info'>
				<?php if($info->created_by==$this->userId){ ?>
                    <div class='t-content'>&nbsp;
                    </div>
					<?php } ?>
                </div>
            </div>
            <?php } ?>
        <?php }else { ?>
		No Images Found
		<?php } ?>
        <div class="clear"></div>
    </div>
</div>