<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
		<?=TEMPLATE_HEAD?>
	</head>
	<body>
		<header class="responsive-block">
			<img class="logo" src="<?=TEMPLATE_FOLDER?>images/blog.svg">
			<div class="menu">
				<?foreach($TEMPLATE_DATA["menu"] as $link => $title):?>
				<a href="<?=$link?>"><?=$title?></a>
				<?endforeach?>
			</div>
		</header>

		<h1 id="page-title" class="responsive-block">
			<?=$TEMPLATE_DATA["title"]?>
		</h1>

		<main class="responsive-block">
			<?=$TEMPLATE_DATA["content"]?>
		</main>

		<footer class="responsive-block">
			#FOOTER#
		</footer>
	</body>
</html>