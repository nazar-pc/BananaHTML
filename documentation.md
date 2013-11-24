### [Methods](#methods) [Tags rendering](#tags-rendering) [Special processing](#special-processing) [Pseudo-attributes](#pseudo-attributes) [Constants](#constants)

<a id="methods" />
###[Up](#wrapper) Methods

h class has several general-purpose methods besides other "magic":
* prepare_url
* level

#### string prepare_url($url : string, $absolute = false : bool)
Adds, if necessary, slash or domain at the beginning of the url, provides correct absolute/relative url

#### string level($in : string, $level = 1 : int)
Line padding for a structured source code (adds tabs)

<a id="tags-rendering" />
###[Up](#wrapper) Tags rendering

Tags generation is done with the help of simplest CSS selectors and inexistent methods (magic with *__callStatic()*).

Let's consider how it works on examples.

#### Simplest:

	h::div('Content')
results

	<div>
		Content
	</div>

#### With class:

	h::{'h1.cs-center'}('Content')
results

	<h1 class="cs-center">
		Content
	</h1>

#### Even with several classes:

	h::{'p.cs-center.more'}('Content')
results

	<p class="cs-center more">
		Content
	</p>

#### Attributes and id are also supported:

	h::{'td#cell[colspan=2]'}('Content')
results

	<td id="cell" colspan="2">
		Content
	</td>

#### Some attributes does not require value:

	h::{'input#id[required]'}()
results

	<input id="id" required>

#### If id, classes and attributes are used together (in any combination) - order *tag/id/classes/attributes* is important:

	h::{'td#cell.table-cell.red[colspan=2][rowspan=3]'}('Content')
results

	<td id="cell" class="table-cell red" colspan="2" rowspan="3">
		Content
	</td>

#### If tag is omitted - assumed that it is *div* tag:

	h::{'#element.class'}('Content')
results

	<div class="class" id="element">
		Content
	</div>

#### Other attributes may be specified as well:

	h::{'h1.main-title'}(
		'Heading',
		[
			'title'	=> 'Some heading title'
		]
	)
results

	<h1 class="main-title" title="Some heading title">
		Heading
	</h1>

#### And, of course, it is possible to render chained tags at once:

	h::{'tr td'}('Content')
results

	<tr>
		<td>
			Content
		</td>
	</tr>
But as you can see - spaces separates chained tags, and can't be used for attributes values in such css-like expression.

#### For many cases it is useful to work with "indexed" (!important) arrays:

	h::{'tr td'}([
		'First cell',
		'Second cell',
		'Third cell'
	])
results

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
If array specified - latest tag will be generated for every element of array.

#### Naturally, if you do not get this list from somewhere, but write it from the beginning - you can write it without square braces:

	h::{'tr td'}(
		'First cell',
		'Second cell',
		'Third cell'
	)
results

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

#### Again, naturally, elements may be not strings, but arrays (as it may be specified for one tag without array, recall additional attributes):

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
results

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
There are several notices here:
* classes are joined together
* styles are also joined together, so, it is recommended do not emit trailing semicolon
* other attributes will be just replaced
* if attribute is set to boolean *false* - attribute will bot be rendered (string false, or just empty value will work fine)

#### One more trick (beyond CSS specification) is shifting of element for array iteration:

	h::{'tr| td'}([
		'First cell',
		'Second cell',
		'Third cell'
	])
results

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
As you can see, pipe symbol *|* forces to generate new cells, rows, not columns. Such method does not allow to omit square braces. Other rules are the same.

#### Continuation of previous example - multidimensional array:

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
results

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

#### It is possible to render several elements from group with common attributes:

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
results

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
		</td class="cs-right">
		<td>
			Second row, second column
		</td>
	<tr>

<a id="special-processing" />
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

#### br
Does not follow general rules, accept as parameter only number (default 1) - how much times br tag should be rendered:

	h::br()
results

	<br>
This tag is unpaired, so, no close tag.

	h::br(3)
results

	<br><br><br>

#### button
Works by general rules, but if *type* attribute is not specified - it will be automatically set to *button*.

#### datalist/select
These tags have a little bit extended syntax. First parameter may be not a string, but array.

##### If array is indexed - elements of array will be generated as *option* tags (so, for rendering of several datalist/select tags with array it is necessary to take first parameter as array of array):

	h::select(
		[
			'first',
			'second'
		],
		[
			'selected' => 'second'
		]
	)
results

	<select>
		<option value="first">
			first
		</option>
		<option selected value="second">
			second
		</option>
	</select>
Also, here is used *selected* attribute, it is rendered as single, but specified with value (string, or even array). If *value* of arbitrary *option* tag is equal to *selected* value, corresponding attribute will be added (if attribute is not specified - *selected* will be added to the first *option* tag).

##### There is a little bit extended form, when value of *option* tag should be different from inner content:

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
results

	<select>
		<option value="value1">
			first
		</option>
		<option selected value="value2">
			second
		</option>
	</select>

#### form
Works by general rules, but if *method* attribute is not specified - it will be automatically set to *post*, and if *method* is set to *post* - *input[type=hidden][name=session]* with value of current user session id will be added automatically (as it is needed by security system of CleverStyle CMS).

#### img
Works by general rules, but if *alt* attribute is not specified - it will be automatically set to empty string.

#### input
Works by general rules, but:
* accepts one parameter or zero very often
* if *type* attribute is not specified - it will be automatically set to *text*
* behaves differently for different values of *type* attribute
* may be wrapped with *span* and accompanied with *label* tags

