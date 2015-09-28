--TEST--
Classes merging (when one class is specified with tag name and second in extended form in array)
--FILE--
<?php
include __DIR__.'/../bootstrap.php';
echo h::{'div.first-class'}(
	'Content',
	[
		'class' => 'second-class'
	]
);
?>
--EXPECT--
<div class="first-class second-class">Content</div>
