<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


//CI_Controller
class Golfcourse_detail extends MY_Controller {

	
	/* public function index()
	{
		
		$results['title']='Golfhub';
		$temp['contents']=$this->load->view('teetime_search',$results,true);
		$this->load->view('template',$temp);
	}*/
	
	

	
	//>>>>>>>>>
	//>>>>>>>>>
	//>>>>>>>>>
	function golf_detail_page()
	{
	     $course_id=$this->input->post('course_id');
		 $this->session->set_userdata('course_id',$course_id);
		 $client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");
	     $response = $client->CourseInfo(array("Hdr"=>array("ResellerId"=>"WPA",
															"PartnerId"=>"",
															"SourceCd"=>"A",
															"Lang"=>"en",
															"UserIp"=>"66.147.244.227",
															"UserSessionId"=>"",
															"AccessKey"=>"",
															"Agent"=>"",
															"gsSource"=>"",
															"gsDebug"=>true),
											"Req"=>array("CourseId"=>$course_id,
															)));
															
			//to save area_id in session
			//$area_id=$response->CourseInfoResult->Course->sAr;
		//	$this->session->set_userdata('area_id',$area_id);
			//end to save area_id in session
			
			$results['result']=$response->CourseInfoResult->Course;
			
		//	$results['curPageURL']=$this->curPageURL();
			
			
		//	$results['result1']=$this->common_model->select_where('*','gama_golfcourse_img',array('gama_golfcourse_id'=>$course_id));
			
			
		//	$results['result2']=$this->common_model->select_where_limit_order('*','gama_golf_review',array('course_id'=>$course_id),0,3,'dates','DESC');
			
			
			$this->load->view('dialogbox_golf_course_detail',$results,'');
		//	$this->load->view('template',$data);
	  }
	
	
	
	function curPageURL() {
 $pageURL = 'http';
 
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}
	
	
	
	/*if (!is_dir('path/to/directory')) {
    mkdir('path/to/directory');
}upload_img/user_golf_course*/

	
	
	
	
