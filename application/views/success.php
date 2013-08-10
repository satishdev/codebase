<?

if($this->session->userdata('status')==1)
{

echo $this->session->userdata('my_msg');
echo "<br>Your Confornation Number is ".$this->session->userdata('confirmationNo');
echo "<br>Your Booking Id is ".$this->session->userdata('bookingId');

$this->session->set_userdata('confirmationNo','');
$this->session->set_userdata('bookingId','');
$this->session->set_userdata('my_msg','');
$this->session->set_userdata('status','');

}
else
{
echo $this->session->userdata('my_msg');
$this->session->set_userdata('my_msg','');
$this->session->set_userdata('status','');

}


?>