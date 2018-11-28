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
  <style>
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
  .update_profile
  {
position:absolute;
top:550px;
cursor:pointed;
left:180px;
  }
    .update_profile_btn
  {
position:absolute;
top:570px;
cursor:pointed;
left:20px;
  }

.update_cover_btn
  {
position:absolute;
top:58%;
right:21%;
cursor:pointed;
  }
  .update_cover
  {
position:absolute;
top:55%;
left:80%;
cursor:pointed;
  }
</style>
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

$sel_msg="select * from messages where user_to='$user_id' AND msg_seen='no' ORDER BY 1 DESC";
$run_msg=mysqli_query($con,$sel_msg);
$count_msg=mysqli_num_rows($run_msg);
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
 

 <?php 
$user=$_SESSION['user_email'];
$get_user="select * from users where user_email='$user'";
$run_user=mysqli_query($con,$get_user);
$row=mysqli_fetch_array($run_user);
$user_id=$row['user_id'];
$user_name=$row['user_name'];
$describe_user=$row['describe_user'];
$Relationship_status=$row['relationship'];
$user_country=$row['user_country'];
$user_image=$row['user_image'];
$user_cover=$row['user_cover'];
$register_date=$row['user_reg_date'];
$gender=$row['user_gender'];
$user_birthday=$row['user_birthday'];

echo"

<img src='users/$user_cover' id='cover-img'>
<form action='profile.php' method='post' enctype='multipart/form-data'>
  <div class='update_cover'>
 <div class='file-field input-field'>
          <div class='btn'><span><i class='material-icons'>file_upload</i></span><input type='file' name='u_covers'/></div>
          <div class='file-path-wrapper'>
            <input type='text' class='file-path' name='u_cover' />
</div>
</div></div>
<div class='update_cover_btn'>
<button name='submit' class='btn waves-effect waves-teal' type='submit'>Update Cover</button>
</div>
</form>

<img src='users/$user_image' height='50%' width='25%' class='circle' id='profile_img'>
<form action='profile.php' method='post' enctype='multipart/form-data'>
<div class='update_profile'>
  <div class='file-field input-field'>
          <div class='btn'><span><i class='material-icons'>file_upload</i></span><input type='file' name='u_images'/></div>
          <div class='file-path-wrapper'>
            <input type='text' class='file-path' name='u_image' />
</div>
</div></div>
<div class='update_profile_btn'>
<button name='update' class='btn waves-effect waves-teal' type='submit'>Update Profile</button>
</div>
</form>




<div class='row'>
<div class='col m3'>
<br>
<div class='card grey lighten-4'>
<br><br>
<span class='teal-text center'><h4><i class='material-icons teal-text medium'>people</i> $user_name</h4></span>
<center><h5>$describe_user</h5></p>
<br>
<table class='striped responsive-table'>
<tbody>
<tr><td><h6>&nbspRelationship status</h6></td><td>$Relationship_status</td></tr>
<tr><td><h6>&nbspLives in </h6></td><td> $user_country </td></tr>
<tr><td><h6>&nbspGender </h6></td><td> $gender </td></tr>
<tr><td><h6>&nbspBirthday </h6></td><td> $user_birthday </td></tr>
<tr><td><h6>&nbspMember since: </h6></td><td> $register_date </td></tr>
</tbody>
</table>
</center>
</div>
</div>
";

 ?>

 <div class='col s12 m9'>
<center><h4><span class='teal-text'>Your</span> Posts</h4></center>
<?php 
global $con;
if(isset($_GET['u_id']))
{
  $u_id=$_GET['u_id'];
} 
$get_posts="select * from posts where user_id='$user_id' ORDER BY 1 DESC LIMIT 200";
 $run_posts=mysqli_query($con,$get_posts);
   while($row_posts=mysqli_fetch_array($run_posts))
   {
$post_id=$row_posts['post_id'];
$user_id=$row_posts['user_id'];
$content=$row_posts['post_content'];
$upload_image=$row_posts['upload_image'];
$post_date=$row_posts['post_date'];
$user="select * from users where user_id='$user_id' and posts='yes'";
$run_user=mysqli_query($con,$user);
$row_user=mysqli_fetch_array($run_user);
$user_name=$row_user['user_name'];
$user_image=$row_user['user_image'];

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
<a href='functions/delete_post.php?post_id=$post_id' style='float:right;' class='btn waves-teal waves-effect red'><i class='fa fa-trash'></i> Delete</a>
<a href='edit_post.php?post_id=$post_id'  style='float:right;' class='btn waves-teal waves-effect teal'><i class='fa fa-edit'></i>Edit</a>
<a href='single.php?post_id=$post_id'  style='float:right;' class='btn waves-teal waves-effect teal'><i class='fa fa-address-book'></i> View</a>
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
              <a href='functions/delete_post.php?post_id=$post_id' style='float:right;' class='btn waves-teal waves-effect red'><i class='fa fa-trash'></i> Delete</a>
              <a href='edit_post.php?post_id=$post_id'  style='float:right;' class='btn waves-teal waves-effect teal'><i class='fa fa-edit'></i>Edit</a>
<a href='single.php?post_id=$post_id'  style='float:right;' class='btn waves-teal waves-effect teal'><i class='fa fa-address-book'></i> View</a>
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
                  <a href='functions/delete_post.php?post_id=$post_id' style='float:right;' class='btn waves-teal waves-effect red'><i class='fa fa-trash'></i> Delete</a>
                  <a href='edit_post.php?post_id=$post_id'  style='float:right;' class='btn waves-teal waves-effect teal'><i class='fa fa-edit'></i>Edit</a>
<a href='single.php?post_id=$post_id' style='float:right;' class='btn waves-teal waves-effect teal'><i class='fa fa-address-book'></i>View</a><br>
</div></div></div><br>";
}
include('functions/delete_post.php'); 
}
?>
</div>
</div>
<?php 
if(isset($_POST['update']))
{
  $u_image=$_POST['u_image'];
  $image_tmp=$_FILES['u_images']['tmp_name'];
  if($u_image=='')
  {
echo"<script>alert('Select an image first')</script>";
  }
  else
  {
  move_uploaded_file($image_tmp,"users/$u_image");
  $update="update users set `user_image`='$u_image' where `user_id`='$user_id'" ;
  $run=mysqli_query($con,$update);
  if($run)
  {
    echo"<script>alert('Profile Pic successfully updated. ')</script>";
 echo"<script>window.open('profile.php','_self')</script>";
  }
}
}

if(isset($_POST['submit']))
{
  $u_cover=$_POST['u_cover'];
  $cover_tmp=$_FILES['u_covers']['tmp_name'];
    if($u_cover=='')
  {
echo"<script>alert('Select an image first')</script>";
  }
  else
  {
  move_uploaded_file($cover_tmp,"users/$u_cover");
  $update="update users set `user_cover`='$u_cover' where `user_id`='$user_id'" ;
  $run=mysqli_query($con,$update);
  if($run)
  {
    echo"<script>alert('Cover Pic successfully updated. ')</script>";
 echo"<script>window.open('profile.php','_self')</script>";
  }
}
}

?> 
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
<?php }?>