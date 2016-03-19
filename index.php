<?php
/**
 * Landing page
 *
 * @copyright Copyright (c) 2016
 * @author Johan Chavaillaz
 */

use Template\Template;
use Core\Kernel;
use Utils\Server;

try
{
	require_once './vendor/autoload.php';
	require_once './app/configuration.php';

	// Handle request and dispatch it to the appropriate controller
	$kernel = new Kernel($_SERVER['REQUEST_URI']);
	$kernel->dispatch();

	// Don't show the page if we make a redirection
	if (!$kernel->isRedirectHeaders())
	{
		// Check request type to select appropriate template
		$httpRequest = isset($_SERVER['HTTP_X_REQUESTED_WITH']) ? $_SERVER['HTTP_X_REQUESTED_WITH'] : '';
		$template = (strtolower($httpRequest) === 'xmlhttprequest') ? TEMPLATE_AJAX : TEMPLATE_DESIGN;

		// Create main template for design and display it
		$smarty = Template::getInstance($kernel->getController()->getSkin());
		$smarty->assign('page', $kernel->getPage());
		$smarty->assign('controller', $kernel->getController());
		$smarty->assign('skin', Server::getBaseUrl().$kernel->getController()->getSkin());
		$smarty->display($kernel->getController()->getSkin().$template);
	}
}
catch (\Throwable $e)
{
    $title = "Fatal Error";
    $description = $e->getMessage();
	$stacktrace = $e->getTraceAsString();
	include_once 'fatal.php';
}