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
	$(".delete_act").live("click", function(){		
			var FRM = $(this);
			$.album_delete_post(FRM);		
			//$(FRM).submit();
		});
      
});
$.extend({
	album_delete_post: function(FRM){
		var data ='albid='+FRM.attr("rel");
		$.ajax({
		    type: "POST",
		    url: "<?php echo site_url('teams/imgdelete');?>",
		    data: data,
		    dataType: "json",
		    beforeSend: function(){
		        //console.log(data);
		      //$("#system_notification").hide();
		    },
		    success: function(data){

		    	if(data.status){
		    		//window.location.href = base_url+"home";	
					var smsg='<div class="success">'+data.message+'</div>';
					 $("#system_notification").html(smsg).show();
					 $(FRM).closest('.thumbnail').hide();
					  /*setTimeout(function(){
                                            window.location.href = base_url+"teams/gallery";
                                        }, 3000);*/
					 
		    	}else{
		    		var emsg='<div class="error">'+data.message+'</div>';
					$(FRM).closest('.thumbnail').hide();
					 $("#system_notification").html(emsg).show();
		    	}
		        
		    },
		    error: function(e, a){
		       // window.location.href = base_url+"home";
		    }
		});
	}
});
</script>
<div id='content_header'>
	<div class='hdr-text'><?php echo  anchor('',ucwords($this->userFname.' '.$this->userLname)).'>'.anchor('players/gallery','Photos').' '.$info->name;?></div>
	
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
                        <a class='t-act delete delete_act' rel="<?=$r->img_id?>">Delete</a>
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