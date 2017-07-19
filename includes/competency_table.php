<div class="panel panel-default">
	<!-- Default panel contents -->
	<div class="panel-heading">Competencies</div>
	<table class="table">
		<tr>
			<th>Competency</th>
			<th>Score</th>
			<th></th>
		</tr>
		<?php
			$competencies = getAllCompetencies();

			foreach ($competencies as $row)
			{
				$score = getAverageCompetencyScore($_SESSION['userID'], $row['ID']);
				
				echo "<tr>\n";
				echo "<td>" . $row['Competency'] . "</td>\n";
				echo "<td>" . $score . "</td>";
				echo '<td><a href="competency.php?id=' . $row['ID'] . '">More Information</a></td>';
				echo "</tr>\n";
			}
		?>
	</table>
</div>
</div>