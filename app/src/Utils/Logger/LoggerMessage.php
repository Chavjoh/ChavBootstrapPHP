<?php
namespace Utils\Logger;

/**
 * Representing a message to show to the user
 *
 * @package Utils\Logger
 * @author Johan Chavaillaz
 * @since 1.0.0
 */
class LoggerMessage
{
	/**
	 * Message to show to the user
	 *
	 * @var string
	 */
	protected $message;

	/**
	 * Severity of the message
	 *
	 * @var int
	 */
	protected $severity;

	/**
	 * Construct a message to show to the user
	 *
	 * @param string $message Message to show
	 * @param int $severity Severity of the message (provided by LoggerSeverity)
	 */
	public function __construct($message, $severity = null)
	{
		$this->message = $message;
		if (in_array($severity, LoggerSeverity::getConstList()))
			$this->severity = $severity;
		else
			$this->severity = LoggerSeverity::getDefault();
	}

	/**
	 * Message to show to the user
	 *
	 * @return string Message
	 */
	public function getMessage()
	{
		return $this->message;
	}

	/**
	 * Severity of the message.
	 * If not indicated, default severity defined in LoggerSeverity
	 *
	 * @return int Severity
	 */
	public function getSeverity()
	{
		return $this->severity;
	}

	/**
	 * Get CSS class corresponding to the severity
	 *
	 * @return string CSS Class
	 */
	public function getSeverityClass()
	{
		switch ($this->severity)
		{
			case LoggerSeverity::NOTICE:
				return 'alert alert-info';
			case LoggerSeverity::SUCCESS:
				return 'alert alert-success';
			case LoggerSeverity::WARNING:
				return 'alert';
			case LoggerSeverity::ERROR:
				return 'alert alert-error';
			default:
				return '';
		}
	}
}