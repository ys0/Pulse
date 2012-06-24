<h3>Getters and Setters</h3>

There are many Getter and Setter in Pulse cause the class respect the Information Hidding and some variable are private and not public.
In Pulse we can get/set the link, the columns, the table and the database.
We can only get the last query, the last mySQL error (if it happens) and the IDs of the table.
We can only set the query restriction.

<pre>
$link = $myPulse->getLink();
$myPulse->setLink($link);

$db = $myPulse->getDatabase();
$myPulse->setDatabase('database');

$table = $myPulse->getTable();
$myPulse->setTable('table');

$columns = $myPulse->getColumns();

$last_query = $myPulse->getLastQuery();
$last_error = $myPulse->getLastError();

$ids = $myPulse->getIDs();

$myPulse->where('age > 18'); //restrict query result
$myPulse->limit('0, 10'); //restrict query result

$myPulse->appendQuery('WHERE age > 10 LIMIT 0, 10'); //raw SQL appended at the end of query
</pre>

Whit this methods you can change all the options runtime.