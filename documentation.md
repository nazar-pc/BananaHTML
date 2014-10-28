### [Methods](#methods) [Tags rendering](#tags-rendering) [Special processing](#special-processing) [Pseudo-attributes](#pseudo-attributes) [Constants](#constants)

For shorter syntax in all examples alias `h` is used:

```php
<?php
use	nazarpc\BananaHTML as h;
```

<a name="methods" />
###[Up](#wrapper) Methods

h class has several general-purpose methods besides other "magic":
* prepare_url
* level

#### string prepare_url($url : string, $absolute = false : bool)
Adds, if necessary, slash or domain at the beginning of the url, provides correct absolute/relative url

#### string level($in : string, $level = 1 : int)
Line padding for a structured source code (adds tabs)

<a name="tags-rendering" />
###[Up](#wrapper) Tags rendering

Tags generation is done with the help of simplest CSS selectors and inexistent methods (magic with *__callStatic()*).

Let's consider how it works on examples.

#### Simplest:
```php
<?php
h::div('Content')
```
results
```html
<div>
	Content
</div>
```
#### With class:
```php
<?php
h::{'h1.cs-center'}('Content')
```
results
```html
<h1 class="cs-center">
	Content
</h1>
```
#### Even with several classes:
```php
<?php
h::{'p.cs-center.more'}('Content')
```
results
```html
<p class="cs-center more">
	Content
</p>
```
#### Attributes and id are also supported:
```php
<?php
h::{'td#cell[colspan=2]'}('Content')
```
results
```html
<td id="cell" colspan="2">
	Content
</td>
```
#### Some attributes does not require value:
```php
<?php
h::{'input#id[required]'}()
```
results
```html
<input id="id" required>
```
#### If id, classes and attributes are used together (in any combination) - order *tag/id/classes/attributes* is important:
```php
<?php
h::{'td#cell.table-cell.red[colspan=2][rowspan=3]'}('Content')
```
results
```html
<td id="cell" class="table-cell red" colspan="2" rowspan="3">
	Content
</td>
```
#### If tag is omitted - assumed that it is *div* tag:
```php
<?php
h::{'#element.class'}('Content')
```
results
```html
<div class="class" id="element">
	Content
</div>
```
#### Other attributes may be specified as well:
```php
<?php
h::{'h1.main-title'}(
	'Heading',
	[
		'title'	=> 'Some heading title'
	]
)
```
results
```html
<h1 class="main-title" title="Some heading title">
	Heading
</h1>
```
#### And, of course, it is possible to render chained tags at once:
```php
<?php
h::{'tr td'}('Content')
```
results
```html
<tr>
	<td>
		Content
	</td>
</tr>
```
But as you can see - spaces separates chained tags, and can't be used for attributes values in such css-like expression.

#### For many cases it is useful to work with "indexed" (!important) arrays:
```php
<?php
h::{'tr td'}([
	'First cell',
	'Second cell',
	'Third cell'
])
```
results
```html
<tr>
	<td>
		First cell
	</td>
	<td>
		Second cell
	</td>
	<td>
		Third cell
	</td>
</tr>
```
If array specified - latest tag will be generated for every element of array.

#### Naturally, if you do not get this list from somewhere, but write it from the beginning - you can write it without square braces:
```php
<?php
h::{'tr td'}(
	'First cell',
	'Second cell',
	'Third cell'
)
```
results
```html
<tr>
	<td>
		First cell
	</td>
	<td>
		Second cell
	</td>
	<td>
		Third cell
	</td>
</tr>
```
#### Again, naturally, elements may be not strings, but arrays (as it may be specified for one tag without array, recall additional attributes):
```php
<?php
h::{'tr.row td.cs-left[style=text-align:left;][colspan=2]'}(
	'First cell',
	[
		'Second cell',
		[
			'class'		=> 'middle-cell',
			'style'		=> 'color:red;',
			'colspan'	=> 1
		]
	],
	[
		'Third cell',
		[
			'colspan'	=> false
		]
	]
)
```
results
```html
<tr class="row">
	<td class="cs-left" colspan="2" style="text-align:left;">
		First cell
	</td>
	<td class="cs-left middle-cell" colspan="1" style="text-align:left;color:red;">
		Second cell
	</td>
	<td class="cs-left" style="text-align:left;">
		Third cell
	</td>
</tr>
```
There are several notices here:
* classes are joined together
* styles are also joined together, so, it is recommended do not emit trailing semicolon
* other attributes will be just replaced
* if attribute is set to boolean *false* - attribute will bot be rendered (string false, or just empty value will work fine)

