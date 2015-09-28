--TEST--
Attribute with no value: input#id[required]
--FILE--
<?php
include __DIR__.'/../bootstrap.php';
echo h::{'input#id[required]'}();
?>
--EXPECT--
<input required id="id" type="text">
