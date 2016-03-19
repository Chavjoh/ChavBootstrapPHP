<?php
namespace Utils\Logger;

/**
 * Logger for message to the user and error backup
 *
 * @package Utils\Logger
 * @author Johan Chavaillaz
 * @since 1.0.0
 */
class Logger
{
	/**
	 * Log a message to show to the user
	 *
	 * @param LoggerMessage $message Message to show
	 */
	public static function logMessage(LoggerMessage $message)
	{
		if (!isset($_SESSION[__CLASS__]))
			$_SESSION[__CLASS__] = array();

		// Add the message to the session, to be show in the future
		array_push($_SESSION[__CLASS__], serialize($message));
	}

	/**
	 * Get message list to show to the user and delete them in memory.
	 *
	 * @return array List of LoggerMessage
	 */
	public static function getListMessage()
	{
		if (!isset($_SESSION[__CLASS__]))
			$_SESSION[__CLASS__] = array();

		// Prepare message list
		$list = array();

		// Retrieve message
		foreach ($_SESSION[__CLASS__] AS $message)
			array_push($list, unserialize($message));

		// Clear the session from old message
		$_SESSION[__CLASS__] = array();

		return $list;
	}

	public static function errorHandler($errorNumber, $errorString, $errorFile, $errorLine)
	{
		// TODO: Error Handler
	}

	public static function exceptionHandler($message, \Exception $e)
	{
		// TODO: Exception Handler
	}
}