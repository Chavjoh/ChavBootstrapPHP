<?php
namespace Controller;

use Controller\Specification\GuestController;

class AboutController extends GuestController
{
    public function __construct(array $arguments)
    {
        parent::__construct($arguments);
        $this->template = 'about.tpl';
    }

    /**
     * @see Controller::index()
     */
    public function index()
    {
        // Nothing to do
    }
}