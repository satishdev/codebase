<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//CI_Controller

class Reserve_golfcourse extends MY_Controller{

function __construct()

    {

        // Call the Parent constructor

        parent::__construct();

		 $this->load->model('login_model');

		 $this->load->model('users_model');

         $this->load->model('schedule_model');

    }

	/* public function index()

	{

		$results['title']='Golfhub';

		$temp['contents']=$this->load->view('teetime_search',$results,true);

		$this->load->view('template',$temp);

	}*/

	//>>>>>>>>>

	//>>>>>>>>>

	//>>>>>>>>>

	function add_cart()
	{
		$session_id=$this->session->userdata('session_id');

		$db_price=$this->common_model->select_where('price','gama_add_cart',array('session_id'=>$session_id));

		if($db_price->num_rows()>0)

		{//to check if any currency exits in cart already.

			$db_price=$db_price->row();

			$db_price=$db_price->price;

			$db_price=explode(' ',$db_price);

			$db_price_curr=$db_price[0];

		}

		else

		{

			$db_price_curr=$this->input->post('ajx_price');

			$db_price_curr=explode(' ',$db_price_curr);

			$db_price_curr=$db_price_curr[0];

		}

		$ajx_price=$this->input->post('ajx_price');

		$price_curr=explode(' ',$ajx_price);

		$price_curr=$price_curr[0];

		

		if(strcmp(strtoupper($price_curr),strtoupper($db_price_curr))==0)

		{//if currency is same

			$course_id=$this->input->post('course_id');

			$ajx_mytime=$this->input->post('ajx_mytime');

			$date=$this->input->post('date');

			$ajx_select_playr=$this->input->post('ajx_select_playr');

			$ppnonref=$this->input->post('ppnonref');

			$nm=$this->input->post('nm');

			$maxRewPts=$this->input->post('maxRewPts');

			$img=$this->input->post('img');

			$allow_players=$this->input->post('allow_players');

			

			$flags=$this->input->post('flags');

			$ppRewPts=$this->input->post('ppRewPts');

			$ppNetRt=$this->input->post('ppNetRt');

			$chrgCurr=$this->input->post('chrgCurr');

			$ppCharge=$this->input->post('ppCharge');

			$ppTxnFee=$this->input->post('ppTxnFee');

			

			if($img!='')

			{

			$image=@file_get_contents('http://xml.golfswitch.com/img/course/'.$course_id.'/'.$img);

			@file_put_contents(PATH_DIR."asserts/upload_img/golf_course/".$course_id.'_'.$img, $image);

			}

			else

			{

			$img='no_image.jpeg';

			$image=file_get_contents(PATH_DIR."asserts/images/".$img);

			@file_put_contents(PATH_DIR."asserts/upload_img/golf_course/".$course_id.'_'.$img, $image);

			

			}

			

			$db_fields['course_id']=$course_id;

			$db_fields['times']=$ajx_mytime;

			$db_fields['dates']=$date;

			$db_fields['price']=$ajx_price;

			$db_fields['players']=$ajx_select_playr;

			$db_fields['ppNonRef']=$ppnonref;

			$db_fields['course_name']=$nm;

			$db_fields['maxRewPts']=$maxRewPts;

			$db_fields['session_id']=$session_id;

			$db_fields['img']=$img;

			$db_fields['allow_players']=$allow_players;

			

			$db_fields['flags']=$flags;

			$db_fields['ppRewPts']=$ppRewPts;

			$db_fields['ppNetRt']=$ppNetRt;

			$db_fields['chrgCurr']=$chrgCurr;

			$db_fields['ppCharge']=$ppCharge;

			$db_fields['ppTxnFee']=$ppTxnFee;

			

		//$this->common_model->delete_where(array('session_id'=>$session_id),'gama_add_cart');

			//start check if a golfcourse already exist in cart...

			$num=$this->common_model->select_where_num('course_id','gama_add_cart',array('times'=>$ajx_mytime,'session_id'=>$session_id,'course_name'=>$nm,'dates'=>$date));

			if($num>0)

			{

				$this->session->set_userdata('my_msg','You already include this golf course in your cart.');

			}

			else

			{

				$this->common_model->insert_array('gama_add_cart',$db_fields);

			}

			//end check if a golfcourse already exist in cart...

		}

		else

		{//if currency is not same

		   $this->session->set_userdata('my_msg','Only Same Currency teetime are allow in Cart.');

		}

		

		

		$results['result']=$this->common_model->select_where('*','gama_add_cart',array('session_id'=>$session_id));

		$html=$this->load->view('ajax_add_cart_dialogbox',$results,'');

		echo $html;

		

	}//end function add_cart

	

	

	

	

	

	//>>>>>>>>>

	//>>>>>>>>>

	//>>>>>>>>>

	function delete_cart()

	{

		$gama_add_cart_id=$this->input->post('gama_add_cart_id');

		$course_id=$this->input->post('course_id');

		$this->common_model->delete_where(array('gama_add_cart_id'=>$gama_add_cart_id),'gama_add_cart');

		

		//@unlink(PATH_DIR.'upload_img/golf_course/'.$course_id.'_overview.jpg');

		

		$session_id=$this->session->userdata('session_id');

		$results['result']=$this->common_model->select_where('*','gama_add_cart',array('session_id'=>$session_id));

		$html=$this->load->view('ajax_add_cart_dialogbox',$results,'');

		echo $html;

	}

	

	

	

	

	

	//>>>>>>>>>

	//>>>>>>>>>

	//>>>>>>>>>

	function check_out()

	{

		$session_id=$this->session->userdata('session_id');

		$results['result']=$this->common_model->select_where('*','gama_add_cart',array('session_id'=>$session_id));

		$results['my_title']='Check Out';  

		$data['contents']=$this->load->view('cart_listing',$results,true);

		$this->load->view('template',$data,'');

	}

	//>>>>>>>>>

	//>>>>>>>>>

	//>>>>>>>>>

	function ajax_cart_listing_dialogbox()

	{

		$players=$this->input->post('players');

		$gama_add_cart_id=$this->input->post('gama_add_cart_id');

		

		$db_fields['players']=$players;

		$this->common_model->update_array(array('gama_add_cart_id'=>$gama_add_cart_id),'gama_add_cart',$db_fields);

		

		$session_id=$this->session->userdata('session_id');

		$results['result']=$this->common_model->select_where('*','gama_add_cart',array('session_id'=>$session_id));

		$html=$this->load->view('ajax_add_cart_dialogbox',$results,'');

		echo $html;

	}

	

	

	

	

	

	

	//>>>>>>>>>

	//>>>>>>>>>

	//>>>>>>>>>

	function ajax_cart_listing()

	{

		$players=$this->input->post('players');

		$gama_add_cart_id=$this->input->post('gama_add_cart_id');

		

		$db_fields['players']=$players;

		$this->common_model->update_array(array('gama_add_cart_id'=>$gama_add_cart_id),'gama_add_cart',$db_fields);

		

		$session_id=$this->session->userdata('session_id');

		$results['result']=$this->common_model->select_where('*','gama_add_cart',array('session_id'=>$session_id));

		$html=$this->load->view('ajax_cart_listing',$results,'');

		echo $html;

	}

	

	

	

	

	//>>>>>>>>>

	//>>>>>>>>>

	//>>>>>>>>>

	function delete_cart_listing()

	{

		$gama_add_cart_id=$this->input->post('gama_add_cart_id');

		$this->common_model->delete_where(array('gama_add_cart_id'=>$gama_add_cart_id),'gama_add_cart');

		

		$session_id=$this->session->userdata('session_id');

		$results['result']=$this->common_model->select_where('*','gama_add_cart',array('session_id'=>$session_id));

		$html=$this->load->view('ajax_cart_listing',$results,'');

		echo $html;

	}

	

	

	

	

	

	//>>>>>>>>>

	//>>>>>>>>>

	//>>>>>>>>>

	

	function process_checkout()

	{

		// $user_id=$this->db_session->userdata('user_object');

		 //$this->session->userdata('session_user_id');

		  

		// if($user_id!='')

		// {

		   redirect('reserve_golfcourse/shipping_form');

		 //}

		 /*else

		 {

			$results['my_title']='Checkout';

			$data['contents']=$this->load->view('login_registration',$results,true);

			$this->load->view('template',$data);

		 }  */

	}

	

	

	

	



	

	

	

	

