<script type="text/javascript" language="javascript">
	$(function(){
		$('.inside-album .thumb-img').fancybox({
				'transitionIn'	:	'elastic',
				'transitionOut'	:	'elastic',
				'speedIn'		:	600, 
				'speedOut'		:	200
			});
	});
</script>
<div id='content_header'>
	<div class='hdr-text'>My Albums</div>
    <?php echo smallButton(array('label'=>'Available Teams', 'href'=>site_url('teams/allteams/'))); ?>
</div>

<div id="content_wrapper">
    <div class="opt_box_wrapper <?php if(empty($album_id)){echo 'albums';}else{ echo 'inside-album';} ?>">
    	<?php if(empty($album_id)){ ?>
        	<?php for($i=0; $i<10; $i++){ ?>
            <div class='thumbnail'>
                <a class='thumb-img' href="<?php echo site_url(); ?>gallery/albums/2">
                    <div class='thumb-wrap'>
                        <img class='thumb' src="<?php echo base_url(); ?>css/images/slider-2.jpg" />
                    </div>
                </a>
                <div class='thumb-info'>
                    <a class='t-name' href="<?php echo site_url(); ?>gallery/albums/2">My Album</a>
                    <div class='t-content'>8 Photos</div>
                </div>
            </div>
            <?php } ?>
        <?php }else{ ?>
        	<?php for($i=2; $i<5; $i++){ ?>
            <div class='thumbnail'>
                <a class='thumb-img' rel='g1' href="<?php echo base_url(); ?>css/images/slider-<?php echo $i; ?>.jpg">
                	<img class='thumb' src="<?php echo base_url(); ?>css/images/slider-<?php echo $i; ?>.jpg" />
                </a>
            </div>
            <?php } ?>
        <?php } ?>
    	
        <div class="clear"></div>
    </div>
</div>