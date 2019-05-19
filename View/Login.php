<div class="login_page">

	<div id="form">
		<h1 id="form_heading">Login</h1>
		<div class="form_field">

			<form class="loginForm" action="index.php" method="POST">
				<label for="username">Username:</label>
				<input type="text" id="username" name="username"  placeholder="Enter Username" required/>
				<label for="password">Password:</label>
				<input type="password" id="password" name="password" placeholder="Enter Password" minlength="8" required/>

				<input type="submit" id="loginButton" name="loginButton" class="btn" value="Login">


			</form>
			<a href="/assignment_2/index.php?register=1">
				<button value="Register">Register</button>
			</a>
		</div>
	</div>
</div>