#### One more trick (beyond CSS specification) is shifting of element for array iteration:
```php
<?php
h::{'tr| td'}([
	'First cell',
	'Second cell',
	'Third cell'
])
```
results
```html
<tr>
	<td>
		First cell
	</td>
<tr>
</tr>
	<td>
		Second cell
	</td>
<tr>
</tr>
	<td>
		Third cell
	</td>
</tr>
```
As you can see, pipe symbol *|* forces to generate new cells, rows, not columns. Such method does not allow to omit square braces. Other rules are the same.

#### Continuation of previous example - multidimensional array:
```php
<?php
h::{'tr| td'}([
	[
		'First row, first column',
		'First row, second column'
	],
	[
		'Second row, first column',
		'Second row, second column'
	]
])
```
results
```html
<tr>
	<td>
		First row, first column
	</td>
	<td>
		First row, second column
	</td>
<tr>
<tr>
	<td>
		Second row, first column
	</td>
	<td>
		Second row, second column
	</td>
<tr>
```
#### It is possible to render several elements from group with common attributes:
```php
<?php
h::{'tr| td'}([
	[
		'First row, first column',
		'First row, second column'
	],
	[
		[
			'Second row',
			'Third row'
		],
		[
			'class'	=> 'cs-right'
		]
	]
])
```
results
```html
<tr>
	<td>
		First row, first column
	</td>
	<td>
		First row, second column
	</td>
<tr>
<tr>
	<td class="cs-right">
		Second row, first column
	</td>
	<td class="cs-right">
		Second row, second column
	</td>
<tr>
```
<a name="special-processing" />
###[Up](#wrapper) Special processing

Some tags have special syntax features, that extends general rules described before, they are:
* br
* button
* datalist/select
* form
* img
* input
* style
* textarea
* Web Components

#### br
Does not follow general rules, accept as parameter only number (default 1) - how much times br tag should be rendered:
```php
<?php
h::br()
```
results
```html
<br>
```
This tag is unpaired, so, no close tag.
```php
<?php
h::br(3)
```
results
```html
<br><br><br>
```
#### button
Works by general rules, but if *type* attribute is not specified - it will be automatically set to *button*.

#### datalist/select
These tags have a little bit extended syntax. First parameter may be not a string, but array.

##### If array is indexed - elements of array will be generated as *option* tags (so, for rendering of several datalist/select tags with array it is necessary to take first parameter as array of array):
```php
<?php
h::select(
	[
		'first',
		'second'
	],
	[
		'selected' => 'second'
	]
)
```
results
```html
<select>
	<option value="first">
		first
	</option>
	<option selected value="second">
		second
	</option>
</select>
```
Also, here is used *selected* attribute, it is rendered as single, but specified with value (string, or even array). If *value* of arbitrary *option* tag is equal to *selected* value, corresponding attribute will be added (if attribute is not specified - *selected* will be added to the first *option* tag).

##### There is a little bit extended form, when value of *option* tag should be different from inner content:
```php
<?php
h::select(
	[
		'in'	=> [
			'first',
			'second'
		],
		'value'	=> [
			'value1',
			'value2'
		]
	],
	[
		'selected' => 'value2'
	]
)
```
results
```html
<select>
	<option value="value1">
		first
	</option>
	<option selected value="value2">
		second
	</option>
</select>
```
#### form
Works by general rules, but if *method* attribute is not specified - it will be automatically set to *post*, and if *method* is set to *post* - `form_csrf` method will be called in order to apply protection from *CSRF*.

#### img
Works by general rules, but if *alt* attribute is not specified - it will be automatically set to empty string.

#### input
Works by general rules, but:
* accepts one parameter or zero very often
* if *type* attribute is not specified - it will be automatically set to *text*
* behaves slightly different for different values of *type* attribute

##### Example of simplest input:
```php
<?php
h::{'input[name=login]'}()
```
results
```html
<input name="login" type="text">
```
##### Example of *checkbox* input:
```php
<?php
h::{'input[name=agree][type=checkbox][value=1][checked=1]'}()
```
results
```html
<input name="agree" checked type="checkbox" value="1"> 
```
If value of *value* attribute is equal to *checked*, corresponding attribute will be added.

##### Several checkboxes at once:
```php
<?php
h::{'input[type=checkbox][checked=1]'}([
	[
		'name'	=> 'check1',
		'value'	=> 1
	],
	[
		'name'	=> 'check2',
		'value'	=> 2
	]
])
```
results
```html
<input checked name="check1" type="checkbox" value="1"> 
<input name="check2" type="checkbox" value="2"> 
```
As we need indexed array to render several tags - we take all into additional square braces.

