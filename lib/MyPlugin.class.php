<?php
class MyPlugin extends NIB_Plugin	{
	
	public function __construct()	{
		/*
		 * This is where you should do all of your plugin's setup, register action hooks, or
		 * whatever else you think you should do on initialization.  Putting that code here
		 * helps to keep your variables out of the global scope.  Bear in mind that whatever
		 * you execute here is firing *before* WordPress's init action takes place, so you
		 * may need to defer the excecution of some parts of your plugin using WordPress's
		 * action hooks.  For further documentation, take a look at the WordPress Plugin API
		 * Documentation (http://codex.wordpress.org/Plugin_API), the WordPress Plugin API
		 * Action Reference (http://codex.wordpress.org/Plugin_API/Action_Reference),  and the
		 * WordPress Plugin API Filter Reference (http://codex.wordpress.org/Plugin_API/Filter_Reference).
		 * 
		 * Simple usage for firing an action:
		 * 
		 * add_action('hook_name','callback');
		 * 
		 * You can also use this with object methods by using an array callback:
		 * 
		 * add_action('plugins_loaded',array(&$this,'method_name'));
		 * 
		 * Make sure that if you do this, that the method passed as a callback is accessible
		 * outside the class (i.e. public).
		 */
	}
	
}