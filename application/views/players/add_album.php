<script>
$(document).ready(function() {
$("#button_img").live("click", function(){		
			var FRM = $("#appl_form");
			$.album_validate(FRM);		
			//$(FRM).submit();
		});
      
});
$.extend({
	album_validate: function(FRM){
		$(FRM).validate({
					messages: {
						name: {required: "Please enter Name"}/*,
						description: {required: "Please enter description"}*/
					},
            errorPlacement: function(error, element){
               $(element).closest('li').append(error);
            },
            submitHandler: function(form){
            	$.album_post(form);
            }
	});
	},
	album_post: function(FRM){
		var data = $(FRM).serialize();
		$.ajax({
		    type: "POST",
		    url: "<?php echo site_url('players/addgallery');?>",
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
					  setTimeout(function(){
                                            window.location.href = base_url+"players/gallery";
                                        }, 3000);
					 
		    	}else{
		    		var emsg='<div class="error">'+data.message+'</div>';
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
	<div class='hdr-text'>Add New Gallery</div>
</div>

<div id='content_wrapper' class="pad">
<form id="appl_form" method="post" enctype="multipart/form-data" action="<?php echo site_url('players/addgallery');?>" name="appl_form">
    <ul class='wesp-form'>
        <li>
            <label for="name">Name</label>
			<input  type="text" name="name" class="text field required" id="name" />
        </li>
		
		<li>
            <label for="description">Description</label>
           	<textarea name="description" class="" id="description"></textarea>
        </li>
		
		<li>
            <label for="logo1">Upload Photos:</label>
			<!--<input type="file" name="file_upload" id="file_upload" />-->
			<div id="file_upload"></div>
        </li>		
		<!--<div id="fileUpload">You have a problem with your javascript</div>
	<a href="javascript:startUpload('fileUpload')">Start Upload</a> |  <a href="javascript:$('#fileUpload').fileUploadClearQueue()">Clear Queue</a>-->
        <li class='frm-btns'>
			<input type="submit" value="submit" name="submit" id="button_img" class="button_img"/>
        </li>
    </ul>
</form>
</div>