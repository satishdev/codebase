$.extend({
    event_form:function(opts){
        var config={
            id:'',
            css:'',
            data:{id:'',title:'',start: '',end: ''}
        }

        if(opts){ $.extend(config,opts); }
       //alert(config.data.end); 
        if(config.data.start && (config.data.start)!=''){
            std_=new Date(config.data.start);
			
			sd=(std_.getDate() < 10 ? '0' : '') + std_.getDate();
			sh=(std_.getHours() < 10 ? '0' : '') + std_.getHours();
			sm=(std_.getMinutes() < 10 ? '0' : '') + std_.getMinutes();
			smm=(std_.getMonth()+1);
			smm2=(smm < 10 ? '0' : '') +smm;
			start=std_.getFullYear()+'-'+smm2+'-'+sd+' '+sh+':'+sm;
        }else{
            start='';
        }

        if(config.data.end && (config.data.end)!=''){
            endd_=new Date(config.data.end);
			
			ed=(endd_.getDate() < 10 ? '0' : '') + endd_.getDate();
			eh=(endd_.getHours() < 10 ? '0' : '') + endd_.getHours();
			em=(endd_.getMinutes() < 10 ? '0' : '') + endd_.getMinutes();
			emm=(endd_.getMonth()+1);
			emm2=(emm < 10 ? '0' : '') +emm;
			end=endd_.getFullYear()+'-'+emm2+'-'+ed+' '+eh+':'+em;
        }else{
            end='';
        }
//alert(config.data.end);
        var content=Array();
        content.push('<form id="event_form" style="margin-top: 15px">');
		content.push('<ul class="wesp-form small">');
		content.push('<li><label for="title">Event Title:</label> <input type="text" class="text field" name="title" id="title" value="'+config.data.title+'"/></li>');
		content.push('<li><label for="start">Start date:</label> <input type="text" class="text field applyDatepicker" name="start" id="start" value="'+start+'" class="applyDatepicker" readonly="readonly"/></li>');
        content.push('<li><label for="end">End date:</label> <input type="text" class="text field applyDatepicker" name="end" id="end" value="'+end+'" class="applyDatepicker" readonly="readonly"/></li>');
		
        /*content.push('<ol>');
        content.push('<li><label style="width:125px;">Event Title:</label> <input type="text" class="text" name="title" id="title" value="'+config.data.title+'"/></li>');
        content.push('<li><label style="width:125px;">Start date:</label> <input type="text" class="text" name="start" id="start" value="'+start+'" class="applyDatepicker" readonly="readonly"/></li>');
        content.push('<li><label style="width:125px;">End date:</label> <input type="text" class="text" name="end" id="end" value="'+end+'" class="applyDatepicker" readonly="readonly"/></li>');
        content.push('</ol>');*/
		content.push('</ul>');
        content.push('</form>');

        return content.join('');
    }
})