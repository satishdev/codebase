$(function(){

    $('#add_user').live('click',function(){
        loadUserTypeSelect('add');
    });

    $('#update_user').live('click',function(){
        loadUserTypeSelect('update');
    });

    $('#user_type_add').live('change',function(){
        loadUserDetailsForm($(this).val());
    });
    $('#user_type_update').live('change',function(){
        // loadUpdateUserDetailsForm($(this).val());
        loadUserSelect($(this).val());
    });

    $('#user_select').live('change',function(){
        loadUsersForm($(this).val());
    })
/****************************************************************************************************************/

    $('[name=users_type],[name=status]').live('change',function(){
        $('#grid_table').setGridParam({
            postData:{
                user_type:$('[name=users_type]').val(),
                status:$('[name=status]').val()
            }
        }).trigger('reloadGrid');
    });

    $('#add_user_btn').live('click',function(){
        loadUserTypeSelect();
    });

    

});


/************** DOC READY END *********************/


function loadUsersForm(users_id){
    if(users_id!=''){
        $.ajax({
            url:site_url+'/admin/users_form',
            data:'users_id='+users_id,
            type:'POST',
            dataType:'text/html',
            beforeSend:function(){

            },
            success:function(dataR){
                $('#user_details').html(dataR);
                if($('.apply_datepicker').length>0){
                    $('.apply_datepicker').datepicker({dateFormat:'yy-mm-dd', changeMonth: true, changeYear: true});
                }
            }
        })
    }else{
        $('#user_details').html('');
    }
}


function loadUserDetailsForm(users_type_id){
    if(users_type_id!=''){
        $.ajax({
            url:site_url+'/admin/user_details_form',
            data:'users_type_id='+users_type_id,
            type:'POST',
            dataType:'text/html',
            beforeSend:function(){

            },
            success:function(dataR){
                $('#user_details').html(dataR);
                if($('.apply_datepicker').length>0){
                    $('.apply_datepicker').datepicker({dateFormat:'yy-mm-dd', changeMonth: true, changeYear: true});
                }
            }
        })
    }else{
        $('#user_details').html('');
    }
}


function loadUserSelect(user_type){
    dataP='user_type='+user_type
    $.ajax({
        url:site_url+'/admin/get_user_list',
        data:dataP,
        type:'POST',
        dataType:'text/html',
        beforeSend:function(){

        },
        success:function(dataR){
            $('#user_select_li').html(dataR);
        }
    })
}

/****************************************************************************************************************/

function users_grid(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/cp/load_players_grid',
            datatype: "json",
            width:900,
            height:250,
            mtype: 'POST',
            recordtext: "User(s)",
            recordtext: "Viewing {0} - {1} of {2} User(s)",
            pgtext : "Page {0} of {1}",
            colNames:['Username','Password', 'Email','Status','Update Account','Squeez/Release'],
            colModel:[
                    {name:'username',index:'username', width:150},
                    {name:'password',index:'password', width:150},
                    {name:'email',index:'email', width:150},
                    {name:'status',index:'status', width:150},
                    {name:'action1',index:'action1', width:150, sortable:false,title:false},
                    {name:'action2',index:'action2', width:130, sortable:false,title:false}
            ],
            rowNum:10,
            //rowList:[10,20],
            pager: '#grid_pager',
            sortname: 'first_name',
            viewrecords: false,
            sortorder: "desc",
            caption:"User(s)",
            loadtext:'Loading..',
            postData:{
                user_type:$('[name=users_type]').val(),
                status:$('[name=status]').val()
            }
    });
}


function update_account(id,f){
    dataP='users_id='+id+'&f='+f;
    $.ajax({
        url:site_url+'/admin/update_account',
        data:dataP,
        type:'POST',
        dataType:'',
        beforeSend:function(){

        },
        success:function(dataR){
            $('#users_content_wrap').html(dataR);
            if($('.apply_datepicker').length>0){
                $('.apply_datepicker').datepicker({dateFormat:'yy-mm-dd', changeMonth: true, changeYear: true});
            }
        }
    })
}


