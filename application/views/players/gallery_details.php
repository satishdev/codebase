<div id='content_header'>
	<div class='hdr-text'><?php  echo $u_details->first_name; ?> <?php  echo $u_details->last_name; ?> View Gallery </div>
</div>

<div id='content_wrapper' class="pad">
<?php if(isset($rows) and $rows!='') {
		 ?>
    <ul class='wesp-form'>
        <li>
            <label for="name">Name:</label>
			<?php echo $rows->name;?>
        </li>
		
		<li>
            <label for="description">Description:</label>
           	<?php echo $rows->description;?>
        </li>
		
		
    </ul>
<?php }?>
<p><a href="<?php echo site_url("players/gallery")?>">Back to Gallery</a></p>
</div>