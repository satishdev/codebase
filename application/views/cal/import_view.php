<script type="text/javascript" src="<?php echo base_url();?>js/jquery.library.js"></script>
<?php
$this->load->view($links_js_css);
?>
<div id='content_header'>
    <div class='hdr-text'>Import Calendar</div>
</div>

<div id='content_wrapper' class="pad">
    <form id="import_ics" method="post" enctype="multipart/form-data" action="<?php echo site_url('players/import_events');?>" name="import_ics">
        <ul class='wesp-form'>
            <li>
                <label for="logo1">Upload ICS File:</label>
                <input type="file" name="file_upload" id="file_upload" />
                <!--<div id="file_upload"></div>-->
            </li>
            <!--<div id="fileUpload">You have a problem with your javascript</div>
	<a href="javascript:startUpload('fileUpload')">Start Upload</a> |  <a href="javascript:$('#fileUpload').fileUploadClearQueue()">Clear Queue</a>-->
            <li>
                <input type="submit" value="submit" name="submit" id="button_img" class="button_img" style="left: auto"/>
            </li>
        </ul>
    </form>
</div>