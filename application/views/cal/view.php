<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
  <head>    
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">    
    <title>Calendar Details</title>    
    <link href="<?php echo base_url();?>src/css/main.css" rel="stylesheet" type="text/css" />       
    <link href="<?php echo base_url();?>src/css/dp.css" rel="stylesheet" />    
    <link href="<?php echo base_url();?>src/css/dropdown.css" rel="stylesheet" />    
    <link href="<?php echo base_url();?>src/css/colorselect.css" rel="stylesheet" />   
     
    <script src="<?php echo base_url();?>src/jquery.js" type="text/javascript"></script>    
    <script src="<?php echo base_url();?>src/Plugins/Common.js" type="text/javascript"></script>        
    <script src="<?php echo base_url();?>src/Plugins/jquery.form.js" type="text/javascript"></script>     
    <script src="<?php echo base_url();?>src/Plugins/jquery.validate.js" type="text/javascript"></script>     
    <script src="<?php echo base_url();?>src/Plugins/datepicker_lang_US.js" type="text/javascript"></script>        
    <script src="<?php echo base_url();?>src/Plugins/jquery.datepicker.js" type="text/javascript"></script>     
    <script src="<?php echo base_url();?>src/Plugins/jquery.dropdown.js" type="text/javascript"></script>     
    <script src="<?php echo base_url();?>src/Plugins/jquery.colorselect.js" type="text/javascript"></script>    
   
  </head>
  <body>    
    <div>      
      <div class="infocontainer fform" style="top:0"> 
          
         <label>                    
            <span>Subject</span>                    
            <div><?php echo isset($event)?$event->description:"" ?></div>                  
          </label>
                    
          <label>                    
            <span>Time</span>                    
            <div>  
              <?php if(isset($event)){
			  if($event->isalldayevent!=0){
                  $sarr = php2JsTime(mySql2PhpTime($event->start_date));
                  $earr = php2JsTime(mySql2PhpTime($event->end_date));
				  }else{
				   $sarr =php2JsTime(strtotime($event->start_date));
                  	 $earr = php2JsTime(strtotime($event->end_date));
				  }
              }?>                    
              <?php echo isset($event)?$sarr:""; ?>
              <span style="display: inline;font-weight: normal;padding-left: 6px;">To</span>                       
              <?php echo isset($event)?$earr:""; ?>
            </div>                
          </label>
                    
        <?php if(isset($event)&&$event->isalldayevent!=0) { ?>          
        <label class="checkp">All Day Event</label>
        <?php } ?>
        
          <label>                    
            <span>Location:</span>                    
            <?php echo isset($event)?$event->location:"--"; ?>
          </label>
        
          <label>                    
            <span>Remark:</span>                    
            <div><?php echo isset($event)?$event->description:""; ?></div>
          </label>                
         
      </div>         
    </div>
  </body>
</html>