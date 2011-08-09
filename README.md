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

[Silex]: http://silex-project.org/


Installation
============

1. Download and unpack this project
2. Make your own template.php - the only thing it needs is
   `<?php echo $content; ?>` where you want your content to go. You can add
   as many other variables as you like, just set them like:
   `$view->pageTitle = 'Hello world';` in your page. They'll be available in
   the template as, e.g. `$pageTitle`
3. Create your pages as usual, but at the top, add 
   `kisskiss-light.php`


Example
=======

Check the `example/` folder. There's both a template, and a normal page.

