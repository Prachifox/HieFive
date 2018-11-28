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
$user_cover=$row['user_cover'];
$user_posts="select * from posts where `user_id`='$user_id'";
$run_posts=mysqli_query($con,$user_posts);
$posts=mysqli_num_rows($run_posts);

$sel_msg="select * from follow where `follower`='$user_id'";
$run_msg=mysqli_query($con,$sel_msg);
$count_msg=mysqli_num_rows($run_msg);

$sel_msg1="select * from follow where `following`='$user_id'";
$run_msg1=mysqli_query($con,$sel_msg1);
$count_msg1=mysqli_num_rows($run_msg1);


$sel_msg2="select * from messages where (`user_to`='$user_id' and msg_seen='no')";
$run_msg2=mysqli_query($con,$sel_msg2);
$count_msg2=mysqli_num_rows($run_msg2);

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
				<li><a href="home.php" ><i class="fa fa-home black-text"> </i>Home</a></li>
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

	 <div class='col s12 m5'><div class="card grey lighten-3">
	
<?php
echo"<div class='myclass'><center><img src='users/$user_image' width='200' height='200' class='circle'/></center>
<p><center><h4>$user_name</h4></center>
<center><strong>$describe_user</strong></center>
</p>
<p><a href='followers.php?u_id=$user_id' style='color:teal'><h6><i class='fa fa-user'></i> Followers($count_msg1)</h6></a></p>
<p><a href='following.php?u_id=$user_id' style='color:teal'><h6><i class='fa fa-user-plus'></i> Following($count_msg)</h6></a></p>
<p><a href='messages.php?u_id=new' style='color:teal'><h6><i class='material-icons'>message</i> Messages($count_msg2)</h6></a></p>
<p><a href='edit_profile.php?u_id=$user_id' style='color:teal'><h6><i class='fa fa-paint-brush'></i> Edit my profile</h6></a></p>

<p><a href='logout.php' style='color:teal'><h6><i class='fa fa-mouse-pointer'></i> Logout</h6><br></a></p></div>
";
				 ?></div>
</div>
<div class='col s12 m7'>
  <br>
<h4><center><span class='teal-text'>What's in </span><span class='black-text'>your mind??</span></center></h4>
<form action='home.php?id=<?phpecho $user_id;?>' method='post' id='f' enctype="multipart/form-data">
	 <div class="input-field">
          <textarea id="textarea1" class="materialize-textarea" name='content' placeholder="What's in your mind??">
          </textarea>
    </div>
          <div class='row'>
            <div class='col s12 m3'>
         <div class='file-field input-field'>
          <div class='btn'><span>Select Image</span><input type='file' name="upload_image"/></div>
          <div class='file-path-wrapper'>
            <input type='text' class='file-path' name="upload_image_name" />
          </div>
        </div>
        </div>
      </div>

    </div>
<!-- 	<textarea cols='83' rows='8' name='content' placeholder="What's in your mind ???" ></textarea> -->
	<center><input type="submit" name="sub" value='Post' class='btn'></center>
</form>	
</div>

<?php insertPost(); ?>
<center><h4><span class="teal-text">News </span>Feed</h4></center>
<?php get_posts(); ?>

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