	//>>>>>>>>>

	//>>>>>>>>>

	//>>>>>>>>>

	function shiping_form($id)

	{

	    if($this->db_session->userdata('user_object')=='')

	    {

		   redirect('reserve_golfcourse/shipping_form');

		}

		

		$this->form_validation->set_rules('card_name','Credit Card name','trim|required');

		

		$this->form_validation->set_rules('user_fname','First Name','trim|required');

		$this->form_validation->set_rules('user_lname','Last Name','trim|required');

		$this->form_validation->set_rules('email','Email','trim|required|valid_email');

		$this->form_validation->set_rules('country','Country','trim|required');

		

		$this->form_validation->set_rules('address','Address','trim|required');

		$this->form_validation->set_rules('city','City','trim|required');

		$this->form_validation->set_rules('state','State','trim|required');

		$this->form_validation->set_rules('postal_code','Postal Code','trim|required');

		$this->form_validation->set_rules('phone','Phone No.','trim|required');

		$this->form_validation->set_rules('card_type','Credit Card Type','trim|required');

		$this->form_validation->set_rules('card_no','Credit Card No.','trim|required');

		/*$this->form_validation->set_rules('ccaddress','Credit Card Address','trim');

		$this->form_validation->set_rules('cccountry','Credit Card Country','trim');

		$this->form_validation->set_rules('ccpostalcode','Credit Card PostalCode','trim');*/

		$this->form_validation->set_rules('ccsecret_no','Credit Card Security Code','trim|required');

		$this->form_validation->set_rules('expire_month','Expiry Month','trim|required');

		$this->form_validation->set_rules('expire_year','Expiry Year','trim|required');

		if($this->form_validation->run()==FALSE)

		{

            //start check user is login or not 

			if($this->db_session->userdata('user_object')!='')

			{

				$unserialize=@unserialize($this->db_session->userdata('user_object'));

				$user_id=$unserialize->getuserid();

				//print_r($userid);

				$results['result']=$this->common_model->select_where('*','players',array('id'=>$user_id));

				 $results['result2']=$this->common_model->select_where('*',' gama_user_shiping_info',array('user_shiping_info_id'=>$id));

				 $results['read_only']='yes';

			}

			else

			{

			   $results['result']='';

			   $results['result2']='';

			   $results['read_only']='no';

			}

			//end check user is login or not  			

				

			$results['adres_id']=$id;

			$results['hide_logout']='yes';

			$results['my_title']='Checkout';

			$results['save']='Save o day ne';

			$session_id=$this->session->userdata('session_id');

			$results['result1']=$this->common_model->select_where('*','gama_add_cart',array('session_id'=>$session_id)); 

			

			$data['contents']=$this->load->view('shipping_form',$results,true);

			$this->load->view('template',$data);

		}

		else

		{

		   //update user info in gama_user table

		   $unserialize=@unserialize($this->db_session->userdata('user_object'));

		   $user_id=$unserialize->getuserid();

		   

		   $db_fields['first_name']=$this->input->post('user_fname');

		   $db_fields['last_name']=$this->input->post('user_lname');

		   $db_fields['email']=$this->input->post('email');

		   $db_fields['country_id']=$this->input->post('country');

		   

		   $this->common_model->update_array(array('id'=>$user_id),'players',$db_fields);

		   $db_fields='';

		   //end update user info in gama_user table

		   

		   /*//insert data in gama_user_shiping_info

		   $db_fields['credit_card_name']=$this->input->post('card_name');

		   $db_fields['address']=$this->input->post('address');

		   $db_fields['city']=$this->input->post('city');

		   $db_fields['state']=$this->input->post('state');

		   $db_fields['postal_code']=$this->input->post('postal_code');

		   $db_fields['phone_no']=$this->input->post('phone');

		   $db_fields['credit_card_type']=$this->input->post('card_type');

		   $db_fields['credit_card_no']=$this->input->post('card_no');

		   $db_fields['ccsecret_no']=$this->input->post('ccsecret_no');

		   $db_fields['credit_card_expiry_month']=$this->input->post('expire_month');

		   $db_fields['credit_card_expiry_year']=$this->input->post('expire_year');

		   

		   $unserialize=@unserialize($this->db_session->userdata('user_object'));

		   $user_id=$unserialize->getuserid();

			

				

		   $db_fields['user_id']=$user_id;

		   $insert_user_shiping_id=$this->common_model->insert_array('gama_user_shiping_info',$db_fields);

		   $db_fields='';

		   //end insert data in gama_user_shiping_info*/

		    $insert_user_shiping_id=$id;

		   

		   //start insert data in gama_booking_detail table

		   $session_id=$this->session->userdata('session_id');

		   //get data from gama_add_cart

		   $cart_data=$this->common_model->select_where('*','gama_add_cart',array('session_id'=>$session_id));

		   foreach($cart_data->result() as $cart_data)

		   {

				/*$price_curr=$cart_data->price;

				$price_curr=explode(' ',$price_curr);

				$curr=$price_curr[0];

				$price=$price_curr[1];

				$db_fields['price']=$cart_data->price;

				$db_fields['curr']=$cart_data->curr;*/

				$db_fields['price']=$cart_data->price;

				$db_fields['course_name']=$cart_data->course_name;

				$db_fields['players']=$cart_data->players;

				$db_fields['allow_players']=$cart_data->allow_players;

				$db_fields['ppTxnFee']=$cart_data->ppTxnFee;

				$db_fields['ppCharge']=$cart_data->ppCharge;

				$db_fields['chrgCurr']=$cart_data->chrgCurr;

				$db_fields['ppNonRef']=$cart_data->ppNonRef;

				$db_fields['ppNetRt']=$cart_data->ppNetRt;

				$db_fields['ppRewPts']=$cart_data->ppRewPts;

				$db_fields['flags']=$cart_data->flags;

				

				$db_fields['maxRewPts']=$cart_data->maxRewPts;

				$db_fields['times']=$cart_data->times;

				$db_fields['dates']=$cart_data->dates;

				$db_fields['course_id']=$cart_data->course_id;

				$db_fields['img']=$cart_data->img;

				

				//insert id of shipping info of a user

				$db_fields['user_shiping_info_id']=$insert_user_shiping_id;

				$db_fields['user_id']= $user_id;

				

				//start get user basic info form players table

			    $user_info=$this->common_model->select_where('*','players',array('id'=>$user_id));

				$row=$user_info->row();

				$db_fields['gender']=$row->gender;

				$db_fields['dob']=$row->dob;

				//end get user basic info form players table

				

				$db_fields['user_fname']=$this->input->post('user_fname');

				$db_fields['user_lname']=$this->input->post('user_lname');

				$db_fields['email']=$this->input->post('email');

				$db_fields['country']=$this->input->post('country');

				$db_fields['address']=$this->input->post('address');

				$db_fields['city']=$this->input->post('city');

				$db_fields['state']=$this->input->post('state');

				$db_fields['postal_code']=$this->input->post('postal_code');

				$db_fields['phone_no']=$this->input->post('phone');

			//	$db_fields['credit_card_expiry_month']=$this->input->post('expire_month');

			//	$db_fields['credit_card_expiry_year']=$this->input->post('expire_year');

				$db_fields['status']=0;

				$db_fields['session_id']=$session_id;

				$db_fields['booking_date']=time();

				

			    $this->common_model->insert_array('gama_booking_detail',$db_fields);

				$db_fields='';

		   } 

		    //end insert data in gama_booking_detail table

		  $this->session->set_userdata('ccsecret_no',$this->input->post('ccsecret_no'));

		  $this->session->set_userdata('card_no',$this->input->post('card_no'));

		  $this->session->set_userdata('card_type',$this->input->post('card_type'));

		  $this->session->set_userdata('card_name',$this->input->post('card_name'));

		  $this->session->set_userdata('expire_month',$this->input->post('expire_month'));

		  $this->session->set_userdata('expire_year',$this->input->post('expire_year'));

		 

		   

		   //delete data from add_to_cart table

	//$this->common_model->delete_where(array('session_id'=>$session_id),'gama_add_cart');

	        redirect('reserve_golfcourse/booking_golfcourse');   

		}

	

	

	

	}

	

	

	

	

	

	function check_add_to_add_empty()

