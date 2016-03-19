<?php
namespace Core;

use Utils\Enumeration;

/**
 * Enumeration of all possible access level for users
 *
 * @package Utils\Logger
 * @author Johan Chavaillaz
 * @since 1.0.0
 */
class AccessLevel extends Enumeration
{
	const __default = self::GUEST;

	/**
	 * A visitor without account
	 */
	const GUEST = 0;

	/**
	 * A member with an account but no more rights
	 */
	const MEMBER = 10;

	/**
	 * An administrator can manage everything in the application
	 */
	const ADMINISTRATOR = 100;
}