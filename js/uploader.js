$(function(){
	$.initUploader({
		id: "file_upload",
		formId: "create_new_album_frm",
		action: base_url+'players/filesUpload',
		size: (18*1024*1024),
		multiple: true,
		removeItemURL: base_url+'players/rfile',
		onSubmit: function(id, name){
			$(".qq-upload-list").show();
		}
	});
 
		   });


