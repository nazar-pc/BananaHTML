--TEST--
level
--FILE--
<?php
include __DIR__.'/../bootstrap.php';
echo h::{'p span'}('Content');
echo h::{'p[level=0] span'}('Content');
echo h::{'p[level=1] span'}('Content');
echo h::{'p[level=2] span'}('Content');
?>
--EXPECT--
<p>
	<span>Content</span>
</p>
<p><span>Content</span></p><p>
	<span>Content</span>
</p>
<p>
		<span>Content</span>
</p>
