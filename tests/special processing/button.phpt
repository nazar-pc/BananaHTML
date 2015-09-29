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
<button type="submit">&nbsp;</button>
<button type="button">&nbsp;</button>
<button type="button">&nbsp;</button>
