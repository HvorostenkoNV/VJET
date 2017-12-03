<?
namespace core;

abstract class Controller
	{
	private
		$modelObject   = NULL,
		$viewObject    = NULL,
		$currentAction = "",
		$urlTemplates  = [],
		$urlVariables  = [];
	/* -------------------------------------------------------------------- */
	/* ------------------------ model/view objects ------------------------ */
	/* -------------------------------------------------------------------- */
	final protected function setModel(Model $modelObject)
		{
		$this->modelObject = $modelObject;
		}
	final protected function setView(View $viewObject)
		{
		$this->viewObject = $viewObject;
		}
	final public function getModel()
		{
		return $this->modelObject;
		}
	final public function getView()
		{
		return $this->viewObject;
		}
	/* -------------------------------------------------------------------- */
	/* -------------------------- pages templates ------------------------- */
	/* -------------------------------------------------------------------- */
	final public function setPagesTemplates(array $pagesTemplatesArray)
		{
		$this->currentAction = "";
		$this->urlVariables  = [];
		$this->urlTemplates  = $pagesTemplatesArray;
		$this->parsePagesTemplates();
		}
	final public function getPagesTemplates()
		{
		return $this->urlTemplates;
		}
	private function parsePagesTemplates()
		{
		$requestUrlArray = explode("/", REQUEST_URL);

		foreach($this->urlTemplates as $action => $url)
			{
			$urlArray               = explode("/", str_replace("index.php", "", $url));
			$currentAction          = false;
			$currentActionVariables = [];

			if(count($requestUrlArray) == count($urlArray))
				foreach($urlArray as $index => $value)
					{
					$templateFolder = $value;
					$currentFolder  = $requestUrlArray[$index];
					$isVariable     =
						strlen($templateFolder)                      >= 3   &&
						strlen($currentFolder)                              &&
						$templateFolder{0}                           == "#" &&
						$templateFolder{strlen($templateFolder) - 1} == "#";

					if($templateFolder != $currentFolder && !$isVariable)
						{
						$currentAction = false;
						break;
						}

					$currentAction = true;
					if($isVariable)
						$currentActionVariables[str_replace("#", "", $templateFolder)] = $currentFolder;
					}

			if($currentAction)
				{
				$this->currentAction = $action;
				$this->urlVariables  = $currentActionVariables;
				break;
				}
			}
		}
	/* -------------------------------------------------------------------- */
	/* ------------------------- action/variables ------------------------- */
	/* -------------------------------------------------------------------- */
	final public function getCurrentAction()
		{
		return $this->currentAction;
		}
	final public function getUrlVariables()
		{
		return $this->urlVariables;
		}
	/* -------------------------------------------------------------------- */
	/* ----------------------------- abstract ----------------------------- */
	/* -------------------------------------------------------------------- */
	abstract public function start();
	}