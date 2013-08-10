<div id='content_header'>
	<div class='hdr-text'><?php  echo $u_details->first_name; ?> <?php  echo $u_details->last_name; ?></div>
 </div>
<div id='content_wrapper' class='pad'>
<div id="calendar">
</div>
</div>
<link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url();?>css/fullcalendar/fullcalendar.css" />
<script type="text/javascript" src="<?php echo base_url();?>js/fullcalendar/fullcalendar.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/views/calender_view.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/calender.js"></script>
<?php
	//echo '<pre>'; print_r($user_calender_events); echo '</pre>'; 
?>
<script type="text/javascript">
var user_events=<?php echo json_encode($user_calender_events); ?>;

var calendar;
$(function(){
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();

    calendar = $('#calendar').fullCalendar({
					theme: true,
					header: {
						left: 'prev,next today',
						center: 'title',
						right: 'month,agendaWeek,agendaDay'
					},
					selectable: true,
					selectHelper: true,
					select: function(start, end, allDay) {
						$.showModal({
							message:$.event_form({data:{id:'',title:'',start: start,end: end}}),
							width:350,
							height:240,
							buttons:[
										{
											text: "Cancel",
											click: function() {$(this).dialog("close");}
										},
										{
											text: "Save Event",
											click: function() {
												if($.trim($('#event_form #title').val())!=''){
													var event = {};
													event.title=$('#event_form #title').val();
													event.start= $('#event_form #start').val();
													event.end= $('#event_form #end').val();
													$('#calendar').fullCalendar('updateEvent', event);
													window.location.reload();
												}
												validateAndSaveEvent({
													title: $('#event_form #title').val(),
													start: $('#event_form #start').val(),
													end: $('#event_form #end').val(),
													allDay: allDay
												},$(this));
											}
										}
									],
							extra:{
								open:function(){
									//$('.applyDatepicker').datetimepicker();
									// $('.applyDatepicker').datetimepicker({dateFormat:'yy-mm-dd',timeFormat: 'hh:mm', changeMonth: true, changeYear: true});
                                                                        $("#start").datetimepicker({
                                                                            beforeShow: customRange2,
                                                                            dateFormat:'yy-mm-dd',timeFormat: 'hh:mm',
                                                                            changeMonth: true, changeYear: true
                                                                        });

                                                                        $("#end").datetimepicker({
                                                                            beforeShow: customRange,
                                                                            dateFormat:'yy-mm-dd',timeFormat: 'hh:mm',
                                                                            changeMonth: true, changeYear: true
                                                                        });
								}
							}
						});
						calendar.fullCalendar('unselect');
					},
					eventDrop: function(event, delta) {
						//                                console.log(event, delta);
						std_=new Date(event.start);
							endd_=new Date(event.end);
						sd=(std_.getDate() < 10 ? '0' : '') + std_.getDate();
						sh=(std_.getHours() < 10 ? '0' : '') + std_.getHours();
						sm=(std_.getMinutes() < 10 ? '0' : '') + std_.getMinutes();
						smm=(std_.getMonth()+1);
						smm2=(smm < 10 ? '0' : '') +smm;
						ed=(endd_.getDate() < 10 ? '0' : '') + endd_.getDate();
						eh=(endd_.getHours() < 10 ? '0' : '') + endd_.getHours();
						em=(endd_.getMinutes() < 10 ? '0' : '') + endd_.getMinutes();
						start=std_.getFullYear()+'-'+smm2+'-'+sd+' '+sh+':'+sm;
						emm=(endd_.getMonth()+1);
						emm2=(emm < 10 ? '0' : '') +emm;
					    end=endd_.getFullYear()+'-'+emm2+'-'+ed+' '+eh+':'+em;
						saveEvent({
							id:event.id,
							title: event.title,
							start: start,
							end: end,
							allDay: event.allDay
						});
					},
					eventResize:function(event, delta) {
						//                                console.log(event, delta);
						std_=new Date(event.start);
							endd_=new Date(event.end);
						sd=(std_.getDate() < 10 ? '0' : '') + std_.getDate();
						sh=(std_.getHours() < 10 ? '0' : '') + std_.getHours();
						sm=(std_.getMinutes() < 10 ? '0' : '') + std_.getMinutes();
						smm=(std_.getMonth()+1);
						smm2=(smm < 10 ? '0' : '') +smm;
						ed=(endd_.getDate() < 10 ? '0' : '') + endd_.getDate();
						eh=(endd_.getHours() < 10 ? '0' : '') + endd_.getHours();
						em=(endd_.getMinutes() < 10 ? '0' : '') + endd_.getMinutes();
						emm=(endd_.getMonth()+1);
						emm2=(emm < 10 ? '0' : '') +emm;
						start=std_.getFullYear()+'-'+smm2+'-'+sd+' '+sh+':'+sm;
					    end=endd_.getFullYear()+'-'+emm2+'-'+ed+' '+eh+':'+em;
						saveEvent({
							id:event.id,
							title: event.title,
							start: start,
							end: end,
							allDay: event.allDay
						});
					},
					eventClick: function(event, element) {
						$.showModal({
							message:$.event_form({data:{id:event.id,title:event.title,start: event.start,end: event.end}}),
							width:350,
							height:240,
							buttons:[
										{
											text: "Cancel",
											click: function() {$(this).dialog("close");}
										},
										{
											text: "Save Event",
											click: function() {
												if($.trim($('#event_form #title').val())!=''){
													event.title=$('#event_form #title').val();
													$('#calendar').fullCalendar('updateEvent', event);
												}
												validateAndSaveEvent({
													id:event.id,
													title: $('#event_form #title').val(),
													start: $('#event_form #start').val(),
													end: $('#event_form #end').val(),
													allDay: event.allDay
												},$(this));
											}
										}
									],
							extra:{
								open:function(){
									//$('.applyDatepicker').datepicker({dateFormat:'yy-mm-dd', changeMonth: true, changeYear: true});
									// $('.applyDatepicker').datetimepicker({dateFormat:'yy-mm-dd',timeFormat: 'hh:mm', changeMonth: true, changeYear: true});
                                                                        $("#start").datetimepicker({
                                                                            beforeShow: customRange2,
                                                                            dateFormat:'yy-mm-dd',timeFormat: 'hh:mm',
                                                                            changeMonth: true, changeYear: true
                                                                        });

                                                                        $("#end").datetimepicker({
                                                                            beforeShow: customRange,
                                                                            dateFormat:'yy-mm-dd',timeFormat: 'hh:mm',
                                                                            changeMonth: true, changeYear: true
                                                                        });

								}
							}
						});
					},
					editable: true,
					events: user_events
				});



});

