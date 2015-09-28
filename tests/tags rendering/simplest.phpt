--TEST--
Simplest: div
--FILE--
<?php
include __DIR__.'/../bootstrap.php';
echo h::div('Content');
?>
--EXPECT--
<div>Content</div>
