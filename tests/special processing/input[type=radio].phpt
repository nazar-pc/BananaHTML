--TEST--
input[type=radio] (special processing)
--FILE--
<?php
include __DIR__.'/../bootstrap.php';
echo h::{'input[name=agree][type=radio][value=1][checked=1]'}();
echo h::{'input[type=radio]'}(
	[
		'checked' => 1,
		'value'   => [0, 1],
		'in'      => ['Off', 'On']
	]
);
?>
--EXPECT--
<input checked name="agree" type="radio" value="1">
<input type="radio" value="0"> Off
<input checked type="radio" value="1"> On
