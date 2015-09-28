--TEST--
Id, class and attributes used together: td#cell.table-cell.red[colspan=2][rowspan=3]
--FILE--
<?php
include __DIR__.'/../bootstrap.php';
echo h::{'td#cell.table-cell.red[colspan=2][rowspan=3]'}('Content');
?>
--EXPECT--
<td class="table-cell red" colspan="2" id="cell" rowspan="3">Content</td>
