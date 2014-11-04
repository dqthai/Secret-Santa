<?php
$name = $_POST['name'];
$number = $_POST['number'];
	foreach(array_keys($_POST['name']) as $key) {
		echo "$name[$key] \n";
		echo "$number[$key] \n";
	}
	echo "hi there";
	mail( '4089812708@vtext.com', '', 'Testing');
?>
