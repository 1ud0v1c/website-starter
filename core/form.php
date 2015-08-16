<?php
	class Form {
		public function __construct($action = "#", $method = "POST") {
			echo "<form action='".$action."' method='".$method."'>";
		}

		public function input($type, $name, $placeholder = '') {
			echo "<input type='".$type."' name='".$name."' placeholder='".$placeholder."' />";
		}

		public function textarea($name, $placeholder = '') {
			echo "<textarea name='".$name."' placeholder='".$placeholder."' cols='45' rows='5'></textarea>";
		}

		public function select($name, $data = array()) {
			echo "<select name='".$name."'>";
			foreach ($data as $key => $value) {
				echo "<option value='".$key."'>$value</option>";
			}
			echo "</select>";
		}

		public function submit($value = 'Valider') {
			echo "<input type='submit' name='post_form' value='".$value."' />";
			echo "</form>";
		}
	}
?>

