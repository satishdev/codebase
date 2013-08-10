<script>

$(function(){
	
	$('#club_news .l-item-hdr').die('click').live('click', function(){
		var me = $(this);
		if(me.hasClass('active')){
			me.next('.l-item-info').slideUp(300, function(){
				me.removeClass('active')
			});
		}else{
			$('#club_news .l-item-hdr.active').removeClass('active').next('.l-item-info').slideUp(300);
			me.addClass('active').next('.l-item-info').slideDown(300);
		}
	})
	
});
</script>
<div id='content_header'>
	<div class='hdr-text'>Club News</div>
</div>

<div id="content_wrapper">
<div class="club_items facilities">
	<?php if(count($club_data) > 0){ ?>
    	<ul id="club_news" class="features_list">
    	<?php foreach($club_data as $row){	?>
            <li class="l-item">
            	<div class="l-item-hdr"><?php echo $row->headline; ?></div>
                <div class="l-item-info"><?php echo nl2br($row->description); ?><span><a href="<?php echo site_url();?>">Edit</a></span></div>
            </li>
    	<?php } ?>
        </ul>
    <?php }else{ ?>
    	<div class="no_no">No News Found</div>
    <?php } ?>
    <div class="clear"></div>
</div>
</div>