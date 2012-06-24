<h3>Deleting a Record</h3>

If you understand how Pulse works you can guess how deletion is simply. To talk about it is more complicated than showing an example:

<pre>
$myPulse->load(10);
$myPulse->delete();

//or smarter
$myPulse->load(10)->delete();
</pre>

If you want to do it on many object:

<pre>
$myPulse->where('age < 18');

foreach($myPulse->getIDs() as $id){
	$myPulse->load($id)->delete();
}
</pre>

This is the powerful of Pulse, it's an adavanced CRUD (Create Read Update Delete) simply to use