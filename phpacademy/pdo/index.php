
<?php
include_once('../inc/header.php');

echo "<h1>Welcome to PDO (PHP Data Objects)</h1>";
echo "<h3>Tutorial by phpacademy!</h3>";


	$thArray = array("Sl #", "Item", "Link", "Tutorial Link");
	$itemArray = array(
		"PDO Connection", 
		'PDO Connection - with Debug',
		"PDO Select", 
		'PDO Fetch  Types',
		'PDO Fetch into a Class',
		'PDO Fetch All Results',
		'PDO Prepared Statements',
		'PDO Last Inserted Id',
		'PDO Getting Row Count',
		'PDO Delete (my own)',
		'PDO Restore DB Table (my own)'
	);

	$linkArray = array(
		"pdoConnection.php",
		"pdoConnection.php?debug=Yes",
		"pdoSelect.php",
		"pdoFetchTypes.php",
		"pdoFetchIntoAClass.php",
		"pdoFetchAllResults.php",
		"pdoPreparedStmt.php",
		"pdoLastInsertedId.php",
		"pdoGetRowCount.php",
		"pdoDelete.php",
		"pdoRestoreDB.php"
	);

	$tutVideoLinkArray = array(
		"https://buckysroom.org/videos.php?cat=90&video=19845",
		"",
		"https://buckysroom.org/videos.php?cat=90&video=19846",
		"https://buckysroom.org/videos.php?cat=90&video=19847",
		"https://buckysroom.org/videos.php?cat=90&video=19848",
		"https://buckysroom.org/videos.php?cat=90&video=19849",
		"https://buckysroom.org/videos.php?cat=90&video=19850",
		"https://buckysroom.org/videos.php?cat=90&video=19851",
		"https://buckysroom.org/videos.php?cat=90&video=19852",
		"",
		""
	);

?>
<table border=1>
	<tr>
		<?php
			foreach($thArray as $th) {
				echo "<th>" . $th . "</th>";
			}
		?>
	</tr>
	<?php
		for($i=1; $i<=count($itemArray); $i++) {
			echo "<tr>";
			echo "<td><center>" . $i. "</center></td>";
			echo "<td>" . $itemArray[$i-1]. "</td>";
			echo "<td><center>" . "<a href='".$linkArray[$i-1]. "'>Link</a>". "</center></td>";
			if(!empty($tutVideoLinkArray[$i-1])) {
				echo "<td><center>" . "<a href='".$tutVideoLinkArray[$i-1]. "'>Link</a>". "</center></td>";
			} else {
				echo "<td></td>";
			}
			echo "</tr>";
		}
	?>
</table>

<?php

	include_once('../inc/footer.php');
?>