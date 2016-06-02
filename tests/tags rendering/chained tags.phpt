--TEST--
Chained tags: tr td
--FILE--
<?php
include __DIR__.'/../bootstrap.php';
echo h::{'tr td'}('Content');
echo h::{'tr td div'}('Content');
?>
--EXPECT--
<tr>
	<td>Content</td>
</tr>
<tr>
	<td>
		<div>Content</div>
	</td>
</tr>
