<h3>Create a Database</h3>

To create a database with pulse you have to connect to mysql with an authorized user.

<pre>
$myPulse->createDatabase('test');
</pre>

Pulse checks automatically IF NOT EXISTS a database witht he same name