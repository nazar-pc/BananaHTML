--TEST--
Chained tags (complex case with elements of different types: string and associative arrays)
--FILE--
<?php
include __DIR__.'/../bootstrap.php';
echo h::{'tr.row td.cs-left[style=text-align:left;][colspan=2]'}(
	'First cell',
	[
		'Second cell',
		[
			'class'   => 'middle-cell',
			'style'   => 'color:red;',
			'colspan' => 1
		]
	],
	[
		'Third cell',
		[
			'colspan' => false
		]
	]
);
echo h::{'table thead tr td[colspan=2]'}();
?>
--EXPECT--
<tr class="row">
	<td class="cs-left" colspan="2" style="text-align:left;">First cell</td>
	<td class="cs-left middle-cell" colspan="1" style="text-align:left;color:red;">Second cell</td>
	<td class="cs-left" style="text-align:left;">Third cell</td>
</tr>
<table>
	<thead>
		<tr>
			<td colspan="2"></td>
		</tr>
	</thead>
</table>
