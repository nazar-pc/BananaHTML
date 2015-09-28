--TEST--
No tag name (div assumed): #element.class
--FILE--
<?php
include __DIR__.'/../bootstrap.php';
echo h::{'#element.class'}('Content');
?>
--EXPECT--
<div class="class" id="element">Content</div>
