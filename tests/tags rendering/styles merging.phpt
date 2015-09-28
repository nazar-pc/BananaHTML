--TEST--
Styles merging (when one style is specified with tag name and second in extended form in array)
--FILE--
<?php
include __DIR__.'/../bootstrap.php';
echo h::{'div[style=color:red;]'}(
	'Content',
	[
		'style' => 'background:black;'
	]
);
?>
--EXPECT--
<div style="color:red;background:black;">Content</div>