function squeez_account(id,f){
    dataP='id='+id+'&f='+f;
    $.ajax({
        url:site_url+'/cp/squeez_account',
        data:dataP,
        type:'POST',
        dataType:'',
        beforeSend:function(){

        },
        success:function(dataR){
            alert(dataR);
            $('#grid_table').trigger('reloadGrid');
        }
    })
}


function loadUserTypeSelect(){
    $.ajax({
        url:site_url+'/admin/get_user_types',
        data:'type=add_user',
        type:'POST',
        dataType:'text/html',
        beforeSend:function(){

        },
        success:function(dataR){
            $('#users_content_wrap').html(dataR);
        }
    })
}

function validate_form_user_form(){
    $('#appl_form').validate({
        rules:{
            name:{
                required:true,
                noDigits:true
            },
            fathers_name:{
                required:true,
                noDigits:true
            },
            students_number:{
                required:true
            },
            sex:{
                required:true
            },
            dob:{
                required:true
            },
            doj:{
                required:true
            },
            course_id:{
                required:true
            },
            branch_id:{
                required:true
            },
            present_year:{
                required:true
            },
            completing_year:{
                required:true
            },
            fee_details:{
                required:true
            },
            address:{
                required:true
            },
            mobile:{
                required:true,
                digits:true,
                rangelength: [10, 10]
            },
            email:{
                required:true,
                email:true
            },
            username:{
                required:true
            },
            password:{
                required:true
            },
            name:{
                required:true
            },
            code:{
                required:true
            },
            email2:{
                required:true,
                email:true
            },
            salary:{
                required:true
            }

        },
        messages:{
            name:{
                required:'Enter name'
            },
            fathers_name:{
                required:'Enter Fathers name'
            },
            students_number:{
                required:'Enter Student number'
            },
            sex:{
                required:'Select sex'
            },
            dob:{
                required:'Select Date of birth'
            },
            doj:{
                required:'Select date of join'
            },
            course_id:{
                required:'Select Course'
            },
            branch_id:{
                required:'Select branch'
            },
            present_year:{
                required:'Select present year'
            },
            completing_year:{
                required:'Select completing year'
            },
            fee_details:{
                required:'Enter fee details'
            },
            address:{
                required:'Enter Address'
            },
            mobile:{
                required:'Please enter mobile number',
                digits:'Please enter only digits',
                rangelength:'Mobile number should be 10 digits'
            },
            email:{
                required:'Please enter email',
                email:'Please enter a valid email address'
            },
            username:{
                required:'Please enter username'
            },
            password:{
                required:'Please enter Password'
            },
            name:{
                required:'Please enter name'
            },
            code:{
                required:'Please enter staff code'
            },
            email2:{
                required:'Please enter email',
                email:'Please enter a valid email address'
            },
            salary:{
                required:'Please enter salary'
            }
        },
        submitHandler:function(form){
            ajax_gen_form(form);
        },
        errorPlacement: function(error, element) {
            if(element.attr('name')=='sex')
                error.appendTo( $('[name=sex]:last').parents("li") );
            else
                error.appendTo( element.parent() )
        }
    });
    $('#appl_form').submit();
}



function no_due_request_grid(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/staff/no_due_requests',
            datatype: "json",
            width:900,
            height:250,
            mtype: 'POST',
            recordtext: "Request(s)",
            recordtext: "Viewing {0} - {1} of {2} Request(s)",
            pgtext : "Page {0} of {1}",
            colNames:['Student Name','Roll Number','Course','Branch','Present Year','Completng Year','Approve?'],
            colModel:[
                    {name:'name',index:'name', width:150},
                    {name:'students_number',index:'students_number', width:150},
                    {name:'course',index:'course', width:150},
                    {name:'branch',index:'branch', width:150},
                    {name:'present_year',index:'present_year', width:150},
                    {name:'completing_year',index:'completing_year', width:150},
                    {name:'approve',index:'approve', width:150, sortable:false},
            ],
            rowNum:10,
            //rowList:[10,20],
            pager: '#grid_pager',
            sortname: 'name',
            viewrecords: false,
            sortorder: "desc",
            caption:"No-Due Requests",
            loadtext:'Loading..'
    });
}

