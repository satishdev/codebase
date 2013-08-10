<table>
<tr>

<td>
User Name
</td>
<td>
email
</td>
<td>
Course Name
</td>
<td>
Price
</td>
<td>
Date
</td>
<td>
Time
</td>
<td>
Option
</td>

<? 
if($result->num_rows()>1)
{
	$conformation_no='';
	$booking_id='';
	foreach($result->result() as $row)
	{
		echo '<tr><td>';
		echo $row->user_fname.' '.$row->user_lname;
		echo '</td><td>';
		echo $row->email;
		echo '</td><td>';
		echo $row->course_name;
		echo '</td><td>';
		echo $row->price;
		echo '</td><td>';
		echo date('d-m-Y',$row->dates);
		echo '</td><td>';
		echo $row->times;
		echo '</td><td>';
		echo '<a href="'.base_url().'admin/user_golf_booking/booking_detail/'.$row->gama_booking_id.'/'.$page_start_from.'">Detail</a> | 
		<a href="'.base_url().'admin/user_golf_booking/booking_cancel/'.$row->course_id.'/'.$row->dates.'/'.$conformation_no.'/'.$booking_id.'">Booking Cancel</a>';
		echo '</td><td></tr>';
	}
}
else
{
echo '<tr><td colspan="7">';
echo 'No Record Found.';
echo '</td></tr>';

}
?>

</table>
<? if($result->num_rows()>1)
{
echo $paginglink;

}?>