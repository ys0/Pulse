<h3>Tips and Tricks</h3>

I show in the doc how code smart with Pulse, it have the chaining, ever method that not returns nothing indeed returns the pulse object so you can concatenate methods in one line.
For example:

<pre>
$myPulse->create($myPluse->load('name', 'one')->read());

$myPulse = new Pulse()->setLink($link)->setDatabase('test')->setTable('people')->load(10);
</pre>

So you can make a smarter and clean code