##### Example of simplest input:

	h::{'input[name=login]'}()
results

	<input name="login">

##### Example of *checkbox* input:

	h::{'input[name=agree][type=checkbox][value=1][checked=1]'}()
results

	<span>
		<input id="input_51961fc97fb6f" name="agree" type="checkbox" checked value="1"><label for="input_51961fc97fb6f">
			&nbsp;
		</label>
	</span>
If value of *value* attribute is equal to *checked*, corresponding attribute will be added, also label with empty inner content added (if no *id* specified - it is generated), and everything in wrapped by *span* (it is needed for jQuery UI, which is automatically applied).

##### Several checkboxes at once:

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
results

	<span>
		<input id="input_51961f99cb059" name="check1" checked type="checkbox" value="1"><label for="input_51961f99cb059">
			&nbsp;
		</label>
	</span>
	<span>
		<input id="input_51961f99cb1ad" name="check2" type="checkbox" value="2"><label for="input_51961f99cb1ad">
			&nbsp;
		</label>
	</span>

As we need indexed array to render several tags - we take all into additional square braces.

##### Usually checkboxes are accompanied with some short name (or description), so we can add it too:

	h::{'input[name=agree][type=checkbox][value=1][checked=1]'}([
		'in'	=> 'Checkbox #1'
	])
results

	<span>
		<input  checked id="input_51961eb6721e4" name="agree" type="checkbox" value="1"><label for="input_51961eb6721e4">
			Checkbox #1
		</label>
	</span>

##### Example of *radio* input:

	h::{'input[type=radio]'}([
		'checked'	=> 1,
		'value'		=> [0, 1],
		'in'		=> ['Off', 'On']
	])
results

	<input id="input_51962143488f1" type="radio" value="0"><label for="input_51962143488f1">
		Off
	</label>
	<input  checked id="input_5196214348a24" type="radio" value="1"><label for="input_5196214348a24">
		On
	</label>
*checked* attribute works like for *checkbox* type, if *checked* attribute is not specified - *checked* will be added to the first element. *value* and *in* are specified in form of arrays.

#### style
Works by general rules, but if *type* attribute is not specified - it will be automatically set to *text/css*.

#### textarea
Works by general rules, but accepts input to be array of strings:

	h::textarea([
		'line1',
		'line2',
		'line3'
	])

results

	<textarea>line1
	line2
	line3</textarea>

<a id="pseudo-attributes" />
###[Up](#wrapper) Pseudo-attributes

Such attributes are not rendered as regular attributes, but they are used to make possible some functionality.
* add
* in
* level
* data-title
* no-label
* quote
* insert

#### add
Allows to add custom string to the end of attributes list before closing &gt;

#### in
Widely used pseudo attribute, it was already used in examples before. It contains content, which is placed between two pairs of tag. For example:

	h::{'p.cs-right'}('Content')
similar to

	h::p([
		'in'	=> 'Content',
		'class'	=> 'cs-right'
	])
and results

	<p class="cs-right">
		Content
	</p>
Also, as you can see, you can specify class or any other attribute in the first argument, if it is needed, or both, then they will be merged into one (twice declared classes and styles will be joined, other attributes replaced).

#### level
Special indentation attribute, in most cases it is not specified directly (and assumed equal to 1). The best way to show difference - examples:

	h::p('Content')

results

	<p>
		Content
	</p>
But:

	h::{'p[level=0]'}('Content')

results

	<p>Content</p>
And:

	h::{'p[level=3]'}('Content')

results

	<p>
				Content
	</p>

#### data-title
If this attribute is specified - it value will be used in tooltip for specified element (with the help of jQuery plugin), attribute actually after some preprocessing will be present in resulting HTML, also class *cs-info* will be added automatically:

	h::p(
		'Text',
		[
			'data-title'	=> 'Tooltip'
		]
	)

results

	<p class="cs-info" data-title="Tooltip">
		Text
	</p>

#### no-label
Allows to cancel wrapping of checkboxes with &lt;label&gt;

#### quote
Allows to change quotation symbol for attributes, " by default.

#### insert
This attribute may be or two-dimentional array. It is used for substituting values into attributes template. Example, how it works:

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

results

	<a href="Page/10">
		Text1
	</a>
	<a href="Page/20">
		Text2
	</a>

Or even more complicated form:

	h::{'input[id=$i[id]][type=checkbox][checked1=$i[value]][value=1]'}([
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

results

	<span>
		<input checked1="1" id="first_checkbox" type="checkbox" value="1"><label for="first_checkbox">
			&nbsp;
		</label>
	</span>
	<span>
		<input checked1="0" id="second_checkbox" type="checkbox" value="1"><label for="second_checkbox">
			&nbsp;
		</label>
	</span>
	<span>
		<input checked1="1" id="third_checkbox" type="checkbox" value="1"><label for="third_checkbox">
			&nbsp;
		</label>
	</span>

As you can see, data inside template are accessible like through `$i` variable.

<a id="constants" />
###[Up](#wrapper) Constants

h class doesn't defines global constants by itself, but uses some optional constants that impacts on its behavior. As for now there is only one constant, that is used there:
* XHTML_TAGS_STYLE

#### XHTML_TAGS_STYLE
If this constant defined as *true* (default *false*) - resulting HTML will satisfy XHTML standards:

	h::{'input[required]'}()
results

	<input type="text" required="required" />
Option may be set in *config/main.php* file.