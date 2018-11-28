<!DOCTYPE html>
<html>
<style>
  #image_upload_button
  {
    right:20;
    top:50;
  }
</style>
<head>
	 <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"
    />
    <!-- Import materialize.css -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"
    />

     <link
      rel="stylesheet"
      href="styles/main.css"
    />

  
 <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
      integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
      crossorigin="anonymous"
    />

     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Forgot Password</title>
</head>
<body>
 <div class="navbar-fixed">
      <nav class="teal">
        <div class="container">
          <div class="nav-wrapper">
       <a href="#" class="brand-logo">HieFive</a><a href="#" class="sidenav-trigger" data-target="mobile-nav">
              <i class="material-icons">menu</i>
            </a>
            <ul class="right hide-on-med-and-down">
              <li><a href="index.php">Home</a></li>
              <li>
                <a href="index.php#login">
                  <button
                    class="btn black white-text waves-effect waves-black scrollspy"
                  >
                    Login
                  </button>
                </a>
              </li>
              <li>
                <a href="index.php#signup">
                  <button
                    class="btn black white-text waves-effect waves-black scrollspy"
                  >
                    Signup
                  </button>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>


	<div class='row'>

   <div class='col s12 m8 offset-m2'>
    <h4><center><span class='teal-text'>Forgot</span><span class='black-text'>Password</span></center></h4>
  <form method='post'>
    <br>
    <div class='card grey lighten-5'>
    <div class='row'><div class='col s12 m8 offset-m1'>  
  <br>  <br>  
<input type="Email" name="email" placeholder='Enter your email' required='required'>
<br>  <hr>  
<pre class='text'>Enter your Best Friend's Name below </pre>
<div class='input-group'>
<input type="text" name="recovery_account" required>
 </div>
 <br> 
<a href="index.php#signup" style="float:right;color:teal;" title='Signin'>Back to Sign in</a>
<br> 
<center><button id='signup' name='submit' class='btn'>Submit</button></center>
<br>  <br>  
 </form>
   </div>
</div>
</div>
</div>
</div>

</body>   
</html>
<?php
session_start();
include('includes/connection.php');
if(isset($_POST['submit']))
{
$email=mysqli_real_escape_string($con,$_POST['email']);
$recovery_account=mysqli_real_escape_string($con,$_POST['recovery_account']);
$select_user="select * from users where `user_email`='$email' AND `recovery_account`='$recovery_account' AND `status`='verified'";
$query=mysqli_query($con,$select_user);
$check_user=mysqli_num_rows($query);
if($check_user==1)
{
  $_SESSION['user_email']=$email;
  echo"<script>window.open('change_password.php','_self')</script>";
}
else
{
  echo"<script>alert('Incorrect details.Try again.')</script>";
}
}
?>