--TEST--
Element shifting for array iteration (multidimensional array)
--FILE--
<?php
include __DIR__.'/../bootstrap.php';
echo h::{'tr| td'}(
	[
		[
			'First row, first column',
			'First row, second column'
		],
		[
			'Second row, first column',
			'Second row, second column'
		]
	]
);
?>
--EXPECT--
<tr>
	<td>First row, first column</td>
	<td>First row, second column</td>
</tr>
<tr>
	<td>Second row, first column</td>
	<td>Second row, second column</td>
</tr>
