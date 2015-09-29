--TEST--
datalist, select, optgroup tags (extended form)
--FILE--
<?php
include __DIR__.'/../bootstrap.php';
echo h::datalist(
	[
		'in'    => [
			'first',
			'second'
		],
		'value' => [
			'value1',
			'value2'
		]
	],
	[
		'selected' => 'value2'
	]
);
echo h::select(
	[
		'in'    => [
			'first',
			'second'
		],
		'value' => [
			'value1',
			'value2'
		]
	],
	[
		'selected' => 'value2'
	]
);
echo h::optgroup(
	[
		'in'    => [
			'first',
			'second'
		],
		'value' => [
			'value1',
			'value2'
		]
	]
);
?>
--EXPECT--
<datalist>
	<option value="value1">first</option>
	<option selected value="value2">second</option>
</datalist>
<select>
	<option value="value1">first</option>
	<option selected value="value2">second</option>
</select>
<optgroup>
	<option selected value="value1">first</option>
	<option value="value2">second</option>
</optgroup>
