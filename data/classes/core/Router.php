<?
namespace core;

class Router
	{
	private static $instance       = NULL;
	private        $routeTemplates = [];
	/* -------------------------------------------------------------------- */
	/* ---------------------------- constructor --------------------------- */
	/* -------------------------------------------------------------------- */
	public static function getInstance()
		{
		if(!self::$instance) self::$instance = new self();
		return self::$instance;
		}
	private function __construct() {}
	private function __clone()     {}
	/* -------------------------------------------------------------------- */
	/* ------------------------------- run -------------------------------- */
	/* -------------------------------------------------------------------- */
	public function run()
		{
		$controllerClassName = "";
		$pagesTemplatesArray = [];
		$controllerObject    = NULL;

		if(REQUEST_URL == "/")
			$controllerClassName = DIRECTORY_SEPARATOR."pages".DIRECTORY_SEPARATOR."main".DIRECTORY_SEPARATOR."ControllerMain";
		else
			foreach($this->getRouteTemplates() as $itemInfo)
				if($itemInfo["root_path"] && strpos(REQUEST_URL, $itemInfo["root_path"]) === 0)
					{
					$controllerClassName = $itemInfo["controller_class_name"];
					if(is_array($itemInfo["path_array"]))
						foreach($itemInfo["path_array"] as $index => $value)
							$pagesTemplatesArray[$index] = $itemInfo["root_path"].$value;
					break;
					}

		if($controllerClassName && class_exists($controllerClassName))
			$controllerObject = new $controllerClassName();

		if($controllerObject && $controllerObject instanceof Controller)
			{
			$controllerObject->setPagesTemplates($pagesTemplatesArray);
			$controllerObject->start();
			}
		else
			$this->process404();
		}
	/* -------------------------------------------------------------------- */
	/* ------------------------ get route templates ----------------------- */
	/* -------------------------------------------------------------------- */
	public function getRouteTemplates()
		{
		if(!count($this->routeTemplates))
			{
			include SITE_PATH.DIRECTORY_SEPARATOR."data".DIRECTORY_SEPARATOR."route_templates.php";
			$this->routeTemplates = $routeTemplates;
			}
		return $this->routeTemplates;
		}
	/* -------------------------------------------------------------------- */
	/* ----------------------------- run 404 ------------------------------ */
	/* -------------------------------------------------------------------- */
	public function process404()
		{
		include SITE_PATH.DIRECTORY_SEPARATOR."404.php";
		exit();
		}
	}