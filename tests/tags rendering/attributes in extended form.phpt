--TEST--
Attributes in extended form (array)
--FILE--
<?php
include __DIR__.'/../bootstrap.php';
echo h::{'h1.main-title'}(
	'Heading',
	[
		'title' => 'Some heading title'
	]
);
echo h::input(
	[
		'readonly'
	]
);
?>
--EXPECT--
<h1 class="main-title" title="Some heading title">Heading</h1>
<input type="text" readonly>
