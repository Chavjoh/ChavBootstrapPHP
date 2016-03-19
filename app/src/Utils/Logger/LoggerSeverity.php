<?php
namespace Utils\Logger;

use Utils\Enumeration;

/**
 * Enumeration of all possible severity for LoggerMessage
 *
 * @package Utils\Logger
 * @author Johan Chavaillaz
 * @since 1.0.0
 */
class LoggerSeverity extends Enumeration
{
	const __default = self::NOTICE;
	const NOTICE = 0;
	const SUCCESS = 1;
	const WARNING = 2;
	const ERROR = 3;
}