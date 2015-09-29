--TEST--
Empty body (including `false`)
--FILE--
<?php
include __DIR__.'/../bootstrap.php';
echo h::{'div'}();
echo h::{'div'}('');
// Boolean `false` is different case, it will not be rendered
echo h::{'div'}(false);
?>
--EXPECT--
<div></div>
<div></div>