	{

		$session_id=$this->session->userdata('session_id');

		$cart_data=$this->common_model->select_where('*','gama_add_cart',array('session_id'=>$session_id));

		if($cart_data->num_rows()>0)

		{

		   return true;

		}

		else

		{

		  $this->form_validation->set_message('check_add_to_add_empty','Your Cart is Empty Now.');

		  return false;

		}	

	}

	

	

	

	

	function expiry_check()
        {
          //  echo '<pre>';
           // print_r($_POST);
        }

	

	function shipping_form()

	{

		$this->form_validation->set_rules('card_name','Credit Card name','trim|required|callback_check_add_to_add_empty');

		$this->form_validation->set_rules('user_fname','First Name','trim|required');

		$this->form_validation->set_rules('user_lname','Last Name','trim|required');

		$this->form_validation->set_rules('email','Email','trim|required|valid_email');

		$this->form_validation->set_rules('country','Country','trim|required');

		$this->form_validation->set_rules('address','Address','trim|required');

		$this->form_validation->set_rules('city','City','trim|required');

		$this->form_validation->set_rules('state','State','trim|required');

		$this->form_validation->set_rules('postal_code','Postal Code','trim|required');

		$this->form_validation->set_rules('phone','Phone No.','trim|required');

		$this->form_validation->set_rules('card_type','Credit Card Type','trim|required');

		$this->form_validation->set_rules('card_no','Credit Card No.','trim|required');

		$this->form_validation->set_rules('ccsecret_no','Credit Card Security Code','trim|required');

		$this->form_validation->set_rules('expire_month','Expiry Month','trim|required|callback_expiry_check');

		$this->form_validation->set_rules('expire_year','Expiry Year','trim|required|callback_expiry_check');

		if($this->form_validation->run()==FALSE)
		{
			//start check user is login or not 

			if($this->db_session->userdata('user_object')!='')

			{

				$unserialize=@unserialize($this->db_session->userdata('user_object'));

				$user_id=$unserialize->getuserid();

				$results['result']=$this->common_model->select_where('*','players',array('id'=>$user_id));

			    $results['result2']=$this->common_model->select_where('*',' gama_user_shiping_info',array('user_id'=>$user_id));

			    $results['read_only']='yes';

			

			}

			else

			{

			   $results['result']='';

			   $results['read_only']='no';

			   $results['result2']='';

			}

			

			//end check user is login or not

			//$results['adres_id']=0;

			//$results['hide_logout']='yes';

			//$results['my_title']='Checkout';
			# lay danh sach cua team
			#$resultTeam = $this->common_model->select_where('players_id','player_teams',array('created_by'=>$user_id));
			$save=array();
			$save_user='';
			$save_team='';
			// $resultTeam = $this->db->query("SELECT  `players_id` FROM  `player_teams` WHERE  `created_by` =  '".$user_id."' GROUP BY  `players_id`");
			// foreach($resultTeam->result() as $team){
				// $result_team = $this->common_model->select_where('description','player_schedule',array('players_id'=>$team->players_id));
				// foreach($result_team->result() as $temp){
					// array_push($save, $temp->description);
				// }
			// }
			
			# Get calendar of team
			$sql_getTeam = "SELECT `teams_id` FROM `player_teams` WHERE `created_by`='".$user_id."' group by `teams_id` ";
			$result_getTeam = $this->db->query($sql_getTeam);
			$save_team=count($result_getTeam->result());
			foreach($result_getTeam->result() as $team){
				$sql="select * FROM player_schedule ps INNER JOIN schedule_users su ON ps.id=su.schedule_id where su.user_id=".$team->teams_id." GROUP BY ps.id";
				$result_team = $this->db->query($sql);
				foreach($result_team->result() as $temp){
					array_push($save, 'My Team '.$temp->id);//$temp->description
					
				}				
			}
			
			$sql_selectTeam ="SELECT * FROM `teams` where `created_by`='".$user_id."' ORDER BY `teams`.`created_date` DESC";
			$result_selectTeam = $this->db->query($sql_selectTeam);
			$saveTeam=array();
			$teamID=array();
			foreach($result_selectTeam->result() as $teams){
				array_push($saveTeam,$teams->name);//$temp->description
				array_push($teamID,"team".$teams->id);
			}
			# Lay calendar cua minh
			$result = $this->common_model->select_where('*','player_schedule',array('players_id'=>$user_id));
			$save_user=count($result->result());
			
			foreach($result->result() as $row){
				//array_push($save, 'user '.$user_id.': '.$row->id);//$row->description
				$saveUser=$row->name;
			}
			// echo "<pre>";
			// print_r($resultTeam->result());
			// echo "</pre>";
			
			//showing the cart data
			
			$names = $this->common_model->select_where('*','players',array('id'=>$user_id));
			foreach($names->result() as $row){
				$name = $row->first_name. " " .$row->last_name;
			}
			
			$session_id=$this->session->userdata('session_id');

			$results['result1']=$this->common_model->select_where('*','gama_add_cart',array('session_id'=>$session_id)); 

			$results['name']= $name;
			
			$results['save_user']= $save_user;
			
			$results['save_team']= $save_team;
			
			$results['saveTeam']= $saveTeam;
			
			$results['teamID']= $teamID;
			
			$results['userID']= $user_id;

			$data['contents']=$this->load->view('shipping_form',$results,true);

			$data['my_title']='Billing Process';

			$this->load->view('template',$data);

		}

		else

		{

		   

		   //start update user info in gama_user table

		   if($this->db_session->userdata('user_object')!='')

		   {

			   $unserialize=@unserialize($this->db_session->userdata('user_object'));

			   $user_id=$unserialize->getuserid();

			   

			   $db_fields['first_name']=$this->input->post('user_fname');

			   $db_fields['last_name']=$this->input->post('user_lname');

			   $db_fields['email']=$this->input->post('email');

			   $db_fields['country_id']=$this->input->post('country');

			   

			   $this->common_model->update_array(array('id'=>$user_id),'players',$db_fields);

			   $db_fields='';

		   }

		   else

		   {

		     $user_id=0;

		   }

		   //end update user info in gama_user table

		   

		   //start update data in gama_user_shiping_info

		   $db_fields['first_name']=$this->input->post('user_fname');

		   $db_fields['last_name']=$this->input->post('user_lname');

		   $db_fields['email']=$this->input->post('email');

		   $db_fields['address']=$this->input->post('address');

		   $db_fields['city']=$this->input->post('city');

		   $db_fields['state']=$this->input->post('state');

		    $db_fields['country_id']=$this->input->post('country');

		   $db_fields['postal_code']=$this->input->post('postal_code');

		   $db_fields['phone_no']=$this->input->post('phone');		  		  

		   $session_id=$this->session->userdata('session_id');

		   $db_fields['session_id']=$session_id;
		   
		   $db_fields['option']= substr($this->input->post('save'),0,4);;
		   
		   // insert table
			$session_id=$this->session->userdata('session_id');

			$resultsz=$this->common_model->select_where('*','gama_add_cart',array('session_id'=>$session_id));
			
			foreach($resultsz->result() as $row){
				$dateTemp = DATE("H:i", STRTOTIME("$row->times"));
			}
			
			$post['players_id']=substr($this->input->post('save'),4);
			$post['created_by']=$user_id;
			$post['start_date']=date('Y-m-d ').$dateTemp;
			$post['end_date']=date('Y-m-d ').$dateTemp;
			$post['name']='Your Booking';
			$post['description']='Your Booking';//$post['CalendarTitle'];
			if(date('H:i:s')!='00:00:00' || date('H:i:s')!='00:00:00'){
				$post['isalldayevent']=0;
			}else{
				$post['isalldayevent']=0;//$post['IsAllDayEvent'];
			}
			
		   if($this->input->post('save')!="user"){
				$teamID = substr($this->input->post('save'),4);
				$db_fields['optionValue']=$teamID;
				// $sql_select_team = "SELECT * FROM `teams` where `id`=".$teamID."";
				// $result_select_teams = $this->db->query($sql_select_team);
				// foreach($result_select_teams->result() as $result_select_team){
					// $db_fields['optionValue']=$result_select_team->id;
				// }		
				
		   }elseif($this->input->post('save')=="user"){
				$sql_select_user = "SELECT * FROM `player_schedule` where `players_id`=".$user_id." ORDER BY `player_schedule`.`end_date` DESC Limit 1";
				$result_select_users = $this->db->query($sql_select_user);
				foreach($result_select_users->result() as $result_select_user){
					$date=$result_select_user->end_date;
					$db_fields['optionValue'] = substr($date,0,10);
				}								
		   }else{
				$db_fields['optionValue']="";
		   }		   

		 /*$db_fields['credit_card_name']=$this->input->post('card_name');

		   $db_fields['credit_card_type']=$this->input->post('card_type');

		   $db_fields['credit_card_no']=$this->input->post('card_no');

		   $db_fields['ccaddress']=$this->input->post('ccaddress');

		   $db_fields['cccountry']=$this->input->post('cccountry');

		   $db_fields['ccpostalcode']=$this->input->post('ccpostalcode');

		   $db_fields['ccsecret_no']=$this->input->post('ccsecret_no');

		   $db_fields['credit_card_expiry_month']=$this->input->post('expire_month');

		   $db_fields['credit_card_expiry_year']=$this->input->post('expire_year');*/

		   //get user id

		   if($this->db_session->userdata('user_object')!='')

		   {//if user login

				$gama_user_shiping_info=$this->common_model->select_where('user_shiping_info_id','gama_user_shiping_info',array('user_id'=>$user_id));

				$num=$gama_user_shiping_info->num_rows();

				if($num>0)

				{//if user shipping address exist in gama_user_shiping_info table

					$this->common_model->update_array(array('user_id'=>$user_id),'gama_user_shiping_info',$db_fields);

					//$gama_user_shiping_info=$gama_user_shiping_info->row();

					//$insert_user_shiping_id=$gama_user_shiping_info->user_shiping_info_id;
					if(!empty($post['id'])){
					$return = $this->my_db_lib->save_record($post,'player_schedule');
				}else{
					$post['schedule_type']='1';
					$post['user_type']='2';
					$return = $this->schedule_model->add_schedule($post);
				}

				}

				else

				{//if user shipping address not exist in gama_user_shiping_info table

					$db_fields['user_id']=$user_id;

					$insert_user_shiping_id=$this->common_model->insert_array('gama_user_shiping_info',$db_fields);
					if(!empty($post['id'])){
					$return = $this->my_db_lib->save_record($post,'player_schedule');
				}else{
					$post['schedule_type']='1';
					$post['user_type']='2';
					$return = $this->schedule_model->add_schedule($post);
				}

				}

				$db_fields='';
				$post='';
		   }

		   else if($this->db_session->userdata('user_object')=='')

		   {//if user not login

			   $db_fields['user_id']=$user_id;

			   

			   $num=$this->common_model->select_where('user_shiping_info_id','gama_user_shiping_info',array('session_id'=>$session_id));

			   if($num->num_rows()>0)

			   {

			        $db_fields['session_id']='';

					$this->common_model->update_array(array('session_id'=>$session_id),'gama_user_shiping_info',$db_fields); 

				    

					//$this->common_model->select_where('user_shiping_info_id','gama_user_shiping_info',array('session_id'=>$session_id));

					//$gama_user_shiping_info=$gama_user_shiping_info->row();

					//$insert_user_shiping_id=$gama_user_shiping_info->user_shiping_info_id;

			   }

			   else	   

			   $insert_user_shiping_id=$this->common_model->insert_array('gama_user_shiping_info',$db_fields);

			   $db_fields='';

		   }

		   //end insert data in gama_user_shiping_info

			$this->session->set_userdata('insert_user_shiping_id',$insert_user_shiping_id);

			$this->session->set_userdata('ccsecret_no',$this->input->post('ccsecret_no'));

			$this->session->set_userdata('card_no',$this->input->post('card_no'));

			$this->session->set_userdata('card_type',$this->input->post('card_type'));

			$this->session->set_userdata('card_name',$this->input->post('card_name'));

			$this->session->set_userdata('expire_month',$this->input->post('expire_month'));

			$this->session->set_userdata('expire_year',$this->input->post('expire_year'));

			//delete data from add_to_cart table

	        //$this->common_model->delete_where(array('session_id'=>$session_id),'gama_add_cart');

	        redirect('reserve_golfcourse/conform_order');   

		}

	}

