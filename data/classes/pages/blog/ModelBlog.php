<?
namespace pages\blog;

use \core\Database;

class ModelBlog extends \core\Model
	{
	/* -------------------------------------------------------------------- */
	/* --------------------------- get user id ---------------------------- */
	/* -------------------------------------------------------------------- */
	protected function getUserId()
		{
		$userIp       =
			getenv("HTTP_CLIENT_IP")      ? :
			getenv("HTTP_X_FORWARDED_FOR")? :
			getenv("HTTP_X_FORWARDED")    ? :
			getenv("HTTP_FORWARDED_FOR")  ? :
			getenv("HTTP_FORWARDED")      ? :
			getenv("REMOTE_ADDR");
		$userUnicCode = md5($userIp);
		$userId       = 0;
		$DB           = Database::getInstance();

		foreach($DB->query("SELECT ID FROM user WHERE UNIC_CODE=\"".$userUnicCode."\"") as $queryItem)
			$userId = (int) $queryItem["ID"];
		if(!$userId)
			{
			$userId = (int) $DB->update("INSERT INTO user (NAME, UNIC_CODE) VALUES (\"Guset New\", \"".$userUnicCode."\")");
			if($userId) $DB->update("UPDATE user SET NAME=\"Guest ".$userId."\" WHERE ID=\"".$userId."\"");
			}

		return $userId;
		}
	/* -------------------------------------------------------------------- */
	/* ------------------------- create new blog -------------------------- */
	/* -------------------------------------------------------------------- */
	public function createNewBlog(array $postData)
		{
		$newBlodId = 0;
		$userId    = $this->getUserId();
		$blogName  = isset($postData["NAME"]) ? $postData["NAME"] : "";
		$blogText  = isset($postData["TEXT"]) ? $postData["TEXT"] : "";

		if($userId && $blogName && $blogText)
			$newBlodId = (int) Database::getInstance()->update("INSERT INTO blog (NAME, TEXT, AUTHOR) VALUES (\"".$blogName."\", \"".$blogText."\", \"".$userId."\")");

		return $newBlodId;
		}
	/* -------------------------------------------------------------------- */
	/* ------------------------ create new comment ------------------------ */
	/* -------------------------------------------------------------------- */
	public function createNewComment(array $postData, $itemId)
		{
		$newCommentId = 0;
		$userId       = $this->getUserId();
		$blogId       = (int) $itemId;
		$commentText  = isset($postData["TEXT"]) ? $postData["TEXT"] : "";

		if($userId && $blogId && $commentText)
			$newCommentId = (int) Database::getInstance()->update("INSERT INTO comments (TEXT, AUTHOR, BLOG) VALUES (\"".$commentText."\", \"".$userId."\", \"".$blogId."\")");

		return $newBlodId;
		}
	/* -------------------------------------------------------------------- */
	/* ------------------------- query items list ------------------------- */
	/* -------------------------------------------------------------------- */
	public function queryItemsList($currentPage, $pageSize)
		{
		$result          = [];
		$DB              = Database::getInstance();
		$pageSize        = (int) $pageSize;
		$currentPage     = (int) $currentPage ? (int) $currentPage : 1;
		$blogIdArray     = [];
		$blogQueryString = "
			SELECT
				blog.ID           AS ID,
				blog.NAME         AS NAME,
				blog.TEXT         AS TEXT,
				blog.CREATED_DATE AS DATE,
				user.NAME         AS AUTHOR
			FROM blog INNER JOIN user
			ON
				blog.AUTHOR=user.ID
			ORDER BY
				CREATED_DATE DESC
			LIMIT
				".(($currentPage - 1) * $pageSize).", ".$pageSize;

		if($pageSize)
			foreach($DB->query($blogQueryString) as $queryItem)
				{
				$itemId = isset($queryItem["ID"]) ? (int) $queryItem["ID"] : 0;
				if(!$itemId) continue;

				foreach(["ID", "NAME", "TEXT", "DATE", "AUTHOR"] as $index)
					$result[$itemId][$index] = isset($queryItem[$index]) ? $queryItem[$index] : "";
				$result[$itemId]["COMMENTS"] = 0;
				$blogIdArray[] = $itemId;
				}

		if(count($blogIdArray))
			foreach($DB->query("SELECT ID, BLOG FROM comments WHERE BLOG IN (".implode(", ", $blogIdArray).")") as $queryItem)
				{
				$blogId = isset($queryItem["BLOG"]) ? (int) $queryItem["BLOG"] : 0;
				if($blogId && isset($result[$blogId]) && isset($result[$blogId]["COMMENTS"]))
					$result[$blogId]["COMMENTS"]++;
				}

		return $result;
		}
	/* -------------------------------------------------------------------- */
	/* ------------------------- query items top -------------------------- */
	/* -------------------------------------------------------------------- */
	public function queryItemsTop($itemCount)
		{
		
		}
	/* -------------------------------------------------------------------- */
	/* ---------------------------- pager info ---------------------------- */
	/* -------------------------------------------------------------------- */
	public function getPagerInfo($currentPage, $pageSize)
		{
		$result      = [];
		$queryResult = Database::getInstance()->query("SELECT COUNT(ID) FROM blog");
		$pageSize    = (int) $pageSize;
		$currentPage = (int) $currentPage;
		$itemsCount  =
			is_array($queryResult)    && isset($queryResult[0]) &&
			is_array($queryResult[0]) && isset($queryResult[0][0])
				? (int) $queryResult[0][0]
				: 0;
		$pagesCount  = $pageSize ? ceil($itemsCount / $pageSize) : 0;

		if($pagesCount > 0)
			for($i = 1;$i <= $pagesCount;$i++)
				$result[] =
					[
					"PAGE"   => $i,
					"ACTIVE" => $i == $currentPage
					];

		return $result;
		}
	/* -------------------------------------------------------------------- */
	/* ------------------------ query item detail ------------------------- */
	/* -------------------------------------------------------------------- */
	public function queryItemDetail($itemId)
		{
		$result      = [];
		$itemId      = (int) $itemId;
		$queryString = "
			SELECT
				blog.ID           AS ID,
				blog.NAME         AS NAME,
				blog.TEXT         AS TEXT,
				blog.CREATED_DATE AS DATE,
				user.NAME         AS AUTHOR
			FROM blog INNER JOIN user
			ON
				blog.AUTHOR=user.ID
			WHERE
				blog.ID=\"".$itemId."\"";

		if($itemId)
			foreach(Database::getInstance()->query($queryString) as $queryItem)
				foreach(["ID", "NAME", "TEXT", "DATE", "AUTHOR"] as $index)
					$result[$index] = isset($queryItem[$index]) ? $queryItem[$index] : "";

		return $result;
		}
	/* -------------------------------------------------------------------- */
	/* ----------------------- query item comments ------------------------ */
	/* -------------------------------------------------------------------- */
	public function queryItemComments($itemId)
		{
		$result      = [];
		$itemId      = (int) $itemId;
		$queryString = "
			SELECT
				comments.ID           AS ID,
				comments.TEXT         AS TEXT,
				comments.CREATED_DATE AS DATE,
				user.NAME             AS AUTHOR
			FROM comments INNER JOIN user
			ON
				comments.AUTHOR=user.ID
			WHERE
				comments.BLOG=\"".$itemId."\"
			ORDER BY
				CREATED_DATE DESC";

		if($itemId)
			foreach(Database::getInstance()->query($queryString) as $queryItem)
				{
				$itemInfoArray = [];
				foreach(["ID", "TEXT", "DATE", "AUTHOR"] as $index)
					$itemInfoArray[$index] = isset($queryItem[$index]) ? $queryItem[$index] : "";
				$result[] = $itemInfoArray;
				}

		return $result;
		}
	}