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
     
    <script type="text/javascript">
        if (!DateAdd || typeof (DateDiff) != "function") {
            var DateAdd = function(interval, number, idate) {
                number = parseInt(number);
                var date;
                if (typeof (idate) == "string") {
                    date = idate.split(/\D/);
                    eval("var date = new Date(" + date.join(",") + ")");
                }
                if (typeof (idate) == "object") {
                    date = new Date(idate.toString());
                }
                switch (interval) {
                    case "y": date.setFullYear(date.getFullYear() + number); break;
                    case "m": date.setMonth(date.getMonth() + number); break;
                    case "d": date.setDate(date.getDate() + number); break;
                    case "w": date.setDate(date.getDate() + 7 * number); break;
                    case "h": date.setHours(date.getHours() + number); break;
                    case "n": date.setMinutes(date.getMinutes() + number); break;
                    case "s": date.setSeconds(date.getSeconds() + number); break;
                    case "l": date.setMilliseconds(date.getMilliseconds() + number); break;
                }
                return date;
            }
        }
        function getHM(date)
        {
             var hour =date.getHours();
             var minute= date.getMinutes();
             var ret= (hour>9?hour:"0"+hour)+":"+(minute>9?minute:"0"+minute) ;
             return ret;
        }
        $(document).ready(function() {
            var id = '<?php echo $id;?>';
			$( "#lb_yr_team" ).find('select').removeClass('required');
			$( "#lb_yr_team" ).hide();
			$( "#lb_fv_team" ).find('select').removeClass('required');
			$( "#lb_fv_team" ).hide();
			if(id!='0')
			{
				var calender_type = '<?php echo $event->calender_type;?>';
				if(calender_type==4)
				  {
					$( "#lb_yr_team" ).find('select').addClass('required');
					$( "#lb_yr_team" ).show();
					$( "#lb_fv_team" ).find('select').addClass('required');
					$( "#lb_fv_team" ).show();
					$( "#what_team" ).find('.whattext').removeClass('required');
					$( "#what_team" ).hide();
				  }
				  else
				  {
					$( "#lb_yr_team" ).find('select').removeClass('required');
					$( "#lb_yr_team" ).hide();
					$( "#lb_fv_team" ).find('select').removeClass('required');
					$( "#lb_fv_team" ).hide();
					$( "#what_team" ).show();
					$( "#what_team" ).find('.whattext').addClass('required');
				  }
			}
			
			
			//debugger;
            var DATA_FEED_URL = "<?php echo base_url();?>cal/datafeed";
            var arrT = [];
            var tt = "{0}:{1}";
            for (var i = 0; i < 24; i++) {
                arrT.push({ text: StrFormat(tt, [i >= 10 ? i : "0" + i, "00"]) }, { text: StrFormat(tt, [i >= 10 ? i : "0" + i, "30"]) });
            }
            $("#timezone").val(new Date().getTimezoneOffset()/60 * -1);
            $("#stparttime").dropdown({
                dropheight: 200,
                dropwidth:60,
                selectedchange: function() { },
                items: arrT
            });
            $("#etparttime").dropdown({
                dropheight: 200,
                dropwidth:60,
                selectedchange: function() { },
                items: arrT
            });
            var check = $("#IsAllDayEvent").click(function(e) {
                if (this.checked) {
                    $("#stparttime").val("00:00").hide();
                    $("#etparttime").val("00:00").hide();
                }
                else {
                    var d = new Date();
                    var p = 60 - d.getMinutes();
                    if (p > 30) p = p - 30;
                    d = DateAdd("n", p, d);
                    $("#stparttime").val(getHM(d)).show();
                    $("#etparttime").val(getHM(DateAdd("h", 1, d))).show();
                }
            });
            if (check[0].checked) {
                $("#stparttime").val("00:00").hide();
                $("#etparttime").val("00:00").hide();
            }
            $("#Savebtn").click(function() { $("#fmEdit").submit(); });
            $("#Closebtn").click(function() { CloseModelWindow(); });
            $("#Deletebtn").click(function() {
                 if (confirm("Are you sure to remove this event")) {  
                    var param = [{ "name": "calendarId", value: $('.fform #id').val()}];                
                    $.post("<?php echo base_url();?>cal/remove",
                        param,
                        function(data){
                              if (data.IsSuccess) {
                                    alert(data.Msg); 
                                    CloseModelWindow(null,true);                            
                                }
                                else {
                                    alert("Error occurs.\r\n" + data.Msg);
                                }
                        }
                    ,"json");
                }
            });
            
           $("#stpartdate,#etpartdate").datepicker({ picker: "<button class='calpick'></button>"});    
            var cv =$("#colorvalue").val() ;
            if(cv=="")
            {
                cv="-1";
            }
            $("#calendarcolor").colorselect({ title: "Color", index: cv, hiddenid: "colorvalue" });
            //to define parameters of ajaxform
            var options = {
                beforeSubmit: function() {
                    return true;
                },
                dataType: "json",
                success: function(data) {
                    alert(data.Msg);
                    if (data.IsSuccess) {
                        CloseModelWindow(null,true);  
                    }
                }
            };
            $.validator.addMethod("date", function(value, element) {                             
                var arrs = value.split(i18n.datepicker.dateformat.separator);
                var year = arrs[i18n.datepicker.dateformat.year_index];
                var month = arrs[i18n.datepicker.dateformat.month_index];
                var day = arrs[i18n.datepicker.dateformat.day_index];
                var standvalue = [year,month,day].join("-");
                return this.optional(element) || /^(?:(?:1[6-9]|[2-9]\d)?\d{2}[\/\-\.](?:0?[1,3-9]|1[0-2])[\/\-\.](?:29|30))(?: (?:0?\d|1\d|2[0-3])\:(?:0?\d|[1-5]\d)\:(?:0?\d|[1-5]\d)(?: \d{1,3})?)?$|^(?:(?:1[6-9]|[2-9]\d)?\d{2}[\/\-\.](?:0?[1,3,5,7,8]|1[02])[\/\-\.]31)(?: (?:0?\d|1\d|2[0-3])\:(?:0?\d|[1-5]\d)\:(?:0?\d|[1-5]\d)(?: \d{1,3})?)?$|^(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])[\/\-\.]0?2[\/\-\.]29)(?: (?:0?\d|1\d|2[0-3])\:(?:0?\d|[1-5]\d)\:(?:0?\d|[1-5]\d)(?: \d{1,3})?)?$|^(?:(?:16|[2468][048]|[3579][26])00[\/\-\.]0?2[\/\-\.]29)(?: (?:0?\d|1\d|2[0-3])\:(?:0?\d|[1-5]\d)\:(?:0?\d|[1-5]\d)(?: \d{1,3})?)?$|^(?:(?:1[6-9]|[2-9]\d)?\d{2}[\/\-\.](?:0?[1-9]|1[0-2])[\/\-\.](?:0?[1-9]|1\d|2[0-8]))(?: (?:0?\d|1\d|2[0-3])\:(?:0?\d|[1-5]\d)\:(?:0?\d|[1-5]\d)(?:\d{1,3})?)?$/.test(standvalue);
            }, "Invalid date format");
            $.validator.addMethod("time", function(value, element) {
                return this.optional(element) || /^([0-1]?[0-9]|2[0-3]):([0-5][0-9])$/.test(value);
            }, "Invalid time format");
            $.validator.addMethod("safe", function(value, element) {
                return this.optional(element) || /^[^$\<\>]+$/.test(value);
            }, "$<> not allowed");
            $("#fmEdit").validate({
                submitHandler: function(form) { $("#fmEdit").ajaxSubmit(options); },
                errorElement: "div",
                errorClass: "cusErrorPanel",
                errorPlacement: function(error, element) {
                    showerror(error, element);
                }
            });
            function showerror(error, target) {
                var pos = target.position();
                var height = target.height();
                var newpos = { left: pos.left, top: pos.top + height + 2 }
                var form = $("#fmEdit");             
                error.appendTo(form).css(newpos);
            }
			
			$( "#calender_type" ).change(function() {
			  //alert( $( "#calender_type" ).val() );
			  if($( "#calender_type" ).val()==4)
			  {
				$( "#lb_yr_team" ).find('select').addClass('required');
				$( "#lb_yr_team" ).show();
				$( "#lb_fv_team" ).find('select').addClass('required');
				$( "#lb_fv_team" ).show();
				$( "#what_team" ).find('.whattext').removeClass('required');
				$( "#what_team" ).hide();
			  }
			  else
			  {
				$( "#lb_yr_team" ).find('select').removeClass('required');
				$( "#lb_yr_team" ).hide();
				$( "#lb_fv_team" ).find('select').removeClass('required');
				$( "#lb_fv_team" ).hide();
				$( "#what_team" ).show();
				$( "#what_team" ).find('.whattext').addClass('required');
			  }
			});	
        });
		
		
    </script>      
   <!-- <style type="text/css">     
    .calpick     {        
        width:16px;   
        height:16px;     
        border:none;        
        cursor:pointer;        
        background:url("sample-css/cal.gif") no-repeat center 2px;        
        margin-left:-22px;    
    }      
    </style>-->
  </head>
  <body>    
    <div style="height: 600px;width: 500px;">  
                    
      <div class="infocontainer">  
          <div class="toolBotton" style="top:450px">           
        <a id="Savebtn" class="imgbtn" href="javascript:void(0);">                
          <span class="Save"  title="Save the calendar">Save(<u>S</u>)
          </span>          
        </a>                           
        <?php if(isset($event)){ ?>
        <a id="Deletebtn" class="imgbtn" href="javascript:void(0);">                    
          <span class="Delete" title="Cancel the calendar">Delete(<u>D</u>)
          </span>                
        </a>             
        <?php } ?>            
        <a id="Closebtn" class="imgbtn" href="javascript:void(0);">                
          <span class="Close" title="Close the window" >Close
          </span></a>            
        </a>        
      </div>    
        <form action="<?php echo site_url('players/schedule_edit'); ?>" class="fform" id="fmEdit" method="post">  
              <input id="id" name="id" type="hidden" value="<?php echo isset($event)?$event->id:"" ?>" />    
			<label><span style='color:#696969;font-weight: bold;'>Calender Types: </span>                    

			<select id='calender_type' name='calender_type' class="required safe">
				<option value='1' <?php if($event->calender_type == 1) echo 'selected=selected';?>>Free Time</option>
				<option value='2'<?php if($event->calender_type == 2) echo 'selected=selected';?>>Events</option>
				<option value='3'<?php if($event->calender_type == 3) echo 'selected=selected';?>>Match(Single)</option>
				<option value='4'<?php if($event->calender_type == 4) echo 'selected=selected';?>>Match(Team)</option>
			</select>
			</label>
		<label id='lb_yr_team' style='display:none'><span style='color:#696969;font-weight: bold;'>Your Team: </span>                    

			<select id='team' name='team' class="required safe">
				<option value='' >Select Team</option>
				<?php 
				foreach($teams as $tk=>$tv)
				{
				?>
					<option value='<?php echo $tv['id'];?>' <?php if($event->team == $tv['id']) echo 'selected=selected';?>><?php echo $tv['name'];?></option>
				<?php	
				}
				?>
			</select>
			</label>
			<label id='lb_fv_team' style='display:none'><span style='color:#696969;font-weight: bold;'>Favorite team: </span>                    

			<select id='favorite_team' name='favorite_team' class="required safe">
				<option value='' >Select opponent team</option>
				<?php 
				foreach($teams as $tk=>$tv)
				{
				?>
					<option value='<?php echo $tv['id'];?>' <?php if($event->favorite_team == $tv['id']) echo 'selected=selected';?>><?php echo $tv['name'];?></option>
				<?php	
				}
				?>
			</select>
			</label>			
          <label id='what_team' style='display:block'>                    
            <span>What:</span>                    
            <input MaxLength="200" class="required safe whattext" id="Subject" name="Subject" style="width:69%; margin-left: 3px;" type="text" value="<?php echo isset($event)?$event->name:"" ?>" />                     
          </label>                 
          <label>                    
            <span>When:</span>                    
            <div>  
              <?php if(isset($event)){
                  $sarr = explode(" ", php2JsTime(mySql2PhpTime($event->start_date)));
                  $earr = explode(" ", php2JsTime(mySql2PhpTime($event->end_date)));
              }?>                    
              <input MaxLength="10" class="required date" id="stpartdate" name="stpartdate" style="padding-left:2px;width:90px;" type="text" value="<?php echo isset($event)?$sarr[0]:""; ?>" />                       
              <input MaxLength="5" class="required time" id="stparttime" name="stparttime" style="width:40px;" type="text" value="<?php echo isset($event)?$sarr[1]:""; ?>" /><span style="display: inline;font-weight: normal;padding-left: 6px;">To</span>                       
              <input MaxLength="10" class="required date" id="etpartdate" name="etpartdate" style="padding-left:2px;width:90px;" type="text" value="<?php echo isset($event)?$earr[0]:""; ?>" />                       
              <input MaxLength="50" class="required time" id="etparttime" name="etparttime" style="width:40px;" type="text" value="<?php echo isset($event)?$earr[1]:""; ?>" />                                            
              <label class="checkp"> 
                <input id="IsAllDayEvent" name="IsAllDayEvent" type="checkbox" value="1" <?php if(isset($event)&&$event->isalldayevent!=0) {echo "checked";} ?>/>          All Day Event                      
              </label>                    
            </div>                
          </label>                 
          <label>                    
            <span>Where</span>                    
            <input MaxLength="200" id="location" name="location" style="width:76%;" type="text" value="<?php echo isset($event)?$event->location:""; ?>" />                 
          </label>
			<label><span style='color:#696969;font-weight: bold;'>Who: </span>                    

			<select id='who_for' name='who_for' class="required safe">
				<option value='1'<?php if($event->who_for == 1) echo 'selected=selected';?>>Public</option>
				<option value='2'<?php if($event->who_for == 2) echo 'selected=selected';?>>sFriends</option>
				<option value='3'<?php if($event->who_for == 3) echo 'selected=selected';?>>Teams or only few selected friends</option>
			</select>
			</label>	
          <label>                    
            <span>Notes:</span>                    
<textarea cols="20" id="description" name="description" rows="2" style="width:76%; height:70px">
<?php echo isset($event)?$event->description:""; ?>
</textarea>                
          </label>                
          <input id="timezone" name="timezone" type="hidden" value="" />           
        </form>         
      </div>         
    </div>
  </body>
</html>