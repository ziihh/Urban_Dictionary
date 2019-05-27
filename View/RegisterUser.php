<div class="createUser">
	<a href="/Urban_Dictionary/index.php">
			<button value="Home">Home</button>
	</a>
	<form name="test" class="registerForm" method="POST" action="index.php">
	<h1>Register </h1>

		<div class="input-group">
			<label>First name</label>
			<input id="inputFields" type="text" name="fname" id="fname" placeholder="John" required>
		</div>
		<div class="input-group">
			<label>Last name</label>
			<input id="inputFields" type="text" name="lname" id="lname" placeholder="Test" required>
		</div>
		<div class="input-group">
			<label>Username</label>
			<input id="inputFields" type="text" name="userr" id="userr" placeholder="Username123" required>
		</div>
		<div class="input-group">
			<label>Email</label>
			<input id="inputFields" type="email" name="email" id="email" placeholder="example@mail.com" required>

		</div>
		<div class="input-group">
			<label>Password</label>
			<input id="inputFields" type="password" name="password_1" id="password_1" placeholder="Minimum 8 characters" minlength="8" required>
		</div>
		<div class="input-group">
			<label>Confirm Password</label>
			<input  id="inputFields" type="password" name="password_2" id="password_2" minlength="8" required>
		</div>
		<div class="input-group">
			<button type="submit" id="registerUser" name="registerUser" class="btn">Register</button>
		</div>
	 </form>
</div>

