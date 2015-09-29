--TEST--
br
--FILE--
<?php
include __DIR__.'/../bootstrap.php';
echo h::br();
// 3 at once
echo h::br(3);
?>
--EXPECT--
<br>
<br>
<br>
<br>
