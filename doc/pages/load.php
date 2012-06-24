<h3>Load and Read Records</h3>

Ahhh, finally something concrete! Yeah, i know, may the initialization part might be boring but it is necessary.
After the Pulse initialization on a database and specific table (in our case 'person') you can load a mySQL record simply in many ways.
For example from the constructor:

<pre>
$myPulse = new Pulse(Array(
	'database' => 'test',
	'host' => 'localhost',
	'username' => '',
	'password' => '',
	'table' => 'test',
	'column' => 'name',
	'value' => 'ys0'
));
</pre>

Or i can load it via the method load:

<pre>
$myPulse = new Pulse(Array(
	'database' => 'test',
	'host' => 'localhost',
	'username' => '',
	'password' => '',
	'table' => 'test'
));

$myPulse->load('name', 'ys0');
</pre>

The load method can be used as Pulse constructor:

<pre>
$myPulse->load(Array(
	'column' => 'name',
	'value' => 'ys0'
));
</pre>

Anyhow, one loaded a record how can i read it? As you can imagine there isn't one only way.
You can use the method read that return an associative array [columns => values] as follows:

<pre>
$data = $myPulse->read();

//example 1
foreach(array_keys($data) as $column) {
	echo 'the column "' . $column . '" has value: " . $data[$column];
}

//example 2
echo $data['name'] . ' is ' . $data['age'] . ' years old.';
</pre>

The second way to read a loaded object is by the array data in the class directly

<pre>
$myPulse->read();

//example 1
foreach(array_keys($myPulse->data) as $column) {
	echo 'the column "' . $column . '" has value: " . $myPulse->data[$column];
}

//example 2
echo $myPulse->data['name'] . ' is ' . $myPulse->data['age'] . ' years old.';
</pre>

As you can see the load method load one only element, to read massive elements you have to know the method readAll that retunrs an Array of $data Arrays (one data for each record found).
Why this strange thing? Cause once you loaded an object you can update and delete it, you wont update a column for all object instead of one.
So to read all data we can do as follow:

<pre>
$array = $myPulse->readAll();

//example
foreach($array as $data){
	//example 1
	foreach(array_keys($data) as $column) {
		echo 'the column "' . $column . '" has value: " . $data[$column];
	}
	
	//example 2
	echo $data['name'] . ' is ' . $data['age'] . ' years old.';
}
</pre>

But if you wont read all the records you can restrict the query with some methods: append, limit, where (append is a generalization of limit and where)

<pre>
$myPulse->where('age > 10'); //it get only the records with age column's value > 10
$myPulse->limit('0, 3'); //it get only first 4 records

$array = $myPulse->readAll(); //it contains only 4 records with age > 10
</pre>

If you know some SQL you can do it with append more raw(rr):

<pre>
$myPulse->append('WHERE age > 10 LIMIT 0, 3');

$array = $myPulse->readAll(); //it contains only 4 records with age > 10
</pre>

Pulse have the autodetect of primary key, so if you omit the column it take it the primary key. In our case the primary key is 'id' so i'll lodad the item with id 10 in the next slice of code:

<pre>
$myPulse->load(10);

//or
$myPulse->load(Array('value' => 10));
</pre>

So you can use everything you have learned so far to do your first query with Pulse
