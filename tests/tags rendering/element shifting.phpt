--TEST--
Element shifting for array iteration
--FILE--
<?php
include __DIR__.'/../bootstrap.php';
echo h::{'tr| td'}(
	[
		'First cell',
		'Second cell',
		'Third cell'
	]
);
?>
--EXPECT--
<tr>
	<td>First cell</td>
</tr>
<tr>
	<td>Second cell</td>
</tr>
<tr>
	<td>Third cell</td>
</tr>
