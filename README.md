Simple templating for rapid prototyping. Requires PHP 5.3 (because of the closure). Based on the 
simple [template class][] by Chad Emrys Minick

[template class]: http://codeangel.org/articles/simple-php-template-engine.html


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
  rarely necessary. Consider using a static site generator like [Jekyll][], 
  [Piecrust][] or my own [Site-Builder][] instead. Web servers like Apache and
  nginx can serve flat HTML hundreds of times faster than generated PHP pages.

  Alternatively, you can run each page through PHP on the command-line and save
  the output as a `.html` file and serve that instead. That's effectively how
  static site generators work anyway.

[Silex]: http://silex.sensiolabs.org/
[Jekyll]: http://jekyllrb.com
[Piecrust]: http://bolt80.com/piecrust/
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


