<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
// Code here is run before ALL controllers
class MY_Controller extends CI_Controller
{
	
	
	function __construct()
    {
        parent::__construct();
		
		 /*if($this->db_session->userdata('user_object')==''){
            redirect('login');
        }*/
		 if($this->db_session->userdata('user_object')!=''){
						 $user_obj= @unserialize($this->db_session->userdata('user_object'));
                         $this->userId = $user_obj->getUserid();
						 $this->userEmail = $user_obj->getEmail();
                         $this->userType  = $user_obj->getusertype();
						 $this->userFname  = $user_obj->getFirstname();
						 $this->userLname  = $user_obj->getLastname();
					 	 $this->gender  = $user_obj->getUsergender();
					  	if($this->userType=='3'){
					  	 	$this->clubId  = $user_obj->getClubid();
					  	}
						 $this->image=$this->db->query("select image from players where id='".$this->userId."'")->row()->image;
						 if($this->image==''){
							 $this->image=($this->gender=='m'?'css/images/empty_image.png':'css/images/female_image.png');
						 }else{
							 $this->image='images/th_'.$this->image;
						 }
						 
			  }
    }
	
}
class MY_Playercontroller extends CI_Controller
{
	
	
	function __construct()
    {
        parent::__construct();
		
		 if($this->db_session->userdata('user_object')==''){
            redirect('login');
        }
		 if($this->db_session->userdata('user_object')!=''){
						 $user_obj= @unserialize($this->db_session->userdata('user_object'));
                         $this->userId = $user_obj->getUserid();
						 $this->userEmail = $user_obj->getEmail();
                         $this->userType  = $user_obj->getusertype();
						 $this->userFname  = $user_obj->getFirstname();
			  }
    }
	
}
class MY_Clubcontroller extends CI_Controller
{
	
	
	function __construct()
    {
        parent::__construct();
		
		 if($this->db_session->userdata('user_object')==''){
            redirect('login');
        }
		 if($this->db_session->userdata('user_object')!=''){
						 $user_obj= @unserialize($this->db_session->userdata('user_object'));
                         $this->userId = $user_obj->getUserid();
						 $this->userEmail = $user_obj->getEmail();
                         $this->userType  = $user_obj->getusertype();
						 $this->userFname  = $user_obj->getFirstname();
			  }
    }
	
}