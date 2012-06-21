<?php 
	include 'Pulse.inc';
	
	/*
	 * $link = mysql_connect('localhost'. ''. '');
	 * mysql_select_db('test', $link);
	 */
	
	$myPulse = new Pulse(Array(
			'host' => 'localhost',
			'username' => '',
			'password' => '',
			'database' => 'test',
			'table' => 'people',
			//'link' => $link,
			//'column' => 'name',
			//'value' => 'ys0'
	));
	
	$myPulse->load('name', 'ys0');
	
	echo $myPulse->getLastQuery();
	echo $myPulse->getLastError();
	echo '<br/>';
	
	echo $myPulse->data['name'] . ' is ' . $myPulse->data['age'] . ' years old.';
	
	echo '<br/>';
	echo $myPulse->getLastQuery();
	echo $myPulse->getLastError();
	
	$myPulse->data['age'] = rand(10, 50);
	$myPulse->update();
	
	echo '<br/>';
	echo $myPulse->getLastQuery();
	echo $myPulse->getLastError();

	$newUser = new Pulse(Array(
			'link' => $myPulse->getLink(),
			'table' => 'people'
	));
	
	$newUser->data['name'] = 'one';
	$newUser->data['age'] = 27;
	
	$newUser->create();
	$newUser->create(); //ops i create 2 record
	
	echo '<br/>';
	echo $newUser->getLastQuery();
	echo $newUser->getLastError();
	
	print_r($newUser->getAll());
	
	$newUser->load('name', 'one'); //it load only the first record found
	$newUser->delete();
	
	echo '<br/>';
	echo $newUser->getLastQuery();
	echo $newUser->getLastError();
	
	print_r($newUser->getAll());
	
	/*
	 * $data = $pulse1->join($pulse2, 'field');
	 * $data = $pulse1->join(Array($pulse2, $pulse3), Array('field1', 'field2'));
	 */
?>