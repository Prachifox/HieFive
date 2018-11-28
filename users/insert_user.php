<?php
include('includes/connection.php');
if(isset($_POST['sign_up']))
{
$f_name=mysqli_real_escape_string($con,$_POST['f_name']);   //$con connection variable
$l_name=mysqli_real_escape_string($con,$_POST['l_name']);
$pass=mysqli_real_escape_string($con,$_POST['u_pass']);
$email=mysqli_real_escape_string($con,$_POST['u_email']);
$country=mysqli_real_escape_string($con,$_POST['u_country']);
$gender=mysqli_real_escape_string($con,$_POST['u_gender']);
$birthday=mysqli_real_escape_string($con,$_POST['u_birthday']);
$status='verified';
$posts='no';
$newgid=sprintf('%05d',rand(0,99999));
$username=strtolower($f_name . "_" . $l_name . "_" .$newgid);
if(strlen($pass)<8){
	echo "<script>alert('Password should be minimum 8 characters')</script>";
	echo"<script>window.open('index.php','_self')</script>";
	exit();
}
$check_email="select * from users where `user_email`='$email'";
$run_email=mysqli_query($con,$check_email);
$check=mysqli_num_rows($run_email);

if($check>=1)
{
	echo"<script>alert('Email already exists.Try another.')</script>";
	echo"<script>window.open('index.php','_self')</script>";
	exit();
}

if($gender=='Male')
{
$user_image="person2.jpg";
}
else if($gender=='Female')
{
$user_image="person3.jpg";
}
else
{
$user_image="users.png";
}

$insert="insert into `users`(`user_name`,`describe_user`,`relationship`,`user_pass`,`user_email`,`user_country`,`user_gender`,`user_birthday`,`user_image`,`user_cover`,`user_reg_date`,`status`,`posts`,`f_name`,`l_name`,`recovery_account`) values
('$username','HieFive Guyzz','.......','$pass','$email','$country','$gender','$birthday','$user_image','default_cover.jpg',NOW(),'$status','$posts','$f_name','$l_name','youbetterdontmesswithme7')";
$query=mysqli_query($con,$insert);
if($query)
{

	echo"<script>alert('Congratulations $f_name your account has been created successfully')</script>";	
}
else
{

	echo"<script>alert('Registration failed .Try again.')</script>";
}
}
?>