--TEST--
Duplicated attributes (when one attribute is specified with tag name and second in extended form in array)
--FILE--
<?php
include __DIR__.'/../bootstrap.php';
echo h::{'div[test=x]'}(
	'Content',
	[
		'test' => 'y'
	]
);
// With boolean `false` should be removed
echo h::{'div[test=x]'}(
	'Content',
	[
		'test' => false
	]
);
?>
--EXPECT--
<div test="y">Content</div>
<div>Content</div>
