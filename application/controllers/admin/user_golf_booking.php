<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class User_golf_booking extends CI_Controller {

	
	
	
	/* $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ admin login $$$$$$$$$$$$$$$$$$$$$$$$$$$$*/	
	function index()
	{
	   $this->form_validation->set_rules('email','Email','trim|required|valid_email');
	   $this->form_validation->set_rules('password','Password','trim|required|callback_admin_check');
	   if($this->form_validation->run()==false)
	   {
		   if($this->session->userdata('session_admin_id')=='')
		   $this->load->view('admin/gama_admin/login');
		   else
		   redirect('admin/user_golf_booking/view');
	   }
	   else
	   {
			
			//$this->load->view('admin/template',$result,'');
			//redirect('admin/user_golf_booking/booking_listing');
			redirect('admin/user_golf_booking/view');
	   }
	}
	
	
	function view()
	{
	     $results['content']=$this->load->view('admin/gama_admin/index','',true);
		$this->load->view('admin/gama_admin/template',$results);
	}
		
		
	
	
	function admin_check()
		{
			$password=$this->input->post('password');
			$email=$this->input->post('email');
			
			$db_fields['admin_email']=$email ;
			$db_fields['admin_password']=$password;
			
			$result=$this->common_model->select_where('*','db_admin',$db_fields);
			$num=$result->num_rows();
			
			
			if($num > 0)
			{
				$result=$result->row_array();
				$admin_id=$result['admin_id'];
				$this->session->set_userdata('session_admin_id',$admin_id); 
				return TRUE;
			}
			else
			{
				$this->form_validation->set_message('admin_check','Your password or email is wrong');
				return FALSE;
			}
		}	
		
	/*function admin_check()
	{
		$this->load->model('login_model');
		(object) $login='';
		$login->username=$this->input->post('email');
		$login->password=$this->input->post('password');
					
		$data_VloginObject=$this->login_model->SetIvieLoginParameters($login);
		$LoginObject=$this->login_model->login_auth($data_VloginObject);
		
		if($LoginObject)
		{
			 $LoginSessionObject=$this->login_model->setLoginSession($LoginObject);
			 $this->db_session->set_userdata('user_object',serialize($LoginSessionObject));
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('admin_check','Your password or email is wrong');
			return FALSE;
		}
	}*/
	
		
	  
		 
		/* $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ logout $$$$$$$$$$$$$$$$$$$$$$$$$*/
		/* function logout()
		{
			$this->db_session->sess_destroy();
			redirect('admin/user_golf_booking/index');
		}*/
function logout()
		  {
			  $this->session->unset_userdata('session_admin_id');
			  //redirect('admin/login/index');
			redirect('admin/user_golf_booking/index');
		  }
	  
	
	
	
	
	
	function booking_listing($page_start_from=0)
	{
		admin_session_check();
		$record_per_page=20;
		$results['result']=$this->common_model->select_where_limit_order('*','gama_booking_detail',array('status'=>1),$page_start_from,$record_per_page,'booking_date','desc');
		$mypaing['total_rows']=$this->common_model->select_where_num('gama_booking_id','gama_booking_detail',array('status'=>1));
		$mypaing['base_url']=base_url()."admin/user_golf_booking/booking_listing/";
		$mypaing['per_page']=$record_per_page;
		$mypaing['uri_segment']=4;
		$this->pagination->initialize($mypaing);
		$results['paginglink']=$this->pagination->create_links();
		$results['page_start_from']=$page_start_from;
		
	    $results['content']=$this->load->view('admin/gama_admin/all_booking_listing',$results,true);
		$this->load->view('admin/gama_admin/template',$results,'');
	    
	}
	
	
	
	
	function booking_detail($gama_booking_id,$back_page)
	{
		admin_session_check();
		$results['result']=$this->common_model->select_where('*','gama_booking_detail',array('gama_booking_id'=>$gama_booking_id));
		$results['back_page']=$back_page;
		$results['content']=$this->load->view('admin/gama_admin/booking_detail',$results,true);
		$this->load->view('admin/gama_admin/template',$results,'');
	}
	
	
	
	
	function booking_cancel($course_id,$dates,$conformation_no,$booking_id,$player_schedule_id,$status)
	{
	   $dates=date('Y-m-d',$dates);
	   $client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");
	   $response = $client->CancelGolf(array("Hdr"=>array("ResellerId"=>"WPA",
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
															"TeeDate"=>$dates."T00:00:00",
													   "ConfirmationNo"=>$conformation_no,
															"BookingId"=>$booking_id,
															)));
	  
	  if($response->CancelGolfResult->RetCd==0)
	  {
	    $cancellationNo=$response->CancelGolfResult->cancellationNo;
		//$this->common_model->delete_where(array('confirmationNo'=>$conformation_no,'bookingId'=>$booking_id),'gama_booking_detail');
		$this->common_model->update_array(array('confirmationNo'=>$conformation_no,'bookingId'=>$booking_id),'gama_booking_detail',array('action_status'=>$status));
		$this->common_model->delete_where(array('id'=>$player_schedule_id),'player_schedule');
		$RetMsg='Your Cancellation is Successfully Completed.';
		$this->session->set_userdata('my_personal_success',$RetMsg);
		
		/*$this->load->library('email');
		$this->email->from('admin@wesport.com', 'admin');
		$this->email->to('muhammad_usman@gammalogics.com');
		$this->email->cc('');
		$this->email->bcc('');
		$this->email->subject('Booking Cancelation');
		$this->email->message('User Usman have request for cash back money.');
		$this->email->send();*/
		
	  }else
	  {
	     $RetMsg=$response->CancelGolfResult->RetMsg;
		 $this->session->set_userdata('my_personal_error',$RetMsg);
	  }
	   //print_r($response);
	  // exit;
	   redirect('admin/user_golf_booking/booking_listing');
	}
	
	
	
	
	
	
	
	
	
	
	
	


}?>