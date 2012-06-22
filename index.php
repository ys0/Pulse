<?php 
	include 'Pulse.inc';
	
	function debug($pulse) {
		echo '<br/>';
		echo $pulse->getLastQuery();
		echo $pulse->getLastError();
		echo '<br/>';
	}
	
	/*
	 * $link = mysql_connect('localhost'. ''. '');
	 * mysql_select_db('test', $link);
	 */
	
// 	$myPulse = new Pulse(Array(
// 			'host' => 'localhost',
// 			'username' => '',
// 			'password' => '',
// 			'database' => 'test',
// 			'table' => 'people',
// 			//'link' => $link, 	
// 			//'column' => 'name',
// 			//'value' => 'ys0'
// 	));
	
// 	$myPulse->load('name', 'ys0');
// 	debug($myPulse);
	
// 	echo $myPulse->data['name'] . ' is ' . $myPulse->data['age'] . ' years old.';
// 	debug($myPulse);
	
// 	$myPulse->data['age'] = rand(10, 50);
// 	$myPulse->update();
// 	debug($myPulse);

// 	$newUser = new Pulse(Array(
// 			'link' => $myPulse->getLink(),
// 			'table' => 'people'
// 	));
	
// 	$newUser->data['name'] = 'one';
// 	$newUser->data['age'] = 27;
// 	$newUser->create();
// 	$newUser->create(); //ops i create 2 record
// 	debug($newUser);
// 	print_r($newUser->getAll());
	
// 	$newUser->load('name', 'one'); //it load only the first record found
// 	$newUser->delete();
// 	debug($newUser);
// 	print_r($newUser->getAll());
	
// 	$data = $pulse1->join($pulse2, 'field');
// 	$data = $pulse1->join(Array($pulse2, $pulse3), Array('field1', 'field2'));
// 	debug($newUser);
	
// 	$newUser->createDatabase('ganja');
// 	debug($newUser);
	
// 	$newUser->dropDatabase('puzza');
// 	debug($newUser);

	$myDB = new Pulse(Array(
		'host' => 'localhost',
		'username' => '',
		'password' => '',
		'database' => 'test'
	));

	$myDB->createTable('people2', Array(
			Array(
					'name' => 'id',
					'type' => 'INT',
					'option' => '11',
					'auto_increment' => true,
					'null' => false,
					'primary_key' => true
			),
			Array(
					'name' => 'name',
					'type' => 'VARCHAR',
					'option' => '30'
			),
			Array(
					'name' => 'age',
					'type' => 'INT',
					'option' => '3'
			),
	));
	
	debug($myDB);
	
	$myDB->dropTable('people2');
	
	debug($myDB);
?>