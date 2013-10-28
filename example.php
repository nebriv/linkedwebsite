<?php
include('settings.php');
include('loadprofile.php');
?>
<HTML>
<BODY>

<b>Example usage of LinkedIn Website Updater</b><br><hr> <br>
<?php
echo "<b>$fullname</b> <br />";
echo "<img src='$photo'> <br />";
echo "<br />";
?>

<?php
echo "<b>Profile Summary:</b> <br />";
echo $summary;
?>
<br><br>
<b>Employment Information</b>
<ul class="resume">
	<?php
	//Loop through the current employement information array
		$display = 3;
		$i = 0;
		while ($i <= $display){
			if ($job_current_array[$i] != "true"){
				echo "<li><b><span class='topic'>$job_title_array[$i] at $job_location_array[$i]</span></b> -- <span class='date'>$job_start_year_array[$i]-$job_end_year_array[$i]</span></li>";
				echo "<span class='description'>$job_description_array[$i]</span>";
			}else{
				// Just show "- Present" if currently employed here
				echo "<li><b><span class='topic'>$job_title_array[$i] at $job_location_array[$i]</span></b> -- <span class='date'>$job_start_year_array[$i]-Present</span></li>";
				echo "<span class='description'>$job_description_array[$i]</span>";
			}
			$i++;
		}
		echo "</ul>";
		echo "</td>";
	?>
</ul>

<br>
<b>Skill Listing</b>
<table class="table" border="0" width="20%" cellpadding="3" cellspacing="3">
	<tr>
		<?php
			$totalCount = $total_skills;
			// $colMax sets the number of columns in the list of skills.
			$colMax     = 8;
			$colcount   = ceil($totalCount / $colMax);
			$counter = 0;
			echo "<td>";
			echo "<ul class='header'>";
			for($i=0;$i<$totalCount;$i++){
				if ($counter < $colMax){
					echo "<li>$skill_array[$i]</li>";
				}else{
					$counter = 0;
					echo "</ul>";
					echo "</td>";
					echo "<td>";
					echo "<ul class='header'>";
					echo "<li>$skill_array[$i]</li>";
				}
				$counter++;
			}
			echo "</ul>";
			echo "</td>";
		?>
	</tr>
</table>
<br>
<b>Course Listing</b>
<table class="table" border="0" width="20%" height="120px" cellpadding="3" cellspacing="3">
	<tr>
		<?php
			$totalCount = $total_courses;
			// $colMax sets the number of columns in the list of courses.
			$colMax     = 10;
			$colcount   = ceil($totalCount / $colMax);
			$counter = 0;
			echo "<td>";
			echo "<ul class='header'>";
			for($i=0;$i<$totalCount;$i++){
				if ($counter < $colMax){
					echo "<li>$course_array[$i]</li>";
				}else{
					$counter = 0;
					echo "</ul>";
					echo "</td>";
					echo "<td>";
					echo "<ul class='header'>";
					echo "<li>$course_array[$i]</li>";
				}
				$counter++;
			}
			echo "</ul>";
			echo "</td>";
		?>
	</tr>
</table>

<br>
<b>Certificate Listings</b>
<table class="table" border="0" width="20%" height="120px" cellpadding="3" cellspacing="3">
	<tr>
		<?php
			$totalCount = $total_certifications;
			// $colMax sets the number of columns in the list of certificates.
			$colMax     = 10;
			$colcount   = ceil($totalCount / $colMax);
			$counter = 0;
			echo "<td>";
			echo "<ul class='header'>";
			for($i=0;$i<$totalCount;$i++){
				if ($counter < $colMax){
					echo "<li>$certifications_array[$i]</li>";
				}else{
					$counter = 0;
					echo "</ul>";
					echo "</td>";
					echo "<td>";
					echo "<ul class='header'>";
					echo "<li>$certifications_array[$i]</li>";
				}
				$counter++;
			}
			echo "</ul>";
			echo "</td>";
		?>
	</tr>
</table>
