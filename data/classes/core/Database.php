<?
namespace core;

use \PDO;

final Class Database
	{
	private static
		$instance = NULL;
	private
		$pdoObject = NULL;
	/* -------------------------------------------------------------------- */
	/* ---------------------------- constructor --------------------------- */
	/* -------------------------------------------------------------------- */
	public static function getInstance()
		{
		if(!self::$instance) self::$instance = new self();
		return self::$instance;
		}
	private function __construct()
		{
		try
			{
			$this->pdoObject = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
			$this->pdoObject->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
		catch(PDOException $exception)
			{
			exit("Database error: ".$exception->getMessage());
			}
		}
	private function __clone() {}
	/* -------------------------------------------------------------------- */
	/* ------------------------------- query ------------------------------ */
	/* -------------------------------------------------------------------- */
	public function query($queryString)
		{
		$queryResult       = [];
		$queryResultObject = NULL;

		try
			{
			$queryResultObject = $this->pdoObject->query($queryString);
			if($queryResultObject) $queryResult = $queryResultObject->fetchAll();
			}
		catch(PDOException $exception)
			{
			
			}

		return $queryResult;
		}
	/* -------------------------------------------------------------------- */
	/* ------------------------------- query ------------------------------ */
	/* -------------------------------------------------------------------- */
	public function update($queryString)
		{
		try
			{
			$this->pdoObject->query($queryString);
			}
		catch(PDOException $exception)
			{
			
			}

		return $this->pdoObject->lastInsertId();
		}
	}