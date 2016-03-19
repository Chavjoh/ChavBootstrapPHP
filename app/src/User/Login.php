<?php
namespace User;

use Core\AccessLevel;
use Exception\Error\InvalidLogonError;
use Utils\Database\Database;
use Utils\Security;

/**
 * Manage logging for the current user
 *
 * @package User
 * @author Johan Chavaillaz
 * @since 1.0.0
 */
class Login
{
	/**
	 * Indicate if the current user is logged in the BackEnd
	 *
	 * @return bool True if the current user is logged, False otherwise
	 */
	public static function isLogged()
	{
		if (isset($_SESSION['login']))
			return true;
		else
			return false;
	}

	/**
	 * Connect a user
	 *
	 * @param string $user User name
	 * @param string $password User password
	 * @throws InvalidLogonError Bad login or password
	 */
	public static function connect($user, $password)
	{
		// TODO
	}

	/**
	 * Disconnect user
	 */
	public static function disconnect()
	{
		session_unset();
	}

	/**
	 * @return Current access level of the user
	 */
	public static function getAccessLevel()
	{
		// TODO
		return AccessLevel::GUEST;
	}
}