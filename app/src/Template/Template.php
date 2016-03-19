<?php
namespace Template;
use Utils\Server;

/**
 * Factory class for Smarty
 *
 * @package Template
 * @author Johan Chavaillaz
 * @since 1.0.0
 */
class Template
{
	/**
	 * Smarty object for template management
	 *
	 * @var \Smarty
	 */
	protected static $smarty = null;

	/**
	 * Retrieve the Smarty object for template management
	 *
	 * @param string $templateDirectory Template include directory
	 * @param integer $cache Representing the validity term in seconds of the cache (-1 for an infinite period)
	 * @return \Smarty Smarty object for template management
	 */
	public static function getInstance($templateDirectory, $cache = 0)
	{
		static::createSmarty();

		// Active cache if requested
		static::cache($cache);

		// Set the template include directory
		static::$smarty->setTemplateDir($templateDirectory);

		// Return the instance of Smarty to manage templates
		return static::$smarty;
	}

	/**
	 * Create a new Smarty object with his configuration
	 */
	protected static function createSmarty()
	{
		static::$smarty = new \Smarty();

		// Set folder paths templates
		static::$smarty->setCompileDir(PATH_COMPILE);

		// Set folder path caches
		static::$smarty->setCacheDir(PATH_CACHE);

		// Make the compilation when a change is made in the debug mode
		static::$smarty->setCompileCheck(DEBUG);

		// Configure global variables
		static::$smarty->assign('root', Server::getBaseUrl());

		// Register special function for Smarty
		static::$smarty->registerClass("Login", "User\\Login");
		static::$smarty->registerPlugin("function", "plural", array('Template\TemplatePlugin', 'pluginPlural'));
		static::$smarty->registerPlugin("modifier", "security", array('Template\TemplatePlugin', 'pluginSecurity'));
		static::$smarty->registerPlugin("modifier", "number", array('Template\TemplatePlugin', 'pluginFormatNumber'));
		static::$smarty->registerPlugin("function", "date", array('Template\TemplatePlugin', 'pluginDate'));
		static::$smarty->registerPlugin("function", "conditional", array('Template\TemplatePlugin', 'pluginConditional'));
		static::$smarty->registerPlugin("function", "link", array('Template\TemplatePlugin', 'pluginLink'));
		static::$smarty->registerPlugin("modifier", "time", array('Template\TemplatePlugin', 'pluginTime'));
	}

	/**
	 * Activation of caching for the smarty instance if requested
	 *
	 * @param Integer $cache Representing the validity term in seconds of the cache (-1 for an infinite period)
	 */
	protected static function cache($cache)
	{
		// Active Smarty cache for a specified time or endless
		if ($cache > 0 OR $cache == -1)
		{
			static::$smarty->setCaching(true);
			static::$smarty->setCacheLifetime($cache);
		}
		else
			static::$smarty->setCaching(false);
	}
}