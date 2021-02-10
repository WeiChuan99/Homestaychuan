<?php  
	$title = "Register";
	function get_content() {	
?>
	<form class="col-md-6 mx-auto py-5" method="POST" action="/controllers/auth/register.php">
    <link rel="stylesheet" href="/assets/css/register.css">
		<div class="Upper">

		 	<div class="divGroup glass">
		    <div class="welcomeHeader">
		      <h1 class="text-white">Welcome</h1>
		      <p class="text-white">-Unexpected Journey-</p>
		    </div>

		    <div>
		      <input type="text" name="firstname" class="inputCustomStyle" placeholder="Firstname">
		    </div>

		    <div>
		      <input type="text" name="lastname" class="inputCustomStyle" placeholder="Lastname">
		    </div>

		    <div>
		      <input type="text" placeholder="Username" name="username" class="inputCustomStyle">
		    </div>

		    <div>
		      <input type="email" placeholder="@Email" name="email" class="inputCustomStyle">
		    </div>

		    <div>
		      <input type="text" placeholder="Address" name="address" class="inputCustomStyle">
		    </div>
		    
		    <div>
		      <input type="password" name="password" class="inputCustomStyle" placeholder="password">
		    </div>

		    <div>
		      <input type="password" name="password2" class="inputCustomStyle" placeholder="Cofirm password">
		    </div>

		    <div class="GlassButtons">
		      <button class="glassBtn">Register</button>
		      <button class="glassBtn"><a class="text-white" href="../../index.php">Return</a></button>

		    </div>	    
		  </div>
		</div>
	</form>

<?php  
	}
	require_once '../partials/layout.php';
?>