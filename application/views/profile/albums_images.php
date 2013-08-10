<script type="text/javascript" language="javascript">
	$(function(){
		$('.inside-album .thumb-img').fancybox({
            //title: "<div id='kirran'>Kiran Reddy</div>",
            //titlePosition: "inside",
            padding: 0,
            allowComments: true,
            onStart: function(selectedArray, selectedIndex, selectedOpts){
                $.ajax({
                    url:site_url+'pcomments/comments',
                    data: "img_id="+($(selectedArray[selectedIndex]).attr('img_id') || 0),
                    type:'POST',
                    dataType:'json',
                    beforeSend:function(){
                        $("#fancybox-comments").html($.spinner());
                    },
                    success:function(dataR){
                        $("#fancybox-comments").html($.getImageContents({data: dataR}));
                    }
                });
            }
        });
	});
</script>
<div id='content_header'>
	<div class='hdr-text'><?php  echo anchor('profile/view/'.$id,ucwords($u_details->first_name.' '.$u_details->last_name)).'> '.anchor('profile/gallery/'.$id,'Photos').' '.$info->name;?></div>
	
    <?php if($info->created_by==$this->userId){ echo smallButton(array('label'=>'Add New Image', 'href'=>site_url('players/addgalleryimage/'.$info->id))); } ?>
</div>

<div id="content_wrapper">
    <div class="opt_box_wrapper inside-album">
    	<?php if(isset($rows)) { ?>
        	<?php foreach($rows as $r) { ?>
            <div class='thumbnail'>
                <a class='thumb-img' rel='g1' img_id="<?php echo $r->img_id; ?>" href="<?php echo base_url();?>uploads/<?php echo $r->filename;?>">
                	<img class='thumb' src="<?php echo base_url();?>uploads/<?php echo $r->thumbnail;?>" />
                </a>
                <div class='thumb-info'>
				<?php if($info->created_by==$this->userId){ ?>
                    <div class='t-content'>&nbsp;
                        <a class='t-act edit' href="<?=site_url('players/editgalleryimage/'.$r->img_id)?>">Edit</a>
                        <a class='t-act delete'>Delete</a>
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