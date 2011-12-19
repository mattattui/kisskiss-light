Simple templating. Requires PHP 5.3 (because of the closure). Based on the 
simple [template class][1] by Chad Emrys Minick

[1]: http://codeangel.org/articles/simple-php-template-engine.html


What does(n't) it do?
=====================

* Lets you wrap your pages in a simple template with just one line of PHP.
* Allows you to set other variables, handy for things like page title.
* Doesn't get in your way at all. Just `<?php require('kisskiss-light.php'); ?>`
  and start writing.
* No automatic output escaping. There's a shortcut to `htmlspecialchars()`
  that you can use in your template files, called `e()`.
* Not designed with complex uses in mind. If you want to do more than wrap
  plain HTML content in a simple template, you're on your own. It might 
  work, but that's not really what this is for. If you want a 
  micro-framework, try [Silex][]
* Dynamically embeds the content in the template for every web request. This is
  rarely necessary, but it's very easy & common. The alternative is to embed the 
  content in the template only once when you change the content or the template,
  then save the output to HTML files and upload those. Web servers can serve 
  flat HTML files many times faster than running PHP scripts, and automatically
  set headers that make web browsers and servers run more efficiently. If you 
  don't update your content often, you have a busy site, or don't need to use
  dynamic templating, this approach is much better. [Site-builder][] is a free
  project that uses the same kind of templates as Kisskiss, so you can switch
  methods easily and see which approach works best for you.

[Silex]: http://silex-project.org/
[Site-builder]: https://github.com/inanimatt/site-builder

Installation
============

1. Download and unpack this project
2. Make your own `template.php` - the only thing it needs is
   `<?php echo $content; ?>` where you want your content to go. You can add
   as many other variables as you like, just set them like:
   `$view->pageTitle = 'Hello world';` in your page. They'll be available in
   the template as, e.g. `$pageTitle`
3. Create your pages as usual, but at the top, add 
   `<?php require('kisskiss-light.php'); ?>`


Example
=======

Check the `example/` folder. There's both a template, and a normal page.


How does it work?
=================

When you use the `require('kisskiss-light.php')` statement to load
kisskiss, it defines the template class, creates an object of that class
with some default options, sets a shutdown function, and then starts a PHP
output buffer. This captures all the output that happens afterward, 
including the rest of the content of your file.

When your file has finished being processed by PHP, the shutdown function
is called. It captures the content of the output buffer in a variable and
passes it to the template object that was created earlier. Finally it calls
the `render()` method on the template object, which loads the template file
and runs it as PHP, passing it the variables that have been set on it. As
long as your template outputs the `$content` variable, the content of your
page will be displayed in the template file you choose.


