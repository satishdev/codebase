<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<title>WESportonline Admin</title>
<link href="<?=base_url()?>asserts/admin_theme/css/main.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/jquery-1.7.2.min.js"></script>

<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/spinner/ui.spinner.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/spinner/jquery.mousewheel.js"></script>

<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/jquery-ui-1.8.22.custom.min.js"></script>

<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/charts/excanvas.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/charts/jquery.sparkline.min.js"></script>

<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/forms/uniform.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/forms/jquery.cleditor.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/forms/jquery.validationEngine-en.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/forms/jquery.validationEngine.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/forms/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/forms/autogrowtextarea.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/forms/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/forms/jquery.dualListBox.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/forms/jquery.inputlimiter.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/forms/chosen.jquery.min.js"></script>

<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/wizard/jquery.form.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/wizard/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/wizard/jquery.form.wizard.js"></script>

<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/uploader/plupload.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/uploader/plupload.html5.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/uploader/plupload.html4.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/uploader/jquery.plupload.queue.js"></script>

<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/tables/datatable.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/tables/tablesort.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/tables/resizable.min.js"></script>

<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/ui/jquery.tipsy.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/ui/jquery.collapsible.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/ui/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/ui/jquery.progress.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/ui/jquery.timeentry.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/ui/jquery.colorpicker.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/ui/jquery.jgrowl.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/ui/jquery.breadcrumbs.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/ui/jquery.sourcerer.js"></script>

<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/calendar.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/plugins/elfinder.min.js"></script>

<script type="text/javascript" src="<?=base_url()?>asserts/admin_theme/js/custom.js"></script>

</head>

<body>

<!-- Left side content -->
<? $this->load->view('admin/gama_admin/left_menu');?>


<!-- Right side -->
<div id="rightSide">

    <!-- Top fixed navigation -->
    <div class="topNav">
        <div class="wrapper">
            <div class="welcome"><a href="#" title=""><img src="<?=base_url()?>asserts/admin_theme/images/userPic.png" alt="" /></a><span>Howdy, Eugene!</span></div>
            <div class="userNav">
                <ul>
                   
                    <li><a href="<?=base_url()?>admin/user_golf_booking/logout" title=""><img src="<?=base_url()?>asserts/admin_theme/images/icons/topnav/logout.png" alt="" /><span>Logout</span></a></li>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    
    <!-- Responsive header -->
    
    
    <!-- Title area -->
    <div class="titleArea">
        <div class="wrapper">
            <div class="pageTitle">
                <h5></h5>
                <span></span>
            </div>
            
            <div class="clear"></div>
        </div>
    </div>
    
   
    
    <!-- Page statistics area -->
    
    
   
    
    <!-- Main content wrapper -->
    <? echo $content;?>
    
    <!-- Footer line -->
    <div id="footer">
        <div class="wrapper">As usually all rights reserved.<!-- And as usually brought to you by <a href="http://themeforest.net/user/Kopyov?ref=kopyov" title="">Eugene Kopyov</a>-->
		</div>
    </div>

</div>

<div class="clear"></div>

</body>
</html>