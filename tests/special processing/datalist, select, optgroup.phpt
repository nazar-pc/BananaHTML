--TEST--
datalist, select, optgroup tags
--FILE--
<?php
include __DIR__.'/../bootstrap.php';
echo h::datalist(
	[
		'first',
		'second'
	],
	[
		'selected' => 'second'
	]
);
echo h::select(
	[
		'first',
		'second'
	],
	[
		'selected' => 'second'
	]
);
echo h::optgroup(
	[
		'first',
		'second'
	]
);
?>
--EXPECT--
<datalist>
	<option value="first">first</option>
	<option selected value="second">second</option>
</datalist>
<select>
	<option value="first">first</option>
	<option selected value="second">second</option>
</select>
<optgroup>
	<option selected value="first">first</option>
	<option value="second">second</option>
</optgroup>
