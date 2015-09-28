--TEST--
With id and attribute: td#cell[colspan=2]
--FILE--
<?php
include __DIR__.'/../bootstrap.php';
echo h::{'td#cell[colspan=2]'}('Content');
?>
--EXPECT--
<td colspan="2" id="cell">Content</td>
