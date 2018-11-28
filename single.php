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
$user_logged_id=$row['user_id'];
$user_name=$row['user_name'];
$user_logged_name=$row['user_name'];
$describe_user=$row['describe_user'];
$user_image=$row['user_image'];
$user_posts="select * from posts where `user_id`='$user_id'";
$run_posts=mysqli_query($con,$user_posts);
$posts=mysqli_num_rows($run_posts);

$sel_msg="select * from messages where `user_to`='$user_id' AND msg_seen='no' ORDER BY 1 DESC";
$run_msg=mysqli_query($con,$sel_msg);
$count_msg=mysqli_num_rows($run_msg);?>
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
<h4><span class='teal-text'><center>Comments</center></span></h4>
<?php 
if(isset($_GET['post_id']))
{
  global $con;
  $get_id=$_GET['post_id'];
  $get_posts="select * from posts where post_id='$get_id'";
  $run_posts=mysqli_query($con,$get_posts);
  $row_posts=mysqli_fetch_array($run_posts);
  $post_id=$row_posts['post_id'];
  $user_id=$row_posts['user_id'];
  $content=$row_posts['post_content'];
  $upload_image=$row_posts['upload_image'];
  $post_date=$row_posts['post_date'];
  $user="select * from users where user_id='$user_id' AND posts='yes'";
  $run_user=mysqli_query($con,$user);
    $row_user=mysqli_fetch_array($run_user);
    $user_name=$row_user['user_name'];
    $user_image=$row_user['user_image'];
    $user_com=$_SESSION['user_email'];
    $get_com="select * from users where user_email='$user_com'";
    $run_com=mysqli_query($con,$get_com);
    $row_com=mysqli_fetch_array($run_com);

    $user_com_id=$row_com['user_id'];
     $user_com_name=$row_com['user_name'];


     if($content=="No" && strlen($upload_image) >= 1){
      echo"
        <div class='row'>
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
              </div></div>
                            ";
}
else if(strlen($content) >= 1 && strlen($upload_image) >= 1){
      echo"
       <div class='row'>
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
              </div></div>

";}
else
{
echo"
       <div class='row'>
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
                  </div>";
}
echo"<form method='post'>
                          <div class='input-field col s12 m10 offset-m1'>
                            <textarea id='textarea1' class='materialize-textarea' name='comment' ></textarea>
                            <label for='textarea1'>Comment...</label>
                             <center>
                           <input type='submit' name='reply' value='comment' class='btn waves-effect waves-teal white-text'></center></div>
</form>";

$get_com="select * from comments where post_id='$get_id' ORDER BY 1 DESC ";
$run_com=mysqli_query($con,$get_com);
while($row=mysqli_fetch_array($run_com))
{
$com_id=$row['com_id'];
$com=$row['comment'];
$com_user=$row['user_id'];
$com_name=$row['comment_author'];
$date=$row['date'];
echo"<div class='row'><div class='col s12 m10 offset-m2'>
";
if(($user_logged_id==$com_user) OR($com_name==$user_logged_name))
{
  echo"<form method='post'>
<a href='functions/delete_comment.php?com_id=$com_id&post_id=$get_id' class='btn red lighten-4' name='delete' type='submit' style='float:right;'><i class='fa fa-trash red-text small' ></i></a></form>";
}
echo"$com_name <small> Commmented on $date</small>
<blockquote>&nbsp $com</blockquote>
</div></div>
";
}

if(isset($_POST['reply']))
{
  $comment=$_POST['comment'];
  $insert="insert into comments (post_id,user_id,comment,comment_author,date) values ('$post_id','$user_id','$comment','$user_com_name',NOW())";
  $run=mysqli_query($con,$insert);
  echo "<script>alert('Your reply has been added')</script>";
  echo "<script>window.open('single.php?post_id=$post_id','_self')</script>";
}

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