##### Usually checkboxes are accompanied with some short name (or description), so we can add it too:
```php
<?php
h::{'input[name=agree][type=checkbox][value=1][checked=1]'}([
	'in'	=> 'Checkbox #1'
])
```
results
```html
<input name="agree" checked type="checkbox" value="1"> Checkbox #1
```
##### Example of *radio* input:
```php
<?php
h::{'input[type=radio]'}([
	'checked'	=> 1,
	'value'		=> [0, 1],
	'in'		=> ['Off', 'On']
])
```
results
```html
<input type="radio" value="0"> Off
<input checked type="radio" value="1"> On
```
*checked* attribute works like for *checkbox* type, if *checked* attribute is not specified - *checked* will be added to the first element. *value* and *in* are specified in form of arrays.

#### style
Works by general rules, but if *type* attribute is not specified - it will be automatically set to *text/css*.

#### textarea
Works by general rules, but accepts input to be array of strings:
```php
<?php
h::textarea([
	'line1',
	'line2',
	'line3'
])
```
results
```html
<textarea>line1
line2
line3</textarea>
```

#### Web Components
This is a bit different, applied to any custom tags:
```php
<?php
h::custom_tag('text')
```
results
```html
<custom-tag>
	text
</custom-tag>
```

Basically, `_` being replaced by `-`.

<a name="pseudo-attributes" />
###[Up](#wrapper) Pseudo-attributes

Such attributes are not rendered as regular attributes, but they are used to make possible some functionality.
* add
* in
* level
* quote
* insert

#### add
Allows to add custom string to the end of attributes list before closing &gt;

#### in
Widely used pseudo attribute, it was already used in examples before. It contains content, which is placed between two pairs of tag. For example:
```php
<?php
h::{'p.cs-right'}('Content')
```
similar to
```php
<?php
h::p([
	'in'	=> 'Content',
	'class'	=> 'cs-right'
])
```
and results
```html
<p class="cs-right">
	Content
</p>
```
Also, as you can see, you can specify class or any other attribute in the first argument, if it is needed, or both, then they will be merged into one (twice declared classes and styles will be joined, other attributes replaced).

#### level
Special indentation attribute, in most cases it is not specified directly (and assumed equal to 1). The best way to show difference - examples:
```php
<?php
h::p('Content')
```
results
```html
<p>
	Content
</p>
```
But:
```php
<?php
h::{'p[level=0]'}('Content')
```
results
```html
<p>Content</p>
```
And:
```php
<?php
h::{'p[level=3]'}('Content')
```

results
```html
<p>
			Content
</p>
```

#### quote
Allows to change quotation symbol for attributes, " by default.

#### insert
This attribute may be or two-dimensional array. It is used for substituting values into attributes template. Example, how it works:
```php
<?php
h::a(
	'$i[text]',
	[
		'href'		=> 'Page/$i[id]',
		'insert'	=> [
			[
				'text'	=> 'Text1',
				'id'	=> 10
			],
			[
				'text'	=> 'Text2',
				'id'	=> 20
			]
		]
	]
)
```
results
```html
<a href="Page/10">
	Text1
</a>
<a href="Page/20">
	Text2
</a>
```
Or even more complex form:
```php
<?php
h::{'input[id=$i[id]][type=checkbox][checked=$i[value]][value=1]'}([
	'insert'	=> [
		[
			'id'	=> 'first_checkbox',
			'value'	=> 1
		],
		[
			'id'	=> 'second_checkbox',
			'value'	=> 0
		],
		[
			'id'	=> 'third_checkbox',
			'value'	=> 1
		]
	]
])
```
results
```html
<span>
	<input checked id="first_checkbox" type="checkbox" value="1"><label for="first_checkbox">
		&nbsp;
	</label>
</span>
<span>
	<input id="second_checkbox" type="checkbox" value="1"><label for="second_checkbox">
		&nbsp;
	</label>
</span>
<span>
	<input checked id="third_checkbox" type="checkbox" value="1"><label for="third_checkbox">
		&nbsp;
	</label>
</span>
```
As you can see, data inside template are accessible like through `$i` variable.

<a name="constants" />
###[Up](#wrapper) Constants

h class doesn't defines global constants by itself, but uses some optional constants that impacts on its behavior. As for now there is only one constant, that is used there:
* XHTML_TAGS_STYLE

#### XHTML_TAGS_STYLE
If this constant defined as *true* (default *false*) - resulting HTML will satisfy XHTML standards:
```php
<?php
h::{'input[required]'}()
```
results
```html
<input type="text" required="required" />
```
If not defined - `false` assumed