function nodue_update(id,update){
    dataP='id='+id+'&update='+update;
    $.ajax({
        url:site_url+'/staff/update_nodue',
        data:dataP,
        type:'POST',
        // dataType:'',
        beforeSend:function(){

        },
        success:function(dataR){
            if(dataR){
                alert(dataR);
                $('#grid_table').trigger('reloadGrid');
                window.location.reload();
            }
        }
    })
}


function approve_q_papers_grid(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/admin/approve_q_papers',
            datatype: "json",
            width:900,
            height:250,
            mtype: 'POST',
            recordtext: "Question Paper(s)",
            recordtext: "Viewing {0} - {1} of {2} Question Papers",
            pgtext : "Page {0} of {1}",
            colNames:['Paper from','Student Count', 'Branch','Year','Subject','Exam Number','Download Link','Status/Action'],
            colModel:[
                    {name:'username',index:'username', width:150},
                    {name:'students_count',index:'students_count', width:150},
                    {name:'branch',index:'branch', width:150},
                    {name:'year',index:'year', width:150},
                    {name:'subject',index:'subject', width:150},
                    {name:'exam_number',index:'exam_number', width:150},
                    {name:'doc_link',index:'doc_link', width:150, sortable:false},
                    {name:'is_approved',index:'is_approved', width:150}
            ],
            rowNum:10,
            //rowList:[10,20],
            pager: '#grid_pager',
            sortname: 'username',
            viewrecords: false,
            sortorder: "desc",
            caption:"Question Papers",
            loadtext:'Loading..'
    });
}



function approve_paper(id){
    dataP='id='+id;
    $.ajax({
        url:site_url+'/admin/approve_paper',
        data:dataP,
        type:'POST',
        // dataType:'',
        beforeSend:function(){

        },
        success:function(dataR){
            if(dataR){
                $('#grid_table').trigger('reloadGrid');
                window.location.reload();
            }
        }
    })
}

function notice_board_grid(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/admin/notice_board',
            datatype: "json",
            width:900,
            height:250,
            mtype: 'POST',
            recordtext: "Item(s)",
            recordtext: "Viewing {0} - {1} of {2} Item(s)",
            pgtext : "Page {0} of {1}",
            colNames:['S.No','Message', 'Date Added','Edit','Delete'],
            colModel:[
                    {name:'id',index:'id', width:150},
                    {name:'message',index:'message', width:150},
                    {name:'date_added',index:'date_added', width:150},
                    {name:'edit',index:'edit', width:150, sortable:false},
                    {name:'delete',index:'delete', width:150, sortable:false}
            ],
            rowNum:10,
            //rowList:[10,20],
            pager: '#grid_pager',
            sortname: 'date_added',
            viewrecords: false,
            sortorder: "desc",
            caption:"College Updates",
            loadtext:'Loading..'
    });
}

function delete_notice(id){
    if(confirm('Are you sure you sure you want to delete this message.?')){
        dataP='id='+id;
        $.ajax({
            url:site_url+'/admin/delete_notice',
            data:dataP,
            type:'POST',
            dataType:'',
            beforeSend:function(){
                
            },
            success:function(dataR){
                $('#grid_table').trigger('reloadGrid');
            }
        });
    }

}


function edit_notice(id){
    {
        dataP='id='+id;
        $.ajax({
            url:site_url+'/admin/edit_notice',
            data:dataP,
            type:'POST',
            dataType:'',
            beforeSend:function(){
                
            },
            success:function(dataR){
                $('#main_content').html(dataR);
            }
        });
    }

}