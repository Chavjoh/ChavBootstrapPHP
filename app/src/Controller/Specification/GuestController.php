<?php
namespace Controller\Specification;

use Core\AccessLevel;

abstract class GuestController extends AbstractController
{
	public function getAccessLevel()
	{
		return AccessLevel::GUEST;
	}
}