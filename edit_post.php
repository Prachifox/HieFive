<!DOCTYPE html>
<?php
session_start();
include('includes/connection.php');
include('functions/function.php');
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
$user_image=$row['user_image'];
$user_posts="select * from posts where `user_id`='$user_id'";
$run_posts=mysqli_query($con,$user_posts);
$posts=mysqli_num_rows($run_posts);
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
<p><a href='edit_profile.php?u_id=$user_id'><h6><i class='fa fa-paint-brush'></i> Edit my profile</h6></a></p>
<p><a href='logout.php'><h6><i class='fa fa-mouse-pointer'></i> Logout</h6><br><br><br><br></a></p></div>
";
?>
</div>
</div>
<div class='col s12 m9'>
 <?php 
if(isset($_GET['post_id']))
{
  $get_id=$_GET['post_id'];
  $get_post="select * from posts where post_id='$get_id'";
  $run_post=mysqli_query($con,$get_post);
  $row=mysqli_fetch_array($run_post);
  $post_con=$row['post_content'];

}

?>
<div class='row'>
  <div class='col s12 m1'></div>
   <div class='col s12 m7'>
    <form method='post' action="">

      <br>  <br>  <br>  <br>  
<center><h4><span class='teal-text'>Edit</span> Your Post</h4></center>

    <br>

<textarea class='materialize-textarea' cols="83" rows="4" name='content'><?php echo $post_con; ?></textarea>
<br> <br> <br>         <center><input type="submit" name="update" class="btn" value="Update post"></center>
<br>
<br>
  
    <br>
 </form>
 <br>

</div>
</div>
<?php
if(isset($_POST['update']))
{
  $content=$_POST['content'];
  $update_post="update posts set post_content='$content' where post_id='$get_id'";
  $run_update=mysqli_query($con,$update_post);
  if($run_update)
  {
    echo"<script>alert('Post successfully updated . ')</script>";
    echo"<script>window.open('home.php','_self')</script>";
  }
}
?>
</div></div>
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
      </ul>


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
   
</html>
