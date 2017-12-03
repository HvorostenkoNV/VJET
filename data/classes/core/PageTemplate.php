<?
namespace core;

abstract class PageTemplate
	{
	private
		$data         = [],
		$includeStyle = [],
		$includeJs    = [];
	private static $templatesFolder =
		DIRECTORY_SEPARATOR."data".DIRECTORY_SEPARATOR.
		"templates".DIRECTORY_SEPARATOR.
		"page".DIRECTORY_SEPARATOR;
	/* -------------------------------------------------------------------- */
	/* ----------------------- get templates folder ----------------------- */
	/* -------------------------------------------------------------------- */
	final public static function getTemplatesFolder()
		{
		return self::$templatesFolder;
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
	/* ----------------------------- style/js ----------------------------- */
	/* -------------------------------------------------------------------- */
	final public function addCss($styleLink)
		{
		if(is_string($styleLink) && strlen($styleLink))
			$this->includeStyle[] = $styleLink;
		}
	final public function addJs($jsLink)
		{
		if(is_string($jsLink) && strlen($jsLink))
			$this->includeJs[] = $jsLink;
		}
	/* -------------------------------------------------------------------- */
	/* --------------------- define template constance -------------------- */
	/* -------------------------------------------------------------------- */
	final private function defineTemplateConstance()
		{
		$templateHeader = "";
		foreach($this->includeStyle as $styleLink)
			$templateHeader .= "<link href=\"".str_replace(DIRECTORY_SEPARATOR, "/", $styleLink)."\" type=\"text/css\" rel=\"stylesheet\">\n";
		foreach($this->includeJs as $jsLink)
			$templateHeader .= "<script type=\"text/javascript\" src=\"".str_replace(DIRECTORY_SEPARATOR, "/", $jsLink)."\"></script>\n";

		define("TEMPLATE_FOLDER", str_replace(DIRECTORY_SEPARATOR, "/", self::getTemplatesFolder()).$this->getTemplateName()."/");
		define("TEMPLATE_HEAD",   $templateHeader);
		}
	/* -------------------------------------------------------------------- */
	/* ------------------------------- apply ------------------------------ */
	/* -------------------------------------------------------------------- */
	final public function apply()
		{
		$templatePath = $this->getTemplateName()
			? SITE_PATH.self::getTemplatesFolder().$this->getTemplateName().DIRECTORY_SEPARATOR."template.php"
			: "";

		if($templatePath && file_exists($templatePath))
			{
			$this->defineTemplateConstance();
			$TEMPLATE_DATA = $this->getData();
			include $templatePath;
			}

		exit();
		}
	/* -------------------------------------------------------------------- */
	/* ----------------------------- absctract ---------------------------- */
	/* -------------------------------------------------------------------- */
	abstract public function getTemplateName();
	}