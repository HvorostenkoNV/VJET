<?
namespace core;

abstract class View
	{
	private
		$contentType = "",
		$data        = [];
	/* -------------------------------------------------------------------- */
	/* --------------------------- content type --------------------------- */
	/* -------------------------------------------------------------------- */
	final public function setContentType($contentType)
		{
		$this->contentType = $contentType;
		}
	final public function getContentType()
		{
		return $this->contentType;
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
	/* ----------------------------- abstract ----------------------------- */
	/* -------------------------------------------------------------------- */
	abstract public function outputPage();
	}