<h3>Initialization and Database Connection</h3>

In first we need to load the Pulse library, in our case it's located at '../Pulse.inc'

<pre>
&lt;?php
	include_once '../Pulse.inc';
?&gt;
</pre>

Now we can declare a variable in wich we load the Pulse class. When we load the class we must pass parameter to the constructor.
There are some ways to init Pulse, it depends if you want to use an external mySQL connection or not. Now we examine every case and consequences:

<pre>
mysql_select_db('test', mysql_connect('localhost'. ''. '')); //connecting to localhost mySQL server on the database 'test'

$myPulse = new Pulse(); //init Pulse (easiest way) no parameter passed to constructor
</pre>

Pulse will work in this case without handling mySQL error messages because no link was passed to constructor
You can add the mySQL error handling simply in this way:

<pre>
$link = mysql_connect('localhost'. ''. ''); //connecting to localhost mySQL server
mysql_select_db('test', $link); //on the database 'test'

$myPulse = new Pulse(Array(
	'link' => $link
)); //init Pulse passing the mySQL link to the constructor
</pre>

So you can se that Pulse constructor wont singular parameter as a normal function but he want an associative array
You can use the Pulse mySQL connection method to do it in another way:

<pre>
$myPulse = new Pulse();

$myPulse->connect('test', 'localhost, '', ''); //another parameter is table and it's optional
</pre>

But the Pulse developer thinks it's hard to remember the order of all parameter of many function so he enabled the associative array method to pass the parameter.
The last slice of code is equal to the next:

<pre>
$myPulse = new Pulse(Array(
	'database' => 'test',
	'host' => 'localhost',
	'username' => '',
	'password' => '' 
));
</pre>

In this way you initialize Pulse at once, but if we need the link? or we need to change it?

<pre>
$myPulse = new Pulse(Array(
	'database' => 'test',
	'host' => 'localhost',
	'username' => '',
	'password' => '' 
));

$link = $myPulse->getLink();

$link = $myPulse->setLink($another_link);
</pre>

Is not cute the way how Pulse do it at once? You can also select the table if you need to work on recordx in a table and not on the database structure:
How? if you understand the Pulse mechanism you might imagine how implement it.

<pre>
$myPulse = new Pulse(Array(
	'database' => 'test',
	'host' => 'localhost',
	'username' => '',
	'password' => '',
	'table' => 'test'
));

//$myPulse->connect('test', 'localhost, '', '', 'test'); //using connect method (the same with associative array method)

$myPulse->setTable('another_table');

echo $myPulse->getTable();
</pre>

We see after in the doc how to load objects from the database but it can be done dicrectly from the constructor in this way:

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

So it load in the database 'test' the record wich have the column 'name' as 'ys0'