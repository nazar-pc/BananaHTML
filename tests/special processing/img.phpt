--TEST--
img (automatic `alt` attribute insertion)
--FILE--
<?php
include __DIR__.'/../bootstrap.php';
echo h::img(
	[
		'src' => 'image.png'
	]
);
?>
--EXPECT--
<img alt="" src="/image.png">
