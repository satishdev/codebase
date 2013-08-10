<style type="text/css" rel="stylesheet">
    /*.content .mainbar .article {
        margin: 0 0 20px 0;
        padding: 0px 0px 10px;
        width: 970px;
    }*/
    .ui-jqgrid tr.ui-row-ltr td {        
		padding: 10px;
    }
</style>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/jquery-ui.css"/>

<script type="text/javascript" language="javascript">
$(function(){

$('.horizontal_tab a').die('click').live('click', function(){
	var me = $(this);
	$('.horizontal_tab .active_tab').removeClass('active_tab');
	me.addClass('active_tab');
	if(me.attr('id') == "inbox_notifications"){
		
	}else{
	}
});

});
</script>

<div id='content_header'>
	<div class='hdr-text'>Inbox</div>
    <?php
	$obj = array();
	$obj['options'][] = array('id'=>'inbox_messages', 'label'=>'Messages', 'href'=>site_url('inbox'), 'active'=>true);
	$obj['options'][] = array('id'=>'inbox_invitations', 'label'=>'Invitations', 'href'=>site_url('inbox/invitation'));
	$obj['options'][] = array('id'=>'inbox_notifications', 'label'=>'Notifications', 'href'=>site_url('inbox/notifications'));
    echo horizontalTab($obj);
	?>
</div>

<div id="content_wrapper">
<div id="users_content_wrap">
    <div class="jqgrid_wrap">
    <table id="grid_table"></table>
    <div id="grid_pager"></div>
    </div>

    <script type="text/javascript" rel="javascript">
        inbox_grid();
    </script>
</div>
</div>
