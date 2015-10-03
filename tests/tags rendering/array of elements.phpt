--TEST--
Array of elements (multidimensional array)
--FILE--
<?php
include __DIR__.'/../bootstrap.php';
echo "Case 1:\n";
echo h::a(
	[
		'Link 1',
		[
			'href' => 'url1'
		]
	],
	[
		'Link 2',
		[
			'href' => 'url2'
		]
	]
);
echo "Case 2:\n";
echo h::a(
	[
		'Link 1',
		[
			'href' => 'url1'
		]
	],
	[
		'Link 2',
		[
			'href' => 'url2'
		]
	],
	[
		'Link 3',
		[
			'href' => 'url3'
		]
	]
);
echo "Case 3:\n";
echo h::{'p a'}(
	[
		'Link 1',
		[
			'href' => 'url1'
		]
	],
	[
		'Link 2',
		[
			'href' => 'url2'
		]
	]
);
echo "Case 4:\n";
echo h::{'p a'}(
	[
		'Link 1',
		[
			'href' => 'url1'
		]
	],
	[
		'Link 2',
		[
			'href' => 'url2'
		]
	],
	[
		'Link 3',
		[
			'href' => 'url3'
		]
	]
);
?>
--EXPECT--
Case 1:
<a href="url1">Link 1</a>
<a href="url2">Link 2</a>
Case 2:
<a href="url1">Link 1</a>
<a href="url2">Link 2</a>
<a href="url3">Link 3</a>
Case 3:
<p>
	<a href="url1">Link 1</a>
	<a href="url2">Link 2</a>
</p>
Case 4:
<p>
	<a href="url1">Link 1</a>
	<a href="url2">Link 2</a>
	<a href="url3">Link 3</a>
</p>
