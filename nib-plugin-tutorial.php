<?php
/*
Plugin Name: NIB Plugin Framework Tutorial
Plugin URI: https://github.com/davidjbeveridge/NerdyIsBack-Plugin-Tutorial
Description: This plugin is a (bad) tutorial on using the NerdyIsBack Plugin Framework (https://github.com/davidjbeveridge/NerdyIsBack-Plugin-Framework)
Author: David Beveridge
Author URI: http://nerdyisback.com
License: MIT
*/

/*	Copyright (c) 2010 David Beveridge

	Permission is hereby granted, free of charge, to any person obtaining a copy
	of this software and associated documentation files (the "Software"), to deal
	in the Software without restriction, including without limitation the rights
	to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
	copies of the Software, and to permit persons to whom the Software is
	furnished to do so, subject to the following conditions:

	The above copyright notice and this permission notice shall be included in
	all copies or substantial portions of the Software.

	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
	THE SOFTWARE.
*/

/**
 * Writing a WordPress Plugin on the NerdyIsBack Plugin Framework
 * By: David Beveridge <davidjbeveridge@gmail.com>, framework author
 * 
 * STANDARD PROCEDURE
 * 
 * As usual, go ahead and edit the header in this file so that WordPress know it's supposed to be
 * a plugin.  Don't forget to change the copyright notice to your name or company or whatever.
 * Also, since you're using my framework, you could mention my name, maybe?  Not strictly necessary,
 * but everyone like being appreciated...
 * 
 * SANITY CHECK
 * 
 * First of all, did you install the NerdyIsBack Plugin Framework? Moreover, did
 * you remember to activate the plugin?  If not, go do that right now so we don't
 * get a bunch of fatal errors when we activate this one.  Also, check the documentaion
 * to make sure you installed everything right.  You might want to include
 * that in YOUR documentation, btw.  Oh, and indicating somewhere that the
 * NerdyIsBack Plugin Framework is a dependency might be a good idea.
 * 
 * INTRO
 * 
 * Ok, let's talk a little about how this all works, then.  You may have noticed that
 * there are several subdirectories in this directory.  Hopefully, their names are
 * somewhat self-explanatory; if you're not familiar with MVC Architecture, I'm not sure
 * I'm qualified to teach it to you, but I'll brief you.  If you already know this, skip to
 * DIRECTORY STRUCTURE to save some time. MVC stands for Model-View-Controller; it's
 * a design pattern (actually, it's an architecture, or a specific combination of design
 * patterns) designed to separate your application (in this case, a WordPress plugin) into
 * very modular pieces.
 * 
 * 	-Models are supposed to encapsulate data access, whether it's with a database,
 * 	 a filesystem, or an external API.
 * 	-Views are what the User gets.  With web applications, you're likely to write your views
 *   in HTML/PHP, but there are cases where you'll want to use other formats like XML, JSON,
 *   or maybe something more complicated like PDF.
 *  -Controllers are responsible for controlling the application flow and user interaction.
 *   Please, try to control your surprise.  Controllers find out what the user is requesting,
 *   get data, do some processing, magic happens, etc., and then they load views and spit them
 *   back out at the user.
 * 
 * Once you wrap you mind around the concept, application development and maintanence become a
 * breeze.
 * 
 * DIRECTORY STRUCTURE
 * 
 * All that being said, this plugin has some directories your should know about:
 * 		/controller
 * 			This is where your Controller classes will live
 * 		/lib
 * 			This directory is for your code libraries.  Maybe you have one that does DB access
 * 			or something?
 * 			/vendor
 * 				This is where you put code libraries you didn't write.  Maybe you downloaded Smarty,
 * 				or some PEAR libraries, or something; I don't know.
 * 		/model
 * 			This is where your data model classes will live.
 * 		/plugin
 * 			This is where your plugin's resources will live:
 * 			/css
 * 				CSS you want to use
 * 			/js
 * 				JavaScript files you want to use
 * 			/images
 * 				images you want to use
 * 		/view
 * 			This is where views (of any type) live.  I recommend you add some subdirectories to break
 * 			things up a little more so you don't end up with a big ol' mess.
 * 
 * CONVENTIONS
 * 
 * To preface: I wrote several conventions into the NerdyIsBack Plugin Framework, mostly for ease of use,
 * and also to prevent you from having to create a large configuration file to make things work.  This may
 * be worked into a future release (j/k).  I have tried not to be terribly restrictive with any conventions,
 * nor to too strongly deviate from accepted norms in convention or practice among OO developers, though
 * I expect there will always be some contention on this manner; if you don't like these conventions, feel
 * free to create your own branch.
 * 
 * I use a few conventions in the framework you might like (or hate):
 * 
 * Class names are all UpperCamelCased
 * Object (instance) names are lowerCamelCased
 * Static methods use_underscores_in_their_names().  I'm not sure I remembered to adhere to this...
 * Files containing class definitions are named like ClassName.class.php because they're special.
 * Method/Function names are lowerCamelCased
 * Variable names are lowerCamelCased
 * private and protected members (vars and methods) are _prefixed() with an $_underscore.
 * Constants (declared in-class with const or otherwise defined()) SHOULD_BE_UPPERCASE_AND_USE_UNDERSCORES
 * I think tabs are easier to read than spaces, so I use tabs.
 * I prefer same-line curly braces( { ).  This means I write blocks like this:
 * 		if( condition ) {     <--- Curly brace goes here
 *         ...
 *      }
 * I put things in as many different files as possible, in case I want to access them from somewhere else.
 * I don't use Hungarian Notation because PHP's typing is too loose to care.
 * Comments are really good.
 * @todo JDoc-style comments are even better.
 * 
 * None of the above is a requirement, but it may be a qualifier for gold stars, brownie points, and riding
 * in the front seat.
 * 
 * In order for your plugin to work with the NerdyIsBack Plugin Framework, you MUST stick to the default
 * directory structure and follow the following naming conventions:
 * 
 * The name of your plugin's base class can be literally anything you want, but you MUST remember the name
 * you pass into the NIB_Plugin::instance() method.  This name will be the prefix that is used to instantiate
 * all of your classes.  Having such a prefix helps prevent namespace pollution.  Could we fix this by using
 * Namespaces? You bet, but then everyone would have to run >= PHP 5.3, so we are going to use prefixes.
 * 
 * Controllers and Models all get prefixed with something like 'MyPlugin_', where MyPlugin is the instance
 * name you passed to NIB_Plugin::instance().  They should also be suffixed with either '_Controller' or 
 * '_Model', respectively.  The name of the controller or model is just the name, though, as is this the
 * case with the file containing that class.  For example, if I want the 'Default' controller, it will be
 * in controllers/Default.php and the class name will be 'MyPlugin_Default_Controller'.
 * 
 * GETTING STARTED
 * 
 * I know, I know, you've been reading (or skipping) for over 100 lines and we're not started yet. So, what do
 * we need to do first?  Let's start by requiring all our dependencies.  This includes the class you will
 * be writing to encapsulate your plugin.  You should have this class in the 'plugin/' directory.  You
 * don't need to worry about including any of the NerdyIsBack Plugin Framework classes, as those should already
 * be loaded. 
 */

