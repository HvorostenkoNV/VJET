<?
namespace pages\main;

class PageTemplate extends \core\PageTemplate
	{
	public function __construct()
		{
		$this->addCss(self::getTemplatesFolder().$this->getTemplateName().DIRECTORY_SEPARATOR."style.css");
		$this->addJs ("https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js");
		}
	public function getTemplateName()
		{
		return "default";
		}
	public function calcTemplateData()
		{
		$menuArray = [];
		// some proccess to get menu array, omitted for simplicity
		$menuArray =
			[
			"/"      => "главная",
			"/blog/" => "блог"
			];

		$this->setData("menu", $menuArray);
		}
	}