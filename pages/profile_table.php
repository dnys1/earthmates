<!-- Scores explanation
<div class="panel panel-default">
	<div class="panel-heading">What Do Your Scores Mean?</div>
	<div class="panel-body">
		<p>In general, the scoring was designed to follow this pattern:</p>
		<ul>
			<li><b>Level 0:</b> </li>
			<li><b>Level 1:</b> </li>
			<li><b>Level 2:</b> </li>
			<li><b>Level 3:</b> </li>
			<li><b>Level 4:</b> </li>
			<li><b>Level 5:</b> </li>
		</ul>
	</div>
</div>
-->
<div class="panel panel-default">
				<div class="panel-heading">Competencies (Click for more information)</div>
				<table class="table table-hover profile-table">
					<thead>
						<tr>
							<th>#</th>
							<th>Competency</th>
							<th class="table-score">Score</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$competencies = getAllCompetencies();
						$index = 1;
						
						foreach ($competencies as $row)
						{
							$score = getAverageCompetencyScore($_SESSION['userID'], $row['ID']);
							
							if ($score >= 4)
								$bgClass = "success";
							else if ($score >= 1)
								$bgClass = "warning";
							else
								$bgClass = "danger";
							
							echo '<tr onclick="window.document.location=\'competency.php?id=' . $row['ID'] . "'\">\n";
							echo "<td>" . $index++ . "</td>\n";
							echo "<td>" . $row['Competency'] . "</td>\n";
							echo '<td class="table-score ' . $bgClass . '">' . number_format($score, 1) . "</td>";
							// echo '<td class="table-button"><a href="competency.php?id=' . $row['ID'] . '" class="btn btn-sm btn-default">More Information</a></td>';
							echo "</tr></a>\n";
						}
					?>
					</tbody>
				</table>
			</div>