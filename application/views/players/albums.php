<script>
$(document).ready(function() {
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
		    url: "<?php echo site_url('teams/albdelete');?>",
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
	<div class='hdr-text'><?php echo  anchor('',ucwords($this->userFname.' '.$this->userLname)); ?> Photos</div>
    <?php echo smallButton(array('label'=>'Add New Album', 'href'=>site_url('players/addgallery'))); ?>
</div>

<div id="content_wrapper">
    <div class="opt_box_wrapper <?php if(empty($album_id)){echo 'albums';}else{ echo 'inside-album';} ?>">
        <?php if(isset($rows)) {
			foreach($rows['records'] as $r) { ?>
            <div class='thumbnail'>
                <a class='thumb-img' href="<?=site_url('players/galimages/'.$r->id)?>">
                    <div class='thumb-wrap'>
                        <img class='thumb' src="<?php echo base_url();?>uploads/<?php echo $r->thumbnail;?>" />
                    </div>
                </a>
                <div class='thumb-info'>
                    <a class='t-name' href="<?=site_url('players/galimages/'.$r->id)?>"><?php echo $r->name; ?></a>
                    <div class='t-content'>
                    	<span class='t-count'><?php if($r->cnt!=0){ echo $r->cnt; if($r->cnt==1) echo ' Photo';else  echo ' Photos';}else{ echo 'No Photos';}?> </span>
                        <a class='t-act edit' href="<?=site_url("players/updategallery/".$r->id)?>">Edit</a>
                        <a class='t-act delete delete_act' rel="<?=$r->id?>">Delete</a>
                    </div>
                </div>
            </div>
            <?php } ?>
        <?php } ?>
        	
        <div class="clear"></div>
    </div>
</div>