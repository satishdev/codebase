$.extend({
   showModal:function(opts){
       var config={
            id:'',
            buttons:
            [{
                text: "Ok",
                click: function() { $(this).dialog("close"); }
            }],
            height:150,
            width:300,
            title: "",
            message:'Please Wait..',
            dialogClass: "",
            resizable: false,
            extra:{}
       };

       if(opts){
           $.extend(config,opts);
       }

       if($('#modal_buffer').length>0){ $('#modal_buffer').remove(); }
       $('body').append('<div id="modal_buffer" style="display:none;"><div id="modal_message'+config.id+'">'+config.message+'</div></div>')

        //$('<p>'+ config.message + '</p>' )

        dialogOptions={
            height: config.height,
            width: config.width,
            buttons: config.buttons,
            dialogClass: config.dialogClass,
            resizable: config.resizable,
            modal: true,
            title: config.title,
            close: function(event, ui) {
                $(this).dialog( "destroy" );
                if($('#modal_buffer').length>0){ $('#modal_buffer').remove(); }
                if($('#modal_message'+config.id).length>0){ $('#modal_message'+config.id).remove(); }
            }
        }
        if(opts && opts.extra){
           $.extend(dialogOptions,opts.extra);
        }
        $('#modal_message'+config.id+'').dialog(dialogOptions);
   },
   change_psw_form:function(){
       var content=Array();
       content.push('<form id="password_form"  style="margin-top: 15px">');
       content.push('<ul class="wesp-form small">');
       content.push('<li><label style="width:125px;">Old Password:</label> <input type="password" name="psw" id="psw" class="text field" /></li>');
       content.push('<li><label style="width:125px;">New Password:</label> <input type="password" name="password" id="password" class="text field" /></li>');
       content.push('<li><label style="width:125px;">Retype Password:</label> <input type="password" name="password2" class="text field" /></li>');
       content.push('</ul>');
       content.push('</form>');
       
       return content.join('');
   }


   
});