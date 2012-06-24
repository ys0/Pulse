<h3>Create a Table</h3>

Pulse can also manage the database and the tables not only records. You can create a table to make a simple setup of your applications.
It check by default IF NOT EXISTS a table with the same time to not overload it.

<pre>
	$myDB->createTable('people', Array(
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
					//'append' => 'other raw SQL'
			),
	));
</pre>

It's only a beta so i don't spend more words to describe it