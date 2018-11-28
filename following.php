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
 if(isset($_GET['u_id']))
      {
$user_id=$_GET['u_id'];
}
$get_user="select * from users where `user_id`='$user_id'";
$run_user=mysqli_query($con,$get_user);
$row=mysqli_fetch_array($run_user);

$user_id=$row['user_id'];
$user_name=$row['user_name'];
$describe_user=$row['describe_user'];
$user_image=$row['user_image'];

$user_posts="select * from posts where `user_id`='$user_id'";
$run_posts=mysqli_query($con,$user_posts);
$posts=mysqli_num_rows($run_posts);

$sel_msg="select * from follow where `follower`='$user_id'";
$run_msg=mysqli_query($con,$sel_msg);
$count_msg=mysqli_num_rows($run_msg);


$sel_msg1="select * from follow where `following`='$user_id'";
$run_msg1=mysqli_query($con,$sel_msg1);
$count_msg1=mysqli_num_rows($run_msg1);

$user_mail=$_SESSION['user_email'];
$get_user_mail="select * from users where `user_email`='$user_mail'";
$run_userr=mysqli_query($con,$get_user_mail);
$rows=mysqli_fetch_array($run_userr);

$user_ids=$rows['user_id'];
$user_names=$rows['user_name'];
$user_emails=$rows['user_email'];
$user_images=$rows['user_image'];

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
<p><a href='followers.php?u_id=$user_id' style='color:teal'><h6><i class='fa fa-user'></i> Followers($count_msg1)</h6></a></p>
<p><a href='following.php?u_id=$user_id' style='color:teal'><h6><i class='fa fa-user-plus'></i> Following($count_msg)</h6></a></p>
<p><a href='logout.php' style='color:teal'><h6><i class='fa fa-mouse-pointer' ></i> Logout</h6><br><br><br><br></a></p></div>
";
 ?>
</div>
</div>


<ul class="sidenav" id="mobile-nav">
   <li>
      <div class="user-view">
        <div class="background teal">
          <img src="">
        </div>
        <a href="#">
  <?php  echo"<img src='users/$user_images' alt='' class='circle'>"; ?>  
        </a>
        <a href="#" class="name white-text">
       <?php echo $user_names;?> 
        </a>
        <a href="#" class="email white-text">
         <?php echo $user_emails;?>  
        </a>
      </div>
    </li>
      <li><a href='profile.php?<?php echo "u_id=$user_id"?>'><i class="fa fa-user black-text"></i>Profile</a></li>
        <li><a href="home.php" ><i class="fa fa-home black-text"> </i> Home</a></li>
        <li><a href="members.php"><i class="fa fa-user-plus black-text"></i> Find People</a></li>
            <li><a href="messages.php?u_id=new" ><i class="fa fa-envelope black-text"></i>Messages</a></li>
            <li><a href='logout.php'><i class='fa fa-mouse-pointer black-text'></i> Logout</a></li>
          
      </ul>

<div class='col s12 m9'>
<center><h4><span class='teal-text'></span>Following</h4></center>
<?php
if(isset($_GET['u_id']))
{
  $userr_id=$_GET['u_id'];
}
        $get_userz="select * from users where user_id='$userr_id'";
        $run_userz=mysqli_query($con,$get_userz);
        $rowz=mysqli_fetch_array($run_userz);
        $user_logged=$rowz['user_id'];
        
    $follow="select * from follow where follower='$user_logged'";
    $run_follow = mysqli_query($con,$follow);
      echo"<br><div class='row'>";
  $i=1;
    while($row_follow=mysqli_fetch_array($run_follow))
    {
      $following_id=$row_follow['following'];
      $get_userzz="select * from users where user_id='$following_id'";
            $run_userzz=mysqli_query($con,$get_userzz);
            $rowzzz=mysqli_fetch_array($run_userzz);
            $user_id=$rowzzz['user_id'];
            $user_name=$rowzzz['user_name'];
            $user_image=$rowzzz['user_image'];
            echo"<div class='col m1 s12'></div><div class='col m4 s12'><div class='card grey lighten-3'>
<br>
<center><img src='users/$user_image' height='140' width='140' class='circle' title='$user_name'></a></center>
<a href='user_profile.php?u_id=$user_id'><span class='black-text center'><h5><i class='fa fa-address-card teal-text'></i> $user_name</h5></span>
</div></div>";
if($i%2==0)
echo"</div><br><div class='row'>";
$i++;

    }
?>
</div>
</div>

 
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
<?php } ?>