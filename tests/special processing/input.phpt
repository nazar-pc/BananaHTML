--TEST--
input (automatic `type` attribute insertion)
--FILE--
<?php
include __DIR__.'/../bootstrap.php';
echo h::{'input[name=login]'}();
echo h::{'input[name=password][type=password]'}();
echo h::{'label input[name=password][type=password]'}();
echo h::{'label input'}(['readonly' => true]);
echo h::{'label input'}();
?>
--EXPECT--
<input name="login" type="text">
<input name="password" type="password">
<label>
	<input name="password" type="password">
</label>
<label>
	<input readonly type="text">
</label>
<label>
	<input type="text">
</label>
