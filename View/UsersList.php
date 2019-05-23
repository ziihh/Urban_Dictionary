<div>
	<a href="/Urban_Dictionary/index.php">
			<button value="Home">Home</button>
	</a>
</div>
<div class="usersList">

	<table>
		<tr>
			<th>Username</th>
			<th class="verticalName"></th>

			<th>Delete</th>
			<th class="verticalName"></th>

			<th>Update</th>
		</tr>
		<tr>
			<th><hr></th>
			<th><hr></th>
			<th><hr></th>
			<th><hr></th>
			<th><hr></th>
			<th><hr></th>
		</tr>
		<?php
			foreach ($data[0] as $user) {
				echo "<tr>";
					echo "<td>". $user->getUserName() ."</td>";
					echo "<th class=\"verticalName\"></th>";
					if($_SESSION["user"]->getUserName() != $user->getUserName()){

					echo "<td>
							<a href=\"/Urban_Dictionary/index.php?usersList=1&deleteUserId=". $user->getID() ."\">
								<button type=\"button\" class=\"btn\"><i class=\"fa fa-trash\"></i></button>
							</a>
						</td>";
					echo "<th class=\"verticalName\"></th>";
					echo "<td>
							<a href=\"/Urban_Dictionary/index.php?usersList=1&updateUserId=". $user->getID() ."\">
								<button type=\"button\" class=\"btn\"><i class=\"fa fa-gear\"></i></button>
							</a>
						</td>";
					} else {

						echo "<td>
							<a href=\"/Urban_Dictionary/index.php?usersList=1\">
								<button type=\"button\" class=\"btn\"><i class=\"fa fa-lock\"></i></button>
							</a>
						</td>";
						echo "<th class=\"verticalName\"></th>";
						echo "<td>
							<a href=\"/Urban_Dictionary/index.php?usersList=1\">
								<button type=\"button\" class=\"btn\"><i class=\"fa fa-lock\"></i></button>
							</a>
						</td>";
					}

				echo "</tr>";
			}

		?>
	</table>
</div>
<?php

	if (isset($_GET["updateUserId"])){
		foreach ($data[0] as $user) {

			if($user->getID() == $_GET["updateUserId"]){


?>
				<div class="Edit_Profile">

					<form class="editForm" method="POST">
						<h1> Update your profile </h1>

						<div class="inputFields">
							<label for="fName">First Name</label>
							<input class="updateFields" type="text" name="fname" id="fname" placeholder="Olav" value=<?php echo $user->getFirstName() ?>>
						</div>

						<div class="inputFields">
							<label for="lName">Last Name</label>
							<input class="updateFields" type="text" name="lname" id="lname" placeholder="Foss" value=<?php echo $user->getLastName() ?>>
						</div>


						<div class="inputFields">
							<label for="email">Email</label>
							<input class="updateFields" type="text" name="email" id="email" placeholder="Olav@hotmail.com" value=<?php echo $user->getEmail() ?>>
						</div>

						<div class="inputFields">
							<label for="password">New Password</label>
							<input class="updateFields" type="text" name="newPass" id="newPass" placeholder="********">
						</div>

						<div class="input-group">
							<button type="submit" id="adminUpdateUser" name="adminUpdateUser">Update</button>
						</div>


					</form>


				</div>

<?php

		}
	}
}
?>