	function upload_photo()
	{
		$this->form_validation->set_rules('title','Title','trim|required');
		$this->form_validation->set_rules('description','Description','trim|required');
		$this->form_validation->set_rules('dates','Date','trim|required');
		$this->form_validation->set_rules('photos','Photo','trim|callback_valid_image');
		if($this->form_validation->run()==false)
		{
		   $results['title']='Upload Photo';
		   $results['result']='';
		   $data['contents']=$this->load->view('upload_photo',$results,true);
		   $this->load->view('template',$data,'');
		
		}
		else
		{
		
			 $title =$this->input->post('title');
			 $description =$this->input->post('description');
			 $dates =$this->input->post('dates');
			 $dates=strtotime($dates);
			 
				 
			 $photo =$_FILES['photos'];
			 
			 $img_name=$photo['name'];
			 $img_name = preg_replace('#[^a-z.0-9]#i', '', $img_name); 
			 $img_name = explode(".", $img_name); 
			 $img_ext = end($img_name); 
			 $img_name = time().rand().".".$img_ext;
			 //image save in session
			 //$this->session->set_userdata('img_name',$img_name);
			 
			 $img_temp=$photo['tmp_name'];
			 
			 move_uploaded_file($img_temp,PATH_DIR.'upload_img/user_golf_course/'.$img_name);
			 
			$db_fields['title']=$title;
			$db_fields['description']=$description;
			$db_fields['dates']=$dates;
			$db_fields['gama_golfcourse_img']=$img_name;
			
			$course_id=$this->session->userdata('course_id');
			$db_fields['gama_golfcourse_id']=$course_id;
			
			//$user_id=$this->session->userdata('user_id');
			$db_fields['user_id']=1;
			
			$inserted_gamaimage_id=$this->common_model->insert_array('gama_golfcourse_img',$db_fields);
			
				 //save gama_golfcourse_img_id in session
	// $this->session->set_userdata('inserted_gamaimage_id',$inserted_gamaimage_id);
			
			redirect('golfcourse_detail/simple_img_view/'.$inserted_gamaimage_id);
		}
	}
	
	
	
	
	
	
	function simple_img_view($id)
	{
		//$img_name=$this->session->userdata('img_name');
		//$this->session->set_userdata('img_name','');
		$results['result']=$this->common_model->select_where('*','gama_golfcourse_img',array('gama_golfcourse_img_id'=>$id));
		$results['id']=$id;
		$results['title']='Golf Course';
		
		$data['contents']=$this->load->view('simple_img_view',$results,true);
		$this->load->view('template',$data,'');
	}
	
	
	
	
	
	
	function view_my_photo($id,$select)
	{
	     //this $id is or a image index value or a gama_golfcourse_img_id value. 
		 //this $select is 1 if big image is from local server and 0 if big image is from         //other server.      
	
	     $course_id=$this->session->userdata('course_id');
	  
	     $client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");
	     $response = $client->CourseInfo(array("Hdr"=>array("ResellerId"=>"WPA",
															"PartnerId"=>"",
															"SourceCd"=>"A",
															"Lang"=>"en",
															"UserIp"=>"66.147.244.227",
															"UserSessionId"=>"",
															"AccessKey"=>"",
															"Agent"=>"",
															"gsSource"=>"",
															"gsDebug"=>true),
											"Req"=>array("CourseId"=>$course_id,
															)));
					
				$results['result']=$response->CourseInfoResult->Course;
				
				$results['result1']=$this->common_model->select_where('*','gama_golfcourse_img',array('gama_golfcourse_id'=>$course_id));
				
				$results['select']=$select;
				$results['id']=$id;
				
				$data['contents']=$this->load->view('view_my_photo',$results,true);
				$this->load->view('template',$data);
	   }
	   
	   
	   
	   
	   
	   
	   function view_photo($course_id)
	   {
	     //$course_id=$this->session->userdata('course_id');
	  
	     $client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");
	     $response = $client->CourseInfo(array("Hdr"=>array("ResellerId"=>"WPA",
															"PartnerId"=>"",
															"SourceCd"=>"A",
															"Lang"=>"en",
															"UserIp"=>"66.147.244.227",
															"UserSessionId"=>"",
															"AccessKey"=>"",
															"Agent"=>"",
															"gsSource"=>"",
															"gsDebug"=>true),
											"Req"=>array("CourseId"=>$course_id,
															)));
					
				$results['result']=$response->CourseInfoResult->Course;
				
				$results['result1']=$this->common_model->select_where('*','gama_golfcourse_img',array('gama_golfcourse_id'=>$course_id));
				
				$data['contents']=$this->load->view('view_photo',$results,true);
				$this->load->view('template',$data);
	   
	   }
	   
	   
	    
