--TEST--
input[type=checkbox] (special processing)
--FILE--
<?php
include __DIR__.'/../bootstrap.php';
echo h::{'input[name=agree][type=checkbox][value=1][checked=1]'}();
// Multiple checkboxes at once
echo h::{'input[type=checkbox][checked=1]'}(
	[
		[
			'name'  => 'check1',
			'value' => 1
		],
		[
			'name'  => 'check2',
			'value' => 2
		]
	]
);
// With content
echo h::{'input[name=agree][type=checkbox][value=1][checked=1]'}(
	[
		'in' => 'Checkbox #1'
	]
);
?>
--EXPECT--
<input checked name="agree" type="checkbox" value="1">
<input checked name="check1" type="checkbox" value="1">
<input name="check2" type="checkbox" value="2">
<input checked name="agree" type="checkbox" value="1"> Checkbox #1
