<div class="homeBody">
	<header>
	<h1>Urban dictionary</h1>
	<div class="user_options">
	<!--	<a href="login.html" class="user_login">
			<i class="glyphicon glyphicon-user"></i>


		</a>
	-->

		<!-- Checks if the user is logged in then show logout button -->
		<?php if(isset($_SESSION["user"])){ ?>
			<a href="/Urban_Dictionary/index.php?logout=1">
				<input type="button"  value="Logout">
			</a>
			<a href="/Urban_Dictionary/index.php?editprofile=1">
				<input type="button" value="Edit profile">
			</a>
			<a href="/Urban_Dictionary/index.php?createTopic=1">
				<input type="button" value="Create Topic">
			</a>
			<a href="/Urban_Dictionary/index.php?createEntry=1">
				<input type="button" value="Add an entry">
			</a>
		<?php } else { ?>  <!-- else show login button -->
			<a href="/Urban_Dictionary/index.php?login=1">
				<input type="button"  value="Login">
			</a>
		<?php }

			if(isset($_SESSION["user"]) && $_SESSION["user"]->getUserType() == "admin"){ ?>
				<a href="/Urban_Dictionary/index.php?usersList=1">
					<input type="button"  value="User list">
				</a>
				<a href="/Urban_Dictionary/index.php?summary=1">
					<input type="button"  value="Summary">
				</a>
	<?php	} ?>



		<input type="text" placeholder="Search..">
	</div>
	</header>

	<div class="grid">
		<div class="topics_container">
			<h2>Topics</h2>
			<hr>
			<div class="orderByOptions">
				<h3>Order by:</h3>
				<form method="POST" action="index.php">
					<select name="orderBy">
						<option value="text" selected="...">...</option>
						<option value="Popularity">Popularity</option>
						<option value="Chronological">Chronological</option>
					</select>
					<input type="submit" value="Order By"/>
				</form>
			</div>

			<hr>

			<div class="topics">
				<!--<form action="/action_page.php">
-->

				<?php
//					echo "<form method=\"POST\" action=\"\">";
//						echo "<select id=\"topicsSelection\" name=\"topicsSelection\">";
//						foreach ($data[0] as $topic) {
//
//
//							echo "<option value=". $topic->getID() .">". $topic->getTopicName() ."</option>";
//							if ($_SESSION["user"]->getUserType() == "admin") {
//							}
//						}
//						echo "</select>";
//					echo "</form>";

					//echo "<a href=\"/Urban_Dictionary/index.php?deleteTopic=1\">";
					//	echo "<button type=\"submit\" class=\"btn\"><i class=\"fa fa-trash\"></i></button>";
					//echo "</a>";

						foreach ($data[0] as $topic) {
							echo "<div>";
							echo "<form class=\"topicDeleteButton\" method=\"POST\" action=\"index.php\">";
								echo "<a href=\"/Urban_Dictionary/index.php?topicEntries=". $topic->getID()."\">";
									echo "<input class=\"topics\" type=\"button\" data-id=\"". $topic->getID() ."\" value=\"". $topic->getTopicName() . "\">";
								echo "</a>";

								// if user is logged and is either a admin or author. if an author then topic must be created by himself to gain delete functionality.
								if(isset($_SESSION["user"]) && ($_SESSION["user"]->getUserType() == "admin" || ($_SESSION["user"]->getUserType() == "author" && $topic->getUserID() == $_SESSION["user"]->getID()))){
									echo "<a href=\"/Urban_Dictionary/index.php?deleteTopic=". $topic->getID()."\">";
										echo "<button type=\"button\" class=\"btn\"><i class=\"fa fa-trash\"></i></button>";
									echo "</a>";
								}
							echo "</form>";
							echo "</div>";

						}

				?>
	<!--		  <input class="topics" type="button" name="gender" value="topic">
			  <input class="topics" type="button" name="gender" value="topic">
			  <input class="topics" type="button" name="gender" value="topic">
			  <input class="topics" type="button" name="age" value="topic">
			  <input class="topics" type="button" name="age" value="topic">

				</form> -->
			</div>
		</div>

		<div class="text_container">

			<?php
				if(sizeof($data) >= 2){
					foreach ($data[1] as $entry) {
						echo "<div class=\"sections\">";
							echo "<h2>". $entry->getEntryName() ."</h2>";
							echo "<p>" . $entry->getEntryDescription() . "</p>";
							echo "<p class=\"entryDate\"><small>" . $entry->getDate() . "</small></p>";
						echo "</div>";

						echo "<form class=\"entryDeleteButtonForm\" method=\"POST\" action=\"index.php\">";
							// if user is logged and is either a admin or author. if an author then topic must be created by himself to gain delete functionality.
							if(isset($_SESSION["user"]) && ($_SESSION["user"]->getUserType() == "admin" || ($_SESSION["user"]->getUserType() == "author" && $entry->getUserID() == $_SESSION["user"]->getID()))){
								echo "<a href=\"/Urban_Dictionary/index.php?topicEntries=". $_GET["topicEntries"] ."&deleteEntry=". $entry->getID() ."\">";
									echo "<button type=\"button\" class=\"btn\"><i class=\"fa fa-trash\"></i></button>";
								echo "</a>";
							}
						echo "</form>";
						echo "<hr>";
					}
				} else {
					echo "<p>Please select the topic.</p>";
				}

			?>

		</div>
	</div>
</div>