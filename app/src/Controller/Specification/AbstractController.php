<?php
namespace Controller\Specification;

use Template\Template;
use Utils\Server;

/**
 * Abstract version of the Controller.
 *
 * Implements default values for META data.
 *
 * @package Controller
 * @author Johan Chavaillaz
 * @since 1.0.0
 */
abstract class AbstractController implements Controller
{
	/**
	 * Arguments list passed to the Controller
	 *
	 * @var array
	 */
	protected $arguments;

	/**
	 * Current URL for this controller
	 *
	 * @var string
	 */
	protected $url;

	/**
	 * Template file for Smarty
	 *
	 * @var string
	 */
	protected $template;

	/**
	 * Skin path
	 *
	 * @var string
	 */
	protected $skin;

	/**
	 * Smarty object for template management
	 *
	 * @var \Smarty
	 */
	protected $smarty;

	/**
	 * Header array
	 *
	 * @var string
	 */
	protected $header = array();

	/**
	 * Set arguments array, smarty object and URL controller.
	 *
	 * @see Controller::__construct()
	 */
	public function __construct(array $arguments)
	{
		$this->arguments = $arguments;
		$this->skin = PATH_SKIN;
		$this->url = Server::getBaseUrl();

		$this->smarty = Template::getInstance('.');
		$this->smarty->assign('skin', Server::getBaseUrl().$this->skin);
		$this->smarty->setTemplateDir($this->skin.'template/');
	}

	/**
	 * @see Controller::index()
	 */
	public abstract function index();

	/**
	 * @see Controller::getPageName()
	 */
	public function getPageName()
	{
		return DEFAULT_PAGE_NAME;
	}

	/**
	 * @see Controller::getPageDescription()
	 */
	public function getPageDescription()
	{
		return DEFAULT_PAGE_DESCRIPTION;
	}

	/**
	 * @see Controller::getPageKeywords()
	 */
	public function getPageKeywords()
	{
		return DEFAULT_PAGE_KEYWORDS;
	}

	/**
	 * @see Controller::getPageRobots()
	 */
	public function getPageRobots()
	{
		return DEFAULT_PAGE_ROBOTS;
	}

	/**
	 * @see Controller::getPageAuthor()
	 */
	public function getPageAuthor()
	{
		return DEFAULT_PAGE_AUTHOR;
	}

	/**
	 * @see Controller::getPageContent()
	 */
	public function getPageContent()
	{
		if (!empty($this->template) AND !empty($this->skin))
		{
			return $this->smarty->fetch($this->template);
		}

		return '';
	}

	/**
	 * @see Controller::getHeaders()
	 */
	public function getHeaders()
	{
		return $this->header;
	}

	/**
	 * @see Controller::getMethodAvailable()
	 */
	public static function getMethodAvailable()
	{
		return array('index');
	}

	/**
	 * @see Controller:getMethodPosition()
	 */
	public static function getMethodPosition(array $urlExplode)
	{
		return 0;
	}

	/**
	 * @see Controller::getScriptList()
	 */
	public function getScriptList()
	{
		return array();
	}

	/**
	 * @see Controller::getStylesheetList()
	 */
	public function getStylesheetList()
	{
		return array();
	}

	/**
	 * Retrieve the skin path of current page
	 *
	 * @return string Skin path
	 */
	public function getSkin()
	{
		return $this->skin;
	}
}