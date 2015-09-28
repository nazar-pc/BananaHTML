--TEST--
Several classes: p.cs-center.more
--FILE--
<?php
include __DIR__.'/../bootstrap.php';
echo h::{'p.cs-center.more'}('Content');
?>
--EXPECT--
<p class="cs-center more">Content</p>
