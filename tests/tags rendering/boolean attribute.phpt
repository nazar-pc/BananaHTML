--TEST--
Boolean attribute
--FILE--
<?php
include __DIR__.'/../bootstrap.php';
echo h::{'input[required]'}();
echo h::p(
	'Content',
	[
		'data-custom' => true
	]
);
?>
--EXPECT--
<input required type="text">
<p data-custom>Content</p>
