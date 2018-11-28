<!DOCTYPE html>
<?php
session_start();
include('includes/connection.php');
include('functions/function.php');
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
	<title>Welcome Users</title>
</head>
<body>
    <?php 
$user=$_SESSION['user_email'];
$get_user="select * from users where `user_email`='$user'";
$run_user=mysqli_query($con,$get_user);
$row=mysqli_fetch_array($run_user);

$user_id=$row['user_id'];
$user_name=$row['user_name'];
$describe_user=$row['describe_user'];
$Relationship_status=$row['relationship'];
$user_pass=$row['user_pass'];
$user_email=$row['user_email'];
$user_country=$row['user_country'];
$user_image=$row['user_image'];
$user_gender=$row['user_gender'];
$user_posts="select * from posts where `user_id`='$user_id'";
$run_posts=mysqli_query($con,$user_posts);
$posts=mysqli_num_rows($run_posts);


$sel_msg2="select * from messages where (`user_to`='$user_id' and msg_seen='no')";
$run_msg2=mysqli_query($con,$sel_msg2);
$count_msg2=mysqli_num_rows($run_msg2);

$sel_msg="select * from follow where `follower`='$user_id'";
$run_msg=mysqli_query($con,$sel_msg);
$count_msg=mysqli_num_rows($run_msg);


$sel_msg1="select * from follow where `following`='$user_id'";
$run_msg1=mysqli_query($con,$sel_msg1);
$count_msg1=mysqli_num_rows($run_msg1);
?>
			<div class="navbar-fixed">
                <nav class="teal">
                       <div class="container">
                        <div class="nav-wrapper">
		                	 <a href="#" class="brand-logo">HieFive</a><a href="#" class="sidenav-trigger button-collapse show-on-large right" data-target="mobile-nav">
                               <i class="material-icons">menu</i>
                                     </a>
            <ul class="right hide-on-med-and-down">
<li><a href='profile.php?<?php echo "u_id=$user_id"?>'><i class="fa fa-user black-text"></i>Profile</a></li>
        <li><a href="home.php" ><i class="fa fa-home black-text"> </i> Home</a></li>
        <li><a href="members.php"><i class="fa fa-user-plus black-text"></i> Find People</a></li>
            <li><a href="messages.php?u_id=new" ><i class="fa fa-envelope black-text"></i>Messages</a></li>
            <li><a href='logout.php'><i class='fa fa-mouse-pointer black-text'></i> Logout</a></li>
			</ul>
            </div>
        </div>
      </nav>
    </div>
			<br>
	<div class='row'>
		<div class='col s12 m3'><div class="card grey lighten-3">
			

<?php
echo"<div class='myclass'><center><img src='users/$user_image' width='200' height='200' class='circle'/></center>
<p><center><h4>$user_name</h4></center>
<center><strong>$describe_user</strong></center>
</p><br><br>
<p><a href='edit_profile.php?u_id=$user_id'style='color:teal'><h6><i class='fa fa-paint-brush'></i> Edit my profile</h6></a></p>
<p><a href='messages.php?u_id=new' style='color:teal'><h6><i class='material-icons'>message</i> Messages($count_msg2)</h6></a></p>
<p><a href='followers.php?u_id=$user_id' style='color:teal'><h6><i class='fa fa-user'></i> Followers($count_msg1)</h6></a></p>
<p><a href='following.php?u_id=$user_id' style='color:teal'><h6><i class='fa fa-user-plus'></i> Following($count_msg)</h6></a></p>
<p><a href='logout.php' style='color:teal'><h6><i class='fa fa-mouse-pointer' ></i> Logout</h6><br><br><br><br></a></p></div>
";
				 ?>
</div>
</div>

<div class='col s12 m1'>
  </div>
<div class='col s12 m7'>
   <center><h4><span class='teal-text'>Edit </span> My Profile</h4></center>
  <div class='card grey lighten-3'>
  
<form method='post' id='f' enctype='multipart/form-data'>
  <table>
 
<tr ><td align='right'>Name:</td><td>
  <input type='text' name='u_name' required='required' value='<?php echo $user_name; ?>'>
</td></tr>

<tr ><td align='right'>Description:</td><td>
  <input type='text' name='describe_user' required='required' value='<?php echo $describe_user; ?>'>
</td></tr>


<tr ><td align='right'><span class="badge new"></span>  Best Friend's Name:</td><td>
  <input type='text' name='recovery_account' required='required' >
