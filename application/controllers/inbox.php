<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inbox extends MY_Controller {

    function __construct() {
        // Call the Parent constructor
        parent::__construct();
		/*if($this->userType!=2){	
				      redirect('');
					  }*/
		 $this->load->model('users_model');
		 $this->load->model('inbox_model');
		 $this->load->library('pagination');
		 session_check();
    }

   
    public function index() {
		if($this->userType==2)
		$data['active_tab'] = '5';
		else
		$data['active_tab'] = '3';
		$data['left_nav'] =  'common/left_nav.php';
		$data['right_nav'] =  'common/ads.php';
        $data['content_page'] = 'inbox/inbox.php';	
		$data['links_js_css']='inbox/links_js_css';
        $this->load->view('common/base_template', $data);
    }
	
	public function sent() {
			if($this->userType==2)
			$data['active_tab'] = '5';
			else
			$data['active_tab'] = '3';
		$data['left_nav'] =  'common/left_nav.php';
		$data['right_nav'] =  'common/ads.php';
        $data['content_page'] = 'inbox/sent.php';
		$data['links_js_css']='inbox/links_js_css';
        $this->load->view('common/base_template', $data);
    }
	
	function inbox_grid(){
        if($this->input->post()){
            $post=$this->input->post();
            $sql="select i.*,u.first_name,u.email from inbox i
			inner join players u on i.`from`=u.id
			inner join inbox_users iu on i.id=iu.inbox_id
                    where iu.user_id='".$this->userId."' ";
            $data=$this->my_db_lib->get_jqgrid_data($post,$sql);
            if(count($data->db_data)){
                $i=0;
                foreach($data->db_data as $k=>$v){
                    $data->rows[$i]['id']=$v['id'];
                    $data->rows[$i]['cell']=array(
                                            '<div><a href="'.site_url('inbox/view/'.$v['id']).'" style="display: block;">'.$v['first_name'].'('.$v['email'].')</a></div>',
                                            '<div><a href="'.site_url('inbox/view/'.$v['id']).'" style="display: block;">'.$v['subject'].'</a></div>',
                                            date('d-m-Y H:i:s',strtotime($v['create_date']))
                                        );
                    $i++;
                }
            }else{
                $data->rows[0]['id']=0;
                $data->rows[0]['cell']=array('No messages Found','','');
            }
            unset($data->db_data);
            echo json_encode($data);
        }
    }
	
	function inbox_sent_grid(){
        if($this->input->post()){
            $post=$this->input->post();
            $sql="select i.*,group_concat(concat(u.first_name,'(',u.email,')')) as reciep from inbox i
			inner join inbox_users iu on i.id=iu.inbox_id
						inner join players u on iu.`user_id`=u.id
                    where i.`from`='".$this->userId."' group by iu.inbox_id ";
            $data=$this->my_db_lib->get_jqgrid_data($post,$sql);
            if(count($data->db_data)){
                $i=0;
                foreach($data->db_data as $k=>$v){
                    $data->rows[$i]['id']=$v['id'];
                    $data->rows[$i]['cell']=array(                        
					'<div><a href="'.site_url('inbox/sent_view/'.$v['id']).'">'.$v['reciep'].'</a></div>',
                                        '<div><a href="'.site_url('inbox/sent_view/'.$v['id']).'">'.$v['subject'].'</a></div>',
					date('d-m-Y H:i:s',strtotime($v['create_date']))
                                        );
                    $i++;
                }
            }else{
                $data->rows[0]['id']=0;
                $data->rows[0]['cell']=array('No messages Found','','');
            }
            unset($data->db_data);
            echo json_encode($data);
        }
    }
	
	function compose() {
		$data['u_details']='';
		if($this->input->post('submit')){
		   $_POST['from']=$this->userId;
		 
			$inbox_id=$this->my_db_lib->save_record($this->input->post(),'inbox');
			$to=$_POST['to_id'];
			$this->inbox_model->add_inbox_users($inbox_id,$to);
			redirect('inbox');
		}else{
			if($this->userType==2)
			$data['active_tab'] = '5';
			else
			$data['active_tab'] = '3';
			$data['left_nav'] =  'common/left_nav.php';
			$data['right_nav'] =  'common/ads.php';
			$data['content_page'] =  'inbox/compose';
			$data['links_js_css']='inbox/links_js_css';
			$this->load->view('common/base_template', $data);
		}
	}
	
	function view($id=0) {
		$data['i_details']=$this->inbox_model->view_message($id,$this->userId);
		if($this->userType==2)
			$data['active_tab'] = '5';
			else
			$data['active_tab'] = '3';
		$data['left_nav'] =  'common/left_nav.php';
		$data['right_nav'] =  'common/ads.php';
		$data['content_page'] =  'inbox/view';
		$data['links_js_css']='inbox/links_js_css';
		$this->load->view('common/base_template', $data);
	}

	function sent_view($id=0) {
		$data['i_details']=$this->inbox_model->sent_view_message($id,$this->userId);
		if($this->userType==2)
			$data['active_tab'] = '5';
			else
			$data['active_tab'] = '3';
		$data['left_nav'] =  'common/left_nav.php';
		$data['right_nav'] =  'common/ads.php';
		$data['content_page'] =  'inbox/sent_view';
		$data['links_js_css']='inbox/links_js_css';
		$this->load->view('common/base_template', $data);
	}

	function notifications($pagenumber=0){
		//$pagenumber=0;
		$rec=$this->inbox_model->notifications($this->userId);
		$data['total_rows']=$rec['total'];
		$data['notify_data']=$rec['records'];
		if($this->userType==2)
		$data['active_tab'] = '5';
		else
		$data['active_tab'] = '3';
		$data['left_nav'][] =  'common/left_nav.php';
		$data['right_nav'][] =  'common/ads.php';
		$data['content_page'] =  'inbox/notifications';
		$data['links_js_css']='inbox/links_js_css';
		$this->load->view('common/base_template', $data);
	}
function invitation($pagenumber=0){
		$config['base_url'] = site_url('inbox/invitation');
		$config['per_page'] = '10'; 
		$config['uri_segment'] = '3'; 
		//$pagenumber=0;
		$config['full_tag_open'] = '<div class="page_box fl">';
		$config['full_tag_close'] = '</div>';
		$rec=$this->users_model->requestfriends($this->userId,$pagenumber,10);
		$config['total_rows'] = $rec['total'];
		$data['total_rows']=$rec['total'];
		$data['frends_data']=$rec['records'];
		$this->pagination->initialize($config);
		$data['plrelation'] = json_encode($this->users_model->friendsrelations());
		$data['teamrelation'] = json_encode($this->users_model->teamrelations());
		if($this->userType==2)
			$data['active_tab'] = '5';
			else
			$data['active_tab'] = '3';
		$data['left_nav'][] =  'common/left_nav.php';
		$data['right_nav'][] =  'common/ads.php';
		$data['content_page'] =  'inbox/invitation';
		$data['links_js_css']='inbox/links_js_css';
		$this->load->view('common/base_template', $data);
	}
	
}

?>
