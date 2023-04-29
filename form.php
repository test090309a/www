echo "
<!DOCTYPE html>
<html>
<head>
	<title>Dynamisches Texteingabe-Formular</title>
	<script>
		function showInput() {
			document.getElementById('output').innerHTML = document.getElementById('textfeld').value;
		}
	</script>
</head>
<body>

	<h1>Dynamisches Texteingabe-Formular</h1>

	<form method="POST" action="" onsubmit="showInput(); return false;">
		<label for="textfeld">Gib deinen Text ein:</label>
		<input type="text" id="textfeld" name="textfeld"><br><br>
		<input type="submit" value="Absenden">
	</form>

	<p>Eingabe: <span id="output"></span></p>

</body>
</html>
";
?>