</td></tr>

<tr ><td align='right'>Relationship Status:</td><td>
  <select name='Relationship'>
    <option><?php echo $Relationship_status;?>  </option>
<option>Engaged</option>
<option>Married</option>
<option>Single</option>
<option>In a relationship</option>
<option>It's Complicated</option>
<option>Separated</option>
<option>Divorced</option>
  </select>
</td></tr>

<tr ><td align='right'>Password:</td><td>
  <input type='password' name='u_pass' id='my_pass' required='required' value='<?php echo $user_pass; ?>'>
 <p>
      <label>
        <input type="checkbox" onClick="show_password()"/>
        <span>Show Password</span>
      </label>
    </p></tr>

<tr ><td align='right'>Email:</td><td>
  <input type='email' name='u_email' required='required' value='<?php echo $user_email; ?>'>

</td></tr>

<tr ><td align='right'>Country:</td><td>
<select name='u_country'>
  <option><?php echo $user_country; ?></option>
<option>India</option>
<option>Pakistan</option>
<option>America</option>
<option>China</option>
<option>UK</option>
<option>France</option>
<option>Japan</option>
</select>
</td></tr>

<tr ><td align='right'>Gender:</td><td>
<select name='u_gender'>
  <option><?php echo $user_gender; ?></option>
<option>Male</option>
<option>Female</option>
<option>Others</option>
</select>
</td></tr>
  </table>


<center> <input type="submit" name="update" value="Update" class='btn waves-effect waves-teal'></center> 
<br>


</form>

<?php

if(isset($_POST['update']))
{
  $u_name=$_POST['u_name'];
$u_pass=$_POST['u_pass'];
$u_email=$_POST['u_email'];
$describe_user=$_POST['describe_user'];
$Relationship_status=$_POST['Relationship'];
$user_country=$_POST['u_country'];
$user_gender=$_POST['u_gender'];
$recovery_account=$_POST['recovery_account'];
$update="update users set 
`user_name`='$u_name',
`describe_user`='$describe_user',
`Relationship`='$Relationship_status',
`user_pass`='$u_pass',
`user_email`='$u_email',
`user_country`='$user_country',
`user_gender`='$user_gender',
`recovery_account`='$recovery_account' where user_id='$user_id'";
$run=mysqli_query($con,$update);
if($run)
{
  echo"<script>alert('Your profile has been updated successfully')</script>";

  echo"<script>window.open('home.php','_self')</script>";
}

}

?>


 <ul class="sidenav" id="mobile-nav">
 	 <li>
      <div class="user-view">
        <div class="background teal">
          <img src="">
        </div>
        <a href="#">
  <?php  echo"<img src='users/$user_image' alt='' class='circle'>"; ?>  
        </a>
        <a href="#" class="name white-text">
       <?php echo $user_name;?> 
        </a>
        <a href="#" class="email white-text">
         <?php echo $user;?>  
        </a>
      </div>
    </li>
			<li><a href='profile.php?<?php echo "u_id=$user_id"?>'><i class="fa fa-user black-text"></i>Profile</a></li>
        <li><a href="home.php" ><i class="fa fa-home black-text"> </i> Home</a></li>
        <li><a href="members.php"><i class="fa fa-user-plus black-text"></i> Find People</a></li>
            <li><a href="messages.php?u_id=new" ><i class="fa fa-envelope black-text"></i>Messages</a></li>
            <li><a href='logout.php'><i class='fa fa-mouse-pointer black-text'></i> Logout</a></li>
				<li>
			</ul>

</div></div></div>
</body>
 <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script >
      	
  $('#textarea1').val('');
  M.textareaAutoResize($('#textarea1'));
      </script>
    <script>
      const sideNav = document.querySelector('.sidenav');
      M.Sidenav.init(sideNav, {});
       const slider = document.querySelector('.slider');
      M.Slider.init(slider, {
        indicators: false,
        height: 600,
        transition: 500,
        interval: 5000
      });
      </script>
      <script>
      (function($){
 
  $(function(){
 
    // Plugin initialization
 
    $('select').not('.disabled').formSelect();
 
  });
 
})(jQuery); // end of jQuery name space
 </script>
 <script>
   function show_password()
   {
    var x=document.getElementById('my_pass');
    if(x.type==='password')
      x.type='text';
    else
      x.type='password';
   }

 </script>
   
</html>
<?php } ?>
