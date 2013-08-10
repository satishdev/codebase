<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class Login_library
{
    private $username;
    private $password;
    private $remember_me;

    function getUsername()
    {
        return $this->username;
    }

    function setUsername($val)
    {
        $this->username = stripslashes($val);
    }

    function getPassword()
    {
        return $this->password;
    }

    function setPassword($val)
    {
        $this->password = stripslashes($val);
    }

    function setRemember_me($val)
    {
        $this->remember_me = stripslashes($val);
    }

    function getRemember_me()
    {
        return $this->remember_me;
    }
}

?>
