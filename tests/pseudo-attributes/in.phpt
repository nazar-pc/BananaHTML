--TEST--
in
--FILE--
<?php
include __DIR__.'/../bootstrap.php';
echo h::p(
	[
		'in'    => 'Content',
		'class' => 'cs-right'
	]
);
?>
--EXPECT--
<p class="cs-right">Content</p>
