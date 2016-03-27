<?php
namespace Core;

use Controller\ErrorController;
use Exception\CoreException;
use Exception\Runtime\ClassNotFoundException;
use Exception\Runtime\InvalidDerivationException;
use Exception\Runtime\PermissionException;
use User\Login;
use Utils\Server;
use Controller\Specification\AbstractController;

/**
 * Dispatcher (Router) class.
 *
 * Handle request and dispatch it to the corresponding controller
 *
 * @package Core
 * @author Johan Chavaillaz
 * @since 1.0.0
 */
class Kernel
{
	/**
	 * URL to compute
	 *
	 * @var string
	 */
	private $url;
	
	/**
	 * Current page
	 *
	 * @var string
	 */
	private $page;

	/**
	 * Controller object of the current page
	 *
	 * @var AbstractController
	 */
	private $controller = null;

	/**
	 * Create new Dispatcher with URL in parameter
	 *
	 * @param string $url Current URL to compute with Dispatcher
	 */
	public function __construct($url)
	{
		// Delete base url to compute correctly the called controller address
		$this->url = substr( $url, strlen(Server::getDirectoryScript()) );
	}

	/**
	 * Indicate if a redirection occurs
	 *
	 * @return bool True if the Controller make a redirection, False otherwise
	 */
	public function isRedirectHeaders()
	{
		foreach ($this->controller->getHeaders() AS $header)
		{
			if (preg_match('/^Location\:/', $header))
				return true;
		}

		return false;
	}

	/**
	 * Process URL and dispatch to controllers
	 */
	public function dispatch()
	{
		$this->url = trim($this->url, '/');

		// Get URL elements of current page
		if (empty($this->url))
			$url = array();
		else
			$url = explode('/', $this->url);

		$this->dispatchToController($url);

		// Get headers from current controller
		$headers = $this->controller->getHeaders();

		// If controller has sent some headers
		if (count($headers) > 0)
		{
			foreach ($headers AS $value)
				header($value);
		}
	}

	/**
	 * Dispatch user query in Controllers
	 *
	 * @param array $urlExplode Array of url composition
	 */
	private function dispatchToController($urlExplode)
	{
		// Get controller name
		$controllerName = array_shift($urlExplode);
		$this->page = $controllerName ?? 'Home';
		$controller = $this->page.'Controller';

		// Add prefix for namespace
		$controller = '\Controller\\'.$controller;

		try
		{
			// Call autoloader to search class
			if (!class_exists($controller))
				throw new ClassNotFoundException("The invoked class does not exist.");

			if (!in_array('Controller\Specification\Controller', class_implements($controller)))
				throw new InvalidDerivationException("The invoked class does not implement Controller interface.");

			// Get the position of the method in the URL
			$positionMethod = abs($controller::getMethodPosition($urlExplode));

			// Get method name of controller
			$method = $urlExplode[$positionMethod] ?? '';

			// Check availability of the method called
			if (!in_array($method, $controller::getMethodAvailable()))
			{
				$method = 'index';
				$arguments = $urlExplode;
			}
			else
			{
				// Delete the URL argument processed (method name)
				unset($urlExplode[$positionMethod]);
				$arguments = array_values($urlExplode);
			}

			// Create controller instance and call appropriate method
			$this->controller = new $controller($arguments);

			if (Login::getAccessLevel() < $this->controller->getAccessLevel())
				throw new PermissionException("The controller access level needed is not reached by current user.");

			$this->controller->$method();
		}
		catch (CoreException $e)
		{
			$this->controller = new ErrorController(array());
			$this->controller->setError($e);
		}
	}

	/**
	 * @return AbstractController Current page Controller
	 */
	public function getController()
	{
		return $this->controller;
	}

	/**
	 * @return string Current page name
	 */
	public function getPage()
	{
		return $this->page;
	}
}