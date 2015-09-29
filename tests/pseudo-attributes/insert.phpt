--TEST--
insert
--FILE--
<?php
include __DIR__.'/../bootstrap.php';
echo h::a(
	'$i[text]',
	[
		'href'   => 'Page/$i[id]',
		'insert' => [
			[
				'text' => 'Text1',
				'id'   => 10
			],
			[
				'text' => 'Text2',
				'id'   => 20
			]
		]
	]
);
echo h::{'input[id=$i[id]][type=checkbox][checked=$i[value]][value=1]'}(
	[
		'insert' => [
			[
				'id'    => 'first_checkbox',
				'value' => 1
			],
			[
				'id'    => 'second_checkbox',
				'value' => 0
			],
			[
				'id'    => 'third_checkbox',
				'value' => 1
			]
		]
	]
);
?>
--EXPECT--
<a href="Page/10">Text1</a>
<a href="Page/20">Text2</a>
<input checked id="first_checkbox" type="checkbox" value="1">
<input id="second_checkbox" type="checkbox" value="1">
<input checked id="third_checkbox" type="checkbox" value="1">
