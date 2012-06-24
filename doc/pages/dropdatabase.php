<h3>Drop a database</h3>

To delete a database with pulse you have to connect to mysql with an authorized user.

<pre>
$myPulse->dropDatabase('test');
</pre>

Pulse checks automatically IF EXISTS a database witht this name