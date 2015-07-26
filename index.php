<?php
	require_once "core/db.php";
	require_once "core/form.php";
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
			$form = new Form();
			$form->input("text", "name", "John Doe");
			$form->select("land", array(
				"1" => "France",
				"2" => "England"
			));
			$form->textarea("content", "Ceci est un message...");
			$form->submit();
		 ?>
		<img src="http://placekitten.com/400/600" class="box-shadow" alt="" />

	</div>


	<?php
		if(isset($_POST['post_form'])) {
			var_dump($_POST);
		}
	?>

</body>
</html>