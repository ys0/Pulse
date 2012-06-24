<h3>Create a record</h3>

We are at the Creation part, it's so simple create an object after initialization of db and table, Pulse automatically get the columns and put it in the data array so you have only to fill it.

<pre>
//initialization (another way, using chaining)
//$myPulse = new Pulse()->setLink($link)->setDatabase('test')->setTable('people'); //yes it supports chaining but we talk about it after

$myPulse->data['name'] = 'oliver';
$myPulse->data['age'] = 27;

$myPulse->create();
</pre>

Or if you don't want to touch data directly you can do it passing an associative array [columns => values] as parameter.
(it's useful when you have an html form and you use names as data[name] data[age], in php you'll give $data = $_GET['data']; (or $_POST) to be passed to create)

<pre>
$myPulse->create($data);

if($myPulse->getLastError() == null) { //handling the error
	echo "ok, user created";
}
else {
	echo $myPulse->getLastError();
}
</pre>

In Pulse every $data will be secured before do a query. You can easily clone a record in this way

<pre>
$data = $myPluse->load('name', 'one')->read();
$myPulse->create($data);

//or smarter
$myPulse->create($myPluse->load('name', 'one')->read());
</pre>

Create a record has never been so easy