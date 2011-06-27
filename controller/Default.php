<?php
// Notice the "MyPlugin_" prefix and the "_Controller" suffix?
// NIB_Plugin needs those so it can find the class.
class MyPlugin_Default_Controller extends NIB_Controller	{
	
	private $_wpAdminView;
	
	// You need to define this, even though PHP is capable of instantiation without it.
	public function __construct($parent=null)	{
		// Always, always, always do this so you can properly inherit from NIB_Controller.
		parent::__construct($parent);
		
		
		// SAMPLE CODE:
		
		// We load the WordPress administration panel as a CompositeView and store the instance:
		$this->_wpAdminView = $this->createView('wp/admin',array('title'=>'Default::index'),'NIB_CompositeView');
		/*
		 * Did you notice how we used a third parameter? That's the class name you want to use for the view
		 * object.  If you don't specify one, createView() will create a NIB_View object (simple template view).
		 * NIB_CompositeView objects let us have child views.  Pretty cool stuff, huh?
		 */
		
		/*
		 * Then we attach that view to this controller with attachView().  That's what tells the controller
		 * to grab the output from the view and spit it out.
		 */
		$this->attachView($this->_wpAdminView);
		
	}
	
	// And you gotta define this one, too. It's the default method for our controller.
	public function index()	{
		
		// SAMPLE CODE:
		
		/*
		 * Our data is an associative array, where the key corresponds to a variable name used in the
		 * template.  So, if we use the 'message' key, it will be $message in the template.
		 */
		$data = array('message'=>'No other controller/method could be found.');

		// We create a view; we just want a simple template view, so no classname is specified.
		$view = $this->createView('default/index',$data);
		
		// Then we're going to add that child to 
		$this->_wpAdminView->addChild($view);
	}
	
	public function message()	{
		// Load the Message Model, call its getMessage method, and store it:
		$message = $this->model('Message')->getMessage();
		
		// We create a view; we just want a simple template view, so no classname is specified.
		// Our data is also passed as an array literal this time, just for fun.
		$view = $this->createView('default/index',array('message'=>$message));
		
		// Then we're going to add that child to 
		$this->_wpAdminView->addChild($view);
	}
	
}