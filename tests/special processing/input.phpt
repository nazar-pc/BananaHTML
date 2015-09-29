--TEST--
input (automatic `type` attribute insertion)
--FILE--
<?php
include __DIR__.'/../bootstrap.php';
echo h::{'input[name=login]'}();
echo h::{'input[name=password][type=password]'}();
?>
--EXPECT--
<input name="login" type="text">
<input name="password" type="password">
