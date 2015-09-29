--TEST--
quote
--FILE--
<?php
include __DIR__.'/../bootstrap.php';
echo h::{'p[data-title=Test]'}('Content');
echo h::{'p[data-title=Test]'}(
	'Content',
	[
		'quote' => "'"
	]
);
?>
--EXPECT--
<p data-title="Test">Content</p>
<p data-title='Test'>Content</p>
