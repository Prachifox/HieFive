	<section class="slider">
    <ul class="slides">
      <li>
        <img src="images/slide3.jpg">

      </li>
      <li>

        <img src="images/slide2.jpg">

      </li>
      <li>

        <img src="images/slide1.jpg">
      </li>
      <li>

        <img src="images/slide4.jpg">

      </li>
  
    </ul>  </section>
        <div class="row">
             <div class="col s12 m6">
		<br><br><br>
		<br><br>
	<img src='images/back.jpg' class="responsive-img circle"></img>
</div>
	<!--Signup form-->
	 <div class="col s12 m6">
	 <section id="signup" class="section section-signup scrollspy">
	 	<div class="center">
	<h2>Create An Account</h2>
	<h6>Its free and always will be</h6>
</div>	<div id='form'>
		<form id='signup_form' method='post' action="">
			<table>
			<tr><td><input type="text" name="f_name" required='required' placeholder='First name'></td></tr>
			<tr><td><input type="text" name="l_name" required='required' placeholder='Last name'></td></tr>
			<tr><td><input type="password" name="u_pass" required='required' placeholder='Enter your password'></td></tr>
			<tr><td><input type="email" name="u_email" required='required' placeholder='Enter your email'></td></tr>
			<tr><td>
<select name="u_country">
<option>Select a country</option>		
<option>India</option>
<option>Pakistan</option>
<option>America</option>
<option>China</option>
<option>UK</option>
<option>France</option>
<option>Japan</option>
</select>
</td>
</tr>
<tr><td><select name='u_gender'>
<option>Select a gender</option>
<option>Male</option>
<option>Female</option>
<option>Others</option>
</select></td></tr>
<tr><td><input type="date" name="u_birthday" required='required' id="dob"><label for="dob">Date Of Birth</label></td></tr>
</table>
<center><input type="submit" name="sign_up" class='btn' value="Create An Account">
</center>
<?php include('users/insert_user.php');?>
</form>
</div>
</section>
</div>
</div>
</div>
        <div class="row">
             <div class="col s12 m5">
              <h4 class="center">
                <span class="teal-text"><br>Join the largest Social Network<br><br></span>Stay connected with friends from school,colleges and other universities 
              </h4>
          </div>

             <div class="col s12 m1">
             </div>
           <div class="col s12 m6">
           	<section id="login" class="section section-login scrollspy">
           	 <div class="center"> <h2>Login</h2></div>
           	<div class="card-panel grey lighten-2 black-text center">
	
		<div id='login_form'>
			<form method='post' id='login_form'>
				<table>
					<tr><td><input type="Email" name="email" placeholder='Enter your email' required='required'></td>
						<td><input type="Password" name="pass" placeholder='Enter your password' required='required'></td>
						<td><button id="btn1" name="login" class="btn large">Login</button></td></tr>
						<tr>
							<td colspan=2><a href="forgot_password.php"><center><div class='black-text'>Forgot Password?</div></center></a></td>
							</tr>
				</table>
			</form>
		</div>
		</div>
</div>
</section>

