--TEST--
Element shifting for array iteration with common attributes
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
			[
				'Second row',
				'Third row'
			],
			[
				'class' => 'cs-right'
			]
		]
	]
);
?>
--EXPECT--
<tr>
	<td>First row, first column</td>
	<td>First row, second column</td>
</tr>
<tr class="cs-right">
	<td>Second row</td>
	<td>Third row</td>
</tr>
