<div class="summary">
	<div>
		<a href="/Urban_Dictionary/index.php">
				<button value="Home">Home</button>
		</a>
	</div>
	<div class="summaryList">

		<table>
			<tr>
				<th>Topic</th>
				<th class="verticalName"></th>

				<th>Nr of entries</th>

			</tr>
			<tr>
				<th><hr></th>
				<th><hr></th>
				<th><hr></th>
			</tr>

			<?php
				foreach ($data[0] as $topicName => $nrOfEntries) {
					echo "<tr>";
						echo "<th>" . $topicName . "</th>";
						echo "<th class=\"verticalName\"></th>";
						echo "<th>" . $nrOfEntries . "</th>";
					echo "</tr>";
					echo "<th><hr></th>";
					echo "<th><hr></th>";
					echo "<th><hr></th>";
				}

			?>

		</table>
	</div>
</div>