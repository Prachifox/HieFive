<!DOCTYPE html>
<?php
session_start();
include('includes/connection.php');
?>
<?php 
if(!isset($_SESSION['user_email']))
{
  header('location:index.php');
}
else
{

 ?>
<html>
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
    <br>
    <h4><center><span class='teal-text'>Change</span><span class='black-text'>Password</span></center></h4>
  <form method='post'>
<table> 
<tr ><td align='right'>New Password:</td><td>
  <input type='text' name='pass' required='required' placeholder="New Password">
</td></tr>

<tr ><td align='right'>Re-Enter new password:</td><td>
  <input type='text' name='pass1' required='required' placeholder="Re-Enter New Password" >
</td></tr>
<br>
 <br> 
<a href="index.php#signup" style="float:right;color:teal;" title='Signin'>Back to Sign in</a>

<tr><td colspan=2><center><button name='change' class='btn'>Change</button></center></td></tr>
<br>  <br>  
</table>
 </form>
</div>
</div>
</body>

</html>
<?php 
$user=$_SESSION['user_email'];
$get_user="select * from users where `user_email`='$user'";
$run_user=mysqli_query($con,$get_user);
$row=mysqli_fetch_array($run_user);

$user_id=$row['user_id'];
if(isset($_POST['change']))
{
  $pass=$_POST['pass'];
$pass1=$_POST['pass1'];
if($pass==$pass1)
{
  if(strlen($pass)<=7)
  {
  echo "<script>alert('Password should be minimum 8 characters')</script>";
  }
  else 
  {
    $update="update users set user_pass='$pass' where user_id='$user_id'";
    $run=mysqli_query($con,$update);
    if($run)
    {
    echo "<script>alert('Your passsword has been successfully changed')</script>";
  echo"<script>window.open('home.php','_self')</script>";
    }
  }
}
else
{
    echo "<script>alert('Passwords did not match')</script>";
      echo"<script>window.open('change_password.php','_self')</script>";
}
}
}
?>