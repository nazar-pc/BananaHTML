## BananaHTML - single class that makes HTML generating easier

This is class for HTML code rendering in accordance with the standards of HTML5, and with useful syntax extensions for simpler usage

Banana means nothing, I just recalled minions from "Despicable Me" when creating this project.
<pre>
            ▀▄   █   ▄▀
           ▄▄▄█▄▄█▄▄█▄▄▄
        ▄▀▀═════════════▀▀▄
       █═══════════════════█
      █═════════════════════█
     █═══▄▄▄▄▄▄▄═══▄▄▄▄▄▄▄═══█
    █═══█████████═█████████═══█
    █══██▀    ▀█████▀    ▀██══█
   ██████   █▀█ ███   █▀█ ██████
   ██████   ▀▀▀ ███   ▀▀▀ ██████
    █══▀█▄    ▄██ ██▄    ▄█▀══█
    █════▀█████▀   ▀█████▀════█
    █═════════════════════════█
    █═════════════════════════█
    █═══════█▀█▀█▀█▀█▀█═══════█
    █═══════▀▄       ▄▀═══════█
   ▐▓▓▌═══════▀▄█▄█▄▀═══════▐▓▓▌
   ▐▐▓▓▌▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▄▐▓▓▌▌
   █══▐▓▄▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▄▓▌══█
  █══▌═▐▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▌═▐══█
  █══█═▐▓▓▓▓▓▓▄▄▄▄▄▄▄▓▓▓▓▓▓▌═█══█
  █══█═▐▓▓▓▓▓▓▐██▀██▌▓▓▓▓▓▓▌═█══█
  █══█═▐▓▓▓▓▓▓▓▀▀▀▀▀▓▓▓▓▓▓▓▌═█══█
  █══█▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓█══█
 ▄█══█▐▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▌█══█▄
 █████▐▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▌ █████
 ██████▐▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▌ ██████
  ▀█▀█  ▐▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▌   █▀█▀
         ▐▓▓▓▓▓▓▌▐▓▓▓▓▓▓▌
          ▐▓▓▓▓▌  ▐▓▓▓▓▌
         ▄████▀    ▀████▄
         ▀▀▀▀        ▀▀▀▀
</pre>

## Requirements:

* PHP 5.4+
* UPF (composer dependency)

## How to use?

Simply add dependency on `nazar-pc/bananahtml` to your project's `composer.json`:

```json
{
    "require": {
        "nazar-pc/bananahtml": "*"
    }
}
```

## Examples:

```php
<?php
//Much easier to write:)
use	nazarpc\BananaHTML as h;

echo h::p('Paragraph content');
// <p>Paragraph content</p>

echo h::{'a#github.cool-link.two-classes[href=http://github.com]'}(
	'GitHub',
	[
		'data-is-supported'	=> 'yes'
	]
);
//<a id="github" class="cool-link two-classes" href="http://github.com" data-is-supported="yes">GitHub</a>

echo h::{'ul.unordered-list li| span'}(
	'one',
	'two',
	'three'
);
//<ul class="unordered-list">
//	<li><span>one</span></li>
//	<li><span>two</span></li>
//	<li><span>three</span></li>
//</ul>
```

Examples are very trivial, just to explain the idea of generating HTML using basic CSS rules with some syntax extension - it is easy and natural.

For complete reference of possible features and syntax constructions look at `documentation.md` file.

## Contribution
Feel free to create issues and send pull requests, they are highly appreciated!

## License
MIT License, see license.txt