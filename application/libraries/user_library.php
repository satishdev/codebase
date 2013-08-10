<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_library {
		  private   $username;
		  private   $firstname;
		  private   $lastname;
		  private   $typename;
		  private   $userid;
		  private   $email;
		  private   $userType;
		  private   $usertypeid;
		  private   $gender;
		  private   $clubid;

		   function setusertype($val)
		   {
			$this->userType=$val;
		   }

		   function getusertype()
		   {
			return $this->userType;
		   }

		   function settypename($val)
		   {
			$this->typename=$val;
		   }

		   function gettypename()
		   {
			return $this->typename;
		   }


		  function setFirstname($val)
		   {
			$this->firstname=$val;
		   }

		   function getFirstname()
		   {
			return  htmlspecialchars(stripslashes($this->firstname));
		   }

		   function setLastname($val)
		   {
			$this->lastname=$val;
		   }

		   function getLastname()
		   {
			return  htmlspecialchars(stripslashes($this->lastname));
		   }

	       function setUsername($val)
		   {
			$this->username=$val;
		   }

		   function getUsername()
		   {
			return  htmlspecialchars(stripslashes($this->username));
		   }


		   function setUserid($val)
		   {
			$this->userid=$val;
		   }

		   function getUserid()
		   {
			return $this->userid;
		   }


		    function setEmail($val)
		   {
			$this->email=$val;
		   }

		   function getEmail()
		   {
			return $this->email;
		   }

			public function getUsertypeid() {
				return $this->usertypeid;
			}

		  public function setUsertypeid($usertypeid) {
			  $this->usertypeid = $usertypeid;
		  }

         public function getUsergender() {
				return $this->gender;
			}

		  public function setUsergender($gender) {
			  $this->gender = $gender;
		  }
        public function getClubid() {
				return $this->clubid;
			}
	   public function setClubid($clubid) {
			  $this->clubid = $clubid;
		  }
	}
?>
