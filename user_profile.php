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
#button
{
  position:absolute;
top:-70px;
cursor:pointed;
left:160px;
}
    #cover-img{
    height:550px;
    width:100%;
  }
  #profile_img
  {
    position:absolute;
    top:220px;
    left:40px;
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
	<title>Welcome Users</title>
</head>
<body>
    <?php  
    if(isset($_GET['u_id']))
      {
$user_id=$_GET['u_id'];
$get_user="select * from users where `user_id`='$user_id'";
$run_user=mysqli_query($con,$get_user);
$row=mysqli_fetch_array($run_user);
$user_id=$row['user_id'];
$user_name=$row['user_name'];
$describe_user=$row['describe_user'];
$user_image=$row['user_image'];
$user_cover=$row['user_cover'];

  $user=$_SESSION['user_email'];
 $get_users="select * from users where user_email='$user'";
  $run_users=mysqli_query($con,$get_users);
    $row_user=mysqli_fetch_array($run_users);
  $user_logged_id=$row_user['user_id'];
   $user_logged_name=$row_user['user_name'];
 $user_logged_email=$row_user['user_email'];
$user_imag=$row_user['user_image'];

$sel_msg="select * from follow where `follower`='$user_id'";
$run_msg=mysqli_query($con,$sel_msg);
$count_msg=mysqli_num_rows($run_msg);


$sel_msg1="select * from follow where `following`='$user_id'";
$run_msg1=mysqli_query($con,$sel_msg1);
$count_msg1=mysqli_num_rows($run_msg1);

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
       <?php echo $user_logged_name;?> 
        </a>
        <a href="#" class="email white-text">
         <?php echo $user_logged_email;?>  
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
  
<?php
echo"

<img src='users/$user_cover' id='cover-img'>


<img src='users/$user_image' height='50%' width='25%' class='circle' id='profile_img'>

";

      }?>
	<div class='row'>
		<div class='col s12 m3'>
<div class='card grey lighten-4'>

  <?php

  if($user_logged_id==$user_id)
  {}
else{
  $check_follow="select * from follow where (follower='$user_logged_id' AND following='$user_id')";
  $run_follow=mysqli_query($con,$check_follow);
$checks=mysqli_num_rows($run_follow);

  if($checks==0)
  {
    echo" <form method='post'><center><button class='btn' name='follow' id='button'>Follow</button></center>
    </form>";
  }
  else
  {
    echo" <form method='post'><center><button class='btn' name='unfollow' id='button' >UnFollow</button></center></form>"; 
  }
  }
  ?>
  <br>
<?php echo"&nbsp <a href='followers.php?u_id=$user_id' class='btn green'><i class='fa fa-user'></i>Followers($count_msg1)</a>&nbsp
<a href='following.php?u_id=$user_id'  class='btn yellow lighten-1 black-text'><i class='fa fa-user-plus'></i>Following($count_msg)</a>";
?>
<div class='center'><h4><span class='teal-text'>Info about</span> <?php echo $user_name;?></h4></div> 
<?php
user_profile();
?>
</div>
</div>
<div class='col s12 m9'>

<br>


  <?php
global $con;
$get_posts="select * from posts where user_id='$user_id' ORDER BY 1 DESC LIMIT 200";
$run_posts=mysqli_query($con,$get_posts);
$rows=mysqli_num_rows($run_posts);
 if($rows==0)
 {
echo"<br><br><br><br><br><center><h1><span class='teal-text'>No posts</span> yet</h1></center>";
 }
 else
 {
  echo"<center><h4><span class='teal-text'>Posts</span></h4></center>";

}

   while($row_posts=mysqli_fetch_array($run_posts))
   {
$post_id=$row_posts['post_id'];
$user_id=$row_posts['user_id'];
$content=$row_posts['post_content'];
$upload_image=$row_posts['upload_image'];
$post_date=$row_posts['post_date'];
$userz="select * from users where user_id='$user_id' and posts='yes'";
$run_userz=mysqli_query($con,$userz);
$row_userz=mysqli_fetch_array($run_userz);

$user_name=$row_userz['user_name'];
$user_image=$row_userz['user_image'];


if($content=="No" && strlen($upload_image) >= 1){
echo"<div class='row'>
    <div class='col s12 m1'>
            </div>
                <div class='col s12 m10'>
                    <div class='card grey lighten-4'>
                  <div class='row'>
                <div class='col s12 m3'>
                <br>
                &nbsp<img src='users/$user_image' class='circle' width='140' height='120'>
                </div>
                <div class='col s12 m5'>
                <br>
              <h5><a href='user_profile.php?u_id=$user_id' class='teal-text'>$user_name</a></h5>
              <h6>Updated a post on <strong>$post_date</strong></h6>
                </div>
                  </div>
            <div class='card-image'>
              <img id='posts-img' src='imagepost/$upload_image' width='500' height='500'>
              </div>
<a href='single.php?post_id=$post_id'  style='float:right;' class='btn waves-teal waves-effect teal'><i class='fa fa-comment'></i> Comment</a>
</div></div></div><br>
              ";
            }

else if(strlen($content) >= 1 && strlen($upload_image) >= 1)
{
  echo"<div class='row'>
            <div class='col s12 m1'>
            </div>
                <div class='col s12 m10'>
                    <div class='card grey lighten-4'>
                  <div class='row'>
                <div class='col s12 m3'>
                <br>
                &nbsp<img src='users/$user_image' class='circle' width='140' height='120'>
                </div>
                <div class='col s12 m5'>
                <br>
              <h5><a href='user_profile.php?u_id=$user_id' class='teal-text'>$user_name</a></h5>
              <h6>Updated a post on <strong>$post_date</strong></h6>
              <blockquote>$content</blockquote>
                </div>
                  </div>
            <div class='card-image'>
              <img id='posts-img' src='imagepost/$upload_image' width='500' height='500'>
              </div>
<a href='single.php?post_id=$post_id'  style='float:right;' class='btn waves-teal waves-effect teal'><i class='fa fa-comment'></i> Comment</a>
</div></div></div><br>";
           

}
else
{
  echo"<div class='row'>
            <div class='col s12 m1'>
            </div>
                <div class='col s12 m10'>
                  <div class='card grey lighten-4'>
                  <div class='row'>
                <div class='col s12 m3'>
                <br>
                &nbsp<img src='users/$user_image' class='circle' width='140' height='120'>
                </div>
                <div class='col s12 m5'>
                <br>
              <h5><a href='user_profile.php?u_id=$user_id' class='teal-text'>$user_name</a></h5>
              <h6>Updated a post on <strong>$post_date</strong></h6>
               <blockquote>$content</blockquote>
                </div>
                  </div>
<a href='single.php?post_id=$post_id' style='float:right;' class='btn waves-teal waves-effect teal'><i class='fa fa-comment'></i>Comment</a><br>
</div></div></div><br>";
}

}

?>

</div>
</div></div>


</body>
 <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
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
   
</html>
<?php } ?>
 <?php
    if(isset($_POST['follow']))
    {
    $insert="insert into follow (follower,following) values('$user_logged_id','$user_id')";
    $run_insert=mysqli_query($con,$insert);
    echo"<script>window.open('user_profile.php?u_id=$user_id','_self');</script>";
  }
    if(isset($_POST['unfollow']))
    {
  $delete_post="delete from follow where follower='$user_logged_id' AND following='$user_id'";
   $run_delete=mysqli_query($con,$delete_post);
if($run_delete)
{  echo"<script>window.open('user_profile.php?u_id=$user_id','_self');</script>";
  }
}




    ?>