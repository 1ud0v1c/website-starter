<?php
	require_once "core/db.php";
	require_once "core/form.php";
	require_once "core/parsedown.php";
	require_once "core/curl.php";
	require_once "core/image-handler.php";
?>

<html>
	<head>
		<meta charset="UTF-8">
		<title>Light Framework</title>
		<link rel="stylesheet" href="css/main.css">
		<script type="text/javascript" src="js/jquery-min.js"></script>
	</head>
<body>
	<div class="header"></div>

	<div class="content">
		<?php
			$img_handler = new Image();
			$img_handler->createImage();
			// $img_handler->generateMin("img/background.jpg", "img");
		?>

		<?php
			$form = new Form();
			$form->input("text", "name", "John Doe");
			$form->input("checkbox", "genre");
			$form->select("land", array(
				"1" => "France",
				"2" => "England"
			));
			$form->textarea("content", "Ceci est un message...");
			$form->submit();
		 ?>
		<img src="http://placekitten.com/400/600" class="box-shadow" alt="" />

		<?php
			if(isset($_POST['post_form'])) {
				var_dump($_POST);
			}

			$md = new Parsedown();
			$text = file_get_contents("markdown.txt");
			echo $md->text($text);
		?>
	</div>

</body>
</html>
