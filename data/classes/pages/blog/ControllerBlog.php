<?
namespace pages\blog;

use \core\Router;

class ControllerBlog extends \core\Controller
	{
	protected
		$pagerPageVariableName     = "page",
		$createNewBlogPostIndex    = "create_new_blog",
		$createNewCommentPostIndex = "create_new_comment";
	/* -------------------------------------------------------------------- */
	/* ---------------------------- constructor --------------------------- */
	/* -------------------------------------------------------------------- */
	public function __construct()
		{
		$this->setModel(new ModelBlog);
		$this->setView(new ViewBlog);
		}
	/* -------------------------------------------------------------------- */
	/* ------------------------------ start ------------------------------- */
	/* -------------------------------------------------------------------- */
	public function start()
		{
		$currentAction  = $this->getCurrentAction();
		$urlVariables   = $this->getUrlVariables();
		$pagesTemplates = $this->getPagesTemplates();
		$detailPageUrl  = isset($pagesTemplates["page_detail"]) ? $pagesTemplates["page_detail"] : "";
		$listPageUrl    = isset($pagesTemplates["list"])        ? $pagesTemplates["list"]        : "";
		$itemId         = isset($urlVariables["ITEM_ID"])       ? $urlVariables["ITEM_ID"]       : "";
		$commentId      = isset($urlVariables["COMMENT_ID"])    ? $urlVariables["COMMENT_ID"]    : "";

		if(isset($_POST[$this->createNewBlogPostIndex]))
			{
			$newBlogId   = $this->getModel()->createNewBlog($_POST);
			$redirectUrl = $newBlogId ? str_replace("#ITEM_ID#", $newBlogId, $detailPageUrl) : $listPageUrl;
			header("Location:".$redirectUrl);
			}
		elseif(isset($_POST[$this->createNewCommentPostIndex]) && $itemId)
			{
			$newCommentId = $this->getModel()->createNewComment($_POST, $itemId);
			$redirectUrl  = str_replace("#ITEM_ID#", $itemId, $detailPageUrl);
			header("Location:".$redirectUrl);
			}
		elseif($currentAction == "list")
			$this->actionList();
		elseif($currentAction == "page_detail" && $itemId)
			$this->actionItemDetail($itemId);
		elseif($currentAction == "comments_detail" && $itemId && $commentId)
			$this->actionCommentDetail($itemId, $commentId);
		else
			Router::getInstance()->process404();
		}
	/* -------------------------------------------------------------------- */
	/* ---------------------------- action list --------------------------- */
	/* -------------------------------------------------------------------- */
	public function actionList()
		{
		$viewObject     = $this->getView();
		$modelObject    = $this->getModel();
		$pagesTemplates = $this->getPagesTemplates();
		$itemDetailUrl  = isset($pagesTemplates["page_detail"]) && strlen($pagesTemplates["page_detail"])
			? $pagesTemplates["page_detail"]
			: "";
		$listPageUrl    = isset($pagesTemplates["list"]) && strlen($pagesTemplates["list"])
			? $pagesTemplates["list"]."?".$this->pagerPageVariableName."=#PAGE#"
			: "";
		$pageSize       = 3;
		$currentPage    = isset($_GET[$this->pagerPageVariableName]) && (int) $_GET[$this->pagerPageVariableName]
			? (int) $_GET[$this->pagerPageVariableName]
			: 1;
		$itemsList      = $modelObject->queryItemsList($currentPage, $pageSize);
		$itemsTop       = $modelObject->queryItemsTop(5);
		$pagerInfo      = $modelObject->getPagerInfo($currentPage, $pageSize);

		if($itemDetailUrl)
			{
			if(count($itemsList))
				foreach($itemsList as $index => $infoArray)
					$itemsList[$index]["LINK"] = str_replace("#ITEM_ID#", $infoArray["ID"], $itemDetailUrl);
			if(count($itemsTop))
				foreach($itemsTop as $index => $infoArray)
					$itemsTop[$index]["LINK"] = str_replace("#ITEM_ID#", $infoArray["ID"], $itemDetailUrl);
			}
		if(count($pagerInfo) && $listPageUrl)
			foreach($pagerInfo as $index => $infoArray)
				$pagerInfo[$index]["LINK"] = str_replace("#PAGE#", $infoArray["PAGE"], $listPageUrl);

		$viewObject->setContentType("list");
		$viewObject->setData("LIST_TOP",   $itemsTop);
		$viewObject->setData("LIST_DATA",  $itemsList);
		$viewObject->setData("PAGER_INFO", $pagerInfo);
		$viewObject->setData
			(
			"FORM_INFO",
				[
				"ADD_BUTTON_NAME" => $this->createNewBlogPostIndex
				]
			);
		$viewObject->outputPage();
		}
	/* -------------------------------------------------------------------- */
	/* --------------------------- action detail -------------------------- */
	/* -------------------------------------------------------------------- */
	public function actionItemDetail($itemId)
		{
		$itemId         = (int) $itemId;
		$viewObject     = $this->getView();
		$modelObject    = $this->getModel();
		$pagesTemplates = $this->getPagesTemplates();

		$viewObject->setContentType("page_detail");
		$viewObject->setData("ITEM_INFO",     $modelObject->queryItemDetail($itemId));
		$viewObject->setData("ITEM_COMMENTS", $modelObject->queryItemComments($itemId));
		$viewObject->setData
			(
			"FORM_INFO",
				[
				"ADD_COMMENT_NAME" => $this->createNewCommentPostIndex
				]
			);
		$viewObject->setData
			(
			"LINKS_INFO",
				[
				"LIST" => isset($pagesTemplates["list"]) && strlen($pagesTemplates["list"])
					? $pagesTemplates["list"]
					: ""
				]
			);
		$viewObject->outputPage();
		}
	public function actionCommentDetail($itemId, $commentId)
		{
		exit("TEST PAGE: blogId - ".$itemId.", commentId - ".$commentId);
		}
	}