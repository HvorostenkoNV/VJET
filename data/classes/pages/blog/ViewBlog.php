<?
namespace pages\blog;

use
	\core\ContentTemplate,
	\pages\blog\BlogPageTemplate;

class ViewBlog extends \core\View
	{
	public function outputPage()
		{
		$pageTemplateObject    = new BlogPageTemplate();
		$contentTemplateObject = new ContentTemplate();

		$pageTemplateObject->calcTemplateData();
		foreach($this->getData() as $index => $value)
			$contentTemplateObject->setData($index, $value);

		switch($this->getContentType())
			{
			case "list":
				$pageTemplateObject->setData("title", "Блог");
				$pageTemplateObject->addCss(ContentTemplate::getTemplatesFolder()."blog".DIRECTORY_SEPARATOR."list.css");
				$pageTemplateObject->addJs (ContentTemplate::getTemplatesFolder()."blog".DIRECTORY_SEPARATOR."list.js");
				$contentTemplateObject->setTemplatePath("blog".DIRECTORY_SEPARATOR."list.php");
				break;
			case "page_detail":
				$itemName  = isset($this->getData()["ITEM_INFO"]["NAME"]) && strlen($this->getData()["ITEM_INFO"]["NAME"])
					? $this->getData()["ITEM_INFO"]["NAME"]
					: "";

				$pageTemplateObject->setData("title", $itemName ? "Блог: ".$itemName : "Блог");
				$pageTemplateObject->addCss(ContentTemplate::getTemplatesFolder()."blog".DIRECTORY_SEPARATOR."page_detail.css");
				$pageTemplateObject->addJs (ContentTemplate::getTemplatesFolder()."blog".DIRECTORY_SEPARATOR."page_detail.js");
				$contentTemplateObject->setTemplatePath("blog".DIRECTORY_SEPARATOR."page_detail.php");
				break;
			case "comments_detail":
				break;
			default:
			}

		$pageTemplateObject->setData("content", $contentTemplateObject->getContentHtml());
		$pageTemplateObject->apply();
		}
	}