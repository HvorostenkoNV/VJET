<?
/* -------------------------------------------------------------------- */
/* ------------------------------ slider ------------------------------ */
/* -------------------------------------------------------------------- */
?>
<div class="blog-list-slider">

</div>
<?
/* -------------------------------------------------------------------- */
/* ------------------------------- list ------------------------------- */
/* -------------------------------------------------------------------- */
?>
<div class="blog-list">
	<?foreach($TEMPLATE_DATA["LIST_DATA"] as $itemInfo):?>
	<div class="item">
		<a class="title" href="<?=$itemInfo["LINK"]?>">
			<?=$itemInfo["NAME"]?>
		</a>
		<div class="info">
			<?if($itemInfo["COMMENTS"] > 0):?>
			<div class="comment"><?=$itemInfo["COMMENTS"]?> комментариев</div>
			<?endif?>
			<div class="date"><?=date("d.m.Y H:i:s", strtotime($itemInfo["DATE"]))?></div>
			<div class="author"><?=$itemInfo["AUTHOR"]?></div>
		</div>
		<div class="text">
			<?
			$text = is_string($itemInfo["TEXT"]) ? $itemInfo["TEXT"] : "";
			if(strlen($text) > 100) $text = substr($text, 0, 97)."...";
			?>
			<?=$text?>
		</div>
	</div>
	<?endforeach?>
</div>
<?
/* -------------------------------------------------------------------- */
/* ------------------------------ pager ------------------------------- */
/* -------------------------------------------------------------------- */
?>
<?if(count($TEMPLATE_DATA["PAGER_INFO"])):?>
<div class="blog-list-pager">
	<?foreach($TEMPLATE_DATA["PAGER_INFO"] as $itemInfo):?>
	<a href="<?=$itemInfo["LINK"]?>" <?if($itemInfo["ACTIVE"]):?>class="selected"<?endif?>>
		<?=$itemInfo["PAGE"]?>
	</a>
	<?endforeach?>
</div>
<?endif?>
<?
/* -------------------------------------------------------------------- */
/* ----------------------------- add form ----------------------------- */
/* -------------------------------------------------------------------- */
?>
<div class="blog-list-add-form-call-button" tabindex="0">
	Создать
</div>
<form class="blog-list-add-form" method="POST">
	<div class="row">
		<div>Название:</div>
		<div>
			<input type="text" name="NAME" required>
		</div>
	</div>
	<div class="row">
		<div>Текст:</div>
		<div>
			<textarea name="TEXT" required></textarea>
		</div>
	</div>
	<button name="<?=$TEMPLATE_DATA["FORM_INFO"]["ADD_BUTTON_NAME"]?>">Создать</button>
</form>