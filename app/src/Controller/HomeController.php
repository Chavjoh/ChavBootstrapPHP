<?php
namespace Controller;

use Controller\Specification\GuestController;

class HomeController extends GuestController
{
	public function __construct(array $arguments)
	{
		parent::__construct($arguments);
		$this->template = "home.tpl";
	}

	/**
	 * @see Controller::index()
	 */
	public function index()
	{
		// Nothing to do
	}
}