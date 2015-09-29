--TEST--
textarea (special processing)
--FILE--
<?php
include __DIR__.'/../bootstrap.php';
echo h::textarea('Content');
echo h::textarea(
	[
		'line1',
		'line2',
		'line3'
	]
);
?>
--EXPECT--
<textarea>Content</textarea><textarea>line1
line2
line3</textarea>
