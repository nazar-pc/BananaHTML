--TEST--
Chained tags: tr td
--FILE--
<?php
include __DIR__.'/../bootstrap.php';
echo h::{'tr td'}('Content');
?>
--EXPECT--
<tr>
	<td>Content</td>
</tr>
