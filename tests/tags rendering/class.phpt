--TEST--
With class: h1.cs-center
--FILE--
<?php
include __DIR__.'/../bootstrap.php';
echo h::{'h1.cs-center'}('Content');
?>
--EXPECT--
<h1 class="cs-center">Content</h1>
