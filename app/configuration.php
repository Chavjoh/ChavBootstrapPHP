<?php
/**
 * Main configuration file
 *
 * @copyright Copyright (c) 2016
 * @author Johan Chavaillaz
 */

define("CONFIGURATION_FILE", "app/configuration.xml");

if (!file_exists(CONFIGURATION_FILE)) {
	throw new Exception("Need XML configuration file.");
}

// Get configuration content in XML
$configurationContentXML = file_get_contents(CONFIGURATION_FILE);
if ($configurationContentXML == "") {
	throw new Exception("Configuration file is empty.");
}

// Read XML file
$configurationXML = new SimpleXMLElement($configurationContentXML);

// Session configuration
session_name('ChavBootstrap');
session_start();

// Date and time configuration
date_default_timezone_set('Europe/Paris');

// Activation of the debug mode
define('DEBUG', (bool) $configurationXML->debug['active']);

// Version
define('VERSION', '1.0.0a');

// Password salt
define('PASSWORD_SALT', $configurationXML->salt['value']);

// Paths
define('PATH_COMPILE', 'app/compile/');
define('PATH_CACHE', 'app/cache/');
define('PATH_SKIN', 'public/');
define('PATH_LOG', 'app/log/');

// Database access information
define('DB_DRIVER', $configurationXML->database->driver);
define('DB_NAME', $configurationXML->database->name);
define('DB_USER', $configurationXML->database->user);
define('DB_PASSWORD', $configurationXML->database->password);
define('DB_HOST', $configurationXML->database->host);
define('DB_PORT', $configurationXML->database->port);
define('DB_PREFIX', $configurationXML->database->prefix);

// Default meta tags
define("DEFAULT_PAGE_NAME", $configurationXML->default->pageName);
define("DEFAULT_PAGE_DESCRIPTION", $configurationXML->default->pageDescription);
define("DEFAULT_PAGE_KEYWORDS", $configurationXML->default->pageKeywords);
define("DEFAULT_PAGE_ROBOTS", $configurationXML->default->pageRobots);
define("DEFAULT_PAGE_AUTHOR", $configurationXML->default->pageAuthor);

// Template information
define('TEMPLATE_DESIGN', 'template/design.tpl');
define('TEMPLATE_AJAX', 'template/ajax.tpl');

// Error reporting (Hard mode here :D)
error_reporting(E_ALL);

// PHP ini configuration
if (DEBUG)
{
	ini_set('display_errors', '1');
}
else
{
	ini_set('display_errors', '0');
	ini_set('log_errors', '1');
	ini_set('error_log', PATH_LOG.'php.log');
}