require_once(dirname(__FILE__).'/lib/MyPlugin.class.php');

/**
 * Since this is the simples plugin on the planet so far, that's the only dependency I have, but if you have
 * others, you should go ahead and include them, too.
 * 
 * Now, if you hadn't figured it out yet, I'm planning on using "MyPlugin" as the instance name, and therefore,
 * the prefix for everything under the sun.  Go ahead and open up lib/MyPlugin.class.php.  You can read the
 * comments I left in there, too.  How hard is it to write a plugin?  It's as easy as:
 */

NIB_Plugin(
	'MyPlugin', /* Instance Name/Prefix */
	'MyPlugin', /* Class name*/
	dirname(plugin_basename(__FILE__)) /* the name of the folder containing this plugin. */
);

/**
 * Wasn't that easy?  Now, technically, our plugin works, but it doesn't really do anything.  We should probably
 * figure out some way to interact with our users, don't you think?
 * 
 * CONTROLLERS
 * 
 * If we're going to interact with users, we're going to need a Controller.  Writing your first controller is really
 * easy; just create a new file in the controller subdirectory with a name like MyController.php, where
 * MyController is the controller name you want to use.  In that file, declare a new class, called
 * MyPlugin_MyController_Controller (remember that MyPlugin is our plugin's instance name), and make sure that it
 * extends NIB_Controller--otherwise it won't work correctly.  You'll also need to write two
 * methods: __construct() and index().  __construct() is the class's constructor (duh) and index() is the method
 * called if no other method name is passed.
 * 
 * __construct() needs to call parent::__construct() so it can take full advantage of NIB_Controller.  You can also
 * do anything else you want to in your constructor.  Maybe this constructor needs access-protection for all of its
 * methods? You can just write it in the constructor instead of doing it in every method.  Maybe you have a
 * composite view that is used by some or all of your methods? I'd use the constructor to store an instance of it
 * as a private member so you can access it from all the other methods.  Remember, don't repeat yourself; it's
 * redundant.  Remember, don't repeat yourself; it's redundant.
 * 
 * You might want to implement index() a little different, too.  The default implementation just throws a
 * warning telling you to re-implement the method.
 * 
 * So you've written a controller; now what?  How do you get in touch with the user?
 * 
 * For reference, and to better see how Controllers and Views interact, check out controller/Default.php
 * 
 * VIEWS
 * 
 * I have to say, I'm a little proud of the way I've done views here.  My implementation has two different
 * kinds of views: NIB_View and NIB_CompositeView (you can roll your own, too).  NIB_View objects just load
 * a template file and shove some variables into it.  This may well be sufficient for what you're doing.  If
 * so, kudos.  If not, try NIB_CompositeView.  It can have children.  And if any of them is a NIB_CompositView,
 * they can have children, too.  You can have your own little view family--or big view family.  And when you
 * attach a NIB_CompositeView, it takes care of the heavy lifting involved in display, too. Oh, did I mention
 * that you don't have to worry about variable scope? If a parent and a child template both have a variable named
 * $title, you don't have to worry about which is which--whatever you passed in is what you get out.  Take a look
 * at controller/Default and pay close attention to the constructor--it loads a composite view, and then index
 * attaches another view to it later.
 * 
 * Open up view/default/index.php and take a look at our template.  Pretty simple, no?  I've passed in one
 * variable, $title, which we display inside some markup.
 * 
 * Now take a look at view/wp/admin.php.  This template loads the WordPress Administration panel, so hang on to
 * it.  You may notice that right after it loads admin-header.php, it has a method call, $this->renderChildren().
 * All that method does is queues the NIB_CompositeView object to put the output from the children there.  If
 * you don't call $this->renderChildren, you won't get the output from the child views.
 * 
 * MODELS
 * 
 * So, we know how to catch a client request with a Controller and how to talk back with a view, but what if
 * we need data?  Short answer: write a Model.
 * 
 * I've left Models pretty much up to you to write.  I don't think that tightly coupling Models to a database
 * table is very useful in the context of WordPress, so if you want to couple them together, you can either
 * use good-old-fashioned SQL calls, or use a library like ActiveRecord (http://www.phpactiverecord.org/).
 * I personally don't care what you do, except to ask that you make your model conform to the directory structure
 * and naming conventions, and call the parent constructor.  You can have a look at model/Message.php for
 * an over-simplified example of a Model, and controller/Default.php's message() method to see it interact
 * with a controller.
 * 
 * TYING IT ALL TOGETHER
 * 
 * Ok, so now you've got all your Models, Views, and Controllers written, you've done unit testing, you've
 * consumed enough coffee to permanently change the color of your teeth and you're literally shaking with
 * anticipation to get your plugin finished. Or maybe that was a mild heart attack... oh, well.  Everything
 * about your plugin is perfect--immaculate, even.  Except for one gaping problem: you don't have any way of
 * getting users to your controller.  You, sir (or madam), need to tie into the WordPress Administration panel's
 * menu system.  Well, wouldn't you know it, I thought of that too.  There is a class included with the
 * NerdyIsBack Plugin Framework called NIB_WordPress_Menu, and it's already included if you remembered to activate
 * the NIB Plugin Framework plugin (there's a mouthful, right?).  You'll probably want to create some menu items,
 * and you should do that in this very file (or whatever file you're using as the plugin's main file.
 * 
 */

