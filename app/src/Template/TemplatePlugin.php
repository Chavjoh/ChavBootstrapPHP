<?php
namespace Template;

use Utils\BBCode;
use Utils\DateTIme;
use Utils\I18n;

/**
 * Contains all plugins for Smarty
 *
 * @package Template
 * @author Johan Chavaillaz
 * @since 1.0.0
 */
class TemplatePlugin
{
	/**
	 * Plugin for plural form in Smarty templates
	 *
	 * @param array $parameters Parameters received from plugin call in template
	 * @param \Smarty $smarty Presently Smarty object
	 * @return string Singular or plural form depending on the value passed by parameter
	 */
	public static function pluginPlural($parameters, $smarty)
	{
		return I18n::plural($parameters['value'], $parameters['singular'], $parameters['plural']);
	}

	/**
	 * Plugin for security Smarty templates
	 *
	 * @param string $value Value received from plugin call in template
	 * @return string String processed and secured
	 */
	public static function pluginSecurity($value)
	{
		return nl2br(htmlentities($value, ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, "UTF-8"));
	}

	/**
	 * Plugin for formatting number in Smarty templates
	 *
	 * @param integer $value Value received from plugin call in template
	 * @return string Number formatted
	 */
	public static function pluginFormatNumber($value)
	{
		return number_format($value, 0, ',', ' ');
	}

	/**
	 * Show something if the "reference" and the "value" parameter are the same.
	 * By default, show the "selected" html tag for SelectBox.
	 *
	 * @param array $parameters Parameters received from plugin call in template
	 * @param \Smarty $smarty Presently Smarty object
	 * @return string The parameter to show
	 */
	public static function pluginConditional($parameters, $smarty)
	{
		if ($parameters['reference'] == $parameters['value'])
			return (isset($parameters['show'])) ? $parameters['show'] : ' selected="selected" ';

		return '';
	}

	/**
	 * Dispatch a number of seconds in days, hours, minutes and seconds
	 *
	 * @param integer $value Number of seconds
	 * @return string Dispatched and formatted time
	 */
	public static function pluginTime($value)
	{
		if (!empty($value))
			return DateTime::calculationTime($value);

		return '';
	}

	/**
	 * Show a formatted date (and time if "hour" parameter is true)
	 *
	 * @param array $parameters Parameters received from plugin call in template
	 * @param \Smarty $smarty Presently Smarty object
	 * @return string Formatted date
	 */
	public static function pluginDate($parameters, $smarty)
	{
		$enableHour = (isset($params['hour'])) ? (bool) $params['hour'] : true;
		return DateTime::printDate($parameters['timestamp'], $enableHour);
	}
	
	/**
	 * Show link to an internal page of the framework. 
	 * Add "active" style if it's the current page. 
	 * To add more style, define "class" parameter.
	 *
	 * @param array $parameters Parameters received from plugin call in template
	 * @param \Smarty $smarty Presently Smarty object
	 * @return string Link to the page in HTML
	 */
	public static function pluginLink($parameters, $smarty) 
	{
		$current = $smarty->getTemplateVars('page');
		$root = $smarty->getTemplateVars('root');
		$name = $parameters['name'] ?? '';
		$link = $parameters['link'] ?? '';
		$class = ($link == $current) ? 'active' : '';
		$class .= isset($parameters['class']) ? ' '.$parameters['class'] : '';
		return '<li class="'.$class.'"><a href="'.$root.$link.'">'.$name.'</a></li>';
	}
}