	function conform_order()

	{

	    $session_id=$this->session->userdata('session_id');

		$results['result']=$this->common_model->select_where('*','gama_add_cart',array('session_id'=>$session_id));

		$results['my_title']='Conform Order';  

		

		if($this->db_session->userdata('user_object')!='')

		{

			$unserialize=@unserialize($this->db_session->userdata('user_object'));

			$user_id=$unserialize->getuserid();

			$results['result1']=$this->common_model->select_where('*','gama_user_shiping_info',array('user_id'=>$user_id));

		}

		else

		{

		    $results['result1']=$this->common_model->select_where('*','gama_user_shiping_info',array('session_id'=>$session_id));

		}

		

		$data['contents']=$this->load->view('conform_order',$results,true);

		$data['my_title']='Conform Order';

		$this->load->view('template',$data,'');     

	}

	function success_order()

	{

	    $session_id=$this->session->userdata('session_id');

		$results['result']=$this->common_model->select_where('*','gama_add_cart',array('session_id'=>$session_id)); 

		$data['contents']=$this->load->view('success_order',$results,true);

		$data['my_title']='Success';

		$this->load->view('template',$data,'');     

	}

	//>>>>>>>>>

	//>>>>>>>>>

	//>>>>>>>>>

	function booking_golfcourse()

