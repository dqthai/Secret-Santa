<?php
$name = $_POST['name'];
$number = $_POST['number'];
	foreach(array_keys($_POST['name']) as $key) {
		echo "$name[$key]";
		echo "$number[$key]";
	}
	echo "hi there";
?>
