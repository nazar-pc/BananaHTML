--TEST--
Empty body (including `false`)
--FILE--
<?php
include __DIR__.'/../bootstrap.php';
echo "1:\n";
echo h::div();
echo "2:\n";
echo h::div('');
// Boolean `false` is different case, it will not be rendered
echo "3:\n";
echo h::div(false);
echo "4:\n";
echo h::div(false, false);
echo "5:\n";
echo h::div(false, false, false);
echo "6:\n";
echo h::div([]);
echo "7:\n";
echo h::div(['']);
echo "8:\n";
echo h::div([false]);
echo "9:\n";
echo h::div([false, false]);
echo "10:\n";
echo h::div([false, false, false]);
?>
--EXPECT--
1:
<div></div>
2:
<div></div>
3:
4:
5:
6:
<div></div>
7:
<div></div>
8:
9:
10:
