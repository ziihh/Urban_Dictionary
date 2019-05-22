<div class="Edit_Profile">
	<a href="/Urban_Dictionary/index.php">
		<button value="Home">Home</button>
	</a>

	<form class="editForm" method="POST" action="index.php">
		<h1> Update your profile </h1>

		<div class="inputFields">
			<label for="fName">First Name</label>
			<input class="updateFields" type="text" name="fname" id="fname" placeholder="Olav" value=<?php echo $data[0]->getFirstName() ?>>
		</div>

		<div class="inputFields">
			<label for="lName">Last Name</label>
			<input class="updateFields" type="text" name="lname" id="lname" placeholder="Foss" value=<?php echo $data[0]->getLastName() ?>>
		</div>


		<div class="inputFields">
			<label for="email">Email</label>
			<input class="updateFields" type="text" name="email" id="email" placeholder="Olav@hotmail.com" value=<?php echo $data[0]->getEmail() ?>>
		</div>


		<div class="inputFields">
			<label for="password">Old Password</label>
			<input class="updateFields" type="text" name="oldPass" id="oldPass" placeholder="*******">
		</div>

		<div class="inputFields">
			<label for="password">New Password</label>
			<input class="updateFields" type="text" name="newPass" id="newPass" placeholder="********">
		</div>

		<div class="input-group">
			<button type="submit" id="updateUser" name="updateUser">Update</button>
		</div>


	</form>


</div>