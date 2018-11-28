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
<style>
#scroll_users
{
  height:650px;
  max-height:650px;
  overflow: scroll;
}
#scroll_messages
{
  height:300px;
  max-height:300px;
  overflow: scroll;
}
  #image_upload_button
  {
    right:20;
    top:50;
  }
#green
{
float:left;
border-radius:3px;
padding:4px;
background-color:#dcedc8 ;
border-color: #9ccc65;
width:45%;
font-size: 16px;
margin-bottom: 5px;

}
#blue
{
float:right;
border-radius: 3px;
padding:4px;
background-color: #e3f2fd ;
border-color: #26c6da;
width:45%;
font-size: 16px;
margin-bottom: 5px;

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
  <title>Messages</title>
</head>
<body>
  <?php
  $user=$_SESSION['user_email'];
 $get_user="select * from users where user_email='$user'";
  $run_user=mysqli_query($con,$get_user);
    $row=mysqli_fetch_array($run_user);
  $user_from_msg=$row['user_id'];
  $user_id=$row['user_id'];
   $user_nam=$row['user_name'];
 $user_email=$row['user_email'];
 $user_gender=$row['user_gender'];
  $user_relationship=$row['relationship'];
  $describe_user=$row['describe_user'];
  $register_date=$row['user_reg_date'];
  $user_country=$row['user_country'];
$user_imag=$row['user_image'];
  $user_from_name=$row['user_name'];
 $follow="select * from follow where follower='$user_id'";
  $run_follow=mysqli_query($con,$follow);
  if(isset($_GET['u_id']))
  {
    $users_id=$_GET['u_id'];
  $updatef="update messages set msg_seen='yes' where (user_to='$user_id' AND user_from='$users_id') ";
  $run_fol=mysqli_query($con,$updatef);
}
    ?>

 <ul class="sidenav" id="mobile-nav">
   <li>
      <div class="user-view">
        <div class="background teal">
          <img src="">
        </div>
        <a href="#">
  <?php  echo"<img src='users/$user_imag' alt='' class='circle'>"; ?>  
        </a>
        <a href="#" class="name white-text">
       <?php echo $user_nam;?> 
        </a>
        <a href="#" class="email white-text">
         <?php echo $user_email;?>  
        </a>
      </div>
    </li>
      <li><a href='profile.php?<?php echo "u_id=$user_id"?>'><i class="fa fa-user black-text"></i>Profile</a></li>
        <li><a href="home.php" ><i class="fa fa-home black-text"> </i> Home</a></li>
        <li><a href="members.php"><i class="fa fa-user-plus black-text"></i> Find People</a></li>
            <li><a href="messages.php?u_id=new" ><i class="fa fa-envelope black-text"></i>Messages</a></li>
            <li><a href='logout.php'><i class='fa fa-mouse-pointer black-text'></i> Logout</a></li>
      </ul>
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

  <?php  echo"<div class='row'>
  <div class='col s12 m2'>

    <div id='scroll_users'><h5><center>Following</center></h5>";

     while($row_follow=mysqli_fetch_array($run_follow))
     {
  $following_id=$row_follow['following'];
  $user_query="select * from users where user_id='$following_id'";
  $run_q=mysqli_query($con,$user_query);
  $row_user=mysqli_fetch_array($run_q);
  $user_msg_id=$row_user['user_id'];
  $user_name=$row_user['user_name'];
  $user_image=$row_user['user_image'];

   $follow_query="select * from messages where (user_to='$user_id' AND user_from='$user_msg_id' AND msg_seen='no')";
  $run_followq=mysqli_query($con,$follow_query);
  $rowzzz=mysqli_num_rows($run_followq);
  echo"<div class='card grey lighten-5'><br><a href='messages.php?u_id=$user_msg_id'>";
  if($rowzzz>0)
  {
echo" <span class='badge new'>($rowzzz)</span>";
}
echo" <center><img src='users/$user_image' width='100px' height='100px' title='$user_name' class='circle'><center>
  <h6>$user_name</h6></div>
  <br>
</a>
";
}?>
<?php echo"<br>
<h5><center>Followers</center></h5>";
 $followz="select * from follow where following='$user_id'";
  $run_followz=mysqli_query($con,$followz);
     while($row_followz=mysqli_fetch_array($run_followz))
     {
  $follower_id=$row_followz['follower'];
  $user_queryz="select * from users where user_id='$follower_id'";
  $run_qz=mysqli_query($con,$user_queryz);
  $row_userz=mysqli_fetch_array($run_qz);
  $user_msg_idz=$row_userz['user_id'];
  $user_namez=$row_userz['user_name'];
  $user_imagez=$row_userz['user_image'];

   $follow_queryz="select * from messages where (user_to='$user_id' AND user_from='$user_msg_idz' AND msg_seen='no')";
  $run_followqz=mysqli_query($con,$follow_queryz);
  $rowzz=mysqli_num_rows($run_followqz);
  echo"<div class='card grey lighten-5'><br><a href='messages.php?u_id=$user_msg_idz'>";
  if($rowzz>0)
  {
echo" <span class='badge new'>($rowzz)</span>";
}
echo" <center><img src='users/$user_imagez' width='100px' height='100px' title='$user_namez' class='circle'><center>
  <h6>$user_namez</h6></div>
  <br>
</a>
";
}?>


</div></div>

  <?php
if(isset($_GET['u_id']))
{
  global $con;
  $get_id=$_GET['u_id'];
  $get_user="select * from users where user_id='$get_id'";
  $run_user=mysqli_query($con,$get_user);
  $row_user=mysqli_fetch_array($run_user);
  $user_to_msg=$row_user['user_id'];
  $user_to_name=$row_user['user_name'];

}
  ?>
   <?php
if(isset($_GET['u_id']))
{
  $user_id=$_GET['u_id'];?>
  <div class="col s12 m7">
   <center><h4><span class='teal-text'>Your</span>Messages</h4></center>
   <br>
     <div class='load_msg' id='scroll_messages'>
   <?php
$sel_msg="select * from messages where (user_to='$user_to_msg' AND user_from='$user_from_msg')
OR (user_from='$user_to_msg' AND user_to='$user_from_msg') ORDER BY 1 ASC";
$run_msg=mysqli_query($con,$sel_msg);
while($row=mysqli_fetch_array($run_msg))
{
  $user_to=$row['user_to'];
  $user_from=$row['user_from'];
  $msg_body=$row['msg_body'];
  $msg_date=$row['date'];
  ?>

  <div id="loaded_msg">  <?php 

if($user_to==$user_to_msg AND $user_from==$user_from_msg)
{
  echo"<div title='$msg_date' id='blue' class='chip'>
    $msg_body
  </div><br><br>";

}
else if($user_from==$user_to_msg AND $user_to==$user_from_msg)
{
  echo"<div title='$msg_date' id='green' class='chip'>
    $msg_body
  </div><br><br>";
}
    ?>
  </div>

  <?php
}
   ?>
  </div>
 
  <?php
  if($user_id=='new')
  {
    echo"<br> <form><center><h5><span class='teal-text'>Select someone to start a conversation with</span></h5></center><br>
    <center><h5><span class='black-text'>You can only send messages amongst your followers or following</span></h5></center>
    <textarea class='materialize-textarea' disabled placeholder='Enter you message' id='textarea1'></textarea><br>
    <br><center><input type='submit' class='btn' disabled value='send'></center>
    </form><br><br>";
  }
  else
  {
    echo"<br> <form method='post'>
    <textarea class='materialize-textarea' placeholder='Enter you message' id='message_textarea' name='msg_box'></textarea><br>
    <br><center><input type='submit' name='send_msg' class='btn' id='btn_msg' value='Send'></center>
    </form><br>

    ";
  }

}
    ?>
    <?php
    if(isset($_POST['send_msg']))
    {
      $msg=$_POST['msg_box'];
      if($msg=='')
      {
      echo"<center><h5><span class='teal-text'>Enter something to send..</span></h5></center>
      ";
    }
    else {
    $insert="insert into messages (user_to,user_from,msg_body,date,msg_seen) values('$user_to_msg','$user_from_msg','$msg',NOW(),'no')";
    $run_insert=mysqli_query($con,$insert);
    echo"<script>window.open('messages.php?u_id=$user_id','_self');</script>";
  }
}


    ?>
     </div>
     <div class='row'>
       <div class='col s12 m3'>

    <?php 
    if($user_id=='new')
    {
echo " <h3><center>My Profile</center></h3><br><center>
<img src='users/$user_imag' width='150' height='150' class='circle'></center>
<table class='striped responsive-table'>
<tbody>
<tr><td><h6>  Name</h6></td><td>$user_nam</td></tr>
<tr><td><h6> Gender</h6></td><td>$user_gender</td></tr>
<tr><td><h6> Country</h6></td><td>$user_country</td></tr>
<tr><td><h6> Relationship</h6></td><td>$user_relationship</td></tr>
<tr><td><h6> Description</h6></td><td>$describe_user</td></tr>
<tr><td><h6> Member since</h6></td><td>$register_date</td></tr>
</tbody>
</table></center>
";
    }
    else
    {
    echo"  <h4><center>Chat with</center>
    $user_to_name</h4>";
  user_profile();
}
  ?>
       </div>
     </div>
  </div>
</div>
</div></div>
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
        var div=document.getElementById("scroll_messages");
        div.scrollTop=div.scrollHeight;
      </script>
   
</html>
<?php } ?>