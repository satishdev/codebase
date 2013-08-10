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
<div id='content_header'>
	<div class='hdr-text'>Sent Messages</div>
</div>

<div id="content_wrapper">
<div id="users_content_wrap">
    <div class="jqgrid_wrap">
        <table id="grid_table"></table>
        <div id="grid_pager"></div>
    </div>

    <script type="text/javascript" rel="javascript">
        inbox_sent_grid();
    </script>
</div>
</div>