$MyPluginMenu = new NIB_WordPress_Menu(
	'MyPlugin',	// Menu title
	NIB_Plugin::instance('PostTypes')->adminURL('Default','index')	// URL, generated by a helper method.
);

$MyPluginMenu->addSubmenu(
	'User',	// Submenu Title
	NIB_Plugin::instance('PostTypes')->adminURL('Default','user','testuser') // URL, generated by helper method
);

/**
 * You may be saying to yourself: "David, you polluted the global scope! Why didn't you do that in a a function
 * or a singleton or something?"  You're absolutely right.  I just don't care very much, because this is a
 * tutorial.  Feel free to fix that.
 * 
 * So, what did we do?  We created an NIB_WordPress_Menu object and then added a submenu item to it.  Can you do
 * this same thing with a built-in WordPress function? Yes, but that would mean looking at the docs, so let's not.
 * NIB_WordPress_Menu::__construct() also takes parameters for capability, image, and position, which you might
 * want to look at (especially capability). Ditto for NIB_WordPress_Menu::addSubmenu().
 * 
 * There's a couple more notes you might wanna take, here.  First of all, did you notice how I made URL's?  I
 * used a helper method from the MyPlugin instance.  I defined it in NIB_Plugin, so don't worry about not
 * having defined it yourself.  This creates URL's that use NIB Plugin Framework's point-of-entry, wp-admin/nib.php.
 * Btw, you might wanna make sure your WP install actually has that file in the right place--sometimes the
 * NIB Plugin Framework plugin can't copy the file in there and you'll have to do it yourself.  There are two
 * separate helper methods for URL's: adminURL() and URL().  The difference?  adminURL() generates the
 * relative URI's necessary for the WP Admin Panel's menu system; URL() generates absolute URL's.
 * 
 * You should also take note of how I referenced the MyPlugin instance: I never store it in a variable.
 * NIB_Plugin::instance() remembers that I have an instance with that name stored already and just returns it,
 * so I can use the NIB_Plugin::instance() method to act on the plugin object.  Pretty handy, huh?
 * 
 * CONCLUSION
 * 
 * That's a really, really ridiculously basic tutorial on writing a plugin with the NerdyIsBack Plugin Framework.
 * Hopefully, this will save all of us a bunch of hassle writing more complex plugins for WordPress, and more
 * importantly, help cut down on the spaghetti-code I see in most of the plugins I've worked with (not that I'm
 * holding my breath).  If you have comments or free coffee/beer, drop me a line on my website, NerdyIsBack
 * (http://www.nerdyisback.com).
 * 
 * ADDITIONAL RESOURCES
 * 
 * WordPress Plugin Development:
 * 
 * WordPress.org: http://www.wordpress.org
 * WordPress Plugin API: http://codex.wordpress.org/Plugin_API
 * WP Plugin API Action Reference: http://codex.wordpress.org/Plugin_API/Action_Reference
 * WP Plugin API Filter Reference: http://codex.wordpress.org/Plugin_API/Filter_Reference
 * 
 * For more information about programming, design patterns, etc.:
 * 
 * The PHP Architect's Guide to PHP Design Patterns (by Jason E. Sweat): http://www.amazon.com/PHP-Architects-Guide-Design-Patterns/dp/0973589825
 * Design Patterns: Elements of Reusable Object-Oriented Software (Gang of Four book): http://www.amazon.com/Design-Patterns-Elements-Reusable-Object-Oriented/dp/0201633612
 * 
 * NOTES
 * 
 * Special Thanks to Benjamin West, who loaned me his copy of Design Patterns and has been an invaluable resource.
 * 
 */
	
