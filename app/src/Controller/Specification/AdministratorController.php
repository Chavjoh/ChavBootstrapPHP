<?php
namespace Controller\Specification;

use Core\AccessLevel;

abstract class AdministratorController extends AbstractController
{
	public function getAccessLevel()
	{
		return AccessLevel::ADMINISTRATOR;
	}
}