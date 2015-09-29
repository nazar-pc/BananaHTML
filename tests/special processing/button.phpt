--TEST--
button (automatic `[type=button]` substitution if omitted)
--FILE--
<?php
include __DIR__.'/../bootstrap.php';
echo h::{'button[type=submit]'}();
echo h::{'button[type=button]'}();
echo h::button();
?>
--EXPECT--
<button type="submit"></button>
<button type="button"></button>
<button type="button"></button>
