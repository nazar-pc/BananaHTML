--TEST--
With attribute: td[colspan=2]
--FILE--
<?php
include __DIR__.'/../bootstrap.php';
echo h::{'td[colspan=2]'}('Content');
?>
--EXPECT--
<td colspan="2">Content</td>
