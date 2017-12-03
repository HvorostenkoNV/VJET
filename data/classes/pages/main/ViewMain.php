<?
namespace pages\main;

use \core\ContentTemplate;

class ViewMain extends \core\View
	{
	public function outputPage()
		{
		$pageTemplateObject    = new PageTemplate();
		$contentTemplateObject = new ContentTemplate();

		$contentTemplateObject->setTemplatePath("main".DIRECTORY_SEPARATOR."index.php");
		foreach($this->getData() as $index => $value)
			$contentTemplateObject->setData($index, $value);

		$pageTemplateObject->calcTemplateData();
		$pageTemplateObject->setData("title", "Главная");
		$pageTemplateObject->setData("content", $contentTemplateObject->getContentHtml());
		$pageTemplateObject->apply();
		}
	}