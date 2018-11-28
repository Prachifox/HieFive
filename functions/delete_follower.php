<?php 
$con=mysqli_connect('localhost','root','','socialnetwork')or die('Connection was not established');
$user=$_SESSION['user_email'];
$get_user="select * from users where `user_email`='$user'";
$run_user=mysqli_query($con,$get_user);
$row=mysqli_fetch_array($run_user);
$user_id=$row['user_id'];
if(isset($_GET['u_id']))
{
	$u_id=$_GET['u_id'];
}
	$delete_follow="delete from follow where (follower='$u_id' AND following='$user_id')";
	 $run_delete=mysqli_query($con,$delete_follow);
if($run_delete)
{
	echo"<script>alert('Follower successfully removed')</script>";
/*    echo"<script>window.open('../home.php','_self')</script>";
}*/
}
 ?>