	{

	   

	   //start insert data in gama_booking_detail table

		$session_id=$this->session->userdata('session_id');

		//$insert_user_shiping_id=$this->session->userdata('insert_user_shiping_id');

	    //$this->session->set_userdata('insert_user_shiping_id','');

		

		//get data from gama_add_cart

		$cart_data=$this->common_model->select_where('*','gama_add_cart',array('session_id'=>$session_id));

		if($cart_data->num_rows()>0)

		{

		   foreach($cart_data->result() as $cart_data)

		   {

				/*$price_curr=$cart_data->price;

				$price_curr=explode(' ',$price_curr);

				$curr=$price_curr[0];

				$price=$price_curr[1];

				$db_fields['price']=$cart_data->price;

				$db_fields['curr']=$cart_data->curr;*/

				$db_fields['gama_add_cart_id']=$cart_data->gama_add_cart_id;

				$db_fields['price']=$cart_data->price;

				$db_fields['course_name']=$cart_data->course_name;

				$db_fields['players']=$cart_data->players;

				$db_fields['allow_players']=$cart_data->allow_players;

				$db_fields['ppTxnFee']=$cart_data->ppTxnFee;

				$db_fields['ppCharge']=$cart_data->ppCharge;

				$db_fields['chrgCurr']=$cart_data->chrgCurr;

				$db_fields['ppNonRef']=$cart_data->ppNonRef;

				$db_fields['ppNetRt']=$cart_data->ppNetRt;

				$db_fields['ppRewPts']=$cart_data->ppRewPts;

				$db_fields['flags']=$cart_data->flags;

				

				$db_fields['maxRewPts']=$cart_data->maxRewPts;

				$db_fields['times']=$cart_data->times;

				$db_fields['dates']=$cart_data->dates;

				$db_fields['course_id']=$cart_data->course_id;

				$db_fields['img']=$cart_data->img;

				

				//get id of shipping info of a user

				//$db_fields['user_shiping_info_id']=$insert_user_shiping_id;

				

				

				if($this->db_session->userdata('user_object')!='')

				{//if user login

					//get user basic info form players table

					$unserialize=@unserialize($this->db_session->userdata('user_object'));

			        $user_id=$unserialize->getuserid();

					$db_fields['user_id']= $user_id;

					$user_info=$this->common_model->select_where('*','players',array('id'=>$user_id));

					$row=$user_info->row();

					$db_fields['gender']=$row->gender;

					$db_fields['dob']=$row->dob;

					//end get user basic info form players table

					

					$gama_user_shiping_info=$this->common_model->select_where('*','gama_user_shiping_info',array('user_id'=>$user_id));

				}

				else

				{

				   $gama_user_shiping_info= $this->common_model->select_where('*','gama_user_shiping_info',array('session_id'=>$session_id));

				}

				

				$row4=$gama_user_shiping_info->row();

				$db_fields['user_fname']=$row4->first_name;

				$db_fields['user_lname']=$row4->last_name;

				$db_fields['email']=$row4->email;

				$db_fields['country']=$row4->country_id;

				$db_fields['address']=$row4->address;

				$db_fields['city']=$row4->city;

				$db_fields['state']=$row4->state;

				$db_fields['postal_code']=$row4->postal_code;

				$db_fields['phone_no']=$row4->phone_no;

				/*$db_fields['ccaddress']=$this->input->post('ccaddress');

				$db_fields['cccountry']=$this->input->post('cccountry');

				$db_fields['ccpostalcode']=$this->input->post('ccpostalcode');*/

				$db_fields['status']=0;

				$db_fields['session_id']=$row4->session_id;

				$db_fields['booking_date']=time();

				

			    $my_check=$this->common_model->select_where('*','gama_booking_detail',array('session_id'=>$db_fields['session_id'],'dates'=>$db_fields['dates'],'times'=>$db_fields['times'],'course_name'=>$db_fields['course_name']));

				$my_check=$my_check->num_rows;

				if($my_check==0)

				{

				    $this->common_model->insert_array('gama_booking_detail',$db_fields);

				}

				$db_fields='';

		   }

		} 

		//end insert data in gama_booking_detail table		

		

		

		

		

		

		

		$ccsecret_no=$this->session->userdata('ccsecret_no');

		$credit_card_no=$this->session->userdata('card_no');

		$credit_card_type=$this->session->userdata('card_type');

		$credit_card_name=$this->session->userdata('card_name');

		$expire_month=$this->session->userdata('expire_month');

		$expire_year=$this->session->userdata('expire_year');

		

		$session_id=$this->session->userdata('session_id');

		

		$this->session->set_userdata('ccsecret_no','');

		$this->session->set_userdata('card_no','');

		$this->session->set_userdata('card_type','');

		$this->session->set_userdata('card_name','');

		$this->session->set_userdata('expire_month','');

		$this->session->set_userdata('expire_year','');

		

		if($this->db_session->userdata('user_object')!='')

		{

			$unserialize=@unserialize($this->db_session->userdata('user_object'));

			$user_id=$unserialize->getuserid();

			$booking_data=$this->common_model->select_where('*','gama_booking_detail',array('user_id'=>$user_id,'status'=>0,'session_id'=>$session_id));

		}

		else

		{

			$booking_data=$this->common_model->select_where('*','gama_booking_detail',array('status'=>0,'session_id'=>$session_id));

		}

		

		//print_r($booking_data->result());

		//exit;

		$response='';

		$count_players=0;

		$i=0;

		$all_data_save='';

		 

		foreach($booking_data->result() as $row)

		{

		$i++;

		

		$gama_add_cart_id=$row->gama_add_cart_id;

		$dates=date('Y-m-d',$row->dates);

		$find=array("AM","PM",":");

        $replace=array("","","");

		$times=str_replace($find,$replace,$row->times);

		$players=$row->players;

		

		$price_cur=$row->price;

		$price_cur=explode(' ',$price_cur);

		$cur=$price_cur[0];

		$price=$price_cur[1];

		$TotPrice=$price*$players;

		

		$ppTxnFee=$row->ppTxnFee;

		$TotTxnFee=$ppTxnFee*$players;

		

		$ppCharge=$row->ppCharge;

		$TotCharge=$ppCharge*$players;

		

		$chrgCurr=$row->chrgCurr;

		

		$ppNonRef=$row->ppNonRef;

		$TotNonRef=$ppNonRef*$players;

		

		 

		$ppNetRt=$row->ppNetRt;

		$TotNetRt=$ppNetRt*$players;

		

		$flags=$row->flags;

		

		$user_fname=$row->user_fname;

		$user_lname=$row->user_lname;

		$email=$row->email;

		/*$credit_card_expiry_month=$row->credit_card_expiry_month;

		$credit_card_expiry_year=$row->credit_card_expiry_year;*/

		

		if($credit_card_type==1)

		{$credit_card_type='VI';}

		if($credit_card_type==2)

		{$credit_card_type='MC';}

		if($credit_card_type==3)

		{$credit_card_type='AX';}

		

		/*$ccaddress=$row->ccaddress;

		$cccountry=$row->cccountry;

		$ccpostalcode=$row->ccpostalcode;*/

		

		

		/*echo "CourseId".$row->course_id;

		echo "PlayDate".$dates."T00:00:00";

		echo "PlayTime".$times;

		echo "NumPlayers".$players;

		echo "PpPrice".$price;

		echo "Curr".$cur;

		echo "PpTxnFee".$ppTxnFee;

		echo "PpCharge".$ppCharge;

		echo "ChrgCurr".$chrgCurr;

		

		echo "PpNetRt".$ppNetRt;

		echo "TotPrice".$TotPrice;

		echo "TotCharge".$TotCharge;

		echo "TotTxnFee".$TotTxnFee;

		echo  "TotNetRt".$TotNetRt;

		

		echo  "TotNetRt".$TotNetRt;

		echo  "TotNetRt".$TotNetRt;

		echo  "TotNetRt".$TotNetRt;

		echo  "TotNetRt".$TotNetRt;

		exit;*/

		

		//$TotNonRef=$this->config->item('sur_charge')*$players;

		//$sur_charge=$this->config->item('sur_charge');

		

		$client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");

		$response = $client->BookGolf(array("Hdr"=>array("ResellerId"=>"WPA",

															"PartnerId"=>"",

															"SourceCd"=>"A",

															"Lang"=>"en",

															"UserIp"=>"66.147.244.227",

															"UserSessionId"=>"",

															"AccessKey"=>"",

															"Agent"=>"",

															"gsSource"=>"",

															"gsDebug"=>true

															),

											"Req"=>array("BookGolfItems"=>

													array("BookGolfItem"=>

													array("CourseId"=>$row->course_id,

													     "PlayDate"=>$dates."T00:00:00",

															"PlayTime"=>$times,

															"NumPlayers"=>$players,

															"AltRateType"=>"",

															"PromoCode"=>"",

															"PpPrice"=>$price,

															"Curr"=>$cur,

															"PpTxnFee"=>$ppTxnFee,

															"PpCharge"=>$ppCharge,

															"ChrgCurr"=>$chrgCurr,

															"PpNonRef"=>$ppNonRef,

															"PpNetRt"=>$ppNetRt,

															"TotPrice"=>$TotPrice,

															"TotTxnFee"=>$TotTxnFee,

															"TotCharge"=>$TotCharge,

															"TotNonRef"=>$TotNonRef,

															"TotNetRt"=>$TotNetRt,

															"Flags"=>$flags,

															"PackageId"=>"",

															"BookNotes"=>"",

															"IgnorePricing"=>true,

													"Players"=>array("Player"=>

														array("ProfileId"=>"",

															"FirstName"=>$user_fname,

															"LastName"=>$user_lname,

															"Email"=>$email,

															"MemberNo"=>"",

															"RewardsPgmId"=>"",

															"RewardsId"=>""

															)),

													"Payments"=>array("Payment"=>

													array("PayType"=>"CC",

															"CcType"=>$credit_card_type,

															"PayNumber"=>$credit_card_no,

															"CcExpMo"=>$expire_month,

															"CcExpYr"=>$expire_year,

															"CcName"=>$credit_card_name,

															"CcAddress1"=>'',

															"CcCountry"=>'',

															"CcPostalCode"=>'',

															"PayAmount"=>$TotCharge,

															"PayCurr"=>"USD"))

															)))));

			if($response->BookGolfResult->RetCd==0)

			{

				$booking=$response->BookGolfResult->GolfBooks->GolfBook;

				$confirmationNo=$booking->confirmationNo;

				$bookingId=$booking->bookingId;

				$this->common_model->update_array(array('gama_booking_id'=>$row->gama_booking_id),'gama_booking_detail',array('status'=>1,'confirmationNo'=>$confirmationNo,'bookingId'=>$bookingId));

				$this->common_model->delete_where(array('gama_add_cart_id'=>$gama_add_cart_id),'gama_add_cart');

				

				$playDate=$booking->playDate;

				$playDate=explode('T',$playDate);

				$playDate=$playDate[0];

				

				$playTime=$booking->playTime;

			    $am_pm='';

				if($playTime<1299)

				$am_pm='AM';

				else

				$am_pm='PM';

				

				$strlen=strlen($playTime);

				if($strlen==3)

				{

				  $explode=str_split($playTime);

				  $playTime=$explode[0].':'.$explode[1].$explode[2].$am_pm;

				}

				if($strlen==4)

				{

				  $explode=str_split($playTime);

				  $playTime=$explode[0].$explode[1].':'.$explode[2].$explode[3].$am_pm;

				}

				

				$numPlayers=$booking->numPlayers;

				$CxlPolicy=$booking->CxlPolicy->desc;

				$courseName=$booking->courseName;

				

				$all_data_save[$i]['courseName']=$courseName;

				$all_data_save[$i]['playDate']=$playDate;

				$all_data_save[$i]['playTime']=$playTime;

				$all_data_save[$i]['confirmationNo']=$confirmationNo;

				$all_data_save[$i]['bookingId']=$bookingId;

				$all_data_save[$i]['numPlayers']=$numPlayers;

				$all_data_save[$i]['CxlPolicy']=$CxlPolicy;

				$all_data_save[$i]['status']=1;

				

				$this->session->set_userdata('status','success');

				/*$this->session->set_userdata('confirmationNo',$confirmationNo);

				$this->session->set_userdata('bookingId',$bookingId);

				$this->session->set_userdata('my_msg',"Your Booking for Date $playDate[0] and Time $playTime is Successfully Conformed.");

				$this->session->set_userdata('status',1); */

				

				//successfull golfcourse entry in player_schedule for calendar entry/////

				if($this->db_session->userdata('user_object')!='')

				{

					$unserialize=unserialize($this->db_session->userdata('user_object'));

					$user_id=$unserialize->getuserid();

					$field['players_id']=$user_id;

					$field['created_by']=$user_id;

					//$row->booking_date

					

					//$start_date=date('Y-m-d',$row->dates);

					//$start_date=$start_date.' '.$times.':00';

					

					$find=array("AM","PM");

					$replace=array("","");

					$times=str_replace($find,$replace,$row->times);

					$times=explode(':',$times);

					$sec1=$times[0]*60*60;

					$sec2=$times[1]*60;

					$sec=$sec1+$sec2;

					$start_date=$row->dates+$sec;

					$field['start_date']=date('Y-m-d H:i:s',$start_date);

					

					//$end_date=;

					/*$times=explode(':',$times);

					if($times[0]+1==13)

					{

					  $first=1;

					}

					else

					{

					  $first=$times[0];

					}

					$second=$times[1];*/

					//$end_date=$end_date.' '.$first.':'.$second.':00';

					//$end_date=date('Y-m-d',$row->dates);

					

					$end_date=$row->dates+$sec;

					$end_date=strtotime('+1 hour',$end_date);

					$field['end_date']=date('Y-m-d H:i:s',$end_date);

					

					$field['isalldayevent']=0;

					$field['name']='Golfcourse Booking';

					$field['description']='Golfcourse Booking. ';

					$field['schedule_type']='1';

					$field['user_type']='1';

					$return = $this->schedule_model->add_schedule($field);

					$field='';

					$this->common_model->update_array(array('gama_booking_id'=>$row->gama_booking_id),'gama_booking_detail',array('player_schedule_id'=>$return));

				}

				////end successfull golfcourse entry in player_schedule for calendar entry//////

			}

			else

			{

				$booking=$response->BookGolfResult->GolfBooks->GolfBook;

				$courseName=$booking->courseName;

				$RetMsg=$response->BookGolfResult->RetMsg;

				$all_data_save[$i]['error']=$RetMsg;

				$all_data_save[$i]['courseName']=$courseName;

				$all_data_save[$i]['status']=0;

				

				$this->common_model->delete_where(array('gama_booking_id'=>$row->gama_booking_id),'gama_booking_detail');

				/*$this->session->set_userdata('my_msg',"Your Booking is not conformed.Because $RetMsg");

				$this->session->set_userdata('status',0);*/

			}

			

				//for paypal

				$city=$row->city;

				$country=$row->country;

				$state=$row->state;

				$address=$row->address;

				$postal_code=$row->postal_code;

				

				//this check will be apply in future that if success return than count this player.

				$count_players=$count_players+$players;

			

			}//end foreach loop

			

			$this->session->set_userdata('all_data_save',$all_data_save);

			redirect('reserve_golfcourse/success_order');

			$country=$this->common_model->select_where('iso_code3','country',array('id'=>$country));

			$country=$country->row();

			$iso_code3=$country->iso_code3;

			$country_code=urlencode($iso_code3);

			$array['billing_city']=urlencode($city);

			$array['billing_address1']=urlencode($address);

			$array['billing_postcode']=urlencode($postal_code);

			$b_state=urlencode($state);

			$b_fname=urlencode($user_fname);

			$b_lname=urlencode($user_lname);

			$helo=$this->config->item('sur_charge')*$count_players;

			$order_amount_total=urlencode($helo);	

			$creditcardtype = urlencode($credit_card_type);

			$payment_type  =  urlencode('sale');

			$creditcardnumber  = urlencode($credit_card_no);

			$paddatemonth= urlencode($credit_card_expiry_month);

			$expdateyear = urlencode($credit_card_expiry_year);

			$cvv2number = urlencode($ccsecret_no);

			$currencyid = urlencode('USD');   // or other currency ('GBP', 'EUR', 'JPY', 'CAD', 'AUD')

		

		$nvpStr = "&PAYMENTACTION=$payment_type&AMT=$order_amount_total&CREDITCARDTYPE=$creditcardtype&ACCT=$creditcardnumber&EXPDATE=$paddatemonth$expdateyear&CVV2=$cvv2number&FIRSTNAME=$b_fname&LASTNAME=$b_lname"."&STREET=".$array['billing_address1']."&CITY=".$array['billing_city']."&STATE=$b_state&ZIP=".$array['billing_postcode']."&COUNTRYCODE=$country_code&CURRENCYCODE=$currencyid";

		

		$httpParsedResponseAr = $this->PPHttpPost('DoDirectPayment', $nvpStr);

		

	    if("Success" == $httpParsedResponseAr["ACK"] || "SuccessWithWarning" == $httpParsedResponseAr["ACK"])

		 {

			//if("Success" == "Success") 

			//{

				echo 'you succeeded....';

				exit;

			//}

		}

		else

		{

		

		echo 'NOt';

		}

				/*print_r($save);exit;											

	        $results['my_title']='Success';

			$data['contents']=$this->load->view('success_page',$results,true);

			$this->load->view('template',$data);*/

	}

