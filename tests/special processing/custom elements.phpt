--TEST--
custom elements (with dash in tag name)
--FILE--
<?php
include __DIR__.'/../bootstrap.php';
echo h::custom_tag('Content');
echo h::{'custom-tag'}('Content');
echo h::my_element('Content');
echo h::{'my-element'}('Content');
?>
--EXPECT--
<custom-tag>Content</custom-tag>
<custom-tag>Content</custom-tag>
<my-element>Content</my-element>
<my-element>Content</my-element>