function customRange(input) {
    return {
        minDate: (input.id == "end" ? $("#start").datepicker("getDate") : null)//,
        //maxDate: (input.id == "from" ? $("#from").datepicker("getDate") : null)
    };
}
function customRange2(input) {
    return {
        maxDate: (input.id == "start" ? $("#end").datepicker("getDate") : null)//,
        //maxDate: (input.id == "from" ? $("#from").datepicker("getDate") : null)
    };
}




var test;

function validateAndSaveEvent(obj,modalObj){
    $('#event_form').validate({
        rules:{
            title:{
                required:true
            }
        },
        messages:{
            title:{
                required:'Please enter the Event Title'
            }
        },
        submitHandler:function(form){
            saveEvent(obj);
            $(modalObj).dialog("close");
        }
    });
    $('#event_form').submit();
}

function saveEvent(dataObj){
    test=dataObj;
    if(dataObj.title){

        dataP='allDay='+dataObj.allDay+'&end_date='+dataObj.end+'&start_date='+dataObj.start+'&description='+dataObj.title;
        if(typeof dataObj.id!='undefined'){ dataP+='&id='+dataObj.id; }
//        console.log(dataP);

        $.ajax({
            url:site_url+'players/save_event',
            data:dataP,
            type:'POST',
            dataType:'json',
            beforeSend:function(){
                
            },
            success:function(dataR){
                if(typeof dataObj.id=='undefined'){
                    eventObj=$.extend(dataObj,{id:dataR.id});
//                    console.log(eventObj);
                    calendar.fullCalendar('renderEvent',
                        eventObj,
                        true // make the event "stick"
                    );
                }
            }
        })
    }
    return true;
}
</script>