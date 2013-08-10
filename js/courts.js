
function courts_grid(){
    jQuery("#grid_table").jqGrid({
            url:site_url+'/clubs/courts_grid',
            datatype: "json",
            width:648,
            height:600,
            mtype: 'POST',
            recordtext: "Court(s)",
            recordtext: "Viewing {0} - {1} of {2} Court(s)",
            pgtext : "Page {0} of {1}",
            colNames:['Name','Court No.','Sport','Court Type','Time'],
            colModel:[
                    {name:'name',index:'crt.name', width:80},
                    {name:'court_no',index:'crt.court_no', width:80},
                    {name:'sport',index:'s.name', width:80},
					{name:'court_types_id',index:'ct.name', width:80},
					{name:'time', width:80,sortable:false}
            ],
            rowNum:10,
            rowList:[10,20,50],
            pager: '#grid_pager',
            sortname: 'crt.name',
            viewrecords: false,
            sortorder: "asc",
            caption:"Corts(s)",
            loadtext:'Loading..',
            postData:{
                //user_type:$('[name=users_type]').val(),
               // status:$('[name=status]').val()
            }
    });
}

