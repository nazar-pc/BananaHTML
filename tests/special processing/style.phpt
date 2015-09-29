--TEST--
style (automatic `[type=text/css]` substitution if omitted)
--FILE--
<?php
include __DIR__.'/../bootstrap.php';
echo h::style('button{color:red;}');
?>
--EXPECT--
<style type="text/css">button{color:red;}</style>
