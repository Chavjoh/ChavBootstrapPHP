<?php
namespace Controller;

use Controller\Specification\GuestController;
use Exception\CoreException;

class ErrorController extends GuestController
{
	/**
	 * Exception to manage
	 *
	 * @var CoreException
	 */
	protected $error;

	/**
	 * Not called by dispatcher (because error occurred)
	 */
	public function index()
	{
		// Nothing to do
	}

	/**
	 * Add the exception to manage
	 *
	 * @param CoreException $e Exception to manage
	 */
	public function setError(CoreException $e)
	{
		$this->error = $e;
	}

	/**
	 * @see AbstractController::getPageName()
	 */
	public function getPageName()
	{
		switch ($this->getClassName($this->error))
		{
			case "FileNotFoundException":
			case "ClassNotFoundException":
				return 'Page not found - '.parent::getPageName();
			default:
				return parent::getPageName();
		}
	}

	/**
	 * @see AbstractController::getPageContent()
	 */
	public function getPageContent()
	{
		switch ($this->getClassName($this->error))
		{
			case "FileNotFoundException":
			case "ClassNotFoundException":
				$this->template = 'not_found.tpl';
				break;
			default:
				$this->template='error.tpl';
				$this->smarty->assign('error', $this->error);
				break;
		}
		return parent::getPageContent();
	}

	/**
	 * @see AbstractController::getHeaders()
	 */
	public function getHeaders()
	{
		$newHeaders = array();
		switch ($this->getClassName($this->error))
		{
			case "FileNotFoundException":
			case "ClassNotFoundException":
				$newHeaders = array(
					$_SERVER["SERVER_PROTOCOL"]." 404 Not Found",
					"Status: 404 Not Found"
				);
				break;
		}
		return array_merge($newHeaders, parent::getHeaders());
	}

	private function getClassName($completeName)
	{
		$namePart = explode("\\", get_class($completeName));
		return $namePart[count($namePart)-1];
	}
}