--TEST--
form (automatic insertion of CSRF token)
--FILE--
<?php
include __DIR__.'/../bootstrap.php';
echo h::form();
?>
--EXPECT--
<form method="post">
	<input name="secret" type="hidden" value="CSRF token">
</form>
