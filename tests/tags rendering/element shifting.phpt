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
echo h::{'table tr| td'}(
	[
		'x',
		'y',
		'z'
	],
	[
		'x',
		'y',
		'z'
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
<table>
	<tr>
		<td>x</td>
		<td>y</td>
		<td>z</td>
	</tr>
	<tr>
		<td>x</td>
		<td>y</td>
		<td>z</td>
	</tr>
</table>
