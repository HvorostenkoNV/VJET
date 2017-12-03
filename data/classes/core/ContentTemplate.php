<?
namespace core;

class ContentTemplate
	{
	private
		$data         = [],
		$contentHtml  = "",
		$templatePath = "";
	private static $templatesFolder =
		DIRECTORY_SEPARATOR."data".DIRECTORY_SEPARATOR.
		"templates".DIRECTORY_SEPARATOR.
		"content".DIRECTORY_SEPARATOR;
	/* -------------------------------------------------------------------- */
	/* ------------------------- templates folder ------------------------- */
	/* -------------------------------------------------------------------- */
	final public static function getTemplatesFolder()
		{
		return self::$templatesFolder;
		}
	final public function setTemplatePath($templatePath)
		{
		if(is_string($templatePath) && strlen($templatePath))
			$this->templatePath = $templatePath;
		}
	/* -------------------------------------------------------------------- */
	/* ------------------------------- data ------------------------------- */
	/* -------------------------------------------------------------------- */
	final public function setData($index, $value)
		{
		if(is_string($index) && strlen($index))
			$this->data[$index] = $value;
		}
	final public function getData()
		{
		return $this->data;
		}
	/* -------------------------------------------------------------------- */
	/* --------------------------- content html --------------------------- */
	/* -------------------------------------------------------------------- */
	final public function getContentHtml()
		{
		$contentHtml  = "";
		$templatePath = $this->templatePath
			? SITE_PATH.self::$templatesFolder.$this->templatePath
			: "";

		if($templatePath && file_exists($templatePath))
			{
			ob_start();
			$TEMPLATE_DATA = $this->getData();
			include $templatePath;
			$contentHtml = ob_get_contents();
			ob_end_clean();
			}

		$this->contentHtml = $contentHtml;
		return $this->contentHtml;
		}
	}