<?php 
$con=mysqli_connect('localhost','root','','socialnetwork')or die('Connection was not established');

function insertPost(){
	if(isset($_POST['sub'])){
		global $con;
		global $user_id;

		$content = htmlentities($_POST['content']);
		$upload_image = htmlentities($_POST['upload_image_name']);
		$image_tmp = $_FILES['upload_image']['tmp_name'];
		$random_number = rand(1, 100);

		if(strlen($content) > 300){
			echo "<script>alert('Please Use 250 or less than 300 words!')</script>";
			echo "<script>window.open('home.php', '_self')</script>";
		}else{
			if(strlen($upload_image) >= 1 && strlen($content) >= 1){
				move_uploaded_file($image_tmp, "imagepost/$upload_image.$random_number");
				$insert = "insert into posts (user_id, post_content, upload_image, post_date) values('$user_id', '$content', '$upload_image.$random_number', NOW())";

				$run = mysqli_query($con, $insert);

				if($run){
					echo "<script>alert('Your Post has been updated successfully')</script>";
					echo "<script>window.open('home.php', '_self')</script>";

					$update = "update users set posts='yes' where user_id='$user_id'";
					$run_update = mysqli_query($con, $update);
				}

				exit();
			}else{
				if($upload_image=='' && $content == ''){
					echo "<script>alert('Error Occured while uploading!')</script>";
					echo "<script>window.open('home.php', '_self')</script>";
				}else{
					if($content==''){
						move_uploaded_file($image_tmp, "imagepost/$upload_image.$random_number");
						$insert = "insert into posts (user_id,post_content,upload_image,post_date) values ('$user_id','No','$upload_image.$random_number',NOW())";
						$run = mysqli_query($con, $insert);

						if($run){
							echo "<script>alert('Your Post updated a moment ago!')</script>";
							echo "<script>window.open('home.php', '_self')</script>";

							$update = "update users set posts='yes' where user_id='$user_id'";
							$run_update = mysqli_query($con, $update);
						}

						exit();
					}else{
						$insert = "insert into posts (user_id, post_content, post_date) values('$user_id', '$content', NOW())";
						$run = mysqli_query($con, $insert);

						if($run){
							echo "<script>alert('Your Post updated a moment ago!')</script>";
							echo "<script>window.open('home.php', '_self')</script>";

							$update = "update users set posts='yes' where user_id='$user_id'";
							$run_update = mysqli_query($con, $update);
						}
					}
				}
			}
		}
	}
}

function get_posts(){
global $con;
/*$query=0;
	$per_page = 4;

	if(isset($_GET['page'])){
		$page = $_GET['page'];
	}else{
		$page=1;
	}

	$start_from = ($page-1) * $per_page;*/
	$get_posts = "select * from posts ORDER by 1 DESC ";

	$run_posts = mysqli_query($con, $get_posts);

	while($row_posts = mysqli_fetch_array($run_posts)){

		$post_id = $row_posts['post_id'];
		$user_id = $row_posts['user_id'];
		$content = substr($row_posts['post_content'], 0,300);
		$upload_image = $row_posts['upload_image'];
		$post_date = $row_posts['post_date'];


        $user=$_SESSION['user_email'];
        $get_userz="select * from users where user_email='$user'";
        $run_userz=mysqli_query($con,$get_userz);
        $rowz=mysqli_fetch_array($run_userz);
        $user_logged=$rowz['user_id'];
        
		$follow="select * from follow where follower='$user_logged' ";
		$run_follow = mysqli_query($con,$follow);
		$i=0;
	while($row_follow = mysqli_fetch_array($run_follow))
	{
		$following=$row_follow['following'];
		if($following==$user_id)
		{
       /*   ++$query;*/
          $i=1;
          break;
		}
	}
        if($i==1)
        {

		$user = "select * from users where user_id='$user_id' AND posts='yes' ";
		$run_user = mysqli_query($con,$user);
		$row_user = mysqli_fetch_array($run_user);

		$user_name = $row_user['user_name'];
		$user_image = $row_user['user_image'];

	
        	if($content=="No" && strlen($upload_image) >= 1){
		
			echo"
			
			  <div class='row'>
						<div class='col s12 m2'>
						</div>
				        <div class='col s12 m9'>
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
						
					<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Comment</button></a><br>
						</div>
				</div>
		            <br>
			";
		}

		else if(strlen($content) >= 1 && strlen($upload_image) >= 1){
		
			echo"
			 <div class='row'>
						<div class='col s12 m2'>
						</div>
				        <div class='col s12 m9'>
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
						
					<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Comment</button></a><br>
						</div>
				</div>
		<br>
			";
		}

		else{

			echo"
			 <div class='row'>
						<div class='col s12 m2'>
						</div>
				        <div class='col s12 m9'>
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
					        </div>
						
					<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Comment</button></a><br>
						</div>
				</div>
		<br>
			";
		}
	}

}

/*$total_pages=ceil($query/$per_page);
echo"
 <center><div id='pagination'><a href='home.php?page=1'>First Page</a>
";
for($i=1;$i<=$total_pages;$i++)
{
echo"<a href='home.php?page=$i'>$i </a>";
}
echo"<a href='home.php?page=$total_pages'>Last Page</a></div></center>";*/



}


function search_user()
{
		global $con;
		if(isset($_GET['search_user_button']))
		{
			$search_query=$_GET['search_user'];
			$get_user="select * from users where f_name like '%$search_query%' OR l_name like '%$search_query%' OR
user_name like '%$search_query%' ";
		}
		else
		{
			$get_user="select * from users";
		}

		$run_user=mysqli_query($con,$get_user);
	echo"<br><div class='row'>";
	$i=1;
    while($row_user=mysqli_fetch_array($run_user))
    {
$user_id=$row_user['user_id'];
$user_name=$row_user['user_name'];
$user_image=$row_user['user_image'];
echo"<div class='col m1 s12'></div><div class='col m4 s12'><div class='card grey lighten-3'>
<br>
<center><img src='users/$user_image' height='140' width='140' class='circle' title='$user_name'></a></center>
<a href='user_profile.php?u_id=$user_id'><span class='black-text center'><h5><i class='fa fa-address-card teal-text'></i> $user_name</h5></span>
</div></div>";
if($i%2==0)
echo"</div><br><div class='row'>";
$i++;

}
}






function user_profile()
{
	if(isset($_GET['u_id']))
	{
		global $con;
        $user_id=$_GET['u_id'];
        $select="select * from users where `user_id`='$user_id'";
        $run=mysqli_query($con,$select);
        $row=mysqli_fetch_array($run);
$id=$row['user_id'];
$name=$row['user_name'];
$describe_user=$row['describe_user'];
$country=$row['user_country'];
$image=$row['user_image'];
$register_date=$row['user_reg_date'];
$gender=$row['user_gender'];

echo "<center>
<img src='users/$image' width='150' height='150' class='circle'></center>
<table class='striped responsive-table'>
<tbody>
<tr><td><h6>  Name</h6></td><td>$name</td></tr>
<tr><td><h6> Gender</h6></td><td>$gender</td></tr>
<tr><td><h6> Country</h6></td><td>$country</td></tr>
<tr><td><h6> Description</h6></td><td>$describe_user</td></tr>
<tr><td><h6> Member since</h6></td><td>$register_date</td></tr>
</tbody>
</table></center>
";


	}
}

?>
