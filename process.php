<?php
$name = $_POST['name'];
$number = $_POST['number'];
$people = array();

	foreach(array_keys($_POST['name']) as $key) {
	  $person = (object) array('name' => $name[$key], 'number' => $number[$key], 'giving_to' => Null);
	  $people[] = $person;
	  echo "$person->name  \n";
	}
//Assign user with their secret santa

$givers = $people;
$receivers = $people;

foreach ($givers as $name){
  $not_assigned = true;
  while($not_assigned){
    $choice = rand(0, sizeof($receivers)-1);
    if($name->name !== receivers[$choice]->name){
      $name->giving_to = recievers[$choice]->name;
      unset($receivers[$choice]);
      $receivers = array_values[$receivers];
      $not_assigned = false;
    } else {
      if(sizeof($receivers) == 1){
        $givers[$name]->giving_to = $givers[0]->giving_to;
        $givers[0]->giving_to = $givers[$name];
        $not_assigned = false;
      }
    }
    
  }
}
foreach($people as $person){
  echo "$person->name is giving to $person->giving_to\n"; 
}
?>