	   function success_review_form($course_id)
	   {
		   $results['course_id']=$course_id;
		   $data['contents']=$this->load->view('success_review_form',$results,true);
		   $this->load->view('template',$data,'');
	   }
	
	   
	
	   
	   function review_course()
	   {
		   /*$this->form_validation->set_rules('title','Title','trim|required');
		   $this->form_validation->set_rules('coment','Comment','trim|required');
		   $this->form_validation->set_rules('conditin','Course Condition','trim|required');
		   $this->form_validation->set_rules('facilits','Service and Facilities','trim|required');
		   $this->form_validation->set_rules('overall','Overall Rating','trim|required');
		   if($this->form_validation->run()==false)
		   {*/
			$course_id=$this->input->post('course_id');
			if($this->input->post('submit')=='FALSE')
			{   
			   $client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");
	           $response = $client->CourseInfo(array("Hdr"=>array("ResellerId"=>"WPA",
															"PartnerId"=>"",
															"SourceCd"=>"A",
															"Lang"=>"en",
															"UserIp"=>"66.147.244.227",
															"UserSessionId"=>"",
															"AccessKey"=>"",
															"Agent"=>"",
															"gsSource"=>"",
															"gsDebug"=>true),
											"Req"=>array("CourseId"=>$course_id,
															)));
					
				$results['course_name']=$response->CourseInfoResult->Course->nm;
				$results['course_id']=$course_id;
				// $results['title']='Golf Course Detail Page';
				$contents=$this->load->view('dialogbox_review_course',$results,true);
				echo $contents;
				//$this->load->view('template',$data,'');
			}
			else
			{
				$db_fields['review_title']=$this->input->post('my_title');
				$db_fields['review_coment']=$this->input->post('my_coment');
				$db_fields['review_rating_condition']=$this->input->post('conditin');
				$db_fields['review_rating_facilities']=$this->input->post('facilits');
				$db_fields['review_rating_all']=$this->input->post('overall');
				$db_fields['course_id']=$this->input->post('course_id');
				
				$unserialize=@unserialize($this->db_session->userdata('user_object'));
				$user_id=$unserialize->getuserid();
				$db_fields['user_id']=$user_id;
				$db_fields['dates']=time();
				$db_fields['status']=1;
				$this->common_model->insert_array('gama_golf_review',$db_fields);
				echo 'Your Review is successfully Submitted.';   
				//$this->load->view('dialogbox_review_course');
				//redirect('golfcourse_detail/success_review_form/'.$course_id);
		    }
	   }
	   
	   
	   
	   
	   
	  
	
	
	
     
	   //$course_id,$page_start_from=0
	   function all_review_listing()
	   {
		   $course_id=$this->input->post('course_id');
		   $client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");
	       $response = $client->CourseInfo(array("Hdr"=>array("ResellerId"=>"WPA",
															"PartnerId"=>"",
															"SourceCd"=>"A",
															"Lang"=>"en",
															"UserIp"=>"66.147.244.227",
															"UserSessionId"=>"",
															"AccessKey"=>"",
															"Agent"=>"",
															"gsSource"=>"",
															"gsDebug"=>true),
											"Req"=>array("CourseId"=>$course_id,
															)));
					
			$results['result']=$response->CourseInfoResult->Course;
			$record_per_page=10000000;
			$results['result1']=$this->common_model->select_where_limit_order('*','gama_golf_review',array('status'=>1,'course_id'=>$course_id),$page_start_from,$record_per_page,'dates','DESC');
			
			$mypaing['total_rows']=$this->common_model->select_where_num('*','gama_golf_review',array('status'=>1,'course_id'=>$course_id)); 
			$mypaing['base_url']=base_url()."golfcourse_detail/all_review_listing/".$course_id;
			$mypaing['per_page']=$record_per_page;
			$mypaing['uri_segment']= 4;
			$this->pagination->initialize($mypaing);
			$results['paginglink']=$this->pagination->create_links();
			
			//$results['sort']="date";
			//$results['title']="Golf Course";
			//$data['contents']=$this->load->view('dialogbox_all_review_listing',$results,true);
			$results['course_id']=$course_id;
			$contents=$this->load->view('dialogbox_all_review_listing',$results,true);
			echo $contents;
			//$this->load->view('template',$data);
			
	   }
	   
	   
	   
	   
	   
	   function review_sorting($para,$course_id,$page_start_from=0)
	   {
	       $client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");
	       $response = $client->CourseInfo(array("Hdr"=>array("ResellerId"=>"WPA",
															"PartnerId"=>"",
															"SourceCd"=>"A",
															"Lang"=>"en",
															"UserIp"=>"66.147.244.227",
															"UserSessionId"=>"",
															"AccessKey"=>"",
															"Agent"=>"",
															"gsSource"=>"",
															"gsDebug"=>true),
											"Req"=>array("CourseId"=>$course_id,
															)));
					
			$results['result']=$response->CourseInfoResult->Course;
	   
	        $record_per_page=5;
			 if($para=='date')
			 {
				$results['result1']=$this->common_model->select_where_limit_order('*','gama_golf_review',array('status'=>1,'course_id'=>$course_id),$page_start_from,$record_per_page,'dates','DESC');
				$results['sort']="date"; 
			 }
			   
			 if($para=='rating')
			 {
				$results['result1']=$this->common_model->count_rating($course_id,$page_start_from,$record_per_page);
				
				$results['sort']="rating";
			 }
	   
	   
			
			
			$mypaing['total_rows']=$this->common_model->select_where_num('*','gama_golf_review',array('status'=>1,'course_id'=>$course_id)); 
			$mypaing['base_url']=base_url()."golfcourse_detail/review_sorting/".$para.'/'.$course_id;
			$mypaing['per_page']=$record_per_page;
			$mypaing['uri_segment']= 5;
			$this->pagination->initialize($mypaing);
			$results['paginglink']=$this->pagination->create_links();
			
			$results['title']="Golf Course";
			$data['contents']=$this->load->view('all_review_listing',$results,true);
			$this->load->view('template',$data);
	   }
	
	
	

	
	
	
	
	
	


}?>