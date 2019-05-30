<div class="createEntry">
	<a href="/Urban_Dictionary/index.php">
		<button value="Home">Home</button>
	</a>
	<form name="test" class="createEntryForm" method="POST" action="index.php">

		<h1>Add an entry </h1>

		<div class="inputFields">
			<label>Entry name</label>
			<input id="inputFields" type="text" name="eName" id="eName" required>
		</div>
		<div class="inputFields">
			<label>Entry description</label>
			<input id="inputFields" type="text" name="eDesc" id="eDesc" required>
		</div>
		<label>Choose topic</label>


		<?php
			// View each topic as an option in add entry page.
			echo "<select id=\"topicsSelection\" name=\"topicsSelection\">";
			foreach ($data[0] as $topic) {
				echo "<option value=". $topic->getID() .">". $topic->getTopicName() ."</option>";
			}
			echo "</select>";
		?>

		<div class="input-group">
			<button type="submit" id="addEntry" name="addEntry" class="btn">Add</button>
		</div>
	 </form>
</div>

