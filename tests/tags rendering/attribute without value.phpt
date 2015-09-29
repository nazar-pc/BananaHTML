--TEST--
Attribute with no value: input#id[required]
--FILE--
<?php
include __DIR__.'/../bootstrap.php';
echo h::{'input[required]'}();
?>
--EXPECT--
<input required type="text">
