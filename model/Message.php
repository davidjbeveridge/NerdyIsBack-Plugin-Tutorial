<?php

// Example Model class; note the use of the PluginName_ModelName_Model naming convention, and don't
// forget to extend NIB_Model
class MyPlugin_Message_Model extends NIB_Model	{
	
	const MESSAGE = 'My Custom message passed in from the model.';
	
	// Make sure to call parent::__construct() in your constructor.
	public function __construct()	{
		parent::__construct();
	}
	
	// Asenine function that returns a value.
	public function getMessage()	{
		return self::MESSAGE;
	}
	
}