--TEST--
With id: td#cell
--FILE--
<?php
include __DIR__.'/../bootstrap.php';
echo h::{'td#cell'}('Content');
?>
--EXPECT--
<td id="cell">Content</td>
