--TEST--
Chained tags with indexed arrays
--FILE--
<?php
include __DIR__.'/../bootstrap.php';
echo h::{'tr td'}(
	[
		'First cell',
		'Second cell',
		'Third cell'
	]
);
// Simplified form of the same thing
echo h::{'tr td'}(
	'First cell',
	'Second cell',
	'Third cell'
);
?>
--EXPECT--
<tr>
	<td>First cell</td>
	<td>Second cell</td>
	<td>Third cell</td>
</tr>
<tr>
	<td>First cell</td>
	<td>Second cell</td>
	<td>Third cell</td>
</tr>