	function success_page()

	{

		$data['contents']=$this->load->view('success','',true);

		$this->load->view('template',$data);

	}

	

	

	

	

	

	

	function PPHttpPost($methodName_, $nvpStr_)

    {

		

		$environment = 'beta-sandbox';// or 'beta-sandbox' or 'live'

		// Set up your API credentials, PayPal end point, and API version.

		$API_UserName = urlencode($this->config->item('api_username'));

		$API_Password = urlencode($this->config->item('api_password'));

		$API_Signature = urlencode($this->config->item('api_signature'));

		$API_Endpoint = "https://api-3t.paypal.com/nvp";

		if("sandbox" === $environment || "beta-sandbox" === $environment) 

		{

		    $API_Endpoint = "https://api-3t.sandbox.paypal.com/nvp";

		}

		$version = urlencode('51.0');

		// Set the curl parameters.

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $API_Endpoint);

		curl_setopt($ch, CURLOPT_VERBOSE, 1);

		// Turn off the server and peer verification (TrustManager Concept).

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		curl_setopt($ch, CURLOPT_POST, 1);

		// Set the API operation, version, and API signature in the request.

		$nvpreq = "METHOD=$methodName_&VERSION=$version&PWD=$API_Password&USER=$API_UserName&SIGNATURE=$API_Signature$nvpStr_";

			// Set the request as a POST FIELD for curl.

		curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);

		// Get response from the server.

		$httpResponse = curl_exec($ch);

		if(!$httpResponse)

		{

		   exit("$methodName_ failed: ".curl_error($ch).'('.curl_errno($ch).')');

		}

		// Extract the response details.

		

		$httpResponseAr = explode("&", $httpResponse);

		$httpParsedResponseAr = array();

		foreach ($httpResponseAr as $i => $value) 

		{

			$tmpAr = explode("=", $value);

			if(sizeof($tmpAr) > 1) 

			{

			   $httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];

		    }

		}

		if((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)) 

		{

		    exit("Invalid HTTP Response for POST request($nvpreq) to $API_Endpoint.");

		}

		return $httpParsedResponseAr;

       }





	

	

	

	

	

	

	

	

	

	

	//>>>>>>>>>

	//>>>>>>>>>

	//>>>>>>>>>

	

	public function registration()

    {

		//$this->load->helper(array('form','url'));

		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');

        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');

        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');

        $this->form_validation->set_rules('country_id', 'Country', 'trim|required');
		
		$this->form_validation->set_rules('save', 'Save', 'trim|required');

        //$this->form_validation->set_rules('dob', 'Birthday', 'trim|required');

       /* $this->form_validation->set_rules('cp_password', 'Confirm Password', 'trim|required|matches[password]|');*/

        if($this->form_validation->run() == FALSE)

        {

			$this->session->set_userdata('msg_check','not_login');

			$this->session->set_userdata('validation_errors',validation_errors());

			$save=$this->input->post('save');

			$user_fname=$this->input->post('first_name');

			$user_lname=$this->input->post('last_name');

			$email=$this->input->post('email');

			$password=$this->input->post('password');

			$gender=$this->input->post('gender');

			$days=$this->input->post('days');

			$months=$this->input->post('months');

			$years=$this->input->post('years');

			$country_id=$this->input->post('country_id');

			$this->session->set_userdata('first_name',$user_fname);

			$this->session->set_userdata('last_name',$user_lname);

			$this->session->set_userdata('email',$email);

			$this->session->set_userdata('password',$password);

			$this->session->set_userdata('gender',$gender);

			$this->session->set_userdata('days',$days);

			$this->session->set_userdata('months',$months);

			$this->session->set_userdata('years',$years);

			$this->session->set_userdata('country',$country_id);

			

			$url=@$_SERVER['HTTP_REFERER'];

			redirect($url);

	   }

	   else

	    {

		   if($this->users_model->validate_player_email($this->input->post())==0)

		   {

				$_POST['player_types_id']=2;

				$days=$this->input->post('days');

				$months=$this->input->post('months');

				$years=$this->input->post('years');

				$dob=$years.'-'.$months.'-'.$days;

				//$post=$this->input->post();

				//print_r($post);

				//exit;

				$_POST['dob']=$dob;

				//$post=array_push($post,array('dob'=>$dob,'date_added'=>time(),'player_types_id'=>2));

				

				//$db_fields['date_added']=time();

				$player_id=$this->my_db_lib->save_record($this->input->post(),'players');

				

				/*$player_details=$this->users_model->players_details($player_id);

				$this->load->library('email');

				$this->email->mailtype="html";

				$data['email']=$player_details->email;

				$data['password']=$player_details->password;

				$msg=$this->load->view('email/player_register',$data,TRUE);

				$from='wesportonline@gmail.com';

				$subject='Player Register';

				$to=$player_details->email;

				$this->email->from($from,'WeSport');

				$this->email->to($to);

				$this->email->subject($subject);

				$this->email->message($msg);

				$this->email->send();

				$this->db_session->set_flashdata('msg', '<div class="success">Successfully registered and send the details to your email address</div>');*/

				$this->session->set_userdata('msg_check','not_login');

				$this->session->set_userdata('user_front_msg','Your Registration is Completed Successfully.');

				$url=@$_SERVER['HTTP_REFERER'];

				redirect($url);

				

			}

			else

			{

				$user_fname=$this->input->post('first_name');

				$user_lname=$this->input->post('last_name');

				$email=$this->input->post('email');

				$password=$this->input->post('password');

				$gender=$this->input->post('gender');

				$days=$this->input->post('days');

				$months=$this->input->post('months');

				$years=$this->input->post('years');

				$country_id=$this->input->post('country_id');

				$this->session->set_userdata('first_name',$user_fname);

				$this->session->set_userdata('last_name',$user_lname);

				$this->session->set_userdata('email',$email);

				$this->session->set_userdata('password',$password);

				$this->session->set_userdata('gender',$gender);

				$this->session->set_userdata('days',$days);

				$this->session->set_userdata('months',$months);

				$this->session->set_userdata('years',$years);

				$this->session->set_userdata('country',$country_id);

				

				$this->session->set_userdata('msg_check','not_login');

				$this->session->set_userdata('user_front_msg','This email is used already.');

				$url=@$_SERVER['HTTP_REFERER'];

				redirect($url);

			}

	   }	

     }

	

	

	

	

	

	

	   /* function registration()

		{

			$this->form_validation->set_rules('user_fname','First Name','trim|required');

			$this->form_validation->set_rules('user_lname','Last Name','trim|required');

			$this->form_validation->set_rules('pasword','Password','trim|required');

			$this->form_validation->set_rules('email','Email','trim|required|valid_email');

			$this->form_validation->set_rules('country','Country','trim|required');

			if($this->form_validation->run()==FALSE)

			{

				$this->session->set_userdata('msg_check','not_login');

				$this->session->set_userdata('validation_errors',validation_errors());

				

				$user_fname=$this->input->post('user_fname');

				$user_lname=$this->input->post('user_lname');

				$email=$this->input->post('email');

				$pasword=$this->input->post('pasword');

				$gender=$this->input->post('gender');

				$days=$this->input->post('days');

				$months=$this->input->post('months');

				$years=$this->input->post('years');

				$set_country=$this->input->post('country');

				$this->session->set_userdata('user_fname',$user_fname);

				$this->session->set_userdata('user_lname',$user_lname);

				$this->session->set_userdata('email',$email);

				$this->session->set_userdata('pasword',$pasword);

				$this->session->set_userdata('gender',$gender);

				$this->session->set_userdata('days',$days);

				$this->session->set_userdata('months',$months);

				$this->session->set_userdata('years',$years);

				$this->session->set_userdata('set_country',$set_country);

				

				$url=@$_SERVER['HTTP_REFERER'];

				redirect($url);

			}

			else

			{

				$registration_type=$this->input->post('registration_type');

				

				$db_fields['user_fname']=$this->input->post('user_fname');

				$db_fields['user_lname']=$this->input->post('user_lname');

				$db_fields['user_name']=$this->input->post('user_fname').' '.$this->input->post('user_lname');

				$db_fields['pasword']=$this->input->post('pasword');

				$db_fields['gender']=$this->input->post('gender');

				$db_fields['email']=$this->input->post('email');

				

				$days=$this->input->post('days');

				$months=$this->input->post('months');

				$years=$this->input->post('years');

				$db_fields['dob']=$days.'-'.$months.'-'.$years;

				

				$db_fields['country']=$this->input->post('country');

				$db_fields['dates']=time();

				 

				$this->common_model->insert_array('gama_user',$db_fields);

				$this->session->set_userdata('msg_check','not_login');

				$this->session->set_userdata('user_front_msg','Your Registration is Completed Successfully.');

				

				$url=@$_SERVER['HTTP_REFERER'];

				redirect($url);

			}

		}*/

		

		

	

		

		

/*function curPageURL() {

$pageURL = 'http';

if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}

$pageURL .= "://";

if ($_SERVER["SERVER_PORT"] != "80") {

$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];

} else {

$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];

}

return $pageURL;

}*/

		

		

		

		

		

	

	

	

	    function login()

		{

		   $this->form_validation->set_rules('psw','Password','trim|required|callback_user_check');

		   $this->form_validation->set_rules('uname','Email','trim|required|valid_email');

		   if($this->form_validation->run()==false)

		   {

				/*$this->session->set_userdata('msg_check','login');

				$data['contents']=$this->load->view('teetime_search','',true);

				$data['my_title']='Golf course';

				$this->load->view('template',$data);*/

				

				$login_type=$this->input->post('login_type');

				if($login_type=='TRUE')

				$this->session->set_userdata('msg_check','process_login');

				else

				$this->session->set_userdata('msg_check','login');

				

				$this->session->set_userdata('validation_errors',validation_errors());

				$url=@$_SERVER['HTTP_REFERER'];

				redirect($url);

		   }

		   else

		   {

				$login_type=$this->input->post('login_type');

				if($login_type=='TRUE')

				{

					$url=@$_SERVER['HTTP_REFERER'];

					redirect($url);

				}

				

				if($login_type=='FALSE')

				{

					$this->session->set_userdata('msg_check','login');

					$this->session->set_userdata('user_front_msg','You login Successfully.');

					

					$url=@$_SERVER['HTTP_REFERER'];

					redirect($url);

					

					/*$data['contents']=$this->load->view('teetime_search','',true);

					$data['my_title']='Golf course';

					$this->load->view('template',$data);*/

				}

		   }

		}

		

		

		

		

		

		

		

		

		function user_check()

		{

			(object) $login='';

			$login->username=$this->input->post('uname');

			$login->password=$this->input->post('psw');

			$data_VloginObject=$this->login_model->SetIvieLoginParameters($login);

			$LoginObject=$this->login_model->login_auth($data_VloginObject);

			

			if($LoginObject)

			{

				 $LoginSessionObject=$this->login_model->setLoginSession($LoginObject);

				 $this->db_session->set_userdata('user_object',serialize($LoginSessionObject));

				$user_object=$this->db_session->userdata('user_object');

				

				 return TRUE;

			}

			else

			{

				$this->form_validation->set_message('user_check','Your password or email is wrong');

				return FALSE;

			}

		}

	

	

	

	  

	

	

	    function logout($para)

		{

			$this->db_session->sess_destroy();

			if($para==1)

			{

			   redirect('login/logout'); 

			}

			$url=@$_SERVER['HTTP_REFERER'];

		    redirect($url);

		}

		

		

		

		

		

		function my_booking_history($page_start_from=0)

		{

			/* $unserialize=unserialize($this->db_session->userdata('user_object'));

			$user_id=$unserialize->getuserid();

			

			$results['result']=$this->common_model->select_where('*','gama_booking_detail',array('user_id'=>$user_id,'status'=>1));

			$data['contents']=$this->load->view('my_booking_history_listing',$results,true);

			$this->load->view('template', $data);*/

			

			/*$id=$this->userId;

			$data['u_details']=$this->users_model->players_details($id);

			$sdata=$this->sports_model->listofmysports($id,0,3,'');

			$fdata=$this->users_model->listofmyplayers($id,0,3,'');

			$tdata=$this->teams_model->listofmyteams($id,$this->userId,0,3,'');

			$isfrd=$this->users_model->isfriend($id,$this->userId);

			$data['e_details']=$this->users_model->education_details($this->userId);

			$data['a_details']=$this->users_model->alert_details($this->userId);

			$data['i_details']=$this->users_model->interest_details($this->userId);

			$data['w_details']=$this->users_model->work_details($this->userId);

			$data['f_count']=$this->users_model->players_frd_count($this->userId);

			$data['s_count']=$this->users_model->players_sports_count($this->userId);

			$data['t_count']=$this->users_model->players_teams_count($this->userId);

			$data['is_frd']=$this->users_model->players_is_friend($this->userId,$this->userId);

			$data['u_sprts']=$this->users_model->userschedule_spports($this->userId);

			$data['s_details']=$sdata['records'];

			$data['t_details']=$tdata['records'];

			$data['f_details']=$fdata['records'];

			$data['s_cnt']=$sdata['total'];

			$data['t_cnt']=$tdata['total'];

			$data['f_cnt']=$fdata['total'];

			$data['isfrd']=$isfrd;

			$data['id']=$id;*/

			

			$record_per_page=20;

			

			$unserialize=unserialize($this->db_session->userdata('user_object'));

			$user_id=$unserialize->getuserid();

			

			

			

			$data['result']=$this->common_model->select_where_limit_order('*','gama_booking_detail',array('user_id'=>$user_id,'status'=>1,'confirmationNo !='=>0,'bookingId !='=>0),$page_start_from,$record_per_page,'booking_date','desc');

			

			$mypaing['total_rows']	=$this->common_model->select_where_num('gama_booking_id','gama_booking_detail',array('user_id'=>$user_id,'status'=>1,'confirmationNo !='=>0,'bookingId !='=>0));

			

			$mypaing['base_url'] 		= base_url()."reserve_golfcourse/my_booking_history";

			$mypaing['per_page']		= $record_per_page;

			$mypaing['uri_segment']		= 3;

			$this->pagination->initialize($mypaing);

			$data['paginglink']		= $this->pagination->create_links();

			

			$data['active_tab'] = '0';

			$data['links_js_css']='players/links_js_css';

			$data['left_nav'] = 'common/left_nav';

			//$data['right_nav'] = 'profile/profile_relations';

			$data['long_right'] = true;

			$data['content_page'] =  'my_booking_history_listing';

			$data['links_js_css']='players/links_js_css';

			$this->load->view('common/base_template', $data);

		}

		

		

		

		

		

	function booking_cancel($course_id,$dates,$conformation_no,$booking_id,$player_schedule_id)

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

		$this->common_model->update_array(array('confirmationNo'=>$conformation_no,'bookingId'=>$booking_id),'gama_booking_detail',array('action_status'=>1));

		//$this->common_model->delete_where(array('confirmationNo'=>$conformation_no,'bookingId'=>$booking_id),'gama_booking_detail');

		$this->common_model->delete_where(array('id'=>$player_schedule_id),'player_schedule');

		$RetMsg='Your Cancellation is Successfully Completed.';

		$this->session->set_userdata('my_personal_success',$RetMsg);

		

		$this->load->library('email');

		

		$unserialize=unserialize($this->db_session->userdata('user_object'));

		$user_id=$unserialize->getuserid();

		$user_info=$this->common_model->select_where('*','players',array('id'=>$user_id));

		$user_info=$user_info->row();

		$first_name=$user_info->first_name;

		$last_name=$user_info->last_name;

		$user_email=$user_info->email;

		

		$admin_info=$this->common_model->select_where('*','db_admin',array('admin_id'=>1));

		$admin_info=$admin_info->row();

		$admin_name =$admin_info->admin_name;

		$admin_email =$admin_info->admin_email ;

		

		$this->email->from($user_email, $first_name);

		$this->email->to($admin_email);

		$this->email->cc('');

		$this->email->bcc('');

		$this->email->subject('Booking Cancelation');

		$msg='Hi '.$admin_name .'<br>'.$first_name.' '.$last_name.'Cancel his booking.';

		$this->email->message($msg);

		$this->email->send();

		

		

	  }else

	  {

	     $RetMsg=$response->CancelGolfResult->RetMsg;

		 $this->session->set_userdata('my_personal_error',$RetMsg);

	  }

	   //print_r($response);

	  // exit;

	   redirect('reserve_golfcourse/my_booking_history');

	}


	function cash_back($course_id,$dates,$conformation_no,$booking_id,$player_schedule_id)

	{

	   

	  $current_date=strtotime("+1 day",time());

	  

	 /* if($current_date <= $dates)

	  {*/

	    $cancellationNo=$response->CancelGolfResult->cancellationNo;

		//$this->common_model->delete_where(array('confirmationNo'=>$conformation_no,'bookingId'=>$booking_id),'gama_booking_detail');

		$this->common_model->update_array(array('confirmationNo'=>$conformation_no,'bookingId'=>$booking_id),'gama_booking_detail',array('action_status'=>2));

		$RetMsg='Your Cash Back Request is Successfully Completed.';

		$this->session->set_userdata('my_personal_success',$RetMsg);

		

		$this->load->library('email');

	

		$unserialize=unserialize($this->db_session->userdata('user_object'));

		$user_id=$unserialize->getuserid();

		$user_info=$this->common_model->select_where('*','players',array('id'=>$user_id));

		$user_info=$user_info->row();

		$first_name=$user_info->first_name;

		$last_name=$user_info->last_name;

		$user_email=$user_info->email;

		

		$admin_info=$this->common_model->select_where('*','db_admin',array('admin_id'=>1));

		$admin_info=$admin_info->row();

		$admin_name =$admin_info->admin_name;

		$admin_email =$admin_info->admin_email ;

		

		

		

		$this->email->from($user_email, $first_name);

		$this->email->to($admin_email);

		$this->email->cc('');

		$this->email->bcc('');

		$this->email->subject('Request for Cash Back');

		$msg='Hi '.$admin_name .'<br>'.$first_name.' '.$last_name.'want to cash back his money.';

		$this->email->message($msg);

		$this->email->send();

		

	 /* }else

	  {

	     $RetMsg='The deadline to Cash Back online has passed.';

		 $this->session->set_userdata('my_personal_error',$RetMsg);

	  }*/

	  

	  

	   //print_r($response);

	  // exit;

	  redirect('reserve_golfcourse/my_booking_history');

	}
}?>