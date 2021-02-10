<?php  
	$title = "Login";
	function get_content() {
?>
    <link rel="stylesheet" href="/assets/css/login.css">
	<form class="col-md-6 mx-auto py-5" method="POST" action="/controllers/auth/login.php">
		<div class="login">

		 	<div class="divGroup glass">
		    <div class="welcomeHeader">
		      <h1 class="text-white">Welcome</h1>
		      <p class="text-white">-Unexpected Journey-</p>
		    </div>
		    
		    <div>
		      <input type="text" placeholder="Username" name="username" class="inputCustomStyle" required>
		    </div>
		    
		    <div>
		      <input type="password" name="password" class="inputCustomStyle" placeholder="password" required>
		    </div>

		    <div class="GlassButtons">
		      <button class="glassBtn">Login</button>
		      <button class="glassBtn"><a class="text-white" href="../../index.php">Return</a></button>
		    </div>	    
		  </div>
		</div>
	</form>

<?php  
	}
	require_once '../partials/layout.php';
?>
