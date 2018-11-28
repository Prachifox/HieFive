<?php 
$con=mysqli_connect('localhost','root','','socialnetwork')or die('Connection was not established');
if(isset($_GET['com_id']))
{
	$post_id=$_GET['post_id'];
$com_id=$_GET['com_id'];	
$delete_com="delete from comments where com_id=$com_id";
	 $run_delete=mysqli_query($con,$delete_com);
if($run_delete)
{
	echo"<script>alert('Comment successfully deleted')</script>";
   echo"<script>window.open('../single.php?post_id=$post_id','_self')</script>";
}
}
?>