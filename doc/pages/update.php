<h3>Updating a Record</h3>

The updating is easier than the creation of a record, you have only to load the object, change the data array and call the update method.

<pre>
$myPulse->load(10);

$myPuse->data['age'] = rand(1, 100);

$myPulse->update();
</pre>

In this way i update the age of the record with id 10, i in the age variable a random number between 1 and 100