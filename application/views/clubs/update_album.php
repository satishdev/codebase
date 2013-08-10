<script>
$(document).ready(function() {
       $("#appl_form").validate({
		messages: {
			name: {required: "Please enter Name"},
			description: {required: "Please enter description"}
		}
	});
});

</script>

<div id='content_header'>
	<div class='hdr-text'>Edit Gallery</div>
</div>

<div id='content_wrapper' class="pad">
<?php if(isset($rows) and $rows!='') { ?>
<form id="appl_form" method="post" enctype="multipart/form-data" action="<?php echo site_url('clubs/updategallery');?>" name="appl_form">
<input  type="hidden" name="id" id="id" value="<?php echo $rows->id;?>" />
    <ul class='wesp-form'>
        <li>
            <label for="name">Name</label>
			<input  type="text" name="name" class="text field required" id="name" value="<?php echo $rows->name;?>" />
        </li>
		<li>
            <label for="description">Description</label>
           	<textarea name="description" class="required" id="description"><?php echo $rows->description;?></textarea>
        </li>
        <li class='frm-btns'>
			<input type="submit" value="submit" name="submit" class="button_img"/>
        </li>
    </ul>
</form>
<?php }?>
</div>