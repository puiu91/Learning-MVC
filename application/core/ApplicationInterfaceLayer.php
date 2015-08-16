<?php

/**
 * Application interface layer is responsible for delegating the flow of 
 * control within the application based on requests invoked by user client
 * 
 */
class ApplicationInterfaceLayer
{
	/**
	 * URL request 
	 * @var null
	 */
	private $urlController = null;
	private $urlMethod     = null;
	private $urlParameter  = null;
	
	/**
	 * Starts application by disassembling the URL request and loading the appropriate controller, 
	 * invoking the appropriate method and its parameters (if requested)
	 * 
	 */
	public function __construct()
	{

		// disassembles the inbound URL request into its controller, method, and parameter parts
		$this->getUrlRequest();

		/**
		 * Debugging
		 */
		echobr('Controller');
		print_var($this->urlController);
		echobr('Method');
		print_var($this->urlMethod);
		echobr('Basename');
		var_dump(basename($_SERVER['PHP_SELF']));

		/**
		 * Load default controller otherwise load the controller corresponding to the client URL request
		 * 
		 */
		if (!$this->urlController) {

			require(APP_PATH . 'controllers/IndexController.php');
			$webpage = new IndexController;
			$webpage->index();

		} elseif (file_exists(APP_PATH . 'controllers/' . $this->urlController . '.php')) {

			// load the controller corresponding to the client URL request
			require(APP_PATH . 'controllers/' . $this->urlController . '.php');

			// instantiate the corresponding controller as an object
			$this->urlController = new $this->urlController;

			/**
			 * Invoke the method requested in the url for previously instantiated object, otherwise invoke
			 * default index() method in the controller
			 * 
			 */
			if (method_exists($this->urlController, $this->urlMethod)) {

				// debug
				// var_dump($this->urlController);
				// var_dump($this->urlMethod);

				/**
				 * Pass the parameters to the method if they exist otherwise invoke the method without parameters
				 * 
				 */
				if (!empty($this->urlParameter)) {
					// invoke the method and pass the parameters
					$this->urlController->{$this->urlMethod}($this->urlParameter);

					//debug 
					// echo "REQUESTED PARAMETERS: <br>";
					// var_dump($this->urlParameter);
				} else {
					$this->urlController->{$this->urlMethod}();
				}

			} else {
				/**
				 * Invoke the default index() method for the corresponding controller if no method was requested 
				 * otherwise redirect client to error page for tampering with the URL request
				 * 
				 */
				if ($this->urlMethod == null) {
					// invoke default index() method
					$this->urlController->index();
				} else {
					// redirect to error page
					// echo "REQUESTED METHOD DOES NOT EXIST";
				}
			}

		} else {
			// echo "TEST: " . $this->urlController;
			// redirect to error page
			// echo "CATASTROPHIC ERROR";
		}
	}

	/**
	 * Gets and prepares the URL request for the application interface layer
	 * 
	 * @return [type] [description]
	 */
	public function getUrlRequest()
	{
		// gets the physical address after the domain and stores as an array
		// example - gets /index/test/ from www.website.com/index/test 
		// [0] = ''
		// [1] = directory name
		// [2] = index.php (the front controller)
		// [3] = controller name
		// [4] = controller method (defaults to index() method of the controller if [4] is not specified)
		// [5] = parameter 1
		// [6] = parameter 2
		$url = explode('/', $_SERVER['REQUEST_URI']);
		// debug
		// echo "URL IS: <br>";
		// var_dump($url);
		
		// var_dump($url);
		

		// build url components - controller
		if (!empty($url[3])) {
			$this->urlController = ucfirst($url[3]) . "Controller";
		}

		// build url components - controller method
		if (isset($url[4])) {
			$this->urlMethod = $url[4];
		}

		// build url components - controller method parameters
		if (isset($url[5])) {
			$this->urlParameter = $url[5];
		}
	}
}

?>