<?
/* -------------------------------------------------------------------- */
/* ----------------------------- main info ---------------------------- */
/* -------------------------------------------------------------------- */
?>
<div class="blog-detail-info">
	<a class="list-link" href="<?=$TEMPLATE_DATA["LINKS_INFO"]["LIST"]?>">
		к списку
	</a>
	<div class="info">
		<div class="date"><?=date("d.m.Y H:i:s", strtotime($TEMPLATE_DATA["ITEM_INFO"]["DATE"]))?></div>
		<div class="author"><?=$TEMPLATE_DATA["ITEM_INFO"]["AUTHOR"]?></div>
	</div>
	<div class="text">
		<?=$TEMPLATE_DATA["ITEM_INFO"]["TEXT"]?>
	</div>
</div>
<?
/* -------------------------------------------------------------------- */
/* ----------------------------- comments ----------------------------- */
/* -------------------------------------------------------------------- */
?>
<?if(count($TEMPLATE_DATA["ITEM_COMMENTS"])):?>
<div class="blog-detail-comments">
	<?foreach($TEMPLATE_DATA["ITEM_COMMENTS"] as $commentInfo):?>
	<div class="item">
		<div class="name">
			<?=$commentInfo["AUTHOR"]?> - <?=date("d.m.Y H:i:s", strtotime($commentInfo["DATE"]))?>
		</div>
		<div class="text">
			<?=$commentInfo["TEXT"]?>
		</div>
	</div>
	<?endforeach?>
</div>
<?endif?>
<?
/* -------------------------------------------------------------------- */
/* ----------------------------- add form ----------------------------- */
/* -------------------------------------------------------------------- */
?>
<div class="blog-detail-add-comments-form-call-button" tabindex="0">
	Добавить комментарий
</div>
<form class="blog-detail-add-comments-form" method="POST">
	<textarea name="TEXT" required></textarea>
	<button name="<?=$TEMPLATE_DATA["FORM_INFO"]["ADD_COMMENT_NAME"]?>">Создать</